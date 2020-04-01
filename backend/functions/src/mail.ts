import * as express from 'express'
import * as exphbs from 'express-handlebars'
import * as functions from 'firebase-functions'
import * as nodemailer from 'nodemailer'
import { config } from 'firebase-functions'

// Configure the email transport using the default SMTP transport and a gmail account.
// For Gmail, enable these:
// 1. https://www.google.com/settings/security/lesssecureapps
// 2. https://accounts.google.com/DisplayUnlockCaptcha
// For other types of transports such as Sendgrid see https://nodemailer.com/transports/

// TODO: Before deploying, set the following environment data by running the following:
// firebase functions:config:set gmail.email="EMAIL USERNAME" gmail.password="EMAIL PASSWORD"
//      contact.receiver="YOUR_EMAIL_ADDRESS@DOMAIN.COM"

interface FunctionConfig extends config.Config {
  contact: {
    receiver: string
  }
  oauth: {
    client_id: string
    client_email: string
    private_key: string
  }
}

const getConfig = (): FunctionConfig => functions.config() as FunctionConfig

interface EmailData {
  name: string
  email: string
  msg: string
  ip: string
  userAgent: string
}

/**
 * Generates an HTML template using the given user information for sending via email.
 *
 * @param emailData Required data to build HTML form
 * @param response Express response required to render HTML template
 *
 * @returns {Promise} if resolves correctly, returns HTML template. If rejects, returns the message
 */
const buildTemplate = (
  emailData: EmailData,
  response: functions.Response
): Promise<String> => {
  console.log('Generating HTML template...')
  return new Promise((resolve, reject) => {
    response.render('template', emailData, (error: any, html: string) => {
      if (error) {
        console.error('Error building HTML template', error)
        reject(emailData.msg)
      }
      resolve(html)
      return
    })
  })
}

/**
 * Dispatches an email, either via template or text, to the recepient set at the top of this file.
 *
 * @param name Name of the contact form user
 * @param email Email of the contact form user
 * @param message Message to be sent
 * @param ip IP Address of the user
 * @param userAgent Browser user agent of the user
 *
 * @returns {Promise} if resolves correctly, returns email message ID. If rejects, returns error
 */
const sendEmail = async (
  name: string,
  email: string,
  message: string,
  request: functions.Request,
  response: functions.Response
): Promise<String> => {
  const mailOptions = {
    from: `"${name}" <${email}>`, // Sender address
    to: `${getConfig().contact.receiver}`, // Receiver address(s)
    subject: 'Contact Form'
  }

  let ip = ''
  if (request.headers['x-forwarded-for']) {
    console.log('Request headers', request.headers['x-forwarded-for'])
    ip = Array.isArray(request.headers['x-forwarded-for'])
      ? request.headers['x-forwarded-for'][0]
      : request.headers['x-forwarded-for'].toString()
  }

  const data: EmailData = {
    name: name,
    email: email,
    msg: message,
    ip: ip,
    userAgent: request.get('User-Agent')
  }

  try {
    const template = await buildTemplate(data, response)
    console.log('Successfully generated HTML template')
    mailOptions['html'] = template
  } catch (msg) {
    console.log('Failed to generate HTML template. Defaulting to text')
    mailOptions['text'] = msg
  }

  console.log('Sending email...')

  // Send mail
  const transporter = buildTransporter()
  return new Promise((resolve, reject) => {
    transporter.sendMail(mailOptions, (error, info) => {
      const messageId = info && info.messageId
      if (error || !messageId) {
        reject(error || new Error('Unable to send mail'))
      } else {
        resolve(`Message sent: ${info.messageId}`)
      }
    })
  })
}

const buildTransporter = () => {
  const { client_id, client_email, private_key } = getConfig().oauth
  return nodemailer.createTransport({
    host: 'smtp.gmail.com',
    port: 465,
    secure: true,
    auth: {
      type: 'OAuth2',
      user: client_email,
      clientId: client_id,
      private_key: private_key
    }
  } as any)
}

// Express output
const app = express()
app.engine('handlebars', exphbs({ defaultLayout: 'main' }))
app.set('view engine', 'handlebars')

app.post(
  '*',
  async (request: functions.Request, response: functions.Response) => {
    if (!request.body) {
      response.status(403).send('Missing request body')
    }

    const name = request.body.name,
      email = request.body.email,
      message = request.body.message

    if (!name || !email || !message) {
      response
        .status(403)
        .send(
          'Missing required body fields. Please check request: ' +
            JSON.stringify(request.body)
        )
    }

    return sendEmail(name, email, message, request, response)
      .then((result: any) => {
        console.log(result)
        return response.status(200).send('Message sent successfully!')
      })
      .catch((error: any) => {
        return response.status(403).send(error)
      })
  }
)

export default functions.https.onRequest((req, res) => {
  // Hitting the endpoint without a trailing "/" with cause the path to be null. Prepending the
  // trailing "/" lets us match the POST request
  if (!req.path) {
    req.url = `/${req.url}`
  }
  return app(req, res)
})

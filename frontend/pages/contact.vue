<template>
  <div class="content">
    <section id="contact" class="about-contact">
      <div class="left">
        <img class="portrait" src="~@/assets/img/peter.png" />
        <div class="text-block">
          <h2>Let's Chat!</h2>
          <p>
            Fill out that beautiful form
            <span v-if="mobile">below</span>
            <span v-else>to the right</span> and we'll get in touch! Or, if
            email is too antiquated, I've linked several social media profiles
            below. I love posting about my projects on Twitter, and I keep the
            LinkedIn fresh with all sorts of content. Use whatever floats your
            boat.
          </p>
          <a
            v-for="(social, index) in socials"
            :key="index"
            :index="index"
            :href="social.url"
            target="_blank"
          >
            <button class="btn btn-square">
              <i class="fa" :class="social.icon" aria-hidden="true"></i>
            </button>
          </a>
        </div>
      </div>
      <div class="right">
        <div class="contact-form">
          <h2>Contact Me</h2>
          <ValidationObserver v-slot="{ handleSubmit }">
            <form method="POST" @submit.prevent="handleSubmit(submitForm)">
              <h4>Name</h4>
              <ValidationProvider
                v-slot="{ errors }"
                name="name"
                rules="required|alpha_spaces"
              >
                <input
                  v-model="name"
                  type="text"
                  class="input"
                  :class="{ 'is-danger': errors.length }"
                  required="required"
                />
                <span v-show="errors.length" class="help is-danger">
                  {{ errors[0] }}
                </span>
              </ValidationProvider>

              <h4>Email</h4>
              <ValidationProvider
                v-slot="{ errors }"
                name="email"
                rules="required|email"
              >
                <input
                  v-model="email"
                  type="email"
                  class="input"
                  :class="{ 'is-danger': errors.length }"
                  required="required"
                />
                <span v-show="errors.length" class="help is-danger">
                  {{ errors[0] }}
                </span>
              </ValidationProvider>

              <h4>Message</h4>
              <textarea
                v-model="message"
                type="text"
                rows="4"
                name="message"
                required
              />
              <button
                type="submit"
                name="submit"
                value="Send Message"
                class="btn btn-white"
              >
                Send Message
              </button>
            </form>
          </ValidationObserver>
        </div>
      </div>
    </section>
    <Modal v-if="showModal" @close="hideModal">
      <h2 slot="header">
        <span v-if="showSuccess">Success!</span>
        <span v-else-if="showError">Uh-oh!</span>
        <span v-else>Sending your information...</span>
      </h2>
      <p slot="body">
        <span v-if="showSuccess"
          >Your contact form has been submitted successfully.</span
        >
        <span v-else-if="showError">
          There was an issue with your request. Please try again later or reach
          out to me directly by
          <a class="under" href="mailto:peter@abbondanzo.com">clicking here</a>.
        </span>
        <span v-else>Hang tight while your contact form gets sent.</span>
      </p>
    </Modal>
  </div>
</template>

<script>
import { ValidationObserver, ValidationProvider } from 'vee-validate'
import axios from 'axios'
import Modal from '~/components/Modal'

export default {
  name: 'Contact',
  components: {
    Modal,
    ValidationObserver,
    ValidationProvider,
  },
  data() {
    return {
      socials: [
        {
          name: 'Twitter',
          url: 'https://twitter.com/PAbbondanzo',
          icon: 'fa-twitter',
        },
        {
          name: 'LinkedIn',
          url: 'https://www.linkedin.com/in/pabbondanzo',
          icon: 'fa-linkedin',
        },
        {
          name: 'Github',
          url: 'https://github.com/Abbondanzo',
          icon: 'fa-github',
        },
      ],
      mobile: false,
      name: '',
      email: '',
      message: '',
      showModal: false,
      showSuccess: false,
      showError: false,
    }
  },
  mounted() {
    this.mobileCheck()
  },
  beforeMount() {
    window.addEventListener('resize', this.mobileCheck)
  },
  methods: {
    mobileCheck() {
      const width = document.body.offsetWidth
      this.mobile = width <= 960
    },
    submitForm() {
      const endpoint =
        process.env.NODE_ENV === 'production'
          ? 'mail/'
          : 'https://us-central1-abbondanzo-b8015.cloudfunctions.net/devmail'
      this.showModal = true
      axios
        .post(endpoint, {
          name: this.name,
          email: this.email,
          message: this.message,
        })
        .then((response) => {
          this.showSuccess = true
          if (process.env.NODE_ENV === 'production') {
            this.emptyForm()
          } else {
            // eslint-disable-next-line no-console
            console.log('Response: ', response)
          }
        })
        .catch((error) => {
          this.showError = true
          // eslint-disable-next-line no-console
          console.error('There was an error sending your message', error)
        })
    },
    emptyForm() {
      this.name = ''
      this.email = ''
      this.message = ''
    },
    hideModal() {
      this.showModal = false
      this.showSuccess = false
      this.showError = false
    },
  },
  head: {
    title: 'Contact',
    meta: [
      {
        hid: 'description',
        name: 'description',
        content:
          'Use this form to send me an email or follow any of my social profiles.',
      },
    ],
  },
}
</script>

<style lang="scss" scoped>
#app {
  .content {
    overflow-x: hidden;
  }
  section {
    min-height: 100vh;
    .left,
    .right {
      vertical-align: top;
      position: relative;
      z-index: 2;
      .valign {
        min-height: 500px;
      }
    }
    .left {
      height: 100%;
      min-height: 722px;
    }
    .right {
      margin-bottom: $padding;
    }
    &.about-contact {
      .left {
        background: #fff;
        color: $primary;
        z-index: 1;
        overflow-x: hidden;
        height: 100vh;
      }
      .portrait {
        position: absolute;
        bottom: 0;
        z-index: 0;
        opacity: 0.075;
        pointer-events: none;
      }
      .text-block {
        width: $container/2;
        z-index: 1;
        float: right;
        clear: both;
        padding: $padding;
        padding-top: $padding * 2;
        padding-right: $padding * 2;
        p {
          line-height: 1.8;
          font-size: 18px;
          padding-bottom: $padding/2;
          &:last-child {
            padding-bottom: 0;
          }
        }
        a {
          margin-right: 0.5em;
          i {
            font-size: 28px;
          }
          &:last-child {
            margin-right: 0;
          }
        }
      }
      .contact-form {
        width: $container/2 - $padding;
        padding: $padding;
        margin-top: $navbarheight;
        background: $primary;
        position: absolute;
        left: -$padding;
        h4 {
          color: #fff;
          padding-top: $padding / 4;
          &:first-child {
            padding-top: 0;
          }
        }
        input,
        textarea {
          width: 100%;
          padding-top: 40px;
          margin-bottom: 20px;
          background: transparent;
          border: 0;
          border-bottom: 3px solid #fff;
          width: 100%;
          font-size: 18px;
          font-family: 'Montserrat', sans-serif;
          color: #fff;
          box-shadow: 0 0 0px 1000px $primary inset;
          -webkit-box-shadow: 0 0 0px 1000px $primary inset;
          -webkit-text-fill-color: white !important;
          &.is-danger {
            border-bottom: 3px dashed #fff;
          }
        }
        textarea {
          resize: vertical;
        }
        form {
          position: relative;
        }
        .help {
          position: absolute;
          display: block;
          color: #fff;
          font-size: 12px;
          margin-top: -16px;
          opacity: 0.8;
        }
      }
    }
  }
  @media screen and (max-width: 1440px) {
    section {
      &.about-contact {
        .text-block {
          width: 100%;
          padding-right: $padding;
          background: #fff;
        }
        .contact-form {
          width: 100%;
          left: 0;
          position: relative;
        }
      }
    }
  }
  @media screen and (max-width: 960px) {
    section {
      &.about-contact {
        .text-block {
          padding: 5%;
          padding-top: 120px;
          p {
            padding: 5%;
          }
        }
        .portrait {
          right: -300px;
        }
      }
      .left,
      .right {
        width: 100%;
        display: block;
      }
      .left {
        height: auto !important;
        min-height: auto;
      }
      .right {
        margin-bottom: 0;
        .contact-form {
          margin-top: 0;
          padding: 10%;
        }
      }
    }
  }
  @media screen and (max-height: 800px) {
    section {
      .right {
        margin-bottom: 0;
      }
      &.about-contact {
        .contact-form {
          margin-top: 0;
          position: relative;
        }
      }
    }
  }
}
</style>

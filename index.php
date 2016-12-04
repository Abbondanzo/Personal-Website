<?php
function time_elapsed($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

	$time = $diff->y;
	if ($time == 18 || (80 <= $time && $time <= 89)) {
		$output = "an ".$time;
	} else {
		$output = "a ".$time;
	}
	return $output;
}
?>
<!DOCTYPE HTML>
<html lang="en-us">
<!-- Code solely created by Peter V. Abbondanzo. Copyright 2016. All rights reserved. -->
<!-- Fun facts: This is the third version of my personal website. The second grew old so I chose 1:31am as the proper time to start. -->
<!-- At this very moment, I'm in the middle of a predicament. Do I go for Lucky Charms or Cinnamon Toast Crunch? -->
<head>
	<title>Web &amp; Mobile Developer | Peter V. Abbondanzo</title>
	<meta name="description" content="I design websites and mobile applications for people and have a long last name. Come check out the cool projects I've made.">
	<meta name="keywords" content="graphic designer,design,developer,develop,code,css,html,photoshop,peter,abbondanzo,peter abbondanzo,website,photoshop,ui,ui designer,ui developer,graphic,graphics">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="favicon.ico">
	<link rel="stylesheet" href="css/style.css">
	<script src="js/jquery-2.1.4.min.js" type="text/javascript"></script>
	<script src="js/modernizr.min.js" type="text/javascript"></script>
	<script src="js/masonry.min.js" type="text/javascript"></script>
	<script src="js/script.min.js" type="text/javascript"></script>
</head>
<body class="open-in">
	<nav class="resting">
		<div class="container">
			<div class="logo"><a href="#scene"><img height="60" title="Abbondanzo" src="img/logo.png" /></a></div>
			<div class="nav-links">
				<ul>
					<li class="underline">
						<a href="#work">Works</a>
					</li>
					<li class="underline">
						<a href="#">Contact</a>
					</li>
					<li>
						<a href="https://github.com/Abbondanzo"><i class="fa fa-github" aria-hidden="true"></i></a>
					</li>
					<li>
						<a href="https://twitter.com/pabbondanzo"><i class="fa fa-twitter" aria-hidden="true"></i></a>
					</li>
					<li>
						<a href="https://www.linkedin.com/in/pabbondanzo"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
					</li>
					<li class="underline">
						<a class="btn btn-white" href="content/resume.pdf">Résumé</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
    <div class="content" id="scene">
		<div id="particles-js" class="header layer" data-depth="0.2">
			<div class="container">
				<div class="header-content animate fade-in-up layer" data-depth="0.4">
					<h1>Peter V. Abbondanzo</h1>
					<h2>Web &amp; Mobile Developer</h2>
					<a href="#about"><button class="btn btn-large">About Me</button></a>
				</div>
			</div>
		</div>
		<div id="about">
			<div class="container">
				<left class="half-block">
					<img style="margin-bottom:-5px;" src="img/photo.png">
				</left><right class="animated fade-in-up half-block sect-title">
					<h3>About Me</h3>
					<span></span>
					<p>Hi! I’m Peter Abbondanzo, <?php echo time_elapsed('1998-05-21 00:00:00'); ?>-year-old UI/UX designer of web and mobile applications. Currently, I am studying at <a href="http://www.northeastern.edu/" title="Northeastern">Northeastern University</a> up in Boston, Massachusetts. I’ve got a passion for creating, innovating, and coffee. I also run this small company called <a href="http://titusdesign.org/" title="Title Design">Titus&nbsp;Design</a> out of my dorm room. </p>
					<div style="text-align: center;">
						<a href="content/resume.pdf"><button class="btn">Résumé</button></a>&nbsp;&nbsp;&nbsp;<button class="btn btn-invert">Contact</button>
					</div>
				</right>
			</div>
		</div>
		<div id="work" class="info-section">
			<div class="container">
                <div style="padding-bottom:3em;" class="sect-title">
					<h3>Works</h3>
					<span></span>
				</div>
                <div class="grid">
                    <div class="grid-item animated fade-in-up">
                        <img src="img/200x200bvc.png">
                        <div class="grid-info">
                            <h1>Bonne Vie Café</h1>
                        </div>
                    </div>
                    <div class="grid-item animated fade-in-up">
                        <img src="img/200x200rogue.png">
                        <div class="grid-info">
                            <h1>Rogue</h1>
                        </div>
                    </div>
                    <div class="grid-item grid-item--width2 grid-item--height2 animated fade-in-up">
                        <img src="img/400x400feedshare.png">
                        <div class="grid-info">
                            <h1>FeedShare</h1>
                        </div>
                    </div>
                    <div class="grid-item grid-item--width2 animated fade-in-up">
                        <img src="img/400x200flipster.png">
                        <div class="grid-info">
                            <h1>Flipster</h1>
                        </div>
                    </div>
                    <div class="grid-item grid-item--width2 grid-item--height2 animated fade-in-up">
                        <img src="img/400x400myneu.png">
                        <div class="grid-info">
                            <h1>Modern MyNEU</h1>
                        </div>
                    </div>
                    <div class="grid-item grid-item--width2 grid-item--height2 animated fade-in-up">
                        <img src="img/400x400sth.png">
                        <div class="grid-info">
                            <h1>Sthacks</h1>
                        </div>
                    </div>
                </div>
			</div>
		</div>
        <div id="cta">
            <div class="container">
                <h1>Let's get in touch</h1>
                <a class="btn btn-white" href="content/resume.pdf">Contact Me</a>
            </div>
        </div>
        <div id="footer">
            <div class="container">
                <div style="text-align:center;">
                    <a href="#scene"><img height="60" title="Abbondanzo" src="img/logo.png" /></a>
                </div>
                <div class="footer-social">
                    <ul>
                        <li><a href="https://twitter.com/pabbondanzo">Twitter</a></li>
                        <li><a href="https://github.com/Abbondanzo">Github</a></li>
                        <li><a href="https://www.linkedin.com/in/pabbondanzo">LinkedIn</a></li>
                        <li><a href="https://www.behance.net/narwalshf41cf">Behance</a></li>
                    </ul>
                </div>
                <p>Copyright &copy; 2016 abbondanzo.com</p>
            </div>
        </div>
    </div>
</body>
<script src="js/particles.min.js" type="text/javascript"></script>
<script src="js/footer.min.js"></script>
</html>

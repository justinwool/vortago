<?php
/*
Template Name: Landing Page
*/
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Vortago:  Lectures, Interviews, and Appearances</title>

  <!-- Stylesheets -->
  <link rel="stylesheet" href="/v1/css/style.css">
  <link rel="stylesheet" href="/v1/css/owl.carousel.css">
  <link rel="stylesheet" href="/v1/css/jquery-ui.css">

  <!-- Google Font -->
  <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

  <!--[if IE 9]>
    <script src="/v1/js/media.match.min.js"></script>
  <![endif]-->
</head>

<body>

<!-- Start Header -->
<header id="header">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="logo">
          <a href="#"><img src="/v1/img/logo.png" alt="logo" class="img-responsive"></a>
          <span class="phone"><i class="fa fa-phone"></i> +48 432 432 432</span>
        </div>
        <div class="navigation">
          <nav>
            <ul class="custom-list list-inline">
              <li><a href="#hero">Home</a></li>
              <li><a href="#tour">Tour</a></li>
              <li><a href="#about">About Us</a></li>
              <li><a href="#features">Features</a></li>
              <li><a href="#pricing">Pricing</a></li>
              <li><a href="#faq">FAQ</a></li>
              <li><a href="#hero" class="btn btn-red">Search</a></li>
            </ul>
          </nav>
          <i class="fa fa-list toggleMenu"></i>
        </div>
      </div>
    </div>
  </div>
</header>
<!-- End Header -->

<!-- Start Hero -->
<section id="hero">
  <div id="gradient"></div>
  <div class="container">
    <div class="row">
      <div class="hero-text">
        <div class="col-md-10 col-md-offset-1">
          <h3 class="title">Find a person, event, or appearance.</h3>
        </div>
        <div class="col-md-8 col-md-offset-2">
          <p class="lead">
            Enter the name of a celebrity or lecturer, a media program or conference event, a year, or any combination of the above to find a specific appearance.
          </p>
        </div>
      </div>
      <div class="col-md-10 col-md-offset-1">
        <div class="hero-form">
          <form action="order.php" class="default-form" method="post">
            <div class="field">
              <input style=";" type="text" name="searchText" placeholder="Search Text" id="searchText">
              <i class="fa fa-envelope"></i>
            </div>
<!--
            <div class="field">
              <input type="email" name="email" placeholder="Your Email" required>
              <i class="fa fa-envelope"></i>
            </div>
            <div class="field select-box">
              <select name="model" data-placeholder="Choose your type">
                <option>MTB</option>
                <option value="1">City</option>
                <option value="2">Triathlon</option>
                <option value="3">Racing</option>
              </select>
              <i class="fa fa-sort"></i>
            </div>
            <div class="field calendar">
              <input type="text" name="date" placeholder="Date" required>
              <i class="fa fa-calendar"></i>
            </div>
-->
            <div class="field">
              <button class="btn btn-red">Search</button>
            </div>

			<div id="searchExamples" style="">
				<u><b>Examples:</b></u><br>
				<i>Tom Cruise Letterman</i><br>
				<i>Bill Nye 2014</i><br>
				<i>Bill Clinton</i>		<br>
				<i>Bill Murray Late Show</i><br>
				<i>Ted Talks</i>				<br>
			</div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End Hero -->

<style>

#searchExamples  {
	width:100%; color:white; text-align:center; margin-top:10px;
}
#searchText {
	width:450px;
}

#hero .hero-form .default-form .field input {
    width: 450px;
}

@media (max-width: 992px){
	#hero .hero-form .default-form .field input {
		width: 450px;
	}
}

@media (max-width: 768px) {
	#searchExamples  {
		width:100%; color:white; text-align:left; margin-top:10px;
	}
	#hero .hero-form .default-form .field input {
		width: 100%;
	}
}

#clients-slider img {width:180px;}
</style>

<!-- Start Clients -->
<section id="clients">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h4 class="title">Popular Vortago Shows and Events</h4>
        <div id="clients-slider" class="owl-carousel">
          <img src="/v1/img/shows_ted.jpg" alt="" class="img-responsive">
          <img src="/v1/img/shows_conan.jpg" alt="" class="img-responsive">
          <img src="/v1/img/shows_wtf.jpg" alt="" class="img-responsive">
          <img src="/v1/img/shows_maher.jpg" alt="" class="img-responsive">
          <img src="/v1/img/shows_ted.jpg" alt="" class="img-responsive">
          <img src="/v1/img/shows_conan.jpg" alt="" class="img-responsive">
          <img src="/v1/img/shows_wtf.jpg" alt="" class="img-responsive">
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End Clients -->

<!-- Start Tour -->
<section id="tour">

  <div class="part first-part">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="preamble text-left">
            <h3>Thousands of People.</h3>
            <p class="lead">The Vortago database of speaking appearances has thousands of people, and grows exponentially every day.</p>
          </div>
          <p>Vortago provides valuable content for a variety of different types of people, including:</p>
          <ul class="features-list custom-list">
            <li><i class="fa fa-check"></i><span>Scientists</span></li>
            <li><i class="fa fa-check"></i><span>Celebrities</span></li>
            <li><i class="fa fa-check"></i><span>Politicians</span></li>
            <li><i class="fa fa-check"></i><span>Scholars</span></li>
            <li><i class="fa fa-check"></i><span>Musicians</span></li>
            <li><i class="fa fa-check"></i><span>Medical Leaders</span></li>
            <li><i class="fa fa-check"></i><span>Philanthropists</span></li>
            <li><i class="fa fa-check"></i><span>Entrepreneurs</span></li>
            <li><span>... and many more</span></li>
          </ul>
          <a style="margin-top:15px;" href="#" class="btn btn-red">View List of People</a>
        </div>
        <div class="col-md-6">
          <img src="/v1/img/nye.jpg" alt="" class="img-responsive">
        </div>
      </div>
    </div>
  </div>
  <div class="part second-part gray-bg">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <img src="/v1/img/dailyshow.jpg" alt="" class="img-responsive">
        </div>
        <div class="col-md-6">
          <div class="preamble text-left">
            <h3>Hundreds of Events.</h3>
            <p class="lead">The Vortago database maintains detailed appearance information from hundreds of shows and events, including past events and programs that still run today.</p>
          </div>
          <p>The types of programs that Vortago catalogues include:</p>
          <ul class="features-list custom-list">
            <li><i class="fa fa-check"></i><span>Television Shows</span></li>
            <li><i class="fa fa-check"></i><span>Podcasts</span></li>
            <li><i class="fa fa-check"></i><span>Conferences</span></li>
            <li><i class="fa fa-check"></i><span>Debates</span></li>
            <li><i class="fa fa-check"></i><span>Panels</span></li>
            <li><i class="fa fa-check"></i><span>Interviews</span></li>
            <li><i class="fa fa-check"></i><span>Lectures</span></li>
            <li><i class="fa fa-check"></i><span>Commencement Addresses</span></li>
            <li><span>... and many more</span></li>
          </ul>
          <a style="margin-top:15px;" href="#" class="btn btn-red">List of Events</a>
        </div>
      </div>
    </div>
  </div>

  <div class="part first-part">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="preamble text-left">
            <h3>Discover Appearances.</h3>
            <p class="lead">From the most recent back to their very first appearance, find chronologically listed content of your favorite actor, writer, scientist, or celebrity.</p>
          </div>
        </div>
        <div class="col-md-6">
          <img src="/v1/img/nye.jpg" alt="" class="img-responsive">
        </div>
      </div>
    </div>
  </div>


</section>
<!-- End Tour -->

<!-- Start About -->
<section id="about">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2 preamble">
        <h3>Our Team</h3>
        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eum possimus id enim nam reprehenderit iusto a quisquam.</p>
      </div>
      <div class="col-md-4 person">
        <img src="/v1/img/about-1.jpg" alt="" class="img-responsive">
        <h4>Ashley Cruz</h4>
        <p class="position">CEO Working</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates quibusdam ullam tenetur facilis cupiditate iusto laudantium, ex nobis.</p>
      </div>
      <div class="col-md-4 person">
        <img src="/v1/img/about-2.jpg" alt="" class="img-responsive">
        <h4>Phyllis Cox</h4>
        <p class="position">Front End Dev</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates quibusdam ullam tenetur facilis cupiditate iusto laudantium, ex nobis.</p>
      </div>
      <div class="col-md-4 person">
        <img src="/v1/img/about-3.jpg" alt="" class="img-responsive">
        <h4>Aniela Morgan</h4>
        <p class="position">Web Designer</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates quibusdam ullam tenetur facilis cupiditate iusto laudantium, ex nobis.</p>
      </div>
    </div>
  </div>
</section>
<!-- End About -->


<!-- Start Pricing -->
<section id="pricing">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2 preamble">
        <h3>Pricing Table</h3>
        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eum possimus id enim nam reprehenderit iusto a quisquam.</p>
      </div>
      <div class="col-md-4 pricing">
        <div class="pricing-column">
          <div class="pricing-header">
            <h2 class="price">$48</h2>
            <h4 class="type">Classic</h4>
          </div>
          <ul class="pricing-features custom-list">
            <li><span>3 bicycle</span></li>
            <li><span>2 times regulations</span></li>
            <li><span>Free tools</span></li>
            <li><span>Easy to contact</span></li>
            <li><span>Premium Support</span></li>
          </ul>
          <a href="#" class="btn btn-order btn-red">Order</a>
        </div>
      </div>
      <div class="col-md-4 pricing pricing-special">
        <div class="pricing-column">
          <div class="pricing-header">
            <h2 class="price">$99</h2>
            <h4 class="type">Premium</h4>
          </div>
          <ul class="pricing-features custom-list">
            <li><span>11 bicycle</span></li>
            <li><span>5 times regulations</span></li>
            <li><span>Free tools</span></li>
            <li><span>Easy to contact</span></li>
            <li><span>Premium Support</span></li>
          </ul>
          <a href="#" class="btn btn-order btn-blue">Order</a>
        </div>
      </div>
      <div class="col-md-4 pricing">
        <div class="pricing-column">
          <div class="pricing-header">
            <h2 class="price">$78</h2>
            <h4 class="type">Standard</h4>
          </div>
          <ul class="pricing-features custom-list">
            <li><span>6 bicycle</span></li>
            <li><span>4 times regulations</span></li>
            <li><span>Free tools</span></li>
            <li><span>Easy to contact</span></li>
            <li><span>Premium Support</span></li>
          </ul>
          <a href="#" class="btn btn-order btn-red">Order</a>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End Pricing -->

<!-- Start FAQ -->
<section id="faq">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2 preamble">
        <h3>FAQ</h3>
        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eum possimus id enim nam reprehenderit iusto a quisquam.</p>
      </div>
      <div class="col-md-6">
        <div class="question">
          <i class="fa fa-comment"></i><h4 class="title">Is Contact Form working?</h4>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione doloremque quidem deserunt aperiam qui molestias officiis nisi ut aspernatur aliquam eveniet, porro eius iure eligendi laboriosam dolores, nobis sunt consectetur?</p>
        </div>
        <div class="question">
          <i class="fa fa-comment"></i><h4 class="title">Is it wordpress theme?</h4>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione doloremque quidem deserunt aperiam qui molestias officiis nisi ut aspernatur aliquam eveniet, porro eius iure eligendi laboriosam dolores, nobis sunt consectetur?</p>
        </div>
        <div class="question">
          <i class="fa fa-comment"></i><h4 class="title">Can you help me with customization?</h4>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione doloremque quidem deserunt aperiam qui molestias officiis nisi ut aspernatur aliquam eveniet, porro eius iure eligendi laboriosam dolores, nobis sunt consectetur?</p>
        </div>
      </div>
      <div class="col-md-6">
        <div class="question">
          <i class="fa fa-comment"></i><h4 class="title">When wordpress version will be available?</h4>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione doloremque quidem deserunt aperiam qui molestias officiis nisi ut aspernatur aliquam eveniet, porro eius iure eligendi laboriosam dolores, nobis sunt consectetur?</p>
        </div>
        <div class="question">
          <i class="fa fa-comment"></i><h4 class="title">Are you able to hire?</h4>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione doloremque quidem deserunt aperiam qui molestias officiis nisi ut aspernatur aliquam eveniet, porro eius iure eligendi laboriosam dolores, nobis sunt consectetur?</p>
        </div>
        <div class="question">
          <i class="fa fa-comment"></i><h4 class="title">When will be next version?</h4>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione doloremque quidem deserunt aperiam qui molestias officiis nisi ut aspernatur aliquam eveniet, porro eius iure eligendi laboriosam dolores, nobis sunt consectetur?</p>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End FAQ -->

<!-- Start CTA -->
<section id="cta">
  <div class="container">
    <div class="row">
      <div class="hero-text">
        <div class="col-md-10 col-md-offset-1">
          <h3 class="title">Check out the best landing page</h3>
        </div>
        <div class="col-md-8 col-md-offset-2">
          <p class="lead">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur iure eligendi.
          </p>
          <a href="#" class="btn btn-red">Start For Free</a>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End CTA -->

<!-- Start Footer -->
<footer id="footer">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ul class="social list-inline">
          <li><a href="#"><i class="fa fa-facebook"></i></a></li>
          <li><a href="#"><i class="fa fa-twitter"></i></a></li>
          <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
          <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
          <li><a href="#"><i class="fa fa-vimeo"></i></a></li>
        </ul>
        <ul class="navi list-inline">
          <li><a href="#">Home</a></li>
          <li><a href="#">Tour</a></li>
          <li><a href="#">News</a></li>
          <li><a href="#">Blog</a></li>
          <li><a href="#">Privacy</a></li>
          <li><a href="#">Contact</a></li>
          <li><a href="#">Politic</a></li>
        </ul>
        <p>492 Mill Way, Independence, GA, Todd's Lawn Mawers</p>
      </div>
    </div>
  </div>
</footer>
<!-- End Footer -->


<!-- Scripts -->
<script src="/v1/js/jquery-2.1.4.min.js"></script>
<script src="/v1/js/scripts.js"></script>
<script src="/v1/js/owl.carousel.min.js"></script>
<script src="/v1/js/jquery.easing.min.js"></script>
<script src="/v1/js/jquery.ba-outside-events.min.js"></script>
<script src="/v1/js/jquery.ui.min.js"></script>

</body>
</html>

<?php

use app\core\Application;
?>
<!doctype html <!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="zxx"> <!--<![endif]-->

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Advances in Electrical &amp; Electronic Engineering Journal</title>
	<link rel="apple-touch-icon" href="/images/favicon.png">
	<link rel="icon" href="/images/favicon.png" type="image/x-icon">
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" href="/css/normalize.css">
	<link rel="stylesheet" href="/css/fontawesome/fontawesome-all.css">
	<link rel="stylesheet" href="/css/font-awesome.min.css">
	<link rel="stylesheet" href="/css/linearicons.css">
	<link rel="stylesheet" href="/css/themify-icons.css">
	<link rel="stylesheet" href="/css/owl.carousel.css">
	<link rel="stylesheet" href="/css/chartist.css">
	<link rel="stylesheet" href="/css/main.css">
	<link rel="stylesheet" href="/css/color.css">
	<link rel="stylesheet" href="/css/transitions.css">
	<link rel="stylesheet" href="/css/responsive.css">
	<link rel="stylesheet" href="/css/toastr.min.css">
	<script src="/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
</head>

<body class="sj-home">
	<!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
	<!--************************************
				Preloader Start
	*************************************-->
	<div class="preloader-outer">
		<div class='loader'>
			<div class='loader--dot'></div>
			<div class='loader--dot'></div>
			<div class='loader--dot'></div>
			<div class='loader--dot'></div>
		</div>
	</div>
	<!--************************************
				Preloader End
	*************************************-->
	<!--************************************
			Wrapper Start
	*************************************-->
	<div id="sj-wrapper" class="sj-wrapper">
		<!--************************************
				Content Wrapper Start
		*************************************-->
		<div class="sj-contentwrapper">
			<!--************************************
					Header Start
			*************************************-->
			<header id="sj-header" class="sj-header sj-haslayout">
				<div class="container">
					<div class="row">
						<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
							<div class="sj-topbar">
								<div class="sj-languagelogin">
									<?php
									if (Application::isGuest()) {
									?>
										<div class="sj-loginarea">
											<ul class="sj-loging">
												<li><a href="/auth/login">Login</a></li>
												<li><a href="/auth/register">Register</a></li>
											</ul>
										</div>
									<?php
									} else {
									?>
										<script>
											// Store user ID in localStorage when logged in
											localStorage.setItem('userId', <?php echo json_encode(Application::$app->session->get('user')); ?>);
										</script>
										<div class="sj-userloginarea">
											<a href="javascript:void(0);">
												<i class="fa fa-angle-down"></i>
												<div class="sj-loginusername">
													<h3>Hi, <b><?php echo Application::$app->user->getDisplayName() ?></b></h3>
												</div>
											</a>
											<nav class="sj-usernav">
												<ul>
													<li><a href="/auth/logout" onclick="logoutHandler()"><i class="lnr lnr-exit"></i><span>Logout</span></a></li>
												</ul>
											</nav>
										</div>
										<script>
											// Function to handle logout and clear user ID from localStorage
											function logoutHandler() {
												localStorage.removeItem('userId');
											}
										</script>
									<?php } ?>
									<div class="sj-languages">
										<a id="sj-languages-button" href="javascript:void(0);">
											<img src="/images/flags/flag-02.jpg" alt="image description">
											<span>ENG</span>
											<i class="fa fa-angle-down"></i>
										</a>
										<ul id="translateCZEBtn">
											<li>
												<a href="javascript:void(0);">
													<img src="/images/flags/flag-01.jpg" alt="image description">
													<span>CZE</span>
												</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="sj-navigationarea">
								<strong class="sj-logo"><a href="/"><img src="/images/logo.png" alt="logo"></a></strong>
								<div class="sj-rightarea">
									<nav id="sj-nav" class="sj-nav navbar-expand-lg">
										<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
											<i class="lnr lnr-menu"></i>
										</button>
										<div class="collapse navbar-collapse sj-navigation" id="navbarNav">
											<ul>
												<li>
													<a href="/""><i class=" lnr lnr-home"></i></a>
												</li>
												<li class="menu-item-has-children page_item_has_children">
													<a href="javascript:void(0);">About Us</a>
													<ul class="sub-menu">
														<li><a href="/about-us/aims-and-scopes">Aims &amp; Scopes</a></li>
														<li><a href="/about-us/abstracting-and-indexing">Abstracting &amp; Indexing</a></li>
														<li><a href="/about-us/publication-and-frequency">Publication Frequency</a></li>
														<li><a href="/about-us/journal-history">Journal History</a></li>
														<li><a href="/about-us/open-access-policy">APC &amp; Open Access Policy</a></li>
														<li><a href="/about-us/contact">Contact</a></li>
													</ul>
												</li>
												<li>
													<a href="/editors">Editors</a>
												</li>
												<li class="menu-item-has-children page_item_has_children">
													<span class="sj-tagnew">New</span>
													<a href="javascript:void(0);">Issues</a>
													<ul class="sub-menu">
														<li><a href="/issues/current-issues">Current Issue</a></li>
														<li><a href="/issues/archives">Archives</a></li>
													</ul>
												</li>
												<li class="menu-item-has-children page_item_has_children">
													<a href="javascript:void(0);">Publish</a>
													<ul class="sub-menu">
														<li class="menu-item-has-children page_item_has_children">
															<a href="javascript:void(0);">Author Guidelines</a>
															<ul class="sub-menu">
																<li><a href="/publish/author-guidelines/submission">Submission Guideline</a></li>
																<li><a href="/publish/author-guidelines/demonstration-videos">Demonstration Videos</a></li>
															</ul>
														</li>
														<!-- <li class="menu-item-has-children page_item_has_children"> -->
														<!-- <a href="javascript:void(0);">Settings</a> -->
														<!-- <ul class="sub-menu"> -->
														<!-- <li><a href="accountsettings.html">Account Settings</a></li> -->
														<!-- <li><a href="generalsettings.html">General Settings</a></li> -->
														<!-- </ul> -->
														<!-- </li> -->
														<li><a href="/publish/publishing-procedure">Publishing Procedure</a></li>
														<li><a href="/publish/review-process">Peer Review Process</a></li>
														<li><a href="/publish/copyright-and-privacy-statement">Copyright &amp; Privacy Statement</a></li>
														<li class="menu-item-has-children page_item_has_children">
															<a href="javascript:void(0);">For Readers &amp; Librarians</a>
															<ul class="sub-menu">
																<li><a href="/publish/for-readers">For Readers</a></li>
																<li><a href="/publish/for-librarians">For Librarians</a></li>
															</ul>
														</li>
														<!-- <li><a href="404error.html">404 Error</a></li> -->
														<!-- <!-- <li><a href="comingsoon.html">Coming Soon</a></li> -->
													</ul>
												</li>
												<li>
													<a href="/announcements">Announcements</a>
												</li>
											</ul>
										</div>
									</nav>
									<a class="sj-btn sj-btnactive" href="http://www.manuscriptmanager.net/aeee">Submit Your Article</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</header>
			<!--************************************
					Header End
			*************************************-->

			{{content}}

			<!--************************************
					Footer Start
			*************************************-->
			<footer id="sj-footer" class="sj-footer sj-haslayout">
				<div class="container">
					<div class="row">
						<a class="sj-btnscrolltotop" href="javascript:void(0);"><i class="fa fa-angle-up"></i></a>
						<div class="sj-footercolumns">
							<div class="col-12 col-sm-6 col-md-6 col-lg-3 float-left">
								<div class="sj-fcol sj-footeraboutus">
									<strong class="sj-logo">
										<a href="/"><img src="/images/logo.png" alt="image description"></a>
									</strong>
									<div class="sj-description">
										<p style="display: block;">VSB - Technical University of Ostrava and University of Zilina Faculty of Electrical Engineering... <a href="javascript:void(0);">Read More</a></p>
									</div>
									<ul class="sj-socialicons sj-socialiconssimple">
										<li class="sj-facebook"><a href="javascript:void(0);"><i class="fab fa-facebook-f"></i></a></li>
										<li class="sj-twitter"><a href="javascript:void(0);"><i class="fab fa-twitter"></i></a></li>
										<li class="sj-linkedin"><a href="javascript:void(0);"><i class="fab fa-linkedin-in"></i></a></li>
										<li class="sj-googleplus"><a href="javascript:void(0);"><i class="fab fa-google-plus-g"></i></a></li>
										<li class="sj-rss"><a href="javascript:void(0);"><i class="fa fa-rss"></i></a></li>
									</ul>
								</div>
							</div>
							<div class="col-12 col-sm-6 col-md-6 col-lg-3 float-left">
								<div class="sj-fcol sj-widget sj-widgetusefullinks">
									<div class="sj-widgetheading">
										<h3>By Specialty</h3>
									</div>
									<div class="sj-widgetcontent">
										<ul>
											<li><a href="javascript:void(0);">Contact Us</a></li>
											<li><a href="javascript:void(0);">Careers @ AEEE</a></li>
											<li><a href="javascript:void(0);">Get Help and Support</a></li>
											<li><a href="javascript:void(0);">Rights &amp; Permissions</a></li>
											<li class="sj-more"><a href="javascript:void(0);">more</a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-12 col-sm-6 col-md-6 col-lg-3 float-left">
								<div class="sj-fcol sj-widget sj-widgetresources">
									<div class="sj-widgetheading">
										<h3>Resources</h3>
									</div>
									<div class="sj-widgetcontent">
										<ul>
											<li><a href="javascript:void(0);">Authors</a></li>
											<li><a href="javascript:void(0);">Librarians</a></li>
											<li><a href="javascript:void(0);">Sponsors &amp; Advertisers</a></li>
											<li><a href="javascript:void(0);">Press &amp; Media</a></li>
											<li class="sj-more"><a href="javascript:void(0);">more</a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-12 col-sm-6 col-md-6 col-lg-3 float-left">
								<div class="sj-fcol sj-widget sj-widgetcontactus">
									<div class="sj-widgetheading">
										<h3>Get In Touch</h3>
									</div>
									<div class="sj-widgetcontent">
										<ul>
											<li><i class="lnr lnr-home"></i>
												<address>Building FEI, 17.listopadu 2172/15 708 00 Ostrava-Poruba, Czech Republic.</address>
											</li>
											<li><a href="tel:(+420) 597 325 845"><i class="lnr lnr-phone"></i><span>(+420) 597 325 845</span></a></li>
											<li><a href="fax:(+420) 59 732 1650"><i class="lnr lnr-screen"></i><span>(+420) 59 732 1650</span></a></li>
											<li><a href="mailto:advances@vsb.cz"><i class="lnr lnr-envelope"></i><span>advances@vsb.cz</span></a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="sj-footerbottom">
							<p class="sj-copyrights">© 2019 <span>AEEE Journal</span>. All Rights Reserved</p>
						</div>
					</div>
				</div>
			</footer>
			<!--************************************
					Footer End
			*************************************-->
		</div>
		<!-- PDF Modal -->
		<div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
			<div class="modal-dialog mw-100" role="document">
				<div class="modal-content container">
					<div class="modal-header">
						<h5 class="modal-title">View Article</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<iframe style="min-width: 100%;" loading="lazy" width="100%" height="550px"></iframe>
					</div>
				</div>
			</div>
		</div>

		<!--************************************
				Content Wrapper End
		*************************************-->
	</div>
	<!--************************************
			Wrapper End
	*************************************-->

	<script src="/js/vendor/jquery-3.3.1.js"></script>
	<script src="/js/vendor/jquery-library.js"></script>
	<script src="/js/vendor/bootstrap.min.js"></script>
	<script src="/js/vendor/bootstrap-datepicker.min.js"></script>
	<script src="/js/owl.carousel.min.js"></script>
	<script src="/js/circle-progress.js"></script>
	<script src="/js/scrollbar.min.js"></script>
	<script src="/js/chartist.min.js"></script>
	<script src="/js/countdown.js"></script>
	<script src="/js/appear.js"></script>
	<script src="/js/toastr.min.js"></script>
	<script src="/js/main.js"></script>
</body>

</html>
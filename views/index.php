<?php
use app\controllers\ArticleController;
use app\core\Application;

$articleController = new ArticleController();

$flashMessage = Application::$app->session->getFlash('success');

// Flash message
if ($flashMessage) {
?>
  <script>
    // Show Toastr notification when the page loads
    document.addEventListener('DOMContentLoaded', function() {
			toastr.success('<?php echo $flashMessage; ?>');
    });
  </script>
<?php
}
?>
<!--************************************
					Home Banner Start
			*************************************-->
<div id="sj-homebanner" class="sj-homebanner">
	<div class="container">
		<div class="row">
			<div class="col-12 col-sm-12 col-md-6 col-lg-6">
				<div class="sj-postbook">
					<figure class="sj-featureimg">
						<a class="sj-btnvideo" href="javascript:void(0);"><i class="lnr lnr-film-play"></i><span>Watch Video Documentary</span></a>
						<div class="sj-bookimg">
							<div class="sj-frontcover"><img src="/images/slider/fronimg.png" alt="image description"></div>
						</div>
					</figure>
				</div>
			</div>
			<div class="col-12 col-sm-12 col-md-6 col-lg-6">
				<div class="sj-bannercontent">
					<h1><span>We Welcome Latest</span>Research Articles in<span>Electrical and</span><span>Electronic Engineering</span></h1>
					<div class="sj-description">
						<p style="display: block;">The Advances in Electrical and Electronic Engineering is a peer-reviewed periodical scientific journal aimed at publishing research results of the Journal focus areas. The role of the Journal is to facilitate contacts between research centers and the industry.... <a href="javascript:void(0);">Read more</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--************************************
					Home Banner End
			*************************************-->
<!--************************************
					Main Start
			*************************************-->
<main id="sj-main" class="sj-main sj-haslayout sj-sectionspace">
	<div class="sj-haslayout">
		<div class="container">
			<div class="row">
				<div class="sj-welcomegreeting">
					<div class="col-12 col-sm-12 col-md-5 col-lg-5 sj-verticalmiddle">
						<div id="sj-welcomeimgslider" class="sj-welcomeimgslider sj-welcomeslider owl-carousel">
							<figure class="sj-welcomeimg item">
								<img src="/images/welcomeimg/img-01.jpg" alt="welcome Image">
							</figure>
							<figure class="sj-welcomeimg item">
								<img src="/images/welcomeimg/img-02.jpg" alt="welcome Image">
							</figure>
							<figure class="sj-welcomeimg item">
								<img src="/images/welcomeimg/img-03.jpg" alt="welcome Image">
							</figure>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-7 col-lg-7 sj-verticalmiddle">
						<div class="sj-welcomecontent">
							<div class="sj-welcomehead">
								<span>Greetings &amp; Welcome</span>
								<h2>Explore Latest Researches</h2>
							</div>
							<div class="sj-description">
								<p>Foreword about Thang Trung Nguyen, Ph.D of the Department of Electrical Engineering, Faculty of Electrical and Electronics Engineering, Ton Duc Thang University, Vietnam</p>
							</div>
							<div class="sj-btnarea">
								<a class="sj-btn sj-btnactive" href="/issues/current-issues">Read More</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="sj-twocolumns" class="sj-twocolumns">
		<div class="container">
			<div class="row">
				<div class="col-12 col-sm-12 col-md-8 col-lg-9">
					<div id="sj-content" class="sj-content">
						<!--************************************
										Editor's Pick Start
								*************************************-->
						<section class="sj-haslayout sj-sectioninnerspace">
							<div class="sj-borderheading">
								<h3>Most Views</h3>
								<a class="sj-btnview" href="javascript:void(0);">View All</a>
							</div>
							<div id="sj-editorchoiceslider" class="sj-editorchoiceslider sj-editorschoice owl-carousel">
								<?php
								echo '<div class="item">';
								foreach ($articleController->sortArticles('views', 0, 10, 0) as $index => $article) {
									if (!$article->restrictTo || in_array(Application::$app->session->get('user'), $article->restrictTo)) {		
								?>
									<article class="sj-post sj-editorchoice">
										<figure class="sj-postimg">
											<img src="/images/editorchoice/img-01.jpg" alt="image" />
										</figure>
										<div class="sj-postcontent">
											<div class="sj-head">
												<span class="sj-username">
													<a href="javascript:void(0);">
														<?php echo $article->author ?>
													</a>
												</span>
												<h3>
													<a class="viewArticleBtn" data-id="<?php echo $article->id ?>" href="javascript:void(0);" data-toggle="modal" data-target="#pdfModal" data-path="<?php echo $article->path ?>"><?php echo ucfirst($article->title) ?></a>
												</h3>
												<span>Views: <?php echo $article->views ?></span>
											</div>
											<a class="sj-btn viewArticleBtn" href="javascript:void(0);" data-id="<?php echo $article->id ?>" data-toggle="modal" data-target="#pdfModal" data-path="<?php echo $article->path ?>">View Full Article</a>
										</div>
									</article>																	
									<?php 
									}
									if (($index + 1) % 4 == 0) {
										echo "</div>";
										echo '<div class="item">';
									}
									?>
								<?php
								}
								echo "</div>";
								?>
							</div>
						</section>
						<!--************************************
										Editor's Pick End
								*************************************-->
						<!--************************************
										Previous Posts Start
								*************************************-->
						<section class="sj-haslayout sj-sectioninnerspace">
							<div class="sj-borderheading">
								<h3>Previous Issues</h3>
								<a class="sj-btnview" href="javascript:void(0);">View All</a>
							</div>
							<div class="sj-previousissues">
								<ul class="sj-navtabs nav" id="myTab" role="tablist" style="height: 170px; overflow-y: scroll;">
									<?php
									for ($i = 2022; $i >= 2002; $i--) {
									?>
										<li class="nav-item">
											<a class="nav-link" id="home-tab" data-toggle="tab" href="#<?php echo $i ?>" role="tab" aria-controls="<?php echo $i ?>" aria-selected="true">
												Issues From: <span><?php echo $i ?></span>
											</a>
										</li>
									<?php
									}
									?>
								</ul>
								<div class="sj-tabcontent tab-content" id="myTabContent">
									<?php
									for ($year = 2022; $year >= 2002; $year--) {
										// Get articles for the year
										$articlesByYear = $articleController->getArticlesByYear($year);
									?>
										<div class="tab-pane fade <?php if ($year == 2022) echo "show active" ?>" id="<?php echo $year ?>" role="tabpanel">
											<div id="sj-issuesslider-<?php echo $year ?>" class="sj-issuesslider-<?php echo $year ?> sj-issuesslider owl-carousel">
												<?php
												if (count($articlesByYear) !== 0) {
													echo '<div class="item">';
													foreach ($articlesByYear as $index => $article) {
												?>
														<article class="sj-post sj-editorchoice sj-smallpost">
															<figure class="sj-postimg">
																<img src="/images/editorchoice/img-04.jpg" alt="image description" />
															</figure>
															<div class="sj-postcontent">
																<div class="sj-head">
																	<span class="sj-username">
																		<a class="viewArticleBtn" data-id="<?php echo $article->id ?>" href="javascript:void(0);" data-toggle="modal" data-target="#pdfModal" data-path="<?php echo $article->path ?>"><?php echo $article->author ?></a>
																	</span>
																	<h3>
																		<a class="viewArticleBtn" data-id="<?php echo $article->id ?>" href="javascript:void(0);" data-toggle="modal" data-target="#pdfModal" data-path="<?php echo $article->path ?>"><?php echo $article->title ?></a>
																	</h3>
																</div>
															</div>
														</article>
												<?php
														if (($index + 1) % 4 == 0) {
															echo "</div>";
															echo '<div class="item">';
														}
													}
													echo "</div>";
												} else {
													echo "No articles found";
												}
												?>
											</div>
										</div>
									<?php
									}
									?>
								</div>
							</div>
						</section>
						<!--************************************
										Previous Posts End
								*************************************-->
						<!--************************************
										Up Coming Books Start
								*************************************-->
						<section class="sj-haslayout sj-sectioninnerspace">
							<div class="sj-borderheading">
								<h3>Coming In 2023</h3>
								<a class="sj-btnview" href="javascript:void(0);">View All</a>
							</div>
							<div id="sj-upcomingbooksslider" class="sj-upcomingbooksslider sj-upcomingbooks owl-carousel">
								<?php
								foreach ($articleController->getArticlesByYear(date("Y")) as $index => $article) {
								?>
									<div class="item">
										<div class="sj-upcomingbook">
											<figure class="sj-upcomingbookimg">
												<img src="/images/comingbooks/img-01.jpg" alt="image description">
											</figure>
											<div class="sj-postcontent">
												<h3><a class="viewArticleBtn" data-id="<?php echo $article->id ?>" href="javascript:void(0);" data-toggle="modal" data-target="#pdfModal" data-path="<?php echo $article->path ?>"><?php echo $article->title ?></a></h3>
											</div>
										</div>
									</div>
								<?php
								}
								?>
							</div>
						</section>
						<!--************************************
										Up Coming Books End
								*************************************-->
						<!--************************************
										News Articles Start
								*************************************-->
						<section class="sj-haslayout sj-sectioninnerspace">
							<div class="sj-borderheading">
								<h3>What's Hot In News</h3>
								<a class="sj-btnview" href="javascript:void(0);">View All</a>
							</div>
							<div class="sj-newsposts">
								<div id="sj-newsarticlesslider" class="sj-newsarticlesslider sj-newsarticles owl-carousel">
									<?php
									foreach ($articleController->getCurrentIssues() as $index => $article) {
									?>
										<div class="item">
											<div class="sj-newsarticle">
												<figure class="sj-newsimg">
													<img src="/images/news/img-01.jpg" alt="image description">
												</figure>
												<div class="sj-newscontent">
													<div class="sj-newshead">
														<time class="sj-posttimedate"><?php echo $articleController->formatDate($article->pubDate); ?></time>
														<h3><a class="viewArticleBtn" data-id="<?php echo $article->id ?>" href="javascript:void(0);" data-toggle="modal" data-target="#pdfModal" data-path="<?php echo $article->path ?>"><?php echo $article->title ?></a></h3>
													</div>
												</div>
											</div>
										</div>
									<?php
									}
									?>
								</div>
							</div>
						</section>
						<!--************************************
										News Articles End
								*************************************-->
					</div>
				</div>
				<div class="col-12 col-sm-12 col-md-4 col-lg-3">
					<aside id="sj-sidebar" class="sj-sidebar">						
						<div class="sj-widget sj-widgetnoticeboard">
							<div class="sj-widgetheading">
								<h3>VSB-TUO</h3>
							</div>
							<div class="sj-widgetcontent">
								<ul>
									<li><a href="https://www.vsb.cz/en/university/">University</a></li>
									<li><a href="https://www.vsb.cz/en/partnership/">Partnership</a></li>
									<li><a href="https://www.vsb.cz/en/media/">Media and University</a></li>
									<li><a href="https://alumni.vsb.cz/en/">Alumni Network</a></li>
									<li><a href="https://www.vsb.cz/en/study/">Study at VSB - Technical University of Ostrava</a></li>
								</ul>
							</div>
						</div>
						<div class="sj-widget sj-widgetadd">
							<div class="sj-widgetcontent">
								<figure class="sj-addimage"><a href="javascript:void(0);"><img src="/images/vsb-tuo-logo.png" alt="image description"></a></figure>
							</div>
						</div>						
					</aside>
				</div>
			</div>
		</div>
	</div>
</main>
<!--************************************
					Main End
			*************************************-->
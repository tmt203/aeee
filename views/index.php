<?php
use app\controllers\ArticleController;
$articleController = new ArticleController();
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
						<p>The Advances in Electrical and Electronic Engineering is a peer-reviewed periodical scientific journal aimed at publishing research results of the Journal focus areas. The role of the Journal is to facilitate contacts between research centers and the industry.... <a href="javascript:void(0);">Read more</a></p>
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
								<p>Foreword about Jan Latal, Lecturer and Professor’s assistant at the Department of Telecommunications, Faculty of Electrical Engineering and Computer Science, VSB–Technical University of Ostrava, Czech Republic and former Editor-in-Chief of Advances in Electrical and Electronic Engineering journal:</p>
							</div>
							<div class="sj-btnarea">
								<a class="sj-btn sj-btnactive" href="javascript:void(0);">Read More</a>
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
								<h3>Editor’s Pick</h3>
								<a class="sj-btnview" href="javascript:void(0);">View All</a>
							</div>
							<div id="sj-editorchoiceslider" class="sj-editorchoiceslider sj-editorschoice owl-carousel">
								<?php
								echo '<div class="item">';
								foreach ($articleController->getAllArticles() as $index => $article) {
								?>
									<article class="sj-post sj-editorchoice">
										<figure class="sj-postimg">
											<img src="/images/editorchoice/img-01.jpg" alt="image" />
										</figure>
										<div class="sj-postcontent">
											<div class="sj-head">
												<span class="sj-username">
													<a target="_blank" href="<?php echo $article->path ?>">
														<?php echo $article->author ?>
													</a>
												</span>
												<h3>
													<a target="_blank" href="<?php echo $article->path ?>"><?php echo ucfirst($article->title) ?></a>
												</h3>
											</div>
											<a class="sj-btn" target="_blank" href="<?php echo $article->path ?>">View Full Article</a>
										</div>
									</article>
									<?php
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
									for ($i = 2023; $i >= 2002; $i--) {
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
									for ($year = 2023; $year >= 2002; $year--) {
										// Get articles for the year
										$articlesByYear = $articleController->getArticlesByYear($year);
									?>
										<div class="tab-pane fade <?php if ($year == 2023) echo "show active" ?>" id="<?php echo $year ?>" role="tabpanel">
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
																	<span class="sj-username"><a href="javascript:void(0);"><?php echo $article->author ?></a></span>
																	<h3>
																		<a href="<?php echo $article->path ?>"><?php echo $article->title ?></a>
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
								foreach ($articleController->getArticlesByYear(2023) as $index => $article) {
								?>
									<div class="item">
										<div class="sj-upcomingbook">
											<figure class="sj-upcomingbookimg">
												<img src="/images/comingbooks/img-01.jpg" alt="image description">
											</figure>
											<div class="sj-postcontent">
												<h3><a target="_blank" href="<?php echo $article->path ?>"><?php echo $article->title ?></a></h3>
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
									foreach ($articleController->getAllArticles() as $index => $article) {
									?>
										<div class="item">
											<div class="sj-newsarticle">
												<figure class="sj-newsimg">
													<img src="/images/news/img-01.jpg" alt="image description">
												</figure>
												<div class="sj-newscontent">
													<div class="sj-newshead">
														<time datetime="2018-12-12" class="sj-posttimedate"><?php echo $articleController->formatDate($article->pubDate); ?></time>
														<h3><a href="<?php echo $article->path ?>"><?php echo $article->title ?></a></h3>
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
						<div class="sj-widget sj-widgetsearch">
							<div class="sj-widgetcontent">
								<form id="indexSearchForm" class="sj-formtheme sj-formsearch">
									<fieldset>
										<input type="search" name="search" class="form-control" placeholder="Search here">
										<button type="submit" class="sj-btnsearch"><i class="lnr lnr-magnifier"></i></button>
									</fieldset>
								</form>
							</div>
						</div>
						<div class="sj-widget sj-widgetimpactfector">
							<div class="sj-widgetcontent">
								<ul>
									<li>
										<h3>Impact Factor<span>0.8</span></h3>
										<h3>5 Year Impact Factor<span>0.8</span></h3>
									</li>
									<li>
										<h3>Dr. Tan N. Nguyen</h3>
										<div class="sj-description">
											<p>Ton Duc Thang Univeristy, Editor-in-Chief <a href="javascript:void(0)">Read More</a></p>
										</div>
									</li>
								</ul>
							</div>
						</div>
						<div class="sj-widget sj-widgetnoticeboard">
							<div class="sj-widgetheading">
								<h3>Notice Board</h3>
							</div>
							<div class="sj-widgetcontent">
								<ul>
									<li><a href="javascript:void(0);">Adipisicing elitaium sed dotas eiusm tempor incididunt utae labore etiate dolore magna aliqua enim.</a></li>
									<li><a href="javascript:void(0);">Labore etiat dolore magna aliquaen ad minim veniam.</a></li>
									<li><a href="javascript:void(0);">Duis aute irure dolor in reprehender</a></li>
								</ul>
							</div>
						</div>
						<div class="sj-widget sj-widgetadd">
							<span class="sj-headtitle">Advertisment 270 x270</span>
							<div class="sj-widgetcontent">
								<figure class="sj-addimage"><a href="javascript:void(0);"><img src="/images/widget-add.jpg" alt="image description"></a></figure>
							</div>
						</div>
						<div class="sj-widget sj-widgetquestions">
							<div class="sj-widgetheading">
								<h3>Question Of The Week</h3>
							</div>
							<div class="sj-widgetcontent">
								<div class="sj-description">
									<p>Consectetur adipisicing elit, sed aeiuse tempor incididunt ut labore etamiudon magna aliqua enim ad minim?</p>
								</div>
								<div class="sj-questions">
									<div class="sj-selectgroup">
										<span class="sj-radio">
											<input id="sj-qone" type="radio" name="question" value="qone" checked="">
											<label for="sj-qone">Sputum stain for acid-fast bacilli</label>
										</span>
										<span class="sj-radio">
											<input id="sj-qtwo" type="radio" name="question" value="qtwo">
											<label for="sj-qtwo">Pleural biopsy</label>
										</span>
										<span class="sj-radio">
											<input id="sj-qthree" type="radio" name="question" value="qthree">
											<label for="sj-qthree">Pleural fluid amylase</label>
										</span>
										<span class="sj-radio">
											<input id="sj-qfour" type="radio" name="question" value="qfour">
											<label for="sj-qfour">Pleural fluid cytology</label>
										</span>
									</div>
									<a class="sj-btn" href="javascript:void(0);">Submit Now</a>
								</div>
							</div>
						</div>
						<div class="sj-widget sj-widgetadd">
							<div class="sj-widgetcontent">
								<figure class="sj-addimage"><a href="javascript:void(0);"><img src="/images/widget-add2.jpg" alt="image description"></a></figure>
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
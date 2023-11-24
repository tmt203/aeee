<?php
use app\controllers\ArticleController;
$articleController = new ArticleController();
?>

<!--************************************
					Inner Banner Start
			*************************************-->
<div class="sj-innerbanner">
	<div class="container">
		<div class="row">
			<div class="col-12 col-sm-12 col-md-12 col-lg-12">
				<div class="sj-innerbannercontent">
					<h1>Issue Index</h1>
					<ol class="sj-breadcrumb">
						<li><a href="javascript:void(0);">Home</a></li>
						<li><a href="javascript:void(0);">Issues</a></li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</div>
<!--************************************
					Inner Banner End
			*************************************-->
<!--************************************
					Main Start
			*************************************-->
<main id="sj-main" class="sj-main sj-haslayout sj-sectionspace">
	<div id="sj-twocolumns" class="sj-twocolumns">
		<div class="container">
			<div class="row">
				<div class="col-12 col-sm-12 col-md-5 col-lg-4 col-xl-3">
					<aside id="sj-sidebarvtwo" class="sj-sidebar">
						<div class="sj-widget sj-widgetvolissue">
							<div class="sj-widgetheading">
								<h3>By Volume and Issue</h3>
							</div>
							<div class="sj-widgetcontent">
								<form class="sj-formtheme sj-formissuevol">
									<fieldset>
										<div class="form-group">
											<input type="text" name="volume" class="form-control" placeholder="Vol no.">
										</div>
										<div class="form-group">
											<input type="text" name="issue" class="form-control" placeholder="Issue no.">
										</div>
									</fieldset>
								</form>
							</div>
						</div>
						<div class="sj-widget sj-widgetsearchdate">
							<div class="sj-widgetheading">
								<h3>By Date</h3>
							</div>
							<div class="sj-widgetcontent">
								<form class="sj-formtheme sj-formsearchbydate">
									<fieldset>
										<div class="form-group sj-inputwithicon">
											<i class="fab fa-calendar"></i>
											<input class="form-control" name="date" data-date-format="yyyy-mm-dd" id="datepicker" placeholder="YYYY - MM - DD">
											<!-- <input type="text" name="date" class="form-control" placeholder="YYYY - MM - DD"> -->
										</div>
										<div class="sj-filterbtns">
											<a id="applyFilterBtn" class="sj-btn" href="javascript:void(0)">Apply Filter</a>
											<a id="resetAllBtn" class="sj-btn" href="javascript:void(0)">Reset All</a>
										</div>
									</fieldset>
								</form>
							</div>
						</div>
						<div class="sj-widget sj-widgetrecentissues">
							<div class="sj-widgetheading">
								<h3>Recent Issues</h3>
							</div>
							<div class="sj-widgetcontent">
								<ul>
									<li><a href="javascript:void(0);"><span>View All</span><em>(216)</em></a></li>
									<li><a href="javascript:void(0);"><span>Current Issue</span><em>(37)</em></a></li>
									<li><a href="javascript:void(0);"><span>December 28, 2017</span><em>(27)</em></a></li>
									<li><a href="javascript:void(0);"><span>December 21, 2017</span><em>(23)</em></a></li>
									<li><a href="javascript:void(0);"><span>December 14, 2017</span><em>(22)</em></a></li>
								</ul>
							</div>
						</div>
					</aside>
				</div>
				<div class="col-12 col-sm-12 col-md-7 col-lg-4 col-xl-6">
					<div id="sj-content" class="sj-content">
						<div class="sj-uploadarticle">
							<figure class="sj-uploadarticleimg">
								<img src="/images/upload-articlebg.jpg" alt="image description">
								<figcaption>
									<div class="sj-uploadcontent">
										<span>Do You Want To Upload Your Article?</span>
										<h3>Submit Now &amp; Make Your Online Presence</h3>
										<a class="sj-btn" href="javascript:void(0);">Submit Now</a>
									</div>
								</figcaption>
							</figure>
						</div>
						<div class="sj-issuesyears">
							<div id="sj-accordion" class="sj-accordion" role="tablist" aria-multiselectable="true">
								<?php								
								foreach ($articleController->getRandomArticles() as $index => $article) {
								?>
									<article class="sj-post sj-editorchoice">
										<figure class="sj-postimg">
											<img src="/images/editorchoice/img-08.jpg" alt="image description">
										</figure>
										<div class="sj-postcontent">
											<div class="sj-head">
												<span class="sj-username"><a href="javascript:void(0);"><?php echo $article->author ?></a></span>
												<h3><a target="_blank" href="<?php echo $article->path ?>"><?php echo $article->title ?></a></h3>
											</div>
											<div class="sj-description">
												<p>DOI: <?php echo $article->doi ?>. pp. <?php echo $article->firstPage ?>-<?php echo $article->lastPage ?></p>
											</div>
											<a class="sj-btn" href="<?php echo $article->path ?>">View Full Article</a>
											<!-- <a class="action" target="_parent" href="http://advances.utc.sk/index.php/AEEE/article/download/4471/488488741"><img title="pdf_icon_35" src="http://advances.uniza.sk/public/site/images/lat04/pdf_icon_35.png" alt="flash_logo_35" width="25" height="25" /></a> -->
										</div>
									</article>
								<?php
								}
								?>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-sm-12 col-md-5 col-lg-4 col-xl-3">
					<aside id="sj-sidebar" class="sj-sidebar sj-sidebarvtwo">
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
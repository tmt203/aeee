<?php
use app\core\Application;
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
					<h1>Extract Metadata</h1>
					<ol class="sj-breadcrumb">
						<li><a href="javascript:void(0);">Home</a></li>
						<li><a href="javascript:void(0);">Extract metadata</a></li>
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
								<h3>Enter Volume and Issue</h3>
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
						<div class="sj-filterbtns">
							<a id="applyFilterBtn" class="sj-btn" href="javascript:void(0)">Apply Filter</a>
							<a id="extractMetadataBtn" class="sj-btn" href="javascript:void(0)">Extract</a>
						</div>
					</aside>
				</div>
				<div class="col-12 col-sm-12 col-md-7 col-lg-4 col-xl-6">
					<div id="sj-content" class="sj-content">
						<div class="sj-uploadarticle volume-info">
							Volume: 21, Number: 3
						</div>
						<div class="sj-issuesyears">
							<div id="sj-accordion" class="sj-accordion" role="tablist" aria-multiselectable="true">
								<?php
								foreach ($articleController->getCurrentIssues() as $index => $article) {
									if (!$article->restrictTo || in_array(Application::$app->session->get('user'), $article->restrictTo)) {
								?>
										<article class="sj-post sj-editorchoice">
											<!-- <figure class="sj-postimg">
												<img src="/images/editorchoice/img-08.jpg" alt="image description">
											</figure> -->
											<div class="sj-postcontent">
												<div class="sj-head">
													<span class="sj-username"><a href="javascript:void(0);"><?php echo $article->author ?></a></span>
													<h3><a href="javascript:void(0);" data-toggle="modal" data-target="#pdfModal" data-path="<?php echo $article->path ?>"><?php echo $article->title ?></a></h3>
												</div>
												<div class="sj-description">
													<p>DOI: <?php echo $article->doi ?>. pp. <?php echo $article->firstPage ?>-<?php echo $article->lastPage ?></p>
												</div>
												<a class="sj-btn" href="javascript:void(0);" data-toggle="modal" data-target="#pdfModal" data-path="<?php echo $article->path ?>">View Full Article</a>
											</div>
										</article>
								<?php
									}
								}
								?>
							</div>
						</div>
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
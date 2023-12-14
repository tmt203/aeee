<?php
use app\controllers\ArticleController;
use app\core\Application;

$articleController = new ArticleController();
?>
<!--************************************
					Main Start
			*************************************-->
<main id="sj-main" class="sj-main sj-haslayout sj-sectionspace">
	<div id="sj-twocolumns" class="sj-twocolumns">
		<div class="container">
			<div class="row">
				<div class="col-12 col-sm-12 col-md-5 col-lg-4 col-xl-3">
					<aside id="sj-sidebarvtwo" class="sj-sidebar">
						<div class="sj-widget sj-widgetsearch">
							<div class="sj-widgetcontent">
								<form id="searchForm" class="sj-formtheme sj-formsearch">
									<fieldset>
										<input type="search" name="content" class="form-control" placeholder="Search here">
										<button type="submit" class="sj-btnsearch"><i class="lnr lnr-magnifier"></i></button>
										<div class="d-flex align-items-center mt-2">
											<label class="my-0" for="searchBy">Search by:</label>
											<select name="searchBy" class="mx-2" id="searchBy">
												<option value="ArticleTitle">Title</option>
												<option value="Abstract">Abstract</option>
												<option value="DOI">DOI</option>
												<option value="AuthorName">Author's Name</option>
											</select>
										</div>
									</fieldset>
								</form>
							</div>
						</div>						
						<div class="sj-widget sj-widgetdate">
							<div class="sj-widgetheading">
								<h3>By Years</h3>
							</div>
							<div class="sj-widgetcontent">
								<div class="sj-selectgroup">									
									<span class="d-flex align-items-center my-2">
										<input id="sj-tenyear" type="radio" name="pastYear" value="5">
										<label class="my-0 mx-3" for="sj-tenyear">Past 5 Years</label>
									</span>
									<span class="d-flex align-items-center">
										<input id="sj-fifteenyears" type="radio" name="pastYear" value="10">
										<label class="my-0 mx-3" for="sj-fifteenyears">Past 10 Years</label>
									</span>
								</div>
								<div class="sj-filterbtns">
									<a id="filterCurrentArticlesBtn" class="sj-btn" href="javascript:void(0)">Apply Filter</a>
								</div>
							</div>
						</div>
					</aside>
				</div>
				<div class="col-12 col-sm-12 col-md-7 col-lg-4 col-xl-6">
					<div id="sj-content" class="sj-content">
						<div class="sj-description">
							<span class="d-flex align-items-center">
								<img class="mr-2" src="/images/h3_arrow.png" alt="icon">
								<p style="display: block; margin: 0"><strong>Vol 21, No 3 (2023): September</strong></p><br />
							</span>
							<img src="/images/current-issue-publisher/thang1.jpg" alt="" width="160" height="150" />
							<p style="display: block; margin: 0"><strong>Foreword about Thang Trung Nguyen, Ph.D of the Department of Electrical Engineering, Faculty of Electrical and Electronics Engineering, Ton Duc Thang University, Vietnam:</strong></p><br />
							<p style="display: block; margin: 0">" In the optimization field, this is one of the biggest concerns among different aspects of human life, including economics, engineering, etc., and power systems are no exception. For example, the optimal operation of thermal power plants will result in a variety of benefits, such as reducing the initial cost of acquiring different types of fossil fuels, mitigating the environmental damage caused by the burning process to produce electricity, and improving the maintenance cost due to the optimal allocation of electricity yield for generating units following their designed capacity. Next, optimizing the placement of wind and solar energy sources in both transmission and distribution power networks will also benefit both economic and engineering aspects. However, it could be more smart if these clean energy sources are used and integrated arbitrarily into power systems, regardless of the scale. Hence, all the research papers on using clean energy sources are appreciated and considered valuable references against the global warming phenomenon, which is profoundly concerning today. If you are interested, do not hesitate to contact me."</p>
							<p><a href="http://advances.utc.sk/index.php/AEEE/manager/files/Ok-ThangTrungNguyenPhDsummarizeddescription.pdf">More...</a></p>
							<h3>Table of Contents</h3>
						</div>						
						<div class="sj-articles">
							<!-- <form id="sortArticleForm" class="sj-formtheme sj-formsortitems">
								<fieldset>
									<div class="form-group">
										<em>Sort By: </em>
										<span class="sj-select">
											<select name="sortBy">
												<option value="ArticleTitle">Article Title</option>
											</select>
										</span>
									</div>
									<div class="form-group">
										<em>Arrange: </em>
										<span class="sj-select">
											<select name="arrange">
												<option value="1">Asc</option>
												<option value="0">Desc</option>
											</select>
										</span>
									</div>
									<div class="form-group">
										<em>Show: </em>
										<span class="sj-select">
											<select name="show">
												<option value="10">10</option>
												<option value="20">20</option>
											</select>
										</span>
									</div>
									<button id="applyBtn" class="sj-btn mt-3 border-0" style="outline: none;" type="submit">Apply</button>
								</fieldset>
							</form> -->
							<div id="sortedArticles">
								<?php
								foreach ($articleController->getCurrentIssues() as $index => $article) {
									if (!$article->restrictTo || in_array(Application::$app->session->get('user'), $article->restrictTo)) {
								?>
									<article class="sj-post sj-editorchoice">
										<figure class="sj-postimg">
											<img src="/images/editorchoice/img-08.jpg" alt="image description">
										</figure>
										<div class="sj-postcontent">
											<div class="sj-head">
												<span class="sj-username"><a href="javascript:void(0);"><?php echo $article->author ?></a></span>
												<h3><a class="viewArticleBtn" data-id="<?php echo $article->id ?>" href="javascript:void(0);" data-toggle="modal" data-target="#pdfModal" data-path="<?php echo $article->path ?>"><?php echo $article->title ?></a></h3>
											</div>
											<div class="sj-description">
												<p>DOI: <?php echo $article->doi ?>. pp. <?php echo $article->firstPage ?>-<?php echo $article->lastPage ?></p>
											</div>
											<a class="sj-btn viewArticleBtn" data-id="<?php echo $article->id ?>" href="javascript:void(0);" data-toggle="modal" data-target="#pdfModal" data-path="<?php echo $article->path ?>">View Full Article</a>
											<!-- <a class="action" target="_parent" href="http://advances.utc.sk/index.php/AEEE/article/download/4471/488488741"><img title="pdf_icon_35" src="http://advances.uniza.sk/public/site/images/lat04/pdf_icon_35.png" alt="flash_logo_35" width="25" height="25" /></a> -->
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
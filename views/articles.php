<?php

use app\controllers\ArticleController;

$articleController = new ArticleController();
// function sortArticles($articles, $sortBy = 'ArticleTitle', $asc = 1, $limit = 10)
// {
// 	usort($articles, function ($a, $b) use ($sortBy, $asc) {
// 		if ($asc == 0) {
// 			return strcmp($b[$sortBy], $a[$sortBy]);
// 		}
// 		return strcmp($a[$sortBy], $b[$sortBy]);
// 	});

// 	return array_slice($articles, 0, $limit);
// }
// function printArticles($article, $limit) {
// 	for ($i = 0; $i < $limit; $i++) {
// 		echo $article[$i]['ArticleTitle'] . '<br>';
// 	}
// }

// function getAuthors($authors)
// {
// 	// Check if the first element is an array or an object
// 	$firstElement = reset($authors);
// 	$isAssociativeArray = is_array($firstElement) && array_keys($firstElement) !== range(0, count($firstElement) - 1);

// 	if ($isAssociativeArray) {
// 		// Handle associative arrays (objects)
// 		return implode(", ", array_map(function ($author) {
// 			return $author['FirstName'] . " " . $author['LastName'];
// 		}, $authors));
// 	} else {
// 		return $authors['FirstName'] . " " . $authors['LastName'];
// 	}
// }

// function getFilePath($root, $year, $volume, $issue, $title)
// {
// 	$title = str_replace(':', '', $title);
// 	$title = strtolower($title);
// 	$path = realpath($root . '/public/data/articles/' . $year . '/Vol ' . $volume . ', No ' . $issue);

// 	if (file_exists($path)) {
// 		foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path)) as $filename) {
// 			if (basename($filename)[0] == '.') continue;
// 			$tmp = strtolower(basename($filename));
// 			$candidateTitle = substr($tmp, 0, strpos($tmp, ".pdf"));
// 			if (strcmp($title, $candidateTitle) == 0 || str_contains($title, $candidateTitle)) return str_replace($root . '\public', '', $filename);
// 		}
// 	}

// 	return '';
// }



// $sortedArticles = sortArticles($articles, $sortBy, $arrange, $show);
// printArticles($sortedArticles, 10);
// var_dump(sortArticles($articles, 'ArticleTitle', 1, 10));
// echo getFilePath($root, '2022', '20', '4', 'Data-Driven Hyperparameter Optimized Extreme Gradient Boosting Machine Learning Model for Solar Radiation Forecasting');
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
									</fieldset>
								</form>
							</div>
						</div>
						<div class="sj-widget sj-widgetspeciality">
							<div class="sj-widgetheading">
								<h3>By Specialty</h3>
							</div>
							<div class="sj-widgetcontent">
								<div class="sj-selectgroup">
									<span class="sj-checkbox">
										<input id="sj-viewall" type="checkbox" name="speciality" value="sj-viewall">
										<label for="sj-viewall">View All<em>(230)</em></label>
									</span>
									<span class="sj-checkbox">
										<input id="sj-oncology" type="checkbox" name="speciality" value="sj-oncology">
										<label for="sj-oncology">Hematology/Oncology<em>(37)</em></label>
									</span>
									<span class="sj-checkbox">
										<input id="sj-care" type="checkbox" name="speciality" value="sj-care">
										<label for="sj-care">Pulmonary/Critical Care<em>(29)</em></label>
									</span>
									<span class="sj-checkbox">
										<input id="sj-padiatrics" type="checkbox" name="speciality" value="sj-padiatrics">
										<label for="sj-padiatrics">Pediatrics<em>(27)</em></label>
									</span>
									<span class="sj-checkbox">
										<input id="sj-neurology" type="checkbox" name="speciality" value="sj-neurology">
										<label for="sj-neurology">Neurology/Neurosurgery<em>(23)</em></label>
									</span>
									<span class="sj-checkbox">
										<input id="sj-disease" type="checkbox" name="speciality" value="sj-disease">
										<label for="sj-disease">Infectious Disease<em>(22)</em></label>
									</span>
								</div>
							</div>
						</div>
						<div class="sj-widget sj-widgetarticles">
							<div class="sj-widgetheading">
								<h3>By Article Type</h3>
							</div>
							<div class="sj-widgetcontent">
								<div class="sj-selectgroup">
									<span class="sj-checkbox">
										<input id="sj-viewalltwo" type="checkbox" name="speciality" value="sj-viewalltwo">
										<label for="sj-viewalltwo">View All<em>(216)</em></label>
									</span>
									<span class="sj-checkbox">
										<input id="sj-psddesign" type="checkbox" name="speciality" value="sj-psddesign">
										<label for="sj-psddesign">Psd Design<em>(37)</em></label>
									</span>
									<span class="sj-checkbox">
										<input id="sj-htmltemplate" type="checkbox" name="speciality" value="sj-htmltemplate">
										<label for="sj-htmltemplate">HTML Template<em>(29)</em></label>
									</span>
									<span class="sj-checkbox">
										<input id="sj-wordpress" type="checkbox" name="speciality" value="sj-wordpress">
										<label for="sj-wordpress">Wordpress<em>(27)</em></label>
									</span>
									<span class="sj-checkbox">
										<input id="sj-joomla" type="checkbox" name="speciality" value="sj-joomla">
										<label for="sj-joomla">Joomla<em>(23)</em></label>
									</span>
								</div>
							</div>
						</div>
						<div class="sj-widget sj-widgetdate">
							<div class="sj-widgetheading">
								<h3>By Date</h3>
							</div>
							<div class="sj-widgetcontent">
								<div class="sj-selectgroup">
									<span class="sj-checkbox">
										<input id="sj-viewallthree" type="checkbox" name="speciality" value="sj-viewallthree">
										<label for="sj-viewallthree">View All<em>(216)</em></label>
									</span>
									<span class="sj-checkbox">
										<input id="sj-tenyear" type="checkbox" name="speciality" value="sj-tenyear">
										<label for="sj-tenyear">Past 10 Years<em>(37)</em></label>
									</span>
									<span class="sj-checkbox">
										<input id="sj-fifteenyears" type="checkbox" name="speciality" value="sj-fifteenyears">
										<label for="sj-fifteenyears">Past 15 Years<em>(29)</em></label>
									</span>
									<span class="sj-checkbox">
										<input id="sj-twentyyears" type="checkbox" name="speciality" value="sj-twentyyears">
										<label for="sj-twentyyears">Past 20 Years<em>(27)</em></label>
									</span>
									<span class="sj-checkbox">
										<input id="sj-twentyfiveyears" type="checkbox" name="speciality" value="sj-twentyfiveyears">
										<label for="sj-twentyfiveyears">Past 25 Years<em>(23)</em></label>
									</span>
								</div>
								<div class="sj-filterbtns">
									<a class="sj-btn" href="javascript:void(0)">Apply Filter</a>
									<a class="sj-btn" href="javascript:void(0)">Reset All</a>
								</div>
							</div>
						</div>
					</aside>
				</div>
				<div class="col-12 col-sm-12 col-md-7 col-lg-4 col-xl-6">
					<div id="sj-content" class="sj-content">
						<div class="sj-description">
							<img src="http://advances.vsb.cz/public/site/images/lat04/Latal.jpg" alt="" width="160" height="150" />
							<p><strong>Foreword from Jan Latal, Lecturer and Professor’s assistant at the Department of Telecommunications, Faculty of Electrical Engineering and Computer Science, VSB–Technical University of Ostrava, Czech Republic and former Editor-in-Chief of Advances in Electrical and Electronic Engineering journal:</strong></p><br />
							<p>"At the end, I will allow myself to add a few Editor's thoughts… Academic research and development is nowadays impossible without sharing of information and presentation of results to other researchers or to the public. The long-term goal of Advances in Electrical and Electronic Engineering journal was and still is to become one of the most important scientific journals not only in the Central Europe area, but also became known to the researchers worldwide. Of course, this is not a simple task for any journal considering that in given area already were journals with similar focus.<br />
								Therefore, journal have to find its way, authors and readers, catch their interest by offering something new or different.<br />
								There is also a significant pressure from government through funding to publish in top quality journals with high reputation and evaluation, this situation makes it quite difficult for small or emerging journals to attract high quality publications. This also brings “grey zone” in form of fraudulent journals that are founded only for generating profits through article processing charge. The other form is so called “hijacked journals”, which are journals that usurp identity of scientific journal and on the first glance are identical with the real journal. The first person to point this out was Tim Hill in 2008, but sadly there have been more such a cases in the academic publishing in recent years. Publishing in a “predator journal” reduces the credibility of the author, but also the credibility of the institution and the scientific community in general. Some articles published in such a journal shows signs of low scientific quality, have negligible or no scientific knowledge contribution at all. The aim of the authors who publish in predatory journals is usually to artificially increase publication activity, Hirsh’s index and to get more publicity for their work. The phenomenon of predatory journals and publishers was made famous the most by American librarian Jeffrey Beall who announced the names of fraudulent subjects on his website. The boundary between a predatory journal and low-quality journal is not unequivocal, but final effect for the author is almost the same. It is only at the authors discretion where to publish their work, to which community to provide their results. Therefore, it is necessary to check the publishing practices and the reputation of a particular publisher before submitting their article." </p> <br />
							<p><a href="http://advances.vsb.cz/public/site/images/lat04/VOL21_NO2_Latal.pdf">More...</a></p>
							<h3>Table of Contents</h3>
						</div>
						<span class="sj-showitems">Showing <em>1</em> to <em>20</em> of <em>153</em> Articles</span>
						<!-- <div class="sj-uploadarticle"> -->
						<!-- <figure class="sj-uploadarticleimg"> -->
						<!-- <img src="/images/upload-articlebg.jpg" alt="image description"> -->
						<!-- <figcaption> -->
						<!-- <div class="sj-uploadcontent"> -->
						<!-- <span>Do You Want To Upload Your Article?</span> -->
						<!-- <h3>Submit Now &amp; Make Your Online Presence</h3> -->
						<!-- <a class="sj-btn" href="javascript:void(0);">Submit Now</a> -->
						<!-- </div> -->
						<!-- </figcaption> -->
						<!-- </figure> -->
						<!-- </div> -->
						<div class="sj-articles">
							<form id="sortArticleForm" class="sj-formtheme sj-formsortitems">
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
							</form>
							<div id="sortedArticles">
								<?php
								foreach ($articleController->sortArticles('ArticleTitle', 1, 10) as $index => $article) {
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
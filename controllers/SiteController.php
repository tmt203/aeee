<?php

namespace app\controllers;

use app\core\Controller;

class SiteController extends Controller
{
  // home
  public function home()
  {
    return $this->render('index');
  }

  // about us
  public function aimsAndScopes()
  {
    return $this->render('aims_scopes');
  }

  public function abstractAndIndexing()
  {
    return $this->render('indexing');
  }

  public function publicationAndFrequency()
  {
    return $this->render('pub_freq');
  }

  public function journalHistory()
  {
    return $this->render('journal_history');
  }

  public function openAccessPolicy()
  {
    return $this->render('apc_oa');
  }

  public function contact()
  {
    return $this->render('contact');
  }

  // editors
  public function editors()
  {
    return $this->render('editors');
  }

  // issues
  public function currentIssues()
  {
    return $this->render('articles');
  }

  public function archives()
  {
    return $this->render('issues_years');
  }

  public function extractMetadata() {
    return $this->render('extract_metadata');
  }

  // publish
  public function submission()
  {
    return $this->render('author_guideline');
  }

  public function demonstrationVideos()
  {
    return $this->render('video_guide');
  }

  public function publishingProcedure()
  {
    return $this->render('pub_process');
  }

  public function reviewProcess()
  {
    return $this->render('rev_process');
  }

  public function copyright()
  {
    return $this->render('copyright');
  }

  public function forReaders()
  {
    return $this->render('for_readers');
  }

  public function forLibrarians()
  {
    return $this->render('for_librarians');
  }

  // announcements
  public function announcements()
  {
    return $this->render('announcements');
  }

  // download
  public function download()
  {
    return $this->render('download');
  }

  // custom - not render view
  public static function getBaseUrl()
  {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    $uri = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');

    return "$protocol://$host$uri";
  }
}

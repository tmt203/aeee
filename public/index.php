<?php 
use app\core\Application;
use app\controllers\SiteController;
use app\controllers\ArticleController;
use app\models\User;

require_once __DIR__.'/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
  'user' => User::class,
  'db' => [
    'dsn' => $_ENV['DB_DSN'],
    'user' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASSWORD'],
  ]
];

$app = new Application(dirname(__DIR__), $config);

// client
$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/about-us/aims-and-scopes', [SiteController::class, 'aimsAndScopes']);
$app->router->get('/about-us/abstracting-and-indexing', [SiteController::class, 'abstractAndIndexing']);
$app->router->get('/about-us/publication-and-frequency', [SiteController::class, 'publicationAndFrequency']);
$app->router->get('/about-us/journal-history', [SiteController::class, 'journalHistory']);
$app->router->get('/about-us/open-access-policy', [SiteController::class, 'openAccessPolicy']);
$app->router->get('/about-us/contact', [SiteController::class, 'contact']);
$app->router->get('/editors', [SiteController::class, 'editors']);
$app->router->get('/issues/current-issues', [SiteController::class, 'currentIssues']);
$app->router->get('/issues/archives', [SiteController::class, 'archives']);
$app->router->get('/publish/author-guidelines/submission', [SiteController::class, 'submission']);
$app->router->get('/publish/author-guidelines/demonstration-videos', [SiteController::class, 'demonstrationVideos']);
$app->router->get('/publish/publishing-procedure', [SiteController::class, 'publishingProcedure']);
$app->router->get('/publish/review-process', [SiteController::class, 'reviewProcess']);
$app->router->get('/publish/copyright-and-privacy-statement', [SiteController::class, 'copyright']);
$app->router->get('/publish/for-readers', [SiteController::class, 'forReaders']);
$app->router->get('/publish/for-librarians', [SiteController::class, 'forLibrarians']);
$app->router->get('/announcements', [SiteController::class, 'announcements']);

// api
$app->router->get('/api/articles', [ArticleController::class, 'getAllArticles']);
$app->router->post('/api/articles/getArticlesByVolumeAndIssueAndDate', [ArticleController::class, 'getArticlesByVolumeAndIssueAndDate']);
$app->router->post('/api/articles/search', [ArticleController::class, 'search']);
$app->router->post('/api/articles/filterArticles', [ArticleController::class, 'filterArticles']);


$app->run();
?>
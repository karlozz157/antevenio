<?php

use Slim\App;
use Antevenio\Controller\QuizController;
use Antevenio\Helper\ViewHelper;
use Antevenio\Manager\QuizManager;

$app = new App();
$controller = new QuizController(new QuizManager($medoo));

$app->get('/login', function ($request, $response) {
    $_SESSION['logged'] = true;
    return $response->withRedirect('/antevenio/index.php');
});

$app->get('/', function ($request, $response, $args) use ($controller) {
    $controller->requireAuth();
    $controller->indexAction();
});

$app->post('/persist', function ($request, $response, $args) use ($controller) {
    $controller->requireAuth();
    $controller->persistAction($request);
});

$app->get('/thanks', function ($request, $response, $args) use ($controller) {
    $controller->requireAuth();
    $controller->thanksAction($request);
});

$app->run();

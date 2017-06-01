<?php

namespace Antevenio\Controller;

use Antevenio\Helper\LocationHelper;
use Antevenio\Helper\JsonHelper;
use Antevenio\Helper\ViewHelper;
use Antevenio\Service\FacebookService;
use Antevenio\Manager\QuizManager;

/**
 * @author karlozz157
 */
class QuizController
{    
    /**
     * @var QuizManager $quizManager
     */
    protected $quizManager;

    /**
     * @param QuizManager $quizManager
     */
    public function __construct(QuizManager $quizManager)
    {
        $this->quizManager = $quizManager;
    }

    public function indexAction()
    {
        $mostVoted = $this->quizManager->getMostVoted();
        ViewHelper::load('index.php', ['mostVoted' => $mostVoted]);
    }

    /**
     * @param mixed $request
     */
    public function persistAction($request)
    {
        $contents = JsonHelper::decode($request->getBody()->getContents());
        $contents['location'] = LocationHelper::getGeolocation();
        $this->quizManager->persist($contents);
        $_SESSION['success'] = true;
        header('Content-type: application/json');
        echo JsonHelper::encode(['success' => true]);
    }

    public function thanksAction()
    {
        if (!isset($_SESSION['success'])) {
            echo 'you can\'t stay here';
            exit;
        }

        session_destroy();

        ViewHelper::load('thanks.html');
    }

    public function requireAuth()
    {
        if (!isset($_SESSION['logged'])) {
            $mostVoted = $this->quizManager->getMostVoted();
            ViewHelper::load('login.php', ['mostVoted' => $mostVoted, 'count' => $this->quizManager->count()]);
            exit;
        }
    }
}

<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\User;
use app\models\LoginForm;

class AuthController extends Controller
{
  public function login(Request $request, Response $response) 
  {
    $loginForm = new LoginForm();
    if ($request->isPost()) {
      $loginForm->loadData($request->getBody());      

      if ($loginForm->validate() && $loginForm->login()) {
        $response->redirect('/');
        exit;
      }
    }

    return $this->render('login', [
      'userModel' => $loginForm
    ]);
  }

  public function register(Request $request)
  {
    $user = new User();
    if ($request->isPost()) {
      $user->loadData($request->getBody());

      if ($user->validate() && $user->save()) {
        Application::$app->session->setFlash('success', 'Thanks for registering');
        Application::$app->response->redirect('/');
        exit;
      }
    }

    return $this->render('register', [
      'user' => $user
    ]);
  }

  public function logout(Request $request, Response $response) {
    Application::$app->logout();
    $response->redirect('/');
  }
}

<?php

namespace app\controllers;

use app\core\Application;
use app\core\ControllerBase;
use app\models\User;
use app\repositories\UserSecretsRepository;
use app\repositories\UsersRepository;

class HomeController extends ControllerBase
{
    public function Index()
    {
        return $this->renderPage('home');
    }

    public function Register()
    {
        return $this->renderPage('register');
    }

    public function HandleRegister()
    {
        $body = $this->request->getBody();

        $userRepo = new UsersRepository(Application::$GlobalThis->database);

        $userInDb = $userRepo->getByEmail($body["email"]);
        if ($userInDb != null) {
            return $this->badRequest("User with such email already exists...");
        }

        $user = new User(0, $body["email"], password_hash($body["password"], PASSWORD_DEFAULT));
        $userRepo->add($user);

        return $this->renderPage('home');
    }

    public function Login()
    {
        return $this->renderPage('login');
    }

    public function HandleLogin()
    {
        $body = $this->request->getBody();

        $userRepo = new UsersRepository(Application::$GlobalThis->database);
        $user = $userRepo->getByEmail($body["email"]);

        if ($user == null) {
            return $this->badRequest("User doesn't exist");
        }

        if (!password_verify($body["password"], $user->password_hash)) {
            return $this->badRequest("Invalid password");
        }

        $secretsRepo = new UserSecretsRepository(Application::$GlobalThis->database);
        $secret = $secretsRepo->getSecretByUserId($user->id);

        if ($secret == null) {
            $secret = [uniqid(), $user->id];
            $secretsRepo->add($secret);

            $this->response->setCookie('Auth', $user->email . ';' . $secret[0]);
        } else {
            $this->response->setCookie('Auth', $user->email . ';' . $secret[1]);
        }


        return $this->renderPage('home');
    }

    public function Admin()
    {
        return $this->renderPage('admin');
    }
}
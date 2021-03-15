<?php


namespace app\middleware;

use app\core\Application;
use app\core\MiddlewareBase;
use app\repositories\UserRolesRepository;
use app\repositories\UserSecretsRepository;
use app\repositories\UsersRepository;
use Exception;

class GuardMiddleware extends MiddlewareBase
{
    private $protectedActions;

    function __construct()
    {
        $this->protectedActions = array();
    }

    public function addGuard($path, $method, $role = "*")
    {
        $this->protectedActions[$method][$path] = [true, $role];
    }

    public function processBefore($request, $response)
    {
        $cookie = $request->getAuthCookie();
        if ($cookie == null && $this->actionIsGuarded($request->getPath(), $request->getMethod())) {
            throw new Exception("Required an auth to access this route");
        }

        if ($cookie != null) {
            $user = $this->verifyCookie($cookie);

            if(isset($this->protectedActions[$request->getMethod()][$request->getPath()])){
                $required_role = $this->protectedActions[$request->getMethod()][$request->getPath()][1];

                if ($required_role != "*" && !$user->user_in_role($required_role) && !$user->user_in_role("super_admin")) {
                    throw new Exception("You don't have permission to enter here, mortal");
                }
            }

            Application::$GlobalThis->user = $user;
        }
    }

    public function processAfter($request, $response)
    {
    }

    private function actionIsGuarded($path, $method)
    {
        return isset($this->protectedActions[$method][$path]);
    }

    private function verifyCookie($cookie)
    {
        $userRepo = new UsersRepository(Application::$GlobalThis->database);
        $user = $userRepo->getByEmail(explode(';', $cookie)[0]);

        $secretsRepo = new UserSecretsRepository(Application::$GlobalThis->database);
        $secret = $secretsRepo->getSecretByUserId($user->id);

        if ($secret[1] != explode(';', $cookie)[1]) {
            throw new Exception("Invalid cookie");
        }

        $roleRepo = new UserRolesRepository(Application::$GlobalThis->database);
        $user->roles = $roleRepo->getUserRoles($user->id);

        return $user;
    }
}
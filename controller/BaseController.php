<?php
class BaseController
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function setSession($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function getSession($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public function sessionExists($key)
    {
        return isset($_SESSION[$key]);
    }

    public function destroySession()
    {
        session_unset();
        session_destroy();
    }

    public function isAuthenticated()
    {
        return $this->sessionExists('user_id');
    }

    public function login($user_id)
    {
        $this->setSession('user_id', $user_id);
    }

    public function logout()
    {
        $this->destroySession();
    }
    public function getUsername()
{
    return $this->getSession('username');
}

}
?>

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

    // Méthode pour vérifier si l'utilisateur est connecté
    public function isAuthenticated()
    {
        return $this->sessionExists('user_id');
    }

    // Méthode pour se connecter
    public function login($user_id)
    {
        $this->setSession('user_id', $user_id);
    }

    // Méthode pour se déconnecter
    public function logout()
    {
        $this->destroySession();
    }
}

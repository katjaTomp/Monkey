<?php
//destroy the cookies
if (ini_get('session.use_cookies'))
{
    $p = session_get_cookie_params();
    setcookie(session_name(), '', time() - 31536000, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
}
session_unset();
unset($_SESSION['login']);

header('Location: ../view/signin.html');
?>

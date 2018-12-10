<?php
class Session {
    public static function is_user($login) {
        return (!empty($_SESSION['login']) && ($_SESSION['login'] == $login));
    }

    public static function is_admin($login) {
        return (isset($_SESSION['admin'])&&$_SESSION['admin']=='true');
    }
}
?>
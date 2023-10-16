<?php
if(file_exists('../config.php')){
    require_once '../config.php';
}else{
    require_once 'config.php';
}
class Admin{
    public static function Login($username, $password)
    {
        // get connection
        global $dbh;
        // encrypte password
        $password = md5($password);
        // prepare query before execute 
        $sql = $dbh->prepare("SELECT id FROM admin WHERE username='$username' AND password='$password'");
        // execute sql query
        $sql->execute();
        $admin = $sql->fetch(PDO::FETCH_ASSOC);
        if(is_array($admin)){
            // start session 
            session_start();
            // create session
            $_SESSION['isLoggedIn'] = true;
            $_SESSION['username'] = $username; 
            return true;
        }else{
            return false;
        }
    }
    public static function isLoggedIn()
    {
        session_start(); 
        if(isset($_SESSION['isLoggedIn'], $_SESSION['username'])){
            return true;
        }else {
            return false;
        }
    }
    public static function logout()
    {
        session_start(); 
        unset($_SESSION['isLoggedIn']);
        unset($_SESSION['username']);
    }
}
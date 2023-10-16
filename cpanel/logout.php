<?php
require_once '../lib/Admin.php';
if(Admin::isLoggedIn()){
    // logout
    Admin::logout();
    // redirect to login page
    header("Location: login.php");
    // for security 
    exit();
}else{
    sleep(5);
    // redirect to home page
    header("Location: index.php");
    // for security 
    exit();
}

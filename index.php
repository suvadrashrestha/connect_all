<?php session_start();
require_once 'assets/php/functions.php';
if(isset($_GET['newfp'])){
    unset($_SESSION['auth_temp']);
    unset($_SESSION['forgot_email']);
    unset($_SESSION['forgot_code']);
}
if(isset($_SESSION['Auth'])){
    $user = getUser($_SESSION['userdata']['id']);
}

if(isset($_SESSION['Auth']) && ($user['ac_status']==1)){
//   echo "user is logged in";
//   $userdata= $_SESSION['userdata'];
//   echo "<pre>";
//   print_r($userdata);
showPage('header',['page_title'=>'connect - home','css'=>'feed']);
showPage('navbar');
showPage('feed');
}
elseif(isset($_SESSION['Auth']) && ($user['ac_status']==0)){
    showPage('header',['page_title'=>'connect - verify your email','css'=>'verify']);
    showPage('verify_email');
}
elseif(isset($_SESSION['Auth']) && ($user['ac_status']==2)){
    showPage('header',['page_title'=>'connect - verify your email','css'=>'blocked']);
    showPage('blocked');
}
elseif(isset($_GET['signup'])){
    showPage('header',['page_title'=>'connect - signup','css'=>'signup']);
    showPage('signup');
   
}
elseif(isset($_GET['login'])){
    showPage('header',['page_title'=>'connect - login','css'=>'signup']);
    showPage('login');
}
elseif(isset($_GET['forgotpassword'])){
    showPage('header',['page_title'=>'connect - forgot password','css'=>'signup']);
    showPage('forgot_password');
}
else{
    showPage('header',['page_title'=>'connect - login','css'=>'signup']);
    showPage('login');
}
showPage('footer');
unset($_SESSION['error']);
unset($_SESSION['formdata']);

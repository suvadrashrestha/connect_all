<?php session_start();
require_once 'assets/php/functions.php';
// echo "<pre>";
// print_r(getPost());

if(isset($_GET['newfp'])){
    unset($_SESSION['auth_temp']);
    unset($_SESSION['forgot_email']);
    unset($_SESSION['forgot_code']);
}
if(isset($_SESSION['Auth'])){
    $user = getUser($_SESSION['userdata']['id']);
    $posts= getPost();
}

$pagecount= count($_GET);



// manage pages 
if(isset($_SESSION['Auth']) && ($user['ac_status']==1) && !$pagecount){
//   echo "user is logged in";
//   $userdata= $_SESSION['userdata'];
//   echo "<pre>";
//   print_r($userdata);
showPage('header',['page_title'=>'connect - home','css'=>['feed','navbar']]);
showPage('navbar');
showPage('feed');
}
elseif(isset($_SESSION['Auth']) && ($user['ac_status']==0) && !$pagecount){
    showPage('header',['page_title'=>'connect - verify your email','css'=>'verify']);
    showPage('verify_email');
}
elseif(isset($_SESSION['Auth']) && ($user['ac_status']==2) && !$pagecount){
    showPage('header',['page_title'=>'connect - verify your email','css'=>'blocked']);
    showPage('blocked');
}
elseif(isset($_SESSION['Auth']) && isset($_GET['editprofile']) ){
    showPage('header',['page_title'=>'connect - edit profile' , 'css'=>['feed','edit_profile','navbar']]);
    showPage('navbar');
    showPage('edit_profile');
}
elseif(isset($_GET['signup'])){
    showPage('header',['page_title'=>'connect - signup','css'=>'signup', ]);
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
    if(isset($_SESSION['Auth'])){
        showPage('header',['page_title'=>'connect - home','css'=>['feed','navbar']]);
        showPage('navbar');
        showPage('feed');
    }
    else{
    showPage('header',['page_title'=>'connect - login','css'=>'signup']);
    showPage('login');
    }
}
showPage('footer');
unset($_SESSION['error']);
unset($_SESSION['formdata']);

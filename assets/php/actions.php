<?php
session_start();
require_once 'functions.php';
require_once 'send_code.php';

//for managing signup
if (isset($_GET['signup'])) {
    $response = validateSignUpForm($_POST);

    if ($response['status']) {
        if (createUser($_POST)) {
            header('location:../../?login');
        } else {
            echo "<script> alert('something is wrong') </script>";
        }
    } else {
        $_SESSION['error'] = $response;
        $_SESSION['formdata'] = $_POST;
        header("location:../../?signup");
    }
}


//for managing login
if (isset($_GET['login'])) {

    // print_r(checkUser($_POST));
    $response = validateLoginForm($_POST);
    // echo "sdcsthis is sme thingd";
    // echo "<pre>";
    // print_r($response);
    if ($response['status']) {
        $_SESSION['Auth'] = true;
        $_SESSION['userdata'] = $response['user'];
        if ($response['user']['is_admin'] == 1) {
            $_SESSION['is_admin'] = true;
        }
        if ($response['user']['ac_status'] == 0 && $response['user']['is_admin'] == 0) {
            $_SESSION['code'] = $code = rand(111111, 999999);
            sendCode($response['user']['email'], 'Verify your email', $code);
        }
        header("location:../../");
        exit;
    } else {
        $_SESSION['error'] = $response;
        $_SESSION['formdata'] = $_POST;
        header("location:../../?login");
        exit;
    }
}

//for resending code 
if (isset($_GET['resend_code'])) {
    $_SESSION['code'] = $code = rand(111111, 999999);
    sendCode($_SESSION['userdata']['email'], 'Verify your email', $code);
    header('location:../../?resended');
}


//for verifying email  
if (isset($_GET['verify_email'])) {
    $user_code = $_POST['code'];
    $code = $_SESSION['code'];
    if ($code == $user_code) {
        if (verifyEmail($_SESSION['userdata']['email'])) {
            header('location:../../');
        } else {
            echo "something is wrong";
        }
    } else {
        $response['msg'] = 'incorrect code !';
        if (!$_POST['code']) {
            $response['msg'] = 'Enter code !';
        }
        $response['field'] = 'email_verify';

        $_SESSION['error'] = $response;
        header('location:../../');
    }
}







if (isset($_GET['forgotpassword'])) {
    if (!$_POST['email']) {
        $response['msg'] = "email your email id";
        $response['field'] = 'email';
        $_SESSION['error'] = $response;
        header('location:../../?forgotpassword');
    } elseif (!isEmailResgistered($_POST["email"])) {
        $response['msg'] = "email is not registered";
        $response['field'] = 'email';
        $_SESSION['error'] = $response;
        header('location:../../?forgotpassword');
    } else {
        $_SESSION['forgot_email'] = $_POST['email'];
        $_SESSION['forgot_code'] = $code = rand(111111, 999999);
        sendCode($_POST['email'], 'Forgot Your Password ?', $code);
        header('location:../../?forgotpassword&resended');
    }
}


//for verify forgot code 
if (isset($_GET['verifycode'])) {
    $user_code = $_POST['code'];
    $code = $_SESSION['forgot_code'];
    if ($code == $user_code) {
        $_SESSION['auth_temp'] = true;
        header('location: ../../?forgotpassword');
    } else {
        $response['msg'] = 'incorrect code !';
        if (!$_POST['code']) {
            $response['msg'] = 'Enter 6 digit code !';
        }
        $response['field'] = 'email_verify';

        $_SESSION['error'] = $response;
        header('location:../../?forgotpassword');
    }
}

if (isset($_GET['changepassword'])) {
    if (!$_POST['password']) {
        $response['msg'] = 'Enter your new password';
        $response['field'] = 'password';
        $_SESSION['error'] = $response;
        header('location:../../?forgotpassword');
    } else {
        resetPassword($_SESSION['forgot_email'], $_POST['password']);
        header('location:../../?reseted');
    }
}

if (isset($_GET['updateprofile'])) {
    // print_r($_POST); 
    //   print_r($_FILES);



    $response = validateUpdateForm($_POST, $_FILES['profile_pic']);
    // print_r($response);

    if ($response['status']) {
        if (updateprofile($_POST, $_FILES['profile_pic'])) {
            header("location: ../../?editprofile=success");
        } else {
            echo "something is wrong";
        }
    } else {
        $_SESSION['error'] = $response;
        header("location: ../../?editprofile");
    }
}



// For managing add post
if (isset($_GET['addpost'])) {
    // echo "<pre>";
    // print_r($_FILES);
    // $image= basename($_FILES['post_img']['name']);

    // $type= strtolower(pathinfo($image,PATHINFO_EXTENSION));
    // echo "$type";
    $response = ['status' => true];
    if (isset($_FILES['post_img']) && $_FILES['post_img']['error'] == 0) {
        $response = validatePostImage($_FILES['post_img']);
    }

    if ($response["status"]) {
        if (createPost($_POST, $_FILES['post_img'] ?? null)) {
            header("location:../../");
        } else {
            echo "Something went wrong";
        }
    } else {
        $_SESSION['error'] = $response;
        header("location:../../");
        exit;
    }
}

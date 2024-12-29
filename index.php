<?php session_start();
require_once 'assets/php/functions.php';
require_once 'assets/php/adminFunction.php';


if (isset($_GET['newfp'])) {
    unset($_SESSION['auth_temp']);
    unset($_SESSION['forgot_email']);
    unset($_SESSION['forgot_code']);
}
if (isset($_SESSION['Auth'])) {
    $user = getUser($_SESSION['userdata']['id']);
    $posts = filterPosts();
    $follow_suggestions = filterFollowSuggestion();
}

$pagecount = count($_GET);



// manage pages 
if (isset($_SESSION['Auth']) && ($user['ac_status'] == 1) && !$pagecount) {
    showPage('header', ['page_title' => 'connect - home', 'css' => ['navbar', 'feed']]);
    showPage('navbar');
    showPage('feed');
} elseif ((isset($_SESSION['Auth']) && ($user['ac_status'] == 0) && !$pagecount) || (isset($_SESSION['Auth']) && ($user['ac_status']=='0') && isset($_GET['resended']))) {
    showPage('header', ['page_title' => 'connect - verify your email', 'css' => 'login']);
    showPage('verify_email');
} elseif (isset($_SESSION['Auth']) && ($user['ac_status'] == 2) && !$pagecount) {
    showPage('header', ['page_title' => 'connect - verify your email', 'css' => 'blocked']);
    showPage('blocked');
} elseif (isset($_SESSION['Auth']) && isset($_GET['editprofile']) && $user['ac_status'] == 1) {
    showPage('header', ['page_title' => 'connect - edit profile', 'css' => [ 'navbar','edit_profile']]);
    showPage('navbar');
    showPage('edit_profile');
} elseif (isset($_SESSION['Auth']) && isset($_GET['search']) && $user['ac_status'] == 1) {
    if (empty($_GET['search'])) {
        showPage('header', ['page_title' => 'connect - home', 'css' => ['feed', 'navbar']]);
        showPage('navbar');
        showPage('feed');
    } else {
        $search_param = $_GET['search'];
        $search_result = searchUser($search_param);
        // echo "<pre>";
        // print_r($search_result);
        showPage('header', ['page_title' => 'search result', 'css' => ['navbar', 'feed']]);
        showPage('navbar');
        showPage('search_result');
    }
} elseif (isset($_SESSION['Auth']) && isset($_GET['u']) && $user['ac_status'] == 1) {
    $profile = getUserByUsername($_GET['u']);

    if (!$profile) {
        showPage('header', ['page_title' => 'User not found', 'css' => ['navbar']]);
        showPage('navbar');
        showPage('user_not_found');
    } else {
        $profile_post = getPostById($profile['id']);
        $profile['followers'] = getFollowers($profile["id"]);
        $profile['following'] = getFollowing($profile["id"]);

        showPage('header', ['page_title' => $profile['first_name'] . ' ' . $profile['last_name'], 'css' => ['navbar','profile']]);
        showPage('navbar');
        showPage('profile');
        // print_r($profile);
        // print_r($profile_post);
    }
} elseif (isset($_GET['signup']) && !(isset($_SESSION['Auth']))) {
    showPage('header', ['page_title' => 'connect - signup', 'css' => 'register',]);
    showPage('signup');
} elseif (isset($_GET['login']) && !(isset($_SESSION['Auth']))) {
    showPage('header', ['page_title' => 'connect - login', 'css' => 'login']);
    showPage('login');
} elseif (isset($_GET['forgotpassword'])) {
    showPage('header', ['page_title' => 'connect - forgot password', 'css' => 'login']);
    showPage('forgot_password');
} elseif (isset($_SESSION['Auth']) && isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {
    if (isset($_GET['adminDashboard'])) {
        $currentPage = 'dashboard';
        showPage('header', ['page_title' => 'connect - admin dashboard', 'css' => ['navbar', 'admindashboard']]);
        showPage('admin/navbar');
        showPage('admin/dashboard');
    }
    if (isset($_GET['usersList'])) {
        $currentPage = 'users';
        showPage('header', ['page_title' => 'connect - user list ', 'css' => ['navbar', 'admindashboard']]);
        showPage('admin/navbar');
        showPage('admin/usersList');
    }
    if (isset($_GET['adminList'])) {
        $currentPage = 'admin';
        showPage('header', ['page_title' => 'connect - admin list ', 'css' => ['navbar', 'admindashboard']]);
        showPage('admin/navbar');
        showPage('admin/adminList');
    }
    if (isset($_GET['postList'])) {
        $currentPage = 'posts';
        showPage('header', ['page_title' => 'connect - posts list ', 'css' => ['navbar', 'admindashboard','feed']]);
        showPage('admin/navbar');
        showPage('admin/postList');
    }
    if (isset($_GET['editSingleUser'])  && !empty($_GET['id'])) {
        $currentPage = 'users';
        $user_id = $_GET['id'];
        $users=getAdminEditUserById($user_id);
        showPage('header', ['page_title' => 'connect - posts list ', 'css' => ['navbar', 'admindashboard']]);
        showPage('admin/navbar');
        showPage('admin/editUser');
    }
} else {
    if (isset($_SESSION['Auth'])  ) {
        showPage('header', ['page_title' => 'connect - home', 'css' => ['feed', 'navbar']]);
       
        
    } else {
        showPage('header', ['page_title' => 'connect - login', 'css' => 'login']);
        showPage('login');
    }
}
showPage('footer');
unset($_SESSION['error']);
unset($_SESSION['formdata']);

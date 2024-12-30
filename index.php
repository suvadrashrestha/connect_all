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



// Manage Pages
if (isset($_SESSION['Auth'])) {
    // Authenticated user logic
    if ($user['ac_status'] == 1) {
        if (!$pagecount) {
            // Home page
            showPage('header', ['page_title' => 'connect - home', 'css' => ['navbar', 'feed']]);
            showPage('navbar');
            showPage('feed');
        } else {
            if (isset($_GET['editprofile'])) {
                // Edit profile
                showPage('header', ['page_title' => 'connect - edit profile', 'css' => ['navbar', 'edit_profile']]);
                showPage('navbar');
                showPage('edit_profile');
            } elseif (isset($_GET['search'])) {
                // Search page
                if (empty($_GET['search'])) {
                    showPage('header', ['page_title' => 'connect - home', 'css' => ['feed', 'navbar']]);
                    showPage('navbar');
                    showPage('feed');
                } else {
                    $search_param = $_GET['search'];
                    $search_result = searchUser($search_param);
                    showPage('header', ['page_title' => 'search result', 'css' => ['navbar', 'feed']]);
                    showPage('navbar');
                    showPage('search_result');
                }
            } elseif (isset($_GET['u'])) {
                // Profile page
                $profile = getUserByUsername($_GET['u']);
                if (!$profile) {
                    // User not found
                    showPage('header', ['page_title' => 'User not found', 'css' => ['navbar']]);
                    showPage('navbar');
                    showPage('user_not_found');
                } else {
                    $posts = getPostById($profile['id']);
                    $profile['followers'] = getFollowers($profile["id"]);
                    $profile['following'] = getFollowing($profile["id"]);
                    showPage('header', [
                        'page_title' => $profile['first_name'] . ' ' . $profile['last_name'],
                        'css' => ['navbar', 'profile', 'feed']
                    ]);
                    showPage('navbar');
                    showPage('profile');
                }
            } elseif (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {
                // Admin logic
                if (isset($_GET['adminDashboard'])) {
                    $currentPage = 'dashboard';
                    showPage('header', ['page_title' => 'connect - admin dashboard', 'css' => ['navbar', 'admindashboard']]);
                    showPage('admin/navbar');
                    showPage('admin/dashboard');
                } elseif (isset($_GET['usersList'])) {
                    $currentPage = 'users';
                    showPage('header', ['page_title' => 'connect - user list', 'css' => ['navbar', 'admindashboard']]);
                    showPage('admin/navbar');
                    showPage('admin/usersList');
                } elseif (isset($_GET['adminList'])) {
                    $currentPage = 'admin';
                    showPage('header', ['page_title' => 'connect - admin list', 'css' => ['navbar', 'admindashboard']]);
                    showPage('admin/navbar');
                    showPage('admin/adminList');
                } elseif (isset($_GET['postList'])) {
                    $currentPage = 'posts';
                    showPage('header', ['page_title' => 'connect - posts list', 'css' => ['navbar', 'admindashboard', 'feed']]);
                    showPage('admin/navbar');
                    showPage('admin/postList');
                } else {
                    showPage('header', ['page_title' => 'connect - Not - found', 'css' => [ 'not-found']]);
                    showPage('not-found');
                }
            } else {
                showPage('header', ['page_title' => 'connect - Not - found', 'css' => [ 'not-found']]);
                showPage('not-found');
            }
        }
    } elseif ($user['ac_status'] == 0 && (!$pagecount || isset($_GET['resended']))) {
        // Email verification
        showPage('header', ['page_title' => 'connect - verify your email', 'css' => 'login']);
        showPage('verify_email');
    } elseif ($user['ac_status'] == 2) {
        // Blocked user
        showPage('header', ['page_title' => 'connect - blocked', 'css' => 'blocked']);
        showPage('blocked');
    } else {
        // Default fallback for authenticated users
        showPage('header', ['page_title' => 'connect - home', 'css' => ['feed', 'navbar']]);
    }
} else {
    // Unauthenticated user logic
    if (isset($_GET['signup'])) {
        // Signup page
        showPage('header', ['page_title' => 'connect - signup', 'css' => 'register']);
        showPage('signup');
    } elseif (isset($_GET['login'])) {
        // Login page
        showPage('header', ['page_title' => 'connect - login', 'css' => 'login']);
        showPage('login');
    } elseif (isset($_GET['forgotpassword'])) {
        // Forgot password
        showPage('header', ['page_title' => 'connect - forgot password', 'css' => 'login']);
        showPage('forgot_password');
    } else {
        // Default login page
        showPage('header', ['page_title' => 'connect - login', 'css' => 'login']);
        showPage('login');
    }
}

showPage('footer');
unset($_SESSION['error']);
unset($_SESSION['formdata']);

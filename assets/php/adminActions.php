<?php
session_start();
require_once 'adminFunction.php';
if (isset($_GET['removeAdmin'])  && !empty($_GET['user_id'])) {
    $remove = RemoveAdmin($_GET['user_id']);
    if ($remove) {
        header("location:../../?adminList");
    }
}
if (isset($_GET['addAdmin'])  && !empty($_GET['user_id'])) {
    $add = AddAdmin($_GET['user_id']);
    if ($add) {
        header("location:../../?adminList");
    }
}
if (isset($_GET['blockUnblockUser'])  && !empty($_GET['user_id'])) {
    $remove = BlockUnblockUser($_GET['user_id']);
    if ($remove) {
        header("location:../../?usersList");
    }
}
if (isset($_GET['deletePost'])  && !empty($_GET['post_id'])) {
    $remove = deletePost($_GET['post_id']);
    if ($remove) {
        header("location:../../?postList");
    }
}
if (isset($_GET['deleteComment'])  && !empty($_GET['comment_id'])) {
    $remove = deleteComment($_GET['comment_id']);
    if ($remove) {
        header("location:../../?postList");
    }
}

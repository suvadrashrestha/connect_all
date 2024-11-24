<?php

session_start();
require_once 'functions.php';
// for managing follow and unfollow
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_GET['follow'])) {
    header('Content-Type: application/json');
    $response = array();
    $input = json_decode(file_get_contents('php://input'), true);
    $user_id = $input['user_id'];
    $result = followUser($user_id);
    if ($result == 'followed') {
        http_response_code(200);
        $response['status'] = "success";
        $response['message'] = "followed";
    } elseif ($result == 'unfollowed') {
        http_response_code(200);
        $response['status'] = "success";
        $response['message'] = "unfollowed";
    } else {
        http_response_code(400);
        $response['status'] = "failed";
        $response['message'] = "something went wrong";
    }
    echo json_encode($response);
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_GET['userlikes'])) {
    header('Content-Type: application/json');
    $response = array();
    $input = json_decode(file_get_contents('php://input'), true);
    $post_id = $input['post_id'];
    $user_data = getUsersByPostId($post_id);
    foreach ($user_data as &$user) {
        $user['follow_status'] = checkFollowStatus($user['user_id']);
    }
    $response['current_user'] = $_SESSION['userdata']['id'];
    $response['data'] = $user_data;
    echo json_encode($response);
}




// for managing likes and unlikes
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_GET['like'])) {
    header('Content-Type: application/json');
    $response = array();
    $input = json_decode(file_get_contents('php://input'), true);
    $post_id = $input['post_id'];
    try {
        if (!($post_id)) {
            throw new Exception("Post ID  is required."); // Throw an exception if post_id is missing
        }
        if (checkLikeStatus($post_id)) {
            if (unlike($post_id)) {
                $newLikesCount = getLikes($post_id);
                http_response_code(200);
                $response['status'] = "success";
                $response['message'] = "Post unliked  successfully!";
                $response['post_id'] = $input['post_id'];
                $response['is_liked'] = false;
                $response['likes'] = $newLikesCount;
            }
        } else {
            if (like($post_id)) {
                $newLikesCount = getLikes($post_id);
                http_response_code(200);
                $response['status'] = "success";
                $response['message'] = "Post liked  successfully!";
                $response['post_id'] = $input['post_id'];
                $response['is_liked'] = true;
                $response['likes'] = $newLikesCount;
            }
        }
    } catch (Exception $e) {
        http_response_code(500);
        $response['status'] = "error";
        $response['message'] = $e->getMessage();
    }
    echo json_encode($response);
}

// for managing  comments 
if (isset($_GET['addComment'])) {
    header('Content-Type: application/json');
    $response = array();
    $input = json_decode(file_get_contents('php://input'), true);
    $post_id = $input['post_id'];
    $comment = $input['comment'];
    try {
        if (!($post_id || !$comment)) {
            throw new Exception("Post ID  or comment is required."); // Throw an exception if post_id is missing
        }
        if (addcomment($post_id, $comment)) {
            $comment_user = getUser($_SESSION['userdata']['id']);
            $response['status'] = true;
            http_response_code(200);
            $response['comment'] = '
               <div style="display: flex;gap:10px ;margin-bottom:10px; ">
                        <a href="?u=' . $comment_user['username'] . '">

<img class="image" src="assets/images/profiles/' . $comment_user['profile_pic'] . '">
</a>
<div style="background-color:#e6f1ff; padding:10px; border-radius:10px;width:100%">
    <span><b>
            <a style="text-decoration:none;color:black" href="?u=' . $comment_user['username'] . ' ">
' . ucfirst($comment_user['username']) . '
</a>
</b></span>
<span style="display:block">' . $comment . '</span>
</div>
</div>
';
        }
    } catch (Exception $e) {
        http_response_code(500);
        $response['status'] = "error";
        $response['message'] = $e->getMessage();
    }
    echo json_encode($response);
}

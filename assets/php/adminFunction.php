<?php
require_once 'config.php';
function getNonAdminUsers()
{
    // Global database connection variable
    global $db;

    // SQL query to fetch all non-admin users
    $sql = "SELECT * FROM users WHERE is_admin='0' ";

    // Execute the query
    $result = $db->query($sql);

    // Check if the query was successful
    if ($result->num_rows > 0) {
        // Store all users in an array
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        return $users;  // Return the array of non-admin users
    } else {
        return [];  // Return an empty array if no non-admin users are found
    }
}

function getAdminUsers()
{
    // Global database connection variable
    global $db;

    // SQL query to fetch all admin users
    $sql = "SELECT * FROM users WHERE is_admin = 1";

    // Execute the query
    $result = $db->query($sql);

    // Check if the query was successful
    if ($result->num_rows > 0) {
        // Store all users in an array
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        return $users;  // Return the array of admin users
    } else {
        return [];  // Return an empty array if no admin users are found
    }
}

function getPosts()
{
    // Global database connection variable
    global $db;

    // SQL query to get all posts
    $sql = "SELECT * FROM posts";

    // Execute the query
    $result = $db->query($sql);

    // Check if the query was successful
    if ($result->num_rows > 0) {
        // Create an empty array to store posts
        $posts = [];

        // Fetch all rows and add them to the $posts array
        while ($row = $result->fetch_assoc()) {
            $posts[] = $row;
        }

        // Return the array of posts
        return $posts;
    } else {
        return [];  // Return an empty array if no posts are found
    }
}

function getCommentCount()
{
    // Global database connection variable
    global $db;

    // SQL query to count the number of comments
    $sql = "SELECT COUNT(*) AS comment_count FROM comments";

    // Execute the query
    $result = $db->query($sql);

    // Check if the query was successful
    if ($result->num_rows > 0) {
        // Fetch the result
        $row = $result->fetch_assoc();
        return $row['comment_count'];  // Return the count of comments
    } else {
        return 0;  // Return 0 if no comments are found
    }
}

function RemoveAdmin($user_id){
global $db;
$query = "UPDATE users SET is_admin = 0 WHERE id = $user_id";
return mysqli_query($db, $query)?true:false;
}
function AddAdmin($user_id){
    global $db;
    $query = "UPDATE users SET is_admin = 1 WHERE id = $user_id";
    return mysqli_query($db, $query)?true:false;
    }
function BlockUnblockUser($user_id) {
    global $db;
    $query = "SELECT ac_status, original_status FROM users WHERE id = $user_id";
    $result = mysqli_query($db, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        // Check if the user is currently blocked
        if ($user['ac_status'] == 2) {
            $restoreStatus = $user['original_status'] ?? 1; // Default to Active (1) if original_status is NULL
            $updateQuery = "UPDATE users SET ac_status = $restoreStatus, original_status = NULL WHERE id = $user_id";
        } else {
            // If not blocked, store the current status and block the user
            $updateQuery = "UPDATE users SET original_status = ac_status, ac_status = 2 WHERE id = $user_id";
        }
        return mysqli_query($db, $updateQuery) ? true : false;
    }

    // If user not found, return false
    return false;
}

function getAdminEditUserById($user_id) {
    global $db; 
    $query = "SELECT * FROM users WHERE id = $user_id";
    $result = mysqli_query($db, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        return $user;
    } else {
        return false;
    }
}

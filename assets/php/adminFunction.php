<?php
require_once 'config.php';
function getNonAdminUsers()
{
    // Global database connection variable
    global $db;

    // SQL query to fetch all non-admin users
    $sql = "SELECT * FROM users ";

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

function getPostCount()
{
    // Global database connection variable
    global $db;

    // SQL query to count the number of posts
    $sql = "SELECT * FROM posts";

    // Execute the query
    $result = $db->query($sql);

    // Check if the query was successful
    if ($result->num_rows > 0) {
        // Fetch the result
        $row = $result->fetch_assoc();
        return $row;  // Return the count of posts
    } else {
        return 0;  // Return 0 if no posts are found
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

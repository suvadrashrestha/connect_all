<?php
// Database connection
const DB_NAME = "connect";
const DB_HOST = "localhost";
const DB_USER = "root";
const DB_PASS = "";

$db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die("Database is not connected");

// SQL to create the 'users' table if it doesn't exist
$sql_users = "CREATE TABLE IF NOT EXISTS users (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password TEXT NOT NULL,
    gender INT(11) NOT NULL,
    profile_pic TEXT NOT NULL DEFAULT 'default_profile.jpg',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    ac_status INT(11) NOT NULL DEFAULT 0 COMMENT '0=not verified, 1=active, 2=blocked',
    is_admin INT(11) NOT NULL DEFAULT 0 COMMENT '0=regular user, 1=admin',
    original_status TINYINT DEFAULT NULL
) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";

// SQL to create the 'posts' table if it doesn't exist
$sql_posts = "CREATE TABLE IF NOT EXISTS posts (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    user_id INT(11) NOT NULL,
    post_img TEXT NOT NULL,
    post_text TEXT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";

// SQL to create the 'followers' table if it doesn't exist
$sql_followers = "CREATE TABLE IF NOT EXISTS follow_list (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    follower_id INT(11) NOT NULL,
    user_id INT(11) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (follower_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";

// SQL to create the 'likes' table if it doesn't exist
$sql_likes = "CREATE TABLE IF NOT EXISTS likes (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    post_id INT(11) NOT NULL,
    user_id INT(11) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";

// SQL to create the 'comments' table if it doesn't exist
$sql_comments = "CREATE TABLE IF NOT EXISTS comments (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    post_id INT(11) NOT NULL,
    user_id INT(11) NOT NULL,
    comment TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";

// Execute table creation queries
if (!mysqli_query($db, $sql_users)) {
    echo "Error creating 'users' table: " . mysqli_error($db) . "<br>";
}

if (!mysqli_query($db, $sql_posts)) {
    echo "Error creating 'posts' table: " . mysqli_error($db) . "<br>";
}

if (!mysqli_query($db, $sql_followers)) {
    echo "Error creating 'followers' table: " . mysqli_error($db) . "<br>";
}

if (!mysqli_query($db, $sql_likes)) {
    echo "Error creating 'likes' table: " . mysqli_error($db) . "<br>";
}

if (!mysqli_query($db, $sql_comments)) {
    echo "Error creating 'likes' table: " . mysqli_error($db) . "<br>";
}

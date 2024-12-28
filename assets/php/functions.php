<?php

require_once 'config.php';


function showPage($page, $data = "")
{
    include("assets/pages/$page.php");
}
//function for follow the user
function followUser($user_id)
{
    global $db;
    $current_user = $_SESSION['userdata']['id'];

    // Check if the current user is already following the target user
    $check_query = "SELECT * FROM follow_list WHERE follower_id = $current_user AND user_id = $user_id";
    $result = mysqli_query($db, $check_query);

    if (mysqli_num_rows($result) > 0) {
        // If the user is already following, unfollow (delete the relationship)
        $unfollow_query = "DELETE FROM follow_list WHERE follower_id = $current_user AND user_id = $user_id";
        if (mysqli_query($db, $unfollow_query)) {
            return "unfollowed";  // Return "unfollowed" if successful
        }
    } else {
        // If the user is not following, follow (insert the relationship)
        $follow_query = "INSERT INTO follow_list(follower_id, user_id) VALUES ($current_user, $user_id)";
        if (mysqli_query($db, $follow_query)) {
            return "followed";  // Return "followed" if successful
        }
    }

    return "error"; // Return "error" if something went wrong
}
//function for like the user
function like($post_id)
{
    global $db;
    $current_user = $_SESSION['userdata']['id'];
    $query = "INSERT INTO likes(post_id,user_id) VALUES ($post_id, $current_user)";
    return mysqli_query($db, $query);
}

//function for commenting
function addcomment($post_id, $comment)
{
    global $db;
    $current_user = $_SESSION['userdata']['id'];
    $comment = mysqli_real_escape_string($db, $comment);
    $query = "INSERT INTO comments (post_id,user_id,comment) VALUES ($post_id, $current_user, '$comment')";
    return mysqli_query($db, $query);
}

//function for getting likes count 
function getLikes($post_id)
{
    global $db;
    $query = "SELECT * FROM likes WHERE post_id=$post_id ";
    $run = mysqli_query($db, $query);
    return mysqli_fetch_all($run, true);
}

//function for getting comment count 
function getComments($post_id)
{
    global $db;
    $query = "SELECT * FROM comments WHERE post_id=$post_id ";
    $run = mysqli_query($db, $query);
    return mysqli_fetch_all($run, true);
}


//function for unlike the user
function unlike($post_id)
{
    global $db;
    $current_user = $_SESSION['userdata']['id'];
    $query = "DELETE FROM likes WHERE user_id=$current_user && post_id=$post_id ";
    return mysqli_query($db, $query);
}

function showError($field)
{
    if (isset($_SESSION['error'])) {
        $error = $_SESSION['error'];
        if (isset($error['field']) && $field == $error['field']) {
?>
            <div style="color: #ff4f4f;display: block;font-size: 15px;">
                <?= $error['msg'] ?>
            </div>
<?php
        }
    }
}

//function for showing previous data 

function showFormData($field)
{
    if (isset($_SESSION['formdata'])) {
        $formdata = $_SESSION['formdata'];
        return $formdata[$field];
    }
}

//for checking duplicate email

function isEmailResgistered($email)
{
    global $db;
    $query = "SELECT count(*) as row FROM users WHERE email='$email'";
    $run = mysqli_query($db, $query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['row'];
}


// for checking duplicate username by other 
function isUsernameResgistered($username)
{
    global $db;
    $query = "SELECT count(*) as row FROM users WHERE username='$username'";
    $run = mysqli_query($db, $query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['row'];
}

function isUsernameResgisteredByOther($username)
{
    global $db;
    $user_id = $_SESSION['userdata']['id'];
    $query = "SELECT count(*) as row FROM users WHERE username='$username' && id!=$user_id";
    $run = mysqli_query($db, $query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['row'];
}

//for validating the signup form
function validateSignUpForm($form_data)
{
    $response = array();
    $response['status'] = true;
    if (!$form_data["password"]) {
        $response['msg'] = "password is required";
        $response['status'] = false;
        $response['field'] = 'password';
    }

    if (!$form_data["username"]) {
        $response['msg'] = "username is required";
        $response['status'] = false;
        $response['field'] = 'username';
    }

    if (!$form_data["email"]) {
        $response['msg'] = "email is required";
        $response['status'] = false;
        $response['field'] = 'email';
    }

    if (!$form_data["last_name"]) {
        $response['msg'] = "lastname is required";
        $response['status'] = false;
        $response['field'] = 'last_name';
    }
    if (!$form_data["first_name"]) {
        $response['msg'] = "firstname is required";
        $response['status'] = false;
        $response['field'] = 'first_name';
    }
    if (isUsernameResgistered($form_data["username"])) {
        $response['msg'] = "username already registered";
        $response['status'] = false;
        $response['field'] = 'username';
    }
    if (isEmailResgistered($form_data["email"])) {
        $response['msg'] = "email already registered";
        $response['status'] = false;
        $response['field'] = 'email';
    }


    return $response;
}

//for checking the user 
function checkUser($login_data)
{
    global $db;
    $username_email = mysqli_real_escape_string($db, $login_data['username_email']);
    $password = md5(mysqli_real_escape_string($db, $login_data['password']));
    // echo $username_email;
    // echo $password;
    $query = "SELECT * FROM users WHERE ( email ='$username_email' || username='$username_email') && password='$password'";
    $run = mysqli_query($db, $query);
    $data = ['status' => false, 'user' => null];
    // Fetch user if found
    if ($run && mysqli_num_rows($run) > 0) {
        $data['user'] = mysqli_fetch_assoc($run);
        $data['status'] = true;
    }
    return $data;
}

// for getting userdata by id 

function getUser($user_id)
{
    global $db;
    $query = "SELECT * FROM users WHERE id=$user_id";
    $run = mysqli_query($db, $query);
    return mysqli_fetch_assoc($run);
}
//for getting users for follow suggestions
function getFollowsuggestion()
{
    global $db;
    $current_user = $_SESSION['userdata']['id'];
    $query = "SELECT * FROM users WHERE id!='$current_user' ";
    $run = mysqli_query($db, $query);
    return mysqli_fetch_all($run, true);
}
//  for getting followers count
function getFollowers($user_id)
{
    global $db;
    $query = "SELECT * FROM follow_list WHERE user_id=$user_id ";
    $run = mysqli_query($db, $query);
    return mysqli_fetch_all($run, true);
}

function getFollowing($user_id)
{
    global $db;
    $query = "SELECT * FROM follow_list WHERE follower_id=$user_id ";
    $run = mysqli_query($db, $query);
    return mysqli_fetch_all($run, true);
}

// for filtering the suggestion list
function filterFollowSuggestion()
{
    $list = getFollowsuggestion();
    $filter_list = array();
    foreach ($list as $user) {
        if (!checkFollowStatus($user['id']) && count($filter_list) < 7) {
            $filter_list[] = $user;
        }
    }

    return $filter_list;
}
//function to check like 

function checkLikeStatus($post_id)
{
    global $db;
    $current_user = $_SESSION['userdata']['id'];
    $query = "SELECT count(*) as row FROM likes WHERE user_id=$current_user && post_id=$post_id ";
    $run = mysqli_query($db, $query);
    return mysqli_fetch_assoc($run)['row'];
}
// for checking the user is folllowed by current user or not
function checkFollowStatus($user_id)
{
    global $db;
    $current_user = $_SESSION['userdata']['id'];
    $query = "SELECT count(*) as row FROM follow_list WHERE follower_id=$current_user && user_id=$user_id";
    $run = mysqli_query($db, $query);
    return mysqli_fetch_assoc($run)['row'];
}
// for getting userdata by username
function getUserByUsername($username)
{
    global $db;
    $query = "SELECT * FROM users WHERE username='$username'";
    $run = mysqli_query($db, $query);
    return mysqli_fetch_assoc($run);
}
// get Post by id
function getPostById($user_id)
{
    global $db;
    $query = "SELECT * FROM posts WHERE user_id=$user_id ORDER BY id DESC ";
    $run = mysqli_query($db, $query);
    return mysqli_fetch_all($run, MYSQLI_ASSOC);  // Fetch as associative array
}

function getUsersByPostId($post_id)
{
    global $db;

    // Prepare the SQL query to fetch user details who liked the specific post
    $query = "
        SELECT users.id AS user_id, users.first_name, users.last_name, users.username, users.profile_pic
        FROM likes
        JOIN users ON likes.user_id = users.id
        WHERE likes.post_id = $post_id
    ";

    // Execute the query
    $result = mysqli_query($db, $query);

    // Initialize an associative array to hold the user details
    $users = [];

    // Fetch all user details as an associative array
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row; // Store each user detail in the array
    }

    return $users; // Return the associative array of users who liked the post
}


function validatePassword($password)
{
    // Define the validation criteria
    $errors = [];

    // Minimum length check (8 characters)
    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long.";
    }

    // Check for at least one uppercase letter
    if (!preg_match('/[A-Z]/', $password)) {
        $errors[] = "Password must contain at least one uppercase letter.";
    }

    // Check for at least one lowercase letter
    if (!preg_match('/[a-z]/', $password)) {
        $errors[] = "Password must contain at least one lowercase letter.";
    }

    // Check for at least one number
    if (!preg_match('/[0-9]/', $password)) {
        $errors[] = "Password must contain at least one number.";
    }

    // Check for at least one special character
    if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
        $errors[] = "Password must contain at least one special character.";
    }

    return $errors;
}

// for validating login form 

function validateLoginForm($form_data)
{
    $response = array('status' => true);

    // Check if password is provided
    if (empty($form_data["password"])) {
        $response['msg'] = "Password is required";
        $response['status'] = false;
        $response['field'] = 'password';
        return $response; // Return early if error
    }

    // Check if username/email is provided
    if (empty($form_data["username_email"])) {
        $response['msg'] = "Username/Email is required";
        $response['status'] = false;
        $response['field'] = 'username_email';
        return $response; // Return early if error
    }

    // Check user credentials
    $userCheck = checkUser($form_data);
    if (!$userCheck['status']) {
        $response['msg'] = "Password or Username/Email is incorrect";
        $response['status'] = false;
        $response['field'] = 'checkuser';
        return $response; // Return early if error
    }

    // If everything is valid, set the user data
    $response['user'] = $userCheck['user'];
    return $response;
}





//for creating new user

function createUser($data)
{
    global $db;
    $first_name = mysqli_real_escape_string($db, $data['first_name']);
    $last_name = mysqli_real_escape_string($db, $data['last_name']);
    $gender = mysqli_real_escape_string($db, $data['gender']);
    $email = mysqli_real_escape_string($db, $data['email']);
    $username = mysqli_real_escape_string($db, $data['username']);
    $password = mysqli_real_escape_string($db, $data['password']);
    $password = md5($password);

    $query = "INSERT INTO users (first_name,last_name,gender,email,username,password) VALUES
('$first_name','$last_name','$gender','$email','$username','$password')";
    return mysqli_query($db, $query);
}

//function for verify email

function verifyEmail($email)
{
    global $db;
    $query = "UPDATE users SET ac_status=1 WHERE email='$email'";
    return mysqli_query($db, $query);
}


function resetPassword($email, $password)
{
    global $db;
    $password = md5($password);
    $query = "UPDATE users SET password='$password' WHERE email='$email'";
    return mysqli_query($db, $query);
}


// for logout user

if (isset($_GET['logout'])) {
    session_destroy();
    header('location:../../');
}

//for validating update form

function validateUpdateForm($form_data, $image_data)
{
    $response = array();
    $response['status'] = true;


    if (!$form_data["username"]) {
        $response['msg'] = "username is required";
        $response['status'] = false;
        $response['field'] = 'username';
    }



    if (!$form_data["last_name"]) {
        $response['msg'] = "lastname is required";
        $response['status'] = false;
        $response['field'] = 'last_name';
    }
    if (!$form_data["first_name"]) {
        $response['msg'] = "firstname is required";
        $response['status'] = false;
        $response['field'] = 'first_name';
    }
    if (isUsernameResgisteredByOther($form_data["username"])) {
        $response['msg'] = $form_data['username'] . " is already registered";
        $response['status'] = false;
        $response['field'] = 'username';
    }

    if ($image_data['name']) {
        $image = basename($image_data['name']);
        $type = strtolower(pathinfo($image, PATHINFO_EXTENSION));
        $size = $image_data['size'] / 1000;
        if ($type != 'jpg' && $type != 'jpeg' && $type != 'png') {
            $response['msg'] = "only jpg,jpeg,png image are allowed";
            $response['status'] = false;
            $response['field'] = 'profile_pic';
        }
        if ($size > 1000) {
            $response['msg'] = "upload image less than 1 mb";
            $response['status'] = false;
            $response['field'] = 'profile_pic';
        }
    }
    return $response;
}
//function for updating profile

function updateProfile($data, $imagedata)
{
    global $db;
    $first_name = mysqli_real_escape_string($db, $data['first_name']);
    $last_name = mysqli_real_escape_string($db, $data['last_name']);
    $username = mysqli_real_escape_string($db, $data['username']);

    $profile_pic = "";
    if ($imagedata['name']) {
        $image_name = time() . basename($imagedata['name']);
        $image_dir = "../images/profiles/" . $image_name;
        move_uploaded_file($imagedata['tmp_name'], $image_dir);
        $profile_pic = ", profile_pic='$image_name'";
    }

    $query = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', username = '$username' $profile_pic
WHERE id = '" . $_SESSION['userdata']['id'] . "'";

    return mysqli_query($db, $query);
}


//for validating add post form

function validatePostImage($image_data)
{
    $response = array();
    $response['status'] = true;
    $image = basename($image_data['name']);
    $type = strtolower(pathinfo($image, PATHINFO_EXTENSION));
    if ($type != 'jpg' && $type != 'jpeg' && $type != 'png') {
        $response['msg'] = "only jpg,jpeg,png image are allowed";
        $response['status'] = false;
        $response['field'] = 'post_img';
    }
    return $response;
}


function createPost($text, $image)
{
    global $db;
    $post_text = mysqli_real_escape_string($db, $text['post_text']);
    $user_id = $_SESSION['userdata']['id'];

    if ($image['name']) {
        // Get the image file extension
        $image_extension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));

        // Check if the image is a valid type (jpg, jpeg, png, gif)

        // Assuming $image is the uploaded file array
        if (in_array($image_extension, ['jpg', 'jpeg', 'png', 'gif'])) {
            // Get EXIF data to manage orientation
            $exif = @exif_read_data($image['tmp_name']);
            $orientation = isset($exif['Orientation']) ? $exif['Orientation'] : null;

            // Create a new image from the uploaded file
            $img = null;
            switch ($image_extension) {
                case 'jpg':
                case 'jpeg':
                    $img = imagecreatefromjpeg($image['tmp_name']);
                    break;
                case 'png':
                    $img = imagecreatefrompng($image['tmp_name']);
                    break;
                case 'gif':
                    $img = imagecreatefromgif($image['tmp_name']);
                    break;
            }

            // Check if the image was created successfully
            if ($img) {
                // Adjust image orientation if needed
                if ($orientation) {
                    switch ($orientation) {
                        case 3:
                            // 180 rotate left
                            $img = imagerotate($img, 180, 0);
                            break;
                        case 6:
                            // 90 rotate right
                            $img = imagerotate($img, -90, 0);
                            break;
                        case 8:
                            // 90 rotate left
                            $img = imagerotate($img, 90, 0);
                            break;
                    }
                }

                // Generate a new name for the image
                $image_name = time() . '.webp';
                $image_dir = "../images/posts/" . $image_name;

                // Convert the image to WebP format and compress it
                imagewebp($img, $image_dir, 10); // 10 is the quality (0-100)

                // Free up memory
                imagedestroy($img);
            }
        }
    }

    // If there's no image, set $image_name to NULL
    $image_name = isset($image_name) ? $image_name : NULL;

    // Insert the post into the database
    $query = "INSERT INTO posts (user_id, post_text, post_img) VALUES ('$user_id', '$post_text', '$image_name')";
    return mysqli_query($db, $query);
}


// for getting post

function getPost()
{
    global $db;
    $query = "SELECT posts.id, posts.user_id, posts.post_img, posts.post_text, posts.created_at,
users.first_name, users.last_name, users.username, users.profile_pic
FROM posts
JOIN users ON users.id = posts.user_id
ORDER BY posts.created_at DESC"; // Order by created_at in descending order
    $run = mysqli_query($db, $query);
    return mysqli_fetch_all($run, MYSQLI_ASSOC); // Fetch as associative array
}

// for getting posts dynamically ie which we followed
function filterPosts()
{
    $list = getPost();
    $filter_list = array();
    foreach ($list as $post) {
        if (checkFollowStatus($post['user_id']) || $post['user_id'] == $_SESSION['userdata']['id']) {
            $filter_list[] = $post;
        }
    }

    return $filter_list;
}

// for getting the search result
function searchUser($param)
{

    global $db;

    // Sanitize the input to prevent SQL injection
    $param = mysqli_real_escape_string($db, $param);

    // Prepare the search query
    $searchTerm = "%" . $param . "%";  // Use wildcards for searching
    $currentUserId = $_SESSION['userdata']['id']; // Assuming the session contains the user's ID

    // Query the database for users that match the search term
    $query = "SELECT * FROM users 
    WHERE (username LIKE '$searchTerm' 
           OR first_name LIKE '$searchTerm' 
           OR last_name LIKE '$searchTerm') 
    AND ac_status IN (0, 1)";

    // Execute the query
    $result = mysqli_query($db, $query);

    // Initialize an array to store the matching users
    $users = [];

    // Check if the query was successful
    if ($result) {
        // Fetch all matching rows from the result
        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }
    } else {
        echo "Error: " . mysqli_error($db);
    }

    // Return the array of users (empty if no users are found)
    return $users;
}


?>
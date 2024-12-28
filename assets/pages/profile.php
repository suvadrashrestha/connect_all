
<?php

global $profile;
global $profile_post;
global $user;

?>
      
 
      
      
     
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
            background-color: #f4f4f4;
        }

        /* Profile Header Section */
        .profile-header {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            margin: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        .profile-info img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }
        .profile-details h2 {
            font-size: 1.5rem;
            margin-bottom: 5px;
        }
        .profile-details p {
            color: #555;
            font-size: 0.9rem;
        }

        /* Stats Section */
        .stats {
            display: flex;
            justify-content: space-around;
            width: 100%;
            margin: 15px 0;
            gap: 20px;
        }
        .stats div {
            text-align: center;
        }
        .stats h3 {
            font-size: 1.2rem;
            margin: 0;
        }
        .stats p {
            font-size: 0.8rem;
            color: #555;
        }

        /* Buttons */
        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }
        .buttons button {
            background-color: #c0a6e8;
            color: #ffffff;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9rem;
            flex: 1;
        }
        .buttons button:hover {
            background-color: #a27cd9;
        }

        /* Content Section */
        .container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .left-section,
        .right-section {
            display: none; /* Hide left and right sections in mobile view */
        }

        .main-section {
            background-color: #ffffff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden; /* Prevent overflow of child elements */
            box-sizing: border-box;
        }

        /* Post Styling */
        .card.post {
            background-color: #fff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px; /* Ensure spacing between posts */
            overflow: hidden;
            box-sizing: border-box;
        }
        .post-header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .post-header img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
            object-fit: cover;
        }
        .post-header h4 {
            font-size: 1rem;
            margin: 0;
        }
        .post-header small {
            color: #555;
            font-size: 0.8rem;
        }
        .post-reactions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
            font-size: 0.9rem;
            color: #555;
        }
        .reaction-buttons {
            display: flex;
            justify-content: space-around;
            margin-top: 10px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        .reaction-buttons button {
            font-size: 0.9rem;
            padding: 5px 10px;
            background: none;
            border: 1px solid #ddd;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }
        .reaction-buttons button:hover {
            background: #f0f0f0;
        }

        /* Following Section */
        .left-section.card.following-list {
            background-color: #ffffff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .following-list ul {
            list-style: none;
            padding-left: 0;
        }
        .following-list li {
            display: flex;
            align-items: center;
            gap: 10px; /* Add spacing between image and name */
            margin-bottom: 10px;
            font-size: 0.9rem;
        }
        .following-list img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        /* Photos Section */
        .right-section.card.photos-list {
            background-color: #ffffff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .photos-list img {
            width: 100%;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        /* Responsive Design */
        @media screen and (min-width: 768px) {
            .container {
                flex-direction: row;
                gap: 20px;
            }
            .left-section,
            .right-section {
                display: block; /* Show left and right sections in desktop view */
            }
            .left-section {
                flex: 1;
            }
            .main-section {
                flex: 2;
            }
            .right-section {
                flex: 1;
            }
        }
    </style>
</head>
<body>
    <!-- Profile Header -->
    <div class="profile-header">
        <div class="profile-info">
            <img src="https://picsum.photos/80" alt="Profile Picture">
            <div class="profile-details">
                <h2>Pawan Dangi</h2>
                <p>@Pawan</p>
            </div>
        </div>
        <div class="stats">
            <div>
                <h3>88</h3>
                <p>Posts</p>
            </div>
            <div>
                <h3>88</h3>
                <p>Following</p>
            </div>
            <div>
                <h3>88</h3>
                <p>Followers</p>
            </div>
        </div>
        <div class="buttons">
            <button>Follow</button>
            <button>Edit</button>
        </div>
    </div>

    <!-- Content Section -->
    <div class="container">
        <!-- Following Section -->
        <div class="left-section card following-list">
            <h3>Following</h3>
            <ul>
                <li>
                    <img src="https://via.placeholder.com/40" alt="Jane Smith">
                    Jane Smith
                </li>
                <li>
                    <img src="https://via.placeholder.com/40" alt="Michael Johnson">
                    Michael Johnson
                </li>
                <li>
                    <img src="https://via.placeholder.com/40" alt="Chris Evans">
                    Chris Evans
                </li>
                <li>
                    <img src="https://via.placeholder.com/40" alt="Emily Davis">
                    Emily Davis
                </li>
            </ul>
        </div>

        <!-- Main Section -->
        <div class="main-section">
            <!-- Posts -->
            <div class="card post">
                <div class="post-header">
                    <img src="https://via.placeholder.com/50" alt="User Image">
                    <div>
                        <h4>Pawan Dangi</h4>
                        <small>Posted 1 hour ago</small>
                    </div>
                </div>
                <p>Hello, it's me Binda. I am new to it.</p>
                <div class="post-reactions">
                    <span>❤️ 1 like</span>
                    <span>1 comment</span>
                </div>
                <div class="reaction-buttons">
                    <button>❤️ Love</button>
                    <button>💬 Comment</button>
                </div>
            </div>
            <div class="card post">
                <div class="post-header">
                    <img src="https://via.placeholder.com/50" alt="User Image">
                    <div>
                        <h4>Pawan Dangi</h4>
                        <small>Posted 3 hours ago</small>
                    </div>
                </div>
                <p>Excited to be part of this community!</p>
                <div class="post-reactions">
                    <span>❤️ 5 likes</span>
                    <span>3 comments</span>
                </div>
                <div class="reaction-buttons">
                    <button>❤️ Love</button>
                    <button>💬 Comment</button>
                </div>
            </div>
        </div>

        <!-- Photos Section -->
        <div class="right-section card photos-list">
            <h3>Photos</h3>
            <img src="https://picsum.photos/200" alt="Photo 1">
            <img src="https://picsum.photos/201" alt="Photo 2">
            <img src="https://picsum.photos/202" alt="Photo 3">
        </div>
    </div>
</body>


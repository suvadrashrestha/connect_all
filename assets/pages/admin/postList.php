<?php $posts = getPosts();
?>
<?php
global $user;
global $follow_suggestions;
?>
<div class="container">

    <?php
    include "sidebar.php";
    ?>

    <!-- Main Content -->
    <main class="content">
      
        <!-- Second Row: Table -->
        <div class="user-table">
            <h3>List of Posts</h3>
            <table>
                <thead>
                    <tr>
                        <th> S/N</th>
                        <th>Image</th>
                        <th>Description</th>

                        <th>Username</th>
                        <th>Likes</th>
                        <th>Comments </th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($posts as $key => $post): ?>
                        <?php
                        $likes = getLikes($post['id']);
                        $comments = getComments($post['id']);

                        ?>
                        <!-- modal for like -->
                        <div id="modal_user_like_<?= $post['id'] ?>" class="modal">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3>Users</h3>
                                    <span style="cursor:pointer" data-post-id="<?= $post['id'] ?>" class="close"
                                        id="closeModal">&times;</span>
                                </div>
                                <div id="modal_content_<?= $post['id'] ?>">

                                </div>
                            </div>
                        </div>
                        <div id="modal_comment_<?= $post['id'] ?>" class="modal">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <?php
                                    $user_name = getUser($post['user_id'])
                                    ?>
                                    <h3><?= ucfirst($user_name['username']) ?>'s post</h3>
                                    <span style="cursor:pointer" class="close comment_close"
                                        id="closeCommentModal<?= $post['id'] ?>">&times;</span>
                                </div>

                                <div class="commentScroll" id="comment_container_<?= $post['id'] ?>"
                                    style="max-height:60vh;overflow-y:scroll; overflow-wrap:anywhere;">
                                    <?php
                                    $comments = getComments($post['id']);
                                    if (count($comments) < 1) {
                                    ?>
                                        <p>
                                            No comments
                                        </p>
                                    <?php
                                    }
                                    foreach ($comments as $comment) {
                                        $comment_user = getUser($comment['user_id']);
                                    ?> <div style="display: flex;gap:10px ;margin-bottom:10px; ">
                                            <a href="?u=<?= $comment_user['username'] ?>">

                                                <img class="image" src="assets/images/profiles/<?= $comment_user['profile_pic'] ?>">
                                            </a>
                                            <div style="background-color:#e6f1ff; padding:10px; border-radius:10px;width:70%">
                                                <span><b>
                                                        <a style="text-decoration:none;color:black"
                                                            href="?u=<?= $comment_user['username'] ?> ">
                                                            <?= ucfirst($comment_user['username']) ?>
                                                        </a>
                                                    </b></span>
                                                <span style="display:block"><?= $comment['comment'] ?></span>
                                            </div>
                                            <a class="delete deleteComment" comment_id="<?=$comment['id']?>">Delete</a>
                                        </div>
                                    <?php
                                    }
                                    ?>


                                </div>
                            </div>
                        </div>
                        <tr>
                            <td><?= htmlspecialchars($key + 1) ?></td>
                            <td>
                                <?php
                                if ($post['post_img']) {
                                ?>
                                    <div class="profile-post" style="height:150px">
                                        <img style="height:150px; object-fit:contain" loading='lazy' id='myImage' src="assets/images/posts/<?= $post['post_img'] ?>" alt="Connect All"
                                            class="post-image" />
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <p>----</p>
                                <?php
                                }
                                ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(!empty($post['post_text']) ? $post['post_text'] : '-----') ?>
                            </td>
                            <td> <?= ucfirst($post['username']) ?> </td>

                            <td> <span style="cursor:pointer" data-post-id="<?= $post['id'] ?>" class="post_like_btn_2"
                                    id="like_<?= $post['id'] ?>"> <?php 
                                    // echo "<pre>" ;
                                    //  print_r($likes);
                                    //  echo "</pre>" ; 
                                     echo count($likes);
                                      ?></span></td>
                            <td>
                                <p style="padding-right:20px; cursor:pointer" data-post-id="<?= $post['id'] ?>" class="hover_comment" id="comment_<?= $post['id'] ?>">
                                    <?= count($comments) ?>
                                </p>
                            </td>
                            </td>
                            <td>
                                <a class="delete deletePost" username="<?= ucfirst($post['username']) ?>"
                                    post_id="<?= htmlspecialchars($post['id']) ?>">Delete </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>


    </main>
</div>


<script>
    document.querySelectorAll('.hover_comment').forEach(button => {
        button.addEventListener('click', async function() {
            
            const commentId = this.getAttribute('data-post-id');
            const comment_modal = document.getElementById('modal_comment_' + commentId);
            comment_modal.style.display = "flex";
            const close_comment_modal = document.getElementById("closeCommentModal" + commentId);
            console.log(close_comment_modal);
            close_comment_modal.onclick = function() {
                comment_modal.style.display = "none";
            }
        })
    })
    document.querySelectorAll('.post_like_btn_2').forEach(button => {
        button.addEventListener('click', async function() {
            const postId = this.getAttribute('data-post-id');
            const modal = document.getElementById('modal_user_like_' + postId);

            const url = "assets/php/ajax.php?userlikes";

            try {
                const response = await fetch(url, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({
                        post_id: postId
                    }), // Send the post ID
                });
                const data = await response.json();

                const modalContent = document.getElementById('modal_content_' + postId);
                modalContent.innerHTML = ''; // Clear previous user elements
                if (data.data.length > 0) {
                    console.log("data",data.data);
                    data.data.forEach(user => {
                        const userElement = document.createElement('div');
                        userElement.className = 'follow'; // Add any necessary classes
                        userElement.style.padding = '5px 10px';
                        userElement.style.marginBottom = '15px';
                        userElement.innerHTML = `
          <div style="display: flex; align-items: center; gap: 10px; flex: 4">
              <img class="image" src="assets/images/profiles/${user.profile_pic}" />
              <div>
                          <a href="?u=${user.username}" style="text-decoration:none">
                <span class="name" style="display: block; margin-top: 2.5px; color: gray">
                  ${user.first_name} ${user.last_name}
                </span>
                 </a>
                <span class="email" style="display: block; margin-top: -5px; color: gray">
                  ${user.username}
                </span>
                </div>
          </div>
         
          </div>
        `;
                        modalContent.appendChild(userElement);
                    })
                }
                modal.style.display = 'flex'; // Show the modal
            } catch (error) {
                console.log("error  getting  user likes by id", error);
            }

        });
    });

    document.querySelectorAll('#closeModal').forEach(button => {
        button.addEventListener('click', function() {
            const postId = this.getAttribute('data-post-id');
            const modal = document.getElementById('modal_user_like_' + postId);
            modal.style.display = 'none'; // Close the modal
        });
    });

    document.addEventListener("DOMContentLoaded", () => {
        const deleteButtons = document.getElementsByClassName("deletePost");

        Array.from(deleteButtons).forEach(button => {
            button.addEventListener("click", (event) => {
                event.preventDefault(); // Prevent default link behavior
                const postId = button.getAttribute("post_id");
                const username = button.getAttribute("username");
               

                const confirmation = confirm( `Are you sure you want to delete ${username}'s this post ?`);

                if (confirmation) {
                    window.location.href =
                        `assets/php/adminActions.php?post_id=${postId}&deletePost`;
                }
            });
        });
    });

    document.addEventListener("DOMContentLoaded", () => {
        const deleteButtons = document.getElementsByClassName("deleteComment");

        Array.from(deleteButtons).forEach(button => {
            button.addEventListener("click", (event) => {
                event.preventDefault(); // Prevent default link behavior
                const comment_id = button.getAttribute("comment_id");
                const confirmation = confirm( `Are you sure you want to delete  this comment ?`);

                if (confirmation) {
                    window.location.href =
                        `assets/php/adminActions.php?comment_id=${comment_id}&deleteComment`;
                }
            });
        });
    });
</script>
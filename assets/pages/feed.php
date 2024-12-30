<?php
global $user;
global $posts;
global $follow_suggestions;
?>


<section class="empty-section">
  <section class="user-info">
    <div class="feedSide">
      <a href="?" style="text-decoration: none;">
      <div  style="display: flex; align-items: center; gap: 10px; flex: 4;cursor:pointer">
        <img style=" object-fit:cover" loading="lazy" class="image" src="assets/images/icon/home.png" />
        <div>
          <span style="display: block; font-size: 18px;font-weight: bold; color:black; ">
            Home
          </span>
        </div>
      </div>
      </a>
      <a href="?u=<?= $user['username'] ?>" style="text-decoration:none; color:black">
        <div style="display: flex; align-items: center; gap: 10px; flex: 4">
          <img style="border: 1px solid gray; object-fit:cover" loading="lazy" class="image" src="assets/images/profiles/<?= $user['profile_pic'] ?>" />
          <div>
            <span style="display: block; font-size: 18px;font-weight: bold;">
              Profile
            </span>
          </div>
        </div>
      </a>
      <div id="openPostModal" style="display: flex; align-items: center; gap: 10px; flex: 4;cursor:pointer">
        <img style="border: 1px solid blue; object-fit:cover" loading="lazy" class="image" src="assets/images/icon/createicon.png" />
        <div>
          <span style="display: block; font-size: 18px;font-weight: bold;">
            Create
          </span>
        </div>
      </div>
    </div>
  </section>

  <!-- post  -->
  <section class="profile">
    <div class="newPost">
      <img style="border: 1px solid gray; object-fit:cover" loading="lazy" class="image" src="assets/images/profiles/<?= $user['profile_pic'] ?>" />
      <button class="photo_button" id="openModal"> What's on your mind?</button>
    </div>

    <!-- post one -->
    <?php
    showError('post_img');
    if (count($posts) < 1) {
      echo "<p style='padding: 20px'> Follow someone or Upload your first post </p>";
    }
    foreach ($posts as $post) {
      include 'parts/posts.php';
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


      <!-- modal for comment -->
      <div id="modal_comment_<?= $post['id'] ?>" class="modal">
        <div class="modal-content">
          <div class="modal-header">
            <?php
            $user_name = getUser($post['user_id'])
            ?>
            <h3><?= ucfirst($user_name['first_name']) ?>'s post</h3>
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
                Be the first one to comment
              </p>
            <?php
            }
            foreach ($comments as $comment) {
              $comment_user = getUser($comment['user_id']);
            ?> <div style="display: flex;gap:10px ;margin-bottom:10px; ">
                <a href="?u=<?= $comment_user['username'] ?>">

                  <img class="image" src="assets/images/profiles/<?= $comment_user['profile_pic'] ?>">
                </a>
                <div style="background-color:#e6f1ff; padding:10px; border-radius:10px;width:100%">
                  <span><b>
                      <a style="text-decoration:none;color:black"
                        href="?u=<?= $comment_user['username'] ?> ">
                        <?= ucfirst($comment_user['username']) ?>
                      </a>
                    </b></span>
                  <span style="display:block"><?= $comment['comment'] ?></span>
                </div>
              </div>
            <?php
            }
            ?>


          </div>

          <div style="display:flex; gap:10px; align-items:center">
            <textarea id="comment_value_<?= $post['id'] ?>"
              style="width: 90%; padding:10px ; border-radius:10px" placeholder="write a comment"></textarea>
            <button style="height:40px" class="comment_btn" data-post-id="<?= $post['id'] ?>">send</button>
          </div>


        </div>
      </div>
    <?php
    }
    ?>
  </section>

  <!-- follow suggestion section -->
  <section class="side-bar" style="flex: 1.5; padding-top: 20px ;">

    <h4 style="margin-bottom: 20px;">You Can Follow Them</h4>
    <div style="overflow-y:auto; padding-top:5px;">
      <!-- one person -->
      <?php
      foreach ($follow_suggestions as $suser) {
        include 'parts/folowsuggestion.php';
      }

      if (count($follow_suggestions) < 1) {
        echo "<p style='padding: 0px 20px'> No follow suggestions </p>";
      }
      ?>

    </div>

  </section>
</section>



<?php
include 'parts/postmodal.php';
?>


<!-- modal for likes showing  -->



<!-- 
<script>
  document.querySelectorAll('.hover_comment').forEach(button => {
    button.addEventListener('click', async function() {
      console.log("hello");
      const commentId = this.getAttribute('data-post-id');
      const comment_modal = document.getElementById('modal_comment_' + commentId);
      comment_modal.style.display = "flex";
      const close_comment_modal = document.getElementById("closeCommentModal" + commentId);
      console.log(close_comment_modal);
      close_comment_modal.onclick = function() {
        console.log("ewewd");
        comment_modal.style.display = "none";
      }
    })
  })
  document.querySelectorAll('.post_like_btn').forEach(button => {
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

        console.log("user", data)
        const modalContent = document.getElementById('modal_content_' + postId);
        modalContent.innerHTML = ''; // Clear previous user elements
        if (data.data.length > 0) {
          data.data.forEach(user => {
            const userElement = document.createElement('div');
            userElement.className = 'follow'; // Add any necessary classes
            userElement.style.padding = '5px 10px';
            userElement.style.marginBottom = '15px';
            const showButton = user.user_id !== data
              .current_user // Replace 'currentUserID' with your actual variable holding the current user's ID
            console.log(data.current_user)
            console.log("id", user.user_id)
            userElement.innerHTML = `
          <div style="display: flex; align-items: center; gap: 10px; flex: 4">
            <a href="?u=${user.username}" style="text-decoration:none">
              <img class="image" src="assets/images/profiles/${user.profile_pic}" />
              <div>
                <span class="name" style="display: block; margin-top: 2.5px; color: gray">
                  ${user.first_name} ${user.last_name}
                </span>
                <span class="email" style="display: block; margin-top: -5px; color: gray">
                  ${user.username}
                </span>
            </a>
          </div>
         
          </div>
            ${showButton ? `<button style="flex:1" class="followbtn" data-user-id=${user.user_id}>${user.follow_status == 1 ? 'Unfollow' : 'Follow'}</button>` : ''}
        `;
            modalContent.appendChild(userElement);
          })
        } else {
          modalContent.innerHTML = 'Be the first one to like'
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
</script> -->
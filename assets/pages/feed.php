
<?php 
global $user;
global $posts;
?>
<section class="empty-section">
  <section class="user-info">
    <div class="follow" >
      <div style="display: flex; align-items: center; gap: 10px; flex: 4">
        <img class="image" src="assets/images/profiles/<?=$user['profile_pic']?>" />
        <div>
          <span style="display: block; font: size: 16px;"  >
            <?=ucfirst($user['first_name'])?>  <?=ucfirst($user['last_name'])?> 
          </span>
          <span style="display: block;  font-size:16px ">
          <?=$user['username']?> 
          </span>
        </div>
      </div>
    </div>
  </section>

  <!-- post  -->
   <section class="profile">
    <div  class="newPost" >
    <img class="image" src="assets/images/profiles/<?=$user['profile_pic']?>" />
    <button class="photo_button" id="openModal"> What's on your mind?</button>
    </div>

    <!-- post one -->
     <?php 
     showError('post_img');
      foreach($posts as $post){
        ?>
         <div  class="posts" >
          <div class="profile-bar">
        <div style="display: flex; gap: 10px; align-items: center">
          <img
            style="border: 1px solid gray"
            src="assets/images/profiles/<?=$post['profile_pic']?>"
            width="40px"
            height="40px"
            class="profile-pic"
          />
          <h5 id="name"><?=ucfirst($post['first_name'])?> <?=ucfirst($post['last_name'])?></h5>
        </div>
        <div>
          <h1>...</h1>
        </div>
      </div>

      <!-- end of profile-bar -->

      <div class="profile-body" style="width: 100%; padding:0px 10px">
        <p style="line-height: 25px">
        <?=ucfirst($post['post_text'])?>
         </p>
      </div>

      <!-- end of description -->

      <?php
       if($post['post_img']){
        ?>
        <div class="profile-post" style="width: 100% ;">
        <img
          src="assets/images/posts/<?=$post['post_img']?>"
          alt="Connect All"
          class="post-image"
          width:100%
        />
      </div>
         <?php
       }
      ?>
    <div style="padding: 10px 20px">
    <img
          src="assets/images/icon/reaction_icon.jpg"
          alt="love"
          width="20px"
          height="20px"
        />
  </div>

    <div style="border-bottom:1px solid gray; margin:0px 20px; height:0.5px"> </div>

      <div  style="display:flex; justify-content:space-around;width: 100%; padding: 10px">
        <div  style="cursor:pointer">
        <img
          src="assets/images/icon/like_icon.jpg"
          alt="love"
          width="15px"
          height="15px"
        />
        <span>Like </span>  </div>
        <div style="cursor:pointer">
        <img
          src="assets/images/icon/comment_icon.jpg"
          alt="love"
          width="15px"
          height="15px"
        />
        <span>Comment </span>  </div>
        
        

      </div>

    
      </div>
    </div>
        <?php
      }
     
     ?>
   
  </section>

  <!-- follow suggestion section -->
  <section class="side-bar" style="flex: 1.5; padding-top: 20px">
    <h4 style="margin-bottom: 20px">You Can Follow Them</h4>

    <!-- one person -->
    <div class="follow" style="padding: 5px 10px; margin-bottom: 15px">
      <div style="display: flex; align-items: center; gap: 10px; flex: 4">
        <img class="image" src="assets/images/logo-color.png" />
        <div>
          <span
            class="name"
            style="display: block; margin-top: 2.5px; color: gray"
          >
            Bill cxzczxGatesaw
          </span>
          <span
            class="email"
            style="display: block; margin-top: -5px; color: gray"
          >
            @\zx\zx\zx\zx\zxsfunnybill
          </span>
        </div>
      </div>
      <button style="flex: 1">Follow</button>
    </div>

        <!-- one person -->
        <div class="follow" style="padding: 5px 10px; margin-bottom: 15px">
      <div style="display: flex; align-items: center; gap: 10px; flex: 4">
        <img class="image" src="assets/images/logo-color.png" />
        <div>
          <span
            class="name"
            style="display: block; margin-top: 2.5px; color: gray"
          >
            Bill cxzczxGatesaw
          </span>
          <span
            class="email"
            style="display: block; margin-top: -5px; color: gray"
          >
            @\zx\zx\zx\zx\zxsfunnybill
          </span>
        </div>
      </div>
      <button style="flex: 1">Follow</button>
    </div>

   
 

<!-- Modal structure -->
<div id="createPostModal" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h3>Create Post</h3>
      <span class="close" id="closeModal">&times;</span>
    </div>

    <form
      method="post"
      action="assets/php/actions.php?addpost"
      enctype="multipart/form-data"
    >
      <textarea
        id="postText"
        rows="4"
        name="post_text"
        class="post-textarea"
        placeholder="What's on your mind?"
        oninput="checkFields()"
      ></textarea>

      <!-- Image preview section (images will appear below the text area) -->
      <div id="image-preview-container" class="post-image-preview"></div>
      <!-- Add More button -->

      <div class="post-actions">
        <!-- Image upload section -->
        <div class="image-upload">
          <label for="file-input">
            <img
              src="assets/images/icon/photo_icon.jpg"
              width="45px"
              height="45px"
            />
          </label>
          <input
            id="file-input"
            type="file"
            name="post_img"
            accept="image/*"
            multiple
            onchange="previewImages(event); checkFields()"
          />
        </div>

        <!-- Submit button -->
        <button type="submit" id="postBtn" class="post-submit"  disabled>Post</button>
      </div>
    </form>
  </div>
</div>

<script>
  // Get modal element and open/close buttons
  const modal = document.getElementById("createPostModal");
  const openModalBtn = document.getElementById("openModal");
  const closeModalBtn = document.getElementById("closeModal");
  const fileInput = document.getElementById("file-input");
  const imagePreviewContainer = document.getElementById(
    "image-preview-container"
  );
  const postBtn = document.getElementById("postBtn");
  const postText = document.getElementById("postText");

  // Function to open the modal
  openModalBtn.onclick = function () {
    modal.style.display = "flex";
    fileInput.value = ""; // Reset file input
    imagePreviewContainer.innerHTML = ""; // Clear preview
  };

  // Function to close the modal
  closeModalBtn.onclick = function () {
    modal.style.display = "none";
  };

  // Close the modal if clicked outside the modal content
  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  };
  function checkFields() {
    const textEntered = postText.value.trim().length > 0;
    const imageSelected = fileInput.files.length > 0;

    // Enable the Post button if there's text or an image selected
    if (textEntered || imageSelected) {
    postBtn.disabled = false;
  } else {
    postBtn.disabled = true;
  }
  }


  // Function to preview the selected images
  function previewImages(event) {
    const files = event.target.files;

    // Check if files are selected
    if (files.length > 0) {
      // Append new images to the preview container
      for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const reader = new FileReader();
        reader.onload = function (e) {
          const img = document.createElement("img");
          img.src = e.target.result;
          imagePreviewContainer.appendChild(img);
        };
        reader.readAsDataURL(file); // Read the file as a Data URL
      }
    }
  }
</script>



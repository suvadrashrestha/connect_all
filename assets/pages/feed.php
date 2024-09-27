
<?php 
global $user
?>
<section class="empty-section">
  <section class="user-info">
  
  
   <!-- one person -->
    <div class="follow" style="padding: 20px; margin-bottom: 15px">
      <div style="display: flex; align-items: center; gap: 10px; flex: 4">
        <img class="image" src="assets/images/profiles/<?=$user['profile_pic']?>" />
        <div>
          <span
           
            style="display: block; font: size: 16px;"
          >
            <?=ucfirst($user['first_name'])?>  <?=ucfirst($user['last_name'])?> 
          </span>
          <span
         
            style="display: block;  font-size:16px "
          >
          <?=$user['username']?> 
          </span>
        </div>
      </div>
    
    </div>

  
  </section>

  <!-- post  -->

  <section class="profile" style="flex: 2; box-shadow: 2px 2px 4px #888888">
    <!-- post one -->
    <div>
      <div class="profile-bar">
        <div style="display: flex; gap: 10px; align-items: center">
          <img
            style="border: 1px solid gray"
            src="assets/images/logo-color.png"
            width="40px"
            height="40px"
            class="profile-pic"
          />

          <h5 id="name">Monu giri</h5>
        </div>
        <div>
          <h1>...</h1>
        </div>
      </div>

      <!-- end of profile-bar -->

      <div class="profile-body" style="width: 100%">
        <p style="line-height: 25px">
          This is a wider card with supportingtext below asa natural lead-in to
          additional content.This connect is a little bit longer.
        </p>
      </div>

      <!-- end of description -->
      <div class="profile-post" style="width: 100%">
        <img
          src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b6/Image_created_with_a_mobile_phone.png/220px-Image_created_with_a_mobile_phone.png"
          alt="Connect All"
          class="post-image"
          width:100%
        />
      </div>

      <div class="profile-likes" style="width: 100%; margin-bottom: 10px">
        <img
          src="assets/images/like.png"
          alt="love"
          width="25px"
          height="25px"
        />
        <img
          src="assets/images/logo-color.png"
          alt="message"
          width="30px"
          height="30px"
        />
      </div>

      <div
        class="profile-comment"
        style="
          width: 95%;
          display: flex;
          padding: 0 5px;
          box-sizing: content-box;
          justify-content: space-between;
        "
      >
        <textarea
          id="comment-text"
          class="styled-textarea"
          placeholder="Add a comment "
          style="
            width: 90%;
            background-color: #e0e7ec;
            border-radius: 20px;
            padding: 0px 10px;
          "
        ></textarea>
        <div>
          <button class="pro-post" style="color: white; padding: 5px 10px">
            Post
          </button>
        </div>
      </div>

      <div
        style="width: 100%; border: 5px solid #eeeeee; margin-top: 20px"
      ></div>
    </div>
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

    <!-- other person -->
    <div class="follow">
      <div style="display: flex; align-items: center; gap: 10px; flex: 4">
        <img class="image" src="assets/images/logo-color.png" />
        <div>
          <span class="name"> Bill cxzczxGatesaw </span>
          <span class="email"> @\zx\zx\zx\zx\zxsfunnybill </span>
        </div>
      </div>
      <button style="flex: 1">Follow</button>
    </div>
  </section>
</section>

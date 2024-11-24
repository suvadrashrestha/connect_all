
<?php

global $profile;
global $profile_post;
global $user;

?>
   
    <div class="container col-9 rounded-0">
      <div class="col-12 rounded p-4 mt-4 d-flex gap-5">
        <div class="col-4 d-flex justify-content-end align-items-start">
          <img
            src="assets/images/profiles/<?=$profile['profile_pic']?>"
            class="img-thumbnail rounded-circle my-3"
            style="height: 170px"
            alt="..."
          />
        </div>
        <div class="col-8">
          <div class="d-flex flex-column">
            <div class="d-flex gap-5 align-items-center">
              <span style="font-size: xx-large"><?=$profile['first_name']?> <?=$profile['last_name']?></span>
              <div class="dropdown">
                <span
                  class=""
                  style="font-size: xx-large"
                  type="button"
                  id="dropdownMenuButton1"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                  ><i class="bi bi-three-dots"></i>
                </span>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  <li>
                    <a class="dropdown-item" href="#"
                      ><i class="bi bi-chat-fill"></i> Message</a
                    >
                  </li>
                  <li>
                    <a class="dropdown-item" href="#"
                      ><i class="bi bi-x-circle-fill"></i> Block</a
                    >
                  </li>
                </ul>
              </div>
            </div>
            <span style="font-size: larger" class="text-secondary"
              ><?=$profile['username']?></span
            >
            <div class="d-flex gap-2 align-items-center my-3">
              <a class="btn btn-sm btn-primary"
                ><i class="bi bi-file-post-fill"></i> <?=count($profile_post)?>Posts</a
              >
              <a class="btn btn-sm btn-primary"
                ><i class="bi bi-people-fill"></i> <?=count($profile['followers'])?> Followers</a
              >
              <a class="btn btn-sm btn-primary"
                ><i class="bi bi-person-fill"></i> <?=count($profile['following'])?> Following</a
              >
            </div>

<?php

if(!($user['id']==$profile['id'])){
?>
   <div class="d-flex gap-2 align-items-center my-1">
    <?php
     if (checkFollowStatus($profile['id'])){
      ?>
      <button class="btn btn-sm btn-danger unfollowbtn" data-user-id='<?=$profile['id']?>'>Unfollow</button>
      <?php     
     }
     else{
      ?>
      <button class="btn btn-sm btn-primary followbtn" data-user-id='<?=$profile['id']?>'>Follow</button>
      <?php
     }
    ?>
            </div>
          <?php
 
  ?>
<?php
}
?>

         
          </div>
        </div>
      </div>
      <h3 class="border-bottom">Posts</h3>
      <?php
      if(count($profile_post)<1){
        echo "<p style='padding: 20px'> No posts </p>";
     }
      ?>
      <div class="gallery d-flex flex-wrap justify-content-center gap-2 mb-4">
        <?php 
           foreach($profile_post as $post){
            if($post['post_img']){
            ?>
            
            <img src="assets/images/posts/<?=$post['post_img']?>" width="300px" class="rounded" />
            <?php
            }
            else{
              ?>
              <span> <?=$post['post_text']?> </span>
                <?php
            }
           }
        ?> 
      </div>
    </div>

    <!-- Button trigger modal -->
    <button
      type="button"
      class="btn btn-primary"
      data-bs-toggle="modal"
      data-bs-target="#exampleModal"
    >
      Launch demo modal
    </button>

    <!-- Modal -->
    <div
      class="modal fade"
      id="exampleModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-body d-flex p-0">
            <div class="col-8">
              <img src="img/post2.jpg" class="w-100 rounded-start" />
            </div>

            <div class="col-4 d-flex flex-column">
              <div class="d-flex align-items-center p-2 border-bottom">
                <div>
                  <img
                    src="./img/profile.jpg"
                    alt=""
                    height="50"
                    class="rounded-circle border"
                  />
                </div>
                <div>&nbsp;&nbsp;&nbsp;</div>
                <div
                  class="d-flex flex-column justify-content-start align-items-center"
                >
                  <h6 style="margin: 0px">Monu Giri</h6>
                  <p style="margin: 0px" class="text-muted">@oyeitsmg</p>
                </div>
              </div>
              <div
                class="flex-fill align-self-stretch overflow-auto"
                style="height: 100px"
              >
                <div class="d-flex align-items-center p-2">
                  <div>
                    <img
                      src="./img/profile2.jpg"
                      alt=""
                      height="40"
                      class="rounded-circle border"
                    />
                  </div>
                  <div>&nbsp;&nbsp;&nbsp;</div>
                  <div
                    class="d-flex flex-column justify-content-start align-items-start"
                  >
                    <h6 style="margin: 0px">@osilva</h6>
                    <p style="margin: 0px" class="text-muted">
                      its nice pic very good
                    </p>
                  </div>
                </div>

                <div class="d-flex align-items-center p-2">
                  <div>
                    <img
                      src="./img/profile2.jpg"
                      alt=""
                      height="40"
                      class="rounded-circle border"
                    />
                  </div>
                  <div>&nbsp;&nbsp;&nbsp;</div>
                  <div
                    class="d-flex flex-column justify-content-start align-items-start"
                  >
                    <h6 style="margin: 0px">@osilva</h6>
                    <p style="margin: 0px" class="text-muted">
                      its nice pic very good
                    </p>
                  </div>
                </div>

                <div class="d-flex align-items-center p-2">
                  <div>
                    <img
                      src="./img/profile2.jpg"
                      alt=""
                      height="40"
                      class="rounded-circle border"
                    />
                  </div>
                  <div>&nbsp;&nbsp;&nbsp;</div>
                  <div
                    class="d-flex flex-column justify-content-start align-items-start"
                  >
                    <h6 style="margin: 0px">@osilva</h6>
                    <p style="margin: 0px" class="text-muted">
                      its nice pic very good
                    </p>
                  </div>
                </div>

                <div class="d-flex align-items-center p-2">
                  <div>
                    <img
                      src="./img/profile2.jpg"
                      alt=""
                      height="40"
                      class="rounded-circle border"
                    />
                  </div>
                  <div>&nbsp;&nbsp;&nbsp;</div>
                  <div
                    class="d-flex flex-column justify-content-start align-items-start"
                  >
                    <h6 style="margin: 0px">@osilva</h6>
                    <p style="margin: 0px" class="text-muted">
                      its nice pic very good
                    </p>
                  </div>
                </div>
              </div>
              <div class="input-group p-2 border-top">
                <input
                  type="text"
                  class="form-control rounded-0 border-0"
                  placeholder="say something.."
                  aria-label="Recipient's username"
                  aria-describedby="button-addon2"
                />
                <button
                  class="btn btn-outline-primary rounded-0 border-0"
                  type="button"
                  id="button-addon2"
                >
                  Post
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  
    <script>

// for unfolloeing the user 
document.querySelectorAll('.unfollowbtn').forEach(function(button) {
    button.addEventListener('click', function() {
        var user_id_v = this.getAttribute('data-user-id');

        // Prepare the URL and data
        const url = 'assets/php/ajax.php?unfollow';
        
        var button= this;
        button.setAttribute('disabled', true); // Disable the button
        const data = new URLSearchParams();
        data.append('user_id', user_id_v);
        console.log(data)
        // Use the fetch API to make the request
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: data
        })
        .then(response => {
          // console.log(response.text());
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text(); // Parse the JSON from the response
        })
        .then(responseData => {
          const cleanedData = responseData.trim();
          const jsonData = JSON.parse(cleanedData);
          console.log(jsonData); 
            if (jsonData.status) {
              button.setAttribute('data-user-id', 0); // Set the data-user-id attribute
              button.textContent = 'Unfollowed'; // Change the button text
              button.style.backgroundColor="gray";
            } else {
                // Handle failure response
                button.setAttribute('disabled', false); // Disable the button

                console.log("Failed to follow user.");
            }
        })
        .catch(error => {
            console.log('There was a problem with the fetch operation:', error); // Handle errors
        });
    });
});


// for follow button

document.querySelectorAll('.followbtn').forEach(function(button) {
    button.addEventListener('click', function() {
        var user_id_v = this.getAttribute('data-user-id');

        // Prepare the URL and data
        const url = 'assets/php/ajax.php?follow';
        
        var button= this;
        button.setAttribute('disabled', true); // Disable the button
        const data = new URLSearchParams();
        data.append('user_id', user_id_v);
        console.log(data)
        // Use the fetch API to make the request
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: data
        })
        .then(response => {
          // console.log(response.text());
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text(); // Parse the JSON from the response
        })
        .then(responseData => {
          const cleanedData = responseData.trim();
          const jsonData = JSON.parse(cleanedData);
          console.log(jsonData); 
            if (jsonData.status) {
              button.setAttribute('data-user-id', 0); // Set the data-user-id attribute
              button.textContent = 'Followed'; // Change the button text
              button.style.backgroundColor="gray";
            } else {
                // Handle failure response
                button.setAttribute('disabled', false); // Disable the button

                console.log("Failed to follow user.");
            }
        })
        .catch(error => {
            console.log('There was a problem with the fetch operation:', error); // Handle errors
        });
    });
});


      </script>
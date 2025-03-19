// for liking the post

document.querySelectorAll(".like_btn").forEach(function (imgTag) {
  imgTag.addEventListener("click", async function () {
    var post_id = this.getAttribute("data-post-id");
    var info = this.getAttribute("info");
    let imgTag;
    if (info) {

       imgTag = document.getElementById(`likeImage_${post_id}`);
    } else {
       imgTag = document.getElementById(`likeImg_${post_id}`);
    }
    const url = "assets/php/ajax.php?like";

    // Disable the like button
    imgTag.setAttribute("disabled", true);

    try {
      const response = await fetch(url, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ post_id: post_id }),
      });
      const data = await response.json();
      const postImage = document.getElementById(`postImage_${post_id}`);
      const likeCount = document.getElementById(`like_${post_id}`);

      if (data.is_liked) {
        imgTag.setAttribute("src", "assets/images/icon/reaction_icon.jpg");
        postImage.style.display = "block";
        likeCount.innerText = data.likes.length + " like";
      } else {
        imgTag.setAttribute("src", "assets/images/icon/unfill_heart_icon.jpg");
        postImage.style.display = "none";
        likeCount.innerText = data.likes.length + " like";
      }
    } catch (error) {
      console.log(error);
    } finally {
      // Re-enable the like button after the request is complete
      imgTag.removeAttribute("disabled");
    }
  });
});

// Event delegation - listen for clicks on the body (or any parent container)
document.body.addEventListener("click", async function (event) {
  // Check if the clicked element is a follow button
  if (event.target && event.target.classList.contains("followbtn")) {
    const button = event.target; // The clicked button
    const user_id = button.getAttribute("data-user-id");

    // Prepare the URL and data for the follow request
    const url = "assets/php/ajax.php?follow";

    // Disable the button to prevent multiple clicks
    button.setAttribute("disabled", true);

    try {
      // Send the POST request with the user_id
      const response = await fetch(url, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ user_id: user_id }), // Send user_id as JSON
      });

      const data = await response.json();

      // Change the button text depending on the follow/unfollow status
      if (data.message === "followed") {
        button.textContent = "Unfollow"; // If followed, show "Unfollow"
      } else if (data.message === "unfollowed") {
        button.textContent = "Follow"; // If unfollowed, show "Follow"
      }
    } catch (error) {
      console.log("Error:", error);
    } finally {
      // Re-enable the button after the request is complete
      button.removeAttribute("disabled");
    }
  }
});

// for commenting
document.body.addEventListener("click", async function (event) {
  if (event.target && event.target.classList.contains("comment_btn")) {
    const button = event.target; // The clicked button
    const post_id = button.getAttribute("data-post-id");
    // console.log("post_id", post_id);
    // Prepare the URL and data for the follow request
    const url = "assets/php/ajax.php?addComment";
    const comment_element = document.getElementById("comment_value_" + post_id);
    const comment = comment_element.value;
    const comment_count=document.getElementById('comment_' + post_id);
    console.log("zxcxzc",comment_count);
  
    const comment_container = document.getElementById(
      "comment_container_" + post_id
    );
    if (comment == "") {
      return 0;
    }

    // Disable the button to prevent multiple clicks
    button.setAttribute("disabled", true);

    try {
      // Send the POST request with the user_id
      const response = await fetch(url, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ post_id: post_id, comment: comment }), // Send user_id as JSON
      });

      const data = await response.json();
      if (data.status) {
        comment_element.value = "";
        comment_container.innerHTML += data.comment;
        comment_count.textContent=data.count +" " +"comment";
      }
    } catch (error) {
      console.log("Error:", error);
    } finally {
      // Re-enable the button after the request is complete
      button.removeAttribute("disabled");
    }
  }
});

document.querySelectorAll(".hover_comment").forEach((button) => {
  button.addEventListener("click", async function () {
    const commentId = this.getAttribute("data-post-id");
    const comment_modal = document.getElementById("modal_comment_" + commentId);
    comment_modal.style.display = "flex";
    const close_comment_modal = document.getElementById(
      "closeCommentModal" + commentId
    );
    close_comment_modal.onclick = function () {
      comment_modal.style.display = "none";
    };
  });
});
document.querySelectorAll(".post_like_btn").forEach((button) => {
  button.addEventListener("click", async function () {
    const postId = this.getAttribute("data-post-id");
    const modal = document.getElementById("modal_user_like_" + postId);

    const url = "assets/php/ajax.php?userlikes";

    try {
      const response = await fetch(url, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          post_id: postId,
        }), // Send the post ID
      });
      const data = await response.json();
      const modalContent = document.getElementById("modal_content_" + postId);
      modalContent.innerHTML = ""; // Clear previous user elements
      if (data.data.length > 0) {
        data.data.forEach((user) => {
          const userElement = document.createElement("div");
          userElement.className = "follow"; // Add any necessary classes
          userElement.style.padding = "5px 10px";
          userElement.style.marginBottom = "15px";
          const showButton = user.user_id !== data.current_user; // Replace 'currentUserID' with your actual variable holding the current user's ID
          userElement.innerHTML = `
          <div style="display: flex; align-items: center; gap: 10px; flex: 4">
            <a href="?u=${user.username}" style="text-decoration:none">
              <img class="image" src="assets/images/profiles/${
                user.profile_pic
              }" />
              <div>
                <span class="name" style="display: block; margin-top: 2.5px; color: gray">
                  ${user.first_name} ${user.last_name}
                </span>
                <span class="email" style="display: block; margin-top: -2px; color: gray">
                  ${user.username}
                </span>
            </a>
          </div>
         
          </div>
            ${
              showButton
                ? `<button style="flex:1" class="followbtn" data-user-id=${
                    user.user_id
                  }>${user.follow_status == 1 ? "Unfollow" : "Follow"}</button>`
                : ""
            }
        `;
          modalContent.appendChild(userElement);
        });
      } else {
        modalContent.innerHTML = "Be the first one to like";
      }

      modal.style.display = "flex"; // Show the modal
    } catch (error) {
      console.log("error  getting  user likes by id", error);
    }
  });
});

document.querySelectorAll("#closeModal").forEach((button) => {
  button.addEventListener("click", function () {
    const postId = this.getAttribute("data-post-id");
    const modal = document.getElementById("modal_user_like_" + postId);
    modal.style.display = "none"; // Close the modal
  });
});

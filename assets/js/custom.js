// for liking the post

document.querySelectorAll(".like_btn").forEach(function (imgTag) {
  imgTag.addEventListener("click", async function () {
    var post_id = this.getAttribute("data-post-id");
    var imgTag = this;
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
    const comment_container = document.getElementById(
      "comment_container_" + post_id
    );
    console.log("comment_Container", comment_container);
    if (comment == "") {
      return 0;
    }
    console.log("value", comment);

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
      console.log(data);
      if (data.status) {
        comment_element.value = "";
        comment_container.innerHTML += data.comment;
      }
    } catch (error) {
      console.log("Error:", error);
    } finally {
      // Re-enable the button after the request is complete
      button.removeAttribute("disabled");
    }
  }
});

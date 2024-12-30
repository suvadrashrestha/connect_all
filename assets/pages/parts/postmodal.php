<!-- Modal structure -->

<div id="createPostModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Create Post</h3>
            <span style="cursor:pointer" class="close" id="closeModal1">&times;</span>

        </div>

        <form
            method="post"
            action="assets/php/actions.php?addpost"
            enctype="multipart/form-data">
            <textarea
                id="postText"
                rows="4"
                name="post_text"
                class="post-textarea"
                placeholder="What's on your mind?"
                oninput="checkFields()"></textarea>

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
                            height="45px" />
                    </label>
                    <input
                        id="file-input"
                        type="file"
                        name="post_img"
                        accept="image/*"
                        multiple
                        onchange="previewImages(event); checkFields()" />
                </div>

                <!-- Submit button -->
                <button type="submit" id="postBtn" class="post-submit" disabled>Post</button>
            </div>
        </form>
    </div>
</div>

<script>
    const modal = document.getElementById("createPostModal");
    const openModalBtn = document.getElementById("openModal");
    const closeModalBtn = document.getElementById("closeModal1");
    const fileInput = document.getElementById("file-input");
    const imagePreviewContainer = document.getElementById(
        "image-preview-container"
    );
    const postBtn = document.getElementById("postBtn");
    const postText = document.getElementById("postText");
    // Function to open the modal
    if(openModalBtn){
    openModalBtn.onclick = function() {

        modal.style.display = "flex";
        fileInput.value = ""; // Reset file input
        imagePreviewContainer.innerHTML = ""; // Clear preview
        closeModalBtn.onclick = function() {
            modal.style.display = "none"
        }
    };
    }

    // Function to close the modal


    // Close the modal if clicked outside the modal content
    window.onclick = function(event) {

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
                reader.onload = function(e) {
                    const img = document.createElement("img");
                    img.src = e.target.result;
                    imagePreviewContainer.appendChild(img);
                };
                reader.readAsDataURL(file); // Read the file as a Data URL
            }
        }
    }
</script>
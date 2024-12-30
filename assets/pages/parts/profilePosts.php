<?php
$likes = getLikes($post['id']);
$comments = getComments($post['id']);

?>




<div class="posts" style="margin-top: 0px; margin-bottom: 10px;">
    <div class="post-header">
        <a href="?u=<?= $profile['username'] ?>" style="text-decoration:none ; display:inline; color:black">
            <div style="display: flex; gap: 10px; align-items: center; margin:10px">
                <img loading='lazy' style="border:1px solid gray;width:40px; height:40px" src="assets/images/profiles/<?= $profile['profile_pic'] ?>"
                    class="profile-pic" />

                <h5 id="name"><?= ucfirst($profile['first_name']) ?> <?= ucfirst($profile['last_name']) ?></h5>

            </div>
        </a>
    </div>

    <!-- end of profile-bar -->

    <div class="profile-body" style="width: 100%; padding:0px 10px">
        <p style="line-height: 25px">
            <?= ucfirst($post['post_text']) ?>
        </p>
    </div>

    <!-- end of description -->

    <?php
    if ($post['post_img']) {
    ?>
        <div class="profile-post" style="width: 100% ;">
            <img style="height:auto" loading='lazy' id='myImage' src="assets/images/posts/<?= $post['post_img'] ?>" alt="Connect All"
                class="post-image" />
        </div>
    <?php
    }
    ?>

    <div style="display:flex; justify-content:space-between;align-items:center">
        <div style="padding: 10px 20px; display:flex; align-items:center; gap:5px">
            <?php
            if (checkLikeStatus($post['id'])) {
            ?>
                <img src="assets/images/icon/reaction_icon.jpg" alt="love" width="16px" height="16px"
                    id="postImage_<?= $post['id'] ?>" />
            <?php
            } else {
            ?>
                <img loading='lazy' src="assets/images/icon/reaction_icon.jpg" alt="love" width="16px" height="16px" style="display:none"
                    id="postImage_<?= $post['id'] ?>" />
            <?php
            }

            ?>
            <span style="cursor:pointer" data-post-id="<?= $post['id'] ?>" class="post_like_btn"
                id="like_<?= $post['id'] ?>"> <?= count($likes) ?> like </span>

        </div>
        <p style="padding-right:20px" id="comment_<?= $post['id'] ?>">
            <?= count($comments) ?> comment
        </p>
    </div>

    <div style="border-bottom:1px solid gray; margin:0px 15px; height:0.5px"> </div>

    <div style="display:flex; justify-content:space-around;width: 100%; padding: 10px">
        <div style="cursor:pointer; color:black ;display:flex; align-items:center;gap:5px">
            <?php
            if (checkLikeStatus($post['id'])) {
            ?>
                <img loading='lazy' src="assets/images/icon/reaction_icon.jpg" alt="love" width="16px" height="16px" class="like_btn"
                    data-post-id="<?= $post['id'] ?>" />
            <?php
            } else {
            ?>
                <img loading='lazy' src="assets/images/icon/unfill_heart_icon.jpg" alt="love" width="16px" height="16px" class="like_btn"
                    data-post-id="<?= $post['id'] ?>" />
            <?php
            }
            ?>

            <span class="hover_love"> Love </span>
        </div>

        <div style="cursor:pointer">
            <img loading='lazy' src="assets/images/icon/comment_icon.jpg" alt="love" width="15px" height="15px" />
            <span data-post-id="<?= $post['id'] ?>" class="hover_comment">Comment </span>
        </div>



    </div>


</div>
<?php
global $search_result;
?>
<!-- <div style="display: flex; align-items: center; justify-content: center">
    <div id="search_div" style="padding:20px">

        <div class="follow" style="padding: 20px; margin-bottom: 15px;">
            <div style="display: flex; align-items: center; gap: 10px; flex: 4">
                
                   
                </a>
                <div>
                    <a href="?u=<?= htmlspecialchars($suser['username']) ?>" style="text-decoration:none">
                        <span class="name" style="display: block; margin-top: 2.5px; color: gray">
                           
                        </span>
                    </a>
                    <span class="email" style="display: block; margin-top: -5px; color: gray">
                       
                    </span>
                </div>
            </div>
        </div>

    </div>
</div> -->

<div class="user-list">


    <?php if (empty($search_result)) { ?>
        <div class="empty-state">
      <div class="empty-icon">👥</div>
      <p class="empty-message">No users found</p>
    </div>
    <?php } else { ?>
        <?php foreach ($search_result as $suser): ?>
            <a href="?u=<?= htmlspecialchars($suser['username']) ?>" style="text-decoration:none">
            <div class="user-card" >
                <div class="avatar"> <img class="image" loading="lazy" style="width: 40px;height:40px; object-fit: cover; border-radius: 20px;" src="assets/images/profiles/<?= htmlspecialchars($suser['profile_pic']) ?>" /></div>
                <div class="user-info">
                    <h3 class="name"> <?= htmlspecialchars($suser['first_name']) ?> <?= htmlspecialchars($suser['last_name']) ?></h3>
                    <p class="username"> <?= htmlspecialchars($suser['username']) ?></p>
                </div>
            </div>
            </a>
        <?php endforeach; ?>
    <?php } ?>




</div>
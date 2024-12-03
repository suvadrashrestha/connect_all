<?php
global $search_result;
?>
<div style="display: flex; align-items: center; justify-content: center">
    <div id="search_div" style="padding:20px">
        <?php if (empty($search_result)) { ?>
        <div>No user found</div>
        <?php } else { ?>
        <?php foreach ($search_result as $suser): ?>
        <div class="follow" style="padding: 20px; margin-bottom: 15px;">
            <div style="display: flex; align-items: center; gap: 10px; flex: 4">
                <a href="?u=<?= htmlspecialchars($suser['username']) ?>" style="text-decoration:none">
                    <img class="image" src="assets/images/profiles/<?= htmlspecialchars($suser['profile_pic']) ?>" />
                </a>
                <div>
                    <a href="?u=<?= htmlspecialchars($suser['username']) ?>" style="text-decoration:none">
                        <span class="name" style="display: block; margin-top: 2.5px; color: gray">
                            <?= htmlspecialchars($suser['first_name']) ?> <?= htmlspecialchars($suser['last_name']) ?>
                        </span>
                    </a>
                    <span class="email" style="display: block; margin-top: -5px; color: gray">
                        <?= htmlspecialchars($suser['username']) ?>
                    </span>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php } ?>
    </div>
</div>
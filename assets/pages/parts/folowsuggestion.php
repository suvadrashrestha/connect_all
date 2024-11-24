<div class="follow" style="padding: 5px 10px; margin-bottom: 15px; ">
    <div style="display: flex; align-items: center; gap: 10px; flex: 4">
        <a href="?u=<?= $suser['username'] ?>" style="text-decoration:none">
            <img class="image" src="assets/images/profiles/<?= $suser['profile_pic'] ?>" />
            <div>
                <span
                    class="name"
                    style="display: block; margin-top: 2.5px; color: gray">
                    <?= $suser['first_name'] ?> <?= $suser['last_name'] ?>
                </span>
                <span
                    class="email"
                    style="display: block; margin-top: -5px; color: gray">
                    <?= $suser['username'] ?>
                </span>
        </a>
    </div>
</div>
<button style="flex: 1" class="followbtn" data-user-id='<?= $suser['id'] ?>'>Follow</button>
</div>
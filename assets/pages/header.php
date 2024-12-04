<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="assets/images/logo-color.png" type="image/x-icon">

  <?php if (isset($data['css'])): ?>
    <?php if (is_array($data['css'])): ?>
      <?php foreach ($data['css'] as $css): ?>
        <link href="assets/css/<?= htmlspecialchars($css) ?>.css" rel="stylesheet" />
      <?php endforeach; ?>
    <?php else: ?>
      <link href="assets/css/<?= htmlspecialchars($data['css']) ?>.css" rel="stylesheet" />
    <?php endif; ?>
  <?php endif; ?>
  <!-- <link href="assets/css/<?= $data['css'] ?>.css" rel="stylesheet" /> -->
  <title><?= $data['page_title'] ?></title>
</head>

<body>

  <!-- 
  <div style=" background-color:gray;"> -->
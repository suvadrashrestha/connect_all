<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="assets/images/logo-color.png" type="image/x-icon">
  <style>
    .infinity-symbol {
      width: 200px;
      height: auto;
      display: inline-block;
    }

    .infinity-symbol::before {
      content: '';
      display: block;
      width: 100%;
      height: 0;
      padding-bottom: 50%;
      background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="45 70 110 60"><defs><linearGradient id="gradient1" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" style="stop-color:%2300B4D8"/><stop offset="100%" style="stop-color:%234361EE"/></linearGradient><linearGradient id="gradient2" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" style="stop-color:%234361EE"/><stop offset="100%" style="stop-color:%23F72585"/></linearGradient></defs><path d="M65,100 C45,70 45,130 65,100 C85,70 115,70 135,100 C155,130 155,70 135,100 C115,130 85,130 65,100" stroke="url(%23gradient1)" fill="none" stroke-width="8" stroke-linecap="round"/><path d="M75,100 C60,80 60,120 75,100 C90,80 110,80 125,100 C140,120 140,80 125,100 C110,120 90,120 75,100" stroke="url(%23gradient2)" fill="none" stroke-width="4" stroke-linecap="round"/><circle cx="65" cy="100" r="6" fill="%2300B4D8"/><circle cx="135" cy="100" r="6" fill="%23F72585"/><circle cx="100" cy="100" r="8" fill="%234361EE"/></svg>');
      background-size: contain;
      background-repeat: no-repeat;
    }
  </style>
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
<?php
/**
 * @var $this \App\Admin\Main\AdminView
 * @var $title string
 */ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/includes/media/tech.png" type="image/x-icon">
</head>
<body>
<div class="wrapper">
    <div class="content">
        <?= $this->getLayoutElement('header') ?>
        <div class="dropdown-divider">
            ------------------------------------------------------------------------------------------------------
            ------------------------------------------------------------------------------------------------------
            ---------------------------
        </div>
        <div class="container-fluid">
            <?= $this->getContent() ?>
        </div>
    </div>
    <div class="footer">
        <?= $this->getLayoutElement('footer') ?>
    </div>
</div>
<?= $this->getLayoutElement('scripts') ?>
</body>
</html>



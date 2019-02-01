<?php
/**
 * @var $this \Core\View;
 * @var $title string
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/media/tech.png" type="image/x-icon">
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
            <div class="row">
                <?= $this->getLayoutElement('categories') ?>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-9">
                            <?= $this->getContent(); ?>
                        </div>
                        <div class="col-sm-3">
                            <script type="text/javascript"
                                    src="//ra.revolvermaps.com/0/0/6.js?i=02op3nb0crr&amp;m=7&amp;s=320&amp;c=e63100&amp;cr1=ffffff&amp;f=arial&amp;l=0&amp;bv=90&amp;lx=-420&amp;ly=420&amp;hi=20&amp;he=7&amp;hc=a8ddff&amp;rs=80"
                                    async="async"></script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?= $this->getLayoutElement('arrivals') ?>
    </div>
    <?= $this->getLayoutElement('footer') ?>
</div>
<?= $this->getLayoutElement('scripts') ?>
</body>
</html>



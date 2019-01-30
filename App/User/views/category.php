<?php if (!empty($products)) : ?>
    <div class="alert alert-secondary">
        <h4 class="alert-heading">Our <?= strtolower($category->title) ?> </h4>
        <p class="mb-0">Here's everything you need!</p>
    </div>
    <div class="row">
        <?php foreach ($products as $value) : ?>
            <div class="card col-sm-3" style="width: 15rem; ">
                <img width="140" height="250" class="card-img-top"
                     src="/media/products/<?= $value->serviceTitle ?>.jpg" alt="Card image cap">
                <div class="card-footer">
                    <h5 class="card-title"><b><?= $value->title ?></b></h5>
                    <p class="card-text"><?= $value->shortDescription; ?></p>
                    <a class="btn btn-primary" href="/item/view/<?= $value->serviceTitle ?>">More</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else : ?>
    <div class="alert alert-warning">
        <h4 class="alert-heading">So sorry, all <?= strtolower($category->title) ?> has been already
            sold!</h4>
        <p class="mb-0">Visit us later.</p>
    </div>
<?php endif; ?>


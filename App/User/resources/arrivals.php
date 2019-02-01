<?php $item = new \App\User\Mappers\ItemMapper(); ?>
<?php $items = $item->getFiveItems(); ?>
<div class="col-sm-12" ;>
    <div class="row justify-content-between">
        <div class="dropdown-divider">
            ------------------------------------------------------------------------------------------------------
            ------------------------------------------------------------------------------------------------------
            ------------------------------------------------------------------------------------------------------
            ------------------------------------------------------------------------------------------------------
        </div>
    </div>
    <div class="jumbotron">
        <h1 class="display-3">Hello, visitor!</h1>
        <p class="lead">Have time to buy the components you are interested right now.</p>
        <hr class="my-4">
        <p>We offer the best prices for the best quality.</p>
        <p class="lead">
            <a href="/category/view?id=all" class="btn btn-primary btn-lg">Learn more</a>
        </p>
    </div>
    <div class="row justify-content-between">
        <?php foreach ($items as $value) : ?>
            <div class="card col-sm-2" style="width: 15rem;" style="height: 15rem;">
                <img width="140" height="250" class="card-img-top" src="/media/products/<?= $value->serviceTitle ?>.jpg"
                     alt="Card image cap">
                <div class="card-footer">
                    <h5 class="card-title"><b><?= $value->title; ?></b></h5>
                    <p class="card-text"><?= $value->shortDescription; ?></p>
                    <a class="btn btn-primary" href="/item/view?id=<?= $value->serviceTitle ?>">More</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<div class="col-sm-10">
    <div class="row">
        <div class="col-sm-9">
            <?php if (!empty($products)): ?>
                <div class="alert alert-secondary">
                    <h4 class="alert-heading">Our <?= strtolower($category->title) ?> </h4>
                    <p class="mb-0">Here's everything you need!</p>
                </div>
                <div class="row">
                    <?php foreach ($products as $value): ?>
                        <div class="card col-sm-3" style="width: 15rem;" style="height: 15rem;">
                            <img width="140" height="250" class="card-img-top" src="/includes/media/products/<?=$value->serviceTitle?>.jpg" alt="Card image cap">
                            <div class="card-footer">
                                <h5 class="card-title"><b><?=$value->title?></b></h5>
                                <p class="card-text"><?=$value->shortDescription;?></p>
                                <a class="btn btn-primary" href="/item/view/<?=$value->serviceTitle?>">More</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="alert alert-warning">
                    <h4 class="alert-heading">So sorry, all <?=strtolower($category->title)?> has been already sold!</h4>
                    <p class="mb-0">Visit us later.</p>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-sm-3">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Article number one</h5>
                    </div>
                    <p class="mb-1">Some interesting info about any goods from any category</p>
                </a>
                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Article number two</h5>
                    </div>
                    <p class="mb-1">Some interesting info about any goods from any category</p>
                </a>
                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Article number three</h5>
                    </div>
                    <p class="mb-1">Some interesting info about any goods from any category</p>
                </a>
            </div>
        </div>
    </div>
</div>

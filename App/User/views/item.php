<?php
/**
 * @var $info \App\User\Data\Item
 **/ ?>
<div class="alert alert-secondary">
    <h4 class="alert-heading"><strong><?= $info->title ?></strong></h4>
</div>
<div class="row">
    <div class="col-sm-3">
        <img class="card-img-top" src="/media/products/<?= $info->serviceTitle ?>.jpg" alt="Card image cap">
    </div>
    <div class="col-sm-9">
        <div class="row justify-content-between">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">Characteristic</th>
                    <th scope="col">Value</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($info->characteristics as $key => $value) : ?>
                    <tr>
                        <th scope="row"><?= $key ?></th>
                        <td><?= $value ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <th scope="row">Price</th>
                    <td><?= $info->price ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="row justify-content-center">
    <form method="POST" action="/item/add">
        <button class="btn btn-primary" name="id" value="<?= $info->id ?>"> Add to cart</button>
    </form>
</div>
<div class="row justify-content-between">
    <div class="dropdown-divider">
        ------------------------------------------------------------------------------------------------------
        ------------------------------------------------------------------------------------------------------
        -------------------------
    </div>
</div>
<div class="row">
    <h4>Description</h4>
</div>
<div class="row">
    <?= $info->description ?>
</div>

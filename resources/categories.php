<?php $categoryMapper = new App\Mappers\CategoryMapper();?>
<div class="col-sm-2">
    <div class="list-group row justify-content-start">
        <?php foreach ($categoryMapper->getAllCategories() as $key => $value):?>
            <?php if ($key === 0):?>
                <a href="/category/view/<?=$value->serviceTitle?>" class="list-group-item list-group-item-action"><strong><?=$value->title?></strong></a>
            <?php else: ?>
                <a href="/category/view/<?=$value->serviceTitle?>" class="list-group-item list-group-item-action"><?=$value->title?></a>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>
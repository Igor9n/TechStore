<?php if (!empty($categories)) : ?>
    <div class="alert alert-secondary">
        <h4 class="alert-heading">All categories</strong></h4>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="row" style="width: 10%;">Category ID</th>
            <th scope="row">Category TITLE</th>
            <th scope="row">Category SERVICE TITLE</th>
            <th scope="row" style="width: 15%;">Category HAS PRODUCTS</th>
            <th scope="row" style="width: 20%;">Buttons</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($categories as $category) : ?>
            <?php if ($category->id === 0) {
                continue;
            } ?>
            <tr>
                <form method="POST" action="/admin/categories/update">
                    <th scope="row"><?= $category->id ?></th>
                    <td scope="row"><input type="text" class="form-control" name="title"
                                           value="<?= $category->title ?>"></td>
                    <td scope="row"><input type="text" class="form-control" name="serviceTitle"
                                           value="<?= $category->serviceTitle ?>">
                    </td>
                    <td scope="row"><?= $category->hasProducts ?></td>
                    <td scope="row">
                        <button class="btn btn-primary" name="update" value="<?= $category->id ?>">Update</button>
                </form>
                <?php if ($category->hasProducts === 'Yes') : ?>
                    <button class="btn btn-primary" name="delete" value="true" disabled>Delete</button>
                <?php else : ?>
                    <form method="POST" action="/admin/categories/delete" class="d-inline-block">
                        <button class="btn btn-primary" name="delete" value="<?= $category->id ?>">Delete
                        </button>
                    </form>
                <?php endif; ?>
                <a class="btn btn-primary" href="/admin/category?id=<?= $category->id ?>">Characteristics
                </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else : ?>
    <div class="alert alert-warning">
        <h4 class="alert-heading">Categories list is <strong>empty.</strong></h4>
        <p class="mb-0">Add a new one.</p>
    </div>
<?php endif; ?>
<table class="table">
    <form method="POST" action="/admin/categories/insert">
        <th scope="row" style="width: 10%;"></th>
        <th scope="row"><input type="text" class="form-control" name="title" placeholder="Enter category title">
        </th>
        <th scope="row"><input type="text" class="form-control" name="serviceTitle"
                               placeholder="Enter category service title"></th>
        <th scope="row" style="width: 15%;"></th>
        <th scope="row" style="width: 20%;">
            <button class="btn btn-primary" name="insert" value="true">Add new category</button>
        </th>
    </form>
</table>

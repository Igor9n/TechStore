<?php if (!empty($categories)) : ?>
    <div class="alert alert-secondary">
        <h4 class="alert-heading"><strong>All categories</strong></h4>
    </div>
    <?php if (!empty($errors['list'])) : ?>
        <div class="alert alert-danger">
            <h4 class="mb-1"><?= ucfirst($errors['action']) ?> <strong>'<?= $errors['id'] ?>'</strong>
                category failed.</strong></h4>
            <ul>
                <?php foreach ($errors['list'] as $error) : ?>
                    <li class="mb-0">
                        <?= $error ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <table class="table">
        <thead>
        <tr>
            <th scope="row" style="width: 10%">Category ID</th>
            <th scope="row" style="width: 15%">Category TITLE</th>
            <th scope="row" style="width: 20%">Category SERVICE TITLE</th>
            <th scope="row">Category HAS PRODUCTS</th>
            <th scope="row" style="width: 25%">Buttons</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($categories as $category) : ?>
            <?php if ($category->id === 0) {
                continue;
            } ?>
            <tr>
                <form method="POST" action="/admin/update/category">
                    <input type="hidden" name="key" value="info">
                    <input type="hidden" name="id" value="<?= $category->id ?>">
                    <th scope="row"><?= $category->id ?></th>
                    <td scope="row"><input type="text" class="form-control" name="title"
                                           value="<?= $category->title ?>"></td>
                    <td scope="row"><input type="text" class="form-control" name="serviceTitle"
                                           value="<?= $category->serviceTitle ?>">
                    </td>
                    <td scope="row"><?= $category->hasProducts ?></td>
                    <td scope="row" style="width: 25%">
                        <button class="btn btn-primary" name="action" value="update">Update</button>
                </form>
                <?php if ($category->hasProducts === 'Yes') : ?>
                    <button class="btn btn-primary" name="delete" value="true" disabled>Delete</button>
                <?php else : ?>
                    <form method="POST" action="/admin/delete/category" class="d-inline-block">
                        <input type="hidden" name="key" value="info">
                        <input type="hidden" name="id" value="<?= $category->id ?>">
                        <button class="btn btn-primary" name="action" value="delete">Delete
                        </button>
                    </form>
                <?php endif; ?>
                <a class="btn btn-primary" href="/admin/one/category?id=<?= $category->id ?>">Characteristics
                </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else : ?>
    <div class="alert alert-warning">
        <h4 class="alert-heading">Categories list is <strong>empty.</strong></h4>
        <p class="mb-0">Add a new one.</p>атрибуты
    </div>
<?php endif; ?>
<table class="table">
    <form method="POST" action="/admin/insert/category">
        <input type="hidden" name="key" value="info">
        <th scope="row" style="width: 10%;"></th>
        <th scope="row" style="width: 15%;"><input type="text" class="form-control" name="title"
                                                   placeholder="Enter category title">
        </th>
        <th scope="row" style="width: 20%;"><input type="text" class="form-control" name="serviceTitle"
                                                   placeholder="Enter category service title"></th>
        <th scope="row"></th>
        <th scope="row" style="width: 25%;">
            <button class="btn btn-primary" name="action" value="insert">Add new category</button>
        </th>
    </form>
</table>

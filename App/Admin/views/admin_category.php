<?php if (!empty($info['characteristics'])) : ?>
    <div class="alert alert-secondary">
        <h4 class="alert-heading">Category characteristics for <strong>'<?= $info['category']['title'] ?>'</strong></h4>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="row" style="width: 15%">Category characteristic ID</th>
            <th scope="row">Category characteristic TITLE</th>
            <th scope="row" style="width: 20%">Category characteristic IN USAGE</th>
            <th scope="row" style="width: 15%;">Buttons</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($info['characteristics'] as $characteristic) : ?>
            <tr>
                <form method="POST" action="/admin/category/update">
                    <th scope="row"><?= $characteristic->id ?></th>
                    <td scope="row"><input type="text" class="form-control" name="title"
                                           value="<?= $characteristic->title ?>"></td>
                    <td scope="row"><?= $characteristic->inUsage ?></td>
                    <td scope="row">
                        <button class="btn btn-primary" name="update" value="<?= $characteristic->id ?>">Update
                        </button>
                </form>
                <?php if ($characteristic->inUsage === 'Yes') : ?>
                    <button class="btn btn-primary" name="delete" value="true" disabled>Delete</button>
                <?php else : ?>
                    <form method="POST" action="/admin/category/delete" class="d-inline-block">
                        <button class="btn btn-primary" name="delete" value="<?= $characteristic->id ?>">Delete
                        </button>
                    </form>
                <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else : ?>
    <div class="alert alert-warning">
        <h4 class="alert-heading">
            Characteristics list for <strong>'<?= $info['category']['title'] ?>'</strong> is empty.
        </h4>
        <p class="mb-0">Add a new one.</p>
    </div>
<?php endif; ?>
<table class="table">
    <form method="POST" action="/admin/category/insert">
        <th scope="row" style="width: 15%;"></th>
        <th scope="row"><input type="text" class="form-control" name="title"
                               placeholder="Enter category characteristic title">
        </th>
        <th scope="row" style="width: 20%;"></th>
        <th scope="row" style="width: 15%;">
            <button class="btn btn-primary" name="insert" value="<?= $info['category']['id'] ?>">
                Add new category characteristic
            </button>
        </th>
    </form>
</table>


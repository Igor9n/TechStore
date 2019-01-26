<?php if (!empty($categories)) : ?>
    <?php $i = 1 ?>
    <table class="table">
        <thead>
        <tr>
            <th scope="row">Category ID</th>
            <th scope="row">Category TITLE</th>
            <th scope="row">Category SERVICE TITLE</th>
            <th scope="row" style="width: 15%;">Category HAS PRODUCTS</th>
            <th scope="row" style="width: 15%;">Buttons</th>
        </tr>
        </thead>
        <tbody>
        <?php for (; $i < count($categories); $i++) : ?>
            <form method="POST" action="/admin/delete">
                <tr>
                    <th scope="row"><?= $categories[$i]->id ?></th>
                    <td scope="row"><?= $categories[$i]->title ?></td>
                    <td scope="row"><?= $categories[$i]->serviceTitle ?></td>
                    <td scope="row"><?= $categories[$i]->hasProducts ?></td>
                    <td scope="row">
                        <button class="btn btn-primary" name="update" value="true">Update</button>
                        <?php if ($categories[$i]->hasProducts === 'Yes') : ?>
                            <button class="btn btn-primary" name="delete" value="true" disabled>Delete</button>
                        <?php else : ?>
                            <form method="POST" action="/admin/delete">
                                <button class="btn btn-primary" name="delete" value="<?= $categories[$i]->id ?>">Delete
                                </button>
                            </form>
                        <?php endif; ?>
                        <button class="btn btn-primary" href="/admin/category?id=<?= $categories[$i]->id ?>">More
                        </button>
                    </td>
                </tr>
            </form>
        <?php endfor; ?>
        <form method="POST" action="/admin/insert">
            <tr>
                <td scope="row"></td>
                <td scope="row"><input type="text" name="title" placeholder="Enter category title"></td>
                <td scope="row"><input type="text" name="serviceTitle" placeholder="Enter category service title"></td>
                <td scope="row"></td>
                <td scope="row">
                    <button class="btn btn-primary" name="insert" value="true">Add new category</button>
                </td>
            </tr>
        </form>
        </tbody>
    </table>
<?php else : ?>
    <div class="alert alert-warning">
        <h4 class="alert-heading">Categories list are <strong>empty.</strong></h4>
    </div>
<?php endif; ?>

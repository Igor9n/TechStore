<?php if (!empty($categories)) : ?>
    <?php $i = 1 ?>
    <table class="table">
        <thead>
        <tr>
            <th scope="row">Category ID</th>
            <th scope="row">Category TITLE</th>
            <th scope="row">Category SERVICE TITLE</th>
            <th scope="row" style="width: 15%;">Category HAS PRODUCTS</th>
            <th scope="row" style="width: 10%;">Buttons</th>
        </tr>
        </thead>
        <?php for (; $i < count($categories); $i++) : ?>
            <tbody>
            <tr>
                <td scope="row"><?= $categories[$i]->id ?></td>
                <td scope="row"><?= $categories[$i]->title ?></td>
                <td scope="row"><?= $categories[$i]->serviceTitle ?></td>
                <td scope="row"><?= $categories[$i]->hasProducts ?></td>
                <td scope="row">
                    <button class="btn btn-primary" name="order" value="true">Update</button>
                    <button class="btn btn-primary" name="order" value="true">Delete</button>
                </td>
            </tr>
            </tbody>
        <?php endfor; ?>
    </table>
<?php else : ?>
    <div class="alert alert-warning">
        <h4 class="alert-heading">Categories list are <strong>empty.</strong></h4>
    </div>
<?php endif; ?>

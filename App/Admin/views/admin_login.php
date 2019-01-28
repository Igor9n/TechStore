<div class="col-sm-12">
    <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $var) : ?>
                    <li><?= $var ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <form method="post" action="/admin/login">
        <div class="row">
            <div class="col">
                <label>Your login</label>
                <input type="text" class="form-control" name="login">
            </div>
            <div class="col">
                <label>Your passsword</label>
                <input type="password" class="form-control" name="password">
            </div>
        </div>
        <div class="dropdown-divider">
            ------------------------------------------------------------------------------------------------------
            ------------------------------------------------------------------------------------------------------
            ---------------------------
        </div>
        <div class="row">
            <div class="col">
                <button class="btn btn-primary" name="try" value="login">Submit</button>
            </div>
        </div>
    </form>
</div>

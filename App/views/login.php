<div class="col-sm-10">
    <div class="row">
        <div class="col-sm-9">
            <?php if ($errors) : ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach ($errors as $var) : ?>
                            <li><?= $var ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            <div class="alert alert-secondary">
                <h4 class="alert-heading">Hi, guest!</h4>
                <p class="mb-0">Sign in for tracking your orders</p>
            </div>
            <form method="post" action="/user/try">
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
                    ---------------------------------------------------------------------------------
                    ---------------------------------------------------------------------------------
                    ---------------------------------------------------------------------
                </div>
                <div class="row">
                    <div class="col">
                        <button class="btn btn-primary" name="try" value="login">Submit</button>
                    </div>
                </div>
            </form>
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

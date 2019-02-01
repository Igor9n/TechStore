<?php if (isset($registered)) : ?>
    <div class="alert alert-success">
        <h4 class="alert-heading"><strong>Well done!</strong></h4>
        <p class="mb-0">You successfully registered!</p>
    </div>
    <div class="alert alert-secondary">
        <a class="btn btn-secondary" href="/">Return</a>
        <a class="btn btn-secondary" href="/user/login">Login</a>
    </div>
<?php else : ?>
    <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $var) : ?>
                    <li><?= $var ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <div class="alert alert-secondary">
        <h4 class="alert-heading">Don't have an account yet?</h4>
        <p class="mb-0">Fix it right now</p>
    </div>
    <form method="post" action="/user/registration">
        <div class="row">
            <div class="col">
                <label>Your login</label>
                <input type="text" class="form-control" name="login">
            </div>
            <div class="col">
                <label>Your email</label>
                <input type="text" class="form-control" name="email">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label>Your password</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="col">
                <label>Confirm password</label>
                <input type="password" class="form-control" name="confirm">
            </div>
        </div>
        <div class="dropdown-divider">
            ------------------------------------------------------------------------------------------------------
            ------------------------------------------------------------------------------------------------------
            ---------------------------
        </div>
        <div class="row">
            <div class="col">
                <button class="btn btn-primary" name="try" value="register">Submit</button>
            </div>
        </div>
    </form>
<?php endif; ?>

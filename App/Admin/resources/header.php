<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <img src="/media/tech.png" width="30" height="30" alt="">
    <a class="navbar-brand" href="/">TechStore</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01"
            aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="btn btn-primary" href="/">To site</a>
            </li>
            <?php if (isset($_SESSION['admin'])) : ?>
                <li class="nav-item">
                    <a class="btn btn-primary" href="/admin">Main</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-primary" href="/admin/categories">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-primary" href="/admin/items">Items</a>
                </li>
            <?php endif; ?>
        </ul>
        <div class="col-3 row justify-content-end form-around">
            <?php if (!isset($_SESSION['admin'])) : ?>
                <a class="btn btn-primary" href="/admin/login">Login</a>
            <?php else : ?>
                <a class="btn btn-primary" href="/admin"><?= $_SESSION['admin']->login ?></a>
                <a class="btn btn-primary" href="/admin/logout">Logout</a>
                <?php if ($_SESSION['admin']->role === 'main') : ?>
                    <a class="btn btn-primary" href="/admin/control">Control admins</a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</nav>



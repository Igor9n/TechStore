<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <img src="/media/tech.png" width="30" height="30" alt="">
    <a class="navbar-brand" href="/">TechStore</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/">Main</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/main/vacancies">Vacancies</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/main/about">About</a>
            </li>
        </ul>
            <form class="form-inline my-2 my-lg-0" method="GET" action="/order/check">
                <input class="form-control mr-sm-1" type="text" placeholder="Enter order number" name="id">
<!--                <button class="btn btn-secondary" type="submit">Search</button>-->
            </form>
        <?php if (!isset($_SESSION['user'])) : ?>
            <div class="col-3 row justify-content-end form-around">
                <a class="btn btn-primary" href="/user/login">Login</a>
                <a class="btn btn-primary" href="/user/registration">Register</a>
                <a class="btn btn-primary" href="/cart/view">Cart</a>
            </div>
        <?php else : ?>
            <div class="col-3 row justify-content-end form-around">
                <a class="btn btn-primary" href="/order/all"><?=$_SESSION['user']->login?></a>
                <a class="btn btn-primary" href="/user/logout">Logout</a>
                <a class="btn btn-primary" href="/cart/view">Cart</a>
            </div>
        <?php endif; ?>
    </div>
</nav>



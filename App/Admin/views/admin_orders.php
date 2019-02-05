<?php /** @var $order \App\Admin\Data\Order */ ?>
<?php if (!empty($orders)) : ?>
    <div class="alert alert-secondary">
        <h4 class="alert-heading"><strong>All orders</strong></h4>
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
            <th scope="row" style="width: 10%">Order ID</th>
            <th scope="row" style="width: 15%">User ID</th>
            <th scope="row" style="width: 20%">Order TOTAL PRICE</th>
            <th scope="row">Actual order STATUS</th>
            <th scope="row">Change status TO</th>
            <th scope="row" style="width: 15%">Buttons</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($orders as $order) : ?>
            <tr>
                <th scope="row"><?= $order->id ?></th>
                <?php if ($order->personalInfo['user'] === '0') : ?>
                    <td scope="row"><input type="text" class="form-control" name="title"
                                           value="Unregistered" disabled></td>
                <?php else : ?>
                    <td scope="row"><input type="text" class="form-control" name="title"
                                           value="<?= $order->personalInfo['user'] ?>" disabled></td>
                <?php endif; ?>
                <td scope="row"><input type="text" class="form-control" name="serviceTitle"
                                       value="<?= $order->mainInfo['total_price'] ?>" disabled>
                </td>
                <td scope="row"><input type="text" class="form-control" name="serviceTitle"
                                       value="<?= $order->mainInfo['status'] ?>" disabled>
                </td>
                <th scope="row">
                    <form class="d-inline" method="POST" action="/admin/update/order">
                        <input type="hidden" name="key" value="info">
                        <input type="hidden" name="id" value="<?= $order->id ?>">
                        <div class="row">
                            <div class="col">
                                <select class="custom-select" name="status">
                                    <option selected value="New">New</option>
                                    <option value="In process">In process</option>
                                    <option value="In delivery">In delivery</option>
                                    <option value="Completed">Completed</option>
                                    <option value="Canceled">Canceled</option>
                                </select>
                            </div>
                            <div class="col">
                                <button class="btn btn-primary " name="action" value="update">Update</button>
                            </div>
                        </div>
                    </form>
                </th>
                <td scope="row">
                    <form class="d-inline" method="POST" action="/admin/delete/order">
                        <input type="hidden" name="key" value="info">
                        <input type="hidden" name="id" value="<?= $order->id ?>">
                        <button class="btn btn-primary" name="action" value="delete">Delete</button>
                    </form>
                    <a class="btn btn-primary" href="/admin/one/order?id=<?= $order->id ?>">More</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else : ?>
    <div class="alert alert-warning">
        <h4 class="alert-heading">Orders list is <strong>empty.</strong></h4>
        <p class="mb-0">Try to buy <a class="btn btn-secondary" href="category/view?id=all">something</a></p>
    </div>
<?php endif; ?>


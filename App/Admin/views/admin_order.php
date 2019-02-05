<?php /** @var $order \App\Admin\Data\Order */ ?>
<div class="alert alert-primary">
    <h2 class="mb-1">Order number <?= $order->id ?></h2>
</div>
<div class="alert alert-info">
    <h4 class="mb-1"><strong>Personal info</strong></h4>
</div>
<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="row" style="width: 15%;">First name</th>
        <th scope="row" style="width: 15%;">Last name</th>
        <th scope="row">Phone number</th>
        <th scope="row">Email</th>
        <th scope="row" style="width: 10%">Buttons</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td scope="row">
            <input type="text" class="form-control" name="firstName"
                   value="<?= $order->personalInfo['firstName'] ?>">
        </td>
        <td scope="row">
            <input type="text" class="form-control" name="lastName"
                   value="<?= $order->personalInfo['lastName'] ?>">
        </td>
        <td scope="row">
            <input type="text" class="form-control" name="firstName"
                   value="<?= $order->personalInfo['phoneNumber'] ?>">
        </td>
        <td scope="row">
            <input type="text" class="form-control" name="firstName"
                   value="<?= $order->personalInfo['email'] ?>">
        </td>
        <td scope="row">
            <button class="btn btn-primary">Update</button>
        </td>
    </tr>
    </tbody>
</table>
<div class="alert alert-info">
    <h4 class="mb-1"><strong>Address info</strong></h4>
</div>
<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="row" style="width: 15%;">City</th>
        <th scope="row">Address</th>
        <th scope="row" style="width: 15%;">Apartments</th>
        <th scope="row" style="width: 10%">Buttons</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td scope="row">
            <input type="text" class="form-control" name="firstName"
                   value="<?= $order->addressInfo['city'] ?>">
        </td>
        <td scope="row">
            <input type="text" class="form-control" name="lastName"
                   value="<?= $order->addressInfo['address'] ?>">
        </td>
        <td scope="row">
            <input type="text" class="form-control" name="firstName"
                   value="<?= $order->addressInfo['apartmentsNumbers'] ?>">
        </td>
        <td scope="row">
            <button class="btn btn-primary">Update</button>
        </td>
    </tr>
    </tbody>
</table>
<div class="alert alert-info">
    <h4 class="mb-1"><strong>Delivery info</strong></h4>
</div>
<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="row" style="width: 15%;">Delivery type</th>
        <th scope="row">Delivery date</th>
        <th scope="row">Delivery time</th>
        <th scope="row" style="width: 10%">Buttons</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td scope="row">
            <input type="text" class="form-control" name="firstName"
                   value="<?= $order->deliveryInfo['type'] ?>">
        </td>
        <td scope="row">
            <input type="text" class="form-control" name="lastName"
                   value="<?= $order->deliveryInfo['date'] ?>">
        </td>
        <td scope="row">
            <input type="text" class="form-control" name="firstName"
                   value="<?= $order->deliveryInfo['time'] ?>">
        </td>
        <td scope="row">
            <button class="btn btn-primary">Update</button>
        </td>
    </tr>
    </tbody>
</table>
<div class="alert alert-info">
    <h4 class="mb-1"><strong>Order products</strong></h4>
</div>
<?php if (empty($order->productsInfo)) : ?>
    <td scope="row">
        <div class="alert alert-warning">
            <h4 class="mb-1">There are no products in this order.</h4>
        </div>
    </td>
<?php else : ?>
    <table class="table">
        <thead>
        <tr>
            <th scope="row" style="width: 10%">Product ID</th>
            <th scope="row" style="width: 15%">Product TITLE</th>
            <th scope="row" style="width: 15%">Actual product QUANTITY</th>
            <th scope="row">Change product quantity TO</th>
            <th scope="row" style="width: 20%">Total price for this PRODUCT</th>
            <th scope="row" style="width: 10%">Buttons</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($order->productsInfo as $product) : ?>
            <tr>
                <th scope="row"><?= $product['info']->id ?></th>
                <td scope="row"><input type="text" class="form-control"
                                       value="<?= $product['info']->title ?>" disabled></td>
                <td scope="row">
                    <input type="number" id="actual" class="form-control" value="<?= $product['count'] ?>" disabled>
                </td>
                <td scope="row">
                    <div class="row">
                        <div class="col-sm-2">
                            <input type="number" class="form-control" name="count" min="1" step="1"
                                   value="<?= $product['count'] ?>">
                        </div>
                        <div class="col">
                            <button class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </td>
                <td scope="row"><input type="text" class="form-control"
                                       value="<?= $product['endprice'] ?>" disabled></td>
                <td scope="row">
                    <button class="btn btn-primary">Delete</button>
                    <a class="btn btn-primary" href="/admin/one/item?id=<?= $product['info']->id ?>">More</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
<table class="table">
    <tr>
        <th scope="row" style="width: 10%"></th>
        <th scope="row" style="width: 15%">
            <select class="custom-select" name="status">
                <?php foreach ($items as $item) : ?>
                    <option value="<?= $item->id ?>"><?= $item->title ?></option>
                <?php endforeach; ?>
            </select>
        </th>
        <th scope="row" style="width: 15%"></th>
        <th scope="row"></th>
        <th scope="row" style="width: 20%">
            <button class="btn btn-primary">Add new product to order</button>
        </th>
        <th scope="row" style="width: 15%"></th>
    </tr>
</table>


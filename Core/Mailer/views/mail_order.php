<?php /**@var  $cart \App\User\Data\Cart */ ?>
<div class="alert alert-info">
    <h2 class="mb-1"><strong>Your order number is <?= $order ?></strong></h2>
</div>
<div class="alert alert-info">
    <h2 class="mb-1"><strong>Personal info</strong></h2>
</div>
<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="row">You first name</th>
        <th scope="row">Your last name</th>
        <th scope="row">Phone number</th>
        <th scope="row">Email</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td scope="row">
            <input type="text" class="form-control" name="firstName"
                   value="<?= $cart->personalArray['firstName'] ?>" disabled>
        </td>
        <td scope="row">
            <input type="text" class="form-control" name="lastName"
                   value="<?= $cart->personalArray['lastName'] ?>" disabled>
        </td>
        <td scope="row">
            <input type="text" class="form-control" name="phoneNumber"
                   value="<?= $cart->personalArray['phone'] ?>" disabled>
        </td>
        <td scope="row">
            <input type="text" class="form-control" name="email"
                   value="<?= $cart->personalArray['email'] ?>" disabled>
        </td>
    </tr>
    </tbody>
</table>
<div class="alert alert-info">
    <h2 class="mb-1"><strong>Address info</strong></h2>
</div>
<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="row">City</th>
        <th scope="row">Address</th>
        <th scope="row">Apartments</th>
        <th scope="row">Zip</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td scope="row">
            <input type="text" class="form-control" name="city"
                   value="<?= $cart->addressArray['city'] ?>" disabled>
        </td>
        <td scope="row">
            <input type="text" class="form-control" name="address"
                   value="<?= $cart->addressArray['address'] ?>" disabled>
        </td>
        <td scope="row">
            <input type="text" class="form-control" name="apartmentsNumbers"
                   value="<?= $cart->addressArray['apartments'] ?>" disabled>
        </td>
        <td scope="row">
            <input type="text" class="form-control" name="zip"
                   value="<?= $cart->addressArray['zip'] ?>" disabled>
        </td>
    </tr>
    </tbody>
</table>
<div class="alert alert-info">
    <h2 class="mb-1"><strong>Order products</strong></h2>
</div>

<table class="table">
    <thead>
    <tr>
        <th scope="row">Product TITLE</th>
        <th scope="row">Product QUANTITY</th>
        <th scope="row">Total price for this PRODUCT</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($cart->itemsArray as $product) : ?>
        <tr>
            <td scope="row"><input type="text" class="form-control"
                                   value="<?= $product['info']->title ?>" disabled></td>
            <td scope="row">
                <input type="number" id="actual" class="form-control"
                       value="<?= $product['count'] ?>" disabled>
            </td>

            <td scope="row"><input type="text" class="form-control"
                                   value="<?= $product['endPrice'] ?>" disabled></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<h3>You ordered for a total <?= $cart->totalPrice ?> UAH</h3>

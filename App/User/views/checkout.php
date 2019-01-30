<?php if (!empty($cart->itemsArray)) : ?>
    <?php if (isset($ordered)) : ?>
        <div class="alert alert-success">
            <h4 class="alert-heading"><strong>Well done!</strong></h4>
            <p class="mb-0">Your order has been successfully placed</p>
            <p class="mb-0">It's number <strong><?= $orderNumber ?></strong></p>
        </div>
    <?php else : ?>
        <ul class="nav nav-pills nav-fill">
            <li class="nav-item">
                <a class="nav-link show active" data-toggle="tab" href="#contact">Contact details</a>
            </li>
            <li class="nav-item">
                <a class="nav-link show" data-toggle="tab" href="#delivery">Delivery info</a>
            </li>
            <li class="nav-item">
                <a class="nav-link show" data-toggle="tab" href="#products">Products</a>
            </li>
        </ul>
        <div class="dropdown-divider">
            ------------------------------------------------------------------------------------------------------
            ------------------------------------------------------------------------------------------------------
            ---------------------------
        </div>
        <form method="POST" action="/cart/order">
            <div class="tab-content">
                <div class="tab-pane fade active show" id="contact">
                    <div class="row">
                        <div class="col">
                            <label>First name*</label>
                            <input type="text" class="form-control" name="firstName"
                                   value="<?= $cart->personalArray['firstName'] ?>">
                        </div>
                        <div class="col">
                            <label>Last name*</label>
                            <input type="text" class="form-control" name="lastName"
                                   value="<?= $cart->personalArray['lastName'] ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label>Your phone number*</label>
                            <input type="text" class="form-control" name="phone"
                                   value="<?= $cart->personalArray['phone'] ?>">
                        </div>
                        <div class="col">
                            <label>Your email</label>
                            <input type="email" class="form-control" name="email"
                                   value="<?= $cart->personalArray['email'] ?>">
                        </div>
                    </div>
                    <div class="dropdown-divider">
                        ------------------------------------------------------------------------------------------------------
                        ------------------------------------------------------------------------------------------------------
                        ---------------------------
                    </div>
                    <p class="mb-0">*required</p>
                </div>
                <div class="tab-pane fade" id="delivery">
                    <div class="row">
                        <div class="col">
                            <label>Your city*</label>
                            <input type="text" class="form-control" name="city"
                                   value="<?= $cart->addressArray['city'] ?>">
                        </div>
                        <div class="col">
                            <label>Your address*</label>
                            <input type="text" class="form-control" name="address"
                                   value="<?= $cart->addressArray['address'] ?>">
                        </div>
                        <div class="col">
                            <label>Zip code</label>
                            <input type="text" class="form-control" name="zip"
                                   value="<?= $cart->addressArray['zip'] ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label>House number*</label>
                            <input type="text" class="form-control" name="house">
                        </div>
                        <div class="col">
                            <label>Apartment number</label>
                            <input type="text" class="form-control" name="apartment">
                        </div>
                    </div>
                    <div class="dropdown-divider">
                        ------------------------------------------------------------------------------------------------------
                        ------------------------------------------------------------------------------------------------------
                        ---------------------------
                    </div>
                    <p class="mb-0">*required</p>
                </div>
                <div class="tab-pane fade" id="products">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col" style="width: 4%;">#</th>
                            <th scope="col">Title</th>
                            <th scope="col" style="width: 20%;">Quantity</th>
                            <th scope="col" style="width: 10%;">Price</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($cart->itemsArray as $var) : ?>
                            <tr>
                                <th scope="row"><?= $i++; ?></th>
                                <th scope="row"><a
                                            href="/item/view/<?= $var['info']->serviceTitle ?>"><?= $var['info']->title ?></a>
                                </th>
                                <td>
                                    <input size="1" value="<?= $var['count'] ?>" disabled>
                                </td>
                                <th scope="row"><?= $var['endPrice'] ?></th>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <th scope="row"></th>
                            <th scope="row"></th>
                            <th scope="row">Total</th>
                            <th scope="row"><b><?= $cart->totalPrice ?> UAH</b></th>
                        </tr>
                        <tr>
                            <th scope="row"></th>
                            <th scope="row"></th>
                            <th scope="row">Confirm your order</th>
                            <th scope="row">
                                <button class="btn btn-primary" name="order" value="true">Submit</button>
                            </th>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
        <?php if (isset($errors)) : ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($errors as $var) : ?>
                        <li><?= $var ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
    <?php endif; ?>
<?php else : ?>
    <div class="alert alert-warning">
        <h4 class="alert-heading">Your cart is empty</h4>
        <p class="mb-0">You haven't ordered anything yet</p>
    </div>
<?php endif; ?>

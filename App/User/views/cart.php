<?php /** @var $cart \App\User\Data\Cart * */ ?>
<?php if (!empty($cart->itemsArray)) : ?>
    <div class="alert alert-secondary">
        <h4 class="alert-heading"><b>Your cart</b></h4>
        <p class="mb-0">Here's everything you've ordered!</p>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col" style="width: 4%;">#</th>
            <th scope="col">Name</th>
            <th scope="col" style="width: 20%;">Quantity</th>
            <th scope="col" style="width: 10%;">Price</th>
            <th scope="col" style="width: 10%;"></th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 1; ?>
        <?php foreach ($cart->itemsArray as $var) : ?>
            <tr>
                <th scope="row"><?= $i++; ?></th>
                <th scope="row"><a
                            href="/item/view?id=<?= $var['info']->serviceTitle ?>"><?= $var['info']->title ?></a></th>
                <td>
                    <div>
                        <?php if ($var['count'] === 1) : ?>
                            <div class="page-item disabled d-inline-block">
                                <a class="page-link">-</a>
                            </div>
                        <?php else : ?>
                            <div class="page-item d-inline-block">
                                <form method="POST" action="/cart/count/minus">
                                    <button class="page-link" name="id" value="<?= $var['info']->id ?>">-
                                    </button>
                                </form>
                            </div>
                        <?php endif; ?>
                        <input size="1" class="input-text qty text" title="Change quantity" value="<?= $var['count'] ?>"
                               disabled>
                        <div class="page-item d-inline-block">
                            <form method="POST" action="/cart/count/plus">
                                <button class="page-link" name="id" value="<?= $var['info']->id ?>">+
                                </button>
                            </form>
                        </div>
                    </div>
                </td>
                <th scope="row"><?= $var['endPrice'] ?></th>
                <td>
                    <form method="POST" action="/cart/delete">
                        <button class="btn btn-secondary" name="id" value="<?= $var['info']->id ?>">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div class="dropdown-divider">
        ------------------------------------------------------------------------------------------------------
        ------------------------------------------------------------------------------------------------------
        ---------------------------
    </div>
    <div class="row justify-content-between">
        <div class="alert alert-light text-right">
            <h6>You can clean your cart</h6>
            <a class="btn btn-primary" href="/cart/clean">Do it</a>
        </div>
        <div class="alert alert-light text-right">
            <h6>You ordered for a total <b><?= $cart->totalPrice ?> </b><b>UAH</b></h6>
            <a class="btn btn-primary" href="/cart/checkout">Checkout</a>
        </div>
    </div>
<?php else : ?>
    <div class="alert alert-warning">
        <h4 class="alert-heading">Your cart is empty</h4>
        <p class="mb-0">You haven't ordered anything yet</p>
    </div>
<?php endif; ?>

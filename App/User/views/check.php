<?php if (!empty($info)) : ?>
    <div class="alert alert-secondary">
        <h4 class="alert-heading">Order number <b><?= $orderId ?></b></h4>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col" style="width: 50%;">Delivery</th>
            <th scope="col" style="width: 50%;">Value</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">Status</th>
            <td><?= $info['status'] ?></td>
        </tr>
        <tr>
            <th scope="row">Type</th>
            <td><?= $info['delivery']['type'] ?></td>
        </tr>
        <tr>
            <th scope="row">Date</th>
            <td><?= $info['delivery']['date'] ?></td>
        </tr>
        <tr>
            <th scope="row">Time</th>
            <td><?= $info['delivery']['time'] ?></td>
        </tr>
        </tbody>
    </table>
<?php else : ?>
    <div class="alert alert-warning">
        <h4 class="alert-heading">Wrong order number</h4>
        <p class="mb-0">Choose <a href="/category/view?=all">something</a></p>
    </div>
<?php endif; ?>



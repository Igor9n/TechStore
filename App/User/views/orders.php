<?php if (!empty($info->orders)) : ?>
    <div class="alert alert-warning">
        <h4 class="alert-heading">All orders</h4>
    </div>
    <div class="tab-content">
        <table class="table">
            <thead>
            <tr>
                <th scope="col" style="width: 20%;">Order number</th>
                <th scope="col" style="width: 20%;">Order status</th>
                <th scope="col" style="width: 20%;">Total price</th>
                <th scope="col" style="width: 10%;">Details</th>

            </tr>
            </thead>
            <tbody>
            <?php foreach ($info->orders as $var) : ?>
                <tr>
                    <th scope="row"><?= $var['id'] ?></th>
                    <td>
                        <div>
                            <input size=5" value="<?= $var['status'] ?>" disabled>
                        </div>
                    </td>
                    <th scope="row"><?= $var['totalPrice'] ?></th>
                    <th scope="row"><a class="btn btn-primary"
                                       href="/order/view?id=<?= $var['id'] ?>">More</a></th>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else : ?>
    <div class="alert alert-warning">
        <h4 class="alert-heading">You haven't orders yet</h4>
        <p class="mb-0">Choose <a href="/category/view?id=all">something</a></p>
    </div>
<?php endif; ?>

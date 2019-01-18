<div class="col-sm-10">
    <div class="row">
        <div class="col-sm-9">
            <?php if(!empty($info)): ?>
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
                            <?php foreach ($info as $var):?>
                                <tr>
                                    <th scope="row"><?=$var['id']?></th>
                                    <td>
                                        <div>
                                            <input size=5" value="<?=$var['status']?>" disabled>
                                        </div>
                                    </td>
                                    <th scope="row"><?=$var['totalPrice']?></th>
                                    <th scope="row"><a class="btn btn-primary" href="/order/view?id=<?=$var['id']?>">More</a></th>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-warning">
                    <h4 class="alert-heading">You haven't orders yet</h4>
                    <p class="mb-0">Choose <a href="/category/view/all">something</a></p>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-sm-3">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Article number one</h5>
                    </div>
                    <p class="mb-1">Some interesting info about any goods from any category</p>
                </a>
                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Article number two</h5>
                    </div>
                    <p class="mb-1">Some interesting info about any goods from any category</p>
                </a>
                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Article number three</h5>
                    </div>
                    <p class="mb-1">Some interesting info about any goods from any category</p>
                </a>
            </div>
        </div>
    </div>
</div>
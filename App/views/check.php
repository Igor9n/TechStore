<div class="col-sm-10">
    <div class="row">
        <div class="col-sm-9">
            <?php if(!empty($info)): ?>
                <div class="alert alert-secondary">
                    <h4 class="alert-heading">Order number <b><?=$orderId?></b></h4>
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
                                <td><?=$info[1]?></td>
                            </tr>
                            <tr>
                                <th scope="row">Type</th>
                                <td><?=$info[0]['type']?></td>
                            </tr>
                            <tr>
                                <th scope="row">Date</th>
                                <td><?=$info[0]['date']?></td>
                            </tr>
                            <tr>
                                <th scope="row">Time</th>
                                <td><?=$info[0]['time']?></td>
                            </tr>
                        </tbody>
                </table>
            <?php else: ?>
                <div class="alert alert-warning">
                    <h4 class="alert-heading">Wrong order number</h4>
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


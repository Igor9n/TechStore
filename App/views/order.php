<div class="col-sm-10">
    <?php if(isset($data['info'])): ?>
        <div class="alert alert-secondary">
            <h4 class="alert-heading">Order number <b><?=$orderNumber?></b></h4>
        </div>
        <ul class="nav nav-pills nav-fill">
            <li class="nav-item">
                <a class="nav-link show active" data-toggle="tab" href="#personal">Personal info</a>
            </li>
            <li class="nav-item">
                <a class="nav-link show" data-toggle="tab" href="#address">Address info</a>
            </li>
            <li class="nav-item">
                <a class="nav-link show" data-toggle="tab" href="#delivery">Delivery info</a>
            </li>
            <li class="nav-item">
                <a class="nav-link show" data-toggle="tab" href="#products">Products info</a>
            </li>
        </ul>
        <div class="dropdown-divider">
            ------------------------------------------------------------------------------------------------------
            ------------------------------------------------------------------------------------------------------
            ---------------------------
        </div>
        <div class="tab-content">
            <div class="tab-pane fade active show" id="personal">
                <div class="tab-content">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 50%;">Title</th>
                                <th scope="col" style="width: 50%;">Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">First name</th>
                                <td><?=$info['personal']['firstName']?></td>
                            </tr>
                            <tr>
                                <th scope="row">Last name</th>
                                <td><?=$info['personal']['lastName']?></td>
                            </tr>
                            <tr>
                                <th scope="row">Phone number</th>
                                <td><?=$info['personal']['phoneNumber']?></td>
                            </tr>
                            <tr>
                                <th scope="row">Email</th>
                                <td><?=$info['personal']['email']?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="address">
                <div class="tab-content">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col" style="width: 50%;">Title</th>
                            <th scope="col" style="width: 50%;">Value</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">City</th>
                            <td><?=$info['address']['city']?></td>
                        </tr>
                        <tr>
                            <th scope="row">Address</th>
                            <td><?=$info['address']['address']?></td>
                        </tr>
                        <tr>
                            <th scope="row">Apartments numbers</th>
                            <td><?=$info['address']['apartmentsNumbers']?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="delivery">
                <div class="tab-content">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 50%;">Title</th>
                                <th scope="col" style="width: 50%;">Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Type</th>
                                <td><?=$info['delivery']['type']?></td>
                            </tr>
                            <tr>
                                <th scope="row">Date</th>
                                <td><?=$info['delivery']['date']?></td>
                            </tr>
                            <tr>
                                <th scope="row">Time</th>
                                <td><?=$info['delivery']['time']?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="products">
                <div class="tab-content">
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
                        <?php $i=1;?>
                        <?php foreach ($data['info']['products'] as $var):?>
                            <tr>
                                <th scope="row"><?= $i++;?></th>
                                <th scope="row"><a href="/item/view/<?=$var['id']?>"><?=$var['name']?></a></th>
                                <td>
                                    <div>
                                        <input size="1" value="<?=$var['count']?>" disabled>
                                    </div>
                                </td>
                                <th scope="row"><?=$var['endprice']?></th>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-warning">
            <h4 class="alert-heading">Wrong order number</h4>
            <p class="mb-0">Choose <a href="/category/view/all">something</a></p>
        </div>
    <?php endif; ?>
</div>


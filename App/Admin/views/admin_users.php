<?php /**@var $user \App\Admin\Data\User */ ?>
<?php /**@var $personal \App\Admin\Data\Personal */ ?>
<?php if (!empty($users)) : ?>
    <div class="alert alert-secondary">
        <h4 class="alert-heading">All <strong>users</strong> info</h4>
    </div>
    <div class="row">
        <div class="col-2">
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link active alert alert-secondary" data-toggle="tab"
                       href="#users">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link alert alert-secondary" data-toggle="tab"
                       href="#personals">Personal info</a>
                </li>
            </ul>
        </div>
        <div class="col-10">
            <div class="tab-content">
                <div class="tab-pane fade active show" id="users">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="row" style="width: 10%">User ID</th>
                            <th scope="row" style="width: 10%">User LOGIN</th>
                            <th scope="row" style="width: 40%">User EMAIL</th>
                            <th scope="row">User PERSONALS as ORDERS</th>
                            <th scope="row">Buttons</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($users as $user) : ?>
                            <tr>
                                <th scope="row">
                                    <label for="id" hidden></label>
                                    <input class="form-control" type="text" id="id" value="<?= $user->id ?>" disabled>
                                </th>
                                <td scope="row">
                                    <label for="login" hidden></label>
                                    <input class="form-control" type="text" id="login" value="<?= $user->login ?>"
                                           disabled>
                                </td>
                                <td scope="row">
                                    <form method="POST" action="">
                                        <div class="row">
                                            <div class="col-8">
                                                <label for="email" hidden></label>
                                                <input class="form-control" type="text" id="email" name="email"
                                                       value="<?= $user->email ?>">
                                            </div>
                                            <div class="col">
                                                <button class="btn btn-primary">Update user email</button>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                                <td scope="row">
                                    <div class="row">
                                        <?php if (empty($user->personalList)) : ?>
                                            <div class="col">
                                                <label for="login" hidden></label>
                                                <input class="form-control" type="text" id="login"
                                                       value="You haven't orders"
                                                       disabled>
                                            </div>
                                        <?php else : ?>
                                            <div class="col-7">
                                                <select class="custom-select" name="personal">
                                                    <?php foreach ($user->personalList as $personal) : ?>
                                                        <option value="<?= $personal->id ?>">
                                                            <?= $personal->first ?> <?= $personal->last ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col">
                                                <button class="btn btn-primary">Unset</button>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <?php if (empty($user->personalList)) : ?>
                                    <td scope="row">
                                        <button class="btn btn-primary">Delete user</button>
                                    </td>
                                <?php else : ?>
                                    <td scope="row">
                                        <button class="btn btn-primary" disabled>Delete user</button>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="personals">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="row" style="width: 10%">Personal ID</th>
                            <th scope="row">Personal NAME</th>
                            <th scope="row">User LOGIN</th>
                            <th scope="row">Buttons</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($personals as $personal) : ?>
                            <tr>
                                <th scope="row">
                                    <label for="id" hidden></label>
                                    <input class="form-control" type="text" id="id" value="<?= $personal->id ?>"
                                           disabled>
                                </th>
                                <td scope="row">
                                    <div class="col">
                                        <label for="user" hidden></label>
                                        <input class="form-control" type="text" id="user"
                                               value="<?= $personal->first ?> <?= $personal->last ?>"
                                               disabled>
                                    </div>
                                </td>
                                <td scope="row">
                                    <div class="row">
                                        <div class="col">
                                            <label for="user" hidden></label>
                                            <input class="form-control" type="text" id="user"
                                                   value="<?= $personal->userLogin ?>"
                                                   disabled>
                                        </div>
                                        <div class="col">
                                            <label for="user" hidden></label>
                                            <select class="custom-select" name="user" id="user">
                                                <?php foreach ($users as $user) : ?>
                                                    <?php if ($user->id === '0') {
                                                        continue;
                                                    } ?>
                                                    <option value="<?= $user->id ?>">
                                                        <?= $user->login ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <button class="btn btn-primary">Set to Chosen user</button>
                                        </div>
                                        <?php if ($personal->userId === '0') : ?>
                                            <div class="col">
                                                <button class="btn btn-primary" disabled>Set to Unregistered</button>
                                            </div>
                                        <?php else : ?>
                                            <div class="col">
                                                <button class="btn btn-primary">Set to Unregistered</button>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <?php if ($personal->order) : ?>
                                    <td scope="row">
                                        <button class="btn btn-primary" disabled>Delete</button>
                                        <a class="btn btn-primary" href="/admin/one/order?id=<?= $personal->order ?>">To
                                            order</a>
                                    </td>
                                <?php else : ?>
                                    <td scope="row">
                                        <button class="btn btn-primary">Delete</button>
                                        <button class="btn btn-primary" disabled>Not in use</button>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="alert alert-warning">
        <h4 class="alert-heading">There are <strong>no registered</strong> users.</h4>
    </div>
<?php endif; ?>

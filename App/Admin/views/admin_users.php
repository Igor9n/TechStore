<?php if (empty($users)) : ?>
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
                            <th scope="row">User PERSONALS</th>
                            <th scope="row">Buttons</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">
                                <label for="id" hidden></label>
                                <input class="form-control" type="text" id="id" value="ID" disabled>
                            </th>
                            <td scope="row">
                                <label for="login" hidden></label>
                                <input class="form-control" type="text" id="login" value="LOGIN" disabled>
                            </td>
                            <td scope="row">
                                <form method="POST" action="">
                                    <div class="row">
                                        <div class="col-8">
                                            <label for="email" hidden></label>
                                            <input class="form-control" type="text" id="email" name="email"
                                                   value="EMAIL">
                                        </div>
                                        <div class="col">
                                            <button class="btn btn-primary">Update user email</button>
                                        </div>
                                    </div>
                                </form>
                            </td>
                            <td scope="row">
                                <div class="row">
                                    <div class="col-7">
                                        <input class="form-control" type="text" name="email" value="PERSONALS LIST">
                                    </div>
                                    <div class="col">
                                        <button class="btn btn-primary">Unset</button>
                                    </div>
                                </div>
                            </td>
                            <td scope="row">
                                <button class="btn btn-primary">Delete user</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="personals">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="row">Personal ID</th>
                            <th scope="row">User LOGIN</th>
                            <th scope="row">Buttons</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">
                                <label for="id" hidden></label>
                                <input class="form-control" type="text" id="id" value="ID" disabled>
                            </th>
                            <td scope="row">
                                <div class="row">
                                    <div class="col">
                                        <label for="user" hidden></label>
                                        <input class="form-control" type="text" id="user" value="User LOGIN" disabled>
                                    </div>
                                    <div class="col">
                                        <label for="user" hidden></label>
                                        <input class="form-control" type="text" id="user" value="USERS LIST">
                                    </div>
                                    <div class="col">
                                        <button class="btn btn-primary">Set to Chosen user</button>
                                    </div>
                                    <div class="col">
                                        <button class="btn btn-primary">Set to Unregistered</button>
                                    </div>
                                </div>
                            </td>
                            <td scope="row">
                                <button class="btn btn-primary">Delete</button>
                                <button class="btn btn-primary">To order</button>
                            </td>
                        </tr>
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

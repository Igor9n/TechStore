<?php if (!empty($items)) : ?>
    <div class="row">
        <div class="col-sm-2">
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link show active alert alert-primary" data-toggle="tab"
                       href="#0">All products</a>
                </li>
                <?php foreach ($categories as $category) : ?>
                    <?php if ($category->id === 0) {
                        continue;
                    } ?>
                    <li class="nav-item">
                        <a class="nav-link show alert alert-secondary" data-toggle="tab"
                           href="#<?= $category->id ?>"><?= $category->title ?></a>
                    </li>
                <?php endforeach; ?>
                <li class="nav-item">
                    <a class="nav-link alert alert-warning" data-toggle="tab"
                       href="#new">Add new item</a>
                </li>
            </ul>
        </div>
        <div class="tab-content col-sm-10">
            <div class="tab-pane fade active show" id="0">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="row" style="width: 10%;">Item ID</th>
                        <th scope="row">Item CATEGORY</th>
                        <th scope="row">Item TITLE</th>
                        <th scope="row" style="width: 10%;">Item IN USAGE</th>
                        <th scope="row" style="width: 15%">Buttons</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($items as $item) : ?>
                        <tr>
                            <th scope="row"><?= $item->id ?></th>
                            <th scope="row"><?= $item->category->title ?></th>
                            <th scope="row"><?= $item->title ?></th>
                            <th scope="row"><?= $item->inUsage ?></th>
                            <th scope="row">
                                <?php if ($item->inUsage === 'Yes') : ?>
                                    <button class="btn btn-primary" disabled>Delete</button>
                                <?php else : ?>
                                    <form method="POST" action="/admin/delete/item" class="d-inline-block">
                                        <input type="hidden" name="key" value="info">
                                        <input type="hidden" name="id" value="<?= $item->id ?>">
                                        <button class="btn btn-primary" name="action" value="delete">Delete
                                        </button>
                                    </form>
                                <?php endif; ?>
                                <a class="btn btn-primary" href="/admin/one/item?id=<?= $item->id ?>">More
                                </a>
                            </th>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php foreach ($categories as $category) : ?>
                <?php if ($category->id === 0) {
                    continue;
                } ?>
                <div class="tab-pane fade" id="<?= $category->id ?>">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="row" style="width: 10%;">Item ID</th>
                            <th scope="row" style="width: 15%">Item SERVICE TITLE</th>
                            <th scope="row">Item TITLE</th>
                            <th scope="row" style="width: 10%;">Item IN USAGE</th>
                            <th scope="row" style="width: 12%">Buttons</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($items as $item) : ?>
                            <?php if ($item->category->id === $category->id) : ?>
                                <tr>
                                    <th scope="row"><?= $item->id ?></th>
                                    <th scope="row"><?= $item->serviceTitle ?></th>
                                    <th scope="row"><?= $item->title ?></th>
                                    <th scope="row"><?= $item->inUsage ?></th>
                                    <th scope="row">
                                        <?php if ($item->inUsage === 'Yes') : ?>
                                            <button class="btn btn-primary" disabled>Delete</button>
                                        <?php else : ?>
                                            <form method="POST" action="/admin/delete/item" class="d-inline-block">
                                                <input type="hidden" name="key" value="info">
                                                <input type="hidden" name="id" value="<?= $item->id ?>">
                                                <button class="btn btn-primary" name="key" value="delete">
                                                    Delete
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                        <a class="btn btn-primary" href="/admin/one/item?id=<?= $item->id ?>">More
                                        </a>
                                    </th>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </table>
                </div>
            <?php endforeach; ?>
            <div class="tab-pane fade" id="new">
                <form method="POST" action="/admin/insert/item">
                    <input type="hidden" name="key" value="info">
                    <div class="row">
                        <div class="form-group col">
                            <label for="title"><strong>Title</strong></label>
                            <input type="text" class="form-control" name="title" placeholder="Enter item title">
                        </div>
                        <div class="form-group col">
                            <label for="serviceTitle"><strong>Service title</strong></label>
                            <input type="text" class="form-control" name="serviceTitle"
                                   placeholder="Enter service title">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="warranty"><strong>Item warranty</strong></label>
                            <input type="text" class="form-control" name="warranty"
                                   placeholder="Enter warranty for item">
                        </div>
                        <div class="form-group col">
                            <label for="price"><strong>Item price</strong></label>
                            <input type="text" class="form-control" name="price" placeholder="Enter item price">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="category"><strong>Category for item</strong></label>
                            <select class="custom-select" name="category">
                                <option selected>Choose category</option>
                                <?php foreach ($categories as $category) : ?>
                                    <?php if ($category->id === 0) {
                                        continue;
                                    } ?>
                                    <option value="<?= $category->id ?>"><?= $category->title ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <fieldset class="form-group col">
                            <legend>Visibility of item</legend>
                            <div class="row">
                                <div class="form-check col">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="visible" value="true"
                                               checked="">
                                        Visible
                                    </label>
                                </div>
                                <div class="form-check col">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="visible" value="false">
                                        Not visible
                                    </label>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="form-group">
                        <label for="shortDescription"><strong>Short description</strong></label>
                        <textarea class="form-control" name="shortDescription"
                                  placeholder="Enter short description for item"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="description"><strong>Description</strong></label>
                        <textarea class="form-control" name="description" placeholder="Enter description for item"
                                  rows="5"></textarea>
                    </div>
                    <button class="btn btn-primary" name="action" value="insert">Add new item</button>
                </form>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="alert alert-warning">
        <h4 class="alert-heading">Items list is <strong>empty.</strong></h4>
        <p class="mb-0">Add a new one.</p>
    </div>
    <form method="POST" action="/admin/insert/item">
        <input type="hidden" name="key" value="info">
        <div class="row">
            <div class="form-group col">
                <label for="title"><strong>Title</strong></label>
                <input type="text" class="form-control" name="title" placeholder="Enter item title">
            </div>
            <div class="form-group col">
                <label for="serviceTitle"><strong>Service title</strong></label>
                <input type="text" class="form-control" name="serviceTitle" placeholder="Enter service title">
            </div>
        </div>
        <div class="row">
            <div class="form-group col">
                <label for="warranty"><strong>Item warranty</strong></label>
                <input type="text" class="form-control" name="warranty" placeholder="Enter warranty for item">
            </div>
            <div class="form-group col">
                <label for="price"><strong>Item price</strong></label>
                <input type="text" class="form-control" name="price" placeholder="Enter item price">
            </div>
        </div>
        <div class="row">
            <div class="form-group col">
                <label for="category"><strong>Category for item</strong></label>
                <select class="custom-select" name="category">
                    <option selected>Choose category</option>
                    <?php foreach ($categories as $category) : ?>
                        <?php if ($category->id === 0) {
                            continue;
                        } ?>
                        <option value="<?= $category->id ?>"><?= $category->title ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <fieldset class="form-group col">
                <legend>Visibility of item</legend>
                <div class="row">
                    <div class="form-check col">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="visible" value="true" checked="">
                            Visible
                        </label>
                    </div>
                    <div class="form-check col">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="visible" value="false">
                            Not visible
                        </label>
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="form-group">
            <label for="shortDescription"><strong>Short description</strong></label>
            <textarea class="form-control" name="shortDescription"
                      placeholder="Enter short description for item"></textarea>
        </div>
        <div class="form-group">
            <label for="description"><strong>Description</strong></label>
            <textarea class="form-control" name="description" placeholder="Enter description for item"
                      rows="5"></textarea>
        </div>
        <button class="btn btn-primary" name="action" value="delete">Add new item</button>
    </form>
<?php endif; ?>
<?php if (!empty($errors['list'])) : ?>
    <div class="alert alert-danger">
        <h4 class="mb-1"><?= ucfirst($errors['action']) ?> <strong>'<?= $errors['key'] ?>'</strong>
            item failed.</strong></h4>
        <ul>
            <?php foreach ($errors['list'] as $error) : ?>
                <li class="mb-0">
                    <?= $error ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
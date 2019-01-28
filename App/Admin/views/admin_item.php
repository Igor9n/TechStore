<div class="row">
    <div class="col-sm-2">
        <ul class="nav nav-pills flex-column">
            <li class="nav-item">
                <a class="nav-link show active alert alert-primary" data-toggle="tab"
                   href="#info">Product Info</a>
            </li>
            <li class="nav-item">
                <a class="nav-link alert alert-primary" data-toggle="tab"
                   href="#characteristics">Product Characteristics</a>
            </li>
        </ul>
    </div>
    <div class="tab-content col-sm-10">
        <div class="tab-pane fade active show" id="info">
            <form method="POST" action="/admin/item/update">
                <div class="row">
                    <div class="form-group col">
                        <label for="title"><strong>Title</strong></label>
                        <input type="text" class="form-control" name="title" value="<?= $item->title ?>">
                    </div>
                    <div class="form-group col">
                        <label for="serviceTitle"><strong>Service title</strong></label>
                        <input type="text" class="form-control" name="serviceTitle" value="<?= $item->serviceTitle ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col">
                        <label for="warranty"><strong>Item warranty</strong></label>
                        <input type="text" class="form-control" name="warranty" value="<?= $item->warranty ?>">
                    </div>
                    <div class="form-group col">
                        <label for="price"><strong>Item price</strong></label>
                        <input type="text" class="form-control" name="price" value="<?= $item->price ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col">
                        <label for="actualCategory"><strong>Actual category</strong></label>
                        <input type="text" class="form-control" id="actualCategory" disabled
                               value="<?= $item->category->title ?>">
                    </div>
                    <div class="form-group col">
                        <label for="category"><strong>Category for item</strong></label>
                        <select class="custom-select" name="category" id="category">
                            <?php foreach ($categories as $category) : ?>
                                <?php if ($category->id === 0) {
                                    continue;
                                } ?>
                                <?php if ($item->category->id === $category->id) : ?>
                                    <option selected value="<?= $category->id ?>"><?= $category->title ?></option>
                                <?php else : ?>
                                    <option value="<?= $category->id ?>"><?= $category->title ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group col">
                        <label for="actualVisibility"><strong>Actual visibility</strong></label>
                        <input type="text" class="form-control" id="actualVisibility" disabled
                               value="<?= $item->visible ?>">
                    </div>
                    <fieldset class="form-group col">
                        <legend>Visibility of item</legend>
                        <div class="row">
                            <div class="form-check col">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="visible" value="true" checked>
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
                              id="shortDescription"><?= $item->shortDescription ?></textarea>
                </div>
                <div class="form-group">
                    <label for="description"><strong>Description</strong></label>
                    <textarea class="form-control" name="description" id="description"
                              rows="5"><?= $item->description ?></textarea>
                </div>
                <button class="btn btn-primary" name="update" value="<?= $item->id ?>">Update product info</button>
            </form>
        </div>
        <div class="tab-pane fade" id="characteristics">
            <table class="table">
                <thead>
                <tr>
                    <th scope="row" style="width: 40%">Characteristic TITLE</th>
                    <th scope="row">Characteristic VALUE</th>
                    <th scope="row" style="width: 15%">Buttons</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($characteristics as $characteristic) : ?>
                    <?php if ($characteristic['value'] === 'No info') : ?>
                        <tr>
                            <form method="POST" action="/admin/item/insert">
                                <input type="hidden" name="product" value="<?= $item->id ?>">
                                <td scope="row"><input type="text" name="title" class="form-control"
                                                       value="<?= $characteristic['info']->title ?>" disabled></td>
                                <td scope="row"><input type="text" name="value" class="form-control"
                                                       value="<?= $characteristic['value'] ?>"></td>
                                <td scope="row">
                                    <button class="btn btn-primary" name="insert"
                                            value="<?= $characteristic['info']->id ?>">Insert characteristic value
                                    </button>
                                </td>
                            </form>
                        </tr>
                    <?php else : ?>
                        <tr>
                            <form method="POST" action="/admin/item/modify">
                                <td scope="row"><input type="text" name="title" class="form-control"
                                                       value="<?= $characteristic['info']->title ?>" disabled></td>
                                <td scope="row"><input type="text" name="value" class="form-control"
                                                       value="<?= $characteristic['value']['value'] ?>"></td>
                                <td scope="row">
                                    <button class="btn btn-primary" name="modify"
                                            value="<?= $characteristic['value']['id'] ?>">Modify
                                    </button>
                            </form>
                            <form method="POST" action="/admin/item/delete" class="d-inline-block">
                                <button class="btn btn-primary" name="delete"
                                        value="<?= $characteristic['value']['id'] ?>">Delete
                                </button>
                            </form>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
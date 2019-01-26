<div class="alert alert-warning">
    <h4 class="alert-heading">Items list is <strong>empty.</strong></h4>
    <p class="mb-0">Add a new one.</p>
</div>
<form method="POST" action="">
    <div class="form-group">
        <label for="title"><strong>Title</strong></label>
        <input type="password" class="form-control" id="title" placeholder="Enter item title">
    </div>
    <div class="form-group">
        <label for="serviceTitle"><strong>Service title</strong></label>
        <input type="text" class="form-control" id="serviceTitle" placeholder="Enter service title">
    </div>
    <div class="form-group">
        <label for="warranty"><strong>Item warranty</strong></label>
        <input type="text" class="form-control" id="warranty" placeholder="Enter warranty for item">
    </div>
    <div class="form-group">
        <label for="shortDescription"><strong>Short description</strong></label>
        <input type="text" class="form-control" id="shortDescription" placeholder="Enter short description for item">
    </div>
    <div class="form-group">
        <label for="description"><strong>Description</strong></label>
        <input type="text" class="form-control" id="description" placeholder="Enter description for item">
    </div>
    <div class="form-group">
        <label for="category"><strong>Category for item</strong></label>
        <select class="custom-select" id="category">
            <option selected="">Open this select menu</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
        </select>
    </div>
    <div class="form-group">
        <label for="price"><strong>Item price</strong></label>
        <input type="text" class="form-control" id="price" placeholder="Enter item price">
    </div>
    <div class="form-group">
        <label for="visible"><strong>Visibility of item</strong></label>
        <input type="text" class="form-control" id="visible" placeholder="Show or hide this item">
    </div>
    <button class="btn btn-primary" name="insert" value="true">Add new item</button>
</form>

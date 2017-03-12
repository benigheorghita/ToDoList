
<?php if (isset($error) && !empty($error)){ ?>
<div class="alert alert-danger">
        <strong>Error!</strong> <?php echo $error ?>
    </div>
<?php } ?>

<?php if (isset($success) && !empty($success)){ ?>
<div class="alert alert-success">
  <strong>Success!</strong> <?php echo $success ?>
</div>
<?php } ?>


<form method='POST' action="/lists/create/">
    <div class="form-group">
        <label for="listName">Name of the list:</label>
        <input type="listName" class="form-control" name="listName">
    </div>
    <div class="form-group">
        <label for="listId">Parent:</label>
        <select class="form-control" id="parent"  name="parent">
            <option>None</option>
            <?php foreach ($existingLists as $content): ?>
                <option value='<?php echo $content['id'] ?>'><?php echo $content['name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-default">Create it!</button>
</form>



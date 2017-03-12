
<?php if (isset($error) && !empty($error)) { ?>
    <div class="alert alert-danger">
        <strong>Error!</strong> <?php echo $error ?>
    </div>
<?php } ?>

<form method='POST' action="<?php echo current_url(); ?>">
    <div class="form-group">
        <label for="taskName">Name of the task:</label>
        <input type="taskName" class="form-control" name="taskName" value="<?php echo $task['name'] ?>">
    </div>
    <div class="form-group">
        <label for="listId">List:</label>
        <select class="form-control" id="listId"  name="list_id">
            <option>None</option>
            <?php foreach ($existingLists as $content): ?>
                <option value='<?php echo $content['id'] ?>' <?php if ($task['list_id'] == $content['id']): ?> selected<?php endif; ?>>
                    <?php echo $content['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="content">Date Start:</label>
        <div class='input-group date'>
            <input type='text' class="form-control" name="datestart" id="datestart" value="<?php echo $task['date_start'] ?>"/>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
    </div>
    <div class="form-group">
        <label for="content">Date End:</label>
        <div class='input-group date'>
            <input type='text' class="form-control" name="dateend" id="dateend" value="<?php echo $task['date_stop'] ?>"/>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
    </div>
    <div class="form-group">
        <label for="content">Content:</label>
        <textarea class="form-control" rows="5" id="content" name="content"><?php echo $task['content'] ?></textarea>
    </div>
    <input type="hidden" name="id" value="<?php echo $task['id'] ?>">
    <button type="submit" class="btn btn-success">Save it!</button>
</form>

<script type="text/javascript">
    $(document).ready(function () {
        $('#datestart').datetimepicker({
            format: 'Y-m-d H:i:s'
        });
        $('#dateend').datetimepicker({
            format: 'Y-m-d H:i:s'
        });
    });
</script>

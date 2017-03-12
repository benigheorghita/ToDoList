<?php if (empty($task)) { ?>
<h3>Sorry but we don't have any data for the provided id.</h3>
<?php } else { ?>

<?php if ($task['date_completed'] == 0): ?>
<div class="actionButtons">
    <a href="<?php echo current_url(); ?>/edit" class="btn btn-sm btn-primary">Edit</a>
    <a href="<?php echo current_url(); ?>/delete" class="btn btn-sm btn-default">Delete</a>
    <a href="<?php echo current_url(); ?>/complete" class="btn btn-sm btn-success">Complete</a>
</div>
<?php endif; ?>

<div class="fixed-table-body">
    <table id="table" class="table table-hover">
    <thead>
        <tr>
            <th class="key" data-field="field">
                <div class="th-inner ">Field</div>
                <div class="fht-cell"></div>
            </th>
            <th data-field="value">
                <div class="th-inner ">Value</div>
                <div class="fht-cell"></div>
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="key" style="">Name:</td> 
            <td style=""><?php echo $task['name']; ?></td> 
        </tr>
        <tr> 
            <td class="key" style="">Content:</td> 
            <td style=""><?php echo $task['content']; ?></td> 
        </tr>
        <tr> 
            <td class="key" style="">Date Entered:</td> 
            <td style=""><?php echo $task['date_entered']; ?></td> 
        </tr>
        <tr> 
            <td class="key" style="">Date Start:</td> 
            <td style=""><?php echo $task['date_start']; ?></td> 
        </tr>
        <tr> 
            <td class="key" style="">Date End:</td> 
            <td style=""><?php echo $task['date_stop']; ?></td> 
        </tr>
        <tr> 
            <td class="key" style="">Completed:</td> 
            <td style=""><input type="checkbox" <?php echo ($task['date_completed'] != 0 ? 'checked' : ''); ?> disabled></td> 
        </tr>
        <tr> 
            <td class="key" style="">List:</td> 
            <td style=""><a href="<?php echo base_url() . 'list/' . $task['listid']; ?>"><?php echo $task['list']; ?></a></td> 
        </tr>
    </tbody>
    </table>
</div>

<?php } ?>
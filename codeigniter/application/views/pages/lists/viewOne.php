<?php if (empty($list)) { ?>
<h3>Sorry but we don't have any data for the provided id.</h3>
<?php } else { ?>

<?php if (!$childrenTasks): ?>
<div class="actionButtons">
    <a href="<?php echo current_url(); ?>/delete" class="btn btn-sm btn-default">Delete</a>
</div>
<?php endif; ?>

<p>Name: <?php echo $list['name']; ?></p>
<?php if (!empty($list['parentListName'])): ?>
    <p>Parent List: <?php echo $list['parentListName']; ?></p>
<?php endif; ?>
<p>Date Entered: <?php echo $list['date_created']; ?></p>

<?php if (!empty($childrenTasks)): ?>
<hr />
<h4>Tasks who belong to this list:</h4>
<hr />
<div class="list-group">
    <?php foreach ($childrenTasks as $childrenTask): ?>
    <a href="<?php echo base_url() . 'task/' . $childrenTask['id']; ?>" class="list-group-item"><?php echo $childrenTask['name']; ?></a>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<?php } ?>
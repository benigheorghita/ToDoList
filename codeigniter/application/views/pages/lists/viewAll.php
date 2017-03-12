<?php
    if (empty($lists)) {
?>
<h3>Unfortunately you don't have any available lists but you can easily <a href="<?php echo base_url(); ?>/lists/create">create a new one</a>.</h3>
<?php } else { ?>

<ul class="list-group">
<?php foreach ($lists as $list): ?>
    <li class="list-group-item">
        <a href="<?php echo base_url() . 'list/' . $list['id']; ?>"><?php echo $list['name']; ?></a> 
        <span class="badge"><?php echo $list['count']; ?></span>
    </li>
<?php endforeach; ?>
</ul>

<?php } ?>
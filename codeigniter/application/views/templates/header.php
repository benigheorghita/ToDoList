<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>To-do list App</title>

        <!-- Bootstrap -->
        <link href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>bootstrap/css/bootstrap-datepicker3.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>bootstrap/css/jquery.datetimepicker.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>css/custom.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>calendar/fullcalendar.min.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>calendar/fullcalendar.print.min.css" rel="stylesheet" media="print" />
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?php echo base_url(); ?>calendar/lib/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-datepicker.min.js"></script>
        <script src="<?php echo base_url(); ?>bootstrap/js/jquery.datetimepicker.full.min.js"></script>
        <script src="<?php echo base_url(); ?>calendar/lib/moment.min.js"></script>
        <script src="<?php echo base_url(); ?>calendar/fullcalendar.min.js"></script>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>
        <div class="content">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <ul class="nav navbar-nav">
                        <li <?php if (!$this->uri->segment(1)): ?>class="active"<?php endif; ?>>
                            <a class="nav-link" href="<?php echo base_url(); ?>">Home</a>
                        </li>
                        <li class="dropdown 
                            <?php if ($this->uri->segment(1) == 'list' || $this->uri->segment(1) == 'lists'): ?>active<?php endif; ?>
                        ">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo base_url(); ?>lists">Lists
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url(); ?>lists/create">Create</a></li>
                                <li><a href="<?php echo base_url(); ?>lists">View All</a></li>
                            </ul>
                        </li>
                        <li class="dropdown
                            <?php if ($this->uri->segment(1) == 'task' || $this->uri->segment(1) == 'tasks'): ?>active<?php endif; ?>
                        ">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Tasks
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url(); ?>tasks/create">Create</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <?php if (isset($title) && !empty($title)): ?>
                <h3><?php echo $title; ?></h3>
            <?php endif; ?>

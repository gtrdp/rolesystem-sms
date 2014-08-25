<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Dashboard | Rolesystem SMS</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo site_url('assets/css'); ?>/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo site_url('assets/css'); ?>//jumbotron-narrow.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">
      <div class="header">
        <ul class="nav nav-pills pull-right">
          <li <?php if($page == 'dashboard') echo 'class="active"'; ?>><a href="<?php echo site_url('main/dashboard'); ?>">Dashboard</a></li>
          <li <?php if($page == 'users') echo 'class="active"'; ?>><a href="<?php echo site_url('main/users'); ?>">Users</a></li>
          <li <?php if($page == 'logs') echo 'class="active"'; ?>><a href="<?php echo site_url('main/logs'); ?>">Logs</a></li>
          <li <?php if($page == 'send_sms') echo 'class="active"'; ?>><a href="<?php echo site_url('main/send_sms'); ?>">Send SMS</a></li>
          <li <?php if($page == 'logout') echo 'class="active"'; ?>><a href="<?php echo site_url('main/logout'); ?>">Logout</a></li>
        </ul>
        <h3 class="text-muted">Rolesystem SMS</h3>
      </div>
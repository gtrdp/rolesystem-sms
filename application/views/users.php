
<div class="content">
  <h1>Registered Numbers</h1>
  
  <?php if($notif): ?>
    <div class="alert alert-danger alert-dismissable">
      <strong>Error!</strong> <?php echo $notif; ?>
    </div>
  <?php endif; ?>

  <table class="table table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Phone Number</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 1; foreach($clients->result() as $row): ?>
      <tr>
        <td><?php echo $i++; ?></td>
        <td><?php echo $row->client_name; ?></td>
        <td><?php echo $row->phone_number; ?></td>
        <td>
          <a type="button" class="btn btn-default btn-xs" href="<?php echo site_url('main/logs/') . '/' . $row->id; ?>">
            <span class="glyphicon glyphicon-search"></span> See logs
          </a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

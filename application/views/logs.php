<div class="content">
  <h1>Communication Logs <small>+62 815 7876 2345</small></h1>

  <table class="table table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th>
          Datetime
          <small>
            <a href="<?php echo $sorting_link; ?>">
              <span class="glyphicon glyphicon-sort"></span>
            </a>
          </small>
        </th>
        <th>Message Content</th>
        <th>Type</th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 1; foreach($logs as $log): ?>
      <tr>
        <td><?php echo $i++; ?></td>
        <td><?php echo $log['date']; ?></td>
        <td><?php echo $log['message']; ?></td>
        <td>
          <?php if($log['type'] == 'in'): ?>
          <button type="button" class="btn btn-info btn-xs">
            <span class="glyphicon glyphicon-arrow-down"></span>
          </button>
          <?php else: ?>
            <button type="button" class="btn btn-success btn-xs">
            <span class="glyphicon glyphicon-arrow-up"></span>
          </button>
          <?php endif; ?>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

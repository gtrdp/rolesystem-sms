<div class="jumbotron">
  <h1>Rolesystem SMS</h1>
  <p class="lead">This is an admin page for Rolesystem-SMS: A SMS-based Consulting application. Below, you may see the statistical information about this system.</p>
  <p><a class="btn btn-lg btn-success" href="#" role="button">OK</a></p>
</div>

<div class="row marketing">
  <h3>Statictics</h3>
  <div class="col-lg-6">
    <h4>Registered Numbers</h4>
    <p>There are total</p>
    <p class="lead"><?php echo $stats['registered_number']; ?> <small>numbers.</small></p>

    <h4>SMS Count</h4>
    <p>Cumulative SMS count is</p>
    <p class="lead"><?php echo $stats['sms_count']; ?> <small>SMS.</small></p>

    <h4>Total Balance</h4>
    <p>This system has spent</p>
    <p class="lead"><small>Rp</small> <?php echo $stats['total_balance']; ?> <small>,00.</small></p>
  </div>

  <div class="col-lg-6">
    <h4>Total Cases</h4>
    <p>This system contains nearly</p>
    <p class="lead"> <?php echo $stats['total_case']; ?> <small>cases</small>.</p>

    <h4>Case Solved</h4>
    <p>This system has successfully solved.</p>
    <p class="lead"> <?php echo $stats['case_solved']; ?> <small>cases</small>.</p>

    <h4>SPAM Counter</h4>
    <p>The number of SPAM encountered</p>
    <p class="lead"> <?php echo $stats['spam_counter']; ?> <small>and counting</small>.</p>
  </div>
</div>
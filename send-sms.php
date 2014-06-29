
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Send SMS | Rolesystem SMS</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/jumbotron-narrow.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">
      <div class="header">
        <ul class="nav nav-pills pull-right">
          <li><a href="dashboard.php">Dashboard</a></li>
          <li><a href="users.php">Users</a></li>
          <li><a href="logs.php">Logs</a></li>
          <li class="active"><a href="send-sms.php">Send SMS</a></li>
        </ul>
        <h3 class="text-muted">Rolesystem SMS</h3>
      </div>

      <div class="content">
        <h1>Send SMS</h1>
        
        <form role="form">
          <div class="form-group">
            <label for="exampleInputEmail1">Phone Number</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="eg. 0815 7876 2345">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Message</label>
            <textarea class="form-control" rows="3"></textarea>
          </div>
          <button type="submit" class="btn btn-success">Send</button>
        </form>
        <br>
      </div>

      <div class="footer">
        <p>&copy; Rolesystem 2014</p>
      </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>

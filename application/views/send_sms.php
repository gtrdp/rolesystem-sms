
<div class="content">
  <h1>Send SMS</h1>

  <?php if($notif): ?>
    <div class="alert alert-success alert-dismissable">
      <strong>Success!</strong> <?php echo $notif; ?>
    </div>
  <?php endif; ?>
  
  <form role="form" method="post" action="<?php echo site_url('main/sms_sender'); ?>">
    <div class="form-group">
      <label for="exampleInputEmail1">Phone Number</label>
      <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="eg. 0815 7876 2345">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Message</label>
      <textarea class="form-control" rows="3" id="message" name="message"></textarea>
    </div>
    <button type="submit" class="btn btn-success">Send</button>
  </form>
  <br>
</div>

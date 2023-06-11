<form id=frm2>
  <h1>Customer</h1>
  <div class="form-group">
    <label for="email">Email address:</label>
    <input type="email" class="form-control" id="email" name='email'>
  </div>
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" class="form-control" id="pwd" name='pwd'>
  </div>
 
  <button type="submit" class="btn btn-default">Submit</button>
</form>
<a href='<?php echo $dir; ?>/newpass'>Lost My Pass</a><br>
<a href='<?php echo $dir; ?>/newaccount'>New Account</a><br>
<div  id="msg">

</div>

<form action="" id=frmuserdata>
  <div class="form-group">
    <label for="email">Email address:</label>
    <input type="email" class="form-control" id="email" name=email value='<?php echo $u->email; ?>'>
  </div>
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" class="form-control" id="pwd" name=pwd >
  </div>
<div class="form-group">
    <label for="fn">Fullname:</label>
    <input type="text" class="form-control" id="fn" name=fn value='<?php echo $u->fullname; ?>'>
  </div>
  <button type="submit" class="btn btn-default">Save</button>
</form>
 
<div id=msg>

</div>

<form  id=frmnewmsg>
  <div class="form-group">
    <label for="msg">Message:</label>
    <textarea  class="form-control" cols=7 rows=10 id="msg" name=msg required></textarea>
  </div>
   
  <button type="submit" class="btn btn-default">Send</button>
</form>

<div id=msg2>

</div>
<script>
$("#frmnewmsg").submit(()=>{
    event.preventDefault();
    $.post("index.php?q=newmsg", $("#frmnewmsg").serialize(),(res)=>{
        if(res=="1"){
				$("#msg2").html("Message Send");
			}
			else
			{
				$("#msg2").html("Error Send ");
			}
    });
})

</script>
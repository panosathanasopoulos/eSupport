$(document).ready(function(){

	// egrafi xristi
	$("#frm1").submit(function(){
		event.preventDefault();
		$.post("index.php?q=ins1",$("#frm1").serialize(),function(res){
			if(res=="1"){
				$("#msg").html("Customer inserted");
			}
			else
			{
				$("#msg").html("Error. Customer did not insert");
			}
		
		});
	
	
	});
 


	
	// syndesi xristi
	$("#frm2").submit(function(event){
		event.preventDefault();
		$.post("index.php?q=login",$("#frm2").serialize(),function(res){
			if(res=="1"){
				
			
			
				window.location.href="loginuser";
				
			}
			else
			{
				$("#msg").html("Error. User not found");
			}
		
		});
	
	
	});


	
	
	// syndesi diaxeiristi
	$("#frm2a").submit(function(){
		event.preventDefault();
		$.post("index.php?q=logina",$("#frm2a").serialize(),function(res){
			if(res=="1"){
				
			
			
				window.location.href="loginadmin";
				
			}
			else
			{
				$("#msg").html("Error. User not found");
			}
		
		});
	
	
	});
	
	
	
	$("#frmprofile").submit(function(event){
		event.preventDefault();
		$.post("index.php?q=upd1",$("#frmprofile").serialize(),function(res){
			if(res=="1"){
				$("#msg").html("Data Saved");
			}
			else
			{
				$("#msg").html("Error ");
			}
		
		});
	
	
	});


	$("#frmprofilea").submit(function(){
		event.preventDefault();
		$.post("index.php?q=upd2",$("#frmprofilea").serialize(),function(res){
			if(res=="1"){
				$("#msg").html("Data Saved");
			}
			else
			{
				$("#msg").html("Error ");
			}
		
		});
	
	
	});
	
	
	
	
	
	$("#frmuserdata").submit(function(){
		event.preventDefault();
		const url = window.location.search;
		const up = new URLSearchParams(url);
		var id=up.get('id');
		$.post("index.php?q=upd2&id="+id,$("#frmuserdata").serialize(),function(res){
			if(res=="1"){
				$("#msg").html("Data Saved");
			}
			else
			{
				$("#msg").html("Error ");
			}
		
		});
	
	
	});
	
	





});

function userrow(u)
{
	return `<tr><td> ${u.email} </td>
				<td> ${u.fullname}</td>
				<td> <a href='index.php?q=userdata&id=${u.id}'>edit</a></td></tr>`;
}

function getrole(r,id)
{

return `<div class='role1' id='${r}${id}'> ${r} <span onclick=\"delrole( '${r}',${id} )\">[x]</span> </div> `;

}

function delrole(r,id)
{
 $.get( "index.php?q=delrole&r="+r+"&id="+id,function(res){
	$("#"+r+id).hide();
 });

}

function getUsers()
	{
		$.getJSON("index.php?q=users",function(res){
			res.forEach(u => { $("#list").append(userrow(u)); });
			
		});
	
	}
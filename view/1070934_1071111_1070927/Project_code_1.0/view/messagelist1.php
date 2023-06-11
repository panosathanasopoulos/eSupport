<div class=container>
	<div class=row >
		<div class=col-md-12 id=msgdata>


        </div>
		
	</div>
</div> 
<script>
    var A=JSON.parse(<?php echo $M; ?>);
   
   
    for (var i=0;i<A.length;i++)
    {
        $("#msgdata").append(`<div id=msg${A[i].id} class=msg1>
                                    <h3>Message </h3><p>${A[i].minima}</p>
                                <p style='text-align:right'>${A[i].date1}</p>
                                </div>`);
    }
	
	
</script>
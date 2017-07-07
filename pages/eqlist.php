<?php


?>
<!-- equipmnet list header -->
<script src="/vendor/jQuery/jquery-3.1.1.min.js"></script>
<div class="container-fluid w3-card w3-white" id='searchcontainer'>
	<h1><i class='fa fa-list'></i> List of Equipment</h1>
	<h3>Search</h3>
	<div class="col-sm-8">
		<input type="text" id="searchbox" class="form-control"></input>
	</div>
	
	<button id="doSearchBtn" class="col-sm-1 btn btn-primary"><span class="glyphicon glyphicon-search"></span></button>
	<button type="button" class="btn btn-default" id="advancefilterbutton" data-toggle='collapse' data-target='#advancefilter'><i class="fa fa-plus"></i>  Advance Filter</button>
	<br />	
	

	<div class="row">
	<br />
		<div class="panel collapse container-fluid" id="advancefilter" >
			<label for="f-package">package: </label>
			<select id="f-package">
				<option value="pib">PIB</option>
				<option value="pic">PIC</option>
				<option value="pid">PID</option>
				<option value="pih">PIH</option>
				<option value="pik">PIK</option>
				<option value="pii">PII</option>
				<option value="piii">PIII</option>
			</select>
		</div>
	</div>
</div>
<div >
<div class="loader-container" id="loader"><div class="loader"></div></div>
<div id='searchResult'></div>
</div>

<script>
	function doSearch(){
			var query = $("#searchbox").val();
			$('#loader').show();
			$.get("/include/search.php",{q:query},function(data){
				$("#searchResult").html(data);
				$('#loader').hide();
			});	
	}
	$(document).ready(function(){
		doSearch();
		$("#doSearchBtn").click(function(){
			doSearch();
		});
	});

</script>

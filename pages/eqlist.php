<?php


?>
<!-- equipmnet list header -->
<div class="container w3-card w3-white" id='searchcontainer'>
	<div class="input-group col-sm-8 col-sm-offset-1">
	<input type="text" id="searchbox" class="form-control"><span class="glyphicon glyphicon-search input-group-addon"></span></input>
	</div>
	

	<div class="col-sm-offset-1">
	<button type="button" class="btn btn-default" id="advancefilterbutton" data-toggle='collapse' data-target='#advancefilter'><i class="fa fa-plus"></i>  Advance Filter</button>
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
<div id='search-result'></div>

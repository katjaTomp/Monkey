<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h2> XML IMPORTER</h2>
  <?php $modifiedBy=History::LastModifiedBy('xml'); echo 'The xml uploader has been last used by '.$modifiedBy.'.';echo'<a href="history-browser.php?module=xml"> More...</a>';?>
<p> Select the details for the import job. </p>
<form method="post" action="../controllers/import.php" role="form">
	<div class="form-group">
		<label for="environment" class="col-lg-2 control-label">Environement</label>  
        <select name="environment" style="width:30%">
        	<option value="development">Developement</option>
            <option value="staging">Staging</option>
        </select>
      </div>
      <div class="form-group">
		<label for="brand" class="col-lg-2 control-label">Brand</label>  
        <select name="brand" style="width:30%">
        	<option value="adidas">adidas</option>
            <option value="reebok">reebok</option>
        </select>
      </div>
      <div class="form-group">
		<label for="component" class="col-lg-2 control-label">Component Type</label>  
        <select name="component" style="width:30%">
        	<option value="asset">Asset</option>
            <option value="slot">Slot</option>
        </select>
      </div>
      <div class="form-group">
     	<label for="password" class="col-lg-2 control-label">Password</label>
     	<input type="password" name="rlmpass" class="form-control" style="width:30%;height:25px">
     </div>
      <div class="form-group">
        <label for="countries" class="col-lg-2 control-label"> Countries</label>
      </div><br />
      
     <div class="row">
     	<div class="col-lg-3">
        <div class="checkbox">
          <label><input type="checkbox" name="GB" value="GB">UK</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" name="DE" value="DE">Germany</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" name="FR" value="FR">France</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" name="IT" value="IT">Italy</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" name="ES" value="ES">Spain</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" name="NL" value="NL">Netherlands</label>
        </div>
      	<div class="checkbox">
          <label><input type="checkbox" name="BE" value="BE">Belgium</label>
       	</div>
       <div class="checkbox">
          <label><input type="checkbox" name="SE" value="SE">Sweden</label>
        </div>
      	
    </div>
    <div class="col-lg-3">
    	
      	<div class="checkbox">
          <label><input type="checkbox" name="FI" value="FI">Finland</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" name="DK" value="DK">Denmark</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" name="IE" value="IE">Ireland</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" name="CZ" value="CZ">Czech Republic</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" name="PL" value="PL">Poland</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" name="SK" value="SK">Slovakia</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" name="RU" value="RU">Russia</label>
        </div>
       </div>
      </div>

     <input type="hidden" name="file_id" value="<?php echo  $_GET['file'];?>">
	<button class="btn btn-small btn-success" type="submit" style="margin-top:10px">Import</button>

</div>
</form>
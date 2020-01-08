<!DOCTYPE html>
<html>
<head>
  <?php require($app_key.'/views/layouts/styles.html'); ?>
  <style>
  .error {color: #FF0000;}
  </style>
</head>
<body>
<?php require($app_key.'/views/layouts/nav.php'); ?>
<form id="form_create_table" method="post" action="/table/add_columns">
<input type="hidden" name="_token" value="<?php echo $rand; ?>"/>
<input type="hidden" name="name" value="<?php echo $table; ?>"/>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-6">
			Add Columns To Table "<?php echo $table; ?>"
		</div>
		<div class="col-md-6">
			<div class="btn-group" style="float:right;">
				<button type="submit" class="btn btn-default">Update Table</button>
				<a class="btn btn-default" href="/table/table_list">Back</a>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="table-responsive" style="padding-bottom: 100px;">
				<table class="table" id="table_fields">
					<thead>
						<tr>
							<th>Sr.No.</th>
							<th style="min-width: 200px;">Field Name</th>
							<th style="min-width: 200px;">Datatype</th>
							<th style="min-width: 150px;">Length/Value</th>
							<th style="min-width: 150px;">Default Value</th>
							<th style="min-width: 150px;">Index</th>
							<th style="min-width: 150px;">Field Position</th>
						</tr>
					</thead>
					<tbody>
						<?php for($i=1; $i<=$fn; $i++): ?>
						<tr>
							<td><?php echo $i; ?></td>
							<td>
								<div class="form-group">
									<input type="text" name="field_name[<?php echo $i; ?>]" class="form-control" placeholder="Field Name" value="<?php echo  $old['field_name.'.$i] ; ?>" />
									<?php if($error['field_name.'.$i]): ?>
								<p style="color:red"><?php echo $error['field_name.'.$i]; ?></p> <?php endif; ?>
								</div>
							</td>
							<td>
								<div class="form-group">
									<select class="form-control" id="field_type_<?php echo $i; ?>" name="field_type[<?php echo $i; ?>]" onchange="ls(<?php echo $i; ?>)"> 
    <option title="A variable-length (0-65,535) string, the effective maximum length is subject to the maximum row size" value="string">string</option>
    <option title="A 4-byte integer, signed range is -2,147,483,648 to 2,147,483,647, unsigned range is 0 to 4,294,967,295" value="unsignedInteger">unsignedInteger</option>
    <option title="A TEXT column with a maximum length of 65,535 (2^16 - 1) characters, stored with a two-byte prefix indicating the length of the value in bytes" value="text">text</option>
    <option title="A TEXT column with a maximum length of 4,294,967,295 or 4GiB (2^32 - 1) characters, stored with a four-byte prefix indicating the length of the value in bytes" value="longText">longText</option>
    <option title="A timestamp, range is 1970-01-01 00:00:01 UTC to 2038-01-09 03:14:07 UTC, stored as the number of seconds since the epoch (1970-01-01 00:00:00 UTC)" value="timestamp">timestamp</option>
    <optgroup label="Numeric">
    	<option title="A 1-byte integer, signed range is -128 to 127, unsigned range is 0 to 255" value="tinyInteger">tinyInteger</option>
    	<option title="A 1-byte integer, signed range is -128 to 127, unsigned range is 0 to 255" value="unsignedTinyInteger">unsignedTinyInteger</option>
    	<option title="A 2-byte integer, signed range is -32,768 to 32,767, unsigned range is 0 to 65,535" value="smallInteger">smallInteger</option>
    	<option title="A 2-byte integer, signed range is -32,768 to 32,767, unsigned range is 0 to 65,535" value="unsignedSmallInteger">unsignedSmallInteger</option>
    	<option title="A 3-byte integer, signed range is -8,388,608 to 8,388,607, unsigned range is 0 to 16,777,215" value="mediumInteger">mediumInteger</option>
    	<option title="A 3-byte integer, signed range is -8,388,608 to 8,388,607, unsigned range is 0 to 16,777,215" value="unsignedMediumInteger">unsignedMediumInteger</option>
    	<option title="A 4-byte integer, signed range is -2,147,483,648 to 2,147,483,647, unsigned range is 0 to 4,294,967,295" value="integer">integer</option>
    	<option title="A 4-byte integer, signed range is -2,147,483,648 to 2,147,483,647, unsigned range is 0 to 4,294,967,295" value="unsignedInteger">unsignedInteger</option>
    	<option title="An 8-byte integer, signed range is -9,223,372,036,854,775,808 to 9,223,372,036,854,775,807, unsigned range is 0 to 18,446,744,073,709,551,615" value="bigInteger">bigInteger</option>
    	<option title="An 8-byte integer, signed range is -9,223,372,036,854,775,808 to 9,223,372,036,854,775,807, unsigned range is 0 to 18,446,744,073,709,551,615" value="unsignedBigInteger">unsignedBigInteger</option>
    	<option disabled="disabled">-</option>
    	<option title="A fixed-point number (M, D) - the maximum number of digits (M) is 65 (default 10), the maximum number of decimals (D) is 30 (default 0)" value="decimal">decimal</option>
    	<option title="A fixed-point number (M, D) - the maximum number of digits (M) is 65 (default 10), the maximum number of decimals (D) is 30 (default 0)" value="unsignedDecimal">unsignedDecimal</option>
    	<option title="A small floating-point number, allowable values are -3.402823466E+38 to -1.175494351E-38, 0, and 1.175494351E-38 to 3.402823466E+38" value="float">float</option>
    	<option title="A double-precision floating-point number, allowable values are -1.7976931348623157E+308 to -2.2250738585072014E-308, 0, and 2.2250738585072014E-308 to 1.7976931348623157E+308" value="double">double</option>
    	<option disabled="disabled">-</option>
    	<option title="A synonym for TINYINT(1), a value of zero is considered false, nonzero values are considered true" value="boolean">boolean</option>
    </optgroup>
    <optgroup label="Date and time">
    	<option title="A date, supported range is 1000-01-01 to 9999-12-31" value="date">date</option>
    	<option title="A date and time combination, supported range is 1000-01-01 00:00:00 to 9999-12-31 23:59:59" value="dateTime">dateTime</option>
    	<option>dateTimeTz</option>
    	<option title="A time, range is -838:59:59 to 838:59:59" value="time">time</option>
    	<option title="A time, range is -838:59:59 to 838:59:59" value="timeTz">timeTz</option>
    </optgroup>
    <optgroup label="String">
    	<option title="A fixed-length (0-255, default 1) string that is always right-padded with spaces to the specified length when stored" value="char">char</option>
    	<option title="A variable-length (0-65,535) string, the effective maximum length is subject to the maximum row size" value="string">string</option>
    	<option disabled="disabled">-</option>
    	<option title="A TEXT column with a maximum length of 65,535 (2^16 - 1) characters, stored with a two-byte prefix indicating the length of the value in bytes" value="text">text</option>
    	<option title="A TEXT column with a maximum length of 16,777,215 (2^24 - 1) characters, stored with a three-byte prefix indicating the length of the value in bytes" value="mediumText">mediumText</option>
    	<option title="A TEXT column with a maximum length of 4,294,967,295 or 4GiB (2^32 - 1) characters, stored with a four-byte prefix indicating the length of the value in bytes" value="longText">longText</option>
    	<option disabled="disabled">-</option>
    	<option title="A BLOB column with a maximum length of 65,535 (2^16 - 1) bytes, stored with a two-byte prefix indicating the length of the value" value="binary">binary(BLOB)</option>
    	<option disabled="disabled">-</option>
    	<option title="An enumeration, chosen from the list of up to 65,535 values or the special '' error value" value="enum">enum</option>
    </optgroup>
    <optgroup label="Geometrical">
    	<option title="A type that can store a geometry of any type">geometry</option>
    	<option title="A point in 2-dimensional space">point</option>
    	<option title="A curve with linear interpolation between points">lineString</option>
    	<option title="A polygon">polygon</option>
    	<option title="A collection of points">multiPoint</option>
    	<option title="A collection of curves with linear interpolation between points">multiLineString</option>
    	<option title="A collection of polygons">multiPolygon</option>
    	<option title="A collection of geometry objects of any type">geometryCollection</option>
    </optgroup>
    <optgroup label="Special">
    	<option title="IP address equivalent.">ipAddress</option>
    	<option title="MAC address equivalent.">macAddress</option>
    	<option title="uuid equivalent.">uuid</option>
    	<option title="year equivalent.">year</option>
    </optgroup>
</select>
<?php if($error['field_type_.'.$i]): ?>
									<p style="color:red"><?php echo $error['field_type_.'.$i]; ?></p> <?php endif; ?>
								</div>
							</td>
							<td>
								<div class="form-group">
									<input type="text" id="field_param_<?php echo $i; ?>" name="field_param[<?php echo $i; ?>]" class="form-control" placeholder="Length/Value" value="<?php echo  $old['field_param.'.$i] ; ?>" />
									<?php if($error['field_param.'.$i]): ?>
									<p style="color:red"><?php echo $error['field_param.'.$i]; ?></p> <?php endif; ?>
								</div>
							</td>
							<td>
								<div class="form-group">
									<input type="text" name="field_default[<?php echo $i; ?>]" class="form-control" placeholder="Default Value" value="<?php echo  $old['field_default.'.$i] ; ?>" />
									<?php if($error['field_default.'.$i]): ?>
									<p style="color:red"><?php echo $error['field_default.'.$i]; ?></p> <?php endif; ?>
								</div>
							</td>
							<td>
								<select name="field_key[<?php echo $i; ?>]" class="form-control">
								    <option value="null">---</option>
								    <option value="primary">PRIMARY</option>
								    <option value="unique">UNIQUE</option>
								    <option value="index">INDEX</option>
								</select>
								<?php if($error['field_key.'.$i]): ?>
									<p style="color:red"><?php echo $error['field_key.'.$i]; ?></p> <?php endif; ?>
							</td>
							<td>
								<select id="field_pos_<?php echo $i; ?>" name="field_pos[<?php echo $i; ?>]" class="form-control">
								    <option>---</option>
								    <?php foreach ($fields as $key => $field): ?>
								    <option><?php echo $field; ?></option>
								    <?php endforeach; ?>
								</select>
								<?php if($error['field_pos.'.$i]): ?>
									<p style="color:red"><?php echo $error['field_pos.'.$i]; ?></p> <?php endif; ?>
							</td>
						</tr>
						<?php endfor; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</form>
<script>
	var tt='<?php json_encode($error); ?>';
<?php if(array_key_exists('field_type1',$old): ?>
	<?php for($i=1; $i<$fn+1; $i++): ?>
	$("#field_type_<?php echo $i; ?>").val("<?php echo $old['field_type.'.$i]; ?>");
	$("#field_key_<?php echo $i; ?>").val("<?php echo $old['field_key.'.$i]; ?>");
	$("#field_pos_<?php echo $i; ?>").val("<?php echo $old['field_pos.'.$i]; ?>");
	<?php endfor; ?>
<?php endif; ?>
	var types = {'decimal':'8,2','unsignedDecimal':'8,2','float':'8,2','double':'','char':'1','string':'255','enum':'option1, option2, option3'};
	function ls(i){
		$("#field_param_"+String(i)).attr('disabled', false);
		var type = $("#field_type_"+String(i)).val();
		if(!types[type]){
			$("#field_param_"+String(i)).attr('placeholder','Optional Input Not Required');
			$("#field_param_"+String(i)).attr('disabled', true);
		}else{
			$("#field_param_"+String(i)).attr('placeholder',types[type]);
		}
	}
	for (var i = 1; i < <?php echo $fn+1; ?>; i++) {
		ls(i);
	};
</script>
<?php require($app_key.'/views/layouts/scripts.html'); ?>
</body>
</html>
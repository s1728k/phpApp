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
<div class="container-fluid">
	<div id="alrt"></div>
	<div class="row">
		<div class="col-md-6">
			CRUD Table "{{$table}}"
		</div>
		<div class="col-md-6">
			<div class="btn-group" style="float:right;">
				<a class="btn btn-default" href="/table/add_record?table={{$table}}">Add New Record</a>
				<a class="btn btn-default" href="/table/table_list">Back</a>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="table-responsive" style="padding-bottom: 100px;">
				<table class="table">
					<thead>
						<tr>
							@foreach($td as $k => $v)
							<th>{{$v->Field}}</th>
							<?php endforeach; ?>
						</tr>
					</thead>
					<tbody>
						@foreach($records as $record)
						<tr id="r{{$record->id}}">
							@foreach($td as $k => $v)
							<td style="word-break: break-all;">{{$record[$v->Field]}}</td>
							<?php endforeach; ?>
							<td><a href="/table/edit_record_view?table={{$table}}&id={{$record->id??''}}" >Edit</a></td>
							<td><a style="cursor: pointer;" onclick="d('{{$record->id}}', '{{$table}}')">Delete</a></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
	        <div class="col-md-12">
	          <?php include($app_key.'/layouts/pagination.php') ?>
	        </div>
		</div>
	</div>
</div>
<script>
  function d(id, table){
    $.post("/table/delete_record", {"_token":"<?php echo $rand; ?>", "id":id, "table":table, "_method":"DELETE"}, function(data) {
      if(data['status'] == 'success'){
        $('#r'+id).remove();
        $('#alrt').html('<div class="alert alert-success"><strong>Success!</strong> Record was successfully removed.</div>');
      }else{
        $('#alrt').html('<div class="alert alert-warning"><strong>Warning!</strong> Record was not removed.</div>');
      }
    })
  }
</script>
<?php require($app_key.'/views/layouts/scripts.html'); ?>
</body>
</html>
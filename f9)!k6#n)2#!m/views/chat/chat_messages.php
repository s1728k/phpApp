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
      Chat Messages | for the app id: {{\Auth::user()->active_app_id}}
    </div>
    <div class="col-md-6">
      <div class="btn-group" style="float:right">
        <a class="btn btn-default" href="{{ route('c.chat.requests') }}">Chat Requests</a>
        <a class="btn btn-default" href="{{ route('c.chat.can_chat_with') }}">Chat Settings</a>
        <a class="btn btn-default" href="{{ route('c.chat.ccac.view') }}">Customer Care App Configuration</a>
      </div>
    </div>
  </div>
	<div class="row">
		<div class="col-md-12 table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>Sr</th>
            <th>message</th>
            <th>fid</th>
            <th>fap</th>
            <th>fname</th>
            <th>tid</th>
            <th>tap</th>
            <th>tname</th>
            <th>style</th>
            <th>status</th>
            <th>updated_at</th>
						<th colspan="2">Actions</th>
					</tr>
				</thead>
				<tbody>
          @foreach($messages as $message)
          <tr id="r{{$message->id}}">
            <td>{{ ($loop->index + 1) + 10 * ($page-1)}}</td>
            <td>{{$message->message}}</td>
            <td>{{$message->fid}}</td>
            <td>{{$message->fap}}</td>
            <td>{{$message->fname}}</td>
            <td>{{$message->tid}}</td>
            <td>{{$message->tap}}</td>
            <td>{{$message->tname}}</td>
            <td>{{$message->style}}</td>
            <td>{{$message->status}}</td>
            <td>{{$message->updated_at}}</td>
            <td><a style="cursor: pointer;" onclick="updateMsgDialog('{{$message->id}}','{{$message->message}}','{{$message->style}}','{{$message->status}}')">Update</a></td>
            <td><a style="cursor: pointer;" onclick="delMsg('{{$message->id}}')">Delete</a></td>
          </tr>
          @endforeach
				</tbody>
			</table>
      {{$messages->appends(request()->input())->links()}}
		</div>
	</div>
</div>
<script>
  function updateMsgDialog(id, msg, style, status){
  	$("#chat_id").val(id);
  	$("#message").val(msg);
  	$("#style").val(style);
  	$("#status").val(status);
  	$("#updateChat").modal();
  }
  function updateMsg(){
  	$.post('{{ route('c.chat.message.update') }}',{"_token":"<?php echo $rand; ?>","id":$("#chat_id").val(),"_method":"put","message":$("#message").val(),"style":$("#style").val(),"status":$("#status").val() },function(data, status){
  		if(status == 'success'){
  			location.replace(window.location.href);
  		}
  	});
  }
  function delMsg(id){
    var bool = confirm("Are you sure! you want to remove Chat Message ");
    if(!bool){
      return;
    }
    $.post('{{route('c.chat.message.delete')}}', {"id":id,"_token":"<?php echo $rand; ?>","_method":"delete"}, function(data, status){
      if(status == 'success'){
        $('#r'+id).remove();
        $('#alrt').html('<div class="alert alert-success"><strong>Success!</strong> Chat Message was successfully removed.</div>');
      }else{
        $('#alrt').html('<div class="alert alert-warning"><strong>Warning!</strong> Chat Message was not removed.</div>');
      }
    })
  }
</script>

<!-- Modal -->
<div id="updateChat" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Chat Message</h4>
      </div>
      <div class="modal-body">
      	<input type="hidden" name="_token" value="<?php echo $rand; ?>" />
				<input type="hidden" name="_method" value="PUT" />
				<input type="hidden" name="id" id="chat_id" />
        <div class="form-group">
          <label>Message</label>
          <textarea rows="3" id="message" class="form-control" placeholder="New message here"></textarea>
        </div>
        <div class="form-group">
          <label>Style</label>
          <input id="style" class="form-control" placeholder="Style" />
        </div>
        <div class="form-group">
          <label>Status</label>
          <select class="form-control" id="status">
          	<option>saved</option><option>sent</option><option>received</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-default" data-dismiss="modal" onclick="updateMsg()">Update</button>
      </div>
    </div>

  </div>
</div>
<?php require($app_key.'/views/layouts/scripts.html'); ?>
</body>
</html>
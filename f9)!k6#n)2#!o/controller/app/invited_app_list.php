<?php include($app_key.'/include/csrf_token.php'); ?>

<?php
include($app_key.'/model/App.php');

$app_ids = json_decode($_SESSION[$app_key]['invited_apps']??"[0]",true);
$filter = [['id','in',$app_ids]];

$pageno = $_GET['pageno']??1;
$no_of_records_per_page = 10;
$offset = ($pageno-1) * $no_of_records_per_page;
$total_pages = ceil(App::where(null,null,'visibles','count',$filter) / $no_of_records_per_page);

$apps = App::where($offset, $no_of_records_per_page,'visibles',null,$filter);
$active_app = App::find($_SESSION[$app_key]["active_app_id"]);
?>

<?php 
include($app_key.'/view/app/invited_app_list.php'); 
?>
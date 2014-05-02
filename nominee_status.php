<?php
require_once("class/master.class.php");
$object = new master;
if(isset($_REQUEST['id']) && isset($_REQUEST['status'])){
    $object->set_nominee_status($_REQUEST['id'],$_REQUEST['status']);
    
}
    header("Location:".SITEURL."/show_nominees.php");
?>

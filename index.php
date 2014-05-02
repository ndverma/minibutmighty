<?php
require_once("class/master.class.php");
$object = new master;
$status = $object->get_campaign_status(DEFAULT_CAMP);
$allstatus = $object->get_campaign_status();
if($status == $allstatus['Active']){
    echo "add nomination";
    header("Location:".SITEURL."/add_nominee.php");
}elseif($status == $allstatus['Not-Active']){
    header("Location:".SITEURL."/finalists.php");
}else{
    header("Location:http://www.auntieannes.com");
}
?>
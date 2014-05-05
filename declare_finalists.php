<?php
require_once("class/master.class.php");
$object = new master;
$allstatus = $object->get_campaign_status();
$nomineestatus = $object->get_nominee_status();
$finalists = $_REQUEST['finalists'];

if($finalists){
    foreach($finalists as $finalist){
        $object->set_nominee_status($finalist, $nomineestatus['Finalist']);
    }

    $object->set_campaign_status(DEFAULT_CAMP, $allstatus['Not-Active']);
}   
    header("Location:".SITEURL."/index.php");
?>

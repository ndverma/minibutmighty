<?php
require_once("class/master.class.php");
$object = new master;
$status = $object->get_campaign_status(DEFAULT_CAMP);
$allstatus = $object->get_campaign_status();
$nomineestatus = $object->get_nominee_status();
if(!isset($_REQUEST['id']) && !isset($_REQUEST['cid']))
{
    header("Location:".SITEURL."/index.php");
}
else{
    $nominee = $object->get_nominee($_REQUEST['id'], $_REQUEST['cid']);
    $nomination_by = $object->get_nomination_by($nominee['nomination_by'], $_REQUEST['cid']);
    //print_r($nomination_by);
}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<html>
<head>
<meta charset="utf-8">
<title>Nominee PopUp</title>
<link href="css/master.css" rel="stylesheet" media="screen">
<script src="js/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="js/jquery.jqtransform.js" ></script>
<script type="text/javascript" src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="js/common.js" ></script>
</head>

<body>
<!--container start-->
	<section id="content_1" class="nominee-pop-content">
  		  		<aside class="nominee-content-left float-left">
                	<aside class="pop-up-img-content">
                    	<img src="<?php echo SITEURL;?>/images/nominee/<?php echo $nominee['img'];?>" width="225" alt="">
                    </aside>
                    <aside class="pop-up-arrows">
                    	<a href="#" class="arrow-left"></a>
                        <a href="#" class="arrow-right"></a>                        
                    </aside>
                </aside>
                <aside class="nominee-content-right float-left">
                    <h3><?php echo $nominee['name'];?></h3>
                    <h4><?php echo $nominee['city'];?>, <?php echo $nominee['state'];?></h4>
                    <span class="nominated-title">Nominated by <?php echo $nomination_by['name'];?></span>
                    <div class="nominatee-decription">
                    <p>
                        <?php echo $nominee['description']; ?>
                    </p>
                    </div>
                </aside>
                <div class="clear"></div>
    </section>
 <!--container start-->
</body>
</html>

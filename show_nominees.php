<?php
require_once("class/master.class.php");
$object = new master;
$nomineestatus = $object->get_nominee_status();

if(isset($_REQUEST['submitfinalists'])){
    $finalists = $_REQUEST['finalists'];
    if(count($finalists)!=10)
    {
        echo "<p class='text-center error-msg'>Please select 10 finalists!!</p>";
    }else{
        foreach($finalists as $finalist){
            $object->set_nominee_status($finalist, $nomineestatus['Finalist']);
        }
        $object->set_campaign_status(DEFAULT_CAMP, $allstatus['Not-Active']);
    }

    
}

$status = $object->get_campaign_status(DEFAULT_CAMP);
$allstatus = $object->get_campaign_status();

if($status == $allstatus['Active']){
    $all_nominees_list =  $object->get_all_nominees(DEFAULT_CAMP);    
}elseif($status == $allstatus['Not-Active']){
    header("Location:finalists.php");
}






//print_r($all_nominees_list);
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>::  AuntieAnne's ::</title>
        <link rel="stylesheet" href="colorbox/colorbox.css">
        <link href="css/master.css" rel="stylesheet" media="screen">
        <script src="js/jquery-1.11.0.min.js"></script>
        <script src="colorbox/jquery.colorbox.js"></script>
        <script src="colorbox/jquery.colorbox-min.js"></script>
        <script type="text/javascript" src="js/jquery.jqtransform.js" ></script>
        <script type="text/javascript" src="js/jquery.mCustomScrollbar.concat.min.js"></script>
        <script type="text/javascript" src="js/common.js" ></script>
    </head>
    <body>
        <?php if($_SESSION['name'] == ADMINUSER){ ?>        
        <form id="declarefinalistform" method="post" action="">
        <?php }else{ ?>
        
        <?php } ?>
        <div class="entries-section">
            <aside class="entries-header">
                ENTRIES
                <?php if($_SESSION['name'] == ADMINUSER){ ?>
                    <p style="float: right;background-color: #FFFFFF;"><a href = "<?php echo SITEURL;?>/admin.php?logout=1">Logout</a><p>
                <?php } ?>
            </aside>
            <article class="gallery-content" id="content_1">                
               
            <?php
            $sr=0;
            foreach($all_nominees_list as $key => $value)
            {
                 //print_r($value); die;
                if($_SESSION['name'] != ADMINUSER && $value[8] == $nomineestatus['Deactive'])
                {
                    continue;
                }
            ?>
                        
                <aside class="box-content float-left">
                    <aside class="img-content">
                        <a class ="nomineegallery" href="<?php echo SITEURL;?>/nominee.php?id=<?php echo $value[0]; ?>&cid=<?php echo DEFAULT_CAMP;?>"><img id ="nomineeimg" src="<?php echo SITEURL;?>/images/nominee/<?php echo $value[5];?>" width="168" height="188"></a>
                    </aside>
                    <h4><?php echo $value[3];?><br> <?php echo $value[10];?>, <?php echo $value[11];?></h4>
                
                    <?php 
                        if($_SESSION['name'] == ADMINUSER)
                        {
                           
                            if($value[8] == $nomineestatus['Active'])
                            {
                    ?> 
                    
                    <h4>
                        <a href="<?php echo SITEURL;?>/nominee_status.php?id=<?php echo $value[0]; ?>&status=<?php echo $nomineestatus['Deactive'];?>">Deactivate</a>
                                      
                        Finalist: <input type="checkbox" id="finalists" name="finalists[]" value="<?php echo $value[0]; ?>"/>
                    </h4>          
                                
                    <?php
                            }
                            else
                            {
                    ?>
                                <h4><a href="<?php echo SITEURL;?>/nominee_status.php?id=<?php echo $value[0]; ?>&status=<?php echo $nomineestatus['Active'];?>">Activate</a></h4>
                
                    <?php
                            }
                        }
                    ?>
                </aside>
            <?php }?>
             <div class="clear"></div> 
             </article>
        </div>
        
        
        <?php if($_SESSION['name'] == ADMINUSER){ ?>
            <div class="submit-btn text-center">
                <input class ="submit submit-btn" type="submit" value="Declare Selected as Finalists" name="submitfinalists"/>
            </div>
        </form>
        <?php } ?>
        
        <!--footer  start-->
        <footer class="text-center"> COPYRIGHT &copy; 2014 BY AUNTIE ANNE'S, INC.  | <a href="http://www.focusbrands.com/privacy-policy" target="_blank">PRIVACY POLICY</a> | <a href="#">CONTEST RULES</a> </footer>
        <!--footer  ends-->
            
     </body>
</html>
<script>
    $("a.nomineegallery").colorbox({rel:'gal',scalePhotos:true,width:'700',height:'500',scrolling:false,closeButton:false});    
    
    $("a.nomineegallery").colorbox({
        onComplete:function(){ 
            $("#content_2").mCustomScrollbar(
            {
                    scrollButtons:{enable:true},
                    advanced:{ updateOnContentResize: true}

            });

        }

    });
    
    $('#declarefinalistform').submit(function(){
        var count_finalists = $(this).find('input[name="finalists[]"]:checked').length;
        if(count_finalists != 10){
            alert("Please select 10 finalists!!");
        }
        return false;
    })
    
    
</script>

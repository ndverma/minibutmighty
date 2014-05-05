<?php
require_once("class/master.class.php");
$object = new master;
$status = $object->get_campaign_status(DEFAULT_CAMP);
$allstatus = $object->get_campaign_status();
$nomineestatus = $object->get_nominee_status();
if($status == $allstatus['Active']){
    $all_nominees_list =  $object->get_all_nominees(DEFAULT_CAMP);    
}elseif($status == $allstatus['Not-Active']){
    header("Location:finalists.php");
}



//print_r($all_nominees_list);
?>
<!--<script src="jquery-1.11.0.min.js"></script>
<link rel="stylesheet" type="text/css" href="shadowbox/shadowbox.css">
<script type="text/javascript" src="shadowbox/shadowbox.js"></script>
<script type="text/javascript">
    Shadowbox.init();
</script>-->
<html>
    <head>
        <link rel="stylesheet" href="colorbox/colorbox.css">
        <script src="jquery-1.11.0.min.js"></script>
        <script src="colorbox/jquery.colorbox-min.js"></script>
    </head>
    <body>
        <?php if($_SESSION['name'] == ADMINUSER){ ?>
        <a href = "<?php echo SITEURL;?>/admin.php?logout=1">Logout</a>
        <form method="post" action="declare_finalists.php">
        <?php }else{ ?>
        
        <?php } ?>
        <table align="center"  rules="all" border="1">
                <tr>
                        <td align="center" colspan="4">
                                <h1>ENTRIES</h1>
                        </td>
                </tr>
                <tr>
                <?php
                $sr=0;
                foreach($all_nominees_list as $key => $value)
                {
                    if($_SESSION['name'] != ADMINUSER && $value[8] == $nomineestatus['Deactive'])
                    {
                        continue;
                    }
                ?>
                        <td>
                                <center>
                                    <a class ="nomineegallery" href="<?php echo SITEURL;?>/nominee.php?id=<?php echo $value[0]; ?>&cid=<?php echo DEFAULT_CAMP;?>"><img id ="nomineeimg" src="<?php echo SITEURL;?>/images/nominee/<?php echo $value[5];?>" width="250" height="220"></a>
                                </center>
                                <br>
                                <?php echo $value[3];
                                    if($_SESSION['name'] == ADMINUSER){
                                        //print_r($nomineestatus); die;
                                        if($value[8] == $nomineestatus['Active'])
                                        {
                                ?>

                                            <a href="<?php echo SITEURL;?>/nominee_status.php?id=<?php echo $value[0]; ?>&status=<?php echo $nomineestatus['Deactive'];?>">Deactivate</a>
                                            <!--/*this will be enabled when we will work on finalist screen */ Finalist: <input type="checkbox" id="finalists" name="finalists[]" value="<?php echo $value[0]; ?>"/>-->

                                <?php
                                        }else{
                                ?>
                                            <a href="<?php echo SITEURL;?>/nominee_status.php?id=<?php echo $value[0]; ?>&status=<?php echo $nomineestatus['Active'];?>">Activate</a>
                                <?php
                                        }
                                    }
                                ?>

                                <br>
                        </td>
                    
                <?php
                    $sr++;
                    if( ( $sr % 4)  == 0 )
                    {
                            echo "</tr><tr>";
                    }
                }
                ?>
                </tr>
        </table>
        
        <?php if($_SESSION['name'] == ADMINUSER){ ?>
        <!--/*this will be enabled when we will work on finalist screen */ <input type="submit" value="Declare Selected as Finalists" name="submitfinalists"/>-->
        </form>
        <?php }else{ ?>
            <a href = "<?php echo SITEURL;?>">Home</a>
        <?php } ?>
    </body>
</html>
<script>
    $("a.nomineegallery").colorbox({rel:'gal',scrolling:'true',scalePhotos:'true',width:'350',height:'400'});    
</script>

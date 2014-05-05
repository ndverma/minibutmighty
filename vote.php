<?php

    require_once("class/master.class.php");
    $object = new master;
    $finalists = $object->get_finalists(DEFAULT_CAMP);
    //print_r($finalists);
    
    if(isset($_REQUEST['addvote']) && isset($_REQUEST['selected'])){
        $result = $object->add_vote($_REQUEST['selected']);
        echo $result; die;
        
    }
    
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>::  AuntieAnne's ::</title>
    <link href="css/master.css" rel="stylesheet" media="screen">  
    
</head>

<body>

<?php if(isset($_REQUEST['addvote'])){ ?>
<!--container start-->

  <!--Middle start-->
  <aside class="voteshare-popup">
  <div class="close"><a href="#" onclick="closepopup()"></a></div>
  <h3>THANK YOU FOR VOTING!</h3>
  <div class="social-btn">
  <a class="fb-share" href="#"></a>
  <a class="twitter-share" href="#"></a>
  </div>
  
<div class="clear"></div>
  </aside>
  
  
  <!--Middle ends--> 

<!--container ends-->  
<?php }else{ ?>
<!--container start-->

  <!--Middle start-->
<aside class="vote-popup">
    <div class="close"><a href="#" onclick="closepopup()"></a></div>
    <h3>Select Finalist:</h3>    
        <div class="custom-form vote-select">
            <form method="post" action="">
                <select id="select_nominee">
                    <?php foreach($finalists as $finalist){?>
                        <option value="<?php echo $finalist['id']?>"><?php echo $finalist['name']?> - <?php echo $finalist['city']?>, <?php echo $finalist['state']?></option>
                    <?php }?>
                </select>
                <div class="clear"></div>
                <div class="submit-btn text-center">
                <a class ="submit" id="addvote" href="#">Submit</a>
                </div>
            </form>
        </div>

        
    <div class="clear"></div>
</aside>
  
  
  <!--Middle ends--> 

<!--container ends-->
<?php } ?>
</body>
</html>
<script>
    $("#addvote").click(function(){
      var postData = {};
      postData.selected = $("#select_nominee").val();
      postData.addvote = 1;
      $.ajax({
            url: '<?php echo SITEURL.'/vote.php';?>',
            method: 'POST',
            data : postData,
            dataType: 'json',
            success: function(response) {
                if(response.length != 0){            
                    if(jQuery(window.parent.document).find("#hiddenvote").length){
                        var prev = jQuery(window.parent.document).find("#hiddenvote");
                        jQuery(prev).trigger('click');
                    }
                } else {
                    console.log("unable to vote");

                }        

            },
            error: function() {
                //something went wrong
            }
      }); 
        
    }); 
        
   
    
    function closepopup()
    {
        if(jQuery(window.parent.document).find("#cboxClose").length){
            var prev = jQuery(window.parent.document).find("#cboxClose");
            jQuery(prev).trigger('click');
        }
    }
</script>
<?php

    require_once("class/master.class.php");
    $object = new master;
    $finalists = $object->get_finalists(DEFAULT_CAMP);
    //print_r($finalists);

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
<!--container start-->
<section  class="container"> 
  <!--header start-->
  <header>
    <aside class="auntie-anne-logo float-left">
        <a href="http://www.auntieannes.com" target="_blank"></a>
        </aside>
        <aside class="call-to-action float-right">
            <a class="fb" href="https://www.facebook.com/auntieannespretzels" target="_blank"></a>
            <a class="twetter" href="https://twitter.com/AuntieAnnes" target="_blank"></a>
            <a class="instagram" href="http://instagram.com/auntieannespretzels/" target="_blank"></a>
            <a class="youtube mrg-0" href="https://www.youtube.com/user/AuntieAnnesPretzels" target="_blank"></a>
        </aside>
        <div class="clear"></div>
  </header>
  <!--header ends--> 
  <?php if($_SESSION['name'] == ADMINUSER){ ?>
            <p style="float: right;background-color: #FFFFFF;"><a href = "<?php echo SITEURL;?>/admin.php?logout=1">Logout</a><p>
        <?php } ?>
  <!--finalist-banner start-->
  <main class="finalist-banner">
    <div class="finalist-left float-left"> <a href="<?php echo SITEURL;?>"></a> </div>
    <div class="finalist-right float-left">
      <h2>THE FINALISTS HAVE BEEN SELECTED!</h2>
      <h1>VOTE FOR YOUR FAVORITE</h1>
      <h3><span class="bule-text">OUT OF OUR TOP 10</span> MINI ACTS, MIGHTY IMPACT <span class="bule-text">NOMINEES</span>.</h3>
    </div>
    <div class="clear"></div>
  </main>
  <!--finalist-banner ends--> 
  <!--finalist-list-content start-->
  <article class="finalist-list-content">      
    <div class="label-top-10"></div>
    <?php foreach($finalists as $finalist){?>
    <div class="finalist-box float-left">
      <h5><?php echo $finalist['name']?> - <?php echo $finalist['city']?>, <?php echo $finalist['state']?></h5>
      <div class="finalist-img">           
          <a title ="<?php echo $object->get_votes($finalist['id']); ?> Vote" class ="finalistgallery" href="<?php echo SITEURL;?>/nominee.php?id=<?php echo $finalist['id']; ?>&cid=<?php echo DEFAULT_CAMP;?>"><img id ="nomineeimg" src="<?php echo SITEURL;?>/images/nominee/<?php echo $finalist['img'];?>" width="168" height="188"></a>
        
      </div>
    </div>
    <?php }?>
    
    <div class="clear"></div>
  </article>
     <div class="votenow-btn-content">
     	<div class="float-right">
        	<img src="images/finalist-logo.png" alt="">
        </div>
         <?php if($_SESSION['name'] == ADMINUSER){?>
            <a href="<?php echo SITEURL;?>/winner.php"><input type="submit" class="votenow-btn" value="Declare Winner"></a>
         <?php }else{ ?>
            <a class ="votenow" href="<?php echo SITEURL;?>/vote.php"><input type="submit" class="votenow-btn" value="Vote Now"></a>
         <?php } ?>
            <a class ="hiddenvote" id="hiddenvote" href="<?php echo SITEURL;?>/vote.php?addvote=1"></a>
        <div class="clear"></div>
    </div>
  <!--finalist-list-content end--> 
  <!--footer  start-->
  <footer class="text-center"> COPYRIGHT &copy; 2014 BY AUNTIE ANNE'S, INC.  | <a href="#">PRIVACY POLICY</a> | <a href="#">CONTEST RULES</a> </footer>
  
  <!--footer  ends--> 
  
</section>
<!--container start-->
</body>
</html>
<script>
    $("a.finalistgallery").colorbox({rel:'gal',scalePhotos:true,width:'700',height:'500',scrolling:false,closeButton:false});    
    
    $("a.finalistgallery").colorbox({
        onComplete:function(){ 
            $("#content_2").mCustomScrollbar(
            {
                    scrollButtons:{enable:true},
                    advanced:{ updateOnContentResize: true}

            });

        }

    });
    
    $("a.votenow").colorbox({rel:'gal',scalePhotos:true,width:'398',height:'225',scrolling:false});    
    $("a.votenow").colorbox({
        onComplete:function(){ 
            $('.custom-form').jqTransform({imgPath:'images/'});
        }

    });
    
    $("a.hiddenvote").colorbox({rel:'gal',scalePhotos:true,width:'398',height:'225',scrolling:false});    
    $("a.hiddenvote").colorbox({
        onComplete:function(){ 
            $('.custom-form').jqTransform({imgPath:'images/'});
        }

    });
</script>
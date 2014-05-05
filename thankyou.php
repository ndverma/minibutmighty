<?php
require_once("class/master.class.php");
include("sdk/fb/src/facebook.php");
if($_SESSION['name'] == ADMINUSER)
{
    header("location:".SITEURL."/show_nominees.php");
}
$session = 1;
if(!isset($_SESSION['twttxt']))
{
    $session = 0;
}else{
    $twttxt = $_SESSION['twttxt'];
    $fbtxt = $_SESSION['fbtxt'];
    session_destroy();
}


if(isset($_GET['code']))
{
	header("location:".SITEURL."/thankyou.php");
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>::  AuntieAnne's ::</title>
<link href="css/master.css" rel="stylesheet" media="screen">
<script src='http://connect.facebook.net/en_US/all.js'></script>

</head>
 <body>
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
    <!--gallery banner start-->
    <a href="<?php echo SITEURL; ?>"><div class="gallery-banner">
        <aside class="gallery-banner-text">
        <h2>CHECK BACK <span class="yllow-text">MAY 18</span></h2>
        <h3>to vote for one of the 10 finalists.</h3>
        </aside>
    </div></a>
    <!--gallery  banner ends--> 
    <!--social media starts-->
    <div class="social-media-share-btn">
        <div id='fb-root'></div>  
        <aside class="fb-share"><a id="fb-link" onclick='postToFeed(); return false;'></a></aside>
        <aside class="twitter-share"><a id="twitter-link" href="https://twitter.com/share?text=<?php echo $twttxt;?>" data-lang="en"></a></aside>
        
    </div>
    <!--social media starts--> 
    <!-- entries -->
    <?php  include 'show_nominees.php'; ?>
    <!-- entries end -->
    
    

    </section>
    </body>
</html>
<!--<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>-->
<script>
    $( document ).ready(function() {
       var session = <?php echo $session; ?>;
       if(session == 0){
           $('.social-media-share-btn').hide();
       }
    });
    FB.init({appId: "1480382228859456", status: true, cookie: true});

    function postToFeed() {

    // calling the API ...
    var obj = {
        method: 'feed',
        link: "<?php echo SITEURL;?>",
        picture: "<?php echo PICTURE;?>",
        name: "<?php echo TITLE;?>",
        caption: "<?php echo CAPTION;?>",
        description: "<?php echo $fbtxt;?>"
    };

    function callback(response) {
        //document.getElementById('msg').innerHTML = "Post ID: " + response['post_id'];
    }

    FB.ui(obj, callback);
    }
    
    $('#twitter-link').click(function(event) {
	var width  = 575,
		height = 400,
		left   = ($(window).width()  - width)  / 2,
		top    = ($(window).height() - height) / 2,
		url    = this.href,
		opts   = 'status=1' +
				 ',width='  + width  +
				 ',height=' + height +
				 ',top='    + top    +
				 ',left='   + left;

	window.open(url, 'twitter', opts);

	return false;
    });
    
    

</script>
<!-- Facebook Share End -->

<?php
if(isset($_GET['logout']))
{
	$facebook->destroySession();
	header("location:add_nominee.php");
}
?>

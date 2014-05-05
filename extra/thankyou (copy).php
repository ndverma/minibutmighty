<?php
require_once("class/master.class.php");
include("sdk/fb/src/facebook.php");
//$object = new master;
if(!isset($_SESSION['twttxt']))
{
    header("location:".SITEURL);
}
$twttxt = $_SESSION['twttxt'];
session_destroy();

if(isset($_GET['code']))
{
	header("location:thankyou.php");
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>::  AuntieAnne's ::</title>
<link href="css/master.css" rel="stylesheet" media="screen">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.jqtransform.js" ></script>
<script type="text/javascript" src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="js/common.js" ></script>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
<script src='http://connect.facebook.net/en_US/all.js'></script>

</head>
 <body>
    <h1>Thank You For Nomination</h1>
    <h2>You can share your nomination with Twitter and Facebook
            <br>
            <?php
                    echo $_SESSION['save_msg'];
            ?>
    </h2>

    <!-- Twitter Share -->
    <a href="https://twitter.com/share?text=<?php echo $twttxt;?>" class="twitter-share-button" data-lang="en">Tweet</a>

        
        <br>
   
        <div id='fb-root'></div>        
        <p><a onclick='postToFeed(); return false;'>Post to Feed</a></p>
        <p id='msg'></p>
        <?php  include 'show_nominees.php'; ?>
    </body>
</html>

<script>
    FB.init({appId: "1480382228859456", status: true, cookie: true});

    function postToFeed() {

    // calling the API ...
    var obj = {
        method: 'feed',
        redirect_uri: "<?php echo SITEURL;?>",
        link: "<?php echo SITEURL;?>",
        picture: "<?php echo PICTURE;?>",
        name: "<?php echo API_NAME;?>",
        caption: "<?php echo CAPTION;?>",
        description: "<?php echo $twttxt;?>"
    };

    function callback(response) {
        document.getElementById('msg').innerHTML = "Post ID: " + response['post_id'];
    }

    FB.ui(obj, callback);
    }

</script>
<!-- Facebook Share End -->

<?php
if(isset($_GET['logout']))
{
	$facebook->destroySession();
	header("location:add_nominee.php");
}
?>

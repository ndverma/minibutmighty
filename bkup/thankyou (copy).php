<?php
require_once("class/master.class.php");
include("sdk/fb/src/facebook.php");
$object = new master;
$twttxt = $_SESSION['twttxt'];
?>
<?php
if(isset($_GET['code']))
{
	header("location:thankyou.php");
}

?>
<h1>
	Thank You For Nomination 
</h1>
<h2>
	You can share your nomination with Twitter and Facebook
	<br>
	<?php
		echo $_SESSION['save_msg'];
	?>
</h2>

<!-- Twitter Share -->
  <a href="https://twitter.com/share?text=<?php echo $twttxt;?>" class="twitter-share-button" data-lang="en">Tweet</a>

    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
    <br>
<!--Twitter Share End-->

<!-- Facebook Share -->
 <?php
  // Remember to copy files from the SDK's src/ directory to a
  // directory in your application on the server, such as php-sdk/
  
 $config = array(
    'appId' => '1480382228859456',
    'secret' => 'a813b32df244261b28ae9a05409294e3',
    'allowSignedRequest' => false // optional but should be set to false for non-canvas apps
  );
  $facebook = new Facebook($config);
  $user_id = $facebook->getUser();
?>
  <?php
    if($user_id) {
      // We have a user ID, so probably a logged in user.
      // If not, we'll get an exception, which we handle below.
      try {
        $ret_obj = $facebook->api('/me/feed', 'POST',
                                    array(
                                      'link' => 'www.mbm.dev',
                                      'message' => $twttxt
                                 ));
       /// echo '<pre>Post ID: ' . $ret_obj['id'] . '</pre>';
       echo "Voted Succesfully";
        // Give the user a logout link 
        //echo '<br /><a href="' . $facebook->getLogoutUrl() . '">logout</a>';
        echo '<br /><a href="thankyou.php?logout=true">logout</a>';
      } catch(FacebookApiException $e) {
        // If the user is logged out, you can have a 
        // user ID even though the access token is invalid.
        // In this case, we'll get an exception, so we'll
        // just ask the user to login again here.
        $login_url = $facebook->getLoginUrl( array(
                       'scope' => 'publish_actions',
                       'redirect_url' => 'http://mbm.dev/thankyou.php'
                       )); 
        echo 'Please <a href="' . $login_url . '">login.</a>';
        error_log($e->getType());
        error_log($e->getMessage());
      }   
    } else {

      // No user, so print a link for the user to login
      // To post to a user's wall, we need publish_actions permission
      // We'll use the current URL as the redirect_uri, so we don't
      // need to specify it here.
      $login_url = $facebook->getLoginUrl( array( 'scope' => 'publish_actions',
												  'redirect_url' => 'http://mbm.dev/thankyou.php'
													) );
      echo 'Please <a href="' . $login_url . '">login.</a>';
    } 
  ?>      
  </body> 
<!-- Facebook Share End -->

<?php
if(isset($_GET['logout']))
{
	$facebook->destroySession();
	header("location:add_nominee.php");
}
?>

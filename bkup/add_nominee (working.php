<?php
require_once("class/master.class.php");
$object = new master;
?>
<table align="center" border="1" width="80%" rules="all">
<form action="#" method="post" enctype="multipart/form-data">
	<tr>
		<td width="50%">
			<table border="1" width="100%" rules="all">
				<tr>
					<td align="right">
						Your Name : 
					</td>
					<td>
						<input type="text" name="name" value="<?php if(!empty($_POST['name'])) echo $_POST['name'];?>"
					</td>
				</tr>
				<tr>
					<td align="right">
						Your Email : 
					</td>
					<td>
						<input type="text" name="email"  value="<?php if(!empty($_POST['email'])) echo $_POST['email'];?>">
					</td>
				</tr>
				<tr>
					<td align="right">
						Your Date of Birth : 
					</td>
					<td>
						<input type="text" name="dob"  value="<?php if(!empty($_POST['dob'])) echo $_POST['dob'];?>">
					</td>
				</tr>
				<tr>
					<td align="right">
						Nominee Name : 
					</td>
					<td>
						<input type="text" name="nname"  value="<?php if(!empty($_POST['nname'])) echo $_POST['nname'];?>">
					</td>
				</tr>
				<tr>
					<td align="right">
						Nominee Email : 
					</td>
					<td>
						<input type="text" name="nemail"  value="<?php if(!empty($_POST['nemail'])) echo $_POST['nemail'];?>">
					</td>
				</tr>
				<tr>
					<td align="right">
						Nominee Twitter Id : 
					</td>
					<td>
						<input type="text" name="ntwitter"  value="<?php if(!empty($_POST['ntwitter'])) echo $_POST['ntwitter'];?>">
					</td>
				</tr>
			</table>
		</td>
		<td>
			<table width="100%" border="1" rules="all">
				<tr> 
					<td align="right">
						Upload Image :
					</td>
					<td>
						<input type="file" name="photo">
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<textarea name="description" placeholder="Tell Us how Your Nominee"><?php if(!empty($_POST['name'])) echo $_POST['name'];?></textarea>
					</td>
				</tr>
				<tr>
					<td align="center" colspan="2">
						What statement best describes your nominee ?
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<select name="noption">
							<?php
							$campaign_id = 1;
							$result = $object->get_nomination_option($campaign_id);
							foreach($result as $key=>$value)
							{
							?>
								<option value="<?php echo $value[0];?>"  <?php if(!empty($_POST['noption'])) echo "selected";?>>
									<?php echo $value[1];?>
								</option>
							<?php
							}
							?>
						</select>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center">
			<input type="hidden" name="campaign_id" value="<?php echo $campaign_id; ?>">
			<input type="hidden" name="fb" value="fb">
			<input type="hidden" name="twitter" value="twitter">
			<input type="submit" name="save" value="SUBMIT NOMINEE">
		</td>
	</tr>
</form>
</table>
<?php
if(isset($_POST['save']))
{
	$filename = $_FILES['photo']['name'];
	$filetype = $_FILES['photo']['type'];
	$campaign_id = $_POST['campaign_id'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$dob = $_POST['dob'];
	$fb = $_POST['fb'];
	$twitter = $_POST['twitter'];
	$option = $_POST['noption'];
	$nname = $_POST['nname'];
	$nemail = $_POST['nemail'];
	$description = $_POST['description'];
	$ntwitter = $_POST['ntwitter'];
	$filesallow = array("image/jpeg","image/png","image/gif");
	$error = 0;
	if(!empty($filename))
	{
		if(in_array($filetype,$filesallow))
		{
			move_uploaded_file($_FILES['photo']['tmp_name'],"images/nominee/".$_FILES['photo']['name']);
			$rename = rand(1111,9999)."_".rand(1111,9999)."_".$filename;
			rename("images/nominee/".$filename,"images/nominee/".$rename);
		}	
		else {
			$error++;
			echo "<center><h1>Invalid File Type </h1></center>";
		}
	}
	else
	{
		$error++;
		echo "<center><h1>Please Upload Nomiee Picture</h1></center>";
	}
	if($error == 0)
	{
		$result = $object->add_nominee_by($campaign_id,$name,$email,$dob,$fb,$twitter);
		if($result['status'])
		{
			$nomineeby_id = $result['id'];
			$nomination_status = $object-> add_nominees($campaign_id,$option,$nomineeby_id,$nname,$nemail,$rename,$description,$ntwitter);
			echo "<center>Nominee : ".$nname." Saved Succesfully by :".$name."</center>";
		}
		else {
			echo "<center><h1>Error Occured Nominee Not Saved Please try Again.</h1></center>";
		}
	}
	$option_value = $object->get_option_value($option);
	$twttxt = "I nominated @".$ntwitter."in @AuntieAnne's Mini Acts,Mighty Impact #Contest - ".$option_value;
	?>
	    <a href="https://twitter.com/share?text=<?php echo $twttxt;?>" class="twitter-share-button" data-lang="en">Tweet</a>

    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
    
    <br><br>
    
    <?php
    
    /*
     * 
     * Facebook setup
     * 
     * 
     * */
     ?>
    
    <?php
  // Remember to copy files from the SDK's src/ directory to a
  // directory in your application on the server, such as php-sdk/
  require_once('sdk/fb/src/facebook.php');

  $config = array(
    'appId' => '1480382228859456',
    'secret' => 'a813b32df244261b28ae9a05409294e3',
    'allowSignedRequest' => false // optional but should be set to false for non-canvas apps
  );

  $facebook = new Facebook($config);
  $user_id = $facebook->getUser();
  print_r($user_id);
?>
<html>
  <head></head>
  <body>

  <?php
    if($user_id) {

      // We have a user ID, so probably a logged in user.
      // If not, we'll get an exception, which we handle below.
      try {
        $ret_obj = $facebook->api('/me/feed', 'POST',
                                    array(
                                      'link' => 'www.example.com',
                                      'message' => 'Posting with the PHP SDK!'
                                 ));
        echo '<pre>Post ID: ' . $ret_obj['id'] . '</pre>';

        // Give the user a logout link 
        echo '<br /><a href="' . $facebook->getLogoutUrl() . '">logout</a>';
      } catch(FacebookApiException $e) {
        // If the user is logged out, you can have a 
        // user ID even though the access token is invalid.
        // In this case, we'll get an exception, so we'll
        // just ask the user to login again here.
        $login_url = $facebook->getLoginUrl( array(
                       'scope' => 'publish_actions'
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
      $login_url = $facebook->getLoginUrl( array( 'scope' => 'publish_actions' ) );
      echo 'Please <a href="' . $login_url . '">login.</a>';

    } 

  ?>      

  </body> 
</html> 
    
    
    
	<?php
}
?>

<?php
require_once("class/master.class.php");
$object = new master;
if($_SESSION['name'] == ADMINUSER)
{
    header("Location:".SITEURL."/show_nominees.php");
}
$states = array('AL','AK','AZ','AR','CA','CO','CT','DE','DC','FL',
                'GA','HI','ID','IL','IN','IA','KS','KY','LE','ME',
                'MD','MA','MI','MN','MS','MO','MT','NV','NH','NH',
                'NJ','NM','NY','NC','ND','OH','OK','OR','PA','RI',
                'SC','SD','TN','TX','UT','VT','WA','WV','WI','WY',);
$empty = 0;
$error = 0;	
$filesallow = array("image/jpeg","image/png","image/gif","image/jpg");
	
if(isset($_POST['save']))
{
        //print_r($_POST); die;
        if(empty($_POST['name']) || 
                empty($_POST['email']) || 
                empty($_POST['nname']) ||
                empty($_POST['nemail']) ||
                empty($_POST['ncity']) ||
                empty($_POST['nstate']) ||
                empty($_POST['description'])
                ){
            $empty++;
        }
	$filename = $_FILES['photo']['name'];
	$filetype = $_FILES['photo']['type'];
	$campaign_id = $_POST['campaign_id'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$dob = $_POST['post_date'].'-'.$_POST['post_month'].'-'.$_POST['post_year'];
	$fb = $_POST['fb'];
	$twitter = $_POST['twitter'];
	$option = $_POST['noption'];
	$nname = $_POST['nname'];
	$nemail = $_POST['nemail'];
	$description = $_POST['description'];
	$ntwitter = $_POST['ntwitter'];
        $ncity = $_POST['ncity'];
        $nstate = $_POST['nstate'];
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
			echo "<p class='text-center error-msg'>Invalid File Type</p>";
		}
	}
	else
	{
		$error++;
		echo "<p class='text-center error-msg'>Please Upload Nomiee Picture</p>";
	}
	if($error == 0 && $empty == 0)
	{
		$result = $object->add_nominee_by($campaign_id,$name,$email,$dob,$fb,$twitter);
                if($result['status'])
                {
                        $nomineeby_id = $result['id'];
                        $insert = array('cid'=> $campaign_id,
                                        'option'=>$option,
                                        'nomineeby_id'=>$nomineeby_id,
                                        'nname'=>$nname,
                                        'nemail'=>$nemail,
                                        'pic'=>$rename,
                                        'description'=>$description,
                                        'ntwitter'=>$ntwitter,
                                        'ncity'=>$ncity,
                                        'nstate'=>$nstate,
                                        );
			$nomination_status = $object->add_nominees($insert);
                        if($nomination_status){
                            $save_msg = "<center>Nominee : ".$nname." Saved Succesfully by :".$name."</center>";
                            $option_value = $object->get_option_value($option);
                            $twttxt = "I nominated @".$ntwitter." in @AuntieAnnes Mini Acts,Mighty Impact #Contest - ".$option_value;
                            $_SESSION['save_msg'] = $save_msg;
                            $_SESSION['twttxt'] = $twttxt;
                            header("location:".SITEURL."/thankyou.php");
                        }else {
                            echo "<p class='text-center error-msg'>Error Occured Nominee Not Saved Please try Again.</p>";
                        }
			
		}
		else {
			echo "<p class='text-center error-msg'>Error Occured Nominee Not Saved Please try Again.</p>";
		}
	}else{
            echo "<p class='text-center error-msg'>Please fill all required fields</p>";
        }
	
	
        
}

?>
<html>
    <head>
    <meta charset="utf-8">
    <title>::  AuntieAnne's :: </title>
    <link href="css/master.css" rel="stylesheet" media="screen">
    <script src="js/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="js/jquery.jqtransform.js" ></script>
    <script type="text/javascript" src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="js/common.js" ></script>
    <!--[if lt IE 9]>
            <script type="text/javascript" src="js/modernizr.custom.73851.js" ></script>
        <script src="js/respond.js"></script>
    <![endif]-->
    <!--[if gte IE 9]>
    <style type="text/css">
        .gradient {
        filter: none;
        }
    </style>
    <![endif]-->
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
             <!--banner start-->
             	<div class="banner">
                	<aside class="mini-mighty-logo"><a href="<?php echo SITEURL;?>"></a></aside>
                        <div class="float-right banner-description">
                        		<main>
                                		<h2>MINI  ACTS</h2>
                                  		<h1>MIGHTY IMPACT</h1>
                                        <div class="content-ribbon"><a href="#"></a></div>
                                </main>
                          <article class="banner-text">
                                	<p>Sometimes, it's the <span class="text-stike">little</span> mini things in life that make the biggest mightiest difference. </p>
                            <div class="nominate-container">
                           	  <div class="nominee-left float-left">
                                        	<p><span class="yellow-text">Nominate</span> someone (friend, family member, coworker,etc.) who has performed a Mini Act with a Mighty Impact.</p>
                                        </div>
                                        <div class="nominee-right float-left">
                                       	  <p class="yellow-text">Entry Period:</p>
                                          <span>May 6th - June 30th, 2014</span>
                                        </div>
                                        <div class="clear"></div>
                            </div>
                                    
                          </article>
                                <aside class="banner-promotional-images">
                                    	<div class="promo-content float-left">
                                        	<img src="images/banner-img-1.jpg" alt="">
                                        </div>
                                        <div class="promo-content float-left">
                                        	<img src="images/banner-img-2.jpg" alt="">
                                        </div>
                                        <div class="promo-content float-left mrg-0">
                                        	<img src="images/banner-img-3.jpg" alt="">
                                        </div>
                                        <div class="clear"></div>
                          </aside>
                          <aside class="scheme-container">
                                		GRAND PRIZE: <span class="whitetext">$1100</span> <span class="smalltext ">gift card furnished <br> by American Express</span> + <span class="whitetext">$1000</span> <span class="smalltext smalltext2">donated to the charity <br> of the nominee’s choice!</span>
                                </aside>
                          <aside class="scheme-desc">In addition, the person who nominated the winner will also receive a <span class="yllow-text">$250 gift</span> card and a <span class="yllow-text">$500 donation</span> to the charity/cause of their choice!</aside>
                  </div>
                </div>
             <!--banner ends-->
              <!--form section start-->
              <form id ="addnomineeform" action="" method="post" enctype="multipart/form-data">
           	  <article class="form-content">
                	<p class="text-center">Receive a <strong>Buy One, Get One Free</strong> coupon via email when you submit your nomination!</p>
                        <div class="form-left float-left  ">
                                    <div class="form-group">
                                    <label class="form-control-label float-left text-right"><span>*</span>Your Name:</label>
                                    <div class="form-control-input float-left "><input type="text" id ="name" name="name" value="<?php if(!empty($_POST['name'])) echo $_POST['name'];?>"/></div>
                                     <div class="clear"></div>
                                </div>
                                <div class="form-group">
                                	<label class="form-control-label float-left text-right"><span>*</span>Your Email:</label>
                                    <div class="form-control-input float-left "><input type="text" id ="email" name="email"  value="<?php if(!empty($_POST['email'])) echo $_POST['email'];?>"/></div>
                                     <div class="clear"></div>
                                </div>
                                 <div class="form-group custom-form">
                                	<label class="form-control-label float-left text-right"><span>*</span>Your Date of Birth:</label>
                                    <div class="form-control-input float-left">
                                    	<div class="month-input float-left">
                                            <select name = "post_month">
                                                <option value="1">January</option>
                                                <option value="2">February</option>
                                                <option value="3">March</option>
                                                <option value="4">April</option>
                                                <option value="5">May</option>
                                                <option value="6">June</option>
                                                <option value="7">July</option>
                                                <option value="8">August</option>
                                                <option value="9">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option value="12">December</option>
                                            </select>
                                        </div>
                                        <div class="date-input float-left">
                                            <select name = "post_date">
                                        	<?php
                                                for($i=1;$i<=31;$i++)
                                                {
                                                ?>
                                                    <option value="<?php echo $i;?>">
                                                            <?php echo $i;?>
                                                    </option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                       <div class="year-input float-left">
                                            <select name = "post_year">
                                        	<?php
                                                for($i=2014;$i>=1914;$i--)
                                                {
                                                ?>
                                                    <option value="<?php echo $i;?>">
                                                            <?php echo $i;?>
                                                    </option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                       </div>
                                       <div class="clear"></div>
                                    </div>
                                     <div class="clear"></div>
                                </div>
                                <div class="form-group">
                                	<label class="form-control-label float-left text-right"><span>*</span>Nominee Name:</label>
                                    <div class="form-control-input float-left "><input type="text" id ="nname" name="nname"  value="<?php if(!empty($_POST['nname'])) echo $_POST['nname'];?>"/></div>
                                     <div class="clear"></div>
                                </div>
                                 <div class="form-group">
                                	<label class="form-control-label float-left text-right"><span>*</span>Nominee Email:</label>
                                    <div class="form-control-input float-left "><input type="text" id="nemail" name="nemail"  value="<?php if(!empty($_POST['nemail'])) echo $_POST['nemail'];?>"></div>
                                     <div class="clear"></div>
                                </div>
                                <div class="form-group">
                                	<div class="nominee-city  float-left">
                                        <label class="form-control-label float-left text-right"><span>*</span>Nominee City:</label>
                                        <div class="form-control-input float-left "><input id ="ncity" name="ncity" type="text"></div>
                                         <div class="clear"></div>
                                    </div>
                                    <div class="nominee-state  float-left">
                                            <label class="form-control-label float-left text-right"><span>*</span>State:</label>
                                            <div class="State-input float-left custom-form">
                                        	 <select id ="nstate" name="nstate">
                                        		<?php
                                                        foreach($states as $state)
                                                        {
                                                        ?>
                                                            <option value="<?php echo $state;?>">
                                                                    <?php echo $state;?>
                                                            </option>
                                                        <?php
                                                        }
                                                        ?>
                                        	</select>
                                        </div>
                                         <div class="clear"></div>
                                    </div>
                                     <div class="clear"></div>
                                </div>
                                 <div class="form-group nominee-twitter">
                                	<label class="form-control-label float-left text-right">Nominee Twitter Handle:</label>
                                    <div class="form-control-input float-left "><input id="ntwitter" type="text" name="ntwitter"  value="<?php if(!empty($_POST['ntwitter'])) echo $_POST['ntwitter'];?>"></div>
                                     <div class="clear"></div>
                                </div>
                        </div>
                        <div class="form-right float-right">
                        	<div class="upload-btn">
                            	<label class="float-left"><span class="req">*</span>Submit a photo of your nominee:</label>
                                <div class="form-control-input float-left "><input class="upload-button" type="file" id="photo" name="photo"></div>
                                <div class="clear"></div>
                            </div>
                          <div class="form-group">
                           	<textarea id ="description" name="description" role="4" class="tell-us" cols="4" placeholder="Tell us how your nominee demonstrates “Mini Acts with Might Impact” (max. 500 characters)"></textarea>
                          </div>
                          <div class="statement-nominee">
                           	<label class="float-left"><span class="req">*</span>What statement best describes your nominee?</label>
                            <div class="form-control-input float-left  custom-form">
                                	<select name="noption">
                                                <?php
                                                $campaign_id = 1;
                                                $result = $object->get_nomination_option($campaign_id);
                                                foreach($result as $key=>$value)
                                                {
                                                ?>
                                                        <option value="<?php echo $value[0];?>"<?php if(!empty($_POST['noption'])) echo "selected";?>>
                                                                <?php echo $value[1];?>
                                                        </option>
                                                <?php
                                                }
                                                ?>
                                        </select>
                                </div>
                                <div class="clear"></div>
                                
                          </div>
                          <div class="required-note text-right">* Indicates required field</div>
                </div>
                <div class="clear"></div>
                        <div class="submit-btn text-center">
                        <input type="hidden" name="campaign_id" value="<?php echo $campaign_id; ?>">
                        <input type="hidden" name="fb" value="fb">
                        <input type="hidden" name="twitter" value="twitter">
                        <input class ="submit submit-btn" type="submit" name="save" value="Submit Nominee">
                        <a class="newentry" href="<?php echo SITEURL; ?>/thankyou.php">View Entries</a>
                </div>
                </article>
              </form>
               <!--form section end-->
               <!--footer  start-->
               	<footer class="text-center">
           		COPYRIGHT &copy; 2014 BY AUNTIE ANNE'S, INC.  |  <a href="http://www.focusbrands.com/privacy-policy" target="_blank">PRIVACY POLICY</a> |  <a href="#">CONTEST RULES</a>
                </footer>
               <!--footer  ends-->
               
             
        </section>
    </body>
</html>

<script>
    $('#addnomineeform').submit(function(){
        var result = true;
        if($('#name').val().length == 0){
            $('#name').addClass("error");
            result = false;
        }
        if($('#email').val().length == 0){
            $('#email').addClass("error");
            result = false;
        }
        if($('#nname').val().length == 0){
            $('#nname').addClass("error");
            result = false;
        }
        if($('#nemail').val().length == 0){
            $('#nemail').addClass("error");
            result = false;
        }
        if($('#ncity').val().length == 0){            
            $('#ncity').addClass("error");
            result = false;
        }
        
        if($('#photo').val().length == 0){
            $('#photo').addClass("error");
            result = false;
        }else{
            var extn = $('#photo').val().split('.');
            var allowedextn = <?php echo json_encode($filesallow); ?>;
            if($.inArray('image/'+extn[1], allowedextn) < 0){
                alert("Invalid file type!!");
                result = false;
            }
        }
        if($('#description').val().length == 0){
            $('#description').addClass("error");
            result = false;
        }
               
        return result;
    });
    
    $('input').click(function(){
        $(this).removeClass("error");
    });
    
</script>
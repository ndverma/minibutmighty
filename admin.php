<?php 
require_once("class/master.class.php");
$object = new master;
$status = $object->get_campaign_status(DEFAULT_CAMP);
$allstatus = $object->get_campaign_status();
$userloggedin = 0;

if(isset($_REQUEST['login'])){
    if($_REQUEST['username'] == ADMINUSER && $_REQUEST['password'] == ADMINPASS){
        session_start();        
        $_SESSION['name'] = ADMINUSER;
        $userloggedin = 1;
    }else{
        echo "<p class='text-center error-msg'>Please enter correct credentials!!</p>";
    }
}elseif($_REQUEST['logout'] == 1){
    $userloggedin = 0;
    session_destroy();
}


?>
<?php if(!$userloggedin){?>
<html>
	<head>
        <meta charset="utf-8">
        <title>::  AuntieAnne's ::</title>
        <link href="css/master.css" rel="stylesheet" media="screen">
        <script type="text/javascript" src="js/jquery.js" ></script>
        <script type="text/javascript" src="js/jquery.jqtransform.js" ></script>
        <script type="text/javascript" src="js/common.js" ></script>
        <!--[if lt IE 9]>
                <script type="text/javascript" src="js/modernizr.custom.73851.js" ></script>
            <script src="js/respond.js"></script>
        <![endif]-->

        </head>
	<body>
            <!--container start-->
            <section  class="container"> 
            <!--Login start-->

            <aside class="login-main">
            <aside class="logo"><a href="<?php echo SITEURL;?>"></a></aside>
            <aside class="login-box">
            <h2>Login</h2>
            <aside class="login-form">
            <form method="POST" action="">
            <div class="form-group">
            <label class="form-control-label float-left text-right"><span>*</span>User Name:</label>
            <div class="form-control-input float-left "><input type="text" name="username"/></div>
            <div class="clear"></div>
            </div>
            <div class="form-group">
            <label class="form-control-label float-left text-right"><span>*</span>Password:</label>
            <div class="form-control-input float-left "><input type="password" name="password"/></div>
            <div class="clear"></div>
            </div>
            <div class="text-center login-btn">
            <input class="login" type="submit" value="login" name="login"/>
            </div>
            </form>
            </aside>
            </aside>
            <aside class="clear"></aside>
            </aside>

            <!--Login ends--> 
            </section>
            <!--container ends-->
            
		
                
            
	</body>
</html>
<?php } elseif($status == $allstatus['Active']){
    header("Location:show_nominees.php");
}elseif($status == $allstatus['Not-Active']){
    header("Location:finalists.php");
}
?>
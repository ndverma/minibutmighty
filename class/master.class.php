<?php
session_start();
?>
<?php
define("LINK","www.mbm.dev");
define("URI","www.mbm.dev");
define("PICTURE","http://202.131.112.106:8880/minibutmighty/images/mini-mighty-logo.png");
define("TITLE","“Mini Acts, Mighty Impact” Contest");
define("CAPTION","To celebrate the mini acts that make a difference every day, Auntie Anneʼs is asking fans to nominate someone who has performed a Mini Act with a Mighty Impact.");
define("DEFAULT_CAMP",1);
define("ADMINUSER",'admin');
define("ADMINPASS",'Admin@123');
define("SITEURL",'http://202.131.112.106:8880/minibutmighty');

class master
{
	var $host = "localhost";
	var $username = "ndverma";
	var $password = "ndv@123";
	var $dbname = "minibutmighty";
	
	public function __construct()
	{
		$con = mysql_connect($this->host,$this->username,$this->password);
		mysql_select_db($this->dbname,$con);
	/*	$query = "SELECT * FROM campaign";
		$run = mysql_query($query);
		$result = mysql_fetch_assoc($run);
		print_r($result);*/
	}
	
	public function get_campaign_status($campaign_id)
	{
		if($campaign_id){
                    $query = "SELECT * FROM campaign where id = ".$campaign_id;
                    $result = mysql_query($query);
                    $row = mysql_fetch_assoc($result);
                    return $row['status'];
                }else{
                    return array('Active' => 'A','Not-Active' => 'N','Done' => 'D');
                }
	}
	
        
	public function get_nomination_option($campaign_id) 
	{
		$query = "SELECT * FROM nomination_option where campaign_id = '$campaign_id'
				  AND
				  status = 'Y'
				 ";
		$result = mysql_query($query);
		while($row = mysql_fetch_assoc($result))
		{
			$optiondata[] = array($row['id'],$row['option']);
		}
		return $optiondata;
	}
	
	public function get_option_value($option_id)
	{
		$query = "SELECT * FROM nomination_option
				 where
				 id = '$option_id'
				 AND
				 status = 'Y'
				 ";
		$result = mysql_query($query);
		$option_value = mysql_fetch_assoc($result);
		$option_value = $option_value['option'];
		return $option_value;
	}
	
	public function add_nominee_by($campaign_id,$name,$email,$dob,$fb,$twitter)
	{
		$query = "INSERT INTO 
						  nomination_by
						  (id,campaign_id,name,email,dob,fb,twitter,created)
						  VALUES
						  ('',
						  '$campaign_id',
						  '$name',
						  '$email',
						  '$dob',
						  '',
						  '',
						  NOW()
						  )
						 ";
		$result['status'] =  mysql_query($query);
		$result['id'] = mysql_insert_id();
		return $result;
	}
	
	public function  add_nominees($insert)
	{
	
			$query = "INSERT INTO nominees
				  (campaign_id,option_id,nomination_by,name,email,img,
				  description,twitter,city,state,created
				  )
				  VALUES
				  (
				  ".$insert['cid'].",
				  ".$insert['option'].",
				  ".$insert['nomineeby_id'].",
				  '".$insert['nname']."',
				  '".$insert['nemail']."',
				  '".$insert['pic']."',
				  '".$insert['description']."',
				  '".$insert['ntwitter']."',	
                                  '".$insert['ncity']."',
                                  '".$insert['nstate']."',
				  NOW()
				  )
				 ";
			$result = mysql_query($query);
			return $result;
	}
	
	//Get All Nominees List
	public function get_all_nominees($campaign_id)
	{
		$query = "SELECT * FROM nominees where campaign_id = '".$campaign_id."' ORDER BY created DESC";
		$result = mysql_query($query);
		while($row = mysql_fetch_assoc($result))
		{
			$all_nominees[] = array($row['id'],$row['option_id'],
                                                    $row['nomination_by'],$row['name'],
                                                    $row['email'],$row['img'],
                                                    $row['description'],$row['twitter'],
                                                    $row['status'],$row['created'],$row['city'],$row['state']
                                                    );
		}
		return $all_nominees;
	}
        
        
        
        public function set_nominee_status($id,$status){            
                if($id){
                    $query = "UPDATE nominees SET status = '".$status."' where id =".$id;
                    mysql_query($query); 
                }
                
        }
        
        public function set_campaign_status($id,$status){           
                if($id){                    
                    $query = "UPDATE campaign SET status = '".$status."' where id =".$id;
                    mysql_query($query);
                }
        }
        
        public function get_nominee_status(){
            return array('Active' => 'A', "Deactive" => "D", "Finalist" => "F");
        }
        
        public function get_nominee($id,$cid){
            $query = "SELECT * FROM nominees where campaign_id = ".$cid." AND id =".$id;
            $result = mysql_query($query);
            $row = mysql_fetch_assoc($result);
            return $row;
		
        }
        
        public function get_nomination_by($id,$cid){
            $query = "SELECT * FROM nomination_by where campaign_id = ".$cid." AND id =".$id;
            $result = mysql_query($query);
            $row = mysql_fetch_assoc($result);
            return $row;
		
        }
        
        public function get_finalists($cid){
            $query = "SELECT * FROM nominees where campaign_id = ".$cid." AND status = 'F'";
            $result = mysql_query($query);
            while($row = mysql_fetch_assoc($result))
            {
                    $all_finalists[] = $row;
            }
            return $all_finalists;
		
        }
        
        public function add_vote($id){
            $query = "INSERT INTO `votes`(`vote_for`, `added`) VALUES (".$id.",NOW())";
            $result = mysql_query($query);
            return $result;
        }
        
        public function get_votes($id){
            $query = "SELECT count(*) from votes where vote_for =".$id;
            $result = mysql_query($query);
            $row = mysql_fetch_assoc($result);
            return $row['count(*)'];
        }
                
}
?>


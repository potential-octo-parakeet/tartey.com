<?php	
	include('class.php');	
	$igb = new igobig;	
	if(isset($_REQUEST['createAccount']) && $_REQUEST['createAccount']==='true'){
		$firstname	= $_REQUEST['firstname'];
		$lastname	= $_REQUEST['lastname'];
		$name		= $firstname.' '.$lastname;
		$email		= $_REQUEST['email'];
		$password	= $_REQUEST['password'];
		$gender		= $_REQUEST['gender'];
		$birthday	= $_REQUEST['birthday'];
		$mobile		= $_REQUEST['mobile'];
		$filterEmail= "/^(.{3,})+\@+(.{2,})+\.+(.{2,4})$/";
		$filterNum	= "/^[0-9]{3,6}$/";
		$filterSex	= "/Male|Female/";
		$filterBday	= "/^[0-9]{4}+\-+[0-9]{2}+\-+[0-9]{2}$/";
		$filterMob	= "/^[0-9 \(\-\)\+]{10,20}$/";
		$birthdate	= $birthday['y'].'-'.$birthday['m'].'-'.$birthday['d'];		
		$ip			= $_SERVER['REMOTE_ADDR'];
		$current_loc= $igb->location();
		$token 		= md5(rand(0,99999)+microtime());
		if((strlen($firstname)<2) && (strlen($lastname)<2) && !preg_match($filterEmail,$email) 
			&& (strlen($password)<6) && !preg_match($filterSex,$gender) && !preg_match($filterBday,$birthdate)){
			echo "You must fill in all of the fields.";
		}elseif(strlen($firstname)<2){
			echo "Please enter a valid first name.";
		}elseif(strlen($lastname)<2){
			echo "Please enter a valid last name.";
		}elseif(!preg_match($filterEmail,$email)){
			echo "Please enter a valid email address.";
		}elseif($igb->emailExist($email)){
			echo "Email already registered by another user.";
		}elseif(strlen($password)<6){
			echo "Please enter a valid password. (atleast 6 characters)";
		}elseif(!preg_match($filterSex,$gender)){
			echo "Please select your sex.";
		}elseif(!preg_match($filterBday,$birthdate)){
			echo "Please select your birthday.";
		}elseif(!empty($mobile) && !preg_match($filterMob,$mobile)){
			echo "Please enter a valid mobile number.";
		}else{
			if($gender=='Female'){
				$pic50 = "9c297f653c3469b0b52a1321aea02acf.gif";
				$pic180= "40ac4e701caf77cf6dac12cdbf1f152c.gif";
			}else{				
				$pic50 = "fec703a89d4b5603443e1dc19721e208.gif";
				$pic180= "307ffa216a18a0a0124d3ef579d8f7b2.gif";
			}			
			db::connect();
			$sql=sprintf("INSERT INTO 
				user(regdate,regipaddress,firstname,lastname,name,email,password,gender,birthday,location,picture50,picture180,token,mobile) 
				VALUES(NOW(),'%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')",
				$ip,$firstname,$lastname,$name,$email,md5($password),$gender,$birthdate,$current_loc,$pic50,$pic180,$token,$mobile);
			mysql_query($sql);
			//SESSION STARTED
			session_start();
			$_SESSION['id'] = $igb->get_user_id($email);
			//REDIRECT TO HOME
			echo "<script>window.location.href='home.php';</script>";
			echo "Please wait...";
		}
	}//end create user	
?>
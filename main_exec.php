<?php
	include_once "config.php";

	switch ($_REQUEST['exec'])
	{
		// 카카오 회원 가입 및 로그인 처리
		case "member_kakao_login" :
			$mb_email					= $_REQUEST["mb_email"];
			$mb_login_way				= $_REQUEST["login_way"];
			$mb_kakao_email_verified	= $_REQUEST["mb_email_verified"];
			$mb_kakao_way_id			= $_REQUEST["mb_way_id"];
			$mb_kakao_profile_img		= $_REQUEST["mb_profile_img"];
			$mb_kakao_name				= $_REQUEST["mb_name"];
			$mb_kakao_thumbnail_img		= $_REQUEST["mb_thumbnail_img"];

			if ($mb_kakao_email_verified == "true")
				$mb_kakao_email_verified = "Y";
			else
				$mb_kakao_email_verified = "N";
			
			$login_query		= "SELECT * FROM ".$_gl['member_info_table']." WHERE mb_email='".$mb_email."' AND mb_kakao_way_id='".$mb_kakao_way_id."'";
			$login_result		= mysqli_query($my_db, $login_query);
			$login_data			= mysqli_fetch_array($login_result);

			if ($login_data['mb_email'])
			{
				$query		= "UPDATE ".$_gl['member_info_table']." SET mb_login_date='".date("Y-m-d H:i:s")."' WHERE mb_email='".$login_data['mb_email']."'";
				$result		= mysqli_query($my_db, $query);
			}else{
				$query    = "INSERT INTO ".$_gl['member_info_table']."(mb_login_way, mb_name, mb_email, mb_kakao_email_verified, mb_kakao_way_id, mb_kakao_profile_img, mb_kakao_thumbnail_img, mb_join_date, mb_login_date, mb_join_ipaddr) values('".$mb_login_way."','".$mb_kakao_name."','".$mb_email."','".$mb_kakao_email_verified."','".$mb_kakao_way_id."','".$mb_kakao_profile_img."','".$mb_kakao_thumbnail_img."','".date("Y-m-d H:i:s")."','".date("Y-m-d H:i:s")."','".$_SERVER['REMOTE_ADDR']."')";
				$result   = mysqli_query($my_db, $query);
			}
print_r($query);
			// 회원 이메일, 이름, 로그인 경로 세션 생성
			$_SESSION['ss_vvv_email']		= $mb_email;
			$_SESSION['ss_vvv_name']		= $mb_kakao_name;
			$_SESSION['ss_vvv_way']			= $mb_login_way;
			
			if ($result)
				$flag	= "Y";
			else
				$flag	= "N";

			echo $flag;
		break;

		// 페이스북 회원 가입 및 로그인 처리
		case "member_facebook_login" :
			$mb_email					= $_REQUEST["mb_email"];
			$mb_login_way				= $_REQUEST["login_way"];
			$mb_facebook_name			= $_REQUEST["mb_name"];
			$mb_facebook_gender			= $_REQUEST["gender"];
			$mb_facebook_birthday		= $_REQUEST["birthday"];
			$mb_facebook_way_id			= $_REQUEST["id"];
			
			$login_query		= "SELECT * FROM ".$_gl['member_info_table']." WHERE mb_email='".$mb_email."' AND mb_facebook_way_id='".$mb_facebook_way_id."'";
			$login_result		= mysqli_query($my_db, $login_query);
			$login_data			= mysqli_fetch_array($login_result);

			if ($login_data['mb_email'])
			{
				$query		= "UPDATE ".$_gl['member_info_table']." SET mb_login_date='".date("Y-m-d H:i:s")."' WHERE mb_email='".$login_data['mb_email']."'";
				$result		= mysqli_query($my_db, $query);
			}else{
				$query    = "INSERT INTO ".$_gl['member_info_table']."(mb_login_way, mb_name, mb_email, mb_facebook_gender, mb_facebook_birthday, mb_facebook_way_id   , mb_join_date, mb_login_date, mb_join_ipaddr) values('".$mb_login_way."','".$mb_facebook_name."','".$mb_email."','".$mb_facebook_gender."','".$mb_facebook_birthday."','".$mb_facebook_way_id."','".date("Y-m-d H:i:s")."','".date("Y-m-d H:i:s")."','".$_SERVER['REMOTE_ADDR']."')";
				$result   = mysqli_query($my_db, $query);
			}

			// 회원 이메일, 이름 세션 생성
			$_SESSION['ss_vvv_email']		= $mb_email;
			$_SESSION['ss_vvv_name']		= $mb_kakao_name;
			$_SESSION['ss_vvv_way']			= $mb_login_way;
			
			if ($result)
				$flag	= "Y";
			else
				$flag	= "N";

			echo $flag;
		break;
	}
?>
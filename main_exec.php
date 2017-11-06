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
			$_SESSION['ss_vvv_name']		= $mb_facebook_name;
			$_SESSION['ss_vvv_way']			= $mb_login_way;
			
			if ($result)
				$flag	= "Y";
			else
				$flag	= "N";

			echo $flag;
		break;

		case "like_video" :
			$v_idx			= $_REQUEST["v_idx"];

			$like_query		= "SELECT * FROM ".$_gl['like_info_table']." WHERE mb_email='".$_SESSION['ss_vvv_email']."' AND v_idx='".$v_idx."' AND like_flag='Y'";
			$like_result	= mysqli_query($my_db, $like_query);
			$like_count		= mysqli_num_rows($like_result);
			$like_data		= mysqli_fetch_array($like_result);

			if ($like_count == 0)
			{
				$query		= "INSERT INTO ".$_gl['like_info_table']."(v_idx, mb_email, like_flag, like_regdate) values('".$v_idx."','".$_SESSION['ss_vvv_email']."','Y','".date("Y-m-d H:i:s")."')";
				$result		= mysqli_query($my_db, $query);

				$query2		= "UPDATE ".$_gl['video_info_table']." SET like_count=like_count+1 WHERE idx='".$v_idx."'";
				$result2	= mysqli_query($my_db, $query2);
				$flag	= "Y";
			}else{
				$query		= "UPDATE ".$_gl['like_info_table']." SET like_flag='N' WHERE idx='".$v_idx."'";
				$result		= mysqli_query($my_db, $query);

				$query2		= "UPDATE ".$_gl['video_info_table']." SET like_count=like_count-1 WHERE idx='".$v_idx."'";
				$result2	= mysqli_query($my_db, $query2);
				$flag	= "N";
			}

			echo $flag;
		break;

		case "view_video" :
			$v_idx			= $_REQUEST["v_idx"];

			$query		= "INSERT INTO ".$_gl['view_info_table']."(v_idx, mb_email, view_regdate) values('".$v_idx."','".$_SESSION['ss_vvv_email']."','".date("Y-m-d H:i:s")."')";
			$result		= mysqli_query($my_db, $query);

			$query2		= "UPDATE ".$_gl['video_info_table']." SET play_count=play_count+1 WHERE idx='".$v_idx."'";
			$result2	= mysqli_query($my_db, $query2);

			if ($result)
				$flag	= "Y";
			else
				$flag	= "N";

			echo $flag;
		break;

		case "insert_comment" :
			$v_idx			= $_REQUEST["idx"];
			$comment_text	= $_REQUEST["comment_text"];
		
			$query		= "INSERT INTO ".$_gl['comment_info_table']."(v_idx, mb_email, comment_text, comment_regdate) values('".$v_idx."','".$_SESSION['ss_vvv_email']."','".$comment_text."','".date("Y-m-d H:i:s")."')";
			$result		= mysqli_query($my_db, $query);

			if ($result)
				$flag	= "Y";
			else
				$flag	= "N";

			echo $flag;
	}
?>
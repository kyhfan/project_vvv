<?php
	include_once "config.php";

	switch ($_REQUEST['exec'])
	{
		case "member_login" :
			$mb_email			= $_REQUEST["mb_email"];
			$mb_password		= $_REQUEST["mb_password"];

			$login_query		= "SELECT * FROM ".$_gl['member_info_table']." WHERE mb_email='".$mb_email."' AND mb_password=MD5('".$mb_password."')";
			$login_result		= mysqli_query($my_db, $login_query);
			$login_data			= mysqli_fetch_array($login_result);

			// 암호 검증
			//if (validate_password($mb_password,$login_data['mb_password']))
			if ($mb_email == $login_data['mb_email'])
			{
				if ($login_data['mb_verify'] == "Y")
				{
					$update_query		= "UPDATE ".$_gl['member_info_table']." SET mb_login_date='".date("Y-m-d H:i:s")."' WHERE mb_id='".$login_data['mb_id']."'";
					$update_result		= mysqli_query($my_db, $update_query);

					// 회원 이메일, 이름, 로그인 경로 세션 생성
					$_SESSION['ss_chon_email']		= $login_data['mb_email'];
					$_SESSION['ss_chon_name']		= $login_data['mb_name'];
					$_SESSION['ss_chon_way']		= $login_data['mb_login_way'];
					$flag	= "Y";
				}else{
					$flag	= "V";
				}
			}else{
				$flag	= "N";
			}
			echo $flag;
		break;

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
			$_SESSION['ss_chon_email']		= $mb_email;
			$_SESSION['ss_chon_name']		= $mb_kakao_name;
			$_SESSION['ss_chon_way']		= $mb_login_way;
			
			if ($result)
				$flag	= "Y";
			else
				$flag	= "N";

			echo $flag;
		break;

		// 네이버 회원 가입 및 로그인 처리
		case "member_naver_login" :
			$mb_email					= $_REQUEST["email"];
			$mb_login_way				= $_REQUEST["login_way"];
			$mb_naver_profile_img		= $_REQUEST["profile_image"];
			$mb_naver_name				= $_REQUEST["mb_name"];
			$mb_naver_nickname			= $_REQUEST["nickname"];
			$mb_naver_gender			= $_REQUEST["gender"];
			$mb_naver_birthday			= $_REQUEST["birthday"];
			$mb_naver_age				= $_REQUEST["age"];
			$mb_naver_way_enc_id		= $_REQUEST["enc_id"];
			$mb_naver_way_id			= $_REQUEST["id"];
			
			$login_query		= "SELECT * FROM ".$_gl['member_info_table']." WHERE mb_email='".$mb_email."' AND mb_naver_way_id='".$mb_naver_way_id."'";
			$login_result		= mysqli_query($my_db, $login_query);
			$login_data			= mysqli_fetch_array($login_result);

			if ($login_data['mb_email'])
			{
				$query		= "UPDATE ".$_gl['member_info_table']." SET mb_login_date='".date("Y-m-d H:i:s")."' WHERE mb_email='".$login_data['mb_email']."'";
				$result		= mysqli_query($my_db, $query);
			}else{
				$query    = "INSERT INTO ".$_gl['member_info_table']."(mb_login_way, mb_name, mb_email, mb_naver_profile_img, mb_naver_nickname, mb_naver_gender, mb_naver_birthday, mb_naver_age, mb_naver_way_enc_id, mb_naver_way_id   , mb_join_date, mb_login_date, mb_join_ipaddr) values('".$mb_login_way."','".$mb_naver_name."','".$mb_email."','".$mb_naver_profile_img."','".$mb_naver_nickname."','".$mb_naver_gender."','".$mb_naver_birthday."','".$mb_naver_age."','".$mb_naver_way_enc_id."','".$mb_naver_way_id."','".date("Y-m-d H:i:s")."','".date("Y-m-d H:i:s")."','".$_SERVER['REMOTE_ADDR']."')";
				$result   = mysqli_query($my_db, $query);
			}

			// 회원 이메일, 이름 세션 생성
			$_SESSION['ss_chon_email']		= $mb_email;
			$_SESSION['ss_chon_name']		= $mb_naver_name;
			$_SESSION['ss_chon_way']		= $mb_login_way;
			
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
			$_SESSION['ss_chon_email']		= $mb_email;
			$_SESSION['ss_chon_name']		= $mb_facebook_name;
			$_SESSION['ss_chon_way']		= $mb_login_way;
			
			if ($result)
				$flag	= "Y";
			else
				$flag	= "N";

			echo $flag;
		break;

		case "member_join":
			$mb_email		= $_REQUEST["mb_email"];
			$mb_password	= $_REQUEST["mb_password"];
			$mb_name		= $_REQUEST["mb_name"];
			$mb_phone		= $_REQUEST["mb_phone"];
			$birthday		= $_REQUEST["birthday"];
			$event_chk		= $_REQUEST["event_chk"];
			$email_chk		= $_REQUEST["email_chk"];
			$sms_chk		= $_REQUEST["sms_chk"];
			$mb_login_way	= "chon";
		
			if ($event_chk == "true")
				$event_chk	= "Y";
			else
				$event_chk	= "N";

			if ($email_chk == "true")
				$email_chk	= "Y";
			else
				$email_chk	= "N";

			if ($sms_chk == "true")
				$sms_chk	= "Y";
			else
				$sms_chk	= "N";


			$dupli_query		= "SELECT * FROM ".$_gl['member_info_table']." WHERE 1 AND mb_email='".$mb_email."'";
			$dupli_result		= mysqli_query($my_db, $dupli_query);
			$dupli_count 		= mysqli_num_rows($dupli_result);
	
			if ($dupli_count > 0)
			{
				$flag = "D";
			}else{
				if ($birthday > date("Y-m-d", strtotime("-14year")))
				{
					$flag = "E";
				}else{
					$insert_query    = "INSERT INTO ".$_gl['member_info_table']."(mb_email, mb_password, mb_name, mb_phone, mb_birth, mb_eventYN, mb_emailYN, mb_smsYN, mb_login_way, mb_join_date, mb_join_ipaddr) values('".$mb_email."',MD5('".$mb_password."'),'".$mb_name."','".$mb_phone."','".$birthday."','".$event_chk."','".$email_chk."','".$sms_chk."','".$mb_login_way."','".date("Y-m-d H:i:s")."','".$_SERVER['REMOTE_ADDR']."')";
					$insert_result   = mysqli_query($my_db, $insert_query);

					// result - 메일 발송
					if($insert_result) {
						$mail_result = sendMail(
							"yh.kim@minivertising.kr",
							"촌의감각",
							"촌의감각 회원가입 인증메일입니다.",
							"	<table style='width: 700px;margin: 61px 0 74px 31px;table-layout:fixed;border-spacing: 0;border-collapse: collapse;border-spacing: 0;border: 0;' border-spacing='0' cellspacing='0' cellpadding='0' border='0'>
							<thead>
								<tr>
									<th>
										<a style='color: inherit;' href='javascript:void(0)'>
											<img style='display: block;padding-bottom: 25px;' src='http://www.store-chon.com/dev/images/logo.png' alt='촌의감각'>
										</a>
									</th>
								</tr>
							</thead>
							<tbody style='border-width: 1px;border-style: solid;border-color: #333333;border-left: none;border-right: none;'>
								<tr>
									<td>
										<h4 style='font-size: 25px;color: #333333;margin: 0;padding: 60px 0 58px;'>WELCOME</h4>
									</td>
								</tr>
								<tr>
									<td>
										<span style='display: block;font-size: 17px;font-weight: 700;color: #333333;'>안녕하세요 촌의 감각입니다.</span>
									</td>
								</tr>
								<tr>
									<td>
										<p style='line-height:20px;color:#333333;margin:0;padding:30px 0 73px;'>
											<span style='color:#809255;'>24시간</span> 이내에 이메일 인증을 클릭해주시면 촌의 감각 회원가입이 완료됩니다.<br>
											24시간 이내에 이메일 인증이 완료되지 않을 경우,<br>
											회원가입을 다시 진행해주셔야 합니다.
										</p>
										<a href='http://www.store-chon.com/dev/join_complete.php?v_email=".$mb_email."' style='display:inline-block;text-align:center;margin-bottom:65px;'>
											<span style='display:inline-block;padding:16px 54px;background-color:#809255;font-size:18px;color:#ffffff;letter-spacing:2px;'>인증하기</span>
										</a>
									</td>
								</tr>
							</tbody>
							<tfoot>
								<tr>
									<td>
										<p style='padding:24px 0 71px;color:#333333;font-size:17px;line-height:22px;'>
											촌의 감각 주문 관련 문의는 1:1문의 및 고객지원센터 T. 02-235-2475를 이용해 주십시오.<br>
											본 메일은 발신전용 메일이며 회신되지 않습니다.
										</p>
									</td>
								</tr>
							</tfoot>
						</table>",
							"$mb_email", "$mb_name");

						$flag = "Y";
					}else{
						$flag = "N";
					}
				}
			}
			echo $flag;

		break;

		case "member_modify":
			$mb_password	= preg_replace("/\s+/", "", $_REQUEST["mb_password"]);
			$mb_name		= preg_replace("/\s+/", "", $_REQUEST["mb_name"]);
			$mb_phone		= preg_replace("/\s+/", "", $_REQUEST["mb_phone"]);
			$birthday		= $_REQUEST["birthday"];
			$event_chk		= $_REQUEST["event_chk"];
			$email_chk		= $_REQUEST["email_chk"];
			$sms_chk		= $_REQUEST["sms_chk"];

			if ($event_chk == "true")
				$event_chk	= "Y";
			else
				$event_chk	= "N";

			if ($email_chk == "true")
				$email_chk	= "Y";
			else
				$email_chk	= "N";

			if ($sms_chk == "true")
				$sms_chk	= "Y";
			else
				$sms_chk	= "N";

			if ($birthday > date("Y-m-d", strtotime("-14year")))
			{
				$flag = "E";
			}else{
				if ($mb_password == "")
					$update_query = "UPDATE ".$_gl['member_info_table']." SET mb_name='".$mb_name."',mb_birth='".$birthday."',mb_phone='".$mb_phone."',mb_smsYN='".$sms_chk."',mb_eventYN='".$event_chk."',mb_emailYN='".$email_chk."',mb_update_date='".date("Y-m-d H:i:s")."' WHERE mb_email='".$_SESSION['ss_chon_email']."'";
				else
					$update_query = "UPDATE ".$_gl['member_info_table']." SET mb_password=MD5('".$mb_password."'),mb_name='".$mb_name."',mb_birth='".$birthday."',mb_phone='".$mb_phone."',mb_smsYN='".$sms_chk."',mb_eventYN='".$event_chk."',mb_emailYN='".$email_chk."',mb_update_date='".date("Y-m-d H:i:s")."' WHERE mb_email='".$_SESSION['ss_chon_email']."'";
		
				$update_result   = mysqli_query($my_db, $update_query);

				if($update_result) {
					$flag = "Y";
				}else{
					$flag = "N";
				}
			}
			echo $flag;

		break;

		case "email_change" :
			$change_email 	= $_REQUEST['change_email'];
			$mb_email 		= $_REQUEST['mb_email'];
			$mb_name 		= $_REQUEST['mb_name'];	

			$dupli_query		= "SELECT * FROM ".$_gl['member_info_table']." WHERE 1 AND mb_email='".$change_email."'";
			$dupli_result		= mysqli_query($my_db, $dupli_query);
			$dupli_count 		= mysqli_num_rows($dupli_result);
	
			if ($dupli_count > 0)
			{
				$flag = "D";
			}else{
				// result - 메일 발송
				$mail_result = sendMail(
					"yh.kim@minivertising.kr",
					"촌의감각",
					"촌의감각 이메일 변경 인증 메일입니다.",
					"<table style='width: 700px;margin: 61px 0 74px 31px;table-layout:fixed;border-spacing: 0;border-collapse: collapse;border-spacing: 0;border: 0;' border-spacing='0' cellspacing='0' cellpadding='0' border='0'>
					<thead>
						<tr>
							<th>
								<a style='color: inherit;' href='http://www.store-chon.com/dev/index.php'>
									<img style='display: block;padding-bottom: 25px;' src='http://www.store-chon.com/dev/images/logo.png' alt='촌의감각'>
								</a>
							</th>
						</tr>
					</thead>
					<tbody style='border-width: 1px;border-style: solid;border-color: #333333;border-left: none;border-right: none;'>
						<tr>
							<td>
								<h4 style='font-size: 25px;color: #333333;margin: 0;padding: 60px 0 58px;'>NEW E-MAIL</h4>
							</td>
						</tr>
						<tr>
							<td>
								<span style='display: block;font-size: 17px;font-weight: 700;color: #333333;'>안녕하세요 촌의 감각입니다.</span>
							</td>
						</tr>
						<tr>
							<td>
								<p style='line-height:20px;color:#333333;margin:0;padding:30px 0 73px;'>
									<span style='color:#809255;'>24시간</span> 이내에 이메일 인증을 클릭해주시면 이메일(아이디) 변경이 완료됩니다.<br>
									24시간 이내에 이메일 인증이 완료되지 않을 경우,<br>
									이메일(아이디) 변경이 진행되지 않습니다.
								</p>
								<a href='http://www.store-chon.com/dev/email_change.php?o_mail=".$mb_email."&c_mail=".$change_email."' style='display:inline-block;text-align:center;margin-bottom:65px;'>
									<span style='display:inline-block;padding:16px 54px;background-color:#809255;font-size:18px;color:#ffffff;letter-spacing:2px;'>인증하기</span>
								</a>
							</td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<td>
								<p style='padding:24px 0 71px;color:#333333;font-size:17px;line-height:22px;'>
									촌의 감각 주문 관련 문의는 1:1문의 및 고객지원센터 T. 02-235-2475를 이용해 주십시오.<br>
									본 메일은 발신전용 메일이며 회신되지 않습니다.
								</p>
							</td>
						</tr>
					</tfoot>
				</table>",
					"$change_email", "$mb_name");

				$flag = "Y";
			}

			echo $flag;
		break;

		case "sear_id":
			$mb_name 	= $_REQUEST['mb_name'];
			$mb_email 	= $_REQUEST['mb_email'];

			$query		= "SELECT mb_id FROM ".$_gl['member_info_table']." WHERE mb_name='".$mb_name."' AND mb_email='".$mb_email."'";
			$result		= mysqli_query($my_db, $query);
			$data 		= mysqli_fetch_array($result);

			if($data){
				$replace_id = substr_replace($data['mb_id'], "***", -3);
				$flag = "Y||".$replace_id;
			}else{
				$flag = "N||none";
			}

			echo $flag;

		break;

		case "member_find":

			$mb_password 	= $_REQUEST['mb_password'];
			$mb_name 		= $_REQUEST['mb_name'];
			$mb_email 		= $_REQUEST['mb_email'];
			$submitTarget	= $_REQUEST["submitTarget"];

			if ($submitTarget == "fid")
			{
				$query		= "SELECT mb_email FROM ".$_gl['member_info_table']." WHERE mb_name='".$mb_name."' AND mb_password=MD5('".$mb_password."')";
				$result		= mysqli_query($my_db, $query);
				$data 		= mysqli_fetch_array($result);
	
				if($data){
					$email_arr	= explode("@",$data['mb_email']);

					$email_arr[0] = substr_replace($email_arr[0], "***", -3);
					$replace_id = $email_arr[0]."@".$email_arr[1];
					$flag = "Y||".$replace_id;
				}else{
					$flag = "N||none";
				}
	
			}else{
				$query		= "SELECT * FROM ".$_gl['member_info_table']." WHERE mb_email='".$mb_email."'";
				$result		= mysqli_query($my_db, $query);
				$data 		= mysqli_fetch_array($result);

				if($data){
					$temp_pw = PHPRandom::getHexString(12);
					//$password = create_hash($temp_pw);
					$update_query = "UPDATE ".$_gl['member_info_table']." SET mb_password=MD5('".$temp_pw."') WHERE mb_email='".$data['mb_email']."'";
					$update_result   = mysqli_query($my_db, $update_query);

					if($update_result)
					{
						$mail_result = sendMail(
							"yh.kim@minivertising.kr",
							"촌의감각",
							"비밀번호가 변경되었습니다.",
							"<table style='width: 700px;margin: 61px 0 74px 31px;table-layout:fixed;border-spacing: 0;border-collapse: collapse;border-spacing: 0;border: 0;' border-spacing='0' cellspacing='0' cellpadding='0' border='0'>
							<thead>
								<tr>
									<th>
										<a style='color: inherit;' href='http://www.store-chon.com/' target='_blank'>
											<img style='display: block;padding-bottom: 25px;' src='http://www.store-chon.com/dev/images/logo.png' alt='촌의감각'>
										</a>
									</th>
								</tr>
							</thead>
							<tbody style='border-width: 1px;border-style: solid;border-color: #333333;border-left: none;border-right: none;'>
								<tr>
									<td>
										<h4 style='font-size: 25px;color: #333333;margin: 0;padding: 60px 0 58px;'>PASSWORD</h4>
									</td>
								</tr>
								<tr>
									<td>
										<span style='display: block;font-size: 17px;font-weight: 700;color: #333333;'>안녕하세요 촌의 감각입니다.</span>
									</td>
								</tr>
								<tr>
									<td>
										<p style='line-height:20px;color:#333333;margin:0;padding:30px 0 25px;'>
											요청하신 임시 비밀번호가 발급되었습니다.<br>
											<a style='color: inherit;' href='javascript:void(0)'>임시 비밀번호를 통해 로그인 하신 후 반드시 새로운 비밀번호를 MY PAGE</a>에서 설정해 주시기 바랍니다.
										</p>
										<span style='display:inline-block;padding-bottom:58px;color:#809255;'>[".$temp_pw."]</span>
									</td>
								</tr>
							</tbody>
							<tfoot>
								<tr>
									<td>
										<p style='padding:24px 0 71px;color:#333333;font-size:17px;line-height:22px;'>
											촌의 감각 주문 관련 문의는 1:1문의 및 고객지원센터 T. 02-235-2475를 이용해 주십시오.<br>
											본 메일은 발신전용 메일이며 회신되지 않습니다.
										</p>
									</td>
								</tr>
							</tfoot>
						</table>",
							"".$data['mb_email']."", "$username");
						/*
						if($mail_result == "Y")
							$flag = "Y"; // 메일 발송까지 완료
						else
							$flag = "E"; // 메일 발송 오류
						*/
						$flag = "Y"; // 메일 발송까지 완료
					}else{
						$flag = "E"; // 비밀번호 업데이트 오류
					}

				}else{
					$flag = "N"; // 입력한 정보의 회원이 없음
				}
			}
			echo $flag;

		break;


		case "insert_banner_info" :
			$banner_name		= $_REQUEST['banner_name'];
			$banner_type		= $_REQUEST['banner_type'];
			$banner_query		= "INSERT INTO ".$_gl['banner_info_table']."(banner_name,banner_type,banner_regdate) values('".$banner_name."','".$banner_type."','".date("Y-m-d H:i:s")."')";
			$banner_result		= mysqli_query($my_db, $banner_query);
			if($banner_result)
				$flag = "Y";
			else
				$flag = "N";
			echo $banner_query;
		break;

		case "insert_oto_info" :
			$oto_question_type		= $_REQUEST['oto_question_type'];
			$oto_title				= $_REQUEST['oto_title'];
			$oto_contents			= $_REQUEST['oto_contents'];
		
			$oto_query		= "INSERT INTO ".$_gl['board_oto_table']."(oto_email, oto_question_type, oto_title, oto_contents, oto_regdate, oto_ipaddr) values('".$_SESSION['ss_chon_email']."','".$oto_question_type."','".$oto_title."','".$oto_contents."','".date("Y-m-d H:i:s")."','".$_SERVER["REMOTE_ADDR"]."')";
			$oto_result		= mysqli_query($my_db, $oto_query);

			if($oto_result)
				$flag = "Y";
			else
				$flag = "N";

			echo $flag;

		break;

		case "delete_oto_info" :
			$oto_idx	= $_REQUEST["oto_idx"];

			$oto_query		= "UPDATE ".$_gl['board_oto_table']." SET oto_showYN='N' WHERE idx='".$oto_idx."'";
			$oto_result		= mysqli_query($my_db, $oto_query);

			if($oto_result)
				$flag = "Y";
			else
				$flag = "N";

			echo $flag;
		break;

		case "sort_oto_list" :
			$sort_val	= $_REQUEST["sort_val"];

			$oto_query		= "SELECT * FROM ".$_gl['board_oto_table']." WHERE oto_question_type='".$sort_val."'";
			$oto_result		= mysqli_query($my_db, $oto_query);
		break;
/*
		case "write_review":

			$user_id = $_REQUEST['user_id'];
			$goods_code = $_REQUEST['goods_code'];
			$subject = $_REQUEST['subject'];
			$content = $_REQUEST['content'];

			$s_query = "SELECT max(thread) AS thread, max(idx) FROM ".$_gl['board_review_table']."";
			$max_thread_result = mysqli_query($my_db, $s_query);
			$max_thread_fetch = mysqli_fetch_row($max_thread_result);

			$max_thread = ceil($max_thread_fetch[0]/1000)*1000+1000;
			$max_idx = $max_thread_fetch[1]+1;

			$i_query = "INSERT INTO ".$_gl['board_review_table']."(group_id, thread, depth, user_id, goods_code, subject, content, date, ipaddr)
			VALUES('".$max_idx."','".$max_thread."',0,'".$user_id."','".$goods_code."','".$subject."','".$content."','".date('Y-m-d H:i:s')."','".$_SERVER['REMOTE_ADDR']."')";

			$i_result = mysqli_query($my_db, $i_query); // 글 저장

			if($i_result){
				$flag = "Y";
			}else{
				$flag = "N";
			}

			echo $flag;

		break;

		case "write_qna":

			$user_id = $_REQUEST['user_id'];
			$goods_code = $_REQUEST['goods_code'];
			$subject = $_REQUEST['subject'];
			$content = $_REQUEST['content'];

			$s_query = "SELECT max(thread) AS thread, max(idx) FROM ".$_gl['board_qna_table']."";
			$max_thread_result = mysqli_query($my_db, $s_query);
			$max_thread_fetch = mysqli_fetch_row($max_thread_result);

			$max_thread = ceil($max_thread_fetch[0]/1000)*1000+1000;
			$max_idx = $max_thread_fetch[1]+1;

			$i_query = "INSERT INTO ".$_gl['board_qna_table']."(group_id, thread, depth, user_id, goods_code, subject, content, date, ipaddr)
			VALUES('".$max_idx."','".$max_thread."',0,'".$user_id."','".$goods_code."','".$subject."','".$content."','".date('Y-m-d H:i:s')."','".$_SERVER['REMOTE_ADDR']."')";

			$i_result = mysqli_query($my_db, $i_query); // 글 저장

			if($i_result){
				$flag = "Y";
			}else{
				$flag = "N";
			}

			echo $flag;

		break;

		case "write_mtm":

			$user_id       = $_REQUEST['user_id'];
			$user_email    = $_REQUEST['user_email'];
			$question_type = $_REQUEST['question_type'];
			$subject       = $_REQUEST['subject'];
			$content       = $_REQUEST['content'];

			$s_query = "SELECT max(thread) AS thread, max(idx) FROM ".$_gl['board_mtm_table']."";
			$max_thread_result = mysqli_query($my_db, $s_query);
			$max_thread_fetch = mysqli_fetch_row($max_thread_result);

			$max_thread = ceil($max_thread_fetch[0]/1000)*1000+1000;
			$max_idx = $max_thread_fetch[1]+1;

			$i_query = "INSERT INTO ".$_gl['board_mtm_table']."(group_id, thread, depth, user_id, user_email, question_type, subject, content, date, ipaddr)
			VALUES('".$max_idx."','".$max_thread."',0,'".$user_id."','".$user_email."','".$question_type."','".$subject."','".$content."','".date('Y-m-d H:i:s')."','".$_SERVER['REMOTE_ADDR']."')";

			$i_result = mysqli_query($my_db, $i_query); // 글 저장

			if($i_result){
				$flag = "Y";
			}else{
				$flag = "N";
			}

			echo $flag;

		break;

		case "edit_review":

			$user_id = $_REQUEST['user_id'];
			$idx	 = $_REQUEST['idx'];
			$goods_code = $_REQUEST['goods_code'];
			$subject = $_REQUEST['subject'];
			$content = $_REQUEST['content'];

			// $s_query = "SELECT max(thread) AS thread FROM ".$_gl['board_review_table']."";
			// $max_thread_result = mysqli_query($my_db, $s_query);
			// $max_thread_fetch = mysqli_fetch_row($max_thread_result);

			// $max_thread = ceil($max_thread_fetch[0]/1000)*1000+1000;

			$u_query = "UPDATE ".$_gl['board_review_table']." SET subject='".$subject."', content='".$content."', date='".date('Y-m-d H:i:s')."', ipaddr='".$_SERVER['REMOTE_ADDR']."' WHERE idx='".$idx."'";
			$u_result = mysqli_query ($my_db, $u_query); // 글 수정
			if($u_result){
				$flag = "Y";
			}else{
				$flag = "N";
			}

			echo $flag;

		break;

		case "edit_qna":

			$user_id       = $_REQUEST['user_id'];
			$subject       = $_REQUEST['subject'];
			$goods_code = $_REQUEST['goods_code'];
			$content       = $_REQUEST['content'];
			$idx           = $_REQUEST['idx'];

			// $s_query = "SELECT max(thread) AS thread FROM ".$_gl['board_review_table']."";
			// $max_thread_result = mysqli_query($my_db, $s_query);
			// $max_thread_fetch = mysqli_fetch_row($max_thread_result);

			// $max_thread = ceil($max_thread_fetch[0]/1000)*1000+1000;

			$u_query = "UPDATE ".$_gl['board_qna_table']." SET subject='".$subject."', content='".$content."', date='".date('Y-m-d H:i:s')."', ipaddr='".$_SERVER['REMOTE_ADDR']."' WHERE idx='".$idx."'";
			$u_result = mysqli_query ($my_db, $u_query); // 글 수정
			if($u_result){
				$flag = "Y";
			}else{
				$flag = "N";
			}

			echo $flag;

		break;

		case "edit_mtm":

			$user_id    = $_REQUEST['user_id'];
			$idx	    = $_REQUEST['idx'];
			$subject    = $_REQUEST['subject'];
			$content    = $_REQUEST['content'];
			$question_type = $_REQUEST['question_type'];
			$user_email    = $_REQUEST['user_email'];


			// $s_query = "SELECT max(thread) AS thread FROM ".$_gl['board_review_table']."";
			// $max_thread_result = mysqli_query($my_db, $s_query);
			// $max_thread_fetch = mysqli_fetch_row($max_thread_result);

			// $max_thread = ceil($max_thread_fetch[0]/1000)*1000+1000;

			$u_query = "UPDATE ".$_gl['board_mtm_table']." SET subject='".$subject."', content='".$content."', date='".date('Y-m-d H:i:s')."', question_type='".$question_type."', user_email='".$user_email."', ipaddr='".$_SERVER['REMOTE_ADDR']."' WHERE idx='".$idx."'";
			$u_result = mysqli_query ($my_db, $u_query); // 글 수정
			if($u_result){
				$flag = "Y";
			}else{
				$flag = "N";
			}

			echo $flag;

		break;

		case "reply_review":

			$user_id = $_REQUEST['user_id'];
			$idx	 = $_REQUEST['idx'];
			$goods_code = $_REQUEST['goods_code'];
			$subject = $_REQUEST['subject'];
			$content = $_REQUEST['content'];
			$p_thread = $_REQUEST['p_thread'];
			$p_depth = $_REQUEST['p_depth'];
			$parent_gID = $_REQUEST['parent_gID'];

			$prev_parent_thread = ceil($p_thread/1000)*1000 - 1000; // 올림

			//원본글보다는 작고 위값보다는 큰 글들의 thread 값을 모두 1씩 낮춘다.
			//만약 부모글이 2000이면 prev_parent_thread는 1000이므로 2000> x >1000 인 x 글들을 모두 -1 한다.

			$u_query = "UPDATE ".$_gl['board_review_table']." SET thread=thread-1 WHERE thread > '".$prev_parent_thread."' AND thread < '".$p_thread."'";
			$result = mysqli_query ($my_db, $u_query);

			//원본글보다는 1 작은 값으로 답글을 등록한다.
			//원본글의 바로 밑에 등록되게 된다.
			//depth는 원본글의 depth + 1 이다. 원본글이 3(이글도 답글)이면 답글은 4가된다.
			$i_query = "INSERT INTO ".$_gl['board_review_table']."(group_id, thread, depth, user_id, goods_code, subject, content, date, ipaddr)
						VALUES ('".$parent_gID."','".$p_thread."'-1,'".$p_depth."'+1,'".$user_id."','".$goods_code."','".$subject."','".$content."','".date('Y-m-d H:i:s')."','".$_SERVER['REMOTE_ADDR']."')";
			$result = mysqli_query($my_db, $i_query);

			if($result){
				$flag = "Y";
			}else{
				$flag = "N";
			}

			echo $flag;

		break;

		case "reply_qna":

			$user_id = $_REQUEST['user_id'];
			$idx	 = $_REQUEST['idx'];
			$goods_code = $_REQUEST['goods_code'];
			$subject = $_REQUEST['subject'];
			$content = $_REQUEST['content'];
			$p_thread = $_REQUEST['p_thread'];
			$p_depth = $_REQUEST['p_depth'];
			$parent_gID = $_REQUEST['parent_gID'];

			$prev_parent_thread = ceil($p_thread/1000)*1000 - 1000; // 올림

			//원본글보다는 작고 위값보다는 큰 글들의 thread 값을 모두 1씩 낮춘다.
			//만약 부모글이 2000이면 prev_parent_thread는 1000이므로 2000> x >1000 인 x 글들을 모두 -1 한다.

			$u_query = "UPDATE ".$_gl['board_qna_table']." SET thread=thread-1 WHERE thread > '".$prev_parent_thread."' AND thread < '".$p_thread."'";
			$result = mysqli_query ($my_db, $u_query);

			//원본글보다는 1 작은 값으로 답글을 등록한다.
			//원본글의 바로 밑에 등록되게 된다.
			//depth는 원본글의 depth + 1 이다. 원본글이 3(이글도 답글)이면 답글은 4가된다.
			$i_query = "INSERT INTO ".$_gl['board_qna_table']."(group_id, thread, depth, user_id, goods_code, subject, content, date, ipaddr)
						VALUES ('".$parent_gID."','".$p_thread."'-1,'".$p_depth."'+1,'".$user_id."','".$goods_code."','".$subject."','".$content."','".date('Y-m-d H:i:s')."','".$_SERVER['REMOTE_ADDR']."')";
			$result = mysqli_query($my_db, $i_query);

			if($result){
				$flag = "Y";
			}else{
				$flag = "N";
			}

			echo $flag;

			break;

		case "delete_review":

			$user_id = $_REQUEST['user_id'];
			$idx	 = $_REQUEST['idx'];
			$group_id	 = $_REQUEST['group_id'];
			$goods_code = $_REQUEST['goods_code'];

			$del_subject = "삭제된 글입니다.";
			$del_content = "삭제된 글입니다.";


			$query = "SELECT * FROM ".$_gl['board_review_table']." WHERE group_id = '".$group_id."'";
			$result = mysqli_query($my_db, $query);
			$rows = mysqli_num_rows($result);

			// $query = "SELECT * FROM ".$_gl['board_review_table']." WHERE idx='".$idx."' AND group_id=";
			// $result = mysqli_query($my_db, $query);
			// $data = mysqli_fetch_array($result);


			if($rows>1)
			{
				$query = "UPDATE ".$_gl['board_review_table']." SET subject='".$del_subject."', content='".$del_content."', date='".date('Y-m-d H:i:s')."', ipaddr='".$_SERVER['REMOTE_ADDR']."' WHERE idx='".$idx."'";
				$result = mysqli_query($my_db, $query); // 글 수정 (답변글 존재)
			}else{
				$query = "DELETE FROM ".$_gl['board_review_table']." WHERE idx='".$idx."'";
				$result = mysqli_query($my_db, $query); // 글 삭제 (답변글 X)
			}

			if($result){
				$flag = "Y";
			}else{
				$flag = "N";
			}

			echo $flag;
		break;

		case "delete_qna":

			$user_id = $_REQUEST['user_id'];
			$idx	 = $_REQUEST['idx'];
			$group_id	 = $_REQUEST['group_id'];
			$goods_code = $_REQUEST['goods_code'];

			$del_subject = "삭제된 글입니다.";
			$del_content = "삭제된 글입니다.";


			$query = "SELECT * FROM ".$_gl['board_qna_table']." WHERE group_id = '".$group_id."'";
			$result = mysqli_query($my_db, $query);
			$rows = mysqli_num_rows($result);

			// $query = "SELECT * FROM ".$_gl['board_review_table']." WHERE idx='".$idx."' AND group_id=";
			// $result = mysqli_query($my_db, $query);
			// $data = mysqli_fetch_array($result);


			if($rows>1)
			{
				$query = "UPDATE ".$_gl['board_qna_table']." SET subject='".$del_subject."', content='".$del_content."', date='".date('Y-m-d H:i:s')."', ipaddr='".$_SERVER['REMOTE_ADDR']."' WHERE idx='".$idx."'";
				$result = mysqli_query($my_db, $query); // 글 수정 (답변글 존재)
			}else{
				$query = "DELETE FROM ".$_gl['board_qna_table']." WHERE idx='".$idx."'";
				$result = mysqli_query($my_db, $query); // 글 삭제 (답변글 X)
			}

			if($result){
				$flag = "Y";
			}else{
				$flag = "N";
			}

			echo $flag;
			break;
*/
		case "add_wishlist" : // 사용하는 코드
			$goods_code		= $_REQUEST['goods_code'];
			//$goods_option	= $_REQUEST['goods_option'];
			$mb_id			= $_SESSION['ss_chon_email'];

			if ($mb_id == "")
			{
				$flag	= "N"; // 로그인 안되어 있음.
			}else{
				$wish_query 	= "SELECT * FROM ".$_gl['wishlist_info_table']." WHERE mb_id='".$mb_id."' AND goods_code='".$goods_code."' AND showYN='Y'";
				$wish_result 	= mysqli_query($my_db, $wish_query);
				$wish_data		= mysqli_fetch_array($wish_result);

				if ($wish_data)
				{
					$wish_query2 	= "UPDATE ".$_gl['wishlist_info_table']." SET showYN='N' WHERE mb_id='".$mb_id."' AND goods_code='".$goods_code."'";
					$wish_result2 	= mysqli_query($my_db, $wish_query2);

					$flag	= "D";
				}else{
					$wish_query2 	= "INSERT INTO ".$_gl['wishlist_info_table']."(mb_id, goods_code, wish_regdate) values('".$mb_id."','".$goods_code."','".date("Y-m-d H:i:s")."')";
					$wish_result2 	= mysqli_query($my_db, $wish_query2);

					if ($wish_result2)
						$flag	= "Y";
					else
						$flag	= "E";
				}
			}
			echo $flag;
		break;

		case "add_mycart" :
			$goods_code		= $_REQUEST['goods_code'];
			$loginYN		= $_REQUEST['loginYN'];
			// $goods_option	= $_REQUEST['goods_option'];
			// $buy_cnt			= $_REQUEST['buy_cnt'];
			$mb_id			= $_SESSION['ss_chon_email'];
			// $cart_id			= $_SESSION['ss_chon_cartid'];

			if ($_SESSION['ss_chon_email'])
			{
				// $mb_id					= create_cartid();
				$mb_id						= $_SESSION['ss_chon_email'];
			}else{
				$_SESSION['ss_chon_email']	= create_cartid();
				$mb_id						= $_SESSION['ss_chon_email'];
			}

			$cart_query 	= "SELECT * FROM ".$_gl['mycart_info_table']." WHERE mb_email='".$mb_id."' AND goods_code='".$goods_code."' AND showYN='Y' AND cart_regdate >= date_add(now(), interval -3 day)";
			$cart_result 	= mysqli_query($my_db, $cart_query);
			$cart_num 	= mysqli_num_rows($cart_result);

			if ($cart_num > 0)
			{
				$cart_data	= mysqli_fetch_array($cart_result);

				$cart_query2		= "UPDATE ".$_gl['mycart_info_table']." SET goods_cnt=goods_cnt+1 WHERE idx='".$cart_data['idx']."'";
				$cart_result2		= mysqli_query($my_db, $cart_query2);
			}else{
				$cart_query2 	= "INSERT INTO ".$_gl['mycart_info_table']."(mb_email, goods_code, goods_cnt, cart_regdate) values('".$mb_id."','".$goods_code."','1','".date("Y-m-d H:i:s")."')";
				$cart_result2 	= mysqli_query($my_db, $cart_query2);
			}

			if ($cart_result2)
				$flag	= "Y";
			else
				$flag	= "N";

			echo $flag;

		break;

		case "insert_restock" :
			$goods_idx	= $_REQUEST['goods_idx'];
			$mb_id		= $_SESSION['ss_chon_id'];

			if ($mb_id == "")
			{
				$flag	= "N"; // 로그인이 안되어 있을 경우
			}else{
				$restock_query2 	= "INSERT INTO ".$_gl['restock_info_table']."(restock_goodsidx, restock_mb_id, restock_regdate) values('".$goods_idx."','".$mb_id."','".date("Y-m-d H:i:s")."')";
				$restock_result2 	= mysqli_query($my_db, $restock_query2);

				if ($restock_result2)
					$flag	= "Y";
				else
					$flag	= "E";
			}

			echo $flag;
		break;

		case "delete_wishlist" :
			$goods_idx	= $_REQUEST['goods_idx'];
			$wish_idx		= $_REQUEST['wish_idx'];
			$mb_id		= $_SESSION['ss_chon_id'];

			if ($mb_id == "")
			{
				$flag	= "N"; // 로그인이 안되어 있을 경우
			}else{
				$wish_query 	= "UPDATE ".$_gl['wishlist_info_table']." SET showYN='N' WHERE idx='".$wish_idx."'";
				$wish_result 	= mysqli_query($my_db, $wish_query);

				if ($wish_result)
					$flag	= "Y";
				else
					$flag	= "E";
			}

			echo $flag;

		break;

		case "move_mycart" :
			$wish_idx		= $_REQUEST['wish_idx'];
			$mb_id		= $_SESSION['ss_chon_id'];

			$wish_query 	= "SELECT * FROM ".$_gl['wishlist_info_table']." WHERE idx='".$wish_idx."'";
			$wish_result 		= mysqli_query($my_db, $wish_query);
			$wish_data		= mysqli_fetch_array($wish_result);

			$du_cart_query	= "SELECT * FROM ".$_gl['mycart_info_table']." WHERE mb_id='".$wish_data['mb_id']."' AND goods_idx='".$wish_data['goods_idx']."' AND goods_option='".$wish_data['goods_option']."' AND showYN='Y'";
			$du_cart_result	= mysqli_query($my_db, $du_cart_query);
			$du_cart_cnt		= mysqli_num_rows($du_cart_result);

			if ($du_cart_cnt > 0)
			{
				// 장바구니에 같은 상품이 있을 경우에 수량 +1 로직 (임시 제거)
				//$cart_query 	= "UPDATE ".$_gl['mycart_info_table']." SET goods_cnt=goods_cnt+1 WHERE mb_id='".$wish_data['mb_id']."' AND goods_idx='".$wish_data['goods_idx']."' AND goods_option='".$wish_data['goods_option']."' AND showYN='Y'";
				//$cart_result 		= mysqli_query($my_db, $cart_query);
				$flag	= "D";
			}else{
				$cart_query 	= "INSERT INTO ".$_gl['mycart_info_table']."(mb_id, goods_idx, goods_option, cart_regdate) values('".$mb_id."','".$wish_data['goods_idx']."','".$wish_data['goods_option']."','".date("Y-m-d H:i:s")."')";
				$cart_result 		= mysqli_query($my_db, $cart_query);

				if ($cart_result)
					$flag	= "Y";
				else
					$flag	= "N";
			}

			echo $flag;
		break;

		case "move_wishlist" :
			$cart_idx	= $_REQUEST['cart_idx'];
			$mb_id		= $_SESSION['ss_chon_id'];

			$cart_query		= "SELECT * FROM ".$_gl['mycart_info_table']." WHERE idx='".$cart_idx."'";
			$cart_result		= mysqli_query($my_db, $cart_query);
			$cart_data		= mysqli_fetch_array($cart_result);

			$wish_query		= "SELECT * FROM ".$_gl['wishlist_info_table']." WHERE goods_idx='".$cart_data['goods_idx']."' AND mb_id='".$mb_id."' AND showYN='Y'";
			$wish_result		= mysqli_query($my_db, $wish_query);
			$wish_num		= mysqli_num_rows($wish_result);

			if ($wish_num > 0)
			{
				$flag	= "D";
			}else{
				$wish2_query 	= "INSERT INTO ".$_gl['wishlist_info_table']."(mb_id, goods_idx, goods_option, wish_regdate) values('".$mb_id."','".$cart_data['goods_idx']."','".$cart_data['goods_option']."','".date("Y-m-d H:i:s")."')";
				$wish2_result 		= mysqli_query($my_db, $wish2_query);

				if ($wish2_result)
					$flag	= "Y";
				else
					$flag	= "N";
			}

			echo $flag;
		break;

		case "delete_all_cart" :
			$mb_id		= $_SESSION['ss_chon_id'];
			$direction	= $_REQUEST['direction'];

			if($direction == "cart")
			{
				$cart_query 	= "UPDATE ".$_gl['mycart_info_table']." SET showYN='N' WHERE mb_id='".$mb_id."' AND cart_regdate >= date_add(now(), interval -3 day)";
				$result 		= mysqli_query($my_db, $cart_query);
			}else{
				$wish_query 	= "UPDATE ".$_gl['wishlist_info_table']." SET showYN='N' WHERE mb_id='".$mb_id."'";
				$result 		= mysqli_query($my_db, $wish_query);
			}

			if ($result)
				$flag	= "Y";
			else
				$flag	= "N";

			echo $flag;
		break;

		case "delete_one_cart" :
			$mb_email		= $_SESSION['ss_chon_email'];
			$cart_idx		= $_REQUEST['cart_idx'];

			$cart_query 	= "UPDATE ".$_gl['mycart_info_table']." SET showYN='N' WHERE mb_email='".$mb_email."' AND idx='".$cart_idx."'";
			$result 		= mysqli_query($my_db, $cart_query);

			if ($result)
				$flag	= "Y";
			else
				$flag	= "N";

			echo $flag;
		break;

		case "delete_chk_cart" :
			$mb_email		= $_SESSION['ss_chon_email'];
			$chk_idx		= $_REQUEST['chk_idx'];

			$chk_idx_arr		= explode(",",$chk_idx);

			$i = 0;
			foreach($chk_idx_arr as $key => $val)
			{
				if ($i == 0)
				{
					$i++;
					continue;
				}

				$cart_query 	= "UPDATE ".$_gl['mycart_info_table']." SET showYN='N' WHERE idx='".$val."' AND mb_email='".$mb_email."'";
				$result 		= mysqli_query($my_db, $cart_query);
				$i++;
			}

			if ($result)
				$flag	= "Y";
			else
				$flag	= "N";

			echo $flag;

		break;

		case "delete_chk_wish" :
			$mb_email		= $_SESSION['ss_chon_email'];
			$chk_idx		= $_REQUEST['chk_idx'];

			$chk_idx_arr		= explode(",",$chk_idx);

			$i = 0;
			foreach($chk_idx_arr as $key => $val)
			{
				if ($i == 0)
				{
					$i++;
					continue;
				}

				$wish_query 	= "UPDATE ".$_gl['wishlist_info_table']." SET showYN='N' WHERE idx='".$val."' AND mb_id='".$mb_email."'";
				$result 		= mysqli_query($my_db, $wish_query);
				$i++;
			}

			if ($result)
				$flag	= "Y";
			else
				$flag	= "N";

			echo $flag;

		break;

		case "delete_one_wish" :
			$mb_email		= $_SESSION['ss_chon_email'];
			$wish_idx		= $_REQUEST['wish_idx'];

			$wish_query 	= "UPDATE ".$_gl['wishlist_info_table']." SET showYN='N' WHERE mb_id='".$mb_email."' AND idx='".$wish_idx."'";
			$result 		= mysqli_query($my_db, $wish_query);

			if ($result)
				$flag	= "Y";
			else
				$flag	= "N";

			echo $flag;
		break;

		case "update_cart_cnt" :
			$cart_idx		= $_REQUEST['cart_idx'];
			$goods_cnt		= $_REQUEST['goods_cnt'];
			$mb_email		= $_SESSION['ss_chon_email'];

			$cart_query 	= "UPDATE ".$_gl['mycart_info_table']." SET goods_cnt='".$goods_cnt."' WHERE idx='".$cart_idx."' AND mb_email='".$mb_email."'";
			$cart_result 		= mysqli_query($my_db, $cart_query);

			if ($cart_result)
				$flag	= "Y";
			else
				$flag	= "N";

			echo $flag;

		break;

		case "show_cate_goods_list" :
			$cate1			= $_REQUEST['cate1'];
			$cate2			= $_REQUEST['cate2'];

			if ($cate2 == "0")
				$where	= "";
			else
				$where	= " AND cate_2='".$cate2."'";

			if ($_SESSION['ss_chon_grade'] == "6")
				$list_query		= "SELECT * FROM ".$_gl['goods_info_table']." WHERE cate_1='".$cate1."' ".$where." ORDER BY idx DESC limit 16";
			else
				$list_query		= "SELECT * FROM ".$_gl['goods_info_table']." WHERE showYN='Y' AND cate_1='".$cate1."' ".$where." ORDER BY idx DESC limit 16";
			$list_result		= mysqli_query($my_db, $list_query);

			$innerHTML	= "";
			$i = 0;
			while ($list_data = mysqli_fetch_array($list_result))
			{
				$list_data['goods_img_url']	= str_replace("../../../",$_mnv_base_url,$list_data['goods_img_url']);

				if ($list_data['discount_price'] == 0)
					$current_price	= $list_data['sales_price'];
				else
					$current_price	= $list_data['discount_price'];

				$percent_num	= ceil(100 - (($list_data['discount_price'] / $list_data['sales_price'])*100));

				if ($i % 4 == 0)
					$innerHTML		.= '<div class="list_product clearfix">';

				$innerHTML		.= '<div class="product n4">';
				$innerHTML		.= '<a href="'.$_mnv_PC_goods_url.'goods_detail.php?goods_code='.$list_data['goods_code'].'"><img src="'.$list_data['goods_img_url'].'" style="width:205px;height:205px"></a>';
				$innerHTML		.= '<div class="prd_info">';
				$innerHTML		.= '<span class="prd_name">'.$list_data['goods_name'].'</span>';
				if ($list_data['sales_price'] != $current_price)
					$innerHTML		.= '<span class="prd_price">'.number_format($list_data['sales_price']).'</span>';
				$innerHTML		.= '<span class="prd_sale" style="display:inline-block;padding-right:0;">'.number_format($current_price).'</span>';
				if ($percent_num < 100)
					$innerHTML		.= '<span class="sale_pctg" style="display:inline-block;padding-left:2px;font-size:13px;color:#00481c;">['.$percent_num.'%]</span>';
				$innerHTML		.= '<span class="prd_desc">'.$list_data['goods_small_desc'].'</span>';
				$innerHTML		.= '</div></div>';

				if ($i == 3 || $i == 7 || $i == 11 || $i == 15)
					$innerHTML		.= '</div>';
				$i++;
			}

			echo $innerHTML;
		break;

		case "show_cate_goods_list_sort" :

			$cate1			= $_REQUEST['cate1'];
			$cate2			= $_REQUEST['cate2'];
			$sort				= $_REQUEST['sort'];

			if ($cate2 == "0")
				$where	= "";
			else
				$where	= " AND cate_2='".$cate2."'";

			$list_query		= "SELECT * FROM ".$_gl['goods_info_table']." WHERE showYN='Y' AND cate_1='".$cate1."' ".$where." ORDER BY ".$sort." limit 16";
			$list_result		= mysqli_query($my_db, $list_query);

			$innerHTML	= "";
			$i = 0;
			while ($list_data = mysqli_fetch_array($list_result))
			{
				$list_data['goods_img_url']	= str_replace("../../../",$_mnv_base_url,$list_data['goods_img_url']);

				if ($list_data['discount_price'] == 0)
					$current_price	= $list_data['sales_price'];
				else
					$current_price	= $list_data['discount_price'];

				$percent_num	= ceil(100 - (($list_data['discount_price'] / $list_data['sales_price'])*100));

				if ($i % 4 == 0)
					$innerHTML		.= '<div class="list_product clearfix">';

				$innerHTML		.= '<div class="product n4">';
				$innerHTML		.= '<a href="'.$_mnv_PC_goods_url.'goods_detail.php?goods_code='.$list_data['goods_code'].'"><img src="'.$list_data['goods_img_url'].'" style="width:205px;height:205px"></a>';
				$innerHTML		.= '<div class="prd_info">';
				$innerHTML		.= '<span class="prd_name">'.$list_data['goods_name'].'</span>';
				if ($list_data['sales_price'] != $current_price)
					$innerHTML		.= '<span class="prd_price">'.number_format($list_data['sales_price']).'</span>';
				$innerHTML		.= '<span class="prd_sale" style="display:inline-block;padding-right:0;">'.number_format($current_price).'</span>';
				if ($percent_num < 100)
					$innerHTML		.= '<span class="sale_pctg" style="display:inline-block;padding-left:2px;font-size:13px;color:#00481c;">['.$percent_num.'%]</span>';
				$innerHTML		.= '<span class="prd_desc">'.$list_data['goods_small_desc'].'</span>';
				$innerHTML		.= '</div></div>';

				if ($i == 3 || $i == 7 || $i == 11 || $i == 15)
					$innerHTML		.= '</div>';
				$i++;
			}

			echo $innerHTML;
		break;

		case "insert_order_info" :
			$order_goods			= $_REQUEST['order_goods'];
			$order_name				= $_REQUEST['order_name'];
			$order_email			= $_REQUEST['order_email'];
			$order_phone			= $_REQUEST['order_phone'];
			$delivery_name			= $_REQUEST['delivery_name'];
			$delivery_zipcode		= $_REQUEST['delivery_zipcode'];
			$delivery_addr1			= $_REQUEST['delivery_addr1'];
			$delivery_addr2			= $_REQUEST['delivery_addr2'];
			$delivery_phone			= $_REQUEST['delivery_phone'];
			$delivery_message		= $_REQUEST['delivery_message'];
			$total_order_price		= $_REQUEST['total_order_price'];
			$total_delivery_price	= $_REQUEST['total_delivery_price'];
			$total_save_price		= $_REQUEST['total_save_price'];
			$total_payment_price	= $_REQUEST['total_payment_price'];
			$total_coupon_price		= $_REQUEST['total_coupon_price'];
			$pay_type				= $_REQUEST['pay_type'];
			$order_oid				= create_oid();
			$show_goods_name		= $_REQUEST['show_goods_name'];

			if ($pay_type == "card_pay")
					$USABLEPAY	= "SC0010";
			else if ($select_pay == "phone_pay")
					$USABLEPAY	= "SC0060";
			else
					$USABLEPAY	= "SC0040";

			$order_query		= "INSERT INTO ".$_gl['order_info_table']."(order_goods, show_goods_name, order_name, order_email, order_phone, delivery_name, delivery_zipcode, delivery_addr1, delivery_addr2, delivery_phone, delivery_message, total_order_price, total_delivery_price, total_save_price, total_payment_price, total_coupon_price, pay_type, order_oid, order_regdate) values('".$order_goods."','".$show_goods_name."','".$order_name."','".$order_email."','".$order_phone."','".$delivery_name."','".$delivery_zipcode."','".$delivery_addr1."','".$delivery_addr2."','".$delivery_phone."','".$delivery_message."','".$total_order_price."','".$total_delivery_price."','".$total_save_price."','".$total_payment_price."','".$total_coupon_price."','".$pay_type."','".$order_oid."','".date("Y-m-d H:i:s")."')";
			$order_result 		= mysqli_query($my_db, $order_query);

			if ($order_result)
			{
				$flag	= "Y";

				$innerHTML	= "";
				// $configPath								= $_SERVER['DOCUMENT_ROOT']."/mnv_mall2/lib/LGU+_SmartXPay_PHP/PHP7/lgdacom";                                  //LG유플러스에서 제공한 환경파일("/conf/lgdacom.conf") 위치 지정.
				$configPath								= $_SERVER['DOCUMENT_ROOT']."/dev/lib/LGU+_SmartXPay_PHP/PHP7/lgdacom";                                  //LG유플러스에서 제공한 환경파일("/conf/lgdacom.conf") 위치 지정.

				/*
				 *************************************************
				 * 2. MD5 해쉬암호화 (수정하지 마세요) - BEGIN
				 *
				 * MD5 해쉬암호화는 거래 위변조를 막기위한 방법입니다.
				 *************************************************
				 *
				 * 해쉬 암호화 적용( LGD_MID + LGD_OID + LGD_AMOUNT + LGD_TIMESTAMP + LGD_MERTKEY )
				 * LGD_MID          : 상점아이디
				 * LGD_OID          : 주문번호
				 * LGD_AMOUNT       : 금액
				 * LGD_TIMESTAMP    : 타임스탬프
				 * LGD_MERTKEY      : 상점MertKey (mertkey는 상점관리자 -> 계약정보 -> 상점정보관리에서 확인하실수 있습니다)
				 *
				 * MD5 해쉬데이터 암호화 검증을 위해
				 * LG유플러스에서 발급한 상점키(MertKey)를 환경설정 파일(lgdacom/conf/mall.conf)에 반드시 입력하여 주시기 바랍니다.
				 */
				$CST_PLATFORM						= "test";
				$CST_MID							= "miniver";
				$LGD_MID							= (("test" == $CST_PLATFORM)?"t":"").$CST_MID;   //상점아이디(자동생성)
				$LGD_OID							= $order_oid;
				$LGD_AMOUNT							= $total_payment_price;
				$LGD_TIMESTAMP						= date("YmdHis");

				// require_once($_SERVER['DOCUMENT_ROOT']."/mnv_mall2/lib/LGU+_SmartXPay_PHP/PHP7/lgdacom/XPayClient.php");
				require_once($_SERVER['DOCUMENT_ROOT']."/dev/lib/LGU+_SmartXPay_PHP/PHP7/lgdacom/XPayClient.php");
				$xpay = new XPayClient($configPath, $CST_PLATFORM);
				if (!$xpay->Init_TX($LGD_MID)) {
					echo "LG유플러스에서 제공한 환경파일이 정상적으로 설치 되었는지 확인하시기 바랍니다.<br/>";
					echo "mall.conf에는 Mert Id = Mert Key 가 반드시 등록되어 있어야 합니다.<br/><br/>";
					echo "문의전화 LG유플러스 1544-7772<br/>";
					exit;
				}
				$LGD_HASHDATA = md5($LGD_MID.$LGD_OID.$LGD_AMOUNT.$LGD_TIMESTAMP.$xpay->config[$LGD_MID]);
				$LGD_CUSTOM_PROCESSTYPE = "TWOTR";
				/*
				 *************************************************
				 * 2. MD5 해쉬암호화 (수정하지 마세요) - END
				 *************************************************
				 */
				$CST_WINDOW_TYPE = "submit";										// 수정불가
				$payReqMap['CST_PLATFORM']           = $CST_PLATFORM;				//LG유플러스 결제 서비스 선택(test:테스트, service:서비스)
				$payReqMap['CST_WINDOW_TYPE']        = $CST_WINDOW_TYPE;			// 수정불가
				$payReqMap['CST_MID']                = "miniver";					//상점아이디(LG유플러스으로 부터 발급받으신 상점아이디를 입력하세요)
				$payReqMap['LGD_MID']                = $LGD_MID;  //상점아이디(자동생성)
				$payReqMap['LGD_OID']                = $order_oid;					//주문번호(상점정의 유니크한 주문번호를 입력하세요)
				$payReqMap['LGD_BUYER']              = $order_name;					//구매자명
				$payReqMap['LGD_PRODUCTINFO']        = $show_goods_name;			//상품명
				$payReqMap['LGD_AMOUNT']             = $total_payment_price;					//결제금액("," 를 제외한 결제금액을 입력하세요)
				$payReqMap['LGD_BUYEREMAIL']         = $order_email;				//구매자 이메일
				$payReqMap['LGD_CUSTOM_SKIN']        = "SMART_XPAY2";                        //상점정의 결제창 스킨
				$payReqMap['LGD_CUSTOM_PROCESSTYPE'] = $LGD_CUSTOM_PROCESSTYPE;		// 트랜잭션 처리방식
				$payReqMap['LGD_TIMESTAMP']          = date(YmdHis);                         //타임스탬프
				$payReqMap['LGD_HASHDATA']           = $LGD_HASHDATA;				// MD5 해쉬암호값
				$payReqMap['LGD_RETURNURL']   		 = "http://store-chon.com/dev/order_complete.php";
				$payReqMap['LGD_VERSION']         	 = "PHP_Non-ActiveX_SmartXPay";	// 버전정보 (삭제하지 마세요)
				// $payReqMap['LGD_CUSTOM_FIRSTPAY']  	 = $_POST["LGD_CUSTOM_FIRSTPAY"];		//상점정의 초기결제수단
				// $payReqMap['LGD_PCVIEWYN']			 = $_POST["LGD_PCVIEWYN"];				//휴대폰번호 입력 화면 사용 여부(유심칩이 없는 단말기에서 입력-->유심칩이 있는 휴대폰에서 실제 결제)
				$payReqMap['LGD_CUSTOM_SWITCHINGTYPE']  = "SUBMIT";					// 신용카드 카드사 인증 페이지 연동 방식
				
				
				//iOS 연동시 필수
				$payReqMap['LGD_MPILOTTEAPPCARDWAPURL'] = "";
			  
				/*
				****************************************************
				* 신용카드 ISP(국민/BC)결제에만 적용 - BEGIN 
				****************************************************
				*/
				$payReqMap['LGD_KVPMISPWAPURL']		 	= "";	
				$payReqMap['LGD_KVPMISPCANCELURL']  	= "";
				
				/*
				****************************************************
				* 신용카드 ISP(국민/BC)결제에만 적용  - END
				****************************************************
				*/
					
				/*
				****************************************************
				* 계좌이체 결제에만 적용 - BEGIN 
				****************************************************
				*/
				$payReqMap['LGD_MTRANSFERWAPURL']		= "";	
				$payReqMap['LGD_MTRANSFERCANCELURL']  	= "";
				
				/*
				****************************************************
				* 계좌이체 결제에만 적용  - END
				****************************************************
				*/
				
				
				/*
				****************************************************
				* 모바일 OS별 ISP(국민/비씨), 계좌이체 결제 구분 값
				****************************************************
				- 안드로이드: A (디폴트)
				- iOS: N
				- iOS일 경우, 반드시 N으로 값을 수정
				*/
				$payReqMap['LGD_KVPMISPAUTOAPPYN']	= "A";		// 신용카드 결제 
				$payReqMap['LGD_MTRANSFERAUTOAPPYN']= "A";		// 계좌이체 결제
			
				// 가상계좌(무통장) 결제연동을 하시는 경우  할당/입금 결과를 통보받기 위해 반드시 LGD_CASNOTEURL 정보를 LG 유플러스에 전송해야 합니다 .
				$payReqMap['LGD_CASNOTEURL'] = "http://store-chon.com/PC/pay/cas_noteurl.php";               // 가상계좌 NOTEURL
			
				//Return URL에서 인증 결과 수신 시 셋팅될 파라미터 입니다.*/
				$payReqMap['LGD_RESPCODE']           = "";
				$payReqMap['LGD_RESPMSG']            = "";
				$payReqMap['LGD_PAYKEY']             = "";
				$payReqMap['LGD_ENCODING'] 						= "UTF-8";
				$payReqMap['LGD_ENCODING_NOTEURL'] 		= "UTF-8";
				$payReqMap['LGD_ENCODING_RETURNURL'] 		= "UTF-8";
			
				$_SESSION['PAYREQ_MAP'] = $payReqMap;
			
				// $innerHTML .= "<script language='javascript' src='http://xpay.uplus.co.kr/xpay/js/xpay_crossplatform.js' type='text/javascript'></script>";
				$innerHTML .= "<script type='text/javascript'>";
				$innerHTML .= "var LGD_window_type = '".$CST_WINDOW_TYPE."';";
				$innerHTML .= "";
				$innerHTML .= "function launchCrossPlatform(){lgdwin = open_paymentwindow(document.getElementById('LGD_PAYINFO'), 'test', LGD_window_type);}";
				$innerHTML .= "function getFormObject() {return document.getElementById('LGD_PAYINFO');}";
				$innerHTML .= "</script>";
				$innerHTML .= "<form method='post' name='LGD_PAYINFO' id='LGD_PAYINFO' action='http://www.store-chon.com/dev/order_complete.php'>";
				foreach ($payReqMap as $key => $value) {
					$innerHTML .= "<input type='hidden' name='$key' id='$key' value='$value'>";
				}
				$innerHTML .= "</form>";

			}else{
				$innerHTML	= "N";
			}

			echo $innerHTML;
		break;

		case "cancel_order_info" :
			/*
			 * [결제취소 요청 페이지]
			 *
			 * LG유플러스으로 부터 내려받은 거래번호(LGD_TID)를 가지고 취소 요청을 합니다.(파라미터 전달시 POST를 사용하세요)
			 * (승인시 LG유플러스으로 부터 내려받은 PAYKEY와 혼동하지 마세요.)
			 */
			$CST_PLATFORM               = $_POST["CST_PLATFORM"];       //LG유플러스 결제 서비스 선택(test:테스트, service:서비스)
			$CST_MID                    = $_POST["CST_MID"];            //상점아이디(LG유플러스으로 부터 발급받으신 상점아이디를 입력하세요)
																				 //테스트 아이디는 't'를 반드시 제외하고 입력하세요.
			$LGD_MID                    = (("test" == $CST_PLATFORM)?"t":"").$CST_MID;  //상점아이디(자동생성)
			$LGD_TID                	= $_POST["LGD_TID"];			 //LG유플러스으로 부터 내려받은 거래번호(LGD_TID)

			$LGD_OID					= $_POST["LGD_OID"];			//추가 파라미터, 주문번호로 주문내역 DB 수정하기 위함 *준우

			$configPath 				= $_SERVER['DOCUMENT_ROOT']."/lib/lg_payment_module_pc/lgdacom"; 						 //LG유플러스에서 제공한 환경파일("/conf/lgdacom.conf") 위치 지정.

			require_once($_SERVER['DOCUMENT_ROOT']."/lib/lg_payment_module_pc/lgdacom/XPayClient.php");
			$xpay = new XPayClient($configPath, $CST_PLATFORM);
			$xpay->Init_TX($LGD_MID);

			$xpay->Set("LGD_TXNAME", "Cancel");
			$xpay->Set("LGD_TID", $LGD_TID);

			/*
			 * 1. 결제취소 요청 결과처리
			 *
			 * 취소결과 리턴 파라미터는 연동메뉴얼을 참고하시기 바랍니다.
			 */
			if ($xpay->TX()) {
				//1)결제취소결과 화면처리(성공,실패 결과 처리를 하시기 바랍니다.)
				// echo "결제 취소요청이 완료되었습니다.  <br>";
				// echo "TX Response_code = " . $xpay->Response_Code() . "<br>";
				// echo "TX Response_msg = " . $xpay->Response_Msg() . "<p>";

				// DB 처리
				$cancel_query		= "UPDATE ".$_gl['order_info_table']." SET cancel_date='".date("Y-m-d H:i:s")."', order_status='order_cancel' WHERE order_oid='".$LGD_OID."'";
				$cancel_result		= mysqli_query($my_db, $cancel_query);

				if($cancel_result) {
					echo $xpay->Response_Code()."/".$xpay->Response_Msg();
				}

			}else {
				//2)API 요청 실패 화면처리
				echo "결제 취소요청이 실패하였습니다.  <br>";
				echo "TX Response_code = " . $xpay->Response_Code() . "<br>";
				echo "TX Response_msg = " . $xpay->Response_Msg() . "<p>";

				// echo "bbb";
				// echo json_encode($xpay->Response_Code(),$xpay->Response_Msg());
			}
		break;
	}
?>
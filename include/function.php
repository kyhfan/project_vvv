<?
/*
*
*	php function 
*
*/


// 상품 코드 테이블에서 새로운 상품코드 가져오기
function create_goodscode()
{
	global $_gl;
	global $my_db;

	$query		= "SELECT goods_code FROM ".$_gl['goodscode_info_table']." WHERE useYN='N' limit 1";
	$result		= mysqli_query($my_db, $query);
	$data			= mysqli_fetch_array($result);

	$query2		= "UPDATE ".$_gl['goodscode_info_table']." SET useYN='Y' WHERE goods_code='".$data['goods_code']."'";
	$result2		= mysqli_query($my_db, $query2);

	return $data['goods_code'];
}

// 해당 상품정보 가져오기 (goods_code)
function select_goods_info($goodscode)
{
	global $_gl;
	global $my_db;

	$query		= "SELECT * FROM ".$_gl['goods_info_table']." WHERE goods_code='".$goodscode."'";
	$result		= mysqli_query($my_db, $query);
	$data			= mysqli_fetch_array($result);

	return $data;
}

// 주문용 해당 상품정보 가져오기 (goods_code)
function select_order_goods_info($goodscode)
{
	global $_gl;
	global $my_db;

	$query		= "SELECT * FROM ".$_gl['goods_info_table']." WHERE goods_code='".$goodscode."'";
	$result		= mysqli_query($my_db, $query);
	while ($data = mysqli_fetch_array($result))
	{
		$res_data[]	= $data;
	}

	return $res_data;
}

// 해당 상품정보 가져오기 (idx)
function select_idx_goods_info($idx)
{
	global $_gl;
	global $my_db;

	$query		= "SELECT * FROM ".$_gl['goods_info_table']." WHERE idx='".$idx."'";
	$result		= mysqli_query($my_db, $query);
	$data			= mysqli_fetch_array($result);

	return $data;
}

// 해당 이벤트 가져오기 (idx)
function select_event_info($idx)
{
	global $_gl;
	global $my_db;

	$query		= "SELECT * FROM ".$_gl['event_info_table']." WHERE idx='".$idx."'";
	$result		= mysqli_query($my_db, $query);
	$data			= mysqli_fetch_array($result);

	return $data;
}

// 해당 포스트 가져오기 (idx)
function select_post_info($idx)
{
	global $_gl;
	global $my_db;

	$query		= "SELECT * FROM ".$_gl['post_info_table']." WHERE idx='".$idx."'";
	$result		= mysqli_query($my_db, $query);
	$data			= mysqli_fetch_array($result);

	return $data;
}

// 서브 카테고리 명 및 갯수 가져오기 (cate1)
function sub_category_info($cate1)
{
	global $_gl;
	global $my_db;

	$query		= "SELECT * FROM ".$_gl['category_info_table']." WHERE cate_1='".$cate1."' AND cate_2 <> '0' AND cate_pcYN='Y'";
	$result		= mysqli_query($my_db, $query);
	while ($data = mysqli_fetch_array($result))
	{
		$goods_query		= "SELECT * FROM ".$_gl['goods_info_table']." WHERE cate_1='".$cate1."' AND cate_2 = '".$data['cate_2']."' AND showYN='Y'";
		$goods_result		= mysqli_query($my_db, $goods_query);
		$goods_num			= mysqli_num_rows($goods_result);
		$res_data[]	= $cate1."||".$data['cate_2']."||".$data['cate_name']."||".$goods_num;
	}

	return $res_data;
}

// 해당 카테고리 정보 가져오기 (idx)
function select_category_info($idx)
{
	global $_gl;
	global $my_db;

	$query		= "SELECT * FROM ".$_gl['category_info_table']." WHERE idx='".$idx."'";
	$result		= mysqli_query($my_db, $query);
	$data			= mysqli_fetch_array($result);

	return $data;
}

// 해당 판매경로 정보 가져오기 (idx)
function select_sales_store_info($idx)
{
	global $_gl;
	global $my_db;

	$query		= "SELECT * FROM ".$_gl['sales_store_info_table']." WHERE idx='".$idx."'";
	$result		= mysqli_query($my_db, $query);
	$data			= mysqli_fetch_array($result);

	return $data;
}

function select_all_category_info($gubun)
{
	global $_gl;
	global $my_db;

	if ($gubun	== "main")
		$where	= " AND cate_2='0' AND cate_3='0'";
	$query		= "SELECT * FROM ".$_gl['category_info_table']." WHERE 1 ".$where."";
	$result		= mysqli_query($my_db, $query);
	while ($data = mysqli_fetch_array($result))
	{
		$res_data[]	= $data;
	}

	return $res_data;
}

function select_banner_info($type, $device)
{
	global $_gl;
	global $my_db;

	$query		= "SELECT * FROM ".$_gl['banner_info_table']." WHERE banner_type='".$type."' AND device_type='".$device."' AND banner_showYN='Y' ORDER BY banner_show_order ASC";
	$result		= mysqli_query($my_db, $query);
	while ($data = mysqli_fetch_array($result))
	{
		$res_data[]	= $data;
	}

	return $res_data;
}

// 메인 베스트 상품 리스트
function select_best_goods_info($goods_flag, $goods_num)
{
	global $_gl;
	global $my_db;

	if ($goods_flag == "auto")
	{
		if ($_SESSION['ss_chon_grade'] == "6")
			$query		= "SELECT * FROM ".$_gl['goods_info_table']." WHERE 1 ORDER BY goods_sales_cnt DESC limit ".$goods_num."";
		else
			$query		= "SELECT * FROM ".$_gl['goods_info_table']." WHERE 1 AND showYN='Y' ORDER BY goods_sales_cnt DESC limit ".$goods_num."";
		$result		= mysqli_query($my_db, $query);
	}else{
		if ($_SESSION['ss_chon_grade'] == "6")
			$query		= "SELECT * FROM ".$_gl['goods_info_table']." WHERE 1 AND goods_best_flag='Y' ORDER BY goods_sequence DESC";
		else
			$query		= "SELECT * FROM ".$_gl['goods_info_table']." WHERE 1 AND showYN='Y' AND goods_best_flag='Y' ORDER BY goods_sequence DESC";
		$result		= mysqli_query($my_db, $query);
	}

	while ($data = mysqli_fetch_array($result))
	{
		$res_data[]	= $data;
	}

	return $res_data;
}

// 메인 신 상품 리스트
function select_new_goods_info($goods_flag, $goods_num)
{
	global $_gl;
	global $my_db;

	if ($goods_flag == "auto")
	{
		if ($_SESSION['ss_chon_grade'] == "6")
			$query		= "SELECT * FROM ".$_gl['goods_info_table']." WHERE 1 ORDER BY goods_regdate DESC limit ".$goods_num."";
		else
			$query		= "SELECT * FROM ".$_gl['goods_info_table']." WHERE 1 AND showYN='Y' ORDER BY goods_regdate DESC limit ".$goods_num."";
		$result		= mysqli_query($my_db, $query);
	}else{
		if ($_SESSION['ss_chon_grade'] == "6")
			$query		= "SELECT * FROM ".$_gl['goods_info_table']." WHERE 1 AND goods_new_flag='Y' ORDER BY goods_sequence DESC";
		else
			$query		= "SELECT * FROM ".$_gl['goods_info_table']." WHERE 1 AND showYN='Y' AND goods_new_flag='Y' ORDER BY goods_sequence DESC";
		$result		= mysqli_query($my_db, $query);
	}

	while ($data = mysqli_fetch_array($result))
	{
		$res_data[]	= $data;
	}

	return $res_data;
}

// 메인 기획 상품 리스트
function select_plan_goods_info($goods_flag, $goods_num)
{
	global $_gl;
	global $my_db;

	if ($goods_flag == "auto")
	{
		if ($_SESSION['ss_chon_grade'] == "6")
			$query		= "SELECT * FROM ".$_gl['goods_info_table']." WHERE 1 ORDER BY goods_regdate DESC limit ".$goods_num."";
		else
			$query		= "SELECT * FROM ".$_gl['goods_info_table']." WHERE 1 AND showYN='Y' ORDER BY goods_regdate DESC limit ".$goods_num."";
		$result		= mysqli_query($my_db, $query);
	}else{
		if ($_SESSION['ss_chon_grade'] == "6")
			$query		= "SELECT * FROM ".$_gl['goods_info_table']." WHERE 1 AND goods_plan_flag='Y' ORDER BY goods_sequence DESC";
		else
			$query		= "SELECT * FROM ".$_gl['goods_info_table']." WHERE 1 AND showYN='Y' AND goods_plan_flag='Y' ORDER BY goods_sequence DESC";
		$result		= mysqli_query($my_db, $query);
	}

	while ($data = mysqli_fetch_array($result))
	{
		$res_data[]	= $data;
	}

	return $res_data;
}

// 카테고리별 베스트 상품 리스트
function select_cate_best_goods_info($cate_no, $goods_flag, $goods_num)
{
	global $_gl;
	global $my_db;

	if ($goods_flag == "auto")
	{
		if ($_SESSION['ss_chon_grade'] == "6")
			$query		= "SELECT * FROM ".$_gl['goods_info_table']." WHERE 1 AND cate_1='".$cate_no."' ORDER BY goods_sales_cnt DESC limit ".$goods_num."";
		else
			$query		= "SELECT * FROM ".$_gl['goods_info_table']." WHERE 1 AND showYN='Y' AND cate_1='".$cate_no."' ORDER BY goods_sales_cnt DESC limit ".$goods_num."";
		$result		= mysqli_query($my_db, $query);
	}else{
		if ($_SESSION['ss_chon_grade'] == "6")
			$query		= "SELECT * FROM ".$_gl['goods_info_table']." WHERE 1 AND cate_1='".$cate_no."' AND goods_cate_flag='Y' ORDER BY goods_sequence DESC";
		else
			$query		= "SELECT * FROM ".$_gl['goods_info_table']." WHERE 1 AND showYN='Y' AND cate_1='".$cate_no."' AND goods_cate_flag='Y' ORDER BY goods_sequence DESC";
		$result		= mysqli_query($my_db, $query);
	}

	while ($data = mysqli_fetch_array($result))
	{
		$res_data[]	= $data;
	}

	return $res_data;
}

// 사이트 기본 옵션 불러오기
function load_option()
{
	global $_gl;
	global $my_db;

	$query		= "SELECT * FROM ".$_gl['site_option_table']." WHERE option_load='Y'";
	$result		= mysqli_query($my_db, $query);
	while ($data = @mysqli_fetch_array($result))
	{
		$res_data[$data['option_name']]	= $data['option_value'];
	}

	return $res_data;

}

/*
* 메일발송 함수
* $EMAIL : 보내는 사람 메일 주소
* $NAME : 보내는 사람 이름
* $SUBJECT : 메일 제목
* $CONTENT : 메일 내용
* $MAILTO : 받는 사람 메일 주소
* $MAILTONAME : 받는 사람 이름 
*/
function sendMail($EMAIL, $NAME, $SUBJECT, $CONTENT, $MAILTO, $MAILTONAME){
	$mail             = new PHPMailer();
	$body             = $CONTENT;
/*
	$mail->IsSMTP(); // telling the class to use SMTP
	// $mail->Host 	  = "www.coolio.so"; // SMTP server
	$mail->SMTPDebug  = 0;						// enables SMTP debug information (for testing)
												// 1 = errors and messages
												// 2 = messages only
	$mail->CharSet    = "utf-8";
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
	$mail->Host       = "smtp.naver.com";      // sets GMAIL as the SMTP server
	$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
	$mail->Username   = "kyhfan";             // GMAIL username
	$mail->Password   = "dudfks88";              // GMAIL password

	$mail->SetFrom($EMAIL, $NAME);

	$mail->AddReplyTo($EMAIL, $NAME);

	$mail->Subject    = $SUBJECT;

	$mail->MsgHTML($body);

	$address = $MAILTO;
	$mail->AddAddress($address, $MAILTONAME);
*/
	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.worksmobile.com';  // Specify main and backup SMTP servers   
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'yh.kim@minivertising.kr';                 // SMTP username
	$mail->Password = '1234';                           // SMTP password
	// $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
	// $mail->Port = 465;                                    // TCP port to connect to
	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                                    // TCP port to connect to
	
	$mail->CharSet    = "utf-8";
	$mail->setFrom($EMAIL, $NAME);
	$mail->addAddress($MAILTO, $NAME);     // Add a recipient

	// $mail->From = "yh.kim@minivertising.kr";
	// $mail->FromName = "촌의감각";
	// $mail->addAddress('yh.kim@minivertising.kr');               // Name is optional
	// $mail->addReplyTo($EMAIL, $NAME);
	// $mail->addCC('cc@example.com');
	// $mail->addBCC('bcc@example.com');
	
	// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	$mail->isHTML(true);                                  // Set email format to HTML
	
	$mail->Subject = $SUBJECT;
	$mail->Body    = $body;
	// $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	
	if(!$mail->send()) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		echo 'Message has been sent';
	}
	// $mail->Send();
}

// 해당 거래처 정보 가져오기 (idx)
function select_purchasing_info($idx)
{
	global $_gl;
	global $my_db;

	$query		= "SELECT * FROM ".$_gl['purchasing_info_table']." WHERE idx='".$idx."'";
	$result		= mysqli_query($my_db, $query);
	$data		= mysqli_fetch_array($result);

	return $data;
}

// 회원 정보 가져오기 (SESSION)
function select_member_info()
{
	global $_gl;
	global $my_db;

	$query		= "SELECT * FROM ".$_gl['member_info_table']." WHERE mb_email='".$_SESSION['ss_chon_email']."'";
	$result		= mysqli_query($my_db, $query);
	$data		= mysqli_fetch_array($result);

	return $data;
}

// 쇼핑몰 기본 설정 가져오기
function select_shop_config_info()
{
	global $_gl;
	global $my_db;

	$query		= "SELECT * FROM ".$_gl['site_option_table']." WHERE 1";
	$result		= mysqli_query($my_db, $query);
	while ($data = @mysqli_fetch_array($result))
	{
		$res_data[$data['option_name']][]	= $data['option_value'];
		$res_data[$data['option_name']][]	= $data['option_load'];
	}

	return $res_data;
}

function create_cartid()
{
	$randcode = md5( mktime() . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT'] ); ;

	return $randcode; // 난수 생성
}

// 카테고리1 이름 가져오기
function select_cate1_info($cate_1)
{
	global $_gl;
	global $my_db;

	$query		= "SELECT cate_name FROM ".$_gl['category_info_table']." WHERE cate_1='".$cate_1."' AND cate_2=0 AND cate_3=0";
	$result		= mysqli_query($my_db, $query);
	$data			= mysqli_fetch_array($result);

	return $data['cate_name'];
}

// 카테고리2 이름 가져오기
function select_cate2_info($cate_1, $cate_2)
{
	global $_gl;
	global $my_db;

	$query		= "SELECT cate_name FROM ".$_gl['category_info_table']." WHERE cate_1='".$cate_1."' AND cate_2='".$cate_2."' AND cate_3=0";
	$result		= mysqli_query($my_db, $query);
	$data			= mysqli_fetch_array($result);

	return $data['cate_name'];
}

// 판매경로 이름 가져오기
function sales_store_name($idx)
{
	global $_gl;
	global $my_db;

	$query		= "SELECT sales_store_name FROM ".$_gl['sales_store_info_table']." WHERE idx='".$idx."'";
	$result		= mysqli_query($my_db, $query);
	$data			= mysqli_fetch_array($result);

	return $data['sales_store_name'];
}

function select_order_goods($ordertype)
{
	global $_gl;
	global $my_db;

	if ($ordertype == "cart")
	{
		if ($_SESSION['ss_chon_id'])
			$order_id	= $_SESSION['ss_chon_id'];
		else
			$order_id	= $_SESSION['ss_chon_cartid'];

		$order_query		= "SELECT * FROM ".$_gl['mycart_info_table']." WHERE cart_regdate >= date_add(now(), interval -3 day) AND mb_id='".$order_id."' AND showYN='Y'";
		$order_result		= mysqli_query($my_db, $order_query);
		while ($order_data = mysqli_fetch_array($order_result))
		{
			$res_data[]	= $order_data;
		}
	}
	return $res_data;
}

// function select_order_info($oid)
// {
// 	global $_gl;
// 	global $my_db;

// 	$order_query		= "SELECT * FROM ".$_gl['order_info_table']." WHERE order_oid='".$oid."'";
// 	$order_result		= mysqli_query($my_db, $order_query);
// 	$order_data			= mysqli_fetch_array($order_result);

// 	return $order_data;
// }

function select_order_info($oid)
{
	global $_gl;
	global $my_db;

	$order_query		= "SELECT * FROM ".$_gl['order_info_table']." WHERE order_oid='".$oid."'";
	$order_result		= mysqli_query($my_db, $order_query);
	$order_data			= mysqli_fetch_array($order_result);

	$order_goods_arr1 	= explode(",",$order_data["order_goods"]);
	$order_goods_arr2	= array_values(array_filter(array_map('trim',$order_goods_arr1)));

	$i = 0;
	foreach($order_goods_arr2 as $key => $val)
	{
		$order_goods_arr3 	= explode("||",$val);
		$goods_query		= "SELECT * FROM ".$_gl['goods_info_table']." WHERE 1 AND goods_code='".$order_goods_arr3[0]."'";
		$goods_result		= mysqli_query($my_db, $goods_query);
		$goods_data[$i]			= mysqli_fetch_array($goods_result);
		$goods_data[$i]['order_cnt']	= $order_goods_arr3[1];
		
		$order_data['order_goods']	= $goods_data;
		$i++;
	}

	return $order_data;
}

function select_order_list_info()
{
	global $_gl;
	global $my_db;

	$order_query		= "SELECT * FROM ".$_gl['order_info_table']." WHERE order_email='".$_SESSION['ss_chon_email']."' AND order_status <> 'pay_error'";
	$order_result		= mysqli_query($my_db, $order_query);
	// $order_num			= mysqli_num_rows($order_result);
// print_r($order_num);
	while($order_data = mysqli_fetch_array($order_result))
	{

		// $res_data[] 	= $order_data;
		$order_goods_arr1 	= explode(",",$order_data["order_goods"]);
		$order_goods_arr2	= array_values(array_filter(array_map('trim',$order_goods_arr1)));
	
		$i = 0;
		foreach($order_goods_arr2 as $key => $val)
		{
			$order_goods_arr3 	= explode("||",$val);
			$goods_query		= "SELECT * FROM ".$_gl['goods_info_table']." WHERE 1 AND goods_code='".$order_goods_arr3[0]."'";
			$goods_result		= mysqli_query($my_db, $goods_query);
			$goods_data[$i]			= mysqli_fetch_array($goods_result);
			$goods_data[$i]['order_cnt']	= $order_goods_arr3[1];
			
			$order_data['order_goods']	= $goods_data;
			$i++;
		}
		$res_data[] 	= $order_data;
	}
	
	return $res_data;
}

function select_promotion_info($idx)
{
	global $_gl;
	global $my_db;

	$promotion_query		= "SELECT * FROM ".$_gl['promotion_info_table']." WHERE idx='".$idx."'";
	$promotion_result		= mysqli_query($my_db, $promotion_query);
	$promotion_data			= mysqli_fetch_array($promotion_result);

	return $promotion_data;
}

function select_payment_info($oid)
{
	global $_gl;
	global $my_db;

	$payment_query		= "SELECT * FROM ".$_gl['payment_info_table']." WHERE LGD_OID='".$oid."'";
	$payment_result		= mysqli_query($my_db, $payment_query);
	$payment_data		= mysqli_fetch_array($payment_result);

	return $payment_data;
}

function select_oto_info($idx)
{
	global $_gl;
	global $my_db;

	$oto_query		= "SELECT * FROM ".$_gl['board_oto_table']." WHERE idx='".$idx."' AND oto_email='".$_SESSION['ss_chon_email']."'";
	$oto_result		= mysqli_query($my_db, $oto_query);
	$oto_data		= mysqli_fetch_array($oto_result);

	return $oto_data;

}

function select_cart_info()
{
	global $_gl;
	global $my_db;

	$mb_id			= $_SESSION['ss_chon_email'];

	$cart_query		= "SELECT * FROM ".$_gl['mycart_info_table']." WHERE mb_email='".$mb_id."' AND showYN='Y' AND cart_regdate >=(CURDATE()-INTERVAL 3 DAY);";
	$cart_result	= mysqli_query($my_db, $cart_query);
	// $cart_data		= mysqli_fetch_array($cart_result);
	while ($cart_data = @mysqli_fetch_array($cart_result))
	{
		$res_data[]	= $cart_data;
	}

	return $res_data;
}

function select_order_cart_info()
{
	global $_gl;
	global $my_db;

	$mb_id			= $_SESSION['ss_chon_email'];

	$cart_query		= "SELECT * FROM ".$_gl['mycart_info_table']." WHERE mb_email='".$mb_id."' AND showYN='Y' AND cart_regdate >=(CURDATE()-INTERVAL 3 DAY);";
	$cart_result	= mysqli_query($my_db, $cart_query);
	// $cart_data		= mysqli_fetch_array($cart_result);

	$total_order_price 	= 0;
	$total_order_cnt	= 0;
	$i 					= 0;
	while ($cart_data = @mysqli_fetch_array($cart_result))
	{
		$goods_info 							= select_goods_info($cart_data['goods_code']);
		$res_data[$i]							= $cart_data;
		$res_data[$i]["goods_thumb_img_url"]	= $goods_info["goods_thumb_img_url"];
		$res_data[$i]["goods_name"]				= $goods_info["goods_name"];
		$res_data[$i]["discount_price"]			= $goods_info["discount_price"];
		$total_order_price						+= $goods_info["discount_price"] * $cart_data["goods_cnt"];
		$total_order_cnt						+= $cart_data["goods_cnt"];
		$i++;
	}
	$res_data[0]["total_order_price"]	= $total_order_price;
	$res_data[0]["total_order_cnt"]		= $total_order_cnt;
	
	return $res_data;
}

function check_wish_goods($goods_code)
{
	global $_gl;
	global $my_db;

	$mb_id			= $_SESSION['ss_chon_email'];
	
	$wish_query 	= "SELECT * FROM ".$_gl['wishlist_info_table']." WHERE mb_id='".$mb_id."' AND goods_code='".$goods_code."' AND showYN='Y'";
	$wish_result 	= mysqli_query($my_db, $wish_query);
	$wish_data		= mysqli_fetch_array($wish_result);

	if ($wish_data)
		$flag 	= "Y";
	else
		$flag 	= "N";

	return $flag;
}

function select_wish_info()
{
	global $_gl;
	global $my_db;

	$mb_id			= $_SESSION['ss_chon_email'];

	$wish_query		= "SELECT * FROM ".$_gl['wishlist_info_table']." WHERE mb_id='".$mb_id."' AND showYN='Y'";
	$wish_result	= mysqli_query($my_db, $wish_query);

	while ($wish_data = @mysqli_fetch_array($wish_result))
	{
		$res_data[]	= $wish_data;
	}

	return $res_data;
}

function create_oid()
{
	global $_gl;
	global $my_db;

	$oid = PHPRandom::getInteger(10000000, 99999999);

	$order_query 	= "SELECT * FROM ".$_gl['order_info_table']." WHERE order_oid='".$oid."'";
	$order_result 	= mysqli_query($my_db, $order_query);
	$order_num		= mysqli_num_rows($order_result);

	if ($order_num > 0)
		create_oid();

	return $oid;
}

function verify_member($email)
{
	global $_gl;
	global $my_db;

	$member_query 	= "UPDATE ".$_gl['member_info_table']." SET mb_verify='Y' WHERE mb_email='".$email."'";
	$member_result 	= mysqli_query($my_db, $member_query);

}

function change_mail($o_mail, $c_mail)
{
	global $_gl;
	global $my_db;
	
	$change_query 	= "SELECT * FROM ".$_gl['member_info_table']." WHERE mb_email='".$o_mail."'";
	$change_result 	= mysqli_query($my_db, $change_query);
	$change_num		= mysqli_num_rows($change_result);

	if ($change_num > 0)
	{
		$change_query2 	= "SELECT * FROM ".$_gl['member_info_table']." WHERE mb_email='".$c_mail."'";
		$change_result2 	= mysqli_query($my_db, $change_query2);
		$change_num2		= mysqli_num_rows($change_result2);
		
		if ($change_num2 > 0)
		{
			$flag	= "D";
		}else{
			$change_query3 		= "UPDATE ".$_gl['member_info_table']." SET mb_email='".$c_mail."' WHERE mb_email='".$o_mail."'";
			$change_result3 	= mysqli_query($my_db, $change_query3);				

			if ($change_result3)
				$flag	= "Y";
			else
				$flag	= "N";
		}
	}

	return $flag;
}
?>
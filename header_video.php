<?
	include_once "./config.php";

	$v 		= $_REQUEST["v"];
	if ($v != "")
	{
		$video_query		= "SELECT * FROM ".$_gl['video_info_table']." WHERE idx='".$v."'";
		$video_result		= mysqli_query($my_db, $video_query);
		$video_data			= mysqli_fetch_array($video_result);
	}
?>
<!DOCTYPE html>
<html lang="ko">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<meta property="og:type" content="website" />
		<meta property="og:title" content="<?=$video_data["video_title"]?>">
		<meta property="og:url" content="http://valuable-viral-video.com/video_detail.php?idx=<?=$v?>" />
		<meta property="og:image" content="https://img.youtube.com/vi/<?=$v?>/hqdefault.jpg" />
		<meta property="og:description" content="<?=$video_data["video_desc"]?>">
		<title>VVV</title>
		<!-- 폰트 -->
		<!-- <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet"> -->
		<link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/moonspam/NanumSquare/master/nanumsquare.css">
		<!-- 합쳐지고 최소화된 최신 CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
		<!-- 부가적인 테마 -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
		<!-- 작업파일 -->
		<link rel="stylesheet" href="./css/style.css">
	</head>

<?
	include_once "./header.php";

	$idx	= $_REQUEST["idx"];
	// 영상정보(idx)
	$query		= "SELECT * FROM ".$_gl['video_info_table']." WHERE idx=".$idx;
	$result		= mysqli_query($my_db, $query);
	$data		= mysqli_fetch_array($result);
	
	$yt_flag 	= explode("v=",$data["video_link"]);	
	
?>
	<body>
		<div id="vvv" class="">
			<div class="bg-layer main">
				<div class="container">
					<div class="desktop-layout big"></div>
<?
	include_once "./head_area.php";
?>				
					<div class="content member">
						<iframe allowfullscreen="1" src="https://www.youtube.com/embed/<?=$yt_flag[1]?>" frameborder="0" id="ytplayer" class="ytplayer" width="200" height="200"></iframe>
						[<?=$data["video_company"]?>] <?=$data["video_title"]?><br />
						▶<?=number_format($data["play_count"])?><br />
						♥<?=number_format($data["like_count"])?><br />
						<a href="#">fb</a>
						<a href="#">ks</a>
						<a href="#">kt</a>
						<a href="javascript:void(0)" onclick="like_video('<?=$idx?>')" id="like_img">like</a>
					</div>
<?
	include_once "./search_area.php";
	include_once "./footer.php";
?>
				</div>
			</div>
		</div>
		<!-- 합쳐지고 최소화된 최신 자바스크립트 -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="./js/TweenMax.js"></script>
<?
	if ($gubun == "MOBILE")
	{
?>		
		<script type="text/javascript" src="./js/m_main.js"></script>
<?
	}else{
?>		
		<script type="text/javascript" src="./js/main.js"></script>
<?
	}
?>
	</body>
</html>

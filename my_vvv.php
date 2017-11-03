<?
	include_once "./header.php";

	if (!$_SESSION['ss_vvv_email'])
		echo "<script>location.href='login.php';</script>";


	$my_query		= "SELECT * FROM ".$_gl['like_info_table']." WHERE mb_email='".$_SESSION['ss_vvv_email']."' AND like_flag='Y'";
	$my_result		= mysqli_query($my_db, $my_query);
	$my_count		= mysqli_num_rows($my_result);

?>
	<body>
		<div id="vvv" class="">
			<div class="bg-layer main">
				<div class="container">
					<div class="desktop-layout big"></div>
<?
	include_once "./head_area.php";
?>				
					<div class="content myVVV">
						<div class="wrapper">
							<div class="rs-text">
								<p>
									<span class="ellipse"></span>
									<span class="name"><?=$_SESSION['ss_vvv_name']?></span>님 반갑습니다
								</p>
							</div>
							<div class="sorting">
								<!-- <a href="javascript:void(0)" class="active">
									<span>UPLOAD</span>
									<span class="count">(10)</span>
								</a> -->
								<a href="javascript:void(0)">
									<span>LIKE</span>
									<span class="count">(<?=$my_count?>)</span>
								</a>
							</div>
							<div class="grid">
								<div class="row">
<?
	while ($data = mysqli_fetch_array($my_result))
	{
		print_r($data);
		$yt_flag 	= explode("v=",$data["video_link"]);	
?>									
									<div class="d-col-3 m-col-1 t-col-2">
										<figure>
											<a href="video_detail.php?idx=<?=$data["idx"]?>">
												<div class="thum">
													<div class="thumnail-img" style="background-image:url(https://img.youtube.com/vi/<?=$yt_flag[1]?>/hqdefault.jpg);"></div>
												</div>
												<figcaption>
													<p>
														<span class="brand-name">
															[<?=$data["video_company"]?>]
														</span>
														<!-- <span class="desc">
															데님 팬츠, 어떻게 입을까.
														</span> -->
													</p>
													<span class="publisher">
														<?=mb_strimwidth($data["video_title"],0,40, '...', 'utf-8')?>
													</span>
													<div class="other">
														<div class="play">
															<span>▶</span>
															<span><?=number_format($data["play_count"])?></span>
														</div>
														<div class="like">
															<span>♥</span>
															<span><?=number_format($data["like_count"])?></span>
														</div>
													</div>
												</figcaption>
											</a>
										</figure>
									</div>
<?
	}
?>									
								</div>
							</div>
							<div class="more-cnt">
								<a href="javascript:void(0)">
									<span class="blind">more</span>
								</a>
							</div>
						</div>
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
		<script type="text/javascript">
		var $vvv = $('#vvv');
		var $header = $('#header');
		$(window).on('scroll', function() {
			var $headerHeight = document.getElementById('header').height || $header.height();
			var currentScroll = $(this).scrollTop();
			if(currentScroll > 254 && !$vvv.hasClass('menu-opened')) {
				$vvv.addClass('scrolled');
				// TweenMax.to($('.gnb-foot'), 0.3, {autoAlpha: 1});
			} else {
				$vvv.removeClass('scrolled');
				// TweenMax.to($('.gnb-foot'), 0.3, {autoAlpha: 0});
			}
			// if(currentScroll > ($app.height()/3)) {
			// 	$('.go-top').css({
			// 		opacity: 1
			// 	});
			// } else {
			// 	$('.go-top').css({
			// 		opacity: 0
			// 	});
			// }
			// (currentScroll > $header.height()) ? $headerBg.addClass('scrolled') : $headerBg.remove

		});

		// mobile search action
		function actionSearch() {
			if($vvv.hasClass('searchOpen')) {
				TweenMax.to($('.box-search'), 0.3, {autoAlpha: 0});
				$vvv.removeClass('searchOpen');
			}else{
				TweenMax.to($('.box-search'), 0.3, {autoAlpha: 1});
				$vvv.addClass('searchOpen');
			}
		}
		</script>
	</body>
</html>

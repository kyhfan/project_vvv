<?
	include_once "./header.php";
?>
	<body>
		<div id="vvv" class="">
			<div class="bg-layer main">
				<div class="container">
					<div class="desktop-layout big"></div>
<?
	include_once "./head_area.php";
?>				
					<div class="content main">
						<div class="wrapper">
							<div class="banner big mobile-layout">
								<div class="slide">
									<a href="javascript:void(0)">
										<img src="./images/main_banner_m.jpg">
									</a>
								</div>
							</div>
							<div class="banner big desktop-layout">
								<div class="slide">
									<a href="javascript:void(0)">
										<img src="./images/main_banner_pc.jpg">
									</a>
								</div>
							</div>
							<div class="sorting">
								<a href="javascript:void(0)" class="active" data-value="new">
									<span>NEW</span>
								</a>
								<a href="javascript:void(0)" data-value="best">
									<span>BEST</span>
								</a>
							</div>
							<div class="grid">
								<div class="row" id="main_area">
<?
	$view_pg            = 6;
	$s_page				= 0;
	// 전체 상품 갯수
	$query				= "SELECT * FROM ".$_gl['video_info_table']." WHERE showYN='Y'";
	$result				= mysqli_query($my_db, $query);
	$total_video_num	= mysqli_num_rows($result);
 	$total_page			= ceil($total_video_num / $view_pg);

	$query		= "SELECT * FROM ".$_gl['video_info_table']." WHERE showYN='Y' ORDER BY idx DESC LIMIT ".$s_page.", ".$view_pg."";
	$result		= mysqli_query($my_db, $query);
	$i = 0;
	while ($data = mysqli_fetch_array($result))
	{
		$yt_flag 	= explode("v=",$data["video_link"]);	
?>									
									<div class="d-col-3 m-col-1 t-col-2">
										<figure>
											<a href="javascript:void(0)">
												<div class="thum">
													<div class="thumnail-img" style="background-image:url(https://img.youtube.com/vi/<?=$yt_flag[1]?>/hqdefault.jpg);"></div>
													<!-- <img src="./images/grid_sample.jpg"> -->
													<!-- <span class="total-time">0:34</span> -->
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
<input type="hidden" id="total_video_num" value="<?=$total_video_num?>">				
<input type="hidden" id="total_page" value="<?=$total_page?>">				
								</div>
							</div>
							<div class="more-cnt" id="main_more">
								<a href="javascript:void(0)" onclick="more_video()">
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
		<script type="text/javascript" src="./js/main.js"></script>
	</body>
</html>

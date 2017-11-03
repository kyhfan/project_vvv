<?
	include_once "./header.php";
?>
	<body>
		<div id="vvv" class="">
			<div class="bg-layer main">
				<div class="container">
					<div class="layout-desktop"></div>
					<div id="header">
						<div class="inner clearfix">
							<div class="logo">
								<a href="javascript:void(0)">
									<img src="./images/vvv_logo.png" alt="홈으로">
								</a>
							</div>
							<div class="nav">
								<ul class="clearfix">
									<li>
										<a href="javascript:void(0)">
											<span>LOGIN</span>
										</a>
									</li>
									<li>
										<a href="javascript:void(0)">
											<span>MY VVV</span>
											<!-- <span></span> -->
										</a>
									</li>
								</ul>
								<div class="search-desktop">
									<div class="input-box">
										<input type="text" placeholder="Search" onKeyUp="search_video(this)" >
										<button>
											<span class="blind">검색</span>
											<span class="icon-search"></span>
										</button>
									</div>
								</div>
								<div class="search-mobile">
									<button onclick="actionSearch();">
										<span class="blind">검색</span>
										<span class="icon-search"></span>
									</button>
								</div>
							</div>
						</div>
						<div class="box-search">
							<div class="wrapper clearfix">
								<div class="input-box">
									<div class="inner">
										<input type="text" placeholder="Search">
									</div>
								</div>
								<div class="close-box">
									<button onclick="actionSearch();">
										<span class="blind">닫기</span>
										<span class="icon-close"></span>
									</button>
								</div>
							</div>
						</div>
					</div>
					<div class="content">
						<div class="wrapper">
							<div class="banner big mobile">
								<div class="slide">
									<a href="javascript:void(0)">
										<img src="./images/main_banner_m.jpg">
									</a>
								</div>
							</div>
							<div class="banner big desktop">
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
								<div class="row" id="search_area">
<?
	$view_pg            = 6;
	$s_page				= 0;
	// 전체 상품 갯수
	$query				= "SELECT * FROM ".$_gl['video_info_table']." WHERE showYN='Y'";
	$result				= mysqli_query($my_db, $query);
	$total_video_num	= mysqli_num_rows($result);
 	$total_page			= ceil($total_video_num / $view_pg);

	$query		= "SELECT * FROM ".$_gl['video_info_table']." WHERE showYN='Y' LIMIT ".$s_page.", ".$view_pg."";
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
													<img src="https://img.youtube.com/vi/<?=$yt_flag[1]?>/mqdefault.jpg">
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
					<div class="search-result">
						<div class="wrapper">
							<div class="rs-text">
								<p>
									<span class="ellipse"></span>
									"<span></span>" 에 대한 <span>1</span>개의 검색결과
								</p>
							</div>
							<div class="grid">
								<div class="row">
									<div class="d-col-3 m-col-1 t-col-2">
										<figure>
											<a href="javascript:void(0)">
												<div class="thum">
													<img src="./images/grid_sample.jpg">
													<span class="total-time">0:34</span>
												</div>
												<figcaption>
													<p>
														<span class="brand-name">
															[Marieclairekorea]
														</span>
														<span class="desc">
															데님 팬츠, 어떻게 입을까.
														</span>
													</p>
													<span class="publisher">
														마리끌레르
													</span>
													<div class="other">
														<div class="play">
															<span>▶</span>
															<span>1,002</span>
														</div>
														<div class="like">
															<span>♥</span>
															<span>50</span>
														</div>
													</div>
												</figcaption>
											</a>
										</figure>
									</div>
							<div class="more-cnt">
								<a href="javascript:void(0)">
									<span class="blind">more</span>
								</a>
							</div>
						</div>
					</div>
<?
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
		var $vvv 		= $('#vvv');
		var $header 	= $('#header');
		var sort_val 	= "new";
		var video_pg 	= 0;
		var total_video_num 	= $("#total_video_num").val();
		var total_page 			= $("#total_page").val();

		$(window).on('scroll', function() {
			var $headerHeight = document.getElementById('header').height || $header.height();
			var currentScroll = $(this).scrollTop();
			if(currentScroll > 254 && !$vvv.hasClass('menu-opened')) {
				$vvv.addClass('scrolled');
			} else {
				$vvv.removeClass('scrolled');
			}
			console.log(currentScroll);
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

		function more_video(total_video_num, total_page)
		{
			video_pg = video_pg + 6;

			$.ajax({
				type   : "POST",
				async  : false,
				url    : "./ajax_video.php",
				data:{
					"video_pg"				: video_pg,
					"total_video_num"		: total_video_num,
					"total_page"			: total_page,
					"sort_val"				: sort_val
				},
				success: function(response){
					if (video_pg > <?=$total_page?>)
						$("#main_more").hide();
					else
						$("#main_more").show();
					$("#search_area").append(response);
				}
			});
		}

		// 상품 리스트 소팅 클릭
		$(document).on("click", ".sorting > a", function(){
			if ($(this).hasClass("active") === false)
			{
				$(".sorting > a").removeClass("active");
				$(this).addClass("active");
				sort_val 	= $(this).attr("data-value");
				sort_area(sort_val);
			}

		});
		
		function sort_area(val)
		{
			video_pg 	= 0;
			$.ajax({
				type   : "POST",
				async  : false,
				url    : "./ajax_video.php",
				data:{
					"video_pg"				: video_pg,
					"total_video_num"		: total_video_num,
					"total_page"			: total_page,
					"sort_val"				: val
				},
				success: function(response){
					if (video_pg > <?=$total_page?>)
						$("#main_more").hide();
					else
						$("#main_more").show();
					$("#search_area").html(response);
				}
			});
			
		}

		function search_video(obj)
		{
			if(window.event.keyCode == 13)
			{
				console.log(obj.value);
				$(".search-result").show();
			}
			
		}
		</script>
	</body>
</html>

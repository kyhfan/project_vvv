<?
	include_once "./header_video.php";

	$idx = $_REQUEST["idx"];
?>
	<body>
		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NH7CPGH"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->
		<div id="vvv" class="">
			<div class="bg-layer main">
				<div class="container">
					<div class="desktop-layout big"></div>
<?
	include_once "./head_area.php";
?>				
					<div class="content detail">
						<div class="wrapper">
							<div class="video main">
								<div class="inner">
									<figure>
										<div class="vid-layer"  id="video_area">
											<img src="./images/loading.jpg">
										</div>
										</a>
										<figcaption>
											<p>
												<span class="brand-name">
													[<?=$data["video_company"]?>]
												</span>
												<span class="desc">
													<?=$data["video_title"]?>
												</span>
											</p>
											<!-- <span class="publisher">
												마리끌레르
											</span> -->
											<div class="other">
												<div class="play">
													<span>▶</span>
													<span id="view_count"><?=number_format($data["play_count"])?></span>
												</div>
												<div class="like">
													<span>♥</span>
													<span id="like_count"><?=number_format($data["like_count"])?></span>
												</div>
											</div>
											<div class="action-group">
												<div class="icon share">
													<button type="button" onclick="alert('작업예정!')">
														<span class="blind">공유하기</span>
													</button>
												</div>
<?
	$like_query		= "SELECT * FROM ".$_gl['like_info_table']." WHERE mb_email='".$_SESSION['ss_vvv_email']."' AND v_idx='".$idx."' AND like_flag='Y'";
	$like_result	= mysqli_query($my_db, $like_query);
	$like_count		= mysqli_num_rows($like_result);
	
	if ($_SESSION['ss_vvv_email'])
	{
		if ($like_count > 0)
		{
?>						
												<div class="icon liked">
<?
		}else{
?>		
												<div class="icon like">
<?
		}
?>				
													<button type="button" onclick="like_video('<?=$idx?>')" id="like_img">
														<span class="blind">좋아요</span>
													</button>
												</div>
<?
	}else{
?>		
												<div class="icon like">
													<button type="button" onclick="alert('로그인 후 이용해 주세요.');location.href='login.php?refurl=video_detail.php?idx=<?=$idx?>';" id="like_img">
														<span class="blind">좋아요</span>
													</button>
												</div>
<?
	}
?>										
											</div>
										</figcaption>
									</figure>
								</div>
							</div>
							<div class="divide-block vw"></div>
<?
	$related_query		= "SELECT * FROM ".$_gl['video_info_table']." WHERE video_company='".$data["video_company"]."' AND idx NOT IN ('".$data["idx"]."') ORDER BY like_count DESC LIMIT 4";
	$related_result		= mysqli_query($my_db, $related_query);
	$related_count 		= mysqli_num_rows($related_result);
	if ($related_count > 0)
	{
?>							
							<div class="grid related">
								<h5 class="tt">관련 영상</h5>
								<div class="row">
<?
		while ($related_data = mysqli_fetch_array($related_result))
		{
?>									
									<div class="d-col-4 m-col-1">
										<figure>
											<a href="javascript:void(0)" class="clearfix">
												<div class="thum">
													<div class="thumnail-img" style="background-image:url(./images/grid_sample.jpg);"></div>
													<span class="total-time">0:34</span>
												</div>
												<figcaption>
													<p>
														<span class="brand-name">
															[<?=$related_data["video_company"]?>]
														</span>
														<span class="desc">
															<?=$related_data["video_title"]?>
														</span>
													</p>
													<!-- <span class="publisher">
														마리끌레르
													</span> -->
													<div class="other">
														<div class="play">
															<span>▶</span>
															<span><?=number_format($related_data["play_count"])?></span>
														</div>
														<div class="like">
															<span>♥</span>
															<span><?=number_format($related_data["like_count"])?></span>
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
<?
	}
?>							
							<div class="rep-area">
								<h5 class="tt">
									댓글
								</h5>
								<div class="input-group">
									<input type="text" placeholder="댓글을 입력해 주세요" id="comment_text">
<?
	if ($_SESSION['ss_vvv_email'])
	{
?>									
									<button type="button" onclick="ins_comment('<?=$data['idx']?>')">
<?
	}else{
?>		
									<button type="button" onclick="alert('로그인 후 이용해 주세요.');location.href='login.php?refurl=video_detail.php?idx=<?=$idx?>';">
<?
	}
?>							
										<span>등록</span>
									</button>
								</div>
								<div class="rep-list">
									<ul>
<?
	$comment_query		= "SELECT * FROM ".$_gl['comment_info_table']." WHERE v_idx='".$idx."' ORDER BY idx DESC";
	$comment_result		= mysqli_query($my_db, $comment_query);

	while ($comment_data = mysqli_fetch_array($comment_result))
	{
?>										
										<li>
											<span class="name">
												<a href="my_vvv.php?email=<?=$comment_data["mb_email"]?>"><?=$comment_data["mb_name"]?></a>
											</span>
											<span class="msg">
												<?=$comment_data["comment_text"]?>
											</span>
											<a href="javascript:void(0)" class="report">
												신고
											</a>
										</li>
<?
	}
?>										
									</ul>
								</div>
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
	<script type="text/javascript">
	// 유튜브 api 재생 클릭시 이벤트 설정
    var tag = document.createElement('script');

    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

	var player;
	
	if ($(window).width() < 1040)
	{
		var yt_width = $(window).width();
		var yt_height = ($(window).width()*9)/16;
	}else{
		var yt_width = '1040';
		var yt_height = '582';
	}		

	function onYouTubeIframeAPIReady() {
		player = new YT.Player('video_area', {
        	height: yt_width,
        	width: yt_width,
        	videoId: '<?=$yt_flag[1]?>',
        	events: {
            	// 'onReady': onPlayerReady,
            	'onStateChange': onPlayerStateChange
          	}
        });
	}

	var play_flag = 0;
    function onPlayerStateChange(event) {
		if (event.data == 1)
		{
			if (play_flag == 0)
			{
				$.ajax({
					type   : "POST",
					async  : false,
					url    : "./main_exec.php",
					data:{
						"exec"				    : "view_video",
						"v_idx"		            : "<?=$idx?>"
					},
					success: function(response){
						if (response.match("Y") == "Y")
						{
							$("#view_count").html(Number($("#view_count").html()) + 1);
						}
					}
				});
			}			
		}else if (event.data == 2){
			play_flag = 1;
		}
    }

    function sns_share(media, flag)
    {
        if (media == "fb")
        {
    
            var newWindow = window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent('http://www.valuable-viral-video.com/video_detail.php?idx=<?=$idx?>'),'sharer','toolbar=0,status=0,width=600,height=325');
            $.ajax({
                type   : "POST",
                async  : false,
                url    : "./main_exec.php",
                data:{
                    "exec"      : "insert_share_info",
                    "sns_media" : media,
                    "sns_flag"	: flag
                }
            });
        }else{
            Kakao.Link.sendTalkLink({
            label: "|도|미|노|챌|린|지|\r\n\r\n무너지지 않는 도미노를 발견하면 핸드폰을 흔들어주세요!\r\n\r\n도미노야 어디한번 해보자!\r\n니가 무너지나 안 무너지나!",
            image: {
                src: 'http://valuable-viral-video.com/images/sns_share.jpg',
                width: '1200',
                height: '630'
            },
            webButton: {
                text: "|도|미|노|챌|린|지|",
                url: 'http://valuable-viral-video.com/index.php?media=kt' // 앱 설정의 웹 플랫폼에 등록한 도메인의 URL이어야 합니다.
            }
            });
            $.ajax({
                type   : "POST",
                async  : false,
                url    : "./main_exec.php",
                data:{
                    "exec"      : "insert_share_info",
                    "sns_media" : media,
                    "sns_flag"	: flag
                }
            });
        }
	}
	
	function like_video(v_idx)
	{
		$.ajax({
			type   : "POST",
			async  : false,
			url    : "./main_exec.php",
			data:{
				"exec"				    : "like_video",
				"v_idx"		            : v_idx
			},
			success: function(response){
				console.log(response);
				if (response.match("Y") == "Y")
				{
					$(".icon.like").attr("class","icon liked");
					$("#like_count").html(Number($("#like_count").html()) + 1);
				}else{
					$(".icon.liked").attr("class","icon like");
					$("#like_count").html($("#like_count").html() - 1);
				}
			}
		});			
	}

	
	</script>
	</body>
</html>

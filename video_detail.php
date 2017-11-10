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
												<div class="comment">
													<span class="glyphicon glyphicon-comment"></span>
													<span><?=number_format($data["comment_count"])?></span>
												</div>
											</div>
											<div class="action-group">
												<div class="inner">
													<div class="icon share">
														<button type="button" onclick="share_spread()">
															<span class="blind">공유하기</span>
														</button>
													</div>
<?
	$like_query		= "SELECT * FROM ".$_gl['like_info_table']." WHERE mb_email='".$_SESSION['ss_vvv_email']."' AND v_idx='".$idx."' AND like_flag='Y'";
	$like_result	= mysqli_query($my_db, $like_query);

	if ($_SESSION['ss_vvv_email'])
	{
		if (mysqli_num_rows($like_result) > 0)
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
													<div class="button trans">
														<!-- 현재 영상이 번역이 된 영상인지 검증 필요. -->
														<button type="button" onclick="request_translate('<?=$idx?>')">
															<span>
																번역신청
															</span>
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
													<div class="button trans">
														<button type="button" onclick="alert('로그인 후 이용해 주세요.');location.href='login.php?refurl=video_detail.php?idx=<?=$idx?>';">
															<span>
																번역신청
															</span>
														</button>
													</div>
<?
	}
?>
													<div class="spread">
														<div class="wrapper">
															<button type="button" class="clipboardBtn lk" onclick="sns_share('lk')" data-clipboard-text="http://valuable-viral-video.com/video_detail.php?idx=<?=$idx?>" data-toggle="tooltip" title="Copied!">
																<span class="blind">링크로 공유</span>
															</button>
															<button type="button" class="kt" onclick="sns_share('kt')">
																<span class="blind">카카오톡으로 공유</span>
															</button>
															<button type="button" class="fb" onclick="sns_share('fb')">
																<span class="blind">페이스북으로 공유</span>
															</button>
														</div>
													</div>
												</div>
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
			$related_yt_flag 	= explode("v=",$related_data["video_link"]);
?>
									<div class="d-col-4 m-col-1">
										<figure>
											<a href="video_detail.php?idx=<?=$related_data["idx"]?>" class="clearfix">
												<div class="thum">
													<div class="thumnail-img" style="background-image:url(https://img.youtube.com/vi/<?=$related_yt_flag[1]?>/hqdefault.jpg);"></div>
													<!-- <span class="total-time">0:34</span> -->
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
														<div class="comment">
															<span class="glyphicon glyphicon-comment"></span>
															<span><?=number_format($data["comment_count"])?></span>
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
											<span class="time">
												2017-11-10 11:14
											</span>
											<a href="javascript:report_comment('<?=$comment_data['idx']?>');" class="report">
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
		<!-- clipboard.js -->
		<script src="./lib/clipboard.js-master/dist/clipboard.min.js"></script>
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
		var yt_height = Math.round((yt_width / 16) * 9);
	}else{
		var yt_width = '1040';
		var yt_height = '582';
	}

	function onYouTubeIframeAPIReady() {
		player = new YT.Player('video_area', {
			height: yt_height,
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
		} else if(media == "kt") {
			Kakao.Link.sendTalkLink({
				label: "<?='['.$data['video_company'].']'.$data['video_title']?>",
				image: {
					src: 'https://img.youtube.com/vi/<?=$yt_flag[1]?>/hqdefault.jpg',
					width: '1200',
					height: '630'
				},
				webButton: {
					text: "영상 보러 가기",
					url: 'http://valuable-viral-video.com/video_detail.php?idx=<?=$idx?>' // 앱 설정의 웹 플랫폼에 등록한 도메인의 URL이어야 합니다.
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
				},
				success: function(res) {
					console.log(res);
				}
			});
		} else {
			var clipboard = new Clipboard('.clipboardBtn');
			clipboard.on('success', function(e) {
				console.info('Action:', e.action);
				console.info('Text:', e.text);
				console.info('Trigger:', e.trigger);
				$('.spread .lk').tooltip('show');
				e.clearSelection();
			});
			clipboard.on('error', function(e) {
			console.error('Action:', e.action);
			console.error('Trigger:', e.trigger);
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
					alert("Like 되었습니다!");
					$(".icon.like").attr("class","icon liked");
					$("#like_count").html(Number($("#like_count").html()) + 1);
				}else{
					alert("Like 에서 제외 되었습니다!");
					$(".icon.liked").attr("class","icon like");
					$("#like_count").html($("#like_count").html() - 1);
				}
			}
		});
	}
	function share_spread()
	{
		$('.action-group .spread').toggleClass('active');
	}

	function report_comment(v_idx)
	{
		$.ajax({
			type   : "POST",
			async  : false,
			url    : "./main_exec.php",
			data:{
				"exec"				    : "report_comment",
				"c_idx"		            : idx
			},
			success: function(response){
				console.log(response);
				if (response.match("Y") == "Y")
				{
					alert("댓글 신고 처리 되었습니다. 삭제여부 운영자 검수 후 처리해 드리도록 하겠습니다. ");
				}else{
					alert("다시 시도해 주세요.");
				}
			}
		});
	}
	function request_translate(v_idx)
	{
		$.ajax({
			type   : "POST",
			async  : false,
			url    : "./main_exec.php",
			data:{
				"exec"				    : "request_translate",
				"v_idx"		            : v_idx
			},
			success: function(response){
				console.log(response);
				if (response.match("Y") == "Y")
				{
					alert("번역 요청이 접수 되었습니다. 번역이 완료되면 이메일로 알려드리겠습니다.");
				}else{
					alert("다시 시도해 주세요.");
				}
			}
		});
	}
	</script>
	</body>
</html>

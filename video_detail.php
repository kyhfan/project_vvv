<?
	include_once "./header_video.php";
	
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
						<div id="video_area">

						</div>
						<!-- <iframe allowfullscreen="1" src="https://www.youtube.com/embed/<?=$yt_flag[1]?>??version=3&enablejsapi=1" frameborder="0" id="ytplayer" class="ytplayer" width="200" height="200"></iframe> -->
						[<?=$data["video_company"]?>] <?=$data["video_title"]?><br />
						▶<span id="view_count"><?=number_format($data["play_count"])?></span><br />
						♥<span id="like_count"><?=number_format($data["like_count"])?></span><br />
						<a href="#" onclick="sns_share('fb', 'detail')">fb</a>
						<a href="#" onclick="sns_share('kt', 'detail')">kt</a>
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
	<script type="text/javascript">
	// 유튜브 api 재생 클릭시 이벤트 설정
    var tag = document.createElement('script');

    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    var player;
    function onYouTubeIframeAPIReady() {
		player = new YT.Player('video_area', {
        	height: '360',
        	width: '640',
        	videoId: '<?=$yt_flag[1]?>',
        	events: {
            	// 'onReady': onPlayerReady,
            	'onStateChange': onPlayerStateChange
          	}
        });
	}

	var play_flag = 0;
    function onPlayerStateChange(event) {
		console.log(event);
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
						console.log(response);
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

	</script>
	</body>
</html>

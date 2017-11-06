<?
	include_once "./header.php";

	$ref_url = $_REQUEST["refurl"];
	
	if ($_SESSION['ss_vvv_email'])
		echo "<script>location.href='index.php';</script>";

?>
	<body>
		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NH7CPGH"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->
		<div id="vvv" class="">
			<div class="bg-layer main">
				<div class="container">
					<div class="desktop-layout"></div>
<?
	include_once "./head_area.php";
?>				
					<div class="content member">
						<div class="wrapper">
							<div class="text">
								<ul>
									<li class="text_01">
										<span>LOGIN</span>
									</li>
									<li class="text_02">
										<span>WELCOME TO VVV</span>
									</li>
								</ul>
							</div>
							<div class="login-box">
								<hr class="line_ys">
								<div class="wrap-buttons">
									<div class="button">
										<a href="javascript:loginWithKakao()">
											<img src="./images/kakao.jpg" alt="카카오 로그인" class="mobile-layout">
											<img src="./images/kakao_desktop.jpg" alt="카카오 로그인" class="desktop-layout">
										</a>
									</div>
									<div class="button">
										<a href="#" id="fblogin">
											<img src="./images/facebook.jpg" alt="페이스북 로그인" class="mobile-layout">
											<img src="./images/facebook_desktop.jpg" alt="페이스북 로그인" class="desktop-layout">
										</a>
									</div>
								</div>
								<hr class="line_ys">
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
		<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>		
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
		Kakao.init('ff013671b5f7b01d59770657a8787952');
		
		function getUserData() {
			/* FB.api('/me', function(response) {
				document.getElementById('response').innerHTML = 'Hello ' + response.name;
				console.log(response);
			}); */
			FB.api('/me', {fields: 'name,email,gender,birthday'}, function(response) {
				console.log(JSON.stringify(response));
				// $("#name").text("이름 : "+response.name);
				// $("#email").text("이메일 : "+response.email);
				// $("#gender").text("성별 : "+response.gender);
				// $("#birthday").text("생년월일 : "+response.birthday);
				// $("#id").text("아이디 : "+response.id);

				$.ajax({
					type   : "POST",
					async  : false,
					url    : "./main_exec.php",
					data:{
						"exec"				: "member_facebook_login",
						"login_way"			: "facebook",
						"mb_name"			: response.name,
						"mb_email"			: response.email,
						"gender"			: response.gender,
						"birthday"			: response.birthday,
						"id"				: response.id
					},
					success: function(response){
						if (response.match("Y") == "Y")
						{
							location.href	= "<?=$ref_url?>";
						}else{
							alert("다시 시도해 주세요!");
							location.reload();
						}

					}
				});

			});
		}

		window.fbAsyncInit = function() {
			//SDK loaded, initialize it
			FB.init({
				appId      : '1893328200738001',
				cookie     : true,  // enable cookies to allow the server to access
						// the session
				xfbml      : true,  // parse social plugins on this page
				version    : 'v2.8' // use graph api version 2.8
			});

			//check user session and refresh it
			FB.getLoginStatus(function(response) {
				if (response.status === 'connected') {
					//user is authorized
					//document.getElementById('loginBtn').style.display = 'none';
					//getUserData();
					FB.logout();
				} else {
					//user is not authorized
				}
			});
		};

		//load the JavaScript SDK
		(function(d, s, id){
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) {return;}
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.com/ko_KR/sdk.js";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));

		//add event listener to login button
		document.getElementById('fblogin').addEventListener('click', function() {
			//do the login
			FB.login(function(response) {
				if (response.authResponse) {
					access_token = response.authResponse.accessToken; //get access token
					user_id = response.authResponse.userID; //get FB UID
					console.log('access_token = '+access_token);
					console.log('user_id = '+user_id);
					$("#access_token").text("접근 토큰 : "+access_token);
					$("#user_id").text("FB UID : "+user_id);
					//user just authorized your app
					//document.getElementById('loginBtn').style.display = 'none';
					getUserData();
				}
			}, {scope: 'email,public_profile,user_birthday',
				return_scopes: true});
		}, false);
		
		</script>
	</body>
</html>

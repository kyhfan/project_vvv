<?
	include_once "./header.php";
?>
	<body>
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
										<a href="#">
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
		<script type="text/javascript" src="./js/main.js"></script>
	</body>
</html>

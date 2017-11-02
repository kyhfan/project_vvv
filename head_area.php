					<div id="header">
						<div class="inner clearfix">
							<div class="wrapper">
								<div class="logo">
									<a href="index.php">
										<img src="./images/vvv_logo.png" alt="홈으로">
									</a>
								</div>
								<div class="nav">
									<ul class="clearfix">
										<li>
											<a href="login.php">
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
									<div class="desktop-layout">
										<div class="input-box">
											<input type="text" placeholder="Search" onKeyUp="search_video(this)">
											<button>
												<span class="blind">검색</span>
												<span class="icon-search"></span>
											</button>
										</div>
									</div>
									<div class="mobile-layout">
										<button onclick="actionSearch();">
											<span class="blind">검색</span>
											<span class="icon-search"></span>
										</button>
									</div>
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

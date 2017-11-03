<div id="header">
						<div class="inner">
							<div class="wrapper clearfix">
								<div class="logo">
									<a href="index.php">
										<img src="./images/vvv_logo.png" alt="홈으로">
									</a>
								</div>
								<div class="nav">
									<ul class="clearfix">
										<li>
<?
	if (!$_SESSION['ss_vvv_email'])
	{
?>
											<a href="login.php">
												<span>LOGIN</span>
                                            </a>
<?
    }else{
?>        
											<a href="logout.php">
												<span>LOGOUT</span>
                                            </a>
<?
    }
?>                                    
										</li>
										<li>
											<a href="my_vvv.php">
												<span>MY VVV</span>
												<!-- <span></span> -->
											</a>
										</li>
									</ul>
									<div class="desktop-layout">
										<div class="input-box">
											<input type="text" placeholder="Search" id="search_txt" onKeyUp="search_video(this)">
											<button>
												<span class="blind">검색</span>
												<span class="icon-search" onclick="search_click(document.getElementById('search_txt').value)"></span>
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
										<input type="text" placeholder="Search" id="search_m_txt" onKeyUp="search_video(this)">
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
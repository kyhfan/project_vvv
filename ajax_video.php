<?
	include_once "./config.php";

    $video_pg               = $_REQUEST["video_pg"];
    $total_video_num        = $_REQUEST["total_video_num"];
    $total_page             = $_REQUEST["total_page"];
    $search_keyword         = $_REQUEST["search_keyword"];
    $sort_val               = $_REQUEST["sort_val"];

    if ($sort_val == "new")
        $order_by = " ORDER BY idx DESC";
    else
        $order_by = " ORDER BY like_count DESC";
	$view_pg            = 6;
	$s_page				= $video_pg;

	if ($search_keyword != "")
		$where 	= " AND (video_company like '%".$search_keyword."%' OR video_title like '%".$search_keyword."%' OR video_desc like '%".$search_keyword."%')";
	else
		$where	= "";

	// 전체 상품 갯수
	$all_query				= "SELECT * FROM ".$_gl['video_info_table']." WHERE showYN='Y' ".$where."";
	$all_result				= mysqli_query($my_db, $all_query);
	$all_video_num			= mysqli_num_rows($all_result);
 	$all_page				= ceil($all_video_num / $view_pg);

	$query			= "SELECT * FROM ".$_gl['video_info_table']." WHERE showYN='Y' ".$where." ".$order_by." LIMIT ".$s_page.", ".$view_pg."";
	$result			= mysqli_query($my_db, $query);
	// $video_count	= mysqli_num_rows($result);
	echo $all_video_num."||";

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
	echo "||".$all_page;
?>									
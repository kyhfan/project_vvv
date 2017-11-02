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
			// console.log(currentScroll);
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
					res_arr	= response.split("||");
					if (video_pg > total_page)
						$("#main_more").hide();
					else
						$("#main_more").show();
					$("#main_area").append(res_arr[1]);
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
					res_arr	= response.split("||");
					if (video_pg > total_page)
						$("#main_more").hide();
					else
						$("#main_more").show();
					$("#main_area").html(res_arr[1]);
				}
			});
			
		}

		function search_video(obj)
		{
			if(window.event.keyCode == 13)
			{
				// console.log(obj.value);
				$(".content").hide();
				$(".search-result").show();
				$("#search_keyword").html(obj.value);

				$.ajax({
					type   : "POST",
					async  : false,
					url    : "./ajax_video.php",
					data:{
						"video_pg"				: video_pg,
						"total_video_num"		: total_video_num,
						"total_page"			: total_page,
						"search_keyword"		: obj.value,
						"sort_val"				: sort_val
					},
					success: function(response){
						res_arr	= response.split("||");
						if (video_pg > total_page)
							$("#main_more").hide();
						else
							$("#main_more").show();
						$("#search_count").html(res_arr[0]);
						$("#search_area").html(res_arr[1]);
					}
				});
			}
			
		}

		var $vvv 		        = $('#vvv');
		var $header         	= $('#header');
		var sort_val 	        = "new";
		var video_pg 	        = 0;
		var total_video_num 	= $("#total_video_num").val();
		var total_page 			= $("#total_page").val();
        var current_page        = 1;

        $(window).on('scroll', function() {
			var $headerHeight = document.getElementById('header').height || $header.height();
			var currentScroll = $(this).scrollTop();
			if(currentScroll > 254 && !$vvv.hasClass('menu-opened')) {
				$vvv.addClass('scrolled');
			} else {
				$vvv.removeClass('scrolled');
			}

			var bodyScroll	= currentScroll + $(window).height();
			console.log(bodyScroll + "||" + document.body.scrollHeight);
			if(bodyScroll == document.body.scrollHeight)
			{
				console.log("end");
				if ($("#search_keyword").html() == "")
					more_video();
				else
					more_search_video();
				
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

		function clearSearch()
		{
			if($vvv.hasClass('searchOpen')) {
				TweenMax.to($('.box-search'), 0.3, {autoAlpha: 0});
				$vvv.removeClass('searchOpen');
				$("#search_m_txt").val("");
			}else{
				TweenMax.to($('.box-search'), 0.3, {autoAlpha: 1});
				$vvv.addClass('searchOpen');
			}
		}

		function more_video()
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
					console.log(response);
                    res_arr	= response.split("||");
                    current_page = current_page + 1;
					// if (current_page >= total_page)
					// 	$("#main_more").hide();
					// else
					// 	$("#main_more").show();
					$("#main_area").append(res_arr[1]);
				}
			});
		}

		function more_search_video()
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
                    "search_keyword"		: $("#search_keyword").html(),
                    "sort_val"				: sort_val
                },
				success: function(response){
                    console.log(response);
                    res_arr	= response.split("||");
                    current_page = current_page + 1;
					// if (current_page >= total_page)
					// 	$("#search_more").hide();
					// else
					// 	$("#search_more").show();
					$("#search_area").append(res_arr[1]);
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
            video_pg 	        = 0;
            current_page        = 1;

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
                    // if (current_page >= total_page)
                    //     $("#main_more").hide();
					// else
					// 	$("#main_more").show();
					$("#main_area").html(res_arr[1]);
				}
			});
			
		}

		function search_video(obj)
		{
			if(window.event.keyCode == 13)
			{
                video_pg 	        = 0;
                current_page        = 1;
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
                        total_page  = res_arr[2];
                        // console.log(current_page+"||"+total_page);
                        
                        // if (current_page >= total_page)
						// 	$("#search_more").hide();
						// else
						// 	$("#search_more").show();

						actionSearch();
						$(window).scrollTop(0);
                        $("#search_count").html(res_arr[0]);
						$("#search_area").html(res_arr[1]);
					}
				});
			}
			
		}

		function search_click(obj)
		{

            video_pg 	        = 0;
            current_page        = 1;
            // console.log(obj.value);
            $(".content").hide();
            $(".search-result").show();
            $("#search_keyword").html(obj);

            $.ajax({
                type   : "POST",
                async  : false,
                url    : "./ajax_video.php",
                data:{
                    "video_pg"				: video_pg,
                    "total_video_num"		: total_video_num,
                    "total_page"			: total_page,
                    "search_keyword"		: obj,
                    "sort_val"				: sort_val
                },
                success: function(response){
                    res_arr	= response.split("||");
                    total_page  = res_arr[2];
                    console.log(current_page+"||"+total_page);
                    
                    // if (current_page >= total_page)
                    //     $("#search_more").hide();
                    // else
                    //     $("#search_more").show();

					actionSearch();
					$(window).scrollTop(0);
                    $("#search_count").html(res_arr[0]);
                    $("#search_area").html(res_arr[1]);
                }
            });			
		}

    // 카카오 로그인
    function loginWithKakao()
    {
        // 로그인 창을 띄웁니다.
        Kakao.Auth.login({
        success: function(authObj) {
            // 로그인 성공시, API를 호출합니다.
            Kakao.API.request({
                url: '/v1/user/me',
                success: function(res) {
                    // console.log(JSON.stringify(res));
                    $.ajax({
                        type   : "POST",
                        async  : false,
                        url    : "./main_exec.php",
                        data:{
                            "exec"				: "member_kakao_login",
                            "login_way"			: "kakao",
                            "mb_email"			: res.kaccount_email,
                            "mb_email_verified"	: res.kaccount_email_verified,
                            "mb_way_id"			: res.id,
                            "mb_profile_img"	: res.properties.profile_image,
                            "mb_name"			: res.properties.nickname,
                            "mb_thumbnail_img"	: res.properties.thumbnail_image
                        },
                        success: function(response){
                            if (response.match("Y") == "Y")
                            {
                                location.href	= "index.php";
                            }else{
                                alert("다시 시도해 주세요!");
                                location.reload();
                            }

                        }
                    });
                },
                fail: function(error) {
                alert(JSON.stringify(error));
                }
            });
        },
        fail: function(err) {
            alert(JSON.stringify(err));
        }
        });
    }

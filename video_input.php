<?
	include_once "./header.php";
?>
	<body>
		<h1>영상 정보 등록 페이지</h1>
		<table class="table table-bordered" style="width:80%">
			<tr>
				<td>국가명</td>
				<td>
					<select id="video_country" class="form-control">
						<option value="">선택하세요</option>
<?
	foreach($_gl["COUNTRY"]["KR"] as $key => $val)
	{
?>	
						<option value="<?=$key?>"><?=$val?></option>
<?
	}
?>				
					</select>
				</td>
			</tr>
			<tr>
				<td>영상제목</td>
				<td><input type="text" id="video_title" class="form-control" style="border:1px solid #ccc" placeholder="영상 제목을 입력해 주세요"></td>
			</tr>
			<tr>
				<td>브랜드명</td>
				<td><input type="text" id="video_company" class="form-control" style="border:1px solid #ccc" placeholder="브랜드명을 입력해 주세요"></td>
			</tr>
			<tr>
				<td>브랜드 산업군</td>
				<td>
					<select id="video_category" class="form-control">
						<option value="">선택하세요</option>
<?
	foreach($_gl["CATEGORY"] as $key => $val)
	{
?>	
						<option value="<?=$val?>"><?=$val?></option>
<?
	}
?>				
					</select>
				</td>
			</tr>
			<tr>
				<td>광고대행사</td>
				<td><input type="text" id="video_agency" class="form-control" style="border:1px solid #ccc" placeholder="광고대행사를 입력해 주세요"></td>
			</tr>
			<tr>
				<td>프로덕션</td>
				<td><input type="text" id="video_production" class="form-control" style="border:1px solid #ccc" placeholder="프로덕션을 입력해 주세요"></td>
			</tr>
			<tr>
				<td>Released Date</td>
				<td><input type="text" id="video_date" class="form-control" style="border:1px solid #ccc" placeholder="영상 등록일을 예제와 같은 형식으로 입력해 주세요. ex)2017년 11월"></td>
			</tr>
			<tr>
				<td>영상 URL</td>
				<td><input type="text" id="video_link" class="form-control" style="border:1px solid #ccc" placeholder="영상 링크를 입력해 주세요"></td>
			</tr>
			<tr>
				<td>캠페인 내용(자막 포함)</td>
				<td>
					<textarea name="" id="video_desc" class="form-control" rows="10"></textarea>
				</td>
			</tr>
			<tr>
				<td>노출 여부 선택</td>
				<td>
					<select id="showYN" class="form-control">
						<option value="Y">노출</option>
						<option value="N">비노출</option>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<button type="button" class="btn btn-success">입력</button>
				</td>
			</tr>
		</table>
		<!-- <input type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon1"> -->
		<!-- 합쳐지고 최소화된 최신 자바스크립트 -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="./js/TweenMax.js"></script>
		<script type="text/javascript" src="./js/lazyload.min.js"></script>
		<script type="text/javascript">
		$(".btn-success").on("click",function(){
            var video_country 		= $("#video_country").val();
            var video_title 		= $("#video_title").val();
            var video_company 		= $("#video_company").val();
            var video_category 		= $("#video_category").val();
            var video_agency 		= $("#video_agency").val();
            var video_production 	= $("#video_production").val();
            var video_date 			= $("#video_date").val();
            var video_link 			= $("#video_link").val();
            var video_desc 			= $("#video_desc").val();
            var showYN 				= $("#showYN").val();

			if (video_country == "")
			{
				alert("국가명을 선택해 주세요.");
				return false;
			}

			if (video_title == "")
			{
				alert("영상 제목을 입력해 주세요.");
				return false;
			}

			if (video_company == "")
			{
				alert("브랜드명을 입력해 주세요.");
				return false;
			}

			if (video_category == "")
			{
				alert("브랜드 산업군을 선택해 주세요.");
				return false;
			}

			if (video_agency == "")
			{
				alert("광고 대행사를 입력해 주세요.");
				return false;
			}

			if (video_production == "")
			{
				alert("프로덕션을 입력해 주세요.");
				return false;
			}

			if (video_date == "")
			{
				alert("영상 등록일을 입력해 주세요.");
				return false;
			}

			if (video_link == "")
			{
				alert("영상링크를 입력해 주세요.");
				return false;
			}

			if (video_desc == "")
			{
				alert("캠페인 내용을 입력해 주세요.");
				return false;
			}

            $.ajax({
                type   : "POST",
                async  : false,
                url    : "./main_exec.php",
                data:{
                    "exec"				  : "insert_video",
                    "video_country"		  : video_country,
                    "video_title"		  : video_title,
                    "video_company"		  : video_company,
                    "video_category"	  : video_category,
                    "video_agency"		  : video_agency,
                    "video_production"	  : video_production,
                    "video_date"		  : video_date,
                    "video_link"		  : video_link,
					"video_desc"          : video_desc,
					"showYN"			  : showYN
                },
                success: function(response){
                    console.log(response);
                    if (response.match("Y") == "Y")
                    {
                        alert("영상이 등록 되었습니다.");
                        location.reload();
                    }else{
                        alert("다시 등록해 주세요.");
                        location.reload();
                    }
                }
            });			
		});
		</script>
	</body>
</html>
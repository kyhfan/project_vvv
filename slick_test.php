<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <link rel="stylesheet" href="./css/style.css">
  <title>Document</title>
 </head>
 <body>
          <div class="collabee-slide slider slide-for">
            <div class="item"><img src="https://markup.openur.biz/miningbee/bumblebee-landing/images/1_2_task.jpg" alt=""></div>
            <div class="item"><img src="https://markup.openur.biz/miningbee/bumblebee-landing/images/1_3_file.jpg" alt=""></div>
            <div class="item"><img src="https://markup.openur.biz/miningbee/bumblebee-landing/images/1_4_schedule.jpg" alt=""></div>
            <div class="item"><img src="https://markup.openur.biz/miningbee/bumblebee-landing/images/1_5_comment.jpg" alt=""></div>
          </div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript" src="./js/slick.js"></script>
        <script>
$(document).ready(function(){
  mainSlide();
  function mainSlide(){
    $('.collabee-slide').each(function(key, item) {
    //   var sliderIdName = 'slider' + key;
    //   alert(sliderIdName);
    //   var sliderNavIdName = 'sliderNav' + key;
    //   this.id = sliderIdName;
    //   $('.slide-tab')[key].id = sliderNavIdName;
    //   var sliderId = '#' + sliderIdName;
    //   var sliderNavId = '#' + sliderNavIdName;
      $(".collabee-slide").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        centerMode:true,
        autoplay: true,
        speed:200,
        cssEase: 'linear',
        dots: true,
        touchMove:true
        // asNavFor: sliderNavId
      });

    //   $(sliderNavId).slick({
    //     initialSlide:0,
    //     slidesToShow: 4,
    //     slidesToScroll: true,
    //     asNavFor: sliderId,
    //     centerMode: false,
    //     focusOnSelect: true,
    //     arrows: false,
    //     variableWidth:true
    //   });
    //   $(sliderNavId).find('.slick-slide').eq(0).trigger('click');
    });
  };
})
</script>
 </body>
</html>
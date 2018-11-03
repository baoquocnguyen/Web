<script type="text/javascript" src="<?=$domain?>/public/js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="<?=$domain?>/app/packages/menureponsive/jquery.mmenu.min.all.js"></script>
<script type="text/javascript" src="<?=$domain?>/public/js/wow.min.js"></script>
<script type="text/javascript" src="<?=$domain?>/public/js/nivo.slider.js"></script>
<script type="text/javascript" src="<?=$domain?>/public/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="<?=$domain?>/public/js/jquery.lazyload.min.js"></script>
<script type="text/javascript" src="<?=$domain?>/public/js/slick.min.js"></script>

<script type="text/javascript" src="<?=$domain?>/public/js/jquery.fullPage.js"></script>

<?include "z_includes/fancybox.php";?>

<script>
$(document).ready(function(){  
  
  $('nav#menu').mmenu({
      offCanvas : {
    zposition   : "front",
    position  : "right"
  }
  });
  $("img.lazy").lazyload();
  $('#slider').nivoSlider({
       animSpeed: 1500,
       pauseTime: 6000,
       effect:'random',
       manualAdvance:false,
       pauseOnHover: false
  });
  <?php if($slugnew==''&&$db->num_rows($qtc10)!=0){?>
  $.fancybox({
        'href': '#popup_qc',
        padding : 0,
        arrows: true,
        showCloseButton: true,
        showNavArrows: true,
        hideOnContentClick: true,
    });
  <?php }?>
  $(".various").fancybox({
        maxWidth  : 900,
        maxHeight : 800,
        fitToView : false,
        width   : '85%',
        height    : '85%',
        autoSize  : false,
        closeClick  : false,
        openEffect  : 'none',
        closeEffect : 'none',
            padding : 0,
            autoscale  : 'true',
            allowfullscreen   : 'true',
             helpers : {
                thumbs : {
            width  : 150,
            height : 100
          }
        }
      });
    $('ul.slide1home').slick({
          dots: false,
          infinite: false,
          arrows: true,
          autoplay: true,
          speed: 1000,
          slidesToShow: 5,
          slidesToScroll: 1,
          responsive: [{
            breakpoint: 960,
            settings: {
              slidesToShow: 4
            }
          },
          {
            breakpoint: 768,
            settings: {
              slidesToShow: 3
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2
            }
          }]
      });
    $('ul.slide2home').slick({
          dots: false,
          infinite: false,
          arrows: true,
          autoplay: true,
          speed: 1000,
          slidesToShow: 5,
          slidesToScroll: 1,
          responsive: [{
            breakpoint: 960,
            settings: {
              slidesToShow: 4
            }
          },
          {
            breakpoint: 768,
            settings: {
              slidesToShow: 3
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2
            }
          }]
      });
    $('ul.slide3home').slick({
          dots: false,
          infinite: false,
          arrows: true,
          autoplay: true,
          speed: 1000,
          slidesToShow: 5,
          slidesToScroll: 1,
          responsive: [{
            breakpoint: 960,
            settings: {
              slidesToShow: 4
            }
          },
          {
            breakpoint: 768,
            settings: {
              slidesToShow: 3
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2
            }
          }]
      });
  <?php if($post_type=='catproduct'||$post_type=='catproduct_detail'){?>
    $(".content_left_ul > li > a").click(function() {
        var ga=$(this).attr('rel');
        $( ".hhhh" ).not('ul.ul_'+ga).slideUp('slow');
        $("ul.ul_"+ga).slideToggle('slow');
    });
    <?php }?>
    $(".block-list li a").click(function () {
        $(".block-list li a").removeClass("active");
        $(this).addClass("active");
        var activeTab = $(this).attr("href");
        $(".block-detail").hide();
        $(activeTab).fadeIn();
        return false;
    });
    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        fade: true,
        adaptiveHeight: true,
        asNavFor: '.slider-nav'
    });
    $('.slider-nav').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: true,
        centerMode: false,
        adaptiveHeight: true,
        focusOnSelect: true
    }); 
    var dtslider = $("#dt-slider");
     dtslider.owlCarousel({
      pagination: true,
      autoPlay:true,
      loop:true,
      navigation: false,
      items: 1,
      addClassActive: true,
      autoplayTimeout:100,
      autoplayHoverPause:true,
      itemsCustom : [
        [0, 1],
        [320, 1],
        [480, 1],
        [700, 1],
        [768, 1],
        [1024, 1],
        [1200, 1],
        [1400, 1],
        [1600, 1]
      ]
    });
     $("input[name$='payment']").change(function() {
        var test = $(this).val();
        $("div.active_bank").hide();
        $("#payment_bank" + test).show();
    });
});
</script>
<script type="text/javascript">section1
var curScrollTop = 0;
$(window).scroll(function(){
    if ($(this).scrollTop() > 0){
        $('#section1').addClass('fixed');
    }else{
        $('#section1').removeClass('fixed');
    }
});
</script>
 <script>
		new WOW().init();
</script>
<script type="text/javascript">
var scrolltotop={setting:{startline:100,scrollto:0,scrollduration:1e3,fadeduration:[500,100]},controlHTML:'<img src="<?=$domain?>/public/images/icon_top.png" />',controlattrs:{offsetx:5,offsety:5},anchorkeyword:"#top",state:{isvisible:!1,shouldvisible:!1},scrollup:function(){this.cssfixedsupport||this.$control.css({opacity:0});var t=isNaN(this.setting.scrollto)?this.setting.scrollto:parseInt(this.setting.scrollto);t="string"==typeof t&&1==jQuery("#"+t).length?jQuery("#"+t).offset().top:0,this.$body.animate({scrollTop:t},this.setting.scrollduration)},keepfixed:function(){var t=jQuery(window),o=t.scrollLeft()+t.width()-this.$control.width()-this.controlattrs.offsetx,s=t.scrollTop()+t.height()-this.$control.height()-this.controlattrs.offsety;this.$control.css({left:o+"px",top:s+"px"})},togglecontrol:function(){var t=jQuery(window).scrollTop();this.cssfixedsupport||this.keepfixed(),this.state.shouldvisible=t>=this.setting.startline?!0:!1,this.state.shouldvisible&&!this.state.isvisible?(this.$control.stop().animate({opacity:1},this.setting.fadeduration[0]),this.state.isvisible=!0):0==this.state.shouldvisible&&this.state.isvisible&&(this.$control.stop().animate({opacity:0},this.setting.fadeduration[1]),this.state.isvisible=!1)},init:function(){jQuery(document).ready(function(t){var o=scrolltotop,s=document.all;o.cssfixedsupport=!s||s&&"CSS1Compat"==document.compatMode&&window.XMLHttpRequest,o.$body=t(window.opera?"CSS1Compat"==document.compatMode?"html":"body":"html,body"),o.$control=t('<div id="topcontrol">'+o.controlHTML+"</div>").css({position:o.cssfixedsupport?"fixed":"absolute",bottom:o.controlattrs.offsety,right:o.controlattrs.offsetx,opacity:0,cursor:"pointer"}).attr({title:"Scroll to Top"}).click(function(){return o.scrollup(),!1}).appendTo("body"),document.all&&!window.XMLHttpRequest&&""!=o.$control.text()&&o.$control.css({width:o.$control.width()}),o.togglecontrol(),t('a[href="'+o.anchorkeyword+'"]').click(function(){return o.scrollup(),!1}),t(window).bind("scroll resize",function(t){o.togglecontrol()})})}};scrolltotop.init();
</script>
<script type="text/javascript">
function addToCart (itemId)
{
        $.ajax({
    type  : 'GET',
        url   : '<?=$domain?>/ajax/cart.php',
    data  : { id : itemId},
    success : function(qq)
    { 
        $("#count-cart").html(qq);  
            alert("Đã thêm vào giỏ hàng");
    }
  });
    
}
function addToCart1 (itemId,soluong)
{
    $.ajax({
    type  : 'GET',
        url   : '<?=$domain?>/ajax/cart.php',
    data  : { id : itemId,so_luong : soluong },
    success : function(qq)
    { 
            $("#count-cart").html(qq); 
            alert("Đã thêm vào giỏ hàng");
            location = "<?=$root?>/<?=show_infopage("cart","slug","15")?>";
    }
  });
    
}

function getprice(gia,id)
{
    var tongdau = document.getElementById('tong'+id).value;
    var so_luong = document.getElementById('quatity'+id).value;
    var tongall = document.getElementById('tongfix').value;

    for(var i =0; i< tongdau.length; i++)
        tongdau =tongdau.replace('.','');

    for(var i =0; i< tongall.length; i++)
    {
        tongall =tongall.replace('.','');
        
    }
    tongdau=parseInt(tongdau);
    tongall=parseInt(tongall);
    
    if(so_luong==''){
        so_luong=1;
    }else if(so_luong==0){
        so_luong=1;
    }
    var so_luong_new=parseInt(so_luong);
    var totalnew = parseInt(gia * so_luong_new);
    var totalnewnew=totalnew;
    
    document.getElementById('tong'+id).value =  totalnewnew.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    var tongfix=parseInt(totalnew-tongdau);
    
    var tongshow=parseInt(tongall+tongfix);
    var tongshownew=tongshow;    

    document.getElementById('tongfix').value = tongshownew.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    $.ajax({
        type: "GET",                              
        url: "<?=$domain?>/ajax/cartupdate.php",
        data  : { id : id,so_luong:so_luong}
    }); 
};
</script>
<script type="text/javascript">
  $("a.add-cart").click(function(event){
    event.preventDefault();
    addToCart($(this).attr('rel'));
  });
</script>
<script type="text/javascript">
  $("a.botton").click(function(event){
    event.preventDefault();
    addToCart1($(this).attr('rel'),document.frm3.so_luong.value);
    });
</script>
$(document).ready(function(){
    //$('img').error(function(){
//        $(this).attr('src', '../images/no-img.png');
//    });
    $("#toggle-menu").click(function (e){
        e.preventDefault();
        $(".toggle-blmenu").toggleClass("toggled1");
        $(".block-rcontent").toggleClass("toggled2");
        $(".left-menu").toggleClass("spanposition");
        $(".sidebar").toggleClass("spansliderbar");
    });
    $(".list-sub li a").click(function () {
        $(".list-sub li a").removeClass("active");
        $(this).addClass("active");
        $(".block-sub").hide();
        var activeTab = $(this).attr("href");
        $(activeTab).show();
        return false;
    });
    $(".list-sub-option li a").click(function () {
        $(".list-sub-option li a").removeClass("active");
        $(this).addClass("active");
        $(".block-sub-option").hide();
        var activeTabOption = $(this).attr("href");
        $(activeTabOption).show();
        return false;
    });
    
    $('#home-date').datepicker({
        inline: true,
        firstDay: 1,
        showOtherMonths: true,
        dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
        todayBtn: 'linked'
    });
    
    $('.ngayma').datepicker({
        inline: true,
    });
    
    $("[data-widget='collapse']").click(function() {
        //Find the box parent        
        var box = $(this).parents(".box-common").first();
        //Find the body and the footer
        var bf = box.find(".box-body, .box-footer");
        if (!box.hasClass("collapsed-box")) {
            box.addClass("collapsed-box");
            bf.slideUp();
        } else {
            box.removeClass("collapsed-box");
            bf.slideDown();
        }
    });
    
    $(".show-content").click(function (){ 
        $header = $(this);
        //getting the next element
        $content = $header.next();
        //open up the content needed - toggle the slide- if visible, slide up, if not slidedown.
        $content.slideToggle(500, function (){
            //execute this after slideToggle is done
            //change text of header based on visibility of content div
            $header.text(function (){
            //change text based on condition
            return $content.is(":visible") ? "Close" : "Open";
            });
        });
    });
       
    $(function() {
        $( "#sortable" ).sortable();
        $( "#sortable" ).disableSelection();
    });
    
    $('.form-seo').click(function(){
        $(".show-form-seo").slideToggle( "slow","linear" );
    });
    
    $('.cp2').colorpicker();
});
function time(){
    var today = new Date();
    var weekday=new Array(7);
    weekday[0]="Sunday";
    weekday[1]="Monday";
    weekday[2]="Tuesday";
    weekday[3]="Wednesday";
    weekday[4]="Thursday";
    weekday[5]="Friday";
    weekday[6]="Saturday";
    var day = weekday[today.getDay()]; 
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();
    var h=today.getHours();
    var m=today.getMinutes();
    var s=today.getSeconds();
    m=checkTime(m);
    s=checkTime(s);
    nowTime = h+":"+m+":"+s;
    if(dd<10){dd='0'+dd} if(mm<10){mm='0'+mm} today = day+', '+ dd+'/'+mm+'/'+yyyy;

    tmp='<span>'+today+'  '+nowTime+'</span>';

    document.getElementById("clock").innerHTML=tmp;

    clocktime=setTimeout("time()","1000","JavaScript");
    function checkTime(i)
    {
    if (i<10)
      {
      i="0" + i;
      }
    return i;
    }
};
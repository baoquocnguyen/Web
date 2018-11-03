<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&language=vi"></script>
<script type="text/javascript">
var map;
function initialize() {
    var myLatlng = new google.maps.LatLng(<?=get_bien("maps")?>);
    var myOptions = {
    zoom: 16,
    center: myLatlng,
    draggable: true,
    scrollwheel: false,
    mapTypeId: google.maps.MapTypeId.ROADMAP
}
map = new google.maps.Map(document.getElementById("div_id"), myOptions); 
    // Biến text chứa nội dung sẽ được hiển thị
    var image = '<?=$domain?>/images/point.png';   
    var marker = new google.maps.Marker({
        position: myLatlng, 
        map: map,
        title:"",
        icon: image,
    });
  
    google.maps.event.addListener(map, 'click', function(event){
    this.setOptions({scrollwheel:true});
    });
    google.maps.event.addListener(map, 'mouseover', function(event){
    this.setOptions({scrollwheel:false});
    }); 
}
</script>
    <body onLoad="initialize()">
        <div  id="div_id" style="height:314px; width:100%;"></div>
    </body>
<div class="line_footer"></div>
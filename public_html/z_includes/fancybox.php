<!-- Add jQuery library -->
<!-- Add mousewheel plugin (this is optional) -->
<!--<script type="text/javascript" src="<?=$domain?>/lib/jquery.mousewheel-3.0.6.pack.js"></script>-->

<!-- Add fancyBox main JS and CSS files -->
<script type="text/javascript" src="<?=$domain?>/app/packages/fancybox/jquery.fancybox.js?v=2.1.5"></script>
<script type="text/javascript" src="<?=$domain?>/app/packages/fancybox/jquery-ui.min.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="<?=$domain?>/app/packages/fancybox/jquery.fancybox.css?v=2.1.5" media="screen" />

<!-- Add Button helper (this is optional) -->
<link rel="stylesheet" type="text/css" href="<?=$domain?>/app/packages/fancybox/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
<script type="text/javascript" src="<?=$domain?>/app/packages/fancybox/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>

<!-- Add Thumbnail helper (this is optional) -->
<link rel="stylesheet" type="text/css" href="<?=$domain?>/app/packages/fancybox/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
<script type="text/javascript" src="<?=$domain?>/app/packages/fancybox/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

<!-- Add Media helper (this is optional) -->
<script type="text/javascript" src="<?=$domain?>/app/packages/fancybox/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

<script type="text/javascript">
		/*
		 *  Simple image gallery. Uses default settings
		 */
    $('.fancybox').fancybox({
	    padding : 0,
	    arrows: true,
        play: true,
        showCloseButton: true,
        showNavArrows: true,
        hideOnContentClick: true,
	    helpers : {
            thumbs : {
			    width  : 80,
			    height : 40
		    }
	    },
	    onUpdate:function(){
		    $('#fancybox-thumbs ul').draggable({
			    axis: "x"
		    });
		    var posXY = '';
		    $('.fancybox-skin').draggable({
			    axis: "x",
			    drag: function(event,ui){
				    // get position
                    posXY = ui.position.left;
                    // if drag distance bigger than +- 100px: cancel drag function..
                    if(posXY > 100){return false;}
				    if(posXY < -100){return false;}
			    },
			    stop: function(){
                    // ... and get next oder previous image
				    if(posXY > 95){$.fancybox.prev();}
				    if(posXY < -95){$.fancybox.next();}
			    }
		    });
	    }
	    });

		/*
		 *  Different effects
		 */

		// Change title type, overlay closing speed
		$(".fancybox-effects-a").fancybox({
			helpers: {
				title : {
					type : 'outside'
				},
				overlay : {
					speedOut : 0
				}
			}
		});

		// Disable opening and closing animations, change title type
		$(".fancybox-effects-b").fancybox({
			openEffect  : 'none',
			closeEffect	: 'none',

			helpers : {
				title : {
					type : 'over'
				}
			}
		});

		// Set custom style, close if clicked, change title type and overlay color
		$(".fancybox-effects-c").fancybox({
			wrapCSS    : 'fancybox-custom',
			closeClick : true,

			openEffect : 'none',

			helpers : {
				title : {
					type : 'inside'
				},
				overlay : {
					css : {
						'background' : 'rgba(238,238,238,0.85)'
					}
				}
			}
		});

		// Remove padding, set opening and closing animations, close if clicked and disable overlay
		$(".fancybox-effects-d").fancybox({
			padding: 0,

			openEffect : 'elastic',
			openSpeed  : 150,

			closeEffect : 'elastic',
			closeSpeed  : 150,

			closeClick : true,

			helpers : {
				overlay : null
			}
		});

		/*
		 *  Button helper. Disable animations, hide close button, change title type and content
		 */

		$('.fancybox-buttons').fancybox({
			openEffect  : 'none',
			closeEffect : 'none',

			prevEffect : 'none',
			nextEffect : 'none',

			closeBtn  : false,

			helpers : {
				title : {
					type : 'inside'
				},
				buttons	: {}
			},

			afterLoad : function() {
				this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
			}
		});


		/*
		 *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked
		 */

		$('.fancybox-thumbs').fancybox({
			prevEffect : 'none',
			nextEffect : 'none',

			closeBtn  : false,
			arrows    : false,
			nextClick : true,

			helpers : {
				thumbs : {
					width  : 50,
					height : 50
				}
			}
		});

		/*
		 *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
		*/
		$('.fancybox-media')
			.attr('rel', 'media-gallery')
			.fancybox({
				openEffect : 'none',
				closeEffect : 'none',
				prevEffect : 'none',
				nextEffect : 'none',

				arrows : false,
				helpers : {
					media : {},
					buttons : {}
				}
			});

		/*
		 *  Open manually
		 */

		$("#fancybox-manual-a").click(function() {
			$.fancybox.open('1_b.jpg');
		});

		$("#fancybox-manual-b").click(function() {
			$.fancybox.open({
				href : 'iframe.html',
				type : 'iframe',
				padding : 5
			});
		});

		$("#fancybox-manual-c").click(function() {
			$.fancybox.open([
				{
					href : '1_b.jpg',
					title : 'My title'
				}, {
					href : '2_b.jpg',
					title : '2nd title'
				}, {
					href : '3_b.jpg'
				}
			], {
				helpers : {
					thumbs : {
						width: 75,
						height: 50
					}
				}
			});
		});
</script>
<style type="text/css">
	.fancybox-custom .fancybox-skin {
		box-shadow: 0 0 50px #222;
	}


</style>

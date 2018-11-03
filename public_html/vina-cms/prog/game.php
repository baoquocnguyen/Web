<link rel="stylesheet" type="text/css" media="screen, projection" href="tpl/sweetalert2.min.css" />
<div id="canves" style="margin-bottom: 100px;">
    <div class="restart"><i class="fa fa-repeat"></i></div>
    <div class="curtain"></div>
    <ul id="score-panel">
        <li><i class="fa fa-star"></i></li>
        <li><i class="fa fa-star"></i></li>
        <li><i class="fa fa-star"></i></li>
        <li>
            <h1><span id="moves-num"></span><span>Moves</span></h1>
        </li>
    </ul>
    <ul id="tower-1" class="tower"></ul>
    <ul id="tower-2" class="tower"></ul>
    <ul id="tower-3" class="tower"></ul>
</div>
<style>
#canves{
    width: 98%;
    margin: 0 auto;
    height: 240px;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    padding: 0;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-box-align: end;
    -webkit-align-items: flex-end;
    -ms-flex-align: end;
    align-items: flex-end;
    position: relative;
}
#canves #score-panel {
    width: 180px;
    height: 53px;
    position: absolute;
    top: 10px;
    left: 50%;
    -webkit-transform: translateX(-50%);
    transform: translateX(-50%);
    font-size: 23px;
    text-align: center;
}
#canves #score-panel li{
    list-style: none;
    display: inline-block;
}
#canves #score-panel li:last-child{
    font-family: 'Coda', cursive;
    display: block;
    font-size: 7px;
    line-height: 1;
}
.restart{
    cursor: pointer;
    position: absolute;
    bottom: -60px;
    left: 50%;
    font-size: 21px;
    -webkit-transform: translateX(-50%);
    transform: translateX(-50%);
}
.tower{
    width: 115px;
    height: 117px;
    border-bottom: 5px solid #000000;
    border-radius: 7px;
    position: relative;
    text-align: center;
    padding: 0;
    margin: 0 25px 0 0;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: reverse;
    -webkit-flex-direction: column-reverse;
    -ms-flex-direction: column-reverse;
    flex-direction: column-reverse;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    cursor: pointer;
}
.tower#tower-3 {
    margin: 0;
}
.tower:before {
    width: 4px;
    height: 116px;
    content: '';
    display: block;
    background: #000000;
    position: absolute;
    bottom: -2px;
    left: calc(50% - 2px);
    z-index: 10;
    border-radius: 30px;
}
.disk{
    list-style: none;
    height: 16px;
    display: block;
    border-radius: 9px;
    font-size: 0;
    z-index: 20;
}
.disk.hold {
    position: absolute;
    top: -50px;
    left: 50%;
    -webkit-transform: translateX(-50%);
    transform: translateX(-50%);
}
.swal2-overlay {
    background-color: white;
}
.disk-1 {
  width: 17.5px;
  background-color: #e91e63;
}
.disk-2 {
    width: 35px;
    background-color: #673ab7;
}
.disk-3 {
    width: 52.5px;
    background-color: #3f51b5;
}
.disk-4 {
    width: 70px;
    background-color: #00bcd4;
}
.disk-5 {
    width: 87.5px;
    background-color: #8bc34a;
}
.disk-6 {
    width: 105px;
    background-color: #ffc107;
}
.disk-7 {
    width: 122.5px;
    background-color: #ff9800;
}
</style>
<script type="text/javascript" src="../<?=admin_url?>/js/jquery.min.js"></script>
<script type="text/javascript" src="../<?=admin_url?>/js/sweetalert2.min.js"></script>
<script>
$(document).ready(function() {
    // Variables
    var holding = [],
    	moves,
    	disksNum = 7,
    	minMoves = 127,
    	$canves = $('#canves'),
    	$restart = $canves.find('.restart'),
    	$tower = $canves.find('.tower'),
    	$scorePanel = $canves.find('#score-panel'),
    	$movesCount = $scorePanel.find('#moves-num'),
    	$ratingStars = $scorePanel.find('i');
    // Init Game
	function initGame(tower) {
		$tower.html('');
		moves = 0;
		$movesCount.html(0);
		holding = [];
		for (var i = 1; i <= disksNum; i++) {
			tower.prepend($('<li class="disk disk-' + i + '" data-value="' + i + '"></li>'));
		}
		$ratingStars.each(function() {
			$(this).removeClass('fa-star-o').addClass('fa-star');
		});
	}
	initGame($tower.eq(0));
	// Game Logic
	function countMove() {
		moves++;
		$movesCount.html(moves);
		if (moves > minMoves - 1) {
			if ($tower.eq(1).children().length === disksNum || $tower.eq(2).children().length === disksNum) {
				swal({
					allowEscapeKey: false,
					allowOutsideClick: false,
					title: 'Congratulations! You Won!',
					text: "Boom Shaka Lak",
					type: 'success',
					confirmButtonColor: '#8bc34a',
					confirmButtonText: 'Play again!'
				}).then(function(isConfirm) {
					if (isConfirm) {
						initGame($tower.eq(0));
					}
				})
			}
		}
		if (moves > minMoves) {
			$ratingStars.eq(2).removeClass('fa-star').addClass('fa-star-o')
		}
		if (moves > minMoves * 2) {
			$ratingStars.eq(1).removeClass('fa-star').addClass('fa-star-o')
		}
		if (moves > minMoves * 3) {
			$ratingStars.eq(0).removeClass('fa-star').addClass('fa-star-o')
		}
	}
	function tower(tower) {
		var $disks = tower.children(),
			$topDisk = tower.find(':last-child'),
			topDiskValue = $topDisk.data('value'),
			$holdingDisk = $canves.find('.hold');

		if ($holdingDisk.length !== 0) {
			if (topDiskValue === holding[0]) {
				$holdingDisk.removeClass('hold');
			} else if (topDiskValue === undefined || topDiskValue > holding[0]) {
				$holdingDisk.remove();
				tower.append($('<li class="disk disk-' + holding[0] + '" data-value="' + holding[0] + '"></li>'));
				countMove();
			}
		} else if ($topDisk.length !== 0) {
			$topDisk.addClass('hold');
			holding[0] = topDiskValue;
		}
	}
	// Event Handlers
	$canves.on('click', '.tower', function() {
		var $this = $(this);
		tower($this);
	});
	$restart.on('click', function() {
		swal({
			allowEscapeKey: false,
			allowOutsideClick: false,
			title: 'Are you sure?',
			text: "Your progress will be Lost!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#8bc34a',
			cancelButtonColor: '#e91e63',
			confirmButtonText: 'Yes, Restart Game!'
		}).then(function(isConfirm) {
			if (isConfirm) {
				initGame($tower.eq(0));
			}
		})
	});
});
</script>
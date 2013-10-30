//http://padolsey.net/p/Sonic/repo/demo/demo.html

$(function(){
var loaders = [
/*
	{

		width: 100,
		height: 100,

		stepsPerFrame: 4,
		trailLength: 1,
		pointDistance: .01,
		fps: 25,

		fillColor: '#FF0000',

		setup: function() {
			this._.lineWidth = 10;
		},

		step: function(point, i, f) {

			var progress = point.progress,
				degAngle = 360 * progress,
				angle = Math.PI/180 * degAngle,
				angleB = Math.PI/180 * (degAngle - 180),
				size = i*5;

			this._.fillRect(
				Math.cos(angle) * 25 + (50-size/2),
				Math.sin(angle) * 15 + (50-size/2),
				size,
				size
			);

			this._.fillStyle = '#63D3FF';

			this._.fillRect(
				Math.cos(angleB) * 15 + (50-size/2),
				Math.sin(angleB) * 25 + (50-size/2),
				size,
				size
			);

			if (point.progress == 1) {

				this._.globalAlpha = f < .5 ? 1-f : f;

				this._.fillStyle = '#EEE';

				this._.beginPath();
				this._.arc(50, 50, 5, 0, 360, 0);
				this._.closePath();
				this._.fill();

			}


		},

		path: [
			['line', 40, 10, 60, 90]
		]
	}*/
	
	{

		width: 100,
		height: 100,

		stepsPerFrame: 1,
		trailLength: 1,
		pointDistance: .025,

		strokeColor: '#05E2FF',

		fps: 20,

		setup: function() {
			this._.lineWidth = 2;
		},
		step: function(point, index) {

			var cx = this.padding + 50,
				cy = this.padding + 50,
				_ = this._,
				angle = (Math.PI/180) * (point.progress * 360);

			this._.globalAlpha = Math.max(.5, this.alpha);

			_.beginPath();
			_.moveTo(point.x, point.y);
			_.lineTo(
				(Math.cos(angle) * 35) + cx,
				(Math.sin(angle) * 35) + cy
			);
			_.closePath();
			_.stroke();

			_.beginPath();
			_.moveTo(
				(Math.cos(-angle) * 32) + cx,
				(Math.sin(-angle) * 32) + cy
			);
			_.lineTo(
				(Math.cos(-angle) * 27) + cx,
				(Math.sin(-angle) * 27) + cy
			);
			_.closePath();
			_.stroke();

		},
		path: [
			['arc', 50, 50, 40, 0, 360]
		]
	}];

var d, a, container = document.getElementById('in');


for (var i = -1, l = loaders.length; ++i < l;) {
	
	d = document.createElement('div');
	d.className = 'l';

	a = new Sonic(loaders[i]);

	d.appendChild(a.canvas);	
	container.appendChild(d);

	a.canvas.style.marginTop = (150 - a.fullHeight) / 2 + 'px';
	a.canvas.style.marginLeft = (150 - a.fullWidth) / 2 + 'px';

	a.play();

}
});

function loadingOff()	{
	$("#mask").hide();
	$("#loading").hide();
}
function loadingOn()	{
	$("#mask").show();
	$("#loading").show();
}

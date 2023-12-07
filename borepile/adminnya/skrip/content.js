ddaccordion.init({
	headerclass: "expandable",
	contentclass: "categoryitems",
	revealtype: "click",
	mouseoverdelay: 200,
	collapseprev: true,
	defaultexpanded: [0],
	onemustopen: false,
	animatedefault: false,
	persiststate: true,
	toggleclass: ["", "openheader"],
	togglehtml: ["prefix", "", ""],
	animatespeed: "fast",
	oninit:function(headers, expandedindices){
	},
	onopenclose:function(header, index, state, isuseractivated){
	}
})

$(function(){
	// Set starting slide to 1
	var startSlide = 1;
	// Get slide number if it exists
	if (window.location.hash) {
		startSlide = window.location.hash.replace('#','');
	}
	// Initialize Slides
	$('#slides').slides({
		preload: true,
		preloadImage: 'img/loading.gif',
		generatePagination: true,
		play: 5000,
		pause: 2500,
		hoverPause: true,
		// Get the starting slide
		start: startSlide,
		animationComplete: function(current){
			// Set the slide number as a hash
			window.location.hash = '#' + current;
		}
	});
});
function buatjam(){
	var date = new Date();
	var h = date.getHours();
	var i = date.getMinutes();
	var s = date.getSeconds();
	var y = date.getFullYear();
	var d = date.getDate();
	var m = date.getMonth()+1;
	
	h = cek(h);
	m = cek(m);
	s = cek(s);
	i = cek(i);
	y = cek(y);
	d = cek(d);
	
	document.getElementById("jam").innerHTML = d+"-"+m+"-"+y+" "+h+":"+i+":"+s;
	setTimeout("buatjam()",1000);
}
function cek(x){
	if(x < 10){
		x = "0"+x;
	}
	return x;
}
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}  
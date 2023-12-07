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

function visitor_cek(w,h){
	var mvisit = "";
	if(w>=1024 && h>=768){
		mvisit = "desktop";
	}else{
		mvisit = "mobile";
	}
	mevisit = mvisit+" "+w+"px "+h+"px";
	// console.log(mevisit);
	$("#me_visit").text(mevisit);
}
function OpenPopupCenter(pageURL, title, w, h) {
	var left = (screen.width - w) / 2;
	var top = (screen.height - h) / 4;  // for 25% - devide by 4  |  for 33% - devide by 3
	var targetWin = window.open(pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
	targetWin.focus();
} 
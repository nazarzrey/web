var ALERT_TITLE = "Info..!";
var ALERT_BUTTON_TEXT = "Ok";

if(document.getElementById) {
    window.alert = function(txt) {
        createCustomAlert(txt);
    }
}

function createCustomAlert(txt) {
    d = document;

    if(d.getElementById("modalContainer")) return;
    mObj = d.getElementsByTagName("body")[0].appendChild(d.createElement("div"));
    mObj.id = "modalContainer";
    /*mObj.style.height = window.innerHeight + "px"; */
	heighall = window.outerHeight
    if(d.documentElement.scrollHeight < window.innerHeight){
        mObj.style.height = window.innerHeight + "px";
    }else{
		mObj.style.height = d.documentElement.scrollHeight + "px";
    }
	ss = window.innerHeight+" "+d.documentElement.scrollHeight;
    mObj.style.width = d.documentElement.scrollWidth + "px";
    alertObj = mObj.appendChild(d.createElement("div"));
    alertObj.id = "alertBox";
    if(d.all && !window.opera) alertObj.style.top = document.documentElement.scrollTop + "px";
    alertObj.style.left = (d.documentElement.scrollWidth - alertObj.offsetWidth)/2 + "px";
    alertObj.style.visiblity="visible";
/*
    h1 = alertObj.appendChild(d.createElement("h1"));
    h1.appendChild(d.createTextNode(ALERT_TITLE));
*/	
    msg = alertObj.appendChild(d.createElement("p"));
    /*msg.appendChild(d.createTextNode(ss)); */
    msg.innerHTML = txt;
    /*msg.innerHTML =d.documentElement.scrollHeight+" "+window.innerHeight; */

    btn = alertObj.appendChild(d.createElement("a"));
    btn.id = "closeBtn";
    btn.appendChild(d.createTextNode(ALERT_BUTTON_TEXT));
    btn.href = "#";
    btn.focus();
    btn.onclick = function() { removeCustomAlert();return false; }

    alertObj.style.display = "block";

}

function removeCustomAlert() {
    document.getElementsByTagName("body")[0].removeChild(document.getElementById("modalContainer"));
}
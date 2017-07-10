
function w3_open() {
	var mySidenav = document.getElementById("pr-left-nav");

	// Get the DIV with overlay effect
	var overlayBg = document.getElementById("myOverlay");
    if (mySidenav.style.display === 'block') {
        mySidenav.style.display = 'none';
        overlayBg.style.display = "none";
    } else {
        mySidenav.style.display = 'block';
        overlayBg.style.display = "block";
    }
}

// Close the sidenav with the close button
function w3_close() {
	var mySidenav = document.getElementById("pr-left-nav");

	// Get the DIV with overlay effect
	var overlayBg = document.getElementById("myOverlay");
    mySidenav.style.display = "none";
    overlayBg.style.display = "none";
}


/*
will initialize all datepicker inputs
*/

function datePickerInitialize() {
    var date_input = $(".datepicker-input"); //our date input has the name "date"
    var options ={
            format: 'yyyy/mm/dd',
            orientation: "bottom auto",
            todayHighlight: true,
            autoclose: true };
    date_input.datepicker(options);
}

/*
convert a button text to please wait status with a fa-spinner
*/

function processButton(aButton){
    $(aButton).html("Please Wait   <span class='fa fa-spinner fa-spin'></span>");
}

/*
Loads Scripts dynamically
https://www.nczonline.net/blog/2009/07/28/the-best-way-to-load-external-javascript/
*/

function loadScript(url, callback){

    var script = document.createElement("script")
    script.type = "text/javascript";

    if (script.readyState){  //IE
        script.onreadystatechange = function(){
            if (script.readyState == "loaded" ||
                    script.readyState == "complete"){
                script.onreadystatechange = null;
                callback();
            }
        };
    } else {  //Others
        script.onload = function(){
            callback();
        };
    }

    script.src = url;
    document.getElementsByTagName("head")[0].appendChild(script);
}

// calls a function from functions file using post method
function callFunction (functionName,Data,successCallback,failCallback){
    $.ajax({
        type:"POST",
        dataType:'json',
        url:'/include/ajaxfunc.php',
        data: {functionname: functionName,arguments: Data},
        success: function(obj,textstatus,xhr){successCallback(obj,textstatus,xhr)},
        fail: failCallback
    });
}
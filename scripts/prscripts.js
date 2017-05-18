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

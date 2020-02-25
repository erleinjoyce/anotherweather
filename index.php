<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/weather-icons.min.css">

<div id="demo"></div>

<script>
var x = document.getElementById("demo");
getLocation();

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
  var lat = position.coords.latitude;
  var long = position.coords.longitude;

  $.ajax({
  	url: "getWeather.php",
  	method: "POST",
  	data: {
  		"lat" : lat,
  		"long" : long
  	}, success: function(result) {
  		$("#demo").html(result);
  	}
  })
}

function showmore() {
	var btn = $(".viewmorebtn");
	
	if (btn.text() == "+ View More") {
		btn.text("- View Less");
		$(".moredata").addClass("shown");
	} else {
		btn.text("+ View More");
		$(".moredata").removeClass("shown");
	}
}
</script>
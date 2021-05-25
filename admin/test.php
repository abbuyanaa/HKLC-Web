<!-- Display the countdown timer in an element -->
<p id="demo"></p><br/>
<p id="timer"></p>

<script>
	var countDownDate = new Date("Jan 5, 2021 15:37:25").getTime();

	setInterval(function() {
		var now = new Date().getTime();
		var distance = countDownDate - now;
		var days = Math.floor(distance / (1000 * 60 * 60 * 24));
		var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		var seconds = Math.floor((distance % (1000 * 60)) / 1000);

		document.getElementById("demo").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";

		if (distance < 0) {
			clearInterval(x);
			document.getElementById("demo").innerHTML = "EXPIRED";
		}
	}, 1000);

	var counter = 0;
	setInterval(function() {
		counter++;
		document.getElementById("timer").innerHTML = counter;
	}, 200);
</script>
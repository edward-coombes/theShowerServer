<?php
ini_set('max_execution_time', 1200);
$pathtopy = '/var/www/html/admin/createExcel.py';
$command = "/usr/bin/python " . $pathtopy . " 2>&1";
$output = passthru($command);
echo $output;
?>
<meta http-equiv="refresh" content="2;url=spreadsheet/theshowerapp.xlsx"/> 

<a href="spreadsheet/theshowerapp.xlsx">click here if your download does not start in </a>
<span id="counter"> 3 </span>
<script>
	var counter = setInterval(function(){
		let c = document.getElementById("counter");
		c.innerHTML = c.innerHTML - 1;
	}, 1000);
	setTimeout(function(){
			window.clearInterval(counter);
	}, 3000);
</script>

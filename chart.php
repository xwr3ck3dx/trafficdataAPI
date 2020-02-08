<?php

        $url = 'http://10.10.40.110:8080/trafficdataAPI/api/readip.php?ip='.$_GET['ip'];
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response=json_decode($response_json, true);
?>

<html>
<head>  
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.css">
 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js"></script>
</head>
<body>
<div class="container">
<canvas id="myChart" height="400" width="400"></canvas>

</div>

<script>
	var ctx = 'myChart';
	var data = {
	    labels: [
			<?php foreach($response['data'] as $data){ ?>
				"<?php echo $data['date']?>",
			<?php }?>
		],
		    datasets: [
				{
					label: "inBytes",
					backgroundColor: "rgba(255, 99, 132, 0.2)",
					borderColor: "rgba(255, 99, 132, 1)" ,
					data: [
						<?php foreach($response['data'] as $data){ ?>
							"<?php echo $data['inBytes']?>",
						<?php }?>
					]
				},
				{
					label: "outBytes",
					backgroundColor: "rgba(255, 99, 132, 0.2)",
					borderColor: "rgba(255, 99, 132, 1)",
					data: [
						<?php foreach($response['data'] as $data){ ?>
							"<?php echo $data['outBytes']?>",
						<?php }?>
					]
				},
			]
	};
	// var myChart = new Chart(ctx, {
	// 	type: 'bar',
	// 	data: data,
	// 	options: {
	// 		responsive: false,
	// 		maintainAspectRatio:false
	// 	}
	// });
	window.onload = function() {
			var ctx = document.getElementById('canvas').getContext('2d');
			window.myBar = new Chart(ctx, {
				type: 'bar',
				data: data,
				options: {
					title: {
						display: true,
						text: 'Chart.js Bar Chart - Stacked'
					},
					tooltips: {
						mode: 'index',
						intersect: false
					},
					responsive: true,
					scales: {
						xAxes: [{
							stacked: true,
						}],
						yAxes: [{
							stacked: true
						}]
					}
				}
			});
		};

</script>

</body>
</html>

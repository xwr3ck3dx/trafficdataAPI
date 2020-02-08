<?php

        $url = 'http://10.10.40.110:8080/trafficdataAPI/api/readip.php?ip='.$_GET['ip'];
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response=json_decode($response_json, true);
?>

<!-- <html>
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
			var ctx = document.getElementById('myChart').getContext('2d');
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
							stacked: false,
						}],
						yAxes: [{
							stacked: false
						}]
					}
				}
			});
		};

</script>

</body>
</html>




<!doctype html>
<html> -->

<head>
	<title>Bar Chart</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.css">
 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js"></script>
	<style>
	canvas {
		-moz-user-select: none;
		-webkit-user-select: none;
		-ms-user-select: none;
	}
	</style>
</head>

<body>
	<div id="container" style="width: 75%;">
		<canvas id="canvas"></canvas>
	</div>
	<button id="randomizeData">Randomize Data</button>
	<button id="addDataset">Add Dataset</button>
	<button id="removeDataset">Remove Dataset</button>
	<button id="addData">Add Data</button>
	<button id="removeData">Remove Data</button>
	<script>
		var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
		var color = Chart.helpers.color;
		var barChartData = {
			labels: [
				<?php foreach($response['data'] as $data){ ?>
				'<?php echo $data["date"]?>',
				<?php }?>
			],
			datasets: [{
				label: 'Dataset 1',
				backgroundColor: 'red',
				borderColor: 'red',
				borderWidth: 1,
				data: [
					<?php foreach($response['data'] as $data){ ?>
							<?php echo $data['inBytes']?>,
					<?php }?>
				]
			}, {
				label: 'Dataset 2',
				backgroundColor: 'blue',
				borderColor: 'blue',
				borderWidth: 1,
				data: [
					<?php foreach($response['data'] as $data){ ?>
							<?php echo $data['inBytes']?>,
					<?php }?>
				]
			}]

		};

		window.onload = function() {
			var ctx = document.getElementById('canvas').getContext('2d');
			window.myBar = new Chart(ctx, {
				type: 'bar',
				data: barChartData,
				options: {
					responsive: true,
					legend: {
						position: 'top',
					},
					title: {
						display: true,
						text: 'Chart.js Bar Chart'
					}
				}
			});

		};

		
	</script>
</body>

</html>

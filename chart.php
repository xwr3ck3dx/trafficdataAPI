<?php

        $url = 'http://10.10.40.110:8080/trafficdataAPI/api/readip.php?ip='.$_GET['ip'];
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
		$response=json_decode($response_json, true);
		$monthInTotal=0;
		$monthOutTotal=0;
?>
<!doctype html>
<html>

<head>
	<title>Bar Chart</title>

 <script src="chart.min.js"></script>
 <script src="utils.js"></script>
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
	<!-- <button id="randomizeData">Randomize Data</button>
	<button id="addDataset">Add Dataset</button>
	<button id="removeDataset">Remove Dataset</button>
	<button id="addData">Add Data</button>
	<button id="removeData">Remove Data</button> -->
	<script>
		// var MONTHS = [
		// 	<?php foreach($response['data'] as $data){ ?>
		// 					"<?php echo $data['inBytes']?>",
		// 	<?php }?>
		// ];
		var color = Chart.helpers.color;
		var barChartData = {
			labels: [
					<?php foreach($response['data'] as $data){ ?>
								'<?php echo $data['date'] ?>',
					<?php }?>
				],
			datasets: [{
				label: 'Inbytes in KB',
				backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
				borderColor: window.chartColors.red,
				borderWidth: 1,
				data: [
					<?php foreach($response['data'] as $data){ ?>
							<?php echo round($data['inBytes']/1024); $monthInTotal=$monthInTotal+$data['inBytes'];?>,
					<?php }?>
				]
			}, {
				label: 'Outbytes in KB',
				backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
				borderColor: window.chartColors.blue,
				borderWidth: 1,
				data: [
					<?php foreach($response['data'] as $data){ ?>
							<?php echo round($data['outBytes']/1024); $monthOutTotal=$monthOutTotal+$data['outBytes'];?>,
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
						text: 'Data Usage chart for <?php echo $_GET['ip']; ?>  Total in= <?php echo $monthInTotal/1048576;?>MB Total out= <?php  echo $monthOutTotal/1048576;?>MB'
					}
				}
			});

		};

		// document.getElementById('randomizeData').addEventListener('click', function() {
		// 	var zero = Math.random() < 0.2 ? true : false;
		// 	barChartData.datasets.forEach(function(dataset) {
		// 		dataset.data = dataset.data.map(function() {
		// 			return zero ? 0.0 : randomScalingFactor();
		// 		});

		// 	});
		// 	window.myBar.update();
		// });

		// var colorNames = Object.keys(window.chartColors);
		// document.getElementById('addDataset').addEventListener('click', function() {
		// 	var colorName = colorNames[barChartData.datasets.length % colorNames.length];
		// 	var dsColor = window.chartColors[colorName];
		// 	var newDataset = {
		// 		label: 'Dataset ' + (barChartData.datasets.length + 1),
		// 		backgroundColor: color(dsColor).alpha(0.5).rgbString(),
		// 		borderColor: dsColor,
		// 		borderWidth: 1,
		// 		data: []
		// 	};

		// 	for (var index = 0; index < barChartData.labels.length; ++index) {
		// 		newDataset.data.push(randomScalingFactor());
		// 	}

		// 	barChartData.datasets.push(newDataset);
		// 	window.myBar.update();
		// });

		// document.getElementById('addData').addEventListener('click', function() {
		// 	if (barChartData.datasets.length > 0) {
		// 		var month = MONTHS[barChartData.labels.length % MONTHS.length];
		// 		barChartData.labels.push(month);

		// 		for (var index = 0; index < barChartData.datasets.length; ++index) {
		// 			// window.myBar.addData(randomScalingFactor(), index);
		// 			barChartData.datasets[index].data.push(randomScalingFactor());
		// 		}

		// 		window.myBar.update();
		// 	}
		// });

		// document.getElementById('removeDataset').addEventListener('click', function() {
		// 	barChartData.datasets.pop();
		// 	window.myBar.update();
		// });

		// document.getElementById('removeData').addEventListener('click', function() {
		// 	barChartData.labels.splice(-1, 1); // remove the label first

		// 	barChartData.datasets.forEach(function(dataset) {
		// 		dataset.data.pop();
		// 	});

		// 	window.myBar.update();
		// });
	</script>
</body>

</html>

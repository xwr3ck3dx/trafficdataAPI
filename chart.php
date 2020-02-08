<?php

        $url = 'http://10.10.40.110:8080/trafficdataAPI/api/readip.php?ip='.$_GET['ip'];
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response=json_decode($response_json, true);
?>
<!DOCTYPE HTML>
<html>
<head>  
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css">
 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
</head>
<body>
<canvas id="myChart" width="400" height="400"></canvas>
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
	var myChart = new Chart(ctx, {
		type: 'bar',
		data: data,
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: true
					}
				}]
			},
			responsive: true,
			maintainAspectRatio: false,
		}
	});
</script>

</body>
</html>

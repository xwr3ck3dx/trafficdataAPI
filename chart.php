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
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title:{
		text: "Data Usage for ip <?php echo $_GET['ip']; ?>"
	},	
	axisY: {
		title: "",
		titleFontColor: "#4F81BC",
		lineColor: "#4F81BC",
		labelFontColor: "#4F81BC",
		tickColor: "#4F81BC"
	},
	axisY2: {
		title: "",
		titleFontColor: "#C0504E",
		lineColor: "#C0504E",
		labelFontColor: "#C0504E",
		tickColor: "#C0504E"
	},	
	toolTip: {
		shared: true
	},
	legend: {
		cursor:"pointer",
		itemclick: toggleDataSeries
	},
	data: [{
		type: "column",
		name: "Proven Oil Reserves (bn)",
		legendText: "Proven Oil Reserves",
		showInLegend: true, 
		dataPoints:[
		<?php foreach($response['data'] as $data){ ?>
			{ label: "<?php echo $data['date'];?>",y: <?php echo (int)$data['inBytes'];?> },
		<?php } ?>
		]
	},
	{
		type: "column",	
		name: "Oil Production (million/day)",
		legendText: "Oil Production",
		axisYType: "secondary",
		showInLegend: true,
		dataPoints:[
		<?php foreach($response['data'] as $data){ ?>
                        { lable: "<?php echo $data['date'];?>",y: <?php echo (int)$data['outBytes'];?> },
                <?php } ?>
		]
	}]
});
chart.render();

function toggleDataSeries(e) {
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else {
		e.dataSeries.visible = true;
	}
	chart.render();
}

}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>

<?php

	$url = 'http://10.10.40.110:8080/trafficdataAPI/api/read.php';
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_HTTPGET, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response_json = curl_exec($ch);
	curl_close($ch);
	$response=json_decode($response_json, true);
	

?>
<html>
<head>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/dt-1.10.20/fc-3.3.0/fh-3.1.6/r-2.2.3/sc-2.0.1/sp-1.0.1/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/dt-1.10.20/fc-3.3.0/fh-3.1.6/r-2.2.3/sc-2.0.1/sp-1.0.1/datatables.min.js"></script>
 

</head>
<body>
	<div class="container" style="margin-top:50px">
    <table id="table_id" class="table">
    	<thead>
        	<tr>
            	<th>Date</th>
            	<th>IP</th>
            	<th>inBytes</th>
            	<th>outBytes</th>
        	</tr>
    	</thead>
    	<tbody>
	<?php foreach($response['data'] as $data){  ?>

                	<tr>
			<td><?php echo $data['date']; ?></td>
                	<td><?php echo $data['ip']; ?></td>
                	<td><?php echo $data['inBytes']; ?></td>
			<td><?php echo $data['outBytes']; ?></td>
                	</tr>
	<?php  } ?>

    	</tbody>
    </table>



	</div>
<script>
$(document).ready( function () {
    
	$('#table_id').DataTable( {
		drawCallback: function () {
			var api = this.api();
			$( api.table().footer() ).html(
				api.column( 4, {page:'current'} ).data().sum()
			);
		}
  	} );
} );



</script>

</body>
</html>


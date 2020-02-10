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
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/dt-1.10.20/fc-3.3.0/fh-3.1.6/r-2.2.3/sc-2.0.1/sp-1.0.1/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/dt-1.10.20/fc-3.3.0/fh-3.1.6/r-2.2.3/sc-2.0.1/sp-1.0.1/datatables.min.js"></script>
<script>
jQuery.fn.dataTable.Api.register( 'sum()', function ( ) {
    return this.flatten().reduce( function ( a, b ) {
        if ( typeof a === 'string' ) {
            a = a.replace(/[^\d.-]/g, '') * 1;
        }
        if ( typeof b === 'string' ) {
            b = b.replace(/[^\d.-]/g, '') * 1;
        }
 
        return a + b;
    }, 0 );
} );
</script>

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
                	<td><a href="http://10.10.40.110:8080/trafficdataAPI/chart.php?ip=<?php echo $data['ip']; ?>" target="_blank"><?php echo $data['ip']; ?></a></td>
                	<td><?php echo $data['inBytes']; ?></td>
			<td><?php echo $data['outBytes']; ?></td>
                	</tr>
	<?php  } ?>

    	</tbody>
		<tfoot>
			<tr>
				<td></td>
				<td  style="font-weight:600;text-align:center">Sum</td>
				<td id="sumIn" style="font-weight:600"></td>
				<td id="sumOut" style="font-weight:600"></td>
			</tr>
		</tfoot>
    </table>



	</div>
<script>
$(document).ready( function () {
    
	$('#table_id').DataTable( {
		drawCallback: function () {
			var api = this.api();
			$( "#sumIn" ).html(
				api.column( 2, {page:'current'} ).data().sum(),
			);
			$( "#sumOut" ).html(
				api.column( 3, {page:'current'} ).data().sum(),
			);
		}
  	} );
} );



</script>

</body>
</html>
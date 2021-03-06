<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../config/Database.php';
    include_once '../models/Trafficdata.php';

    $database = new Database();
    $db= $database->connect();

    $trafficdata=new Trafficdata($db);
    $trafficdata->month=isset($_GET['month'])?$_GET['month']:die();
    $result = $trafficdata->read();
    $num = $result->rowCount();

    if($num > 0){

        $trafficdata_arr = array();
        $trafficdata_arr['data']= array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $trafficdata_item =array(
                'ip' => $ip,
                'date' => $date,
                'inBytes' => $inBytes,
                'outBytes' => $outBytes
            );
            array_push($trafficdata_arr['data'], $trafficdata_item);
        }

        echo json_encode($trafficdata_arr);

    } else {
        echo json_encode(
            array('message'=> 'No data Found')
        );
    }


?>

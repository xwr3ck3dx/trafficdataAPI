<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../config/Database.php';
    include_once '../models/Post.php';

    $database = new Database();
    $db= $database->connect();

    $trafficdata=new Post($db);

    $result = $trafficdata->read();
    $num = $result->rowCount();

    if($num > 0){

        $trafficdata_arr = array();
        $trafficdata_arr['data']= array();

        while($row = $result->fetch(PDO::FETCH_ASSOC){
            extract($row);
            $trafficdata_item =array(
                'ip' => $id,
                'date' => $date,
                'inBytes' => $inBytes,
                'outBytes' => $outBytes
            );
            array_push($trafficdata['data'], $trafficdata_item);
        }

        echo json_encode($trafficdata_arr);

    } else {
        echo json_encode(
            array('message'=> 'No data Found')
        );
    }


?>
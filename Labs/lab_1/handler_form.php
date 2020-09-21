<?php


    function firstCheck($x,$y,$r){
        return !in_array($x,array(-5,-4,-3,-2,-1,0,1,2,3)) || !is_numeric($y) || $y <= -5 || $y >=3 || !in_array($r, array(1,1.5,2,2.5,3));
    }

    function checkArea($x,$y,$r){
        if (($x>=0 && $x <= $r && $y>=0 && $y <= $r) || ($x<=0 && $y>=0 && $y<=($x + $r/2)) || ($x>=0 && $y<=0 && ($y*$y+$x*$x) <= ($r*$r)/4)){
            return 'Вошло';
        }
        else{
            return 'Не вошло';
        }
    }

    function checkPolitical($x,$y){
        if ($x > 0 && $y > 0){
            return 'Тупой правый авторитарист';
        }
        else if ($x < 0 && $y > 0){
            return 'Тупой левый авторитарист';
        }
        else if ($x > 0 && $y < 0){
            return 'Тупой правый либераст';
        }
        else if ($x < 0 && $y < 0){
            return 'Тупой левый либераст';
        }
        else
            return 'Тупой центрист';
    }


    session_start();

    date_default_timezone_set('Europe/Moscow');

    $start = microtime(true);


    $x = (double) $_GET['x'];
    $y = (double) str_replace(",",".",$_GET['y']);
    $r = (double) $_GET['r'];

    if (firstCheck($x,$y,$r)){
        http_response_code(400);
        return;
    }

    $result = checkArea($x,$y,$r);
    $polit = checkPolitical($x,$y);
    $time = number_format( microtime(true) - $start,10, ".", "")*1000000;
    $currentTime = date("H:i:s");

    $political_result = array($result,$x,$y,$r,$currentTime,$time,$polit);

    if(!isset($_SESSION['queue'])){
        $_SESSION['queue'] = array();
    }

    array_push($_SESSION['queue'],$political_result);

    echo '<table  border="1" class="resultForm">
        <tr>
            <th width="100">Попал?</th>
            <th>Координата X</th>
            <th>Координата Y</th>
            <th>Радиус</th>
            <th>Текущее время</th>
            <th>Врамя запроса</th>
            <th width="250">Кто ты.</th>
            </tr>';
            foreach ($_SESSION['queue'] as $queue)
            {
                echo "<tr>
                <td>$queue[0]</td>
                <td>$queue[1]</td>
                <td>$queue[2]</td>
                <td>$queue[3]</td>
                <td>$queue[4]</td>
                <td>$queue[5]</td>
                <td>$queue[6]</td>
                </tr>";
            }
    echo'</table>';

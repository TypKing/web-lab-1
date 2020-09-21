<?php
    session_start();

    if (isset($_SESSION['queue'])) {
        $_SESSION['queue'] = array();
    }
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
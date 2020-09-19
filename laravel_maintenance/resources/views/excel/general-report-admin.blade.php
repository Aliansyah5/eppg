<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>General Report</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th><b>Status</b></th>
                <th><b>Ticket No</b></th>
                <th><b>Subject</b></th>
                <th><b>Requester</b></th>
                <th><b>Description</b></th>
                <th><b>Request Date</b></th>
                <th><b>Category</b></th>
                <th><b>Priority</b></th>
                <th><b>Start Date</b></th>
                <th><b>Assignee</b></th>
                <th><b>Answer by</b></th>
                <th><b>Request Close</b></th>
                <th><b>Request Close by</b></th>
                <th><b>Close</b></th>
                <th><b>Close by</b></th>
                <th><b>Comment (A:Assignee R:Requester)</b></th>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach($data as $item):
                $data_comment = getComment($item->id);
                $comment = "";
                foreach ($data_comment as $detail):
                    $user = "A";
                    if ($detail->name == "njing"){
                        $user = "R";
                    }
                    $text = $user." : ".$detail->comment." || ";
                    $comment .= $text;
                endforeach;
                $panjang = strlen($comment)-4;
                $comment = substr($comment, 0, $panjang);
        ?>
            <tr>
                <td ><?=$item->Setatus;?></td>
                <td >{{ $item->Ticket_No }}</td>
                <td >{{ $item->Title }}</td>
                <td >{{ $item->Requester }}</td>
                <td >{{ $item->Description }}</td>
                <td >{{ $item->Request_Date }}</td>
                <td >{{ $item->Category }}</td>
                <td >
                    <?php
                        $text = "";
                        if ($item->Priority == "3H"){
                            $text = "Minor";
                        } else 
                        if ($item->Priority == "9H"){
                            $text = "Major";
                        }
                        echo $text;

                    ?>
                </td>
                <td >{{ $item->Start_Date }}</td>
                <td >{{ $item->Assignee }}</td>
                <td >{{ $item->Answer_By }}</td>
                <td >{{ $item->Request_Close_Date }}</td>
                <td >{{ $item->Request_Close_By }}</td>
                <td >{{ $item->Close_Date }}</td>
                <td >{{ $item->Close_By }}</td>
                <td >{{ $comment }}</td>
            </tr>
        <?php
            endforeach;
        ?>
        </tbody>
    </table>    
</body>
</html>
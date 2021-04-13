<?php

trait ExternalDBHandle
{
    public function external_query($query)
    {
        $result = [];
        global $database;
        $conn = new mysqli($database['host'], $database['user'], $database['password'], 'ppp');
        $res = $conn->query($query);
        if($res->num_rows)
            while($row = $res->fetch_assoc()) 
                array_push($result, $row);
        return $result;
    }
}

?>
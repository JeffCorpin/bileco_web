<?php
    $mysqli = new mysqli("localhost", "root", "", "bileco_system");

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $sql = "SELECT date, bill FROM bill";  // Only select required columns
    $res = $mysqli->query($sql);

    $data = [];

    while ($row = $res->fetch_assoc()) {
        $data[] = [
            "date" => $row["date"],
            "bill" => (float)$row["bill"] // Convert bill to float
        ];
    }

    echo json_encode($data);
?>

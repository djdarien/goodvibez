<?php
session_start();
$filename = "counter.txt";

if (!file_exists($filename)) {
    file_put_contents($filename, json_encode(["recent" => 0, "previous" => 0, "community" => 0]));
}

$data = json_decode(file_get_contents($filename), true);

if (isset($_GET['section'])) {
    $section = $_GET['section'];
    if (array_key_exists($section, $data)) {
        $data[$section]++;
        file_put_contents($filename, json_encode($data));
    }
}

echo json_encode($data);
?>

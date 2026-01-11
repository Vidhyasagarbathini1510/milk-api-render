<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include("db.php");

$ID = $_GET['ID'] ?? '';
$TableName = $_GET['TableName'] ?? '';

/* ID Validation */
if ($ID !== "IMIE7075118212") {
    echo json_encode([
        "status" => false,
        "message" => "Invalid ID"
    ]);
    exit;
}

if ($TableName == '') {
    echo json_encode([
        "status" => false,
        "message" => "TableName missing"
    ]);
    exit;
}

$sql = "SELECT 
            id AS SNo,
            party AS Party,
            contact AS Contact,
            village AS Village,
            qty AS Qty,
            amount AS Amount,
            notes AS Notes,
            action AS Action
        FROM $TableName";

$result = mysqli_query($conn, $sql);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode([
    "status" => true,
    "ID" => $ID,
    "TableName" => $TableName,
    "count" => count($data),
    "data" => $data
]);
?>

<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include "db.php";

$ID = $_GET['ID'] ?? '';
$TableName = $_GET['TableName'] ?? '';

/* API KEY VALIDATION */
if ($ID !== "IMIE7075118212") {
    echo json_encode([
        "status" => false,
        "message" => "Invalid API ID"
    ]);
    exit;
}

/* TABLE NAME REQUIRED */
if (empty($TableName)) {
    echo json_encode([
        "status" => false,
        "message" => "TableName is required"
    ]);
    exit;
}

/* ALLOWED TABLES (SECURITY) */
$allowedTables = ["sales"];

if (!in_array($TableName, $allowedTables)) {
    echo json_encode([
        "status" => false,
        "message" => "Unauthorized table access"
    ]);
    exit;
}

/* QUERY */
$sql = "
    SELECT
        id AS SNo,
        party AS Party,
        contact AS Contact,
        village AS Village,
        qty AS Qty,
        amount AS Amount,
        notes AS Notes,
        action AS Action
    FROM `$TableName`
";

$result = mysqli_query($conn, $sql);

if (!$result) {
    echo json_encode([
        "status" => false,
        "message" => mysqli_error($conn)
    ]);
    exit;
}

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

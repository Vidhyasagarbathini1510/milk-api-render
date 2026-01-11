<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

include("db.php");

$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode([
        "status" => false,
        "message" => "JSON not received"
    ]);
    exit;
}

$party   = $data['party'] ?? '';
$contact = $data['contact'] ?? '';
$village = $data['village'] ?? '';
$qty     = $data['qty'] ?? 0;
$amount  = $data['amount'] ?? 0;
$notes   = $data['notes'] ?? '';
$action  = $data['action'] ?? '';

$sql = "INSERT INTO sales 
        (party, contact, village, qty, amount, notes, action)
        VALUES
        ('$party','$contact','$village','$qty','$amount','$notes','$action')";

if (mysqli_query($conn, $sql)) {
    echo json_encode([
        "status" => true,
        "message" => "Sales data inserted successfully"
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "Insert failed"
    ]);
}
?>

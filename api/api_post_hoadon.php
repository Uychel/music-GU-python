<?php
include 'db.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['MaKH']) && isset($data['TongTien'])) {
    $MaKH = intval($data['MaKH']);
    $TongTien = floatval($data['TongTien']);
    $NgayLap = date('Y-m-d');

    $sql = "INSERT INTO hoadon (MaKH, NgayLap, TongTien)
            VALUES ('$MaKH', '$NgayLap', '$TongTien')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "MaHD" => $conn->insert_id]);
    } else {
        echo json_encode(["status" => "error", "message" => $conn->error]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Thiếu dữ liệu hóa đơn"]);
}
?>

<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "db.php";

$sql = "
    SELECT 
        hd.MaHD, 
        hd.NgayLap, 
        hd.TongTien, 
        kh.TenKH, 
        kh.SoDienThoai, 
        kh.Email
    FROM hoadon hd
    JOIN khachhang kh ON hd.MaKH = kh.MaKH
    ORDER BY hd.NgayLap DESC
";

$result = $conn->query($sql);
$data = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode([
        "status" => "success",
        "data" => $data
    ], JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Lỗi truy vấn: " . $conn->error
    ], JSON_UNESCAPED_UNICODE);
}

$conn->close();
?>

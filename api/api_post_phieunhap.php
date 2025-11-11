<?php
include 'db.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['MaCongTy']) && isset($data['MaNV']) && isset($data['TongTien'])) {
    $MaCongTy = intval($data['MaCongTy']);
    $MaNV = intval($data['MaNV']);
    $TongTien = floatval($data['TongTien']);
    $NgayNhap = date('Y-m-d');

    $sql = "INSERT INTO phieunhap (NgayNhap, MaCongTy, MaNV, TongTien)
            VALUES ('$NgayNhap', '$MaCongTy', '$MaNV', '$TongTien')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "MaPhieuNhap" => $conn->insert_id]);
    } else {
        echo json_encode(["status" => "error", "message" => $conn->error]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Thiếu dữ liệu phiếu nhập"]);
}
?>

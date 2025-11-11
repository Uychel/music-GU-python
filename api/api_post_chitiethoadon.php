<?php
include 'db.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (
    isset($data['MaHD']) &&
    isset($data['MaSanPham']) &&
    isset($data['SoLuong']) &&
    isset($data['DonGiaBan'])
) {
    $MaHD = intval($data['MaHD']);
    $MaSanPham = intval($data['MaSanPham']);
    $SoLuong = intval($data['SoLuong']);
    $DonGiaBan = floatval($data['DonGiaBan']);
    $ThanhTien = $SoLuong * $DonGiaBan;

    $sql = "INSERT INTO chitiethoadon (MaHD, MaSanPham, SoLuong, DonGiaBan, ThanhTien)
            VALUES ('$MaHD', '$MaSanPham', '$SoLuong', '$DonGiaBan', '$ThanhTien')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "id" => $conn->insert_id]);
    } else {
        echo json_encode(["status" => "error", "message" => $conn->error]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Thiếu dữ liệu chi tiết hóa đơn"]);
}
?>

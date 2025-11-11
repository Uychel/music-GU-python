<?php
include 'db.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (
    isset($data['TenSanPham']) &&
    isset($data['DonGia']) &&
    isset($data['SoLuongTon']) &&
    isset($data['DonViTinh']) &&
    isset($data['MaLoai']) &&
    isset($data['MaDanhMuc'])
) {
    $TenSanPham = $conn->real_escape_string($data['TenSanPham']);
    $DonGia = floatval($data['DonGia']);
    $SoLuongTon = intval($data['SoLuongTon']);
    $DonViTinh = $conn->real_escape_string($data['DonViTinh']);
    $MaLoai = intval($data['MaLoai']);
    $MaDanhMuc = intval($data['MaDanhMuc']);
    $MoTa = isset($data['MoTa']) ? $conn->real_escape_string($data['MoTa']) : '';

    $sql = "INSERT INTO sanpham (TenSanPham, DonGia, SoLuongTon, DonViTinh, MaLoai, MaDanhMuc, MoTa)
            VALUES ('$TenSanPham', '$DonGia', '$SoLuongTon', '$DonViTinh', '$MaLoai', '$MaDanhMuc', '$MoTa')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "id" => $conn->insert_id]);
    } else {
        echo json_encode(["status" => "error", "message" => $conn->error]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Thiếu dữ liệu sản phẩm"]);
}
?>

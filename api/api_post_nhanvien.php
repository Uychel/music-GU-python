<?php
include 'db.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['TenNV']) && isset($data['ChucVu']) && isset($data['SoDienThoai'])) {
    $TenNV = $conn->real_escape_string($data['TenNV']);
    $ChucVu = $conn->real_escape_string($data['ChucVu']);
    $SoDienThoai = $conn->real_escape_string($data['SoDienThoai']);
    $NgayVaoLam = date('Y-m-d');

    $sql = "INSERT INTO nhanvien (TenNV, ChucVu, SoDienThoai, NgayVaoLam)
            VALUES ('$TenNV', '$ChucVu', '$SoDienThoai', '$NgayVaoLam')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "MaNV" => $conn->insert_id]);
    } else {
        echo json_encode(["status" => "error", "message" => $conn->error]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Thiếu dữ liệu nhân viên"]);
}
?>

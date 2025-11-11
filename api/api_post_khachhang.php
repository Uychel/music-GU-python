<?php
include 'db.php';
header('Content-Type: application/json; charset=UTF-8');

$data = json_decode(file_get_contents("php://input"), true);

if (
    isset($data['TenKH']) &&
    isset($data['SoDienThoai']) &&
    isset($data['DiaChi']) &&
    isset($data['Email']) &&
    isset($data['MatKhau'])
) {
    $TenKH = $conn->real_escape_string($data['TenKH']);
    $SoDienThoai = $conn->real_escape_string($data['SoDienThoai']);
    $DiaChi = $conn->real_escape_string($data['DiaChi']);
    $Email = $conn->real_escape_string($data['Email']);
    
    // ✅ Giữ mã hóa mật khẩu an toàn
    $MatKhau = password_hash($data['MatKhau'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO khachhang (TenKH, SoDienThoai, DiaChi, Email, MatKhau)
            VALUES ('$TenKH', '$SoDienThoai', '$DiaChi', '$Email', '$MatKhau')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "MaKH" => $conn->insert_id]);
    } else {
        echo json_encode(["status" => "error", "message" => $conn->error]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Thiếu dữ liệu khách hàng"]);
}
?>

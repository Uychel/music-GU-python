<?php
include 'db.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['TenCongTy']) && isset($data['DiaChi']) && isset($data['DienThoai']) && isset($data['Email'])) {
    $TenCongTy = $conn->real_escape_string($data['TenCongTy']);
    $DiaChi = $conn->real_escape_string($data['DiaChi']);
    $DienThoai = $conn->real_escape_string($data['DienThoai']);
    $Email = $conn->real_escape_string($data['Email']);

    $sql = "INSERT INTO congty (TenCongTy, DiaChi, DienThoai, Email)
            VALUES ('$TenCongTy', '$DiaChi', '$DienThoai', '$Email')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "MaCongTy" => $conn->insert_id]);
    } else {
        echo json_encode(["status" => "error", "message" => $conn->error]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Thiếu dữ liệu công ty"]);
}
?>

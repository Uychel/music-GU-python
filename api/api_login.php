<?php
include 'db.php';
header('Content-Type: application/json; charset=UTF-8');

$data = json_decode(file_get_contents("php://input"), true);

$email = $data["email"] ?? "";
$password = $data["password"] ?? "";

if (empty($email) || empty($password)) {
    echo json_encode(["status" => "error", "message" => "Vui lòng nhập email và mật khẩu."]);
    exit;
}

$sql = "SELECT * FROM khachhang WHERE Email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(["status" => "error", "message" => "Email không tồn tại."]);
    exit;
}

$user = $result->fetch_assoc();

// ✅ Kiểm tra mật khẩu hash
if (password_verify($password, $user['MatKhau'])) {
    echo json_encode([
        "status" => "success",
        "message" => "Đăng nhập thành công!",
        "user" => [
            "MaKH" => $user["MaKH"],
            "TenKH" => $user["TenKH"],
            "Email" => $user["Email"]
        ]
    ]);
} else {
    echo json_encode(["status" => "error", "message" => "Sai mật khẩu."]);
}
?>

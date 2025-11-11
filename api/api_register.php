<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

// Kết nối CSDL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlshoppet";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Kết nối CSDL thất bại: " . $conn->connect_error]));
}

// Lấy dữ liệu JSON từ frontend
$data = json_decode(file_get_contents("php://input"), true);

$tenkh = $data["tenkh"] ?? "";
$email = $data["email"] ?? "";
$matkhau = $data["matkhau"] ?? "";
$vaitro = "customer"; // mặc định

if (empty($tenkh) || empty($email) || empty($matkhau)) {
    echo json_encode(["success" => false, "message" => "Vui lòng nhập đầy đủ thông tin."]);
    exit;
}

// Kiểm tra email đã tồn tại chưa
$check = $conn->prepare("SELECT * FROM khachhang WHERE Email = ?");
$check->bind_param("s", $email);
$check->execute();
$result = $check->get_result();

if ($result->num_rows > 0) {
    echo json_encode(["success" => false, "message" => "Email đã được sử dụng."]);
    exit;
}

// Thêm người dùng (KHÔNG HASH mật khẩu)
$stmt = $conn->prepare("INSERT INTO khachhang (tenkh, Email, matkhau, vaitro) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $tenkh, $email, $matkhau, $vaitro);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Đăng ký thành công!"]);
} else {
    echo json_encode(["success" => false, "message" => "Lỗi khi thêm người dùng: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>

<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once "db.php";

$sql = "
    SELECT lsp.MaLoai, lsp.TenLoai, lsp.MoTa, dm.TenDanhMuc
    FROM loaisanpham lsp
    JOIN danhmuc dm ON lsp.MaDanhMuc = dm.MaDanhMuc
    ORDER BY lsp.MaLoai ASC
";
$result = $conn->query($sql);
$data = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode(["status" => "success", "data" => $data], JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(["status" => "error", "message" => $conn->error], JSON_UNESCAPED_UNICODE);
}

$conn->close();
?>

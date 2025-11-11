<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once "db.php";

$sql = "SELECT sp.MaSanPham, sp.TenSanPham, sp.DonGia, sp.SoLuongTon, sp.DonViTinh, 
               sp.MoTa, lsp.TenLoai, dm.TenDanhMuc
        FROM sanpham sp
        JOIN loaisanpham lsp ON sp.MaLoai = lsp.MaLoai
        JOIN danhmuc dm ON sp.MaDanhMuc = dm.MaDanhMuc
        ORDER BY sp.MaSanPham DESC";

$result = $conn->query($sql);
$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode(["status" => "success", "data" => $data], JSON_UNESCAPED_UNICODE);
$conn->close();
?>

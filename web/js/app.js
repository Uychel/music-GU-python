async function login() {
  const email = document.getElementById("email").value.trim();
  const password = document.getElementById("password").value.trim();

  if (!email || !password) {
    alert("⚠️ Vui lòng nhập email và mật khẩu!");
    return;
  }

  try {
    const res = await fetch("../api/api_login.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ email, password }),
    });

    const data = await res.json();

    if (data.status === "success") {
      alert("🎉 Đăng nhập thành công!");
      window.location.href = "index.html"; // ✅ chuyển sang trang chính
    } else {
      alert("❌ " + data.message);
    }
  } catch (error) {
    console.error(error);
    alert("🚫 Không thể kết nối máy chủ!");
  }
}
async function addSanPham() {
  const sp = {
    TenSP: document.getElementById("TenSP").value,
    DonGia: document.getElementById("DonGia").value,
    SoLuongTon: document.getElementById("SoLuongTon").value,
    DonViTinh: document.getElementById("DonViTinh").value,
    MaDanhMuc: document.getElementById("MaDanhMuc").value,
    MoTa: document.getElementById("MoTa").value
  };

  const res = await fetch("../api/api_post_sanpham.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(sp)
  });

  const data = await res.json();
  alert(data.status === "success" ? "Thêm thành công!" : "Lỗi khi thêm sản phẩm");
}
async function register() {
  const TenKH = document.getElementById("TenKH").value.trim();
  const SoDienThoai = document.getElementById("SoDienThoai").value.trim();
  const DiaChi = document.getElementById("DiaChi").value.trim();
  const Email = document.getElementById("Email").value.trim();
  const MatKhau = document.getElementById("MatKhau").value.trim();

  if (!TenKH || !SoDienThoai || !DiaChi || !Email || !MatKhau) {
    alert("⚠️ Vui lòng nhập đầy đủ thông tin!");
    return;
  }

  try {
    // Gọi đến API PHP để thêm khách hàng (đã bỏ hash mật khẩu)
    const res = await fetch("../api/api_post_khachhang.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ TenKH, SoDienThoai, DiaChi, Email, MatKhau }),
    });

    const result = await res.json();

    if (result.status === "success") {
      alert("🎉 Đăng ký thành công!");
      window.location.href = "dangnhap.html"; // ← đổi link nếu cần
    } else {
      alert("❌ " + result.message);
    }
  } catch (error) {
    console.error(error);
    alert("🚫 Lỗi khi kết nối đến máy chủ!");
  }
}

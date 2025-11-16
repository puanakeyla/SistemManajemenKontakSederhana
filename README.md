# 📇 Sistem Manajemen Kontak Sederhana

Aplikasi web untuk mengelola daftar kontak dengan fitur CRUD menggunakan PHP murni dan Tailwind CSS.

**Puan Akeyla** - NPM: 2315061070

---

## 📋 Spesifikasi Sistem

### 1️⃣ Form Tambah Kontak dengan Validasi
- Validasi nama (regex: `/^[a-zA-Z\s\.]+$/`)
- Validasi email (filter_var FILTER_VALIDATE_EMAIL)
- Validasi telepon (regex: `/^[0-9+\-\s\(\)]+$/`)
- Validasi alamat (wajib diisi)
- Error message per field

### 2️⃣ Tampilan Daftar Kontak
- Tabel responsif dengan semua data kontak
- HTML escaping (XSS prevention)
- Empty state handling
- Hover effect pada baris

### 3️⃣ Fitur Edit dan Hapus
- Edit: Form pre-filled dengan data existing
- Edit: Update data ke JSON file
- Hapus: Konfirmasi sebelum hapus
- Hapus: Redirect ke dashboard

### 4️⃣ Session Management
- Login: `session_start()` dan set `$_SESSION['logged_in']`
- Proteksi: `checkAuth()` di setiap halaman
- Logout: `session_destroy()` dan redirect
- Username: `Akeyla`, Password: `TA4`

---

## 📁 Struktur File

```
├── config.php           # Helper functions (readContacts, saveContacts, checkAuth)
├── login.php            # Login + session
├── index.php            # Dashboard (Read)
├── add-contact.php      # Create + validasi
├── edit-contact.php     # Update + validasi
├── delete-contact.php   # Delete
├── logout.php           # Logout
└── contacts.json        # Database JSON
```

---

Made by Puan Akeyla

# 📁 DOKUMENTASI REORGANISASI FILE WISATAKU

## ✅ Status Reorganisasi

Berikut adalah struktur folder baru yang telah dibuat:

```
c:\xampp\htdocs\PJBL\
├── index.html (✅ SUDAH DIUPDATE - landing page)
├── landing.css
├── admin/
│   └── index.html (perlu update paths gambar → ../images/)
├── PJBL WEB/ (tourism pages - tetap di lokasi)
├── auth/
│   ├── login.html (✅ DIBUAT - paths sudah benar)
│   ├── login.css (✅ DIBUAT)
│   ├── regrist.html (✅ DIBUAT - paths sudah benar)
│   └── regrist.css (✅ DIBUAT)
├── dashboard/
│   ├── home.html (perlu dibuat - template di bawah)
│   ├── home.css
│   ├── contoh.html
│   └── (perlu update semua paths)
├── user/
│   ├── profile.html (✅ DIBUAT - paths sudah benar)
│   ├── profile.css (✅ DIBUAT)
│   ├── akun.html (perlu dibuat dengan paths benar)
│   └── akun.css
├── orders/
│   ├── pesanan.html (perlu dibuat)
│   ├── pesanan.css
│   ├── riwayat.html (perlu dibuat)
│   ├── riwayat.css
│   ├── pembayaran.html (perlu dibuat)
│   └── pembayaran.css
├── wishlist/
│   ├── whistlist.html (perlu dibuat)
│   ├── whistlist.css
│   └── whislist2.html
├── help/
│   ├── bantuan.html (perlu dibuat)
│   └── bantuan.css
├── images/ (✅ DIBUAT - semua .png dan .jpg sudah dikopy)
└── tentang.html (tetap di root)
```

## 📋 MAPPING PATHS YANG PERLU DIUPDATE

### 1️⃣ File di FOLDER `auth/` (Login & Registrasi)
**Status: ✅ SUDAH DIBUAT DENGAN PATHS BENAR**

- `login.html` - paths sudah benar:
  - Logo: `../images/logo.png`
  - Home link: `../dashboard/home.html`
  - Regrist link: `./regrist.html`

- `regrist.html` - paths sudah benar:
  - Logo: `../images/logo.png`
  - Login link: `./login.html`

---

### 2️⃣ File di FOLDER `dashboard/` (Home Page)
**Status: ⏳ PERLU DIBUAT**

**home.html paths yang perlu diupdate:**
```
- <link rel="stylesheet" href="home.css">
- Profile link (navbar): ../user/profile.html
- Home link: ./home.html
- Favorite link: ../wishlist/whistlist.html
- Tentang Kami: ../tentang.html
- Profile image: ../images/dapin kecil.jpg
- Category images: ../images/Wisata Alam.png, etc
- Social media icons: ../images/Instagram.png, etc
```

---

### 3️⃣ File di FOLDER `user/` (Profil User)
**Status: ✅ SUDAH DIBUAT (profile.html)**

**Untuk file lain di user folder:**

#### `akun.html` (Pengaturan Akun) - paths perlu diupdate:
```
- <link rel="stylesheet" href="akun.css">
- Profile link: ./profile.html
- Pesanan link: ../orders/pesanan.html
- Riwayat link: ../orders/riwayat.html
- Pembayaran link: ../orders/pembayaran.html
- Wishlist link: ../wishlist/whistlist.html
- Bantuan link: ../help/bantuan.html
- Home link: ../dashboard/home.html
```

---

### 4️⃣ File di FOLDER `orders/` (Pesanan, Riwayat, Pembayaran)
**Status: ⏳ PERLU DIBUAT**

**Semua file dalam folder ini harus memiliki links:**
```
- Profile link: ../user/profile.html
- Pesanan link: ./pesanan.html
- Riwayat link: ./riwayat.html
- Pembayaran link: ./pembayaran.html
- Wishlist link: ../wishlist/whistlist.html
- Akun link: ../user/akun.html
- Bantuan link: ../help/bantuan.html
- Home link: ../dashboard/home.html
```

---

### 5️⃣ File di FOLDER `wishlist/` (Wishlist)
**Status: ⏳ PERLU DIBUAT**

**whistlist.html paths yang perlu diupdate:**
```
- Semua link ke user pages → ../user/ atau ../dashboard/
- Semua image paths → ../images/
```

---

### 6️⃣ File di FOLDER `help/` (Bantuan)
**Status: ⏳ PERLU DIBUAT**

**bantuan.html paths yang perlu diupdate:**
```
- Semua navigation links → ../ + folder/file
- Home link: ../dashboard/home.html
```

---

## 🔧 CARA MENGUPDATE FILE YANG MASIH LAMA

### Untuk setiap file yang masih di root folder, Anda perlu:

1. **Copy file ke folder yang sesuai**
2. **Update semua paths:**

#### Path conversions reference:
```
LOGIN/REGISTRASI FILES (dari root → auth/)
- login.html → auth/login.html
- regrist.html → auth/regrist.html

HOME FILES (dari root → dashboard/)
- home.html → dashboard/home.html

PROFILE FILES (dari root → user/)
- profile.html → user/profile.html
- akun.html → user/akun.html

ORDER FILES (dari root → orders/)
- pesanan.html → orders/pesanan.html
- riwayat.html → orders/riwayat.html
- pembayaran.html → orders/pembayaran.html

WISHLIST FILES (dari root → wishlist/)
- whistlist.html → wishlist/whistlist.html
- whislist2.html → wishlist/whislist2.html

HELP FILES (dari root → help/)
- bantuan.html → help/bantuan.html

IMAGE FILES (dari root → images/)
- *.png → images/
- *.jpg → images/
```

---

## 📝 TEMPLATE UNTUK INTERNAL LINKS

Gunakan template ini ketika mengupdate links antar halaman:

### Dari file di `auth/` folder:
```html
<a href="../dashboard/home.html">Home</a>
<a href="./login.html">Login</a>
<a href="./regrist.html">Register</a>
```

### Dari file di `dashboard/` folder:
```html
<a href="./home.html">Home</a>
<a href="../user/profile.html">Profile</a>
<a href="../auth/login.html">Login</a>
<a href="../orders/pesanan.html">Orders</a>
<a href="../help/bantuan.html">Help</a>
<a href="../images/logo.png">Image</a>
```

### Dari file di `user/` folder:
```html
<a href="./profile.html">My Profile</a>
<a href="./akun.html">Account Settings</a>
<a href="../orders/pesanan.html">My Orders</a>
<a href="../dashboard/home.html">Home</a>
```

### Image references (dari folder manapun):
```html
<!-- Dari auth/ -->
<img src="../images/logo.png">

<!-- Dari dashboard/ -->
<img src="../images/logo.png">

<!-- Dari user/ -->
<img src="../images/logo.png">

<!-- Dari orders/ -->
<img src="../images/logo.png">
```

---

## 🚀 LANGKAH BERIKUTNYA

1. **Copy sisa file ke folder yang sesuai** (atau manual rename/move)
2. **Update CSS link pada setiap file HTML** - sudah sesuai nama folder
3. **Update semua href dan src** menggunakan template di atas
4. **Test setiap halaman** untuk memastikan links dan images berfungsi

---

## ✨ CATATAN PENTING

✅ **Sudah selesai:**
- Folder structure dibuat
- Images dikopy ke `images/` folder
- `index.html` diupdate dengan image paths benar
- `auth/login.html` dibuat dengan paths benar
- `auth/regrist.html` dibuat dengan paths benar
- `user/profile.html` dibuat dengan paths benar

⏳ **Masih perlu diupdate:**
- File lain di `dashboard/`, `user/`, `orders/`, `wishlist/`, `help/` folders
- Relative paths dalam semua HTML files
- CSS files jika ada references ke images

---

## 💡 TIPS MENGGUNAKAN FIND & REPLACE

Di VS Code, gunakan **Find & Replace** (Ctrl+H) untuk batch update:

**Contoh:** Update profile.html reference
- Find: `href="profile.html"`
- Replace: `href="../user/profile.html"`

**Contoh:** Update image references  
- Find: `src="` (pilih file HTML)
- Replace dengan `src="../images/` sesuai kebutuhan

---

Untuk pertanyaan lebih lanjut atau bantuan, silakan hubungi developer! 🎉

# Revisi Sistem Pemesanan Web

## 1. Penghapusan Fitur Autentikasi Customer

**Tujuan:** Mempercepat proses transaksi dengan menghilangkan hambatan pendaftaran akun.

- **Hapus Fitur Registrasi:** Sistem tidak lagi memerlukan pembuatan akun untuk pengguna baru.
- **Hapus Fitur Login:** Akses ke dalam sistem tidak memerlukan proses autentikasi (tanpa _email/password_).
- **Akses Langsung:** Customer yang membuka web dapat langsung diarahkan ke halaman katalog menu dan bisa langsung melakukan _checkout_ pesanan.

---

## 2. Penyesuaian Varian Topping Menu Snack

**Tujuan:** Menghindari kebingungan varian tambahan antara kategori makanan dan minuman.

- **Pemisahan Data Topping:** Pisahkan _database_ atau pilihan topping antara kategori **Snack** dan **Coffee** (saat ini masih terduplikasi).
- **Kustomisasi Topping Snack:** Ubah dan sesuaikan daftar topping pada menu Snack agar relevan khusus untuk makanan ringan (contoh: saus sambal, mayones, bumbu tabur), sehingga tidak lagi memunculkan topping minuman (seperti _shot espresso_, _oat milk_, dll).

---

## 3. Alur Pemesanan Berbasis Nomor Meja (Tanpa Nama)

**Tujuan:** Menyederhanakan input data saat _dine-in_ dengan mengandalkan lokasi meja sebagai identifikasi pesanan.

- **Hapus Input Nama:** Hilangkan _field_ pengisian "Nama Customer" pada halaman _checkout_.
- **Alur Flow Pemesanan Baru:**

1. Customer datang ke _coffee shop_ dan langsung mengakses web pemesanan.
2. Customer memilih menu (_Coffee_ / _Snack_) dan menambahkannya ke keranjang.
3. Saat _checkout_, customer wajib mengisi **Nomor Meja** (_Table Number_) tempat mereka duduk.
4. Customer melanjutkan ke tahap pembayaran.

- **Identifikasi Pesanan:** Sistem sepenuhnya akan mengenali dan memproses pesanan berdasarkan **Nomor Meja**, tanpa perlu menautkannya ke nama atau ID Akun tertentu.

CREATE DATABASE tarhilala_database;
USE tarhilala_database;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    nomor_telepon VARCHAR(20) NOT NULL,
    PASSWORD VARCHAR(255) NOT NULL,
    ALTER TABLE users CHANGE PASSWORD PASSWORD VARCHAR(255);
    role ENUM('nasabah','petugas','admin') NOT NULL,
    reset_token VARCHAR(255),
    reset_token_expired_at DATETIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE jenis_sampah (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    kategori VARCHAR(100),
    deskripsi TEXT,
    harga_per_kg DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE rute (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_rute VARCHAR(100),
    wilayah TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE jadwal_penjemputan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    rute_id INT,
    driver_id INT,
    hari ENUM('senin','selasa','rabu','kamis','jumat','sabtu','minggu'),
    jam_mulai TIME,
    jam_selesai TIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (rute_id) REFERENCES rute(id),
    FOREIGN KEY (driver_id) REFERENCES users(id)
);

CREATE TABLE setoran (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nasabah_id INT NOT NULL,
    jadwal_id INT,
    tanggal_pengajuan DATETIME DEFAULT CURRENT_TIMESTAMP,
    STATUS ENUM('menunggu','diproses','dijemput','selesai','dibatalkan') DEFAULT 'menunggu',
    total_berat DECIMAL(10,2),
    total_harga DECIMAL(12,2),
    catatan TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (nasabah_id) REFERENCES users(id),
    FOREIGN KEY (jadwal_id) REFERENCES jadwal_penjemputan(id)
);

CREATE TABLE detail_setoran (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setoran_id INT NOT NULL,
    jenis_sampah_id INT NOT NULL,
    berat DECIMAL(10,2) NOT NULL,
    harga_satuan DECIMAL(10,2) NOT NULL,
    subtotal DECIMAL(12,2) NOT NULL,
    FOREIGN KEY (setoran_id) REFERENCES setoran(id),
    FOREIGN KEY (jenis_sampah_id) REFERENCES jenis_sampah(id)
);

CREATE TABLE foto_setoran (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setoran_id INT,
    image_path VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (setoran_id) REFERENCES setoran(id)
);

CREATE TABLE validasi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setoran_id INT,
    image_path VARCHAR(255),
    hasil_ai ENUM('medis','non_medis'),
    confidence_score DECIMAL(5,4),
    hasil_petugas ENUM('medis','non_medis'),
    status_validasi ENUM('menunggu','valid','ditolak') DEFAULT 'menunggu',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (setoran_id) REFERENCES setoran(id)
);

CREATE TABLE tabungan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nasabah_id INT UNIQUE,
    saldo DECIMAL(15,2) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (nasabah_id) REFERENCES users(id)
);

CREATE TABLE transaksi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nasabah_id INT NOT NULL,
    setoran_id INT,
    jenis ENUM('setoran','penarikan','penukaran_poin'),
    jumlah DECIMAL(15,2) NOT NULL,
    STATUS ENUM('pending','berhasil','ditolak') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (nasabah_id) REFERENCES users(id),
    FOREIGN KEY (setoran_id) REFERENCES setoran(id)
);

CREATE TABLE penarikan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nasabah_id INT,
    jumlah DECIMAL(15,2),
    metode VARCHAR(100),
    STATUS ENUM('menunggu','diproses','selesai','ditolak') DEFAULT 'menunggu',
    tanggal_pengajuan DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (nasabah_id) REFERENCES users(id)
);

CREATE TABLE invoice (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setoran_id INT,
    nomor_invoice VARCHAR(100) UNIQUE,
    total_bayar DECIMAL(15,2),
    file_invoice VARCHAR(255),
    tanggal_invoice DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (setoran_id) REFERENCES setoran(id)
);

CREATE TABLE edukasi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(200),
    isi TEXT,
    gambar VARCHAR(255),
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(id)
);

CREATE TABLE notifikasi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    judul VARCHAR(200),
    pesan TEXT,
    is_read BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE chat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pengirim_id INT,
    penerima_id INT,
    pesan TEXT,
    is_read BOOLEAN DEFAULT FALSE,
    waktu_kirim DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (pengirim_id) REFERENCES users(id),
    FOREIGN KEY (penerima_id) REFERENCES users(id)
);

CREATE TABLE poin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nasabah_id INT UNIQUE,
    total_poin INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (nasabah_id) REFERENCES users(id)
);

CREATE TABLE reward (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_reward VARCHAR(200),
    deskripsi TEXT,
    poin_dibutuhkan INT,
    stok INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE penukaran_reward (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nasabah_id INT,
    reward_id INT,
    STATUS ENUM('menunggu','diproses','selesai','ditolak') DEFAULT 'menunggu',
    tanggal_penukaran DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (nasabah_id) REFERENCES users(id),
    FOREIGN KEY (reward_id) REFERENCES reward(id)
);
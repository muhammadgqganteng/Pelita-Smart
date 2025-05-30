Berikut adalah perkiraan tabel-tabel yang mungkin kamu butuhkan beserta kolom-kolomnya:

1. users

id (BIGINT UNSIGNED, PRIMARY KEY, AUTO_INCREMENT)
name (VARCHAR, 255, NOT NULL)
email (VARCHAR, 255, UNIQUE, NOT NULL)
password (VARCHAR, 255, NOT NULL)
role1 (ENUM: 'murid', 'guru', 'admin', NOT NULL, DEFAULT 'murid')   
1.
github.com
github.com
kelas_id (BIGINT UNSIGNED, FOREIGN KEY ke kelas, NULLABLE)
jurusan_id (BIGINT UNSIGNED, FOREIGN KEY ke jurusan, NULLABLE)
nip (VARCHAR, 20, NULLABLE)
mata_pelajaran_diampu (TEXT, NULLABLE)
email_verified_at (TIMESTAMP, NULLABLE)
remember_token (VARCHAR, 100, NULLABLE)
created_at (TIMESTAMP, NULLABLE)
updated_at (TIMESTAMP, NULLABLE)
2. kelas

id (BIGINT UNSIGNED, PRIMARY KEY, AUTO_INCREMENT)
nama_kelas (VARCHAR, 50, UNIQUE, NOT NULL)
created_at (TIMESTAMP, NULLABLE)
updated_at (TIMESTAMP, NULLABLE)
3. jurusan

id (BIGINT UNSIGNED, PRIMARY KEY, AUTO_INCREMENT)
nama_jurusan (VARCHAR, 100, UNIQUE, NOT NULL)
created_at (TIMESTAMP, NULLABLE)
updated_at (TIMESTAMP, NULLABLE)
4. mata_pelajaran

id (BIGINT UNSIGNED, PRIMARY KEY, AUTO_INCREMENT)
nama_mapel (VARCHAR, 100, UNIQUE, NOT NULL)
deskripsi (TEXT, NULLABLE)
created_at (TIMESTAMP, NULLABLE)
updated_at (TIMESTAMP, NULLABLE)
5. materi_belajar

id (BIGINT UNSIGNED, PRIMARY KEY, AUTO_INCREMENT)
judul (VARCHAR, 255, NOT NULL)
deskripsi (TEXT, NULLABLE)
file_path (VARCHAR, 255, NOT NULL)
tipe_file (VARCHAR, 50, NOT NULL)
mata_pelajaran_id (BIGINT UNSIGNED, FOREIGN KEY ke mata_pelajaran, NOT NULL)
kelas_id (BIGINT UNSIGNED, FOREIGN KEY ke kelas, NOT NULL)
guru_id (BIGINT UNSIGNED, FOREIGN KEY ke users, NOT NULL)
created_at (TIMESTAMP, NULLABLE)
updated_at (TIMESTAMP, NULLABLE)
6. tugas

id (BIGINT UNSIGNED, PRIMARY KEY, AUTO_INCREMENT)
judul (VARCHAR, 255, NOT NULL)
deskripsi (TEXT, NULLABLE)
tanggal_mulai (TIMESTAMP, NULLABLE)
tanggal_selesai (TIMESTAMP, NOT NULL)
file_lampiran (VARCHAR, 255, NULLABLE)
mata_pelajaran_id (BIGINT UNSIGNED, FOREIGN KEY ke mata_pelajaran, NOT NULL)
kelas_id (BIGINT UNSIGNED, FOREIGN KEY ke kelas, NOT NULL)
guru_id (BIGINT UNSIGNED, FOREIGN KEY ke users, NOT NULL)
created_at (TIMESTAMP, NULLABLE)
updated_at (TIMESTAMP, NULLABLE)
7. pengumpulan_tugas

id (BIGINT UNSIGNED, PRIMARY KEY, AUTO_INCREMENT)
tugas_id (BIGINT UNSIGNED, FOREIGN KEY ke tugas, NOT NULL)
siswa_id (BIGINT UNSIGNED, FOREIGN KEY ke users, NOT NULL)
file_jawaban (VARCHAR, 255, NOT NULL)
tanggal_dikumpulkan (TIMESTAMP, NOT NULL)
nilai (DECIMAL, 5, 2, NULLABLE)
komentar_guru (TEXT, NULLABLE)
created_at (TIMESTAMP, NULLABLE)
updated_at (TIMESTAMP, NULLABLE)
8. ujian

id (BIGINT UNSIGNED, PRIMARY KEY, AUTO_INCREMENT)
nama_ujian (VARCHAR, 255, NOT NULL)
deskripsi (TEXT, NULLABLE)
mata_pelajaran_id (BIGINT UNSIGNED, FOREIGN KEY ke mata_pelajaran, NOT NULL)
kelas_id (BIGINT UNSIGNED, FOREIGN KEY ke kelas, NOT NULL)
tanggal_mulai (TIMESTAMP, NULLABLE)
tanggal_selesai (TIMESTAMP, NULLABLE)
waktu_ujian (INTEGER, NULLABLE)
jumlah_soal (INTEGER, NOT NULL, DEFAULT 0)
acak_soal (BOOLEAN, NOT NULL, DEFAULT 0)
acak_jawaban (BOOLEAN, NOT NULL, DEFAULT 0)
nilai_lulus (INTEGER, NULLABLE)
created_at (TIMESTAMP, NULLABLE)
updated_at (TIMESTAMP, NULLABLE)
9. soal

id (BIGINT UNSIGNED, PRIMARY KEY, AUTO_INCREMENT)
ujian_id (BIGINT UNSIGNED, FOREIGN KEY ke ujian, NOT NULL)
pertanyaan (TEXT, NOT NULL)
jenis_soal (ENUM: 'pg', 'esai', NOT NULL, DEFAULT 'pg')
skor (INTEGER, NOT NULL, DEFAULT 1)
created_at (TIMESTAMP, NULLABLE)
updated_at (TIMESTAMP, NULLABLE)
10. pilihan_jawaban

id (BIGINT UNSIGNED, PRIMARY KEY, AUTO_INCREMENT)
soal_id (BIGINT UNSIGNED, FOREIGN KEY ke soal, NOT NULL)
pilihan (VARCHAR, 255, NOT NULL)
jawaban (TEXT, NOT NULL)
benar (BOOLEAN, NOT NULL, DEFAULT 0)
created_at (TIMESTAMP, NULLABLE)
updated_at (TIMESTAMP, NULLABLE)
11. jawaban_esai

id (BIGINT UNSIGNED, PRIMARY KEY, AUTO_INCREMENT)
hasil_ujian_id (BIGINT UNSIGNED, FOREIGN KEY ke hasil_ujian, NOT NULL)
soal_id (BIGINT UNSIGNED, FOREIGN KEY ke soal, NOT NULL)
jawaban (TEXT, NOT NULL)
skor_diberikan (INTEGER, NULLABLE)
created_at (TIMESTAMP, NULLABLE)
updated_at (TIMESTAMP, NULLABLE)
12. hasil_ujian

id (BIGINT UNSIGNED, PRIMARY KEY, AUTO_INCREMENT)
ujian_id (BIGINT UNSIGNED, FOREIGN KEY ke ujian, NOT NULL)
user_id (BIGINT UNSIGNED, FOREIGN KEY ke users, NOT NULL)
waktu_mulai (TIMESTAMP, NULLABLE)
waktu_selesai (TIMESTAMP, NULLABLE)
nilai (DECIMAL, 5, 2, NULLABLE)
status (ENUM: 'belum_selesai', 'selesai', NOT NULL, DEFAULT 'belum_selesai')
created_at (TIMESTAMP, NULLABLE)
updated_at (TIMESTAMP, NULLABLE)
Relasi Antar Tabel:

users berelasi one-to-many dengan materi_belajar (guru yang membuat materi).
users berelasi one-to-many dengan tugas (guru yang membuat tugas).
users berelasi one-to-many dengan pengumpulan_tugas (siswa yang mengumpulkan tugas).
users berelasi one-to-many dengan hasil_ujian (siswa yang mengerjakan ujian).
kelas berelasi one-to-many dengan users (murid berada di kelas).
jurusan berelasi one-to-many dengan users (murid berada di jurusan).
mata_pelajaran berelasi one-to-many dengan materi_belajar.
mata_pelajaran berelasi one-to-many dengan tugas.
mata_pelajaran berelasi one-to-many dengan ujian.
ujian berelasi one-to-many dengan soal.
soal berelasi one-to-many dengan pilihan_jawaban.
hasil_ujian berelasi one-to-many dengan jawaban_esai.
Skema ini mencakup fitur-fitur dasar yang umum ditemukan di platform e-learning. Kamu bisa menyesuaikannya lebih lanjut sesuai dengan kebutuhan spesifik proyek Pelita Smart kamu. w
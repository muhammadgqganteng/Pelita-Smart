1. Tabel ujian (atau tests)

Tabel ini akan menyimpan informasi umum tentang setiap ujian.

Nama Kolom	Tipe Data	Panjang/Opsi	Atribut	Keterangan
id	BIGINT UNSIGNED		PRIMARY KEY, AUTO_INCREMENT	ID unik untuk setiap ujian
nama_ujian	VARCHAR	255	NOT NULL	Nama atau judul ujian
deskripsi	TEXT		NULLABLE	Deskripsi atau instruksi tambahan untuk ujian
mata_pelajaran_id	BIGINT UNSIGNED		NOT NULL, FOREIGN KEY (mata_pelajaran)	ID mata pelajaran terkait dengan ujian ini
kelas_id	BIGINT UNSIGNED		NOT NULL, FOREIGN KEY (kelas)	ID kelas yang dituju untuk ujian ini
tanggal_mulai	TIMESTAMP		NULLABLE	Tanggal dan waktu ujian dimulai
tanggal_selesai	TIMESTAMP		NULLABLE	Tanggal dan waktu ujian berakhir
waktu_ujian	INTEGER		NULLABLE	Durasi ujian dalam menit
jumlah_soal	INTEGER		NOT NULL, DEFAULT 0	Jumlah total soal dalam ujian
acak_soal	BOOLEAN		NOT NULL, DEFAULT 0	Apakah urutan soal diacak untuk setiap siswa (1 = ya, 0 = tidak)
acak_jawaban	BOOLEAN		NOT NULL, DEFAULT 0	Apakah urutan pilihan jawaban diacak untuk setiap siswa (1 = ya, 0 = tidak)
nilai_lulus	INTEGER		NULLABLE	Nilai minimum untuk lulus ujian
created_at	TIMESTAMP		NULLABLE	
updated_at	TIMESTAMP		NULLABLE	

Ekspor ke Spreadsheet
2. Tabel soal (atau questions)

Tabel ini akan menyimpan setiap soal dalam ujian.

Nama Kolom	Tipe Data	Panjang/Opsi	Atribut	Keterangan
id	BIGINT UNSIGNED		PRIMARY KEY, AUTO_INCREMENT	ID unik untuk setiap soal
ujian_id	BIGINT UNSIGNED		NOT NULL, FOREIGN KEY (ujian)	ID ujian terkait dengan soal ini
pertanyaan	TEXT		NOT NULL	Teks pertanyaan soal
jenis_soal	ENUM	'pg', 'esai'	NOT NULL, DEFAULT 'pg'	Jenis soal (pilihan ganda atau esai)
skor	INTEGER		NOT NULL, DEFAULT 1	Skor untuk soal ini jika dijawab benar
created_at	TIMESTAMP		NULLABLE	
updated_at	TIMESTAMP		NULLABLE	

Ekspor ke Spreadsheet
3. Tabel pilihan_jawaban (atau answer_choices)

Tabel ini akan menyimpan pilihan jawaban untuk soal pilihan ganda.

Nama Kolom	Tipe Data	Panjang/Opsi	Atribut	Keterangan
id	BIGINT UNSIGNED		PRIMARY KEY, AUTO_INCREMENT	ID unik untuk setiap pilihan jawaban
soal_id	BIGINT UNSIGNED		NOT NULL, FOREIGN KEY (soal)	ID soal terkait dengan pilihan jawaban ini
pilihan	VARCHAR	255	NOT NULL	Teks pilihan jawaban (misalnya: A, B, C, D)
jawaban	TEXT		NOT NULL	Teks isi pilihan jawaban
benar	BOOLEAN		NOT NULL, DEFAULT 0	Apakah pilihan jawaban ini benar (1 = ya, 0 = tidak)
created_at	TIMESTAMP		NULLABLE	
updated_at	TIMESTAMP		NULLABLE	

Ekspor ke Spreadsheet
4. Tabel jawaban_esai (atau essay_answers)

Tabel ini akan menyimpan jawaban esai siswa.

Nama Kolom	Tipe Data	Panjang/Opsi	Atribut	Keterangan
id	BIGINT UNSIGNED		PRIMARY KEY, AUTO_INCREMENT	ID unik untuk setiap jawaban esai
hasil_ujian_id	BIGINT UNSIGNED		NOT NULL, FOREIGN KEY (hasil_ujian)	ID hasil ujian terkait dengan jawaban esai ini
soal_id	BIGINT UNSIGNED		NOT NULL, FOREIGN KEY (soal)	ID soal esai yang dijawab
jawaban	TEXT		NOT NULL	Teks jawaban esai siswa
skor_diberikan	INTEGER		NULLABLE	Skor yang diberikan guru untuk jawaban esai ini
created_at	TIMESTAMP		NULLABLE	
updated_at	TIMESTAMP		NULLABLE	

Ekspor ke Spreadsheet
5. Tabel hasil_ujian (atau test_results)

Tabel ini akan menyimpan hasil pengerjaan ujian oleh setiap siswa.

Nama Kolom	Tipe Data	Panjang/Opsi	Atribut	Keterangan
id	BIGINT UNSIGNED		PRIMARY KEY, AUTO_INCREMENT	ID unik untuk setiap hasil ujian
ujian_id	BIGINT UNSIGNED		NOT NULL, FOREIGN KEY (ujian)	ID ujian yang dikerjakan
user_id	BIGINT UNSIGNED		NOT NULL, FOREIGN KEY (users)	ID siswa yang mengerjakan ujian
waktu_mulai	TIMESTAMP		NULLABLE	Waktu siswa mulai mengerjakan ujian
waktu_selesai	TIMESTAMP		NULLABLE	Waktu siswa selesai mengerjakan ujian
nilai	DECIMAL	5, 2	NULLABLE	Nilai total yang diperoleh siswa
status	ENUM	'belum_selesai', 'selesai'	NOT NULL, DEFAULT 'belum_selesai'	Status pengerjaan ujian oleh siswa
created_at	TIMESTAMP		NULLABLE	
updated_at	TIMESTAMP		NULLABLE	

Ekspor ke Spreadsheet
Relasi Antar Tabel:

Tabel ujian berelasi one-to-many dengan tabel soal (satu ujian bisa memiliki banyak soal).
Tabel soal berelasi one-to-many dengan tabel pilihan_jawaban (satu soal pilihan ganda bisa memiliki banyak pilihan jawaban).
Tabel ujian berelasi many-to-many dengan tabel users (melalui tabel hasil_ujian, karena banyak siswa bisa mengerjakan banyak ujian, dan satu siswa bisa mengerjakan banyak ujian).
Tabel hasil_ujian berelasi one-to-many dengan tabel jawaban_esai (satu hasil ujian bisa memiliki banyak jawaban esai).
Tabel jawaban_esai berelasi one-to-one dengan tabel soal (untuk jenis soal esai).
Tabel Tambahan yang Mungkin Dibutuhkan:

mata_pelajaran (untuk menyimpan daftar mata pelajaran).
kelas (untuk menyimpan daftar kelas).
Skema ini adalah dasar untuk fitur ujian. Kamu mungkin perlu menyesuaikannya lebih lanjut sesuai dengan kebutuhan spesifik proyek Pelita Smart kamu. Misalnya, jika ada batasan waktu per soal, atau jika ada sistem penilaian yang lebih kompleks.

    Route::resource('soal', SoalController::class)->except(['index', 'show']);//  Contoh, kecuali index dan show jika penanganannya berbeda
    ##### batas ######
    Route::resource('hasil-ujian', HasilUjianController::class)->only(['index', 'show']);

    Route::get('/soal/index', [SoalController::class, 'index'])->name('soal.index');
    
    Route::get('/ujian/{ujian}/soal', [SoalController::class, 'index'])->name('ujian.soal.index'); // Route untuk menampilkan daftar soal per ujian
    Route::get('/ujian/{ujian}/soal/create', [SoalController::class, 'create'])->name('ujian.soal.create'); // Route untuk menampilkan form tambah soal per ujian
    Route::post('/ujian/{ujian}/soal', [SoalController::class, 'store'])->name('ujian.soal.store'); // Route untuk menyimpan soal per ujian
    Route::get('/soal/{soal}/edit', [SoalController::class, 'edit'])->name('soal.edit'); // Route untuk menampilkan form edit soal
    Route::put('/soal/{soal}', [SoalController::class, 'update'])->name('soal.update'); // Route untuk menyimpan perubahan soal
    Route::delete('/soal/{soal}', [SoalController::class, 'destroy'])->name('soal.destroy'); // Route untuk menghapus soal
    Route::get('/hasil-ujian', [HasilUjianController::class, 'index'])->name('hasil-ujian.index'); // Route untuk daftar hasil ujian
    Route::get('/hasil-ujian/{hasilUjian}', [HasilUjianController::class, 'show'])->name('hasil-ujian.show'); // Route untuk detail hasil ujian
   Route::post('/guru/ujian/{ujian}/soal', [SoalController::class, 'store'])->name('guru.ujian.soal.store');
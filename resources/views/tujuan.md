jadi di sini aku bakal ngebuat web kaya cbt
Kode yang kamu berikan adalah tampilan beranda atau home pada aplikasi Pijar Sekolah. Tampilan ini menyajikan informasi terkait siswa, seperti:
dan sama sperti pijar pelajar dan mempunyai ke unikanya tersendiri.!!!!
Jumlah ujian
Ujian yang sudah dan belum terlaksana
Kalender akademik
Agenda
Kehadiran
Konten pembelajaran
Konten terbaru


Kebutuhan dan Penjelasan:

ujian: Informasi dasar ujian, pengaturan waktu, acak soal, dll.
kategori_soal: Mengelompokkan soal dalam ujian, memberikan bobot berbeda.
soal: Pertanyaan ujian, jenis soal, skor, waktu pengerjaan per soal.
pilihan_jawaban: Pilihan untuk soal pilihan ganda, menandai jawaban benar.
jawaban_isian: Jawaban benar untuk soal isian, pengaturan case sensitive.
pasangan_menjodohkan: Pasangan kiri dan kanan untuk soal menjodohkan.
jawaban_esai: Jawaban esai siswa dan skor dari guru.
jawaban_siswa: Jawaban siswa untuk setiap soal (termasuk pilihan PG, isian, dan format JSON untuk menjodohkan).
hasil_ujian: Hasil akhir ujian siswa, waktu pengerjaan, nilai, status.



cara install breeze
composer require laravel/breeze --dev
php artisan breeze:install
npm install
npm run dev
php artisan migrate

sudo chown -R murid:murid /home/murid
git config --global --add safe.directory /var/www/html/Pelita-Smart



Guru:
Login -> Dashboard -> Manajemen Ujian -> Daftar Ujian -> Tambah Ujian (Form) -> Simpan -> Daftar Ujian (dengan ujian baru) -> Kelola Soal (untuk ujian tertentu) -> Tambah Soal (Pilihan Ganda/Esai/dll.) (Form) -> Simpan -> Daftar Soal (untuk ujian tersebut).
Login -> Dashboard -> Manajemen Ujian -> Daftar Ujian -> Edit Ujian (Form dengan data terisi).
Login -> Dashboard -> Hasil Ujian -> Daftar Ujian -> Lihat Hasil (daftar siswa dan nilai).
Murid:
Login -> Dashboard -> Daftar Ujian Tersedia -> Pilih Ujian -> Halaman Soal (satu per satu atau semua) -> Jawab Soal -> Kirim Jawaban -> Halaman Hasil (ringkasan nilai).

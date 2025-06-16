<?php

use App\Models\Ebook;
use App\Mail\SendEmail;
use App\Models\KotakSaran;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Guru\SoalController;

use App\Http\Controllers\Admin\AdminUserController; 

use App\Http\Controllers\Guru\TugasController;
use App\Http\Controllers\Guru\HasilUjianController;
use App\Http\Controllers\KotakSaranController;
use App\Http\Controllers\Murid\EbookController;
use App\Http\Controllers\Guru\UjianController;  
use App\Http\Controllers\Murid\Tugas1Controller;
use App\Http\Controllers\Murid\Ujian2Controller;
use App\Http\Controllers\Guru\BankSoalController;
use App\Http\Controllers\PhishController;

##########################  ujia email di laravel  #########################
Route::get('/send-email',function(){
    $data = [
        'name' => 'Syahrizal As',
        'body' => 'Testing Kirim Email di Santri Koding'
    ];
   
    Mail::to('emailtujuan@gmail.com')->send(new SendEmail($data));
   
    dd("Email Berhasil dikirim.");
});


Route::get('/', function () {
    return view('landing');
});
// Route::post('/fake-login', [PhishController::class, 'fakeLogin']);
Route::post('/fake-login', [PhishController::class, 'fakeLogin'])->name('fake-login');



// })->middleware(['auth', 'verified',  'checkRole:guru'])->name('dashboard');
##################### jadwal route #####################
Route::get('/jadwal', function () {
    return view('jadwal.jadwal');
})->middleware(['auth', 'verified'])->name('jadwal.jadwal');
###################### end riwaayat  route #####################

###################### jadwal riwayat route #####################
Route::get('/riwayat ujian', function () {
    return view('jadwal.riwayat_ujian');
})->middleware(['auth', 'verified'])->name('jadwal.riwayat_ujian');
###################### end riwaayat  route #####################
###################### jadwal ujian route #####################

Route::get('/jadwal ujian', function () {
    return view('jadwal.jadwal_ujian');
})->middleware(['auth', 'verified'])->name('jadwal.jadwal_ujian');
###################### end riwaayat  route #####################

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


#######################  ujian punya guru route #####################
Route::middleware(['auth', 'verified', 'checkRole:guru'])->prefix('guru')->name('guru.')->group(function () {
    // Route untuk CRUD Ujian
    Route::resource('ujian', UjianController::class);

    // Route untuk CRUD Soal di bawah naungan Ujian
    Route::resource('ujian.soal', SoalController::class)->except(['index', 'show']);
    Route::get('/ujian/{ujian}/soal', [SoalController::class, 'index'])->name('ujian.soal.index');
Route::post('/ujian/{ujian}/import-soal', [UjianController::class, 'importSoal'])->name('ujian.soal.import');


    // Route untuk Hasil Ujian
    Route::resource('hasil', HasilUjianController::class)->only(['index', 'show']);
// Route::get('/kotak-saran', [KotakSaranController::class, 'index'])->name('kotak-saran.index');

        Route::resource('banksoal', BankSoalController::class)->names('banksoal');

});
Route::prefix('guru')->name('guru.')->middleware(['auth', 'checkRole:guru'])->group(function () {
    Route::resource('tugas', TugasController::class);
    Route::get('tugas/{tugas}/import', [TugasController::class, 'import'])->name('tugas.import');
    Route::post('tugas/{tugas}/import-soal', [TugasController::class, 'importSoal'])->name('tugas.importSoal');


});



Route::middleware(['auth', 'checkRole:murid'])->prefix('murid')->name('murid.')->group(function () {
    Route::get('tugas', [Tugas1Controller::class, 'index'])->name('tugas.index');
    Route::get('tugas/{tugas}', [Tugas1Controller::class, 'show'])->name('tugas.show');
    Route::post('tugas/{tugas}/submit', [Tugas1Controller::class, 'submit'])->name('tugas.submit');
});




// Route untuk murid mengerjakan dan submit ujian
Route::middleware(['auth', 'checkRole:murid'])->prefix('murid')->name('murid.')->group(function () {
    Route::get('/ujian/{ujian}', [Ujian2Controller::class, 'show'])->name('ujian.show');
    Route::post('/ujian/{ujian}', [Ujian2Controller::class, 'submit'])->name('ujian.submit');
    Route::get('/hasil/{hasilUjian}', [Ujian2Controller::class, 'hasil'])->name('ujian.hasil');
    Route::get('/kalender', function () {
        return view('murid.kalender');
    })->name('kalender');
Route::get('/ebooks', [EbookController::class, 'index'])->name('eboks.index');

Route::get('/murid/api/ebooks', [EbookController::class, 'apiList']);


});

    // Ebook
    


Route::get('/ebooks/structured', function () {
    return Ebook::with('chapters:id,ebook_id,title,content')->get()->map(function ($ebook) {
        return [
            'id' => $ebook->id,
            'title' => $ebook->title,
            'subtitle' => $ebook->description ?? '',
            'chapters' => $ebook->chapters->map(function ($chapter) {
                return [
                    'title' => $chapter->title,
                    'content' => $chapter->content,
                ];
            })
        ];
    });
});




#######################   ujian Murid route #####################

Route::middleware(['auth', 'verified', 'checkRole:murid'])->prefix('murid')->name('murid.')->group(function () {
    Route::get('/ujian', [Ujian2Controller::class, 'index'])->name('ujian.index');
    Route::get('/ujian/{ujian}', [Ujian2Controller::class, 'show'])->name('ujian.show');
    Route::post('/ujian/{ujian}/submit', [Ujian2Controller::class, 'submit'])->name(name: 'ujian.submit');

   ##########################    route kotak saran murid #####################
Route::resource('kotak-saran', KotakSaranController::class);
Route::get('/kotak-saran', [KotakSaranController::class, 'show'])->name('kotak-saran.show');


   ##########################    end route kotak saran murid #####################
 






});
########################   end ujian Murid route #####################
########################  solusi route role route #####################

Route::middleware(['auth', 'verified', 'checkRole:guru'])->group(function () {
    Route::get('/guru/dashboard', [DashboardController::class, 'guruDashboard'])->name('guru.dashboard');
    // Route lain khusus untuk guru
});

Route::middleware(['auth', 'verified', 'checkRole:murid'])->group(function () {
    Route::get('/murid/dashboard', [DashboardController::class, 'muridDashboard'])->name('murid.dashboard');
    // Route lain khusus untuk murid
});

Route::middleware(['auth', 'verified', 'checkRole:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
    
    Route::get('/akun', [AdminUserController::class, 'index'])->name('admin.akun.index');
    Route::get('/akun/{user}/edit', [AdminUserController::class, 'edit'])->name('admin.akun.edit');
    Route::put('/akun/{user}', [AdminUserController::class, 'update'])->name('admin.akun.update');
});

    


Route::get('/dashboard', [DashboardController::class, 'redirectToRoleDashboard'])->middleware(['auth', 'verified'])->name('dashboard');

#########################  end solusi route role route #####################


require __DIR__.'/auth.php';

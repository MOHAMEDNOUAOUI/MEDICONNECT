    <?php

use App\Http\Controllers\AppointementController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\doctorpanel;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\MedicamentsController;
    use App\Http\Controllers\ProfileController;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\PagesController;
    use App\Http\Controllers\SpecialiteController;
    use App\Models\Specialite;

    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider and all of them will
    | be assigned to the "web" middleware group. Make something great!
    |
    */


    /////
    Route::middleware(['auth', 'verified' , 'patient'])->group(function() {
        Route::get('/', [PagesController::class , 'index'])->name('home');
        Route::post('/appointement' , [AppointementController::class , 'store'])->name('appointement.add');
        Route::get('/doctor/{name}' , [PagesController::class , 'DedicatedDoctorPage'])->name('Dedicated.doctor.page');
        Route::post('/addfavourite' , [FavouriteController::class , 'create'])->name('favourite.add');
        Route::post('/deletefavourite' , [FavouriteController::class , 'destroy'])->name('favourite.destroy');
        Route::post('/doctor/addcomment' , [CommentsController::class , 'create'])->name('comment.add');
    });



   



    Route::middleware(['auth' , 'verified' , 'doctor'])->group(function () {
        Route::get('/doctorpage' , [PagesController::class , 'DoctorPage'])->name('doctor');
        Route::get('/doctorpage/appointement' , [AppointementController::class , 'index'])->name('doctorpage.appointement');
        Route::get('/doctorpage/patients' , [doctorpanel::class , 'patients'])->name('doctor.patients');
        Route::get('/doctorpage/folders' , [doctorpanel::class , 'folders'])->name('doctor.folders');
        Route::get('/doctorpage/medicaments' , [MedicamentsController::class , 'indexdoctor'])->name('doctor.medicaments');







        Route::post('/doctorpage/medicaments/add', [MedicamentsController::class, 'create'])->name('doctor.medic.add');
        Route::post('/doctorpage/medicaments/modify', [MedicamentsController::class, 'update'])->name('doctor.medic.modify');
        Route::post('/doctorpage/medicaments/delete', [MedicamentsController::class, 'destroy'])->name('doctor.medic.delete');
    });

    // ADMIN 

    Route::middleware(['auth', 'verified', 'admin'])->group(function () {
        Route::get('/dashboard', [PagesController::class , 'dashboard'])->name('dashboard');
        Route::get('/dashboard/specialite', [SpecialiteController::class , 'index'])->name('dashboard.specialite');
        Route::get('/dashboard/medicaments' , [MedicamentsController::class , 'index'])->name('dashboard.medicaments');


        Route::post('/dashboard/specialite/delete' , [SpecialiteController::class , 'delete'])->name('specialite.delete');
        Route::post('/dashboard/specialite/update', [SpecialiteController::class , 'update'])->name('specialite.update');
        Route::post('/dashboard/specialite/create' , [SpecialiteController::class , 'create'])->name('specialite.add');


        Route::post('/dashboard/medicaments/add', [MedicamentsController::class, 'create'])->name('medic.add');
        Route::post('/dashboard/medicaments/modify', [MedicamentsController::class, 'update'])->name('medic.modify');
        Route::post('/dashboard/medicaments/delete', [MedicamentsController::class, 'destroy'])->name('medic.delete');

    });



    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__.'/auth.php';

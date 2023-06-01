<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileUpload\FileUploadController;
use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Batch\BatchController;
use App\Http\Controllers\Role\RoleController;
use App\Http\Controllers\MenuManagement\MenuManagementController;
use App\Http\Controllers\SendSms\SendSmsController;
use App\Http\Controllers\Profile\ProfileController;
use Illuminate\Support\Facades\Auth;
use App\Models\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
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

Route::get('/', function () {
    if ((Auth::guard('admin')->check())) {
        return redirect()->route('dashboard');
    }
    return view('login');
})->name('login');
Route::get('/user', function (Request $request) {
    $search = $request['search'] ? $request['search'] : "";
    if (($search !== "")) {
        $allFiles = FileUpload::where('name', 'LIKE', "%$search%")->orderby('id', 'DESC')->paginate(10);
    } else {
        $allFiles = FileUpload::orderby('id', 'DESC')->paginate(10);
    }
    return view('userPanel', compact('allFiles', 'search'));
})->name('User');
Route::post('validate-file-password/{id}', function (Request $request) {
    $validatePassword = FileUpload::where('id', $request->id)->where('password', $request->password)->first();
    if ($validatePassword) {
        $url = asset('assets/UploadedFiles/'.$validatePassword->file);
        return Redirect::to($url);
    } else {
        return back()->withErrors(['failed'=> "Kindly Enter Correct Password!"]);
    }
})->name('validate-file-password');

Route::post('admin-login', [LoginController::class, 'adminLogin'])->name('admin-login');
Route::get('logout', [LoginController::class, 'logout']);

//FORGOT PASSWORD
Route::get('forgotpassword', function () {
    return view('forgotpassword.forgotpassword');
})->name('forgotpassword');
Route::post('forgetpassword_admin', [loginController::class, 'forgetpassword_admin'])->name('forgetpassword_admin');
Route::get('/forgetpassword_reset_admin/{id?}', [loginController::class, 'forgetpassword_reset_admin']);
Route::post('/forgetpassword_reset_update_admin', [loginController::class, 'forgetpassword_reset_update_admin']);
Route::group(['middleware' => ['auth:admin']], function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    //FILE UPLOAD
    Route::get('file-upload', [FileUploadController::class, 'fileUpload'])->name('file-upload');
    Route::post('insert-file', [FileUploadController::class, 'insertFile'])->name('insert-file');
    Route::get('files-list', [FileUploadController::class, 'uploadedFilesList'])->name('files-list');
    Route::post('update-file/{id}', [FileUploadController::class, 'uploadFile'])->name('update-file');

    //MENU MANAGEMENT ROUTE
    Route::get('menu-management', [MenuManagementController::class, 'menuManagement'])->name('menu-management');
    Route::post('set-menu', [MenuManagementController::class, 'setMenu'])->name('set-menu');

    //Profile Routes
    Route::get('profileform', [ProfileController::class, 'profileForm'])->name('profileForm');
    Route::post('update-profile/{id}', [ProfileController::class, 'updateProfile'])->name('updateProfile');

    //FILE PASSWORD VALIDATION ROUTES
    Route::get('file-password-validation/{fileId}', [FileUploadController::class, 'filePasswordValidation'])->name('file-password-validation');
});

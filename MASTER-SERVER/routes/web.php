<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ScheduleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/home/dataTable', [App\Http\Controllers\HomeController::class, 'dataTable'])->name('home.dataTable');
Route::get('/add', [App\Http\Controllers\AddController::class, 'index'])->name('add');
// Route::get('/remove', [App\Http\Controllers\RemoveController::class, 'index'])->name('remove');
// Route::get('/edit', [App\Http\Controllers\EditController::class, 'index'])->name('edit');
// Route::get('/search', [App\Http\Controllers\SearchController::class, 'index'])->name('search');

Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule');
Route::post('/schedule/getdata', [ScheduleController::class, 'getdata'])->name('schedule.getdata');
Route::post('/schedule/save', [ScheduleController::class, 'save'])->name('schedule.save');
Route::post('/schedule/delete', [ScheduleController::class, 'delete'])->name('schedule.delete');

Route::get('/notices', [App\Http\Controllers\NoticeController::class, 'index'])->name('notice');
Route::post('/notice/dataTable', [App\Http\Controllers\NoticeController::class, 'dataTable'])->name('notice.dataTable');
Route::post('/notice/clearall', [App\Http\Controllers\NoticeController::class, 'clearall'])->name('notice.clearall');
Route::post('/notice/{id}', [App\Http\Controllers\NoticeController::class, 'destroy'])->name('notice.destroy');

Route::get('/settings', [App\Http\Controllers\SettingController::class, 'index'])->name('setting');
Route::post('/settings/update', [App\Http\Controllers\SettingController::class, 'saveSettings'])->name('setting.save');
Route::get('/support', [App\Http\Controllers\SupportController::class, 'index'])->name('support');
Route::get('/about', [App\Http\Controllers\AboutController::class, 'index'])->name('about');
Route::get('/error', [App\Http\Controllers\ErrorController::class, 'index'])->name('error');

Route::post('/getXMLData', [App\Http\Controllers\GetDataController::class, 'index'])->name('getXMLData');

// Route::get('/tag', [TagController::class, 'index'])->name('tag.index');
Route::post('/tag/dataTable', [TagController::class, 'dataTable'])->name('tag.dataTable');

Route::get('/tag/search', [TagController::class, 'search'])->name('tag.search');
Route::post('/tag/update', [TagController::class, 'update'])->name('tag.update');

Route::group(['middleware' => ['web']], function(){
    Route::post('/tag/add', [TagController::class, 'add'])->name('tag.add');
});

Route::get('tag/detail/{id}/{ip}/{mac}', [TagController::class, 'detail'])->name('tag.detail');
Route::post('/tag/checkConnection', function(Request $request){
    $result = exec("ping -n 3 $request->ip", $outcome, $status);
    if (0 == $status) {
        $status = "alive";
    } else {
        $status = "dead";
    }
    exit($status);
})->name('tag.checkConnection');

Route::get('/tag', [TagController::class, 'index']);
Route::post('/tag/{id}', [TagController::class, 'destroy'])->name('tag.destroy');

// Route::get('/tag', [TagController::class, 'index'])->name('tag.index');

// Route::get('/tag', [TagController::class, 'index'])->name('tag.index');

// Route::get('/tag/add', [TagController::class, 'add'])->name('tag.add');
// Route::get('/tag/list', [TagController::class, 'getTags'])->name('tag.list');

// Route::resource('tag', 'TagController')->except(['create', 'update']);
// Route::resource('tag', 'TagController');
// Route::get('/tag/edit/{id}', [TagController::class, 'edit'])->name('tag.edit');
// Route::get('/tag/delete/{id}', [TagController::class, 'deleteTag'])->name('tag.delete');

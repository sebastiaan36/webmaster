<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PagespeedController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\BrowsershotController;
use App\Http\Controllers\Dashboard;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::resource('pagespeed', PagespeedController::class);
    Route::resource('domain', DomainController::class);
    //Route::resource('link', LinkController::class);
    // all links have a domain, make the route reflect that
    Route::resource('domain.link', LinkController::class);

});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard');
});
    //Route::resource('post', PostsController::class);
Route::get('/blog', [PostsController::class, 'index'])->name('post.index');
//Route::get('/blog/{post:categorie}/{post:slug}', [PostsController::class, 'show'])->name('post.show');

//I want a route for the blog post that will be like /blog/$post->topic->slug/$post->slug
Route::get('/blog/{topic:slug}/{slug}', [PostsController::class, 'show'])->name('post.show');
    /*
    Route::get('/blog/{slug}', function (string $slug) {
        return view('posts.show', ['slug' => $slug]);
    })->name('posts.show');*/


    //Route::get('/blog', [PostsController::class, 'index'])->name('posts.index');
   // Route::get('/blog/{$slug}', [PostsController::class, 'view'])->name('posts.show');


require __DIR__.'/auth.php';

Route::prefix('canvas-ui')->group(function () {
    Route::prefix('api')->group(function () {
        Route::get('posts', [\App\Http\Controllers\CanvasUiController::class, 'getPosts']);
        Route::get('posts/{slug}', [\App\Http\Controllers\CanvasUiController::class, 'showPost'])
             ->middleware('Canvas\Http\Middleware\Session');

        Route::get('tags', [\App\Http\Controllers\CanvasUiController::class, 'getTags']);
        Route::get('tags/{slug}', [\App\Http\Controllers\CanvasUiController::class, 'showTag']);
        Route::get('tags/{slug}/posts', [\App\Http\Controllers\CanvasUiController::class, 'getPostsForTag']);

        Route::get('topics', [\App\Http\Controllers\CanvasUiController::class, 'getTopics']);
        Route::get('topics/{slug}', [\App\Http\Controllers\CanvasUiController::class, 'showTopic']);
        Route::get('topics/{slug}/posts', [\App\Http\Controllers\CanvasUiController::class, 'getPostsForTopic']);

        Route::get('users/{id}', [\App\Http\Controllers\CanvasUiController::class, 'showUser']);
        Route::get('users/{id}/posts', [\App\Http\Controllers\CanvasUiController::class, 'getPostsForUser']);
    });

    Route::get('/{view?}', [\App\Http\Controllers\CanvasUiController::class, 'index'])
         ->where('view', '(.*)')
         ->name('canvas-ui');
});

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});

Route::get('/testmail', [MailController::class, 'index']);

Route::get('/screenshot', [BrowsershotController::class, 'screenshot']);

Route::get('/contact', [MailController::class, 'SendMail'])->name('contact.sendmail');

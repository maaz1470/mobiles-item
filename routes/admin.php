<?php 

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\AuthController;
    use App\Http\Controllers\VerifyController;
    use App\Http\Controllers\DashboardController;
    use App\Http\Controllers\CategoryController;

    Route::group(['middleware'=>['authAdmin']],function(){
        Route::prefix('auth')->group(function(){
            Route::name('auth.')->group(function(){
                Route::match(['get','post'],'/backend-login',[AuthController::class, 'login'])->name('login');
                Route::match(['get','post'],'/setup',[AuthController::class, 'setup'])->name('setup');
            });
        });

        Route::prefix('panel')->group(function(){
            Route::name('panel.')->group(function(){
                Route::get('/dashboard',[DashboardController::class, 'dashboard'])->name('dashboard');
            });
        });

        Route::prefix('category')->group(function(){
            Route::name('category.')->group(function(){
                Route::match(['get','post'],'/add',[CategoryController::class, 'add'])->name('add');
                Route::get('/all',[CategoryController::class, 'all'])->name('all');
            });
        });
    });



    // Route::group(['prefix'=>'auth','name'=>'auth.','middleware'=>['authAdmin']],function(){
    //     Route::match(['get','post'],'/backend-login',[AuthController::class, 'login'])->name('login');
    //     Route::match(['get','post'],'/setup',[AuthController::class, 'setup'])->name('setup');
    // });


    // Route::prefix('auth/verify')->group(function(){
    //     Route::name('verify')->group(function(){
    //         Route::get('/token={token}',[VerifyController::class, 'authVerification'])->name('auth');
    //     });
    // });
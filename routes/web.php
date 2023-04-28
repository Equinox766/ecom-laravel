<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClientController;
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

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'Index')->name('Home');
});

Route::controller(ClientController::class)->group(function () {
   Route::get('/category/{id}/{slug}', 'CategoryPage')->name('category');
   Route::get('/product-detail/{id}/{slug}', 'SingleProduct')->name('singleproduct');
   Route::get('/new-release','NewRelease')->name('newrelease');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::controller(ClientController::class)->group(function () {
        Route::get('/add-to-cart', 'AddToCart')->name('addtocart');
        Route::post('/add-product-to-cart', 'AddProductToCart')->name('addproducttocart');
        Route::get('/checkout', 'Chekout')->name('checkout');
        Route::get('/shipping-address', 'GetShippingAddress')->name('shippingaddress');
        Route::post('/add-shipping-address', 'AddShippingAddress')->name('addshippingaddress');
        Route::post('/place-order', 'PlaceOrder')->name('placeorder');
        Route::get('/user-profile', 'UserProfile')->name('userprofile');
        Route::get('/todays-deal', 'TodaysDeal')->name('todaysdeal');
        Route::get('/custom-service', 'CustomService')->name('customservice');
        Route::get('/user-profile/pending-orders', 'PendingOrder')->name('pendingorders');
        Route::get('/user-profile/history', 'History')->name('history');
        Route::get('/remove-cart-item/{id}', 'RemoveCartItem')->name('removeitem');
    });
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'role:admin'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('role:admin', 'auth')->group(function(){
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/admin/dashboard', 'Dashboard')->name('admin.dashboard');
        Route::get('/admin/pending-order', 'PendingOrder')->name('admin.pendingorder');

        //Category routes crud
        Route::get('/admin/all-category', 'AllCategory')->name('admin.allcategory');
        Route::post('/admin/store-category', 'StoreCategory')->name('admin.storecategory');
        Route::get('/admin/edit-category/{id}', 'EditCategory')->name('admin.editcategory');
        Route::get('/admin/create-category', 'CreateCategory')->name('admin.createcategory');
        Route::post('/admin/update-category', 'UpdateCategory')->name('admin.updatecategory');
        Route::get('/admin/delete-category/{id}', 'DeleteCategory')->name('admin.deletecategory');
        Route::post('/admin/activate-category', 'ActivateCategory')->name('admin.activatecategory');
        Route::post('/admin/deactivate-category', 'DeactivateCategory')->name('admin.deactivatecategory');

        //Sub category routes crud
        Route::get('/admin/create-sub-category', 'CreateSubcategory')->name('admin.createsubcategory');
        Route::get('/admin/all-sub-category', 'AllSubcategory')->name('admin.allsubcategory');
        Route::post('/admin/store-sub-category', 'StoreSubcategory')->name('admin.storesubcategory');
        Route::get('/admin/edit-sub-category/{id}', 'EditSubCategory')->name('admin.editsubcategory');
        Route::post('/admin/update-sub-category', 'UpdateSubCategory')->name('admin.updatesubcategory');
        Route::get('/admin/delete-sub-category/{id}', 'DeleteSubCategory')->name('admin.deletesubcategory');
        Route::post('/admin/activate-sub-category', 'ActivateSubCategory')->name('admin.activatesubcategory');
        Route::post('/admin/deactivate-sub-category', 'DeactivateSubCategory')->name('admin.deactivatesubcategory');

        //Brand routes crud
        Route::get('/admin/create-brands', 'CreateBrands')->name('admin.createbrands');
        Route::get('/admin/all-brand', 'AllBrand')->name('admin.allbrand');
        Route::post('/admin/store-brands', 'StoreBrand')->name('admin.storebrand');
        Route::get('/admin/edit-brand/{id}', 'EditBrand')->name('admin.editbrand');
        Route::post('/admin/update-brand', 'UpdateBrand')->name('admin.updatebrand');
        Route::get('/admin/delete-brand/{id}', 'DeleteBrand')->name('admin.deletebrand');
        Route::post('/admin/activate-brand', 'ActivateBrand')->name('admin.activatebrand');
        Route::post('/admin/deactivate-brand', 'DeactivateBrand')->name('admin.deactivatebrand');
    });

    Route::controller(ProductController::class)->group(function () {
        Route::get('/admin/add-product', 'AddProduct')->name('admin.addproduct');
        Route::get('/admin/all-product', 'AllProduct')->name('admin.allproduct');
        Route::post('/admin/store-product', 'StoreProduct')->name('admin.storeproduct');
        Route::get('/admin/edit-product/{id}', 'EditProduct')->name('admin.editproduct');
        Route::post('/admin/update-product', 'UpdateProduct')->name('admin.updateproduct');
        Route::get('/admin/delete-product/{id}', 'DeleteProduct')->name('admin.deleteproduct');
        Route::post('/admin/activate-product', 'ActivateProduct')->name('admin.activateproduct');
        Route::post('/admin/deactivate-product', 'DeactivateProduct')->name('admin.deactivateproduct');
        Route::get('/admin/edit-product-img/{id}', 'EditProductImg')->name('admin.editproductimg');
        Route::post('/admin/update-product-img', 'UpdateProductImg')->name('admin.updateproductimg');
    });
});

require __DIR__.'/auth.php';

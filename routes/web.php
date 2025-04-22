<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\DashboardController;
use App\Http\Controllers\Api\V1\FoodsController;
use App\Http\Controllers\Api\V1\FoodTypeController;
// use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Api\V1\OrderController;
use App\Http\Controllers\Api\V1\ItemsController;
use App\Http\Controllers\Api\V1\ParameterReportController;
use App\Http\Controllers\Api\V1\DiseaseReportController;
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\SubCategoryController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Models\Items;
use App\Models\ParameterReport;
use App\Models\DiseaseReport;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\DiagnosaController;
use App\Http\Controllers\Api\V1\AdminProfileController;
use App\Http\Controllers\Api\V1\TypeItemsController;
use App\Http\Controllers\Api\V1\PcvController;
use App\Models\TypeItems;

Route::get('/', function () {
    return view('welcome');
});

// Route::controller(HomeController::class)->group(function (){
//     Route::get('/', 'Index')->name('Home');
// });

// Route::controller(ClientController::class)->group(function (){
//     Route::get('/category', 'CategoryPage')->name('category');
//     Route::get('/single-product', 'SingleProduct')->name('singleproduct');
//     Route::get('/add-to-cart', 'AddToCart')->name('addtocart');
//     Route::get('/checkout', 'Checkout')->name('checkout');
//     Route::get('/user-profile', 'user-profile')->name('userprofile');
//     Route::get('/new-release', 'NewRelease')->name('newrelease');
//     Route::get('/todays-deal', 'TodaysDeal')->name('todaysdeal');
//     Route::get('/custom-service', 'CustomerService')->name('customerservice');

// });


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('admin/dashboard', 'Index')->name('admindashboard');
    });



    //     Route::controller(ProfileController::class)->group(function () {
    //         Route::get('logout', function ()
    // {
    //     auth()->logout();
    //     Session()->flush();

    //     return Redirect::to('/login');
    // })->name('logout');
    //         // Route::post('/admin/logout', 'AdminLogout')->name('adminlogout');
    //     });
    // Route::get('resources/admin/logout', 'App\Http\Controllers\Auth\AuthenticatedSessionController@logout');


    Route::controller(ItemsController::class)->group(function () {
        Route::get('/admin/all-item', 'Index')->name('allitems');
        Route::get('/admin/manage-item', 'ManageItems')->name('manageitems');
        Route::get('/admin/all-item/search', 'SearchItem')->name('searchitem');
        Route::get('/admin/add-items', 'AddItems')->name('additems');
        Route::post('/admin/store-item', 'StoreItem')->name('store-item');
        Route::get('/admin/edit-item/{id}', 'EditItem')->name('edititem');
        Route::get('/admin/edit-item-img/{id}', 'EditItemImg')->name('edititemimg');
        Route::post('/admin/update-item-img', 'UpdateItemImg')->name('updateitemimg');
        Route::post('/admin/update-item', 'UpdateItem')->name('updateitem');
        Route::get('/admin/delete-item/{id}', 'DeleteItem')->name('deleteitem');
    });

    Route::controller(ParameterReportController::class)->group(function () {
        Route::get('/admin/parameter-report', 'Index')->name('parameterreport');
    });

    Route::controller(DiseaseReportController::class)->group(function () {
        Route::get('/admin/disease-report', 'Index')->name('diseasereport');
    });

    Route::controller(ItemsController::class)->group(function () {
        Route::get('/admin/daftar-barang', 'index')->name('daftarbarang');
        Route::get('/admin/daftar-barang/add-daftar-barang', 'addDaftarBarang')->name('adddaftarbarang');
        Route::post('/admin/daftar-barang/add-daftar-barang', 'addDaftarBarang')->name('adddaftarbarang');
        // GET request untuk menampilkan form tambah barang
        Route::get('/admin/daftar-barang/add-daftar-barang', 'addDaftarBarang')->name('adddaftarbarang');
        // POST request untuk memproses form tambah barang
        Route::post('/admin/daftar-barang/add-daftar-barang', 'addDaftarBarang')->name('adddaftarbarang'); // Ubah ke store, bukan addDaftarBarang
        // Rute untuk tambah jenis barang baru
        Route::post('/admin/jenis-barang/add', [TypeItems::class, 'addDaftarBarang'])->name('addTypeItems');
        // Route untuk detail barang
        Route::get('/admin/daftar-barang/barang/{id}/detail', 'show')->name('barang.detail');
        // Route untuk edit barang
        Route::get('/admin/daftar-barang/barang/{id}/edit', 'edit')->name('barang.edit');
        // Route untuk update barang
        Route::put('/admin/daftar-barang/barang/{id}/update', 'update')->name('barang.update'); // Perbaiki route untuk update
        // Route untuk delete barang
        Route::delete('/admin/daftar-barang/barang/{id}', 'destroy')->name('barang.delete');

        Route::post('/add-penyakit', [ItemsController::class, 'addPenyakit'])->name('addPenyakit');

        Route::post('/add-jenis-barang', [ItemsController::class, 'addTypeItems'])->name('addTypeItems');
        Route::delete('/delete-jenis-barang/{id}', [ItemsController::class, 'deleteTypeItems'])->name('deleteTypeItems');
        Route::post('/add-kolam', [ItemsController::class, 'addKolam'])->name('addKolam');

    });



    // Route::controller(FoodsController::class)->group(function () {
    //     Route::get('/admin/all-food', 'Index')->name('allfoods');
    //     Route::get('/admin/all-food/search', 'SearchFood')->name('searchfood');
    //     Route::get('/admin/add-food', 'AddFood')->name('addfoods');
    //     Route::post('/admin/store-food', 'StoreFood')->name('store-food');
    //     Route::get('/admin/edit-food/{id}','EditFood')->name('editfood');
    //     Route::get('/admin/edit-food-img/{id}', 'EditFoodImg')->name('editfoodimg');
    //     Route::post('/admin/update-food-img', 'UpdateFoodImg')->name('updatefoodimg');
    //     Route::post('/admin/update-food', 'UpdateFood')->name('updatefood');
    //     Route::get('/admin/delete-food/{id}','DeleteFood')->name('deletefood');
    // });

    Route::controller(FoodTypeController::class)->group(function () {
        Route::get('/admin/all-fo od-type', 'Index')->name('allfoodtype');
        // Route::get('/admin/food-type/search', 'SearchFoodType')->name('searchfoodtype');
        Route::get('/admin/add-food-type', 'AddFoodType')->name('addfoodtype');
        Route::post('/admin/store-food-type', 'StoreFoodType')->name('storefoodtype');
        Route::get('/admin/edit-food-type/{id}', 'EditFoodType')->name('editfoodtype');
        Route::post('/admin/update-food-type', 'UpdateFoodType')->name('updatefoodtype');
        Route::get('/admin/delete-food-type/{id}', 'DeleteFoodType')->name('deletefoodtype');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/admin/all-users', 'Index')->name('allusers');
        Route::get('/admin/search-users/search', 'SearchUsers')->name('searchusers');
        Route::get('/admin/add-users', 'AddUsers')->name('add-users');
        Route::post('/admin/store-users', 'StoreUsers')->name('storeusers');
        Route::get('/admin/edit-users/{id}', 'EditUsers')->name('editusers');
        Route::post('/admin/update-users', 'UpdateUsers')->name('update-users');
        Route::get('/admin/delete-users/{id}', 'DeleteUsers')->name('deleteusers');
    });

    Route::controller(DiagnosaController::class)->group(function () {
        Route::get('/admin/all-diagnosa', 'Index')->name('allDiagnosaPenyakit');
        Route::get('/admin/search-diagnosa', 'SearchDiagnosa')->name('searchdiagnosa');
        Route::get('/admin/add-diagnosa', 'AddDiagnosa')->name('add-diagnosa');
        Route::post('/admin/store-diagnosa', 'StoreDiagnosa')->name('storediagnosa');
        Route::get('/admin/edit-diagnosa/{id}', 'editDiagnosa')->name('editdiagnosa');
        Route::post('/admin/update-diagnosa/{id}', 'updateDiagnosa')->name('update-diagnosa');
        Route::get('/admin/delete-diagnosa/{id}', 'deleteDiagnosa')->name('deletediagnosa');
        Route::get('/admin/show-diagnosa/{id}', 'showDiagnosa')->name('showdiagnosa');
    });


    Route::controller(OrderController::class)->group(function () {
        Route::get('/admin/pending-order', 'Index')->name('pendingorder');
        Route::get('/admin/pending-order/search', 'SearchPending')->name('searchorder');
        Route::get('/admin/history-order', 'IndexHistory')->name('historyorder');
        Route::get('/admin/view-order/{id}', 'ViewOrder')->name('vieworder');
        Route::get('/admin/update-order/{id}', 'UpdateOrder')->name('updateorder');
        Route::get('/admin/delete-order/{id}', 'DeleteOrder')->name('deleteorder');
    });

    Route::controller(AdminProfileController::class)->group(function () {
        Route::get('/admin/admin-profile', 'Index')->name('profile');
        Route::post('/admin/store-profile', 'StoreProfile')->name('storeprofile');
        Route::get('/admin/pending-order/search', 'SearchPending')->name('searchorder');
        Route::get('/admin/history-order', 'IndexHistory')->name('historyorder');
        Route::get('/admin/view-order/{id}', 'ViewOrder')->name('vieworder');
        Route::get('/admin/update-order/{id}', 'UpdateOrder')->name('updateorder');
        Route::get('/admin/delete-order/{id}', 'DeleteOrder')->name('deleteorder');
        Route::post('/admin/profile', [AdminProfileController::class, 'StoreProfile'])->name('storeprofile');

    });

    Route::controller(PcvController::class)->group(function () {
        Route::get('/admin/pcv-page', 'Index')->name('pcv');
        Route::post('/admin/predict', 'Result')->name('predict');
        Route::post('/admin/store-profile', 'StoreProfile')->name('storeprofile');
        Route::get('/admin/pending-order/search', 'SearchPending')->name('searchorder');
        Route::get('/admin/history-order', 'IndexHistory')->name('historyorder');
        Route::get('/admin/view-order/{id}', 'ViewOrder')->name('vieworder');
        Route::get('/admin/update-order/{id}', 'UpdateOrder')->name('updateorder');
        Route::get('/admin/delete-order/{id}', 'DeleteOrder')->name('deleteorder');
    });


    Route::get('/routes', function () {
        $routeCollection = Route::getRoutes();
        foreach ($routeCollection as $value) {
            echo $value->getActionName();
            echo "<br/>";
        }
    });

    Route::group(['prefix' => 'payment-mobile'], function () {
        Route::get('/', 'PaymentController@payment')->name('payment-mobile');
        Route::get('set-payment-method/{name}', 'PaymentController@set_payment_method')->name('set-payment-method');
    });
    Route::post('pay-paypal', 'PaypalPaymentController@payWithpaypal')->name('pay-paypal');
    Route::get('paypal-status', 'PaypalPaymentController@getPaymentStatus')->name('paypal-status');
    Route::get('payment-success', 'PaymentController@success')->name('payment-success');
    Route::get('payment-fail', 'PaymentController@fail')->name('payment-fail');

    // Route::controller(CategoryController::class)->group(function () {
    //     Route::get('/admin/all-category', 'Index')->name('allcategory');
    //     Route::get('/admin/add-category', 'AddCategory')->name('addcategory');
    //     Route::post('/admin/store-category', 'StoreCategory')->name('storecategory');
    //     Route::get('/admin/edit-category/{id}','EditCategory')->name('editcategory');
    //     Route::post('/admin/update-category', 'UpdateCategory')->name('updatecategory');
    //     Route::get('/admin/delete-category/{id}','DeleteCategory')->name('deletecategory');
    // });



    // Route::controller(SubCategoryController::class)->group(function () {
    //     Route::get('/admin/all-subcategory', 'Index')->name('allsubcategory');
    //     Route::get('/admin/add-subcategory', 'AddSubCategory')->name('addsubcategory');
    //     Route::post('/admin/store-subcategory', 'StoreSubCategory')->name('storesubcategory');
    //     Route::get('/admin/edit-subcategory/{id}','EditSubCat')->name('editsubcat');
    //     Route::get('/admin/delete-subcategory/{id}','DeleteSubCat')->name('deletesubcat');
    //     Route::post('/admin/update-subcategory', 'UpdateSubcat')->name('updatesubcat');
    // });

    // Route::controller(ProductController::class)->group(function () {
    //     Route::get('/admin/all-products', 'Index')->name('allproducts');
    //     Route::get('/admin/add-product', 'AddProduct')->name('addproduct');
    //     Route::post('/admin/store-product', 'StoreProduct')->name('storeproduct');
    //     Route::get('/admin/edit-product-img/{id}', 'EditProductImg')->name('editproductimg');
    //     Route::post('/admin/update-product-img', 'UpdateProductImg')->name('updateproductimg');
    //     Route::get('/admin/edit-product/{id}', 'EditProduct')->name('editproduct');
    //     Route::post('/admin/update-product', 'UpdateProduct')->name('updateproduct');
    //     Route::get('/admin/delete-product/{id}', 'DeleteProduct')->name('deleteproduct');
    // });

});

Route::get('/userprofile', [DashboardController::class, 'Index']);
Route::middleware('auth')->group(function () {
    Route::get('resources/admin/logout', [DashboardController::class, 'AdminLogout'])->name('adminlogout');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



// require __DIR__.'/auth.php';
Route::get('password/reset/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

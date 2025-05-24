<?php

use App\Http\Controllers\Api\V1\CustomerController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\DashboardController;
use App\Http\Controllers\Api\V1\SatuanController;
use App\Http\Controllers\Api\V1\FoodTypeController;
// use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Api\V1\OrderController;
use App\Http\Controllers\Api\V1\ItemsController;
use App\Http\Controllers\Api\V1\ParameterReportController;
use App\Http\Controllers\Api\V1\DiseaseReportController;
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\SubCategoryController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\TransaksiController;
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
use App\Http\Controllers\Api\V1\SupplierController;
use App\Models\TypeItems;
use App\Http\Controllers\Api\V1\TokoController;
use App\Models\Produk;
use App\Models\Supplier;
use App\Http\Controllers\Api\V1\ProdukController;
use App\Http\Controllers\Api\V1\DeliveryShoppingController;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Api\V1\CartController;
use App\Http\Controllers\Api\V1\LaporanController;
use App\Http\Controllers\Api\V1\LaporanTransaksiController;
use App\Http\Controllers\Api\V1\ForecastController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Api\V1\AddressController;
use App\Http\Controllers\Api\V1\PaymentController;

use App\Http\Controllers\Api\V1\DetailProdukController;


// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    $produk = Produk::orderBy('IdProduk', 'desc')->take(7)->get();
    return view('welcome', compact('produk'));
});

// Add dashboard route
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('admin/dashboard', 'Index')->name('admindashboard');
    });

    Route::controller(AdminProfileController::class)->group(function () {
        Route::get('/admin/admin-profile', 'Index')->name('profile');
        Route::post('/admin/store-profile', 'StoreProfile')->name('storeprofile');
    });
});


    Route::controller(DetailProdukController::class)->group(function () {
        Route::get('/admin/detail-produk', 'index')->name('detail.produk');
        Route::get('/detail-produk/{id}', [DetailProdukController::class, 'show'])->name('detail.produk');
        Route::get('/admin/produk', [DetailProdukController::class, 'indexAdmin'])->name('admin.produk.index');
    });


Route::controller(ItemsController::class)->group(function () {
    Route::get('/admin/all-item', 'Index')->name('allitems');
    Route::get('/admin/manage-item', 'ManageItems')->name('manageitems');
    Route::get('/admin/all-item/search', 'SearchItem')->name('searchitem');
    Route::get('/admin/add-items', 'AddItems')->name('additems');
    Route::post('/admin/store-item', 'StoreItem')->name('store-item');
    Route::get('/admin/edit-item/{id}', 'EditItem')->name('edititem');
    Route::post('/admin/update-item', 'UpdateItem')->name('updateitem');
    Route::get('/admin/delete-item/{id}', 'DeleteItem')->name('deleteitem');
        Route::get('/admin/keluar-barang', 'KeluarBarang')->name('exititems');
        Route::post('/admin/store-keluar-barang', 'StoreKeluarBarang')->name('store-exititems');
    Route::get('/admin/keluar-barang', 'KeluarBarang')->name('exititems');
    Route::post('/admin/store-keluar-barang', 'StoreKeluarBarang')->name('store-exititems');
});

    Route::post('/predict', [ForecastController::class, 'predict']);

Route::controller(SatuanController::class)->group(function () {
    Route::get('/admin/all-satuan', 'Index')->name('allsatuan');
    Route::get('/admin/manage-satuan', 'ManageSatuan')->name('managesatuan');
    Route::get('/admin/all-satuan/search', 'SearchSatuan')->name('searchsatuan');
    Route::get('/admin/add-satuan', 'AddSatuan')->name('addsatuan');
    Route::post('/admin/store-satuan', 'StoreSatuan')->name('store-satuan');
    Route::get('/admin/edit-satuan/{id}', 'EditSatuan')->name('editsatuan');
    Route::post('/admin/update-satuan', 'UpdateSatuan')->name('updatesatuan');
    Route::get('/admin/delete-satuan/{id}', 'DeleteSatuan')->name('deletesatuan');
});

Route::controller(TransaksiController::class)->group(function () {
    Route::get('/admin/all-transaksi', 'Index')->name('alltransaksi');
    Route::get('/admin/manage-transaksi', 'ManageTransaksi')->name('managetransaksi');
    Route::get('/admin/all-transaksi/search', 'SearchTransaksi')->name('searchtransaksi');
    Route::get('/admin/add-transaksi', 'AddTransaksi')->name('addtransaksi');
    Route::post('/admin/store-transaksi', 'StoreTransaksi')->name('store-transaksi');
    Route::get('/admin/edit-transaksi/{id}', 'EditTransaksi')->name('edittransaksi');
    Route::post('/admin/update-transaksi', 'UpdateTransaksi')->name('updatetransaksi');
    Route::get('/admin/delete-transaksi/{id}', 'DeleteTransaksi')->name('deletetransaksi');
});



Route::middleware(['auth'])->group(function () {
    Route::controller(TypeItemsController::class)->group(function () {
        Route::get('/admin/all-type', 'Index')->name('alltype');
        Route::get('/admin/all-type/search', 'SearchType')->name('searchtype');
        Route::get('/admin/add-type', 'AddType')->name('addtype');
        Route::post('/admin/store-type', 'StoreType')->name('store-type');
        Route::get('/admin/edit-type/{id}', 'EditType')->name('edittype');
        Route::post('/admin/update-type', 'UpdateType')->name('updatetype');
        Route::get('/admin/delete-type/{id}', 'DeleteType')->name('deletetype');
    });
});

Route::get('/admin/all-laporan', [LaporanController::class, 'index'])->name('alllaporan');

Route::get('/admin/laporantransaksi', [LaporanTransaksiController::class, 'index'])->name('laporan-transaksi');



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

    Route::post('/add-jenis-barang', [ItemsController::class, 'addTypeItems'])->name('addTypeItems');
    Route::delete('/delete-jenis-barang/{id}', [ItemsController::class, 'deleteTypeItems'])->name('deleteTypeItems');
});

    Route::controller(TokoController::class)->group(function () {
        Route::get('/tokodashboard', function () {return view('toko.dashboardToko');})->name('tokodashboard');
        Route::get('/tokodashboard', [TokoController::class, 'tokodashboard'])->name('tokodashboard');


        Route::get('/shop', function () {return view('toko.dashboardToko');})->name('shop');
        Route::get('/keranjang', function () {return view('toko.dashboardToko');})->name('keranjang');
        Route::get('/faq', function () {return view('toko.dashboardToko');})->name('faq');
        Route::get('/lacak', function () {return view('toko.dashboardToko');})->name('lacak');
        Route::get('/kontak', function () {return view('toko.dashboardToko');})->name('kontak');
    });
    Route::controller(LaporanController::class)->group(function () {
        Route::get('/admin/laporanbarang', 'index')->name('laporanbarang');
        Route::get('admin/detaillaporanbarang/{id}', 'show')->name('admin.detaillaporanbarang');
        Route::get('/admin/laporanbarang/export-pdf', 'exportPdf')->name('laporanbarang.exportpdf');
        Route::get('/admin/laporanbarang/{id}/export-pdf', 'exportPdfDetail')->name('laporanbarang.exportpdf.detail');
        Route::delete('/admin/laporanbarang/{id}', 'destroy')->name('laporanbarang.destroy');
    });

    Route::get('/admin/laporantransaksi', [LaporanTransaksiController::class, 'index'])->name('laporan-transaksi');


    Route::controller(ParameterReportController::class)->group(function () {
        Route::get('/admin/parameter-report', 'Index')->name('parameterreport');
    });


    Route::controller(ProdukController::class)->group(function () {
        // Tampilkan semua produk
        Route::get('/admin/all-produk', 'index')->name('allproduk');
        // Tampilkan form tambah produk
        Route::get('/admin/add-produk', 'addProduk')->name('addproduk');
        // Proses form tambah produk
        Route::post('/admin/store-produk', 'storeProduk')->name('storeproduk');
        // Form edit produk
        Route::get('/admin/all-produk/{id}/edit', 'editProduk')->name('editproduk');
        // Update produk
        Route::put('/admin/all-produk/{id}/update', 'updateProduk')->name('updateproduk');
        // Hapus produk
        Route::delete('/admin/all-produk/{id}', 'deleteProduk')->name('deleteproduk');
        // Cari produk
        Route::get('/admin/search-produk', 'searchProduk')->name('searchproduk');
        // API get list produk (JSON)
        Route::get('/api/produk', 'get_produk_list')->name('getproduk');
    });

    Route::controller(TransaksiController::class)->group(function () {
        // Tampilkan semua produk
        Route::get('/admin/all-transaksi', 'index')->name('alltransaksi');
        // Tampilkan form tambah produk
        Route::get('/admin/all-transaksi/{id}/terima', 'terimaOrderan')->name('terimaOrderan');
        // Proses form tambah produk
        Route::post('/admin/all-transaksi/{id}/tolak', 'tolakOrderan')->name('tolakOrderan');
        // Form edit produk
        Route::get('/admin/all-produk/{id}/edit', 'editProduk')->name('editproduk');
        // Update produk
        Route::put('/admin/all-produk/{id}/update', 'updateProduk')->name('updateproduk');
        // Hapus produk
        Route::delete('/admin/all-produk/{id}', 'deleteProduk')->name('deleteproduk');
        // Cari produk
        Route::get('/admin/search-produk', 'searchProduk')->name('searchproduk');
        // API get list produk (JSON)
        Route::get('/api/produk', 'get_produk_list')->name('getproduk');
    });




    Route::controller(TransaksiController::class)->group(function () {
        // Tampilkan semua produk
        Route::get('/admin/all-transaksi', 'index')->name('alltransaksi');
        // Tampilkan form tambah produk
        Route::get('/admin/all-transaksi/{id}/terima', 'terimaOrderan')->name('terimaOrderan');
        // Proses form tambah produk
        Route::post('/admin/all-transaksi/{id}/tolak', 'tolakOrderan')->name('tolakOrderan');
        // Form edit produk
        Route::get('/admin/all-produk/{id}/edit', 'editProduk')->name('editproduk');
        // Update produk
        Route::put('/admin/all-produk/{id}/update', 'updateProduk')->name('updateproduk');
        // Hapus produk
        Route::delete('/admin/all-produk/{id}', 'deleteProduk')->name('deleteproduk');
        // Cari produk
        Route::get('/admin/search-produk', 'searchProduk')->name('searchproduk');
        // API get list produk (JSON)
        Route::get('/api/produk', 'get_produk_list')->name('getproduk');
    });
    Route::controller(SupplierController::class)->group(function () {
        // Tampilkan semua supplier
        Route::get('/admin/daftar-supplier', 'index')->name('allsuppliers');
        // Tampilkan form tambah supplier
        Route::get('/admin/daftar-supplier/add', 'addSupplier')->name('addsupplier');
        // Proses form tambah supplier
        Route::post('/admin/daftar-supplier/add', 'storeSupplier')->name('storesupplier');
        // Form edit supplier
        Route::get('/admin/daftar-supplier/{id}/edit', 'editSupplier')->name('editsupplier');
        Route::put('/admin/daftar-supplier/{id}/update', 'updateSupplier')->name('updatesupplier');
        Route::delete('/admin/daftar-supplier/{id}', 'deleteSupplier')->name('deletesupplier');
        Route::get('/admin/search-supplier', 'searchSupplier')->name('searchsupplier');
        Route::get('/api/suppliers', 'get_supplier_list')->name('getsuppliers');
        Route::delete('/supplier/{id}', 'destroy')->name('deletesupplier');

        Route::delete('/supplier/{id}', 'destroy')->name('deletesupplier');

    });

    Route::controller(CustomerController::class)->group(function () {
        // Tampilkan semua supplier
        Route::get('/admin/daftar-customer', 'index')->name('allcustomer');
        // Tampilkan form tambah supplier
        Route::get('/admin/daftar-supplier/add', 'addSupplier')->name('addsupplier');
        // Proses form tambah supplier
        Route::post('/admin/daftar-supplier/add', 'storeSupplier')->name('storesupplier');
        // Form edit supplier
        Route::get('/admin/daftar-supplier/{id}/edit', 'editSupplier')->name('editsupplier');
        // Update supplier
        Route::put('/admin/daftar-supplier/{id}/update', 'updateSupplier')->name('updatesupplier');
        // Hapus supplier
        Route::delete('/admin/daftar-supplier/{id}', 'deleteCustomer')->name('deletecustomer');
        // Cari supplier
        Route::get('/admin/search-supplier', 'searchSupplier')->name('searchsupplier');
        // API get list supplier (JSON)
        Route::get('/api/suppliers', 'get_supplier_list')->name('getsuppliers');
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

    // Forecast routes
    Route::get('/admin/forecast', [ForecastController::class, 'showForm'])->name('forecast.form');
    Route::post('/admin/forecast/predict', [ForecastController::class, 'predict'])->name('predict');
    // Forecast routes
    Route::get('/admin/forecast', [ForecastController::class, 'showForm'])->name('forecast.form');
    Route::post('/admin/forecast/predict', [ForecastController::class, 'predict'])->name('predict');
    Route::get('/admin/forecast/get-sales-data', [ForecastController::class, 'getSalesData'])->name('forecast.get-sales-data');

    Route::get('/routes', function () {
        $routeCollection = Route::getRoutes();
        foreach ($routeCollection as $value) {
            echo $value->getActionName();
            echo "<br/>";
        }
    });

Route::controller(TokoController::class)->group(function () {
    // Route::get('/tokodashboard', function () {return view('toko.dashboardToko');})->name('tokodashboard');
    Route::get('/tokodashboard', [TokoController::class, 'tokodashboard'])->name('tokodashboard');
    Route::get('/search', [TokoController::class, 'search'])->name('searchProduct');
    Route::get('/shop', function () {return view('toko.dashboardToko');})->name('shop');
    Route::get('/cart', function () {return view('toko.cart');})->name('cart');
    Route::get('/faq', function () {return view('toko.dashboardToko');})->name('faq');
    Route::get('/lacak', function () {return view('toko.dashboardToko');})->name('lacak');
    Route::get('/kontak', function () {return view('toko.dashboardToko');})->name('kontak');

});

// Cart and Order routes
Route::middleware(['auth'])->group(function () {
    Route::controller(CartController::class)->group(function () {
        Route::get('/cart', 'index')->name('cart');
        Route::match(['get', 'post'], '/details', 'details')->name('details');
        Route::post('/save-address', 'saveAddress')->name('save.address');
        Route::post('/save-shipping', 'saveShipping')->name('save.shipping');
        Route::get('/shipping', fn () => view('toko.shipping'))->name('shipping');
        Route::get('/payment', fn () => view('toko.payment'))->name('payment');
        Route::get('/review', fn () => view('toko.review'))->name('review');
        
        // API Cart
        Route::post('/cart/add', 'add')->name('cart.add');
        Route::post('/cart/remove/{id}', 'remove')->name('cart.remove');
        Route::post('/cart/decrease', 'decrease')->name('cart.decrease');
        Route::post('/cart/update/{id}', 'update')->name('cart.update');
    });

    // Order routes
    Route::controller(OrderController::class)->group(function () {
        Route::post('/confirm-order', 'confirmOrder')->name('confirm.order');
    });

    Route::controller(AddressController::class)->group(function () {
        Route::get('/addresses', 'index')->name('addresses.index');
        Route::post('/addresses', 'store')->name('addresses.store');
        Route::post('/addresses/{address}/default', 'setDefault')->name('addresses.default');
        Route::delete('/addresses/{address}', 'destroy')->name('addresses.destroy');
    });
});



// Forecast routes
Route::get('/admin/forecast', [ForecastController::class, 'showForm'])->name('forecast.form');
Route::post('/admin/forecast/predict', [ForecastController::class, 'predict'])->name('predict');

Route::get('/routes', function () {
    $routeCollection = Route::getRoutes();
    foreach ($routeCollection as $value) {
        echo $value->getActionName();
        echo "<br/>";
    }
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

// Add registration routes
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/checkout', [DeliveryShoppingController::class, 'index'])->name('checkout');


Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');

// Midtrans Payment Routes
Route::controller(PaymentController::class)->group(function () {
    Route::post('/payment/create-snap-token', 'createSnapToken')->name('payment.create-snap-token');
    Route::post('/payment/notification', 'handleNotification')->name('payment.notification');
});

Route::post('/set-midtrans-paid', function (Illuminate\Http\Request $request) {
    session(['midtrans_paid' => $request->paid]);
    return response()->json(['success' => true]);
});

Route::post('/set-payment-method', function (Illuminate\Http\Request $request) {
    session(['payment_method' => $request->method]);
    session(['midtrans_paid' => $request->paid]);
    return response()->json(['success' => true]);
});
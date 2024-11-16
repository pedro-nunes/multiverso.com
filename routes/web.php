<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\AddressController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ManufacturerController;

Route::middleware('auth')->name('admin.')->prefix('admin')->group(function () {
    Route::controller(DashController::class)->group(function () {
        Route::get('/', 'index')->name('dash');
    });
    Route::controller(ProductController::class)->name('product.')->group(function () {
        Route::get('/produtos', 'index')->name('index');
        Route::get('/produto/cadastrar', 'create')->name('create');
        Route::post('/produtos', 'store')->name('store');
        Route::get('/produto/{id}/editar', 'edit')->name('edit');
        Route::put('/produto/{id}', 'update')->name('update');
        Route::delete('/produto/{id}', 'destroy')->name('destroy');
    });
    Route::controller(CategoryController::class)->name('category.')->group(function () {
        Route::get('/categorias', 'index')->name('index');
        Route::post('/categorias', 'store')->name('store');
        Route::put('/categoria/{id}', 'update')->name('update');
        Route::delete('/categoria/{id}', 'destroy')->name('destroy');
    });
    Route::controller(ManufacturerController::class)->name('manufacturer.')->group(function () {
        Route::get('/fabricantes', 'index')->name('index');
        Route::post('/fabricantes', 'store')->name('store');
        Route::put('/fabricante/{id}', 'update')->name('update');
        Route::delete('/fabricante/{id}', 'destroy')->name('destroy');
    });
    Route::controller(VendorController::class)->name('vendor.')->group(function () {
        Route::get('/fornecedores', 'index')->name('index');
        Route::get('/fornecedor/cadastrar', 'create')->name('create');
        Route::post('/fornecedores', 'store')->name('store');
        Route::get('/fornecedor/{id}/editar', 'edit')->name('edit');
        Route::put('/fornecedor/{id}', 'update')->name('update');
        Route::delete('/fornecedor/{id}', 'destroy')->name('destroy');
    });
    Route::controller(StockController::class)->name('stock.')->group(function () {
        Route::get('/estoque', 'index')->name('index');
        Route::get('/estoque/produto/{code?}', 'getProduct')->name('getProduct');
        Route::post('/stoque/store', 'store')->name('store');
    });
    Route::controller(CustomerController::class)->name('customer.')->group(function () {
        Route::get('/clientes', 'index')->name('index');
        Route::get('/cliente/cadastrar', 'create')->name('create');
        Route::post('/clientes', 'store')->name('store');
        Route::get('/cliente/{id}/editar', 'edit')->name('edit');
        Route::put('/cliente/{id}', 'update')->name('update');
        Route::delete('/cliente/{id}', 'destroy')->name('destroy');
    });
    Route::controller(AddressController::class)->name('address.')->group(function () {
        Route::get('/endereco/cadastrar/{id}', 'create')->name('create');
        Route::post('/endereco/{id}', 'store')->name('store');
        Route::get('/endereco/{id}/editar', 'edit')->name('edit');
        Route::put('/endereco/{id}', 'update')->name('update');
        Route::delete('/endereco/{id}', 'destroy')->name('destroy');
    });
    Route::controller(OrderController::class)->name('order.')->group(function () {
        Route::get('/pedidos', 'index')->name('index');
        Route::get('/pedido/cadastrar', 'create')->name('create');
        Route::post('/pedidos', 'store')->name('store');
        Route::get('/pedido/cliente/{document?}', 'getCustomer')->name('getCustomer');
        Route::get('/pedido/frete/{zip?}', 'getDeliveryPrice')->name('getDeliveryPrice');
    });
    Route::controller(UserController::class)->name('user.')->group(function () {
        Route::get('/usuarios', 'index')->name('index');
        Route::get('/usuario/cadastrar', 'create')->name('create');
        Route::post('/usuarios', 'store')->name('store');
        Route::get('/usuario/{id}/editar', 'edit')->name('edit');
        Route::put('/usuario/{id}', 'update')->name('update');
    });
    // Rota de busca geral
});


Route::middleware('auth')->get('/', function () {
    return redirect()->route('admin.dash');
    //return view('admin.login');
    //return view('welcome');
})->name('admin.login');

Auth::routes([
    'login' => true,
    'logout' => true,
    'register' => false,
    'reset' => false,
    'confirm' => false,
    'verify' => false,
  ]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
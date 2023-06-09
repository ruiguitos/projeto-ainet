<?php

use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\CamisolaController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CorController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\EncomendaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
});

Auth::routes(['verify' => true]);

#############################################################################################################################################################################

Route::view('about-us', 'about-us');

Route::middleware('admin')->group(function () {

});


Route::group(['middleware' => 'admin'], function () {

    Route::resource('dashboard.index', DashboardController::class);
    Route::resource('dashboard.charts', DashboardController::class);
    Route::resource('dashboard.tables', DashboardController::class);
    Route::resource('users.admins.index', UserController::class);
    Route::resource('users.clientes.index', UserController::class);
    Route::resource('users.empregados.index', UserController::class);
    Route::resource('cores.index', CorController::class);
    Route::resource('categorias.index', CategoriaController::class);
    Route::resource('encomendas.index', EncomendaController::class);


    /*
     * Admin Dashboard                                                                  //TODO
     */
    Route::view('/dashboard', 'dashboard.index')
        ->middleware('verified');


    Route::get('/dashboard/charts', [DashboardController::class, 'indexCharts'])
        ->name('dashboard.charts');

    Route::get('/dashboard', [UserController::class, 'indexCount']);


    /*
     * Perfil                                                                  //TODO
     */

    Route::get('/perfil/{id}/edit', [PerfilController::class, 'edit'])
        ->name('perfil.shared.edit')
        ->middleware('auth');

    Route::put('/perfil/{id}', [PerfilController::class, 'update'])
        ->name('perfil.shared.update')
        ->middleware('auth');

    Route::delete('/perfil/{id}', [PerfilController::class, 'destroy'])
        ->name('perfil.shared.destroy')
        ->middleware('auth');

    Route::delete('/perfil/{id}/photo', [PerfilController::class, 'destroy_photo'])
        ->name('perfil.photo.destroy')
        ->middleware('auth');

    /*
     * Categorias
     */
    Route::get('/categorias', [CategoriaController::class, 'index'])
        ->name('categorias.index')
        ->middleware('verified');

    Route::get('/categorias/{categoria}/edit', [CategoriaController::class, 'edit'])
        ->name('categorias.edit');
//        ->middleware('verified')
//        ->middleware('can:view,categoria');

    Route::get('/categorias/create', [CategoriaController::class, 'create'])
        ->name('categorias.shared.create');
//        ->middleware('verified');
//        ->middleware('can:create,App\Models\Categoria');

    Route::post('/categorias/store', [CategoriaController::class, 'store'])
        ->name('categorias.store');
//        ->middleware('verified');
//        ->middleware('can:create,App\Models\Categoria');

    Route::put('/categorias/{categoria}/update', [CategoriaController::class, 'update'])
        ->name('categorias.shared.update');
//        ->middleware('verified')
//        ->middleware('can:update,categoria');

    Route::delete('/categorias/{categoria}/destroy', [CategoriaController::class, 'destroy'])
        ->name('categorias.shared.destroy');
//        ->middleware('verified')
//        ->middleware('can:delete,categoria');


#############################################################################################################################################################################
    /*
     * Cores
     */
    Route::get('/cores', [CorController::class, 'index'])
        ->name('cores.index')
        ->middleware('verified');

    Route::get('/cores/{cor}/edit', [CorController::class, 'edit'])
        ->name('cores.shared.edit')
//        ->middleware('can:view,cor')
        ->middleware('verified');

    Route::get('/cores/create', [CorController::class, 'create'])
        ->name('cores.shared.create')
//        ->middleware('can:create,App\Models\Cor')
        ->middleware('verified');

    Route::post('/cores/store', [CorController::class, 'store'])
        ->name('cores.store')
//        ->middleware('can:create,App\Models\Cor')
        ->middleware('verified');

    Route::put('/cores/{cor}/update', [CorController::class, 'update'])
        ->name('cores.shared.update')
//        ->middleware('can:update,cor')
        ->middleware('verified');

    Route::delete('/cores/{cor}/destroy', [CorController::class, 'destroy'])->name('cores.shared.destroy')
//        ->middleware('can:delete,cor')
        ->middleware('verified');

#############################################################################################################################################################################
    /*
     * Users Admins
     */
    Route::view('/users/admins', 'users.admins.index')
        ->middleware('verified');

    Route::get('/users/admins', [App\Http\Controllers\UserController::class, 'indexAdmins'])
        ->name('users.admins.index')
        ->middleware('verified');

    Route::put('/users/admins/{id}/toggle-blocked', [UserController::class, 'toggleBlocked'])
        ->name('users.admins.index')
        ->middleware('verified');

    Route::get('users/admins/{id}/toggle-blocked', [UserController::class, 'toggleBlocked'])
        ->name('users.admins.index');

    Route::get('/users/admins/{id}/edit', [UserController::class, 'editA'])
        ->name('users.admins.shared.edit')
        ->middleware('verified');
//        ->middleware('can:view,admin');

    Route::get('/users/admins/create', [UserController::class, 'createA'])
        ->name('users.admins.shared.create')
//        ->middleware('can:create,App\Models\User')
        ->middleware('verified');

    Route::post('/users/admins/store', [UserController::class, 'storeA'])
        ->name('users.admins.shared.store')
//        ->middleware('can:create,App\Models\User')
        ->middleware('verified');

    Route::put('/users/admins/{id}/update', [UserController::class, 'updateA'])
        ->name('users.admins.shared.update')
//        ->middleware('can:update,admin')
        ->middleware('verified');

    Route::delete('/users/admins/{id}/destroy', [UserController::class, 'destroyA'])
        ->name('users.admins.shared.destroy')
//        ->middleware('can:delete,admin')
        ->middleware('verified');

    Route::delete('users/{user}/photo', [UserController::class, 'destroy_fotoA'])->name('users.admins.photo.destroy')
        ->middleware('can:update,user');

#############################################################################################################################################################################
    /*
     * Users clientes
     */
    Route::view('/users/clientes', 'users.clientes.index');

    Route::get('/users/clientes', [App\Http\Controllers\UserController::class, 'indexClientes'])
        ->name('users.clientes.index')
        ->middleware('verified');

    Route::put('/users/clientes/{id}/toggle-blocked', [UserController::class, 'toggleBlocked'])
        ->name('users.clientes.index')
        ->middleware('verified');

    Route::get('/users/clientes/{id}/toggle-blocked', [UserController::class, 'toggleBlocked'])
        ->name('users.clientes.index');

    Route::get('/users/clientes/{id}/edit', [UserController::class, 'editC'])
        ->name('users.clientes.shared.edit')
//        ->middleware('can:view,cliente')
        ->middleware('verified');

    Route::get('/users/clientes/create', [UserController::class, 'createC'])
        ->name('users.clientes.shared.create')
//        ->middleware('can:create,App\Models\User')
        ->middleware('verified');

    Route::post('/users/clientes/store', [UserController::class, 'storeC'])
        ->name('users.clientes.shared.store')
//        ->middleware('can:create,App\Models\User')
        ->middleware('verified');

    Route::put('/users/clientes/{id}/update', [UserController::class, 'updateC'])
        ->name('users.clientes.shared.update')
//        ->middleware('can:update,cliente')
        ->middleware('verified');

    Route::delete('/users/clientes/{id}/destroy', [UserController::class, 'destroyC'])
        ->name('users.clientes.shared.destroy')
//        ->middleware('can:delete,cliente')
        ->middleware('verified');
    Route::delete('users/{user}/photo', [UserController::class, 'destroy_fotoC'])->name('users.clientes.photo.destroy')
        ->middleware('can:update,user');

#############################################################################################################################################################################
    /*
     * Users Empregados
     */
    Route::view('/users/empregados', 'users.empregados.index');

    Route::get('/users/empregados', [App\Http\Controllers\UserController::class, 'indexEmpregados'])
        ->name('users.empregados.index')
        ->middleware('verified');

    Route::put('/user/empregados/{id}/toggle-blocked', [UserController::class, 'toggleBlocked'])
        ->name('users.empregados.index')
        ->middleware('verified');

    Route::get('/users/empregados/{id}/toggle-blocked', [UserController::class, 'toggleBlocked'])
        ->name('users.empregados.index');

    Route::get('/users/empregados/{id}/edit', [UserController::class, 'editE'])
        ->name('users.empregados.shared.edit')
//        ->middleware('can:view,empregado')
        ->middleware('verified');

    Route::get('/users/empregados/create', [UserController::class, 'createE'])
        ->name('users.empregados.shared.create')
//        ->middleware('can:create,App\Models\User')
        ->middleware('verified');

    Route::post('/users/empregados/store', [UserController::class, 'storeE'])
        ->name('users.empregados.shared.store')
//        ->middleware('can:create,App\Models\User')
        ->middleware('verified');

    Route::put('/users/empregados/{id}/update', [UserController::class, 'updateE'])
        ->name('users.empregados.shared.update')
//        ->middleware('can:update,empregado')
        ->middleware('verified');

    Route::delete('/users/empregados/{id}/destroy', [UserController::class, 'destroyE'])
        ->name('users.empregados.shared.destroy')
//        ->middleware('can:delete,empregado')
        ->middleware('verified');
    Route::delete('users/{user}/photo', [UserController::class, 'destroy_fotoE'])->name('users.empregados.photo.destroy')
        ->middleware('can:update,user');

#############################################################################################################################################################################
    /*
     * Encomendas
     */

    Route::get('/encomendas/{encomenda}/edit', [EncomendaController::class, 'edit'])
        ->name('encomendas.shared.edit')
//        ->middleware('can:view,encomenda')
        ->middleware('verified');

    Route::put('/encomendas/{id}/update-status', [EncomendaController::class, 'toggleStatus'])
        ->name('encomendas.index')
        ->middleware('verified');

    Route::get('/encomendas/create', [EncomendaController::class, 'create'])
        ->name('encomendas.shared.create')
//        ->middleware('can:create,App\Models\Encomenda')
        ->middleware('verified');

    Route::post('/encomendas/store', [EncomendaController::class, 'store'])
        ->name('encomendas.shared.store')
//        ->middleware('can:create,App\Models\Encomenda')
        ->middleware('verified');

    Route::put('/encomendas/{encomenda}/update', [EncomendaController::class, 'update'])
        ->name('encomendas.shared.update')
//        ->middleware('can:update,encomenda')
        ->middleware('verified');

    Route::delete('/encomendas/{encomenda}/destroy', [EncomendaController::class, 'destroy'])
        ->name('encomendas.shared.destroy')
//        ->middleware('can:delete,encomenda')
        ->middleware('verified');

});

#############################################################################################################################################################################


Route::middleware('auth')->group(function () {

    /*
     * Password                                                                        //TODO
     */
    Route::get('/password/change', [ChangePasswordController::class, 'show'])
        ->name('password.change.show');

    Route::post('/password/change', [ChangePasswordController::class, 'store'])
        ->name('password.change.store');

#############################################################################################################################################################################
    /*
     * Home
     */
    Route::get('/home', [HomeController::class, 'index'])
        ->name('home');


#############################################################################################################################################################################
    /*
     * Catálogo
     */
    Route::get('/catalogo', [CatalogoController::class, 'index'])
        ->name('catalogo.index')
        ->middleware('verified');

    Route::get('/catalogo/{id}', [CatalogoController::class, 'show'])
        ->name('catalogo.details')
        ->middleware('verified');

    Route::view('about-us', 'about-us')->name('about-us');

    ### ESTAMPA

    Route::view('estampa', 'catalogo.estampa')->name('catalogo.estampa');

    Route::get('/estampa', [CatalogoController::class, 'uploadEstampa'])
        ->name('catalogo.estampa')
        ->middleware('verified');

    Route::post('/estampa', [App\Http\Controllers\CatalogoController::class, 'uploadEstampa'])
        ->name('perfil.estampa');

#############################################################################################################################################################################
    /*
     * Camisolas                                                                        //TODO
     */
    Route::get('/camisolas', [CamisolaController::class, 'index'])
        ->name('catalogo.camisola')
        ->middleware('verified');

#############################################################################################################################################################################


#############################################################################################################################################################################
    /*
     * Perfil
     */
    Route::get('/perfil', [CustomerController::class, 'index'])
        ->name('perfil.index')
        ->middleware('auth');

    Route::post('/perfil/foto', [App\Http\Controllers\PerfilController::class, 'updatePhoto'])
        ->name('perfil.shared.updatePhoto');


    Route::get('/perfil/{id}', [App\Http\Controllers\PerfilController::class, 'index'])
        ->name('perfil.index')
        ->middleware('auth');


#############################################################################################################################################################################
    /*
     * Carrinho
     */

    Route::get('/cart', [CartController::class, 'cart'])->name('cart.index')->middleware('auth');
    Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('cart.add')->middleware('auth');
    Route::patch('/update-cart', [CartController::class, 'updateCarrinho'])->middleware('auth');
    Route::delete('/remove-from-cart', [CartController::class, 'removeCarrinho'])->middleware('auth');
    Route::get('/pagamento', [CartController::class, 'pagamento'])->name('pagamento')->middleware('auth');
    Route::post('/concluir', [CartController::class, 'concluirPagamento'])->name('concluir')->middleware('auth');

#############################################################################################################################################################################

#############################################################################################################################################################################
    /*
     * Encomendas
     */
    Route::view('/encomendas/cliente', 'encomendas.clientes');

    Route::get('/encomendas/cliente', [EncomendaController::class, 'encomendaClientes'])
        ->name('encomendas.clientes')
        ->middleware('verified');


    Route::view('/encomendas', 'encomendas.index');
    Route::get('/encomendas', [EncomendaController::class, 'index'])
        ->name('encomendas.index')
        ->middleware('verified');

});

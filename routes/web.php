<?php

use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EncomendaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\CorController;
use App\Http\Controllers\CamisolaController;
use App\Http\Controllers\CartController;


Route::get('/', function () {
    return view('home');
});

Auth::routes(['verify' => true]);

#############################################################################################################################################################################

Route::view('about-us', 'about-us');


Route::middleware('auth')->group(function () {
    Route::resource('dashboard.index', DashboardController::class);
    Route::resource('dashboard.charts', DashboardController::class);
    Route::resource('dashboard.tables', DashboardController::class);
    Route::resource('users.admins.index', UserController::class);
    Route::resource('users.clientes.index', UserController::class);
    Route::resource('users.empregados.index', UserController::class);
    Route::resource('cores.index', CorController::class);
    Route::resource('categorias.index', CategoriaController::class);
    Route::resource('encomendas.index', EncomendaController::class);
});

Route::middleware('auth')->group(function () {

#############################################################################################################################################################################
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
        ->name('catalogo.shared.show')
        ->middleware('verified');

    Route::view('about-us', 'about-us')->name('about-us');
    Route::view('estampa', 'catalogo.estampa')->name('catalogo.estampa');


#############################################################################################################################################################################
    /*
     * Camisolas                                                                        //TODO
     */
    Route::get('/camisolas', [CamisolaController::class, 'index'])
        ->name('catalogo.camisola')
        ->middleware('verified');

#############################################################################################################################################################################


/*
 * Admin Dashboard                                                                  //TODO
 */
    Route::view('/dashboard', 'dashboard.index')
        ->middleware('verified');

//Route::get('/dashboard', [DashboardController::class, 'index'])
//    ->name('dashboard.index')
//    ->middleware('verified');

    Route::get('/dashboard/charts', [DashboardController::class, 'indexCharts'])
        ->name('dashboard.charts');

    Route::get('/dashboard/tables', [DashboardController::class, 'indexTables'])
        ->name('dashboard.tables');

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

#############################################################################################################################################################################
    /*
     * Carrinho                                                                         //TODO
     */
    Route::view('/carrinho', 'carrinho.index')
        ->middleware('verified');

    Route::post('/carrinho/add/{tshirt}', [CarrinhoController::class, 'add'])
        ->name('carrinho.add')
        ->middleware('verified');

    Route::view('/pagamento', 'carrinho.pagamento')
        ->middleware('verified');

//Route::get('carrinho', [EstampaController::class, 'cart'])
//->name('carrinho.index')
//    ->middleware('verified');
//
//Route::post('add-to-cart/{id}', [EstampaController::class, 'addToCart']);
//
//Route::patch('update-cart', [EstampaController::class, 'updateCarrinho']);
//
//Route::delete('remove-from-cart', [EstampaController::class, 'removeCarrinho']);
//
//Route::get('pagamento', [EstampaController::class, 'pagamento'])
//    ->name('pagamento')
//    ->middleware('verified');
//
//Route::post('concluir', [EstampaController::class, 'concluirPagamento'])
//    ->name('concluir')
//    ->middleware('verified');


// Show the cart:
    Route::get('cart', [CartController::class, 'show'])->name('cart.show');

// Confirm (store) the cart and save disciplinas registration on the database:
    Route::post('cart', [CartController::class, 'store'])->name('cart.store');

// Clear the cart:
    Route::delete('cart', [CartController::class, 'destroy'])->name('cart.destroy');


#############################################################################################################################################################################
    /*
     * Categorias
     */
    Route::get('/categorias', [CategoriaController::class, 'index'])
        ->name('categorias.index')
        ->middleware('verified');

    Route::get('/categorias/{categoria}/edit', [CategoriaController::class, 'edit'])
        ->name('categorias.shared.edit')
        ->middleware('verified')
        ->middleware('can:view,categoria');

    Route::get('/categorias/create', [CategoriaController::class, 'create'])
        ->name('categorias.shared.create')
        ->middleware('verified');
//        ->middleware('can:create,App\Models\Categoria');

    Route::post('/categorias/store', [CategoriaController::class, 'store'])
        ->name('categorias.shared.store')
        ->middleware('verified');
//        ->middleware('can:create,App\Models\Categoria');

    Route::put('/categorias/{categoria}/update', [CategoriaController::class, 'update'])
        ->name('categorias.shared.update')
        ->middleware('verified');
//        ->middleware('can:update,categoria');

    Route::delete('/categorias/{categoria}/destroy', [CategoriaController::class, 'destroy'])
        ->name('categorias.shared.destroy')
        ->middleware('verified');
//        ->middleware('can:delete,categoria');


#############################################################################################################################################################################
    /*
     * Cores
     */
    Route::get('/cores', [CorController::class, 'index'])
        ->name('cores.index')
        ->middleware('verified');

//Route::get('/cores', [CorController::class, 'index'])->name('cores.index')
//    ->middleware('can:viewAny,App\Models\Cor')
// ->middleware('verified');;

    Route::get('/cores/{cor}/edit', [CorController::class, 'edit'])
        ->name('cores.shared.edit')
//        ->middleware('can:view,cor')
        ->middleware('verified');

    Route::get('/cores/create', [CorController::class, 'create'])
        ->name('cores.shared.create')
//        ->middleware('can:create,App\Models\Cor')
        ->middleware('verified');

    Route::post('/cores/store', [CorController::class, 'store'])
        ->name('cores.shared.store')
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

    Route::put('/user/admins/{id}/toggle-blocked', [UserController::class, 'toggleBlocked'])
        ->name('users.admins.index')
        ->middleware('verified');

    Route::get('/users/admins/{id}/edit', [UserController::class, 'editAdmin'])
        ->name('users.admins.shared.edit')
        ->middleware('verified');
//        ->middleware('can:view,admin');

    Route::get('/users/admins/create', [UserController::class, 'createAdmin'])
        ->name('users.admins.shared.create')
//        ->middleware('can:create,App\Models\User')
        ->middleware('verified');

    Route::post('/users/admins/store', [UserController::class, 'storeAdmin'])
        ->name('users.admins.shared.store')
//        ->middleware('can:create,App\Models\User')
        ->middleware('verified');

    Route::put('/users/admins/{id}/update', [UserController::class, 'updateAdmin'])
        ->name('users.admins.shared.update')
//        ->middleware('can:update,admin')
        ->middleware('verified');

    Route::delete('/users/admins/{id}/destroy', [UserController::class, 'destroyAdmin'])
        ->name('users.admins.shared.destroy')
//        ->middleware('can:delete,admin')
        ->middleware('verified');

#############################################################################################################################################################################
    /*
     * Users clientes
     */
    Route::view('/users/clientes', 'users.clientes.index');

    Route::get('/users/clientes', [App\Http\Controllers\UserController::class, 'indexClientes'])
        ->name('users.clientes.index')
        ->middleware('verified');

    Route::put('/user/clientes/{id}/toggle-blocked', [UserController::class, 'toggleBlocked'])
        ->name('users.clientes.index')
        ->middleware('verified');

    Route::get('/users/clientes/{id}/edit', [UserController::class, 'edit'])
        ->name('users.clientes.shared.edit')
//        ->middleware('can:view,cliente')
        ->middleware('verified');

    Route::get('/users/clientes/create', [UserController::class, 'create'])
        ->name('users.clientes.shared.create')
//        ->middleware('can:create,App\Models\User')
        ->middleware('verified');

    Route::post('/users/clientes/store', [UserController::class, 'store'])
        ->name('users.clientes.shared.store')
//        ->middleware('can:create,App\Models\User')
        ->middleware('verified');

    Route::put('/users/clientes/{id}/update', [UserController::class, 'update'])
        ->name('users.clientes.shared.update')
//        ->middleware('can:update,cliente')
        ->middleware('verified');

    Route::delete('/users/clientes/{id}/destroy', [UserController::class, 'destroy'])
        ->name('users.clientes.shared.destroy')
//        ->middleware('can:delete,cliente')
        ->middleware('verified');

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

    Route::get('/users/empregados/{id}/edit', [UserController::class, 'edit'])
        ->name('users.empregados.shared.edit')
//        ->middleware('can:view,empregado')
        ->middleware('verified');

    Route::get('/users/empregados/create', [UserController::class, 'create'])
        ->name('users.empregados.shared.create')
//        ->middleware('can:create,App\Models\User')
        ->middleware('verified');

    Route::post('/users/empregados/store', [UserController::class, 'store'])
        ->name('users.empregados.shared.store')
//        ->middleware('can:create,App\Models\User')
        ->middleware('verified');

    Route::put('/users/empregados/{id}/update', [UserController::class, 'update'])
        ->name('users.empregados.shared.update')
//        ->middleware('can:update,empregado')
        ->middleware('verified');

    Route::delete('/users/empregados/{id}/destroy', [UserController::class, 'destroy'])
        ->name('users.empregados.shared.destroy')
//        ->middleware('can:delete,empregado')
        ->middleware('verified');

#############################################################################################################################################################################
    /*
     * Encomendas
     */
    Route::view('/encomendas', 'encomendas.index');
    Route::get('/encomendas', [EncomendaController::class, 'index'])
        ->name('encomendas.index')
        ->middleware('verified');

//Route::get('/cores', [CorController::class, 'index'])->name('cores.index')
//    ->middleware('can:viewAny,App\Models\Cor');

    Route::get('/encomendas/{encomenda}/edit', [EncomendaController::class, 'edit'])
        ->name('encomendas.shared.edit')
        ->middleware('can:view,encomenda')
        ->middleware('verified');

    Route::put('/encomendas/{id}/update-status', [EncomendaController::class, 'toggleStatus'])
        ->name('encomendas.index')
        ->middleware('verified');

   Route::get('/encomendas/create', [EncomendaController::class, 'create'])
        ->name('encomendas.shared.create')
        ->middleware('can:create,App\Models\Encomenda')
        ->middleware('verified');

    Route::post('/encomendas/store', [EncomendaController::class, 'store'])
        ->name('encomendas.shared.store')
        ->middleware('can:create,App\Models\Encomenda')
        ->middleware('verified');

    Route::put('/encomendas/{encomenda}/update', [EncomendaController::class, 'update'])
        ->name('encomendas.shared.update')
        ->middleware('can:update,encomenda')
        ->middleware('verified');

    Route::delete('/encomendas/{encomenda}/destroy', [EncomendaController::class, 'destroy'])
        ->name('encomendas.shared.destroy')
        ->middleware('can:delete,encomenda')
        ->middleware('verified');

});

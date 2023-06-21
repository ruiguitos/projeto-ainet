<?php

use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EncomendaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
//use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\CorController;
use App\Http\Controllers\CamisolaController;


Route::get('/', function () {
    return view('home');
});

Auth::routes();

#######################################################################################################################################
//HOME
Route::get('/home', [HomeController::class, 'index'])->name('home');



#######################################################################################################################################
//CATALOGO
Route::get('/catalogo', [CatalogoController::class, 'index'])->name('catalogo.index');
Route::get('/catalogo/{id}', [CatalogoController::class, 'show'])->name('catalogo.shared.show');


#######################################################################################################################################
//Camisolas
Route::get('/camisolas', [CamisolaController::class, 'index'])->name('catalogo.camisola');




#######################################################################################################################################
//ADMIN DASHBOARD
Route::view('/dashboard', 'dashboard.index');
Route::view('/dashboard/charts', 'dashboard.charts');
Route::view('/dashboard/tables', 'dashboard.tables');




#######################################################################################################################################

//PERFIL
//Route::view('/perfil', 'perfil.index');
Route::get('/perfil', [CustomerController::class, 'index'])->name('perfil.index');
Route::get('/perfil/{user}', [App\Http\Controllers\CustomerController::class, 'indexclientes'])->name('perfil.index');

//Route::get('/perfil/{user}', [CustomerController::class, 'indexclientes'])->name('perfil.index');
//Route::get('/perfil/{user}', [App\Http\Controllers\CustomerController::class, 'indexclientes'])->name('perfil.index');

Route::get('/perfil/{user}/edit', [UserController::class, 'edit'])->name('perfil.shared.edit');
Route::put('/perfil/{user}', [UserController::class, 'update'])->name('perfil.shared.update');
Route::delete('/perfil/{user}', [UserController::class, 'destroy'])->name('perfil.shared.destroy');
Route::delete('/perfil/{user}/photo', [UserController::class, 'destroy_photo'])->name('perfil.photo.destroy');



#######################################################################################################################################
//CARRINHO
Route::view('/carrinho', 'carrinho.index');
Route::post('/carrinho/add/{tshirt}', [CarrinhoController::class, 'add'])->name('carrinho.add');

Route::view('/pagamento', 'carrinho.pagamento');




#######################################################################################################################################
//Categorias
Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');

Route::get('/categorias/{categoria}/edit', [CategoriaController::class, 'edit'])->name('categorias.shared.edit')
    ->middleware('can:view,categoria');
Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('categorias.shared.create')
    ->middleware('can:create,App\Models\Categoria');
Route::post('/categorias/store', [CategoriaController::class, 'store'])->name('categorias.shared.store')
    ->middleware('can:create,App\Models\Categoria');
Route::put('/categorias/{categoria}/update', [CategoriaController::class, 'update'])->name('categorias.shared.update')
    ->middleware('can:update,categoria');
Route::delete('/categorias/{categoria}/destroy', [CategoriaController::class, 'destroy'])->name('categorias.shared.destroy')
    ->middleware('can:delete,categoria');


#######################################################################################################################################
//Cores
Route::get('/cores', [CorController::class, 'index'])->name('cores.index');

//Route::get('/cores', [CorController::class, 'index'])->name('cores.index')
//    ->middleware('can:viewAny,App\Models\Cor');

Route::get('/cores/{cor}/edit', [CorController::class, 'edit'])->name('cores.shared.edit')
    ->middleware('can:view,cor');
Route::get('/cores/create', [CorController::class, 'create'])->name('cores.shared.create')
    ->middleware('can:create,App\Models\Cor');
Route::post('/cores/store', [CorController::class, 'store'])->name('cores.shared.store')
    ->middleware('can:create,App\Models\Cor');
Route::put('/cores/{cor}/update', [CorController::class, 'update'])->name('cores.shared.update')
    ->middleware('can:update,cor');
Route::delete('/cores/{cor}/destroy', [CorController::class, 'destroy'])->name('cores.shared.destroy')
    ->middleware('can:delete,cor');





#######################################################################################################################################
//Users Admins
Route::view('/users/admins', 'users.admins.index');
Route::get('/users/admins', [App\Http\Controllers\UserController::class, 'indexAdmins'])->name('users.admins.index');
Route::put('/user/admins/{id}/toggle-blocked', [UserController::class, 'toggleBlocked'])->name('users.admins.index');

Route::get('/users/admins/{admin}/edit', [UserController::class, 'editAdmin'])->name('users.admins.shared.edit')
    ->middleware('can:view,admin');
Route::get('/users/admins/create', [UserController::class, 'createAdmin'])->name('users.admins.shared.create')
    ->middleware('can:create,App\Models\User');
Route::post('/users/admins/store', [UserController::class, 'storeAdmin'])->name('users.admins.shared.store')
    ->middleware('can:create,App\Models\User');
Route::put('/users/admins/{admin}/update', [UserController::class, 'updateAdmin'])->name('users.admins.shared.update')
    ->middleware('can:update,admin');
Route::delete('/users/admins/{admin}/destroy', [UserController::class, 'destroyAdmin'])->name('users.admins.shared.destroy')
    ->middleware('can:delete,admin');


//Users Clientes
Route::view('/users/clientes', 'users.clientes.index');
Route::get('/users/clientes', [App\Http\Controllers\UserController::class, 'indexClientes'])->name('users.clientes.index');
Route::put('/user/clientes/{id}/toggle-blocked', [UserController::class, 'toggleBlocked'])->name('users.clientes.index');

Route::get('/users/clientes/{cliente}/edit', [UserController::class, 'edit'])->name('users.clientes.shared.edit')
    ->middleware('can:view,cliente');
Route::get('/users/clientes/create', [UserController::class, 'create'])->name('users.clientes.shared.create')
    ->middleware('can:create,App\Models\User');
Route::post('/users/clientes/store', [UserController::class, 'store'])->name('users.clientes.shared.store')
    ->middleware('can:create,App\Models\User');
Route::put('/users/clientes/{cliente}/update', [UserController::class, 'update'])->name('users.clientes.shared.update')
    ->middleware('can:update,cliente');
Route::delete('/users/clientes/{cliente}/destroy', [UserController::class, 'destroy'])->name('users.clientes.shared.destroy')
    ->middleware('can:delete,cliente');

//Users Empregados
Route::view('/users/empregados', 'users.empregados.index');
Route::get('/users/empregados', [App\Http\Controllers\UserController::class, 'indexEmpregados'])->name('users.empregados.index');
Route::put('/user/empregados/{id}/toggle-blocked', [UserController::class, 'toggleBlocked'])->name('users.empregados.index');

Route::get('/users/empregados/{empregado}/edit', [UserController::class, 'edit'])->name('users.empregados.shared.edit')
    ->middleware('can:view,empregado');
Route::get('/users/empregados/create', [UserController::class, 'create'])->name('users.empregados.shared.create')
    ->middleware('can:create,App\Models\User');
Route::post('/users/empregados/store', [UserController::class, 'store'])->name('users.empregados.shared.store')
    ->middleware('can:create,App\Models\User');
Route::put('/users/empregados/{empregado}/update', [UserController::class, 'update'])->name('users.empregados.shared.update')
    ->middleware('can:update,empregado');
Route::delete('/users/empregados/{empregado}/destroy', [UserController::class, 'destroy'])->name('users.empregados.shared.destroy')
    ->middleware('can:delete,empregado');

#######################################################################################################################################
//Encomendas
Route::view('/encomendas', 'encomendas.index');
Route::get('/encomendas', [EncomendaController::class, 'index'])->name('encomendas.index');

//Route::get('/cores', [CorController::class, 'index'])->name('cores.index')
//    ->middleware('can:viewAny,App\Models\Cor');

Route::get('/encomendas/{encomenda}/edit', [EncomendaController::class, 'edit'])->name('encomendas.shared.edit')
    ->middleware('can:view,encomenda');
Route::get('/encomendas/create', [EncomendaController::class, 'create'])->name('encomendas.shared.create')
    ->middleware('can:create,App\Models\Encomenda');
Route::post('/encomendas/store', [EncomendaController::class, 'store'])->name('encomendas.shared.store')
    ->middleware('can:create,App\Models\Encomenda');
Route::put('/encomendas/{encomenda}/update', [EncomendaController::class, 'update'])->name('encomendas.shared.update')
    ->middleware('can:update,encomenda');
Route::delete('/encomendas/{encomenda}/destroy', [EncomendaController::class, 'destroy'])->name('encomendas.shared.destroy')
    ->middleware('can:delete,encomenda');




#######################################################################################################################################

//Route::get('carrinho', [EstampaController::class, 'cart'])->name('carrinho.index');
//Route::post('add-to-cart/{id}', [EstampaController::class, 'addToCart']);
//Route::patch('update-cart', [EstampaController::class, 'updateCarrinho']);
//Route::delete('remove-from-cart', [EstampaController::class, 'removeCarrinho']);
//Route::get('pagamento', [EstampaController::class, 'pagamento'])->name('pagamento');
//Route::post('concluir', [EstampaController::class, 'concluirPagamento'])->name('concluir');


#######################################################################################################################################
//CHANGE PASSWORD
Route::get('/password/change', [ChangePasswordController::class, 'show'])->name('password.change.show');
Route::post('/password/change', [ChangePasswordController::class, 'store'])->name('password.change.store');


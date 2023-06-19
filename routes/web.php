<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EncomendaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
//use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\CorController;
//use App\Http\Controllers\ImagemController;
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
Route::get('/catalogo/{id}', [CatalogoController::class, 'show'])->name('catalogo.show');


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
Route::view('/perfil', 'perfil.index');
Route::get('/perfil/{customer}', [UserController::class, 'index'])->name('perfil.index');
Route::get('/perfil/{customer}/edit', [UserController::class, 'edit'])->name('perfil.edit');
Route::put('/perfil/{customer}', [UserController::class, 'update'])->name('perfil.update');
Route::delete('/perfil/{customer}', [UserController::class, 'destroy'])->name('perfil.destroy');
Route::delete('/perfil/{customer}/photo', [UserController::class, 'destroy_photo'])->name('perfil.photo.destroy');



#######################################################################################################################################
//CARRINHO
Route::view('/carrinho', 'carrinho.index');
Route::post('/carrinho/add/{tshirt}', [CarrinhoController::class, 'add'])->name('carrinho.add');

Route::view('/pagamento', 'carrinho.pagamento');




#######################################################################################################################################
//Categorias
Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');

Route::get('/categorias/{categoria}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit')
    ->middleware('can:view,categoria');
Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create')
    ->middleware('can:create,App\Models\Categoria');
Route::post('/categorias/store', [CategoriaController::class, 'store'])->name('categorias.store')
    ->middleware('can:create,App\Models\Categoria');
Route::put('/categorias/{categoria}/update', [CategoriaController::class, 'update'])->name('categorias.update')
    ->middleware('can:update,categoria');
Route::delete('/categorias/{categoria}/destroy', [CategoriaController::class, 'destroy'])->name('categorias.destroy')
    ->middleware('can:delete,categoria');


#######################################################################################################################################
//Cores
Route::get('/cores', [CorController::class, 'index'])->name('cores.index');

//Route::get('/cores', [CorController::class, 'index'])->name('cores.index')
//    ->middleware('can:viewAny,App\Models\Cor');

Route::get('/cores/{cor}/edit', [CorController::class, 'edit'])->name('cores.edit')
    ->middleware('can:view,cor');
Route::get('/cores/create', [CorController::class, 'create'])->name('cores.create')
    ->middleware('can:create,App\Models\Cor');
Route::post('/cores/store', [CorController::class, 'store'])->name('cores.store')
    ->middleware('can:create,App\Models\Cor');
Route::put('/cores/{cor}/update', [CorController::class, 'update'])->name('cores.update')
    ->middleware('can:update,cor');
Route::delete('/cores/{cor}/destroy', [CorController::class, 'destroy'])->name('cores.destroy')
    ->middleware('can:delete,cor');





#######################################################################################################################################
//Users Admins
Route::view('/users/admins', 'users.admins.index');
Route::get('/users/admins', [App\Http\Controllers\UserController::class, 'indexAdmins'])->name('users.admins.index');
Route::put('/user/admins/{id}/toggle-blocked', [UserController::class, 'toggleBlocked'])->name('users.admins.index');

Route::get('/users/admins/{admin}/edit', [UserController::class, 'editAdmin'])->name('users.admins.edit')
    ->middleware('can:view,admin');
Route::get('/users/admins/create', [UserController::class, 'createAdmin'])->name('users.admins.create')
    ->middleware('can:create,App\Models\User');
Route::post('/users/admins/store', [UserController::class, 'storeAdmin'])->name('users.admins.store')
    ->middleware('can:create,App\Models\User');
Route::put('/users/admins/{admin}/update', [UserController::class, 'updateAdmin'])->name('users.admins.update')
    ->middleware('can:update,admin');
Route::delete('/users/admins/{admin}/destroy', [UserController::class, 'destroyAdmin'])->name('users.admins.destroy')
    ->middleware('can:delete,admin');


//Users Clientes
Route::view('/users/clientes', 'users.clientes.index');
Route::get('/users/clientes', [App\Http\Controllers\UserController::class, 'indexClientes'])->name('users.clientes.index');
Route::put('/user/clientes/{id}/toggle-blocked', [UserController::class, 'toggleBlocked'])->name('users.clientes.index');

Route::get('/users/clientes/{cliente}/edit', [UserController::class, 'edit'])->name('users.clientes.edit')
    ->middleware('can:view,cliente');
Route::get('/users/clientes/create', [UserController::class, 'create'])->name('users.clientes.create')
    ->middleware('can:create,App\Models\User');
Route::post('/users/clientes/store', [UserController::class, 'store'])->name('users.clientes.store')
    ->middleware('can:create,App\Models\User');
Route::put('/users/clientes/{cliente}/update', [UserController::class, 'update'])->name('users.clientes.update')
    ->middleware('can:update,cliente');
Route::delete('/users/clientes/{cliente}/destroy', [UserController::class, 'destroy'])->name('users.clientes.destroy')
    ->middleware('can:delete,cliente');

//Users Empregados
Route::view('/users/empregados', 'users.empregados.index');
Route::get('/users/empregados', [App\Http\Controllers\UserController::class, 'indexEmpregados'])->name('users.empregados.index');
Route::put('/user/empregados/{id}/toggle-blocked', [UserController::class, 'toggleBlocked'])->name('users.empregados.index');

Route::get('/users/empregados/{empregado}/edit', [UserController::class, 'edit'])->name('users.empregados.edit')
    ->middleware('can:view,empregado');
Route::get('/users/empregados/create', [UserController::class, 'create'])->name('users.empregados.create')
    ->middleware('can:create,App\Models\User');
Route::post('/users/empregados/store', [UserController::class, 'store'])->name('users.empregados.store')
    ->middleware('can:create,App\Models\User');
Route::put('/users/empregados/{empregado}/update', [UserController::class, 'update'])->name('users.empregados.update')
    ->middleware('can:update,empregado');
Route::delete('/users/empregados/{empregado}/destroy', [UserController::class, 'destroy'])->name('users.empregados.destroy')
    ->middleware('can:delete,empregado');

#######################################################################################################################################
//Encomendas
Route::view('/encomendas', 'encomendas.index');
Route::get('/encomendas', [EncomendaController::class, 'index'])->name('encomendas.index');

//Route::get('/cores', [CorController::class, 'index'])->name('cores.index')
//    ->middleware('can:viewAny,App\Models\Cor');

Route::get('/encomendas/{encomenda}/edit', [EncomendaController::class, 'edit'])->name('encomendas.edit')
    ->middleware('can:view,encomenda');
Route::get('/encomendas/create', [EncomendaController::class, 'create'])->name('encomendas.create')
    ->middleware('can:create,App\Models\Encomenda');
Route::post('/encomendas/store', [EncomendaController::class, 'store'])->name('encomendas.store')
    ->middleware('can:create,App\Models\Encomenda');
Route::put('/encomendas/{encomenda}/update', [EncomendaController::class, 'update'])->name('encomendas.update')
    ->middleware('can:update,encomenda');
Route::delete('/encomendas/{encomenda}/destroy', [EncomendaController::class, 'destroy'])->name('encomendas.destroy')
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
Route::view('/password/reset', 'auth.passwords.reset');


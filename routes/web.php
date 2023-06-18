<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\CorController;
use App\Http\Controllers\ImagemController;
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
Route::get('/perfil/{customer}', [CustomerController::class, 'index'])->name('perfil.index');
Route::get('/perfil/{customer}/edit', [CustomerController::class, 'edit'])->name('perfil.edit');
Route::put('/perfil/{customer}', [CustomerController::class, 'update'])->name('perfil.update');
Route::delete('/perfil/{customer}', [CustomerController::class, 'destroy'])->name('perfil.destroy');
Route::delete('/perfil/{customer}/photo', [CustomerController::class, 'destroy_photo'])->name('perfil.photo.destroy');



#######################################################################################################################################
//CARRINHO
Route::view('/carrinho', 'carrinho.index');
Route::post('/carrinho/add/{tshirt}', [CarrinhoController::class, 'add'])->name('carrinho.add');

Route::view('/pagamento', 'carrinho.pagamento');




#######################################################################################################################################
//Categorias
Route::view('/categorias', [CatalogoController::class, 'index'])->name('categorias.index');





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
//Users Clientes
Route::view('/users/admins', 'users.admins.index');
Route::get('/users/admins', [App\Http\Controllers\UserController::class, 'indexAdmins'])->name('users.admins.index');

//Users Clientes
Route::view('/users/clientes', 'users.clientes.index');
Route::get('/users/clientes', [App\Http\Controllers\UserController::class, 'indexClientes'])->name('users.clientes.index');

//Users Empregados
Route::view('/users/empregados', 'users.empregados.index');
Route::get('/users/empregados', [App\Http\Controllers\UserController::class, 'indexEmpregados'])->name('users.empregados.index');





#######################################################################################################################################
//Encomendas
Route::view('/encomendas', 'encomendas.index');





#######################################################################################################################################
//Empregados
Route::view('/empregados', 'empregados.index');
Route::view('/clientes', 'clientes.index');





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


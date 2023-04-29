<?php
@if(Auth::user()->tipo != 'C')
    <!-- Nav Item - Dashboard -->
    <li class="nav-item" {{Route::currentRouteName()=='admin.dashboard'? 'active': ''}}>
        <a class="nav-link" href="/admin">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
@endif

<!-- Nav Item -->
@can('viewAny', App\Models\Estampa::class)
    <li class="nav-item {{Route::currentRouteName()=='admin.estampas'? 'active': ''}}">
        <a class="nav-link" href="{{route('admin.estampas')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>Estampas</span></a>
    </li>
@endcan

<!-- Nav Item -->
@can('viewAny', App\Models\Categoria::class)
    <li class="nav-item {{Route::currentRouteName()=='admin.categorias'? 'active': ''}}">
        <a class="nav-link" href="{{route('admin.categorias')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>Categorias</span></a>
    </li>
@endcan

<!-- Nav Item -->
@can('viewAny', App\Models\Cliente::class)
    <li class="nav-item {{Route::currentRouteName()=='admin.clientes'? 'active': ''}}">
        <a class="nav-link" href="{{route('admin.clientes')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>Clientes</span></a>
    </li>
@endcan

<!-- Nav Item -->
@can('viewAny', App\Models\Cor::class)
    <li class="nav-item {{Route::currentRouteName()=='admin.cores'? 'active': ''}}">
        <a class="nav-link" href="{{route('admin.cores')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>Cores</span></a>
    </li>
@endcan

<!-- Nav Item -->
@can('view', App\Models\Preco::class)
    <li class="nav-item {{Route::currentRouteName()=='admin.precos'? 'active': ''}}">
        <a class="nav-link" href="{{route('admin.precos')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>Preços</span></a>
    </li>
@endcan

<!-- Nav Item -->
@can('viewAny', App\Models\User::class)
    <li class="nav-item {{Route::currentRouteName()=='admin.users'? 'active': ''}}">
        <a class="nav-link" href="{{route('admin.users')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>Utilizadores</span></a>
    </li>
@endcan

<!-- Nav Item -->
@can('viewAny', App\Models\Encomenda::class)
    <li class="nav-item {{Route::currentRouteName()=='admin.encomendas'? 'active': ''}}">
        <a class="nav-link" href="{{route('admin.encomendas')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>Encomendas</span></a>
    </li>
@endcan

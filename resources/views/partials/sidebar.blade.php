<!-- Nav Item -->
<li class="nav-item" {{Route::currentRouteName()=='estampas.index'? 'active': ''}}>
    <a class="nav-link" href="/estampas">
        <i class="fas fa-fw fa-table"></i>
        <span>Catálogo</span></a>
</li>

<!-- Nav Item -->
<li class="nav-item">
    <a class="nav-link" href="/carrinho">
        <i class="fas fa-fw fa-table"></i>
        <span>Carrinho</span></a>
</li>

<!-- Nav Item -->
@guest

@else
    <li class="nav-item">
        <a class="nav-link" href="{{ url('encomendasCliente/' . Auth::user()->id) }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Encomendas</span></a>
    </li>
@endguest

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Nav Item -->
<li class="nav-item">
    <a class="nav-link" href="{{url('/admin')}}">
        <i class="fas fa-fw fa-table"></i>
        <span>Administração</span>
    </a>
</li>

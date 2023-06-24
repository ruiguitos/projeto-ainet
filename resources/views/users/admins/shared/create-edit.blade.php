<div class="form-group">
    <label for="inputNome">Nome</label>
    <input type="text" class="form-control" name="name" id="inputNome" value="{{old('name', $user->name)}}" >
    @error('name')
    <div class="small text-danger">{{$message}}</div>
    @enderror
</div>

<div class="form-group">
    <label for="inputEmail">Email</label>
    <input type="text" class="form-control" name="email" id="inputEmail" value="{{old('email', $user->email)}}" >
    @error('email')
    <div class="small text-danger">{{$message}}</div>
    @enderror
</div>

<div class="form-group">
    <label for="inputTipo">Tipo</label>
    <select class="form-control" name="tipo" id="inputTipo">
        <option value="A" {{$tipo == old('tipo', $user->user_type) ? 'selected' : ''}}>Administrador</option>
        <option value="C" {{$tipo == old('tipo', $user->user_type) ? 'selected' : ''}}>Cliente</option>
        <option value="F" {{$tipo == old('tipo', $user->user_type) ? 'selected' : ''}}>Empregado</option>
        @error('user_type')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>

<div class="form-group">
    <label for="inputFoto">Upload da foto</label>
    <input type="file" class="form-control" name="photo_url" id="inputFoto">
    @error('photo')
    <div class="small text-danger">{{$message}}</div>
    @enderror
</div>


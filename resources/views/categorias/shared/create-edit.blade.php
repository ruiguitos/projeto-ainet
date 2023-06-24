<div class="form-group">
    <label for="inputTipo">Tipo</label>
    <select class="form-control" name="tipo" id="inputTipo">
        <option {{$category == old('tipo', $category->name) ? 'selected' : ''}}>Administrador</option>
        <option {{$category == old('tipo', $category->name) ? 'selected' : ''}}>Cliente</option>
        <option {{$category == old('tipo', $category->name) ? 'selected' : ''}}>Empregado</option>
        @error('user_type')
        <div class="small text-danger">{{$message}}</div>
    @enderror
        <button type="submit" class="btn btn-success" name="ok">Save</button>
        {{--            <a href="{{route('users.admins.index')}}" class="btn btn-secondary">Cancel</a>--}}
        <a href="{{ URL::previous() }}" class="btn btn-secondary">Cancel</a>
</div>


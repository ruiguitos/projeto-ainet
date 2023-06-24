<div class="form-group">
    <label for="inputAbr">Nome</label>
    <input type="text" class="form-control" name="cor" id="inputAbr" value="{{old('cor', $color->name)}}" >
    @error('name')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>

<div class="form-group">
    <label for="inputAbr">Code</label>
    <input type="text" class="form-control" name="cor" id="inputAbr" value="{{old('cor', $color->code)}}" >
    @error('code')
        <div class="small text-danger">Campo "Code" tem que ser preenchido</div>
    @enderror
</div>


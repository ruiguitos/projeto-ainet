<div class="form-group">
    <label for="inputAbr">Status</label>
    <input type="text" class="form-control" name="cor" id="inputAbr" value="{{old('cor', $order->status)}}" >
    @error('name')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>

<div class="form-group">
    <label for="inputAbr">Status</label>
    <input type="text" class="form-control" name="cor" id="inputAbr" value="{{old('cor', $order->date)}}" >
    @error('name')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>

<div class="form-group">
    <label for="inputAbr">Status</label>
    <input type="text" class="form-control" name="cor" id="inputAbr" value="{{old('cor', $order->customer_id)}}" >
    @error('name')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>

<div class="form-group">
    <label for="inputAbr">Status</label>
    <input type="text" class="form-control" name="cor" id="inputAbr" value="{{old('cor', $order->total_price)}}" >
    @error('name')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>

<div class="form-group">
    <label for="inputAbr">Code</label>
    <input type="text" class="form-control" name="cor" id="inputAbr" value="{{old('cor', $cor->notes)}}" >
    @error('code')
        <div class="small text-danger">Campo "Code" tem que ser preenchido</div>
    @enderror
</div>

<div class="form-group">
    <label for="inputAbr">Code</label>
    <input type="text" class="form-control" name="cor" id="inputAbr" value="{{old('cor', $cor->nif)}}" >
    @error('code')
        <div class="small text-danger">Campo "Code" tem que ser preenchido</div>
    @enderror
</div>

<div class="form-group">
    <label for="inputAbr">Code</label>
    <input type="text" class="form-control" name="cor" id="inputAbr" value="{{old('cor', $cor->address)}}" >
    @error('code')
        <div class="small text-danger">Campo "Code" tem que ser preenchido</div>
    @enderror
</div>

<div class="form-group">
    <label for="inputAbr">Code</label>
    <input type="text" class="form-control" name="cor" id="inputAbr" value="{{old('cor', $cor->payment_type)}}" >
    @error('code')
        <div class="small text-danger">Campo "Code" tem que ser preenchido</div>
    @enderror
</div>

<div class="form-group">
    <label for="inputAbr">Code</label>
    <input type="text" class="form-control" name="cor" id="inputAbr" value="{{old('cor', $cor->payment_ref)}}" >
    @error('code')
        <div class="small text-danger">Campo "Code" tem que ser preenchido</div>
    @enderror
</div>

<div class="form-group">
    <label for="inputAbr">Code</label>
    <input type="text" class="form-control" name="cor" id="inputAbr" value="{{old('cor', $cor->receipt_url)}}" >
    @error('code')
        <div class="small text-danger">Campo "Code" tem que ser preenchido</div>
    @enderror
</div>


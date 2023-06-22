<div class="form-group">
  <label for="">{{$label}}</label>
  <input type="{{$type}}" name="{{$name}}" id="{{$id.'23'}}" class="form-control" placeholder="" aria-describedby="helpId">
  <small id="helpId" class="text-muted">
    @error('$name')
        {{$message}}
    @enderror
  </small>
</div>
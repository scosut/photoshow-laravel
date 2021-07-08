<div class="form-group{{$errors->has($name) ? ' has-error has-feedback' : ''}}">
  {{ Form::label($name, null, ['class' => 'control-label'])}}
  {{ Form::file($name, array_merge(['class' => 'form-control', 'accept' => 'image/*'], $attributes)) }}
  @if($errors->has($name))
    <span class="glyphicon glyphicon-remove form-control-feedback"></span>
    <div class="help-block" role="alert">
      {{ $errors->first($name) }}
    </div>
  @endif
</div>
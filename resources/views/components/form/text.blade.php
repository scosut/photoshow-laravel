<div class="form-group{{$errors->has($name) ? ' has-error has-feedback' : ''}}">
  {{ Form::label($name, null, ['class' => 'control-label'])}}
  {{ Form::text($name, $value, array_merge(['class' => 'form-control'], $attributes)) }}
  @if($errors->has($name))
    <span class="glyphicon glyphicon-remove form-control-feedback"></span>
    <div class="help-block" role="alert">
      {{ $errors->first($name) }}
    </div>
  @endif
</div>
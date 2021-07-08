<div class="form-group">  
  <input type="hidden" id="firstError" name="firstError" value="{{ session('firstError') }}" />
  {{ Form::submit($value, $attributes) }}
</div>
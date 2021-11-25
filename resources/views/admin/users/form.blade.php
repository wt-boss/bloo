  <?php
$allowedRoles = config('variables.role');
  unset($allowedRoles["3"]);
  unset($allowedRoles["4"]);
  unset($allowedRoles["6"]);
if (Auth::user()->rolename() !== "Superadmin") {
    foreach ($allowedRoles as $key => $value ) {
        if ($key >= Auth::user()->role) {
            unset($allowedRoles[$key]);
        }
    }
}

//$img_url = (isset($item) ? $item->avatar : "http://placehold.it/160x160");
$img_url = (isset($user) ? $user->avatar : url('/') . config('variables.avatar.public') . 'avatar1.jpg') ;
?>


{!! Form::myInput('text', 'first_name', trans('first_name')) !!}

{!! Form::myInput('text', 'last_name', trans('last_name')) !!}

{!! Form::myInput('email', 'email', 'Email') !!}

  <div class="form-group col-6">
      <label for="birth-date">{{ trans('Pays') }}:</label><br>
      <select class="form-control" name="country_id" id="country">
          @foreach($countries as $country)
              <option value="{{$country->id}}">{{$country->name}}</option>
          @endforeach
      </select>
  </div>
  <div id="div_region" style="display:none" class="form-group col-6">
      <label for="birth-date">{{ trans('Region') }} :</label><br>
      <select class="form-control" name="state_id" id="region" >
      </select>
  </div>
  <div id="div_ville" style="display:none" class="form-group col-6">
      <label for="birth-date">{{ trans('Ville') }} :</label><br>
      <select class="form-control" name="city_id" id="ville" required>
      </select>
  </div>

{!! Form::myInput('password', 'password', trans('password')) !!}

{!! Form::myInput('password', 'password_confirmation', trans('password_confirmation')) !!}

  <div class="form-group focused">
      <label for="role">Rôle</label>
      <select class="form-control" id="role" name="role">
          @foreach($allowedRoles as $key => $role)
          <option value="{{$key}}">@lang($role)</option>
          @endforeach
      </select>
  </div>

  <select class="form-control" id="active" name="active">
      @foreach(config('variables.boolean') as $key => $value)
          <option value="{{$key}}">@lang($value)</option>
      @endforeach
  </select>

{!! Form::myFileImage('avatar', 'Avatar', $img_url) !!}

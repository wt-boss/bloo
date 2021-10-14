  <?php
$allowedRoles = config('variables.role');
if (Auth::user()->rolename() !== "Superadmin") {
    foreach ($allowedRoles as $key => $value ) {
        if ($key > Auth::user()->role) {
            unset($allowedRoles[$key]);
        }
    }
}

//$img_url = (isset($item) ? $item->avatar : "http://placehold.it/160x160");
$img_url = (isset($user) ? $user->avatar : url('/') . config('variables.avatar.public') . 'edit-lect-btn.png');
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

{!! Form::myInput('text', 'password', trans('password')) !!}

{!! Form::myInput('text', 'password_confirmation', trans('password_confirmation')) !!}

{!! Form::mySelect('role', 'Rôle', $allowedRoles) !!}

{!! Form::mySelect('active', trans('compte_active'), config('variables.boolean')) !!}

{!! Form::myFileImage('avatar', 'Avatar', $img_url) !!}

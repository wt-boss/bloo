
<div id="extraModal-{{$extra->id}}" class="modal" tabindex="-1">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ trans('update_extra') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="">
                    <div class="my-content create-user">
                        {!! Form::model($extra, [
                                'action' => ['OperationController@update_extra', $extra->id],
                                'method' => 'put',

                            ])
                        !!}
                        @csrf
                        <?php
                        $allowedRoles = config('variables.role');
                        if (Auth::user()->rolename() !== "Superadmin") {
                            foreach ($allowedRoles as $key => $value ) {
                                if ($key >= Auth::user()->role) {
                                    unset($allowedRoles[$key]);
                                }
                            }
                        }

                        //$img_url = (isset($item) ? $item->avatar : "http://placehold.it/160x160");
                        //$img_url = (isset($user) ? $user->avatar : url('/') . config('variables.avatar.public') . 'avatar0.png');
                        ?>
                        <div class="form-group focused" >
                            <label for="intitule">Type</label>
                            <input class="form-control" name="intitulé" type="text" value="{{$extra->type}}" id="intitule" disabled>
                        </div>

                        <div class="form-group focused" >
                            <label for="payementCycle">Prix</label>
                            <input class="form-control" name="payementCycle" type="text" value="{{$extra->cost}}" id="payementCycle" >
                        </div>


                        {{--                    @include('admin.users.form2')--}}
                        <br>
                        {{--                        <a class="btn btn-bloo-cancel" href="{{ route('offers.index') }}">{{ trans('Annuler') }}</a>--}}
                        {{--                        <button class="btn btn-bloo">{{ trans('Mettre_jour') }}</button>--}}
                        {!! Form::close() !!}
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-bloo-cancel" data-dismiss="modal">{{trans('Annuler')}}</button>
                <button type="button"  class="btn btn-bloo legitRipple">{{trans('Mettre_jour')}}</button>

            </div>
        </div>
    </div>
</div>
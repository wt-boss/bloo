
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

                        <form id="form_extra_{{$extra->id}}" method='POST' action="{{route('extra.update',$extra->id)}}">
                            @csrf
                            @method('PUT')
                            <?php
                            $allowedRoles = config('variables.role');
                            if (Auth::user()->rolename() !== "Superadmin") {
                                foreach ($allowedRoles as $key => $value ) {
                                    if ($key >= Auth::user()->role) {
                                        unset($allowedRoles[$key]);
                                    }
                                }
                            }

                            ?>
                        <div class="form-group focused" >
                            <label for="type">Type</label>
                            <input class="form-control" name="type" type="text" value="{{$extra->type}}" id="type" disabled>
                        </div>

                        <div class="form-group focused" >
                            <label for="cost">Prix</label>
                            <input class="form-control" name="cost" type="text" value="{{$extra->cost}}" id="cost" >
                        </div>


                        {{--                    @include('admin.users.form2')--}}
                        <br>
                        {{--                        <a class="btn btn-bloo-cancel" href="{{ route('offers.index') }}">{{ trans('Annuler') }}</a>--}}
                        {{--                        <button class="btn btn-bloo">{{ trans('Mettre_jour') }}</button>--}}

                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-bloo-cancel" data-dismiss="modal">{{trans('Annuler')}}</button>
                <button onclick="form_submit('form_extra_{{$extra->id}}')" class="btn btn-bloo legitRipple">{{trans('Mettre_jour')}}</button>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
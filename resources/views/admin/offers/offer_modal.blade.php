
<div id="myModal-{{$offer->id}}" class="modal" tabindex="-1">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ trans('update_offer') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="">
                    <div class="my-content create-user">
                        {!! Form::model($offer, [
                                'action' => ['OfferController@update', $offer->id],
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
                            <label for="intitule">Intitule</label>
                            <input class="form-control" name="intitulé" type="text" value="{{$offer->intitule}}" id="intitule" disabled>
                        </div>

                        <div class="form-group focused" >
                            <label for="payementCycle">Payement Cycle</label>
                            <input class="form-control" name="payementCycle" type="text" value="{{$offer->payementCycle}}" id="payementCycle" >
                        </div>

                        <div class="form-group focused">
                            <label for="timeTest">Time Test</label>
                            <input class="form-control" name="timeTest" type="text" value="{{$offer->timeTest}}" id="timeTest">
                        </div>

                        <div class="form-group focused" >
                            <label for="userTest">User Test</label>
                            <input class="form-control" name="userTest" type="text" value="{{$offer->userTest}}" id="userTest">
                        </div>
                        <div class="form-group focused" >
                            <label for="reduction">Reduction</label>
                            <input class="form-control" name="reduction" type="text" value="{{$offer->reduction}}" id="reduction">
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
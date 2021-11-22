
<div id="myModal-{{$offer->id}}" class="modal" tabindex="-1" data-easein="bounce" role="dialog" aria-labelledby="costumModalLabel" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ trans('update_offer') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="form_offer_{{$offer->id}}" method='POST' action="{{route('offers.update',$offer->id)}}">
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
                    <div class="my-content create-user">

                        <div class="form-group focused" >
                            <label for="intitule">Intitule</label>
                            <input class="form-control" name="intitulé" type="text" value="{{$offer->intitule}}" id="intitule" disabled>
                        </div>
                        <div class="form-group focused" >
                            <label for="montant">Prix</label>
                            <input class="form-control" name="montant" type="text" value="{{$offer->montant}}" id="payementCycle" required>
                        </div>

                        @if($offer->id === 2 )
                        <div class="form-group focused" >
                            <label for="payementCycle">Payement Cycle</label>
                            <input class="form-control" name="payementCycle" type="text" value="{{$offer->payementCycle}}" id="payementCycle" >
                        </div>

                        <div class="form-group focused">
                            <label for="timeTest">Time Test</label>
                            <input class="form-control" name="timeTest" type="text" value="{{$offer->timeTest}}" id="timeTest">
                        </div>
                        @endif

                        @if($offer->id === 1)
                        <div class="form-group focused" >
                            <label for="userTest">User Test</label>
                            <input class="form-control" name="userTest" type="text" value="{{$offer->userTest}}" id="userTest">
                        </div>
                        @endif

                        {!! Form::close() !!}
                    </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-bloo-cancel" data-dismiss="modal">{{trans('Annuler')}}</button>
                <button onclick="form_submit('form_offer_{{$offer->id}}')" class="btn btn-bloo legitRipple">{{trans('Mettre_jour')}}</button>

            </div>
            </form>
        </div>
    </div>
</div>


<div id="myModal" class="modal" tabindex="-1" data-easein="bounce" role="dialog" aria-labelledby="costumModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ trans('update_promotion') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_offer" method='POST' action="{{route('promotion.store')}}">
            <div class="modal-body">


                    @csrf
                    @php
                      $offers = \App\Offer::all();
                    @endphp

                    <div class="my-content create-user">

                        <div class="form-group focused" >
                            <label for="montant">Pourcentage</label>
                            <input class="form-control" name="montant" type="number"  required>
                        </div>

                        <div class="form-group focused" >
                            <label for="montant">Offre</label>
                            <select class="form-control" name="offer">
                                @foreach($offers as $item)
                                <option value="{{$item->id}}">{{$item->intitule}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group focused" >
                                <label for="userTest">Date de fin </label>
                                <input class="form-control" name="end_date" type="date"  required>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-bloo-cancel" data-dismiss="modal">{{trans('Annuler')}}</button>
                <button  class="btn btn-bloo legitRipple">{{trans('Save')}}</button>
            </div>
            </form>
        </div>
    </div>
</div>


<div id="theExtra" class="modal" tabindex="-1" data-easein="bounce" role="dialog" aria-labelledby="costumModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ trans('update_promotion') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_offer" method='POST' action="{{route('updateoffers')}}">
                <div class="modal-body">
                    @csrf
                    @php
                     $extras = \App\Extra::with('offer')->get();
                     $offer = \App\Subscription::where("user_id",auth()->user()->id)->get()->last();
                    @endphp
                    <div class="my-content create-user">

                        <div class="form-group focused" >
                            <label for="montant">Offre</label>
                            <select class="form-control" name="extra_id">
                                @foreach($extras as $item)
                                    <option value="{{$item->id}}">{{$item->offer->intitule}} - {{$item->type}} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group focused" >
                            <label for="montant">Prix</label>
                            <input class="form-control" name="montant" type="number"  required>
                        </div>


                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-bloo-cancel" data-dismiss="modal">{{trans('Annuler')}}</button>
                    <button  class="btn btn-bloo legitRipple">{{trans('Save')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg"  id="myExtra" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                    <span aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">×</font></font></span></button>
                <h4 class="modal-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ trans('Create an extra') }}</font></font></h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('storeoffers') }}">
                    @csrf
                    <div class="text-center">
                        <div class="icon-object border-success text-success"><i class="icon-plus3"></i></div>
                        <h5 class="content-group">Create an account <small class="display-block">All fields are required</small></h5>
                    </div>

                    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" value="{{ old('first_name') }}" required autofocus>
                        <div class="form-control-feedback">
                            <i class="icon-user text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" value="{{ old('last_name') }}" required>
                        <div class="form-control-feedback">
                            <i class="icon-user text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" value="{{ (isset($user_data['email'])) ? $user_data['email'] : old('email') }}" required{{ isset($user_data['email']) ? ' disabled' : '' }}>
                        <div class="form-control-feedback">
                            <i class="icon-mail5 text-muted"></i>
                        </div>
                    </div>

                    <input type="hidden" name="offer_id" value="{{$offer->offer_id}}">

                    <div class="form-group has-feedback has-feedback-left">
                        <select class="form-control" name="role" id="description" required>
                              <option value=""></option>
                               <option value="1">Operateur</option>
                                <option value="4">Client</option>
                        </select>
                        <div class="form-control-feedback">
                            <i class="icon-book3 text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                        <div class="form-control-feedback">
                            <i class="icon-lock2 text-muted"></i>
                        </div>
                        @if ($errors->has('password'))
                            <span class="help-block">{{ $errors->first('password') }}</span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" required>
                        <div class="form-control-feedback">
                            <i class="icon-lock2 text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn bg-teal btn-block">{{ trans('savee') }} <i class="icon-arrow-right14 position-right"></i></button>
                    </div>

                    <div class="content-divider text-muted form-group"><span></span></div>
                    <button type="button" class="btn btn-default btn-block content-group" data-dismiss="modal"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ trans('Close') }}</font></font></button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


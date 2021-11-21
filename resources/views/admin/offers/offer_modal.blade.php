
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

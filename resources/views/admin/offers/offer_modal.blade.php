
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

                <form  method='POST' action="{{route('offers.update',$offer->id)}}">
                @csrf
                    @method('PUT')
                    <div class="my-content create-user">

                        <div class="form-group focused" >
                            <label >Intitule</label>
                            <input class="form-control" name="intitulé" type="text" value="{{$offer->intitule}}" disabled>
                        </div>
                        <div class="form-group focused" >
                            <label >Prix</label>
                            <input class="form-control" name="montant" type="text" value="{{$offer->montant}}"  required>
                        </div>

                        @if($offer->id === 2 )
                        <div class="form-group focused" >
                            <label >Payement Cycle</label>
                            <input class="form-control" name="payementCycle" type="text" value="{{$offer->payementCycle}}"  >
                        </div>

                        <div class="form-group focused">
                            <label >Time Test</label>
                            <input class="form-control" name="timeTest" type="text" value="{{$offer->timeTest}}" >
                        </div>
                        @endif

                        @if($offer->id === 1)
                        <div class="form-group focused" >
                            <label>User Test</label>
                            <input class="form-control" name="userTest" type="text" value="{{$offer->userTest}}" >
                        </div>
                        @endif


                    </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-bloo-cancel" data-dismiss="modal">{{trans('Annuler')}}</button>
                <button onclick="form_submit('form_offer_{{$offer->id}}')" class="btn btn-bloo legitRipple">{{trans('Mettre_jour')}}</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>




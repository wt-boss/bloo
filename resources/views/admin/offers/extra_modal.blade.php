
<div id="theExtra-{{$item->id}}" class="modal" tabindex="-1" data-easein="bounce" role="dialog" aria-labelledby="costumModalLabel" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ trans('update_offer') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <form  method='POST' action="{{route('extra.update',$item->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="my-content create-user">
                        <div class="form-group focused">
                            <label >Intitule26</label>
                            <input class="form-control"  type="text" value="{{$item->type}} - {{$item->offer->intitule}}" disabled>
                            <input type="hidden" name="extra_id" value="{{$item->id}}">
                        </div>
                        <div class="form-group focused" >
                            <label >Prix</label>
                            <input class="form-control" name="montant" type="text" value="{{$item->cost}}"  required>
                        </div>
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




<button class="btn btn-xs btn-success dropdown-toggle" data-toggle="dropdown" style="margin-left: 10px;">{{ trans('actions') }} <span class="caret"></span></button>
<ul class="dropdown-menu dropdown-menu-right" style="padding: 10px;">
    <li><a href="{{ route('forms.show', [$operation->form->code]) }}" class="btn btn-bloo-action mb-5">{{ trans('edit_op') }}</a></li>
    <li><a href="{{ route('operation.show', [$operation->id]) }}" class="btn btn-bloo-action mb-5 ">{{ trans('view_form') }}</a></li>
    <li><a href="{{  route('operation.edit', [$operation->id]) }}" class="btn btn-bloo-action mb-5">{{ trans('edit_form') }}</a></li>
    <li><a href="{{route('messages_show',$operation->id)}}" class="btn  btn-bloo-action mb-5">{{ trans('view_msg') }}</a></li>
    <li><a href="{{ route('operation.destroy', $operation->id) }}" class="btn btn-bloo-action" data-id="{{ $operation->id }}" data-method="delete" data-item="form" data-ajax="true">{{ trans('delete_op') }}</a></li>
</ul>

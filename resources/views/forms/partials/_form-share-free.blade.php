<button class="btn btn-xs btn-success dropdown-toggle" data-toggle="dropdown" style="margin-left: 10px;"><i class="fa fa-share-alt" aria-hidden="true"></i> {{ trans('share') }}</button>
<ul class="dropdown-menu dropdown-menu-right">
    <li><a href="whatsapp://send?text={{ route('forms.view', $form->code) }}" data-action="share/whatsapp/share">Whatsapp</a></li>
    <li>
        <div class="fb-share-button" data-href="{{ route('forms.view', $form->code) }}" data-layout="button_count" data-size="large"><a target="_blank" class="fb-xfbml-parse-ignore" href="https://www.facebook.com/sharer/sharer.php?u=" . urlencode({{ route('forms.view', $form->code) }}) . "&amp;src=sdkpreparse">Partager</a></div>
    </li>
</ul>

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v7.0" nonce="sJPV1BRg"></script>

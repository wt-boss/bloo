<button  style="background-color: #69c6fb;" class="btn btn-xs btn-success dropdown-toggle" data-toggle="dropdown" style="margin-left: 10px;"><i class="fa fa-share-alt" aria-hidden="true"></i> {{ trans('share') }}</button>
<ul class="dropdown-menu dropdown-menu-right share-free">
    <li class="facebook"><a href="#"><i class="fab fa-facebook" aria-hidden="true"></i> facebook</a></li>
    <li class="twitter"><a href="#" class="twitter"><i class="fab fa-twitter-square"></i> twitter</a></li>
    <li class="linkedin"><a href="#" class="linkedin"><i class="fab fa-linkedin"></i> linkedin</a></li>
    <li class="whatsapp"><a href="whatsapp://send?text={{ route('forms.view', $form->code) }}"><i class="fab fa-whatsapp"></i> WhatsApp</a></li>
</ul>


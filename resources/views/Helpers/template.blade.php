<div class="row">
    @foreach($templates as $item)
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h6><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$item->form->title}}</font></font></h6>
                     <br>
                    <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$item->form->description}}</font></font></p>
                </div>
                <div class="icon">
                    <i class="fa fa-bookmark"></i>
                </div>
                <a href="{{route('usetemplate',[$item->id])}}" class="small-box-footer"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                            @lang("Use this template") </font></font><i class="fa fa-arrow-circle-right"></i>
                </a>
                <a href="{{route('forms.show',[$item->form->code])}}" target="_blank" class="small-box-footer"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                            @lang("View this template") </font></font><i class="fa fa-eye "></i>
                </a>
            </div>
        </div>
    @endforeach
</div>

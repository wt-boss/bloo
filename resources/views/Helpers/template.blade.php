<div class="row">
    @foreach($templates as $item)
    <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-bookmark"></i></span>
            <div class="info-box-content">
                <span class="info-box-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$item->form->title}}</font></font></span>
                <a href="#" class="small-box-footer"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                            @lang("Use this template") </font></font><i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    @endforeach
</div>

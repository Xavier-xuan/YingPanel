@if(Session::has('alert.errors'))
    @foreach(Session::pull('alert.errors') as $ae)
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>错误：</strong> {{$ae}}
        </div>
    @endforeach
@endif

@if(Session::has('alert.successes'))
    @foreach(Session::pull('alert.successes') as $as)
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>成功：</strong> {{$as}}
        </div>
    @endforeach
@endif

@if(Session::has('alert.warings'))
    @foreach(Session::pull('alert.warings') as $aw)
        <div class="alert alert-waring alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>警告：</strong> {{$aw}}
        </div>
    @endforeach
@endif

@if(Session::has('alert.infos'))
    @foreach(Session::pull('alert.infos') as $ai)
        <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>提醒：</strong> {{$ai}}
        </div>
    @endforeach
@endif
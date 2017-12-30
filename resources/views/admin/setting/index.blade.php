@extends('layouts.admin')
@section('content')
    <div class="col-md-10 text-center" style="float: none; margin: 2em auto 1em auto ">
        <div class="row">
            <form class="form-horizontal col-md-8" method="POST" action="{{ route('admin.setting.store') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="register" class="col-md-4 control-label">开放注册</label>

                    <div class="col-md-6">

                        <label class="radio-inline">
                            <input type="radio" name="register" value="0" {{$settings['register'] == 0 ? "checked" : ""}}> 是
                        </label>

                        <label class="radio-inline">
                            <input type="radio" name="register" value="1" {{$settings['register'] == 1 ? "checked" : ""}}> 否
                        </label>

                        @if ($errors->has('register'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('register') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <br />

                <button class="btn btn-default col-md-offset-1" type="submit">保存</button>
            </form>
        </div>
    </div>
@endsection

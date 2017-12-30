@extends('layouts.console') @section('content')

    <div class="panel panel-default">
        <div class="panel-body">
            <!-- 导航栏 Start -->

            <ul class="nav nav-tabs">
                <li role="presentation" class="{{active_class(if_route('server.list.all'))}}">
                    <a href="{{ route('server.list.all') }}">所有服务器</a>
                </li>
                <li role="presentation" class="{{active_class(if_route('server.list.my'))}}">
                    <a href="{{ route('server.list.my') }}">我的服务器</a>
                </li>
            </ul>
            <!-- 导航栏 End -->

            <!-- 内容 Start -->
            <div style="padding-top: 1em;">
                <div class="table-responsive">
                    <table class="table table-hover ">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>标识</th>
                            <th>IP</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>

                        @if(count($servers) > 0)
                            <tbody>
                            @foreach($servers as $server)
                                <tr>
                                    <th>{{$server->id}}</th>
                                    <th>{{$server->name}}</th>
                                    <th>{{$server->host->ip}}</th>
                                    <th>
                                        @if($server->status == 0)
                                            <span class="label label-default">{{$server->getStatusText()}}</span>
                                        @elseif($server->status == 1)
                                            <span class="label label-success">{{$server->getStatusText()}}</span>
                                        @elseif($server->status == 2)
                                            <span class="label label-warning">{{$server->getStatusText()}}</span>
                                        @else
                                            <span class="label label-danger">{{$server->getStatusText()}}</span>
                                        @endif
                                    </th>
                                    <th>
                                        <button class="btn btn-warning btn-sm">管理</button>
                                    </th>
                                </tr>
                            @endforeach
                            </tbody>
                        @endif
                    </table>
                    <div class="center-block">
                        {{ $servers->links() }}
                    </div>


                    @if(if_route('server.list.all') && Auth::user()->can("create server"))
                        @if(count($servers) == 0 )
                            <div style="margin: 4em auto;text-align: center">
                                这里毛都没有，赶快
                                <a href="#" data-toggle="modal" data-target="#createServer">创建一台服务器</a> 吧！
                            </div>
                        @else
                            <div style="text-align: right">
                                <a href="#" data-toggle="modal" data-target="#createServer">创建一台服务器 >>></a>
                            </div>
                        @endif

                    <!-- 创建服务器模状框 Start -->
                        <div class="modal fade" id="createServer" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h4 class="modal-title" id="myModalLabel">创建服务器</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <form class="form-horizontal col-md-offset-1"
                                                  action="{{route('server.create')}}"
                                                  method="post">
                                                {{ csrf_field() }}

                                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                                    <label for="name" class="col-md-3 control-label">标识</label>

                                                    <div class="input-group col-md-6">
                                                        <input id="name" type="text" class="form-control"
                                                               name="name"
                                                               value="{{ old('name') }}" required
                                                               autofocus>
                                                        @if ($errors->has('name'))
                                                            <span class="help-block">
										                            <strong>{{ $errors->first('name') }}</strong>
									                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group{{ $errors->has('host') ? ' has-error' : '' }}">
                                                    <label for="host" class="col-md-3 control-label">主机</label>

                                                    <div class="input-group col-md-6">
                                                        <select name="host" class="form-control">
                                                            @foreach($hosts as $host)
                                                                <option value="{{$host->id}}">{{$host->name}}
                                                                    [{{$host->ip}}]
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @if ($errors->has('host'))
                                                            <span class="help-block">
										                            <strong>{{ $errors->first('host') }}</strong>
									                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                               {{-- <div class="form-group{{ $errors->has('port') ? ' has-error' : '' }}">
                                                    <label for="port" class="col-md-3 control-label">端口</label>

                                                    <div class="input-group col-md-6">
                                                        <input id="port" type="number" min="0" class="form-control"
                                                               name="port"
                                                               value="{{ old('port') }}"
                                                               required>
                                                        @if ($errors->has('port'))
                                                            <span class="help-block">
										                            <strong>{{ $errors->first('port') }}</strong>
									                            </span>
                                                        @endif
                                                    </div>
                                                    <span class="help-block col-md-offset-3">
                                                                tips: 设置后不可更改
                                                        </span>
                                                </div>--}}

                                                <div class="form-group{{ $errors->has('expire') ? ' has-error' : '' }}">
                                                    <label for="expire" class="col-md-3 control-label">到期时间</label>

                                                    <div class="input-group col-md-6">
                                                        <input id="expire" class="form-control"
                                                               name="expire"
                                                               value="{{ old('expire') }}"
                                                               required>
                                                        @if ($errors->has('expire'))
                                                            <span class="help-block">
										                            <strong>{{ $errors->first('expire') }}</strong>
									                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group{{ $errors->has('max_mem') ? ' has-error' : '' }}">
                                                    <label for="max_mem" class="col-md-3 control-label">内存限制</label>

                                                    <div class="input-group col-md-6">
                                                        <input id="max_mem" type="number" min="0"
                                                               class="form-control"
                                                               name="max_mem"
                                                               value="{{ old('max_mem') ?? 1024 }}"
                                                               required>
                                                        <div class="input-group-addon">M</div>
                                                        @if ($errors->has('max_mem'))
                                                            <span class="help-block">
										                            <strong>{{ $errors->first('max_mem') }}</strong>
									                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group{{ $errors->has('max_hard_disk_capacity') ? ' has-error' : '' }}">
                                                    <label for="max_hard_disk_capacity"
                                                           class="col-md-3 control-label">磁盘空间限制</label>

                                                    <div class="input-group col-md-6">
                                                        <input id="max_hard_disk_capacity" type="number" min="0"
                                                               class="form-control"
                                                               name="max_hard_disk_capacity"
                                                               value="{{ old('max_hard_disk_capacity') }}"
                                                               required>
                                                        <div class="input-group-addon">M</div>
                                                        @if ($errors->has('max_hard_disk_capacity'))
                                                            <span class="help-block">
										                            <strong>{{ $errors->first('max_hard_disk_capacity') }}</strong>
									                            </span>
                                                        @endif

                                                    </div>
                                                    <span class="help-block col-md-offset-3">
                                                                tips: 设置后不可更改
                                                        </span>
                                                </div>

                                                <div class="form-group{{ $errors->has('max_cpu_utilizatio_rate') ? ' has-error' : '' }}">
                                                    <label for="max_cpu_utilizatio_rate"
                                                           class="col-md-3 control-label">CPU 限制</label>

                                                    <div class="input-group col-md-6">
                                                        <input id="max_cpu_utilizatio_rate" type="number" min="1"
                                                               class="form-control"
                                                               name="max_cpu_utilizatio_rate"
                                                               value="{{ old('max_cpu_utilizatio_rate') ?? 1 }}"
                                                               required>
                                                        <div class="input-group-addon">核</div>
                                                        @if ($errors->has('max_cpu_utilizatio_rate'))
                                                            <span class="help-block">
										                            <strong>{{ $errors->first('max_cpu_utilizatio_rate') }}</strong>
									                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                            </form>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">取消
                                        </button>
                                        <button type="button" class="btn btn-primary" onclick="$('form').submit();">
                                            创建
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- 创建服务器模状框 End -->

                    @elseif(count($servers) == 0 )

                        <div style="margin: 4em auto;text-align: center">
                            这里空荡荡的，什么也没有
                        </div>
                    @endif

                </div>
            </div>

            <!-- 内容 End -->
        </div>
    </div>

@endsection
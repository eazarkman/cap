@extends('layouts.page')

@section('content')
    @include('layouts.left')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
            <div class="row" style="margin-bottom: 15px;">
                <div class="col-xs-2">
                    <button type="button" class="btn btn-block btn-info btn-lg" onclick="adduser()">Add User</button>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">User Management</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" id="userview">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Admin</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->admin == 1)
                                            Admin User
                                        @else
                                            Associate
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Admin</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
        @if($errors->any())
            <div class="container" id="user-register">
        @else
            <div class="container" id="user-register" style="display:none">
        @endif
            <div class="row">
                <div id="result"></div>
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Register</div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/user/register') }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="col-md-4 control-label">Name</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group{{ $errors->has('admin') ? ' has-error' : '' }}">
                                    <label for="equity" class="col-md-4 control-label">Admin ? </label>

                                    <div class="col-md-6 input-group">
                                        <div class="form-group">
                                            <select class="form-control" name="admin" id="admin">
                                                <option value="1">Admin</option>
                                                <option value="0">Associate</option>
                                            </select>
                                        </div>
                                        @if ($errors->has('admin'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('admin') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-4 control-label">Password</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                        @if ($errors->has('password_confirmation'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Register
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- /.content-wrapper -->
    @include('layouts.contentfooter')

    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
    <!-- ./wrapper -->

    <script type="text/javascript">
        function adduser() {
            $("#user-register").show();
        }

        $("#register").on("submit", function(e) {
            alert('hello');
            return false;
            e.preventDefault();
            var results = '';
            $.post('register', {username: $("#username").val(), email: $("#email").val(), password:$("#password").val(), password_confirmation:$("#password_confirmation").val()}, function(data) {
                $.each(data, function(){
                    results += this + '<br>';
                });
                $("#results").html(results);
            });
        });

    </script>

@endsection

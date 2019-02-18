@extends('layouts.admin.app')

@section('content')
    <!-- Main content -->
    <section class="content">
        @include('layouts.errors-and-messages')
        <form action="{{ route('admin.users.update', $user->id) }}" method="post" class="form">
            @method('put')
            @csrf
            <!-- Default box -->
            <div class="box">
                <div class="box-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td class="col-md-4">Name</td>
                                <td class="col-md-4">Email</td>
                                <td class="col-md-4">Password</td>
                            </tr>
                        </tbody>
                        <tbody>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <input name="name" type="text" class="form-control" value="{{ $user->name }}">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input name="email" type="email" class="form-control" value="{{ $user->email }}">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input name="password" type="password" class="form-control" value="" placeholder="xxxxxx">
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="btn-group">
                        <button class="btn btn-success btn-sm" type="submit"> <i class="fa fa-save"></i> Save</button>
                    </div>
                </div>
            </div>
            <!-- /.box -->
        </form>

    </section>
    <!-- /.content -->
@endsection

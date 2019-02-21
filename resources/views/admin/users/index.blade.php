@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
    <h1>Users</h1>
@stop

@section('content')
    <!-- Main content -->
    <section class="content">
    @include('layouts.errors-and-messages')
    <!-- Default box -->
        @if($users)
            <div class="box">
                <div class="box-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <td class="col-md-4">Имя</td>
                            <td class="col-md-4">Почта</td>
                            <td class="col-md-4">Действия</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    <a href="{{ route('admin.users.show', $user->id) }}">{{ $user->name }}</a>
                                </td>
                                <td>
                                    {{$user->email}}
                                </td>

                                <td>
                                    <div class="btn-group">

                                        <form action="{{ route('admin.users.destroy', $user->id) }}"
                                              method="post">
                                            @csrf
                                            @method('delete')
                                            <a href="{{ route('admin.users.show', $user->id) }}"
                                               class="btn btn-default btn-sm"><i class="fa fa-eye"></i>Показать</a>
                                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                               class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Редактировать</a>
                                            <button onclick="return confirm('Вы уверены?')" type="submit"
                                                    class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Удалить
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $users->links() }}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        @endif

    </section>
    <!-- /.content -->
@endsection

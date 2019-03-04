@extends('adminlte::page')

@section('title', 'Posts')

@section('content_header')
    <h1>Posts</h1>
@stop

@section('content')
    @include('layouts.errors-and-messages')
    <!-- Default box -->
            <div class="box datatables_box">
                <div class="box-body">
                    <table id="datatable" class="table" data-api_route="{{route('api.posts.admin-index')}}" data-columns_config="{{json_encode(\App\Models\Post::ADMIN_DATATABLES_JSON)}}">
                        <thead>
                        <tr>
                            <td class="col-md-2">Название</td>
                            <td class="col-md-2">Тип записи</td>
                            <td class="col-md-2">Изображение</td>
                            <td class="col-md-2">Время создания</td>
                            <td class="col-md-2">Действия</td>
                        </tr>
                        </thead>

                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

    <!-- /.content -->
@endsection

@extends('adminlte::page')

@section('title', 'Posts')


@section('content')
    <!-- Main content -->
    <section class="content">

    @include('layouts.errors-and-messages')
    <!-- Default box -->
        @if($post)
            <div class="box">
                <div class="box-body">
                    <h2>Запись</h2>
                    <table class="table">
                        <thead>
                        <tr>
                            <td class="col-md-4">Название</td>
                            <td class="col-md-4">Контент</td>
                            <td class="col-md-4">Краткое описание</td>
                            <td class="col-md-4">Изображение</td>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $post->name }}</td>
                                <td>{!! $post->content !!}</td>
                                <td>{{ $post->short_desc }}</td>
                                <td>
                                    @if(isset($post->cover))
                                        <img src="{{asset("storage/$post->cover")}}" alt="category image" class="img-thumbnail">
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="btn-group">
                        <a href="{{url()->previous()==url()->current()?route('admin.posts.index'):url()->previous() }}" class="btn btn-default btn-sm">Назад</a>
                    </div>
                </div>
            </div>
            <!-- /.box -->
        @endif

    </section>
    <!-- /.content -->
@endsection

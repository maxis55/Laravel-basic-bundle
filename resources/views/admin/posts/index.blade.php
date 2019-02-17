@extends('adminlte::page')

@section('title', 'Posts')

@section('content_header')
    <h1>Posts</h1>
@stop

@section('content')
    <!-- Main content -->
    <section class="content">
    @include('layouts.errors-and-messages')
    <!-- Default box -->
        @if($posts)
            <div class="box">
                <div class="box-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <td class="col-md-3">Название</td>
                            <td class="col-md-3">Тип записи</td>
                            <td class="col-md-3">Изображение</td>
                            <td class="col-md-3">Действия</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($posts as $single_post)
                            <tr>
                                <td>
                                    <a href="{{ route('admin.posts.show', $single_post->id) }}">{{ $single_post->name }}</a>
                                </td>
                                <td>
                                    @lang($single_post->type)
                                </td>
                                <td>
                                    @if(isset($single_post->cover))
                                        <img src="{{ asset("storage/$single_post->cover") }}" alt="cover" class="img-responsive">
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">

                                        <form action="{{ route('admin.posts.destroy', $single_post->id) }}"
                                              method="post">
                                            @csrf
                                            @method('delete')
                                            <a href="{{ route('admin.posts.edit', $single_post->id) }}"
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
                    {{ $posts->links() }}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        @endif

    </section>
    <!-- /.content -->
@endsection

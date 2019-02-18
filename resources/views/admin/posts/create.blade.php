@extends('adminlte::page')

@section('title', 'Create post')

@section('content_header')
    <h1>Create post</h1>
@stop

@section('content')
    <!-- Main content -->
    <section class="content">
        @include('layouts.errors-and-messages')
        <div class="box">
            <form action="{{ route('admin.posts.store') }}" method="post" class="form posts_form" enctype="multipart/form-data">
                <div class="box-body">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="type">Тип записи <span class="text-danger">*</span></label>
                        <select type="text" name="type" id="type" class="form-control" required autocomplete="off">
                            @foreach(\App\Models\Post::POST_TYPES as $post_type)
                                <option value="{{$post_type}}" >{{$post_type}}</option>
                            @endforeach
                        </select>
                    </div>

                    {{--Add types for type specific blocks with content that will appear when post type is chosen--}}
                    <div class="type_specific_block {{\App\Models\Post::TYPE_DEFAULT}}-block" style="display: none">

                    </div>

                    <div class="form-group">
                        <label for="name">Название <span class="text-danger">*</span></label>
                        <input required type="text" name="name" id="name" placeholder="Название" class="form-control" value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="content">Описание </label>
                        <textarea class="form-control ckeditor" name="content" id="content" rows="5" placeholder="Описание">{{ old('content') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="short_desc">Краткое описание </label>
                        <textarea class="form-control" name="short_desc" id="short_desc" rows="5" placeholder="Краткое описание">{{ old('short_desc') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="cover">Изображение </label>
                        <input type="file" name="cover" id="cover" class="form-control">
                    </div>




                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="btn-group">
                        <a href="{{ route('admin.posts.index') }}" class="btn btn-default">Назад</a>
                        <button type="submit" class="btn btn-primary">Создать</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection

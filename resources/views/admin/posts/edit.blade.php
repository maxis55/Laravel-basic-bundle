@extends('adminlte::page')

@section('title', 'Редактировать запись')

@section('content_header')
    <h1>Редактировать запись</h1>
@stop

@section('content')
    <!-- Main content -->
    <section class="content">
        @include('layouts.errors-and-messages')
        <div class="box">
            <form action="{{ route('admin.posts.update', $post->id) }}" method="post" class="form dynamic_form" enctype="multipart/form-data">
                <div class="box-body">
                    <input type="hidden" name="_method" value="put">
                    @csrf
                    <div class="form-group">
                        <label for="type">Тип записи <span class="text-danger">*</span></label>
                        <select type="text" name="type" id="type" class="form-control type_select" required autocomplete="off">
                            @foreach(\App\Models\Post::POST_TYPES as $post_type)
                            <option value="{{$post_type}}" {{$post->type===$post_type?'selected':''}}>{{$post_type}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="type_specific_block {{\App\Models\Post::TYPE_DEFAULT}}-block" style="display: none">

                    </div>


                    <div class="form-group">
                        <label for="name">Название <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" placeholder="Name" class="form-control" value="{!! $post->name ?: old('name')  !!}">
                    </div>
                    <div class="form-group">
                        <label for="description">Описание </label>
                        <textarea class="form-control ckeditor" name="description" id="description" rows="5" placeholder="Описание">{!! $post->content ?: old('content')  !!}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="short_desc">Краткое описание </label>
                        <textarea class="form-control" name="short_desc" id="short_desc" rows="5" placeholder="Краткое описание">{!! $post->short_desc ?: old('short_desc')  !!}</textarea>
                    </div>
                    @if(isset($post->cover))
                    <div class="form-group">
                        <img src="{{ asset("storage/$post->cover") }}" alt="cover" class="img-responsive"> <br/>
                        <a onclick="return confirm('Вы уверены?')" href="{{ route('admin.posts.remove-image', ['news' => $post->id]) }}" class="btn btn-danger">Удалить изображение?</a>
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="cover">Изображение </label>
                        <input type="file" name="cover" id="cover" class="form-control">
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="btn-group">
                        <a href="{{ route('admin.posts.index') }}" class="btn btn-default">Назад</a>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection


@section('js')
    <script src="{{ asset('admin/js/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('admin/js/ckeditor/ru.js') }}"></script>
    <script src="{{ asset('admin/js/app.js') }}"></script>
    @endsection
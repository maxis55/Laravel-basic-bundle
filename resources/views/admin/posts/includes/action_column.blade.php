<div class="btn-group">
        <a href="{{ route('admin.posts.edit', $post->id) }}"
           class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Редактировать</a>
        <a data-confirmation="Вы уверены?" href="{{route('admin.posts.destroy', $post->id)}}"
           class="btn btn-danger btn-sm delete_element"><i class="fa fa-times"></i> Удалить
        </a>
</div>
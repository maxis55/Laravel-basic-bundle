<div class="btn-group">
        <a href="{{ route('admin.'.$route.'.show', $post->id) }}"
           class="btn btn-default btn-sm"><i class="fa fa-eye"></i> Показать</a>
        <a href="{{ route('admin.'.$route.'.edit', $post->id) }}"
           class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Редактировать</a>
        <a data-confirmation="Вы уверены?" href="{{route('admin.'.$route.'.destroy', $post->id)}}"
           class="btn btn-danger btn-sm delete_element"><i class="fa fa-times"></i> Удалить
        </a>
</div>
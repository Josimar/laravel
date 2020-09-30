<ul>
    @foreach($childs as $child)
        <li>
            <a href="javascript:void(0)" class="atualizarCategoria" data-id="{{ $child->id }}">{{ $child->descricao }}</a>
            @if(count($child->childs))
                @include('categorias.treeviewitem',['childs' => $child->childs])
            @endif
        </li>
    @endforeach
</ul>

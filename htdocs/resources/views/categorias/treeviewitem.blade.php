<ul>
    @foreach($childs as $child)
        <li>
            {{ $child->descricao }}
            @if(count($child->childs))
                @include('categorias.treeviewitem',['childs' => $child->childs])
            @endif
        </li>
    @endforeach
</ul>

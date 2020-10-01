<ul>
    @foreach($childs as $child)
        <li>
            <input type="checkbox" id="categoriaid[]" name="categoriaid[]" value="{{ $child->id }}">
            {{ $child->descricao }}
            @if(count($child->childs))
                @include('admin.sistemas.treeviewitem',['childs' => $child->childs])
            @endif
        </li>
    @endforeach
</ul>

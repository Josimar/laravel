<div class="card-header">
    <h3 class="card-title">{{$titulo}}</h3>
    <div class="card-tools">
        <ul class="pagination pagination-sm float-right">
            <!--
            <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
            //-->
            @if(!$search && $recordsetList)
               <!-- {{ $recordsetList->links() }} ToDo: Css --> 
            @endif
        </ul>
    </div>
</div>
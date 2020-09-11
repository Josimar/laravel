@if (session('msgMessage') && session('msgStatus'))
    @php
        $status = session('msgStatus');
        $message = session('msgMessage');

         if ($status == "error"){
            $status = "danger";
         }elseif ($status == "notification"){
            $status = "info";
         }else{
            $status == "success";
         }
    @endphp

    <div id="alert" class="alert alert-{{$status}}" role="alert">
        {{ $message }}
    </div>
@endif

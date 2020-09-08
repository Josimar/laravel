@if (isset($message) && $message != "" && isset($status) && $status != "")
    @php
     if ($status == "error"){
        $status = "danger";
     }elseif ($status == "notification"){
        $status = "info";
     }else{
        $status == "success";
     }
    @endphp

    <div class="alert alert-{{$status}}" role="alert">
        {{ $message }}
    </div>
@endif

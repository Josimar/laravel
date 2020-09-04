@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('controle.dashboard') }}</div>

                <div class="card-body">
                    @alert()
                    @endalert
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

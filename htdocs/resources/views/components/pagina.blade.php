<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('controle.list') }} {{ __($page) }}</h1>
                </div>
                <div class="col-sm-6">
                    <x-breadcrumb :caminhos="$caminhos"></x-breadcrumb>
                </div>
            </div>
        </div>
    </section>

    {{ $slot }}

    @if (isset($columnList) && !empty($columnList))
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <x-alert :message="$msgMessage ?? ''" :status="$msgStatus ?? ''" />
                    <div class="card">
                        <x-paginacao titulo="{{__($page)}}" :search="$search" :recordsetList="$recordsetList" />
                        <div class="card-body p-0">
                            <x-tabela :routeName="$routeName ?? 'tarefas'" :columnList="$columnList" :recordsetList="$recordsetList" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
</div>

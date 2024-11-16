@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dash') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pedidos</li>
            </ol>
        </nav>
    </div>
</div>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mx-lg-2 mb-0 text-gray-800">Pedidos</h1>
</div>
<div class="row mx-lg-2 mb-4">
    <div class="col-lg-12 bg-white">
        <div class="text-left my-3">
            <a class="btn btn-sm btn-primary btn-icon-split" href="{{ route('admin.order.create') }}">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Criar pedido</span>
            </a>
        </div>
        <input type="text" class="form-control form-control-sm" id="filter" placeholder="Procurar pedido">
        <div class="mt-3">
            @include('layouts.flash-message')
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID pedido</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">CPF</th>
                        <th scope="col">Valor total</th>
                        <th scope="col">Data do pedido</th>
                        <th scope="col">Tipo do frete</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td scope="row">Pedro Nunes</th>
                        <td scope="row">318.193.888-55</th>
                        <td>R$ 5.199,99</td>
                        <td>25 de outubro de 2024 19:50hrs</td>
                        <td>PAC</td>
                        <td>Visualizar</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('layouts.modal-delete')

@endsection
@push('script')
<script type="text/javascript">
    $(document).ready(function() {
        /** Deletar item */
        $('a.delete-product').on('click', function(e) {
            if ($('.alert').length > 0) {
                $('.alert').remove();
                $('.btn-load').removeAttr('disabled');
            }
            $('b.modal-item-name').text($(this).data('modal-item-name'));
            $('button').data('url', $(this).data('url'));
            $('span.subtitle').text($(this).data('subtitle'));
        });
    });
</script>
@endpush
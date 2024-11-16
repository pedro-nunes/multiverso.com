@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dash') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.customer.index') }}">Clientes</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    @isset($customer)
                    Editar cliente
                    @else
                    Cadastrar cliente
                    @endisset
                </li>
            </ol>
        </nav>
    </div>
</div>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mx-lg-2 mb-0 text-gray-800">
        @isset($customer)
        Editar cliente: {{ $customer->first_name . ' ' . $customer->last_name }}
        @else
        Cadastrar cliente
        @endisset
    </h1>
</div>
<div class="row mx-lg-2 mb-4">
    <div class="col-lg-12 bg-white">
        <form class="send-ajax form-horizontal my-4" id="send-ajax"
            action="{{ isset($customer) ? route('admin.customer.update', $customer->id) : route('admin.customer.store') }}"
            method="post" autocomplete="off">
            @isset($customer) @method('PUT') @endisset
            <div class="ajax-alert"></div>
            <div class="row">
                <div class="col-sm-12 col-md-3">
                    <div class="form-group">
                        <label for="first_name">Nome: <i class="text-danger">*</i></label>
                        <input type="text" class="form-control" name="first_name" id="first_name"
                            value="{{ $customer->first_name ?? '' }}" required autocomplete="off">
                    </div>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="form-group">
                        <label for="last_name">Sobrenome: <i class="text-danger">*</i></label>
                        <input type="text" class="form-control" name="last_name" id="last_name"
                            value="{{ $customer->last_name ?? '' }}" required autocomplete="off">
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="register">RG:</label>
                        <input type="text" class="form-control" name="register" id="register"
                            value="{{ $customer->register ?? '' }}">
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="document">CPF: <i class="text-danger">*</i></label>
                        <input type="tel" class="form-control" name="document" id="document"
                            data-inputmask="'mask':'999.999.999-99'" value="{{ $customer->document ?? '' }}" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 col-md-3">
                    <div class="form-group">
                        <label for="whatsapp">Whatsapp: <i class="text-danger">*</i></label>
                        <input type="tel" class="form-control" name="whatsapp" id="whatsapp"
                            data-inputmask="'mask':'99 9999-9999[9]'" value="{{ $customer->whatsapp ?? '' }}">
                    </div>
                </div>
                <div class="col-sm-4 col-md-3">
                    <div class="form-group">
                        <label for="phone">Telefone: <i class="text-danger">*</i></label>
                        <input type="tel" class="form-control" name="phone" id="phone"
                            data-inputmask="'mask':'99 9999-9999[9]'" value="{{ $customer->phone ?? '' }}"
                            autocomplete="off">
                    </div>
                </div>
                <div class="col-sm-4 col-md-3">
                    <div class="form-group">
                        <label for="email">E-mail: <i class="text-danger">*</i></label>
                        <input type="email" class="form-control" name="email" id="email"
                            value="{{ $customer->email ?? '' }}" required autocomplete="off">
                    </div>
                </div>
                <div class="col-sm-4 col-md-3">
                    <div class="form-group">
                        <label for="where_find">Como nos conheceu:</label>
                        <input list="where_finds" class="form-control" name="where_find" id="where_find"
                            value="{{ $customer->where_find ?? '' }}">
                        <datalist id="where_finds">
                            <option value="Google">
                            <option value="Facebook">
                            <option value="Instagram">
                            <option value="Indicação">
                        </datalist>
                    </div>
                </div>
            </div>
            <div class="col-12 text-left">
                <div class="icon-load"></div>
                <button type="submit" class="btn btn-sm btn-success btn-icon-split btn-load">
                    <span class="icon text-white-50"><i class="fas fa-save fa-fw"></i></span>
                    <span class="text">Salvar</span>
                </button>
                <a class="btn btn-sm btn-light btn-icon-split" href="{{ route('admin.customer.index') }}">
                    <span class="icon text-white-50"><i class="fas fa-ban fa-fw"></i></span>
                    <span class="text">Cancelar</span>
                </a>
            </div>
        </form>
    </div>
</div>

@isset($customer)
<div class="row mx-lg-2 mb-4">
    <div class="col-12 p-4 bg-white">
        <h4 class="mx-lg-2 mb-4">Endereços</h4>
        <div class="text-left my-3">
            <a class="create-address btn btn-sm btn-primary btn-icon-split" href="#" title="Cadastrar endereço"
                data-toggle="modal" data-target="#modal-address-create">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Cadastrar endereço</span>
            </a>
        </div>
        <div class="row">
            @forelse($customer->addresses as $a) <div class="col-sm-12 col-lg-4 mb-3">
                <div class="card" style="">
                    <div class="card-body">
                        <h5 class="card-title h6">{{ $a->address }}, {{ $a->number }}, {{ $a->complement }}
                        </h5>
                        <h6 class="card-subtitle mb-2 text-muted">
                            <span class="badge badge-light rounded-0">
                                <i class="fas fa-{{ $a->type == 'casa' ? 'home' : 'briefcase' }}"></i> {{ $a->type }}
                            </span>
                            @if($a->main == 1)
                            <span class="badge badge-success rounded-0">Principal</span>
                            @endif
                        </h6>
                        <div class="card-text">
                            <p><span>CEP {{ $a->zip }} - {{ $a->state }} - {{ $a->city }}</span></p>
                            <p>{{ $a->responsible }} - {{ $a->phone }}</p>
                            <a href="#" class="btn btn-primary btn-icon-split btn-sm address-edit" data-toggle="modal"
                                data-target="#modal-address-edit" data-route="{{ route('admin.address.edit', $a->id) }}"
                                data-route-update="{{ route('admin.address.update', $a->id) }}">
                                <span class="icon text-white-50">
                                    <i class="fas fa-edit"></i>
                                </span>
                                <span class="text">Editar</span>
                            </a>
                            <a href="#" class="btn btn-danger btn-icon-split btn-sm">
                                <span class="icon text-white-50">
                                    <i class="fas fa-trash"></i>
                                </span>
                                <span class="text">Deletar</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            @endforelse
        </div>
    </div>
</div>

<div class="row mx-lg-2 mb-4">
    <div class="col-12 p-4 bg-white">
        <h4 class="mx-lg-2">Pedidos</h4>
        <div class="row">
            <div class="col-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID Pedido</th>
                            <th scope="col">Valor total</th>
                            <th scope="col">Data do pedido</th>
                            <th scope="col">Status</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>R$ 5.199,99</td>
                            <td>25 de Outubro de 2024</td>
                            <td>Entregue</td>
                            <td>
                                <a class="btn btn-sm btn-secondary" href="#" title="Visualizar pedido">
                                    <i class="fas fa-eye fa-fw"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('admin.customer.modal-address-create')
@include('admin.customer.modal-address-edit')

@endisset
@endsection
@push('script')
<script src="{{ asset('vendor/inputmask/dist/inputmask.min.js') }}"></script>
<script src="{{ asset('vendor/inputmask/dist/bindings/inputmask.binding.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('a.address-edit').on('click', function(e) {
            const routeUpdate = $(this).data('route-update');
            const route = $(this).data('route');
            const $modalForm = $('#modal-address-edit form');
            const $inputs = $modalForm.find('input, textarea');
            const $alert = $('.alert');
            // Remove todos os alertas se existirem
            if ($alert.length > 0) {
                $alert.remove();
            }
            // Realiza a requisição AJAX para buscar os dados
            $.get(route, function(data) {
                // Atualiza a ação do formulário
                $modalForm.attr('action', routeUpdate);
                // Preenche os campos com os dados retornados
                const a = data.a;

                $modalForm.find('input[name="responsible"]').val(a.responsible);
                $modalForm.find('input[name="phone"]').val(a.phone);
                $modalForm.find('input[name="zip"]').val(a.zip);
                $modalForm.find('input[name="address"]').val(a.address);
                $modalForm.find('input[name="number"]').val(a.number);
                $modalForm.find('input[name="complement"]').val(a.complement);
                $modalForm.find('input[name="district"]').val(a.district);
                $modalForm.find('input[name="city"]').val(a.city);
                $modalForm.find('input[name="state"]').val(a.state);
                $modalForm.find('textarea[name="information"]').val(a.information);
                // Atualiza o campo do tipo (Casa ou Trabalho)
                if (a.type === 'Casa') {
                    $modalForm.find('input[id="type"]').prop('checked', true);
                } else if (a.type === 'Trabalho') {
                    $modalForm.find('input[id="type2"]').prop('checked', true);
                }
                // Atualiza o campo principal
                $modalForm.find('input[name="main"]').prop('checked', a.main === 1);
            })
            .fail(function() {
                // Lida com falha na requisição
                alert("Ocorreu um erro ao carregar os dados. Tente novamente.");
            });
        });
    });
</script>
@endpush
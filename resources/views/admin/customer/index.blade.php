@extends('layouts.admin')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Clientes</h1>
</div>
<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href={{ route('admin.dash') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Clientes</li>
            </ol>
        </nav>
    </div>
</div>
<div class="row mx-lg-2 mb-4">
    <div class="col-lg-12 bg-white">
        <div class="text-left my-3">
            <a class="btn btn-sm btn-primary btn-icon-split" href=" {{ route('admin.customer.create') }}">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Cadastrar cliente</span>
            </a>
        </div>
        <input type="text" class="form-control form-control-sm" id="filter" placeholder="Procurar cliente">
        <div class="mt-3">
            @include('layouts.flash-message')
        </div>
        <table class="table table-responsive-md">
            <thead>
                <tr>
                    <th scope=" col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">WhatsApp</th>
                    <th scope="col">Telefones</th>
                    <th scope="col" Cadastrado</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                @forelse($customers as $c)
                <tr>
                    <th scope="row">{{ $c->id }}</th>
                    <td>{{ $c->first_name . ' ' . $c->last_name }} </td>
                    <td>{{ $c->email }}</td>
                    <td><i class="fab fa-whatsapp fa-fw text-success"></i>{{ $c->whatsapp }}</td>
                    <td>{{ $c->phone }}</td>
                    <td>{{ $c->created_at }}</td>
                    <td class="text-center footable-visible footable-last-column">
                        <a class="btn btn-sm btn-primary" href="{{ route('admin.customer.edit', $c->id) }}"
                            title="Editar dados">
                            <i class="fas fa-edit fa-fw"></i>
                        </a>
                        <a class="delete-customer btn btn-sm btn-danger" href="#" title="Excluir cliente"
                            data-toggle="modal" data-target="#modal-delete" data-subtitle="o cliente"
                            data-url="{{ route('admin.customer.destroy', $c->id) }}"
                            data-modal-item-name="{{ $c->first_name }}">
                            <i class="fas fa-trash-alt fa-fw"></i>
                        </a>
                    </td>
                </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@include('layouts.modal-delete')
@endsection
@push('script')
<script type="text/javascript">
    $(document).ready(function() {
        /**
         * Deletar item
         */
        $('a.delete-customer').on('click', function(e) {
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
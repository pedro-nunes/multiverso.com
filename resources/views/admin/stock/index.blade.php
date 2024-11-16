@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dash') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Estoque</li>
            </ol>
        </nav>
    </div>
</div>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mx-lg-2 mb-0 text-gray-800">Alterar o estoque</h1>
</div>
<div class="row mx-lg-2 mb-4">
    <div class="col-lg-12 bg-white">
        <form class="send-ajax form-horizontal my-4" id="send-ajax" action="{{ route('admin.stock.store') }}"
            method="post" autocomplete="off">
            <div class="ajax-alert"></div>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="form-group">
                        <label for="description">Descrição: <i class="text-danger">*</i><br>
                            <small class="text-muted">Descreva o motivo da alteração do estoque</small>
                        </label>
                        <input type="text" class="form-control" name="description" id="description"
                            value="Entrada de novo produto cadastrado" required autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-2">
                    <div class="form-group">
                        <label for="product_code">Código do produto: <i class="text-danger">*</i></label>
                        <input type="text" class="form-control" name="product_code" id="product_code" required
                            autocomplete="off">
                    </div>
                </div>
                <div class="col-sm-12 col-md-8 col-lg-4">
                    <div class="form-group">
                        <label for="product_name">Nome do produto: </label>
                        <input type="text" class="form-control" name="product_name" id="product_name" disabled>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="form-group">
                        <label for="current_stock">Saldo atual: </label>
                        <input type="text" class="form-control" name="current_stock" id="current_stock" disabled>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="form-group">
                        <label for="new_stock">Novo Saldo: <i class="text-danger">*</i></label>
                        <input type="text" class="form-control" name="new_stock" id="new_stock" required
                            autocomplete="off">
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-2 d-flex align-items-center">
                    <button type="submit"
                        class="btn btn-sm btn-success btn-icon-split btn-load border border-2 border-success"
                        style="margin-top: 0.55rem">
                        <span class="icon text-white-50"><i class="fas fa-save fa-fw"></i></span>
                        <span class="text">Salvar</span>
                    </button>
                </div>
            </div>
        </form>
        <hr class="separator">
        <h4 class="mx-lg-2 mb-4">Ultímas alterações</h4>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Descrição</th>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Saldo</th>
                        <th class="text-center">Entrada/Saída</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stock as $s)
                    <tr>
                        <td>{{ $s->created_at }}</td>
                        <td>{{ $s->description }}</td>
                        <td class="text-center">{{ $s->product->code }}</td>
                        <td>{{ $s->product->name }}</td>
                        <td class="text-center">{{ $s->product->stock }}</td>
                        <td class="text-center">Entrada</td>
                    </tr>
                    @empty
                    @endforelse
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
        
        $('input[name="product_code"]').on('change', function(e) {
            const code = $(this).val();            
            const route = "{{ route('admin.stock.getProduct') }}/"+code;
            const $form = $('form');
            $.get(route, function(data) {
                const p = data.p;
                if(p === null) {
                    alert("Produto não encontrado. Confira se o código está correto");
                } else {
                    $form.find('input[name="product_name"]').val(p.name);
                    $form.find('input[name="current_stock"]').val(p.stock);
                }
                })
            .fail(function() {
                // Lida com falha na requisição
                alert("Ocorreu um erro ao carregar os dados. Tente novamente.");
            });
        });
    });
</script>
@endpush
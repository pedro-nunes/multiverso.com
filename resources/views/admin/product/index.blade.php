@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dash') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Produtos</li>
            </ol>
        </nav>
    </div>
</div>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mx-lg-2 mb-0 text-gray-800" role="heading" aria-level="1">Produtos</h1>
</div>
<div class="row mx-lg-2 mb-4">
    <div class="col-lg-12 bg-white">
        <div class="text-left my-3">
            <a class="btn btn-sm btn-primary btn-icon-split" href="{{ route('admin.product.create') }}" role="button">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Cadastrar produto</span>
            </a>
        </div>
        <div class="mt-3">
            @include('layouts.flash-message')
        </div>
        <div class="row">
            @foreach($products as $p)
            <div class="col-3 mb-3 px-1 d-flex align-items-stretch">
                <article class="card" aria-labelledby="product-title-{{ $p->id }}">
                    @if($p->thumbnail)
                    <img src="{{ asset('img/'. $p->thumbnail) }}" class="card-img-top" alt="{{ $p->name }}">
                    @endif
                    <div class="card-body p-3">
                        <h5 class="card-title h6" id="product-title-{{ $p->id }}">
                            {{ $p->name }}
                        </h5>
                        <h6 class="card-subtitle mb-2 text-muted">
                            @if($p->stock > 0)
                            <span class="badge badge-success rounded-0" aria-label="Disponível">Disponível</span>
                            @elseif($p->stock == $p->min_stock)
                            <span class="badge badge-warning rounded-0" aria-label="Estoque baixo">Estoque baixo</span>
                            @else
                            <span class="badge badge-secondary rounded-0" aria-label="Indisponível">Indisponível</span>
                            @endif
                        </h6>
                        <div class="card-text">
                            <p class="m-0"><strong>Estoque:</strong> {{ $p->stock }}</p>
                            <p class="m-0"><strong>Cod:</strong> {{ $p->code }}</p>
                            <p class=""><strong>Venda:</strong> R$ {{ $p->sale_price }}</p>
                        </div>
                    </div>
                    <div class="card-footer text-center bg-white">
                        <a href="{{ route('admin.product.edit', $p->id) }}"
                            class="btn btn-primary btn-icon-split btn-sm" role="button">
                            <span class="icon text-white-50">
                                <i class="fas fa-edit"></i>
                            </span>
                            <span class="text">Editar</span>
                        </a>
                        <a href="#" title="Excluir produto" data-toggle="modal" data-target="#modal-delete"
                            data-subtitle="a categoria" data-url="{{ route('admin.product.destroy', $p->id) }}"
                            data-modal-item-name="{{ $p->name }}"
                            class="btn btn-danger btn-icon-split btn-sm delete-product" role="button">
                            <span class="icon text-white-50">
                                <i class="fas fa-trash"></i>
                            </span>
                            <span class="text">Deletar</span>
                        </a>
                    </div>
                </article>
            </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            {{ $products->links() }}
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
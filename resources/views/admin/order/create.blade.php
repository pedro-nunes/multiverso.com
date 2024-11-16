@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dash') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.order.index') }}">Pedidos</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Criar pedido
                </li>
            </ol>
        </nav>
    </div>
</div>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mx-lg-2 mb-0 text-gray-800">Criar pedido</h1>
</div>
<div class="row mx-lg-1 mb-4">
    <div class="ajax-alert"></div>
    <form class="send-ajax form-horizontal mb-4" id="send-ajax" enctype="multipart/form-data"
        action="{{ route('admin.order.store') }}" method="POST" autocomplete="off">
        <div class="col-12 bg-white py-2">
            <h2 class="h4 ml-0">Dados do cliente</h2>
            <div class="row">
                <div class="col-12 col-sm-9 col-md-2">
                    <div class="form-group">
                        <label for="document">CPF: <i class="text-danger">*</i></label>
                        <input type="text" class="form-control" name="document" id="document" required
                            autocomplete="off">
                    </div>
                </div>
                <div class="col-6 col-sm-3 col-md-4">
                    <div class="form-group">
                        <label for="customer">Cliente: <i class="text-danger">*</i></label>
                        <input type="text" class="form-control" name="customer" id="customer" disabled>
                    </div>
                </div>
                <div class="col-12 col-sm-9 col-md-2 px-2">
                    <div class="form-group">
                        <label for="whatsapp">Whatsapp: <i class="text-danger">*</i></label>
                        <input type="text" class="form-control" name="whatsapp" id="whatsapp" disabled>
                    </div>
                </div>
                <div class="col-12 col-sm-9 col-md-2 pl-1">
                    <div class="form-group">
                        <label for="phone">Telefone: <i class="text-danger">*</i></label>
                        <input type="text" class="form-control" name="phone" id="phone" disabled>
                    </div>
                </div>
                <div class="col-12 col-sm-9 col-md-2 pl-1">
                    <div class="form-group">
                        <label for="register">RG: <i class="text-danger">*</i></label>
                        <input type="text" class="form-control" name="register" id="register" disabled>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-9 col-md-3">
                    <div class="form-group">
                        <label for="address_name">Endereço de entrega: <i class="text-danger">*</i></label>
                        <select class="custom-select" aria-label="Default select example" style="font-size:unset"
                            name="address_name">
                            <option value="Casa" elected>Casa (Padrão)</option>
                            <option value="Trabalho">Trabalho</option>
                            <option value="Amigo">Amigo</option>
                            <option value="Minha mãe">Minha mãe</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="form-group">
                        <label for="zip">CEP: <i class="text-danger">*</i></label>
                        <input type="tel" class="form-control" name="zip" id="zip" data-inputmask="'mask':'99999-999'"
                            value="{{ $customer->zip ?? '' }}">
                    </div>
                </div>
                <div class="col-12 col-md-5">
                    <div class="form-group">
                        <label for="address">Rua: <i class="text-danger">*</i></label>
                        <input type="text" class="form-control" name="address" id="address"
                            value="{{ $customer->address ?? '' }}" required>
                    </div>
                </div>
                <div class="col-12 col-sm-1 col-md-2">
                    <div class="form-group">
                        <label for="number">Número: <i class="text-danger">*</i></label>
                        <input type="text" class="form-control" name="number" id="number"
                            value="{{ $customer->number ?? '' }}" required>
                    </div>
                </div>
                <div class="col-12 col-sm-2">
                    <div class="form-group">
                        <label for="complement">Complemento:</label>
                        <input type="text" class="form-control" name="complement" id="complement"
                            value="{{ $customer->complement ?? '' }}">
                    </div>
                </div>
                <div class="col-12 col-sm-3">
                    <div class="form-group">
                        <label for="district">Bairro: <i class="text-danger">*</i></label>
                        <input type="text" class="form-control" name="district" id="district"
                            value="{{ $customer->district ?? '' }}" required>
                    </div>
                </div>
                <div class="col-12 col-sm">
                    <div class="form-group">
                        <label for="city">Cidade: <i class="text-danger">*</i></label>
                        <input type="text" class="form-control" name="city" id="city"
                            value="{{ $customer->city ?? '' }}" required>
                    </div>
                </div>
                <div class="col-12 col-sm-2 col-md-2">
                    <div class="form-group">
                        <label for="state">Estado <small>(Ex: SP)</small>: <i class="text-danger">*</i></label>
                        <input type="text" class="form-control" name="state" id="state" maxlength="2"
                            data-inputmask="'mask':'AA'" value="{{ $customer->state ?? '' }}" required>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="observation">Observação:</label>
                        <input type="text" class="form-control" name="observation" id="observation"
                            value="{{ $customer->observation ?? '' }}">
                    </div>
                </div>
            </div>
            <hr>
            <h2 class="h4 mt-2 ml-0">Itens do pedido</h2>
            <div class="row">
                <div class="col-6 col-sm-3 col-md-2 px-2">
                    <div class="form-group">
                        <label for="code">Código: <i class="text-danger">*</i></label>
                        <input type="text" class="form-control" name="code" id="code" required autocomplete="off">
                    </div>
                </div>
                <div class="col-12 col-sm-9 col-md-6 px-2">
                    <div class="form-group">
                        <label for="product">Produto: <i class="text-danger">*</i></label>
                        <input type="text" class="form-control" name="product" id="product" required autocomplete="off">
                    </div>
                </div>
                <div class="col-12 col-sm-9 col-md-2 pl-1">
                    <div class="form-group">
                        <label for="price">Preço: <i class="text-danger">*</i></label>
                        <input type="text" class="form-control" name="price" id="price" required autocomplete="off">
                    </div>
                </div>
                <div class="col-12 col-sm-9 col-md-1 pl-1">
                    <div class="form-group">
                        <label for="quantity">Qnt: <i class="text-danger">*</i></label>
                        <input type="number" class="form-control p-1" name="quantity" id="quantity" required
                            autocomplete="off">
                    </div>
                </div>
                <div class="col-12 col-sm-9 col-md-1 pl-0 text-right">
                    <p class="mb-1">&nbsp; </p>
                    <button type="button" class="btn btn-sm btn-success mt-1" title="Adicionar" alt="Adicionar">
                        Adicionar
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered my-4" id="items-list">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Produto</th>
                                <th>Preço</th>
                                <th class="text-center">Qtde</th>
                                <th>Subtotal</th>
                                <th class="text-center">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>0101</td>
                                <td>Camera Digital Canon EOS T100</td>
                                <td>R$ 5.199,99</td>
                                <td class="text-center">01</td>
                                <td>R$ 5.199,99</td>
                                <td class="text-center">
                                    <button type="button" data-target="services-list" title="Remover"
                                        class="btn btn-sm btn-danger delete-confirm" data-url="#">
                                        <i class="fas fa-trash fa-fw"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row cart-value-calc">
                <div class="col-6 col-sm-3 col-md-2">
                    <div class="form-group">
                        <label for="addition">Acréscimo: </label>
                        <input type="text" class="form-control" name="addition" id="addition" required>
                    </div>
                </div>
                <div class="col-12 col-sm-9 col-md-2">
                    <div class="form-group">
                        <label for="discount">Desconto: </label>
                        <input type="text" class="form-control" name="discount" id="discount" required
                            autocomplete="off">
                    </div>
                </div>
                <div class="col-12 col-sm-9 col-md-5">
                    <div class="form-group">
                        <label for="information">Informação: </label>
                        <input type="text" class="form-control" name="information" id="information" required
                            autocomplete="off">
                    </div>
                </div>
                <div class="col-md-3">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th class="text-left cart-subtotal-info">Subtotal: </th>
                                <td class="text-right cart-subtotal">R$ 5.199,99</td>
                            </tr>
                            <tr>
                                <th class="text-left cart-addition-info">Acréscimo: </th>
                                <td class="text-right cart-addition"></td>
                            </tr>
                            <tr>
                                <th class="text-left cart-discount-info">Desconto: </th>
                                <td class="text-right cart-discount"></td>
                            </tr>
                            <tr>
                                <th class="text-left cart-delivery-info">Frete: </th>
                                <td class="text-right cart-delivery"></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="cart-total-info">TOTAL:</th>
                                <td class="text-right cart-total"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <div class="icon-load"></div>
                    <button type="submit" class="btn btn-success btn-icon-split btn-load">
                        <span class="icon text-white-50"><i class="fas fa-save fa-fw"></i></span>
                        <span class="text">Salvar</span>
                    </button>
                    <a class="btn btn-light btn-icon-split" href="{{ route('admin.order.index') }}">
                        <span class="icon text-white-50"><i class="fas fa-ban fa-fw"></i></span>
                        <span class="text">Cancelar</span>
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('input[name="document"]').on('change', function(e) {
            const document = $(this).val();            
            const route = "{{ route('admin.order.getCustomer') }}/"+document;
            const $form = $('form');
            $.get(route, function(data) {
                const c = data.c;
                if(c === null) {
                    alert("Cliente não encontrado. Confira se o CPF foi digitado corretamente");
                } else {
                    $form.find('input[name="customer"]').val(c.first_name + ' ' + c.last_name);
                    $form.find('input[name="whatsapp"]').val(c.whatsapp);
                    $form.find('input[name="phone"]').val(c.phone);
                    $form.find('input[name="register"]').val(c.register);
                }
                })
            .fail(function() {
                alert("Ocorreu um erro ao carregar os dados. Tente novamente.");
            });
        });

        $('input[name="zip"]').on('change', function(e) {
            const zip = $(this).val();
            const getDeliveryPrice = "{{ route('admin.order.getDeliveryPrice') }}/"+zip;
            $.get(getDeliveryPrice, function(data) {
                const c = data.c;
                if(c === null) {
                    alert("Endereço não encontrado. Confira se o CEP foi digitado corretamente");
                } else {
                    $('.cart-delivery').text(c.frete);
                    $('.cart-total').text(c.total);
                }
                })
            .fail(function() {
                alert("Ocorreu um erro ao carregar os dados. Tente novamente.");
            });
        });
    });

</script>
@endpush
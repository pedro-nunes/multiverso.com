<div class="modal fade" id="modal-address-edit" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby="modal-address-editLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <form class="send-ajax form-horizontal my-4" id="send-ajax" method="post" autocomplete="off">
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title address-edit">
                        <b class="text-white">Editar endereço:</b>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="ajax-alert"></div>
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label for="responsible">Responsável: <i class="text-danger">*</i></label>
                                <input type="text" class="form-control" name="responsible" id="responsible" required
                                    value="teste">
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label for="phone">Telefone: <i class="text-danger">*</i></label>
                                <input type="tel" class="form-control" name="phone" id="phone"
                                    data-inputmask="'mask':'99 9999-9999[9]'" required autocomplete="off">
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type" id="type" value="casa"
                                    required>
                                <label class="form-check-label" for="type">
                                    <i class="fas fa-home fa-fw"></i> Casa</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type" id="type2" value="trabalho"
                                    required>
                                <label class="form-check-label" for="type2">
                                    <i class="fas fa-briefcase fa-fw"></i> Trabalho</label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="main" name="main" value="1">
                                <label class="form-check-label" for="main">Endereço principal</label>
                            </div>
                        </div>
                        <hr>
                        <div class="col-sm-12 col-lg-3">
                            <div class="form-group">
                                <label for="zip">CEP: <i class="text-danger">*</i></label>
                                <input type="tel" class="form-control" name="zip" id="zip"
                                    data-inputmask="'mask':'99999-999'" required>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-9">
                            <div class="form-group">
                                <label for="address">Rua: <i class="text-danger">*</i></label>
                                <input type="text" class="form-control" name="address" id="address" required
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-3">
                            <div class="form-group">
                                <label for="number">Número: <i class="text-danger">*</i></label>
                                <input type="text" class="form-control" name="number" id="number" required>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-9">
                            <div class="form-group">
                                <label for="complement">Complemento:</label>
                                <input type="text" class="form-control" name="complement" id="complement">
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label for="district">Bairro: <i class="text-danger">*</i></label>
                                <input type="text" class="form-control" name="district" id="district" required>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label for="city">Cidade: <i class="text-danger">*</i></label>
                                <input type="text" class="form-control" name="city" id="city" required>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                                <label for="state">Estado <small>(Ex: SP)</small>: <i class="text-danger">*</i></label>
                                <input type="text" class="form-control" name="state" id="state" maxlength="2"
                                    data-inputmask="'mask':'AA'" required>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-9">
                            <div class="form-group">
                                <label for="information">Informação:</label>
                                <textarea class="form-control" name="information" id="information"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-success btn-icon-split btn-load">
                        <span class="icon text-white-50"><i class="fas fa-trash fa-fw"></i></span>
                        <span class="text">Salvar</span>
                    </button>
                    <button class="btn btn-sm btn-secondary btn-icon-split" data-dismiss="modal">
                        <span class="icon text-white-50"><i class="fas fa-ban fa-fw"></i></span>
                        <span class="text">Cancelar</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
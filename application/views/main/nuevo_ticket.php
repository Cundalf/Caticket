<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<main role="main" class="container animated fadeIn mb-5">
    <h3>Carga de ticket</h3>
    <hr />

    <?= validation_errors('<div class="alert alert-danger" role="alert">', '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'); ?>

    <? if (isset($error)) : ?>
        <div class="alert alert-danger" role="alert">
            <?= $error ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    <? endif; ?>

    <? if (isset($ok)) : ?>
        <div class="alert alert-success" role="alert">
            Se genero el ticket #<?= $ok ?>. <a href="<?= base_url("main/tickets?target=" . $ok ) ?>">Ver tickets</a>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    <? endif; ?>

    <?= form_open() ?>

    <input type="hidden" id="tokendata" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

    <div class="row">
        <div class="form-group col-lg-2 col-md-3 col-sm-4">
            <label for="dpFecha">Fecha<i class="text-danger">*</i></label>
            <input type="date" name="fecha" id="dpFecha" class="form-control form-control-sm" value="<?= ($fecha != "" ? $fecha : date('Y-m-d')) ?>">
        </div>

        <div class="form-group col-lg-2 col-md-3 col-sm-4">
            <label for="tmrHora">Hora<i class="text-danger">*</i></label>
            <input type="time" name="hora" id="tmrHora" class="form-control form-control-sm" value="<?= ($hora != "" ? $hora : date('H:i')) ?>">
        </div>

        <div class="form-group col-lg-2 col-md-3 col-sm-4">
            <label for="cboSede">Sede<i class="text-danger">*</i></label>
            <select name="sede" id="cboSede" class="form-control form-control-sm">
                <? if (isset($sedes)) : ?>
                    <? foreach ($sedes as $value) : ?>
                        <option value="<?= $value->id_sede ?>" <?= ($prioridad == $value->id_sede ? "selected" : "") ?>>
                            <?= ucfirst(strtolower($value->descripcion)) ?>
                        </option>
                    <? endforeach ?>
                <? endif ?>
            </select>
        </div>

        <div class="form-group col-lg-2 col-md-3 col-sm-6">
            <label for="cboPrioridad">Prioridad<i class="text-danger">*</i></label>
            <select name="prioridad" id="cboPrioridad" class="form-control form-control-sm">
                <? if (isset($prioridades)) : ?>
                    <? foreach ($prioridades as $value) : ?>
                        <option value="<?= $value->id_prioridad ?>" <?= ($prioridad == $value->id_prioridad ? "selected" : "") ?>>
                            <?= ucfirst(strtolower($value->descripcion)) ?>
                        </option>
                    <? endforeach ?>
                <? endif ?>
            </select>
        </div>

        <div class="form-group col-lg-4 col-sm-6">
            <label for="cboResponsable">Responsable<i class="text-danger">*</i></label>
            <select name="responsable" id="cboResponsable" class="form-control form-control-sm">
                <? if (isset($usuarios)) : ?>
                    <? foreach ($usuarios as $value) : ?>
                        <option value="<?= $value->id_usuario ?>" 
                            <?= ($responsable == $value->id_usuario ? "selected" : 
                                ($value->id_usuario == $this->session->userdata('id') ? "selected" : "") 
                            ) ?>
                        >
                            <?= $value->nombre ?>
                        </option>
                    <? endforeach ?>
                <? endif ?>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-3 col-sm-6">
            <label for="cboTipo">Tipo<i class="text-danger">*</i></label>
            <select name="tipo" id="cboTipo" class="form-control form-control-sm">
                <? if (isset($tipos)) : ?>
                    <? foreach ($tipos as $value) : ?>
                        <option value="<?= $value->id_tipo ?>" <?= ($tipo == $value->id_tipo ? "selected" : "") ?>>
                            <?= $value->descripcion ?>
                        </option>
                    <? endforeach ?>
                <? endif ?>
            </select>
        </div>

        <div class="form-group col-md-3 col-sm-6">
            <label for="cboEquipo">Equipo<i class="text-danger">*</i></label>
            <select name="equipo" id="cboEquipo" class="form-control form-control-sm">
                <? if (isset($equipos)) : ?>
                    <? foreach ($equipos as $value) : ?>
                        <option value="<?= $value->id_equipo ?>" <?= ($equipo == $value->id_equipo ? "selected" : "") ?>>
                            <?= $value->descripcion ?>
                        </option>
                    <? endforeach ?>
                <? endif ?>
            </select>
        </div>

        <div class="form-group col-md-3 col-sm-6">
            <label for="cboCategoria">Categoria<i class="text-danger">*</i></label>
            <select name="categoria" id="cboCategoria" class="form-control form-control-sm">
                <? if (isset($categorias)) : ?>
                    <? foreach ($categorias as $value) : ?>
                        <option value="<?= $value->id_categoria ?>" <?= ($categoria == $value->id_categoria ? "selected" : "") ?>>
                            <?= $value->descripcion ?>
                        </option>
                    <? endforeach ?>
                <? endif ?>
            </select>
        </div>

        <div class="form-group col-md-3 col-sm-6">
            <label for="cboSector">Sector<i class="text-danger">*</i></label>
            <select name="sector" id="cboSector" class="form-control form-control-sm">
                <? if (isset($sectores)) : ?>
                    <? foreach ($sectores as $value) : ?>
                        <option value="<?= $value->id_sector ?>" <?= ($sector == $value->id_sector ? "selected" : "") ?>>
                            <?= $value->descripcion ?>
                        </option>
                    <? endforeach ?>
                <? endif ?>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-sm-12">
            <label for="txtSolicitante">Solicitante<i class="text-danger">*</i></label>
            <input type="text" name="solicitante" id="txtSolicitante" class="form-control form-control-sm" aria-describedby="helpSolicitante" value="<?= $solicitante ?>">
        </div>
    </div>

    <div class="row">
        <div class="form-group col-sm-12">
            <label for="txtDescripcion">Descripcion<i class="text-danger">*</i></label>
            <input type="text" name="descripcion" id="txtDescripcion" class="form-control form-control-sm" aria-describedby="helpDescripcion" value="<?= $descripcion ?>">
            <small id="helpDescripcion" class="text-muted">Solo se permite un maximo de 255 caracteres.</small>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-sm-4">
            <label for="txtInterno">Interno</label>
            <input type="text" name="interno" id="txtInterno" class="form-control form-control-sm" value="<?= $interno ?>">
        </div>

        <div class="form-group col-sm-4">
            <label for="txtTerminal">Terminal</label>
            <input type="text" name="terminal" id="txtTerminal" class="form-control form-control-sm" value="<?= $terminal ?>">
        </div>

        <div class="form-group col-sm-4">
            <label for="txtEmail">Email</label>
            <input type="email" name="email" id="txtEmail" class="form-control form-control-sm" value="<?= $email ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <p class="text-muted"><i class="text-danger">*</i> Campos obligatorios</p>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <button type="submit" class="btn btn-danger btn-sm float-right">Guardar</button>
        </div>
    </div>
    </form>
</main>
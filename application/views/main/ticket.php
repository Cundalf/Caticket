<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<main role="main" class="container animated fadeIn mb-5">
    <input id="txtID" type="hidden" value="<?= $id ?>">

    <div class="row">
        <h3 class="col-sm-4 mb-0">Ticket #<?= $id ?></h3>

        <div class="mb-2 col-xs-12 d-block d-sm-none">&nbsp;</div>

        <? if($ticket->estado == 1): ?>
            <div class="col-sm-8 mb-0">
                <button type="button" class="btn btn-danger btn-sm float-right ml-1" id="btnGuardar">Guardar Cambios</button>
                <button type="button" class="btn btn-primary btn-sm float-right ml-1" id="btnCerrar">Cerrar Ticket</button>
                <!--button type="button" class="btn btn-secondary btn-sm float-right ml-1">Anular Ticket</button-->
            </div>
        <? endif; ?>
    </div>
    <hr />

    <div class="row">
        <div class="form-group col-lg-2 col-md-3 col-sm-4">
            <label for="dpFecha">Fecha</label>
            <input type="date" id="dpFecha" class="form-control form-control-sm" value="<?= $ticket->fecha ?>" readonly>
        </div>

        <div class="form-group col-lg-2 col-md-3 col-sm-4">
            <label for="tmrHora">Hora</label>
            <input type="time" id="tmrHora" class="form-control form-control-sm" value="<?= $ticket->hora ?>" readonly>
        </div>

        <div class="form-group col-lg-2 col-md-3 col-sm-4">
            <label for="txtPrioridad">Sede</label>
            <input type="text" id="txtSede" class="form-control form-control-sm" value="<?= $ticket->sede_descripcion ?>" readonly>
        </div>

        <div class="form-group col-lg-2 col-md-3 col-sm-4">
            <label for="txtPrioridad">Prioridad</label>
            <input type="text" id="txtPrioridad" class="form-control form-control-sm" value="<?= $ticket->prioridad_descripcion ?>" readonly>
        </div>

        <div class="form-group col-lg-4 col-sm-6">
            <label for="cboResponsable">Responsable<i class="text-danger">*</i></label>
            <select id="cboResponsable" class="form-control form-control-sm">
                <? if (isset($usuarios)) : ?>
                    <? foreach ($usuarios as $value) : ?>
                        <option value="<?= $value->id_usuario ?>" <?= ($ticket->responsable == $value->id_usuario ? "selected" : "") ?>>
                            <?= $value->nombre ?>
                        </option>
                    <? endforeach ?>
                <? endif ?>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-3 col-sm-6">
            <label for="txtTipo">Tipo</label>
            <input type="text" id="txtTipo" class="form-control form-control-sm" value="<?= $ticket->tipo_descripcion ?>" readonly>
        </div>

        <div class="form-group col-md-3 col-sm-6">
            <label for="txtEquipo">Equipo</label>
            <input type="text" id="txtEquipo" class="form-control form-control-sm" value="<?= $ticket->equipo_descripcion ?>" readonly>
        </div>

        <div class="form-group col-md-3 col-sm-6">
            <label for="txtCategoria">Categoria</label>
            <input type="text" id="txtCategoria" class="form-control form-control-sm" value="<?= $ticket->categoria_descripcion ?>" readonly>
        </div>

        <div class="form-group col-md-3 col-sm-6">
            <label for="txtCategoria">Sector</label>
            <input type="text" id="txtSector" class="form-control form-control-sm" value="<?= $ticket->sector_descripcion ?>" readonly>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-sm-12">
            <label for="txtSolicitante">Solicitante</label>
            <input type="text" id="txtSolicitante" class="form-control form-control-sm" aria-describedby="helpSolicitante" value="<?= $ticket->solicitante ?>" readonly>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-sm-12">
            <label for="txtDescripcion">Descripcion<i class="text-danger">*</i></label>
            <input type="text" id="txtDescripcion" class="form-control form-control-sm" aria-describedby="helpDescripcion" value="<?= $ticket->descripcion ?>" readonly>
            <small id="helpDescripcion" class="text-muted">Solo se permite un maximo de 255 caracteres.</small>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-sm-4">
            <label for="txtInterno">Interno</label>
            <input type="text" id="txtInterno" class="form-control form-control-sm" value="<?= $ticket->interno ?>">
        </div>

        <div class="form-group col-sm-4">
            <label for="txtTerminal">Terminal</label>
            <input type="text" id="txtTerminal" class="form-control form-control-sm" value="<?= $ticket->terminal ?>">
        </div>

        <div class="form-group col-sm-4">
            <label for="txtEmail">Email</label>
            <input type="email" id="txtEmail" class="form-control form-control-sm" value="<?= $ticket->email ?>">
        </div>
    </div>

    <hr />

    <div class="row">
        <div class="form-group col-sm-6">
            <label for="txtObservacion">Observacion<i class="text-danger">*</i></label>
            <input type="text" id="txtObservacion" class="form-control form-control-sm" value="">
        </div>

        <div class="col-sm-6 pl-0">
            <i id="btnAgregarObs" class="fas fa-plus-circle text-success pointer" style="font-size: 30px; padding-top: 32px;"></i>
        </div>
    </div>

    <table class="table table-hover table-striped table-sm" id="observaciones-table">
        <thead class="thead-dark">
            <tr>
                <th class="text-nowrap" scope="col">#</th>
                <th class="text-nowrap" scope="col">Fecha</th>
                <th scope="col">Observacion</th>
                <th class="text-nowrap" scope="col">Usuario</th>
            </tr>
        </thead>
        <tbody class="pointer">
            <? foreach ($observaciones as $value) : ?>
                <tr>
                    <th class="text-nowrap" scope="row"><?= $value->id_observacion ?></th>
                    <td class="text-nowrap"><?= $value->fecha ?></td>
                    <td><?= $value->observacion ?></td>
                    <td class="text-nowrap"><?= $ticket->creador ?></td>
                </tr>
            <? endforeach; ?>
        </tbody>
    </table>

    <div class="row">
        <div class="col-sm-12">
            <p class="text-muted"><i class="text-danger">*</i> Campos obligatorios</p>
        </div>
    </div>

</main>
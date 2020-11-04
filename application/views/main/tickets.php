<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<main role="main" class="container-fluid animated fadeIn mb-5">
    <div class="row">
        <div class="col-sm-12 mb-5">
            <h3>Tickets</h3>
            <hr />

            <form action="<?= base_url("main/tickets") ?>" method="GET">
                <div class="row">
                    <div class="form-group col-sm-2">
                        <label for="dpFecha">Fecha Desde</label>
                        <input type="date" name="desde" id="dpFechaDesde" class="form-control form-control-sm" value="<?= ($desde == "" ? Date("Y-m-d") : $desde) ?>">
                    </div>

                    <div class="form-group col-sm-2">
                        <label for="dpFecha">Fecha Hasta</label>
                        <input type="date" name="hasta" id="dpFechaHasta" class="form-control form-control-sm" value="<?= ($hasta == "" ? Date("Y-m-d") : $hasta) ?>">
                    </div>

                    <div class="form-group col-sm-2">
                        <label for="cboEstado">Estado</label>
                        <select name="estado" id="cboEstado" class="form-control form-control-sm">
                            <? if (isset($estados)) : ?>
                                <option value="0">Todos</option>
                                <? foreach ($estados as $value) : ?>
                                    <option value="<?= $value->id_estado ?>" <?= ($prioridad == $value->id_estado ? "selected" : "") ?>>
                                        <?= ucfirst(strtolower($value->descripcion)) ?>
                                    </option>
                                <? endforeach ?>
                            <? endif ?>
                        </select>
                    </div>

                    <div class="form-group col-sm-2">
                        <label for="cboPrioridad">Prioridad<i class="text-danger">*</i></label>
                        <select name="prioridad" id="cboPrioridad" class="form-control form-control-sm">
                            <? if (isset($prioridades)) : ?>
                                <option value="0">Todas</option>
                                <? foreach ($prioridades as $value) : ?>
                                    <option value="<?= $value->id_prioridad ?>" <?= ($prioridad == $value->id_prioridad ? "selected" : "") ?>>
                                        <?= ucfirst(strtolower($value->descripcion)) ?>
                                    </option>
                                <? endforeach ?>
                            <? endif ?>
                        </select>
                    </div>

                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-sm btn-danger" style="margin-top: 33px">Filtrar</button>
                        <button type="button" id="btnExportar" class="btn btn-sm btn-outline-success float-right" style="margin-top: 33px">Exportar</button>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover table-striped table-sm" id="tickets-table">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-nowrap" scope="col">#</th>
                            <th class="text-nowrap" scope="col">Fecha</th>
                            <th scope="col">Descripcion</th>
                            <th class="text-nowrap" scope="col">Creador</th>
                            <th class="text-nowrap" scope="col">Responsable</th>
                            <th class="text-nowrap" scope="col">Estado</th>
                            <th class="text-nowrap" scope="col">Prioridad</th>
                            <th class="text-nowrap" scope="col">Fecha Resolucion</th>
                            <th class="text-nowrap" scope="col"></th>
                        </tr>
                    </thead>
                    <tbody class="pointer">
                        <? foreach ($tickets as $ticket) : ?>
                            <tr class="<?= ($ticket->id_ticket == $target ? "table-danger" : "") ?>">
                                <th class="text-nowrap" scope="row" name="id"><?= $ticket->id_ticket ?></th>
                                <td class="text-nowrap"><?= $ticket->fecha . " - " . $ticket->hora ?></td>
                                <td><?= $ticket->descripcion ?></td>
                                <td class="text-nowrap"><?= $ticket->creador_nombre ?></td>
                                <td class="text-nowrap"><?= $ticket->responsable_nombre ?></td>
                                <td class="text-nowrap"><?= $ticket->estado_descripcion ?></td>
                                <td class="text-nowrap"><?= $ticket->prioridad_descripcion ?></td>
                                <td class="text-nowrap"><?= $ticket->fecha_resolucion ?></td>
                                <td class="text-nowrap"><i class="fas fa-chevron-right"></i></td>
                            </tr>
                        <? endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
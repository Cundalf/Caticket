<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<main role="main" class="container animated fadeIn mb-5">
    <div class="row">
        <div class="col-sm-9 mb-5">
            <h3>Tickets</h3>
            <hr />

            <table class="table table-hover table-striped table-sm" id="tickets-table">
                <thead class="thead-dark">
                    <tr>
                        <th class="nowrap" scope="col">#</th>
                        <th class="nowrap" scope="col">Fecha</th>
                        <th scope="col">Descripcion</th>
                        <th class="nowrap" scope="col">Prioridad</th>
                        <th class="nowrap" scope="col">Creador</th>
                        <th class="nowrap" scope="col"></th>
                    </tr>
                </thead>
                <tbody class="pointer">
                    <? foreach ($tickets as $ticket) : ?>
                        <tr>
                            <th class="nowrap" scope="row" name="id"><?= $ticket->id_ticket ?></th>
                            <td class="nowrap">
                                <?= Date("d/m", strtotime($ticket->fecha)) . " - " . Date("H:i", strtotime($ticket->hora)) ?>
                            </td>
                            <td><?= $ticket->descripcion ?></td>
                            <td class="nowrap">
                                <?
                                $badgeCss = "badge-primary";
                                switch ($ticket->id_prioridad) {
                                    case 1:
                                        $badgeCss = "badge-success";
                                        break;
                                    case 2:
                                        $badgeCss = "badge-warning";
                                        break;
                                    case 3:
                                        $badgeCss = "badge-danger";
                                        break;
                                    case 4:
                                        $badgeCss = "badge-danger";
                                        break;
                                }
                                ?>
                                <span class="badge <?= $badgeCss ?>">
                                    <?= $ticket->prioridad ?>
                                    <? if ($ticket->id_prioridad == 4) : ?>
                                        <i class="fas fa-exclamation-triangle text-warning"></i>
                                    <? endif; ?>
                                </span>
                            </td>
                            <td class="nowrap"><?= $ticket->usuario ?></td>
                            <td class="nowrap"><i class="fas fa-chevron-right"></i></td>
                        </tr>
                    <? endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="col-sm-3">
            <div class="row mb-5">
                <div class="col-sm-12">
                    <h4>Notas</h4>
                    <hr />

                    <div class="form-group">
                        <textarea class="form-control form-control-notes" id="txtNota" rows="3"><?= (isset($nota[0]->nota) ? $nota[0]->nota : "") ?></textarea>
                    </div>

                    <button type="button" class="btn btn-danger btn-sm btn-block" id="btnGuardar">Guardar</button>
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-sm-12">
                    <h4>Estadisticas</h4>
                    <hr />

                    <table class="table table-hover table-striped table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Dato</th>
                                <th scope="col">Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            <? foreach ($estadisticas as $value) : ?>
                                <tr>
                                    <td><?= $value->descripcion ?></td>
                                    <td><?= $value->cantidad ?></td>
                                </tr>
                            <? endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
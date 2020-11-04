$(document).ready(function ()
{
    $('#btnGuardar').on('click', function ()
    {
        var tokenname = $("#tokendata").attr('name');
        var tokenval = $("#tokendata").val();
        var obj = {};
        obj[tokenname] = tokenval;
        obj.id = $("#txtID").val();
        obj.responsable = $("#cboResponsable").val();
        obj.interno = $("#txtInterno").val();
        obj.terminal = $("#txtTerminal").val();
        obj.email = $("#txtEmail").val();

        $('body').block({
            message: '<div class="spinner-border text-danger" role="status">Procesando...</div >'
        });
 
        $.ajax({
            url: $('head base').attr('href') + "Main/UpdateTicket/",
            method: "POST",
            cache: false,
            dataType: "json",
            data: obj
        }).done(function (data) {
            $("#tokendata").val(data.csrfhash);
            $('body').unblock();
            
            if (data.length == 0) {
                Swal.fire('Error', 'No fue posible grabar los datos.', 'error');
                return;
            }

            if (data.ban == 1)
            {
                Swal.fire('Listo', 'Se han guardado los datos correctamente.', 'success');
            }
            else
            {
                Swal.fire('Error', 'No fue posible grabar los datos.', 'error');
            }

        }).fail(function () {
            Swal.fire('Error!', 'Se produjo un error interno.', 'error');
            $('body').unblock();
        });
    });
    
    $('#btnCerrar').on('click', function () {
        var tokenname = $("#tokendata").attr('name');
        var tokenval = $("#tokendata").val();
        var obj = {};
        obj[tokenname] = tokenval;
        obj.id = $("#txtID").val();
        
        $('body').block({
            message: '<div class="spinner-border text-danger" role="status">Procesando...</div >'
        });

        Swal.fire({
            title: 'Ingrese la resolucion',
            input: 'textarea',
            showCancelButton: true,
            confirmButtonText: 'Cerrar Ticket',
        }).then((result) => {
            $('body').unblock();
            if (typeof result.value == 'undefined') return;
            
            if (result.value.trim() == '')
            {
                Swal.fire('Atencion!', 'La resolucion es obligatoria.', 'warning');
                return;
            }
            obj.resolucion = result.value;
            
            $.ajax({
                url: $('head base').attr('href') + "Main/CerrarTicket/",
                method: "POST",
                cache: false,
                dataType: "json",
                data: obj
            }).done(function (data) {
                $("#tokendata").val(data.csrfhash);
                $('body').unblock();
                
                if (data.length == 0)
                {
                    Swal.fire('Error', 'No fue posible grabar los datos.', 'error');
                    return;
                }

                if (data.ban == 1)
                {
                    Swal.fire('Listo', 'Se han guardado los datos correctamente.', 'success').then((result) => {
                        location.replace($('head base').attr('href')); 
                    });
                }
                else
                {
                    Swal.fire('Error', 'No fue posible grabar los datos.', 'error');
                }

            }).fail(function () {
                $('body').unblock();
                Swal.fire('Error!', 'Se produjo un error interno.', 'error');
            });
        });
    });
    
    $('#btnAgregarObs').on('click', function ()
    {
        var tokenname = $("#tokendata").attr('name');
        var tokenval = $("#tokendata").val();
        var obj = {};
        obj[tokenname] = tokenval;
        obj.id = $("#txtID").val();
        obj.observacion = $("#txtObservacion").val();
        $("#txtObservacion").prop("disabled", true);

        $.ajax({
            url: $('head base').attr('href') + "Main/SetObservacion/",
            method: "POST",
            cache: false,
            dataType: "json",
            data: obj
        }).done(function (data)
        {
            $("#tokendata").val(data.csrfhash);
            $("#txtObservacion").prop("disabled", false);
            
            if(data.length == 0)
            {
                Swal.fire('Error', 'No fue posible grabar la observacion.', 'error');
                return;
            }

            $("#txtObservacion").val("");
            
            var html = '<tr>';
            html += '<th>' + data[0].id_observacion +'</th>';
            html += '<td>'+ data[0].fecha +'</td>';
            html += '<td>' + data[0].observacion +'</td>';
            html += '<td>' + data[0].creador +'</td>';
            html += '</tr>';
            
            $("#observaciones-table tbody").append(html);

        }).fail(function ()
        {
            $("#txtObservacion").prop("disabled", false);
            Swal.fire('Error!', 'Se produjo un error interno.', 'error');
        });
    });
});
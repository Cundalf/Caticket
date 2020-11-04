$(document).ready(function() {
    $('#btnGuardar').on('click', function () {

        var tokenname = $("#tokendata").attr('name');
        var tokenval = $("#tokendata").val();
        var obj = {};
        obj[tokenname] = tokenval;
        obj.nota = $("#txtNota").val();
        $("#txtNota").prop("disabled", true);

        $.ajax({
            url: $('head base').attr('href') + "Main/SetNota/",
            method: "POST",
            cache: false,
            dataType: "json",
            data: obj
        }).done(function (data) {
            $("#tokendata").val(data.csrfhash);
            $("#txtNota").prop("disabled", false);
            
            if(data.ban != 1)
            {
                Swal.fire('Error!', 'No se pudo grabar la nota.', 'error');
            }
            else
            {
                Swal.fire('Listo', 'Se guardo la nota correctamente.', 'success');
            }
        }).fail(function (){
            $("#txtNota").prop("disabled", false);
            Swal.fire('Error!', 'No se pudo grabar la nota.', 'error');
        });
    });

    $("#tickets-table tbody tr").on("click", function(){
        var id = $(this).find('th[name="id"]').text();

        if(id == "") return;

        window.location.replace($('head base').attr('href') + "Main/Ticket/" + id);
    });
});
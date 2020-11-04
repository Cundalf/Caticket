$(document).ready(function () {
    $("#tickets-table tbody tr").on("click", function () {
        var id = $(this).find('th[name="id"]').text();

        if (id == "") return;

        window.location.replace($('head base').attr('href') + "Main/Ticket/" + id);
    });
    
    $("#btnExportar").on("click", function () {
        var desde = $("#dpFechaDesde").val();
        var hasta = $("#dpFechaHasta").val();
        var estado = $("#cboEstado").val();
        var prioridad = $("#cboPrioridad").val();
        
        var url = $('head base').attr('href') + "Main/Exportar_tickets";
        url += "?desde=" + desde + "&hasta=" + hasta + "&estado=" + estado + "&prioridad=" + prioridad;

        window.open(url, "_blank");
    });
});
$(document).ready(function(){
    $(".veen .rgstr-btn button").click(function(){
        $('.veen .wrapper').addClass('move');
        $('.body').css('background','#e0b722');
        $(".veen .login-btn button").removeClass('active');
        $(this).addClass('active');

    });
    $(".veen .login-btn button").click(function(){
        $('.veen .wrapper').removeClass('move');
        $('.body').css('background','#ff4931');
        $(".veen .rgstr-btn button").removeClass('active');
        $(this).addClass('active');
    });
});

function ingreso(t){
    document.getElementById("venflo").style.height = "0px";
    document.getElementById("login1").style.display = "none";
    document.getElementById("olv1").style.display = "none";
    document.getElementById("register1").style.display = "none";
    if(t==1){
        document.getElementById("venflo").style.height = "267px";
        document.getElementById("login1").style.display = "inherit";
    }else if(t==2){
        document.getElementById("venflo").style.height = "0px";
        /* document.getElementById("register1").style.display = "inherit"; */
    }else if(t==3){
        document.getElementById("venflo").style.height = "240px";
        document.getElementById("olv1").style.display = "inherit";
    }
}

$(document).ready(function() {    
    $('#mytpag').DataTable({
    //para cambiar el lenguaje a español
        "language": {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast":"Último",
                    "sNext":"Siguiente",
                    "sPrevious": "Anterior"
                 },
                 "sProcessing":"Procesando...",
            },
        "order": [[ 0, "desc" ]],
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copyHtml5',
                    text:   '<i class="fa-solid fa-copy fa-2x"></i> ',
                    titleAttr: 'Copiar',
                    className: 'btn'
                },
                {
                    extend: 'csvHtml5',
                    text:   '<i class="fa-solid fa-file-csv fa-2x"></i> ',
                    titleAttr: 'Exportar a CSV',
                    className: 'btn'
                },
                {
                    extend: 'excelHtml5',
                    text:   '<i class="fa-solid fa-file-excel fa-2x"></i> ',
                    titleAttr: 'Exportar a Excel',
                    className: 'btn'
                },
                // {
                //     extend: 'pdfHtml5',
                //     text:   '<i class="fa-solid fa-file-pdf fa-2x"></i> ',
                //     titleAttr: 'Exportar a PDF',
                //     className: 'btn'
                // }
            ]
    });
});

$(document).ready(function() {    
    $('#myt').DataTable({
    //para cambiar el lenguaje a español
        "language": {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast":"Último",
                    "sNext":"Siguiente",
                    "sPrevious": "Anterior"
                 },
                 "sProcessing":"Procesando...",
            },
        "order": [[ 0, "desc" ]],
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copyHtml5',
                    text:   '<i class="fa-solid fa-copy fa-2x"></i> ',
                    titleAttr: 'Copiar',
                    className: 'btn'
                },
                {
                    extend: 'csvHtml5',
                    text:   '<i class="fa-solid fa-file-csv fa-2x"></i> ',
                    titleAttr: 'Exportar a CSV',
                    className: 'btn'
                },
                {
                    extend: 'excelHtml5',
                    text:   '<i class="fa-solid fa-file-excel fa-2x"></i> ',
                    titleAttr: 'Exportar a Excel',
                    className: 'btn'
                },
                {
                    extend: 'pdfHtml5',
                    text:   '<i class="fa-solid fa-file-pdf fa-2x"></i> ',
                    titleAttr: 'Exportar a PDF',
                    className: 'btn'
                }
            ]
    });
});


$(document).ready(function() {    
    $('#myt2').DataTable({
    //para cambiar el lenguaje a español
        "language": {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast":"Último",
                    "sNext":"Siguiente",
                    "sPrevious": "Anterior"
                 },
                 "sProcessing":"Procesando...",
            },
        "order": [[ 0, "desc" ]],
            dom: 'Bfrtip'
    });
});


$(document).ready(function() {    
    $('#myta').DataTable({
    //para cambiar el lenguaje a español
        "language": {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast":"Último",
                    "sNext":"Siguiente",
                    "sPrevious": "Anterior"
                 },
                 "sProcessing":"Procesando...",
            },
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copyHtml5',
                    text:   '<i class="fa-solid fa-copy fa-2x"></i> ',
                    titleAttr: 'Copiar',
                    className: 'btn'
                },
                {
                    extend: 'csvHtml5',
                    text:   '<i class="fa-solid fa-file-csv fa-2x"></i> ',
                    titleAttr: 'Exportar a Excel',
                    className: 'btn'
                },
                {
                    extend: 'excelHtml5',
                    text:   '<i class="fa-solid fa-file-excel fa-2x"></i> ',
                    titleAttr: 'Exportar a Excel',
                    className: 'btn'
                },
                {
                    extend: 'pdfHtml5',
                    text:   '<i class="fa-solid fa-file-pdf fa-2x"></i> ',
                    titleAttr: 'Exportar a Excel',
                    className: 'btn'
                }
            ]
    });
});

function eli(){
    let v = confirm("¿Está seguro de eliminar este registro?");
    return v;
}

function eliusu(){
    let v = confirm("Se va a eliminar todo registro relacionado con este usuario, en agendas y minutas. Después de eliminar no se puede recuperar la información. ¿Está seguro de eliminar este registro?");
    return v;
}

function verf(){
    let v = confirm("Va a agregar una nueva agenda, tenga en cuenta que si existen agendas ya registradas de este usuario dentro de las fechas seleccionadas, se eliminarán estos registros.\n\n¿Está seguro de agregar este registro?");
    return v;
}

function verfs(){
    let v = confirm("Va a asignar una nueva agenda a todos los usuarios, tenga en cuenta que si existen agendas ya registradas para estos usuarios dentro de las fechas seleccionadas, se eliminarán estos registros.\n\n¿Está seguro de asignar esta agenda?");
    return v;
}

function ocultar(ocu){
    document.getElementById('ocultar').style.display = ocu;
    if(ocu=="none"){
        document.getElementById('mos').style.display = "inline-block";
        document.getElementById('cer').style.display = "none";
    }else{
        document.getElementById('mos').style.display = "none";
        document.getElementById('cer').style.display = "inline-block";
    }
}

function actBusc() {
    var search = prompt("Termino de busqueda:");
    if (search == null || search == "") {
        // alert("User cancelled");
    } else {
        find(search)
    }
   
}

document.addEventListener('DOMContentLoaded', function () {
    var home = document.querySelector('.home');
    var btnmod = home.querySelectorAll('.btnmod');
    if (btnmod.length === 1) home.style.gridTemplateColumns = '1fr';
    else if (btnmod.length === 2) home.style.gridTemplateColumns = '1fr 1fr';
});

function err(mess=""){
    if(mess){
        mess = "<strong>Error:</strong> ¡"+mess+"!";
        document.getElementById("err").innerHTML = mess;
        document.getElementById("err").style.display = "inline-block";
    }else{
        document.getElementById("err").innerHTML = "";
        document.getElementById("err").style.display = "none";
    }
}
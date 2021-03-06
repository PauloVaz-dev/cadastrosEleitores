var gridDebitostable;
var fornecedorNome;
var valor_debito;
var numero_cobranca;
var id_debito; //id do debito

function template(d){
    console.log(d);
    //Retirar os "&quot" da array aditivos
    //var aditivos = JSON.parse(d.aditivos.replace(/&quot;/g,'"'))

    var html = "<table class='table table-bordered'>";
    html += "<thead>" +
        "<tr><td>Profile</td><td>Grupo</td></tr>" +
        "</thead>";



    html += "<tr>";
    html += "<td>"  + d.profile + "</td>";
    html += "<td>"  + d.grupo + "</td>";

    html += "</tr>"

    html += "</table>";

    return  html;
}

var table = $('#cliente').DataTable({
    "stateSave": false,
    "dom": 'lCfrtip',
    "order": [],
    "colVis": {
        "buttonText": "Colunas",
        "overlayFade": 0,
        "align": "right"
    },
    "searching": false,
    "bLengthChange": false,
    processing: true,
    serverSide: true,
    bFilter: true,
    order: [[ 0, "desc" ]],
    ajax: {
        url: "/index.php/cliente/grid",
        data: function (d) {
            d.name = $('input[name=name]').val();
            d.bairro_id = $('select[name=bairro_id] option:selected').val();

        }
    },
    columns: [
        {data: 'id', name: 'id', targets: 0, visible: false},
        {data: 'name', name: 'clientes.name'},
        {data: 'phone01', name: 'clientes.phone01', targets: 0, visible: true},
        {data: 'bairro', name: 'bairro', visible: true},
        {data: '.colegio_eleitoral', name: 'clientes.colegio_eleitoral', visible: true},
        {data: 'action', name: 'action', orderable: false, searchable: false, width: '60px'}
    ],
    "fnDrawCallback": function( oSettings ) {
        //if ( data.DT_RowAttr ) $.each( data.DT_RowAttr, function( key, value ) {
          //  $(tr).attr( key, value );
        //});
        $('tbody tr').each( function() {

          //  this.setAttribute( 'title', '<span data-toggle="tooltip" title="ssss"</span>' );
        } );
        /* Apply the tooltips */
        table.$('span').tooltip( {
           // placement : 'top',
            html : true } );
    }
});

// Add event listener for opening and closing details
$('#cliente tbody').on('click', 'td.details-control', function () {
    var tr = $(this).closest('tr');
    var row = table.row( tr );

    if ( row.child.isShown() ) {
        // This row is already open - close it
        row.child.hide();
        tr.removeClass('shown');
    }
    else {
        // Open this row
        row.child( template(row.data()) ).show();
        tr.addClass('shown');
    }
});

$( "#localizar" ).click(function() {
    //console.log(document.getElementById("integrador").value);
    table.draw();
});

$( "#limpar" ).click(function() {
    $('input[name=nome]').val("");
    $('input[name=data_cadadastro_ini]').val("");
    $('input[name=data_cadadastro_fim]').val("");
});

var mascara = function (val) {
    return $('val.cpf_cnpj').mask('00.000.000/0000-00')
}

$('.cpf').mask('000.000.000-00', {reverse: true});
$('.cnpj').mask('00.000.000/0000-00', {reverse: true});
var cpfMascara = function (val) {
        return val.replace(/\D/g, '').length > 11 ? '00.000.000/0000-00' : '000.000.000-009';
    },
    cpfOptions = {
        onKeyPress: function(val, e, field, options) {
            field.mask(cpfMascara.apply({}, arguments), options);
        }
    };
$('.mascara-cpfcnpj').mask(cpfMascara, cpfOptions);


/* Abrir Modal de Clientes */
var report = document.getElementById('report_id');

report.addEventListener('change', function (ev) {
    modalName = this.options[this.selectedIndex].value;
    if(modalName){
        console.log(modalName);
        $('#' + modalName).modal();
    }
})

/* Fim Abrir Modal de Clientes */

/*  Modal */
function formModalRelatorio() {
    console.log("www");
    //$('#formModalRelatorio').modal();
}


/*/!* Modal Projeto *!/
var reportCliente = document.getElementById('reportCliente');

reportCliente.addEventListener('click', function (ev) {
    var e = document.getElementById('ProjetoOrdenarPor')
    var ordenarPor = e.options[e.selectedIndex].value;


    //var t = document.getElementById('vistoriaOrder')
    //var order = t.options[t.selectedIndex].value;

    const selected = document.querySelectorAll('#projetoStatus option:checked');
    const status = Array.from(selected).map(el => el.value);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': document.getElementsByName("_token")[0].value
        }
    });
    var dados = {
        'order': order,
        'ordenarPor': ordenarPor
    }

    console.log(dados);

    var url = '/index.php/report/reportPdf?modalName=' + modalName + "&status=" + status + "&ordenar1=" +  ordenarPor;
    window.open(url, '_blank');
})*/







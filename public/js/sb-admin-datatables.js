$(document).ready(function() {
   var img='';
   var tbl=$('.total');
//    alert('hola');
//    var fecha_consulta='k';
//    var base64='{{ isset($inicio) ? $base64 : ""}}';
  $('.total').DataTable( {
    // "bLengthChange": false,
    // dom: 'lBfrtip lbf',
    
    dom: "<'row'<'col-12 col-sm-4'B><'col-sm-2'l><'col-12 col-sm-6'f>>",
    // dom: 'Bfrtip',
    buttons: [
        { 
            extend:    'excelHtml5',
            text:      '<i class="far fa-file-excel"></i>',
            titleAttr: 'Excel',
            messageTop:fecha_consulta,
            footer:    true 
        },
        { 
            extend:    'pdfHtml5', 
            text:      '<i class="far fa-file-pdf"></i>',
            titleAttr: 'PDF',
            orientation: 'landscape',
            customize: function(doc) {
                var colCount = new Array();
                $(tbl).find('tbody tr:first-child td').each(function(){
                    if($(this).attr('colspan')) for(var i=1;i<=$(this).attr('colspan');i++) colCount.push('*');
                    else colCount.push('*'); 
                });
                doc.content[1].table.widths = colCount;
                doc.content.splice(0, 1, {
                    columns: [
                        {
                            margin: [80,0,0,1],
                            image: base64,
                            width: 40,
                            height: 40,
                        },
                        [
                            {margin: [-50,0,0,10],text: 'Flujo de caja - '+nombre_empresa,fontSize: 16,bold: true,alignment:'center'},
                            {margin: [-50,0,0,30],text: fecha_consulta,fontSize: 12,alignment:'center'}
                        ],
                    ],

                });
              },
            footer:    true 
        },
        { 
            extend:    'print', 
            text:      '<i class="fas fa-print"></i>',
            titleAttr: 'Imprimir',
            // messageTop: '01-01-2019 al 03-01-2019',
            footer:    true,
            title:'',
            orientation: 'landscape',
            // autoPrint: true,
            customize: function ( win ) {
                $(win.document.body)
                    // .css( 'font-size', '10pt' )
                    .prepend(
                        '<div class=container>'+
                            '<div class=row>'+
                                '<div class=col-3  style="text-align:center">'+
                                    '<img src='+base64+' style="height:100px" />'+
                                '</div>'+
                                '<div class=col-6>'+
                                    '<h1 class=text-center>Flujo de caja - '+nombre_empresa+'</h1>'+
                                    '<h3 class=text-center>'+fecha_consulta+'</h3>'+
                                '</div>'+
                            '</div>'+
                        '</div><br>'
                    );

               /*  $(win.document.body).find( 'table' )
                    .addClass( 'compact' )
                    .css( 'font-size', 'inherit' ); */
            }
            // <img src="{{asset('img/pinocix.png')}}" alt="">
        }
    ],
    "bInfo": false,
    "ordering": false,
    language: {
        processing:     "Procesando...",
        search:         "Buscar:",
        lengthMenu:     "Mostrar _MENU_ Entradas",
        info:           "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        infoEmpty:      "Mostrando 0 a 0 de 0 Entradas",
        infoFiltered:   "(Filtrado de _MAX_ total entradas)",
        infoPostFix:    "",
        loadingRecords: "Cargando...",
        zeroRecords:    "Sin resultados encontrados",
        emptyTable:     "No hay información",
        paginate:{
            first:      "primero",
            previous:   "Anterior",
            next:       "Siguiente",
            last:       "Ultimo"
        },
        aria: {
            sortAscending:  ": Activar para ordenar la columna en orden ascendente",
            sortDescending: " Activar para ordenar la columna en orden descendente."
        },
    },
    //dar tamaño a las columnas
    columnDefs: [ 
        { "width": "100px", "targets": 1 },
        { "width": "100px", "targets": 4 }
    ],
  });

  $('.table.info').DataTable( {
    "bInfo": false,
    "ordering": false,
    language: {
        processing:     "Procesando...",
        search:         "Buscar:",
        lengthMenu:    "Mostrar _MENU_ Entradas",
        info:           "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        infoEmpty:      "Mostrando 0 a 0 de 0 Entradas",
        infoFiltered:   "(Filtrado de _MAX_ total entradas)",
        infoPostFix:    "",
        loadingRecords: "Cargando...",
        zeroRecords:    "Sin resultados encontrados",
        emptyTable:     "No hay información",
        paginate: {
            first:      "primero",
            previous:   "Anterior",
            next:       "Siguiente",
            last:       "Ultimo"
        },
        aria: {
            sortAscending:  ": Activar para ordenar la columna en orden ascendente",
            sortDescending: " Activar para ordenar la columna en orden descendente."
        },
    },
    //dar tamaño a las columnas
    /* columnDefs: [ 
        { "width": "10px", "targets":1 }
    ], */
  });
  
  /**
   * sumas de los totales de los reportes menos operaciones hoy 
   */
    var total = 0;
    $('.total').DataTable().rows().data().each(function(el, index){
        //Asumiendo que es la columna 5 de cada fila la que quieres agregar a la sumatoria
        
      /*   $('.concepto').each(function() {
            var text = $(this).text();
            text=text.replace(/\?/g," ");
            $(this).text(text);
            // console.log(text);
        }) */;

        var num=el[4];
        console.log(num);
        var num =num.replace(/\,/g,"");
        // total += parseInt(el[4]);
        total += parseInt(num);
    });
    $('#total').text(total);
    $('#total').number( true, 2 );

    total=0;
    /**
     * operaciones hoy :: suma 
     */
    $('#hoy').DataTable().rows().data().each(function(el, index){
        //Asumiendo que es la columna 5 de cada fila la que quieres agregar a la sumatoria
        
        // console.log('hola'+total);
        // var num=parseInt(el[4]);
        var num=el[4];
        var num =num.replace(/\,/g,"");
        var num=parseInt(num);
        if(el[5]=='Egreso' || el[5]=='Transferencia'){
            num=-num;
            total = total + num;
        }else{
            num=+num;
            total = total + num;
        }
        
    });
    $('#totalhoy').text(total);
    $('#totalhoy').number( true, 2 );


});



$(document).ready(function(){
    interaccion();
});

$("#tipo").change(function(){
    interaccion();  
    $('#razon').val('');
    $('#idrazon').val('');
});
function ocultar(){
    $('#divrazon').attr('hidden','hidden');
    $('#divnumdoc').attr('hidden','hidden');
    $('#divconcepto').attr('hidden','hidden');
    $('#divdescripcion').attr('hidden','hidden');
    $('#divtotal').attr('hidden','hidden');
    $('#divboton').attr('hidden','hidden');
    
    
}
function desocultar(){
    $('#divrazon').removeAttr('hidden');
    $('#divnumdoc').removeAttr('hidden');
    $('#divconcepto').removeAttr('hidden');
    $('#divdescripcion').removeAttr('hidden');
    $('#divtotal').removeAttr('hidden');
    $('#divboton').removeAttr('hidden');
}
function desocultar2(){
    $('#divrazon').removeAttr('hidden');
    $('#divnumdoc').removeAttr('hidden');
    $('#divconcepto').removeAttr('hidden');
    // $('#divdescripcion').removeAttr('hidden');
    $('#divtotal').removeAttr('hidden');
    $('#divboton').removeAttr('hidden');
}
function interaccion(){
    if($('#tipo').val()==''){
        ocultar();
    }
    if($('#tipo').val()=='Egreso' || $('#tipo').val()=='Transferencia'){
        ocultar();
        desocultar();
    }
    
    if($('#tipo').val()=='Ingreso' || $('#tipo').val()=='Deposito'){
        ocultar();
        desocultar2();
    }

}
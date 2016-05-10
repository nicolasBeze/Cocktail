$(document).ready(function() {

    $( "#buttonFormAdd" ).click(function() {

        if($('#formAdd').css('display') == 'none'){
            $('#formAdd').css("display","block");
        }else{
            $('#formAdd').css("display","none");
        }
    });
});
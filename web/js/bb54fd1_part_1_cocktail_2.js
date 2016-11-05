$(document).ready(function() {

    $( "#buttonFormAdd" ).click(function() {

        if($('#formAdd').css('display') == 'none'){
            $('#formAdd').css("display","block");
        }else{
            $('#formAdd').css("display","none");
        }
    });

    $( "#makeCocktail" ).click(function() {
        $.ajax({
            url: Routing.generate('makeCocktail', "cocktail="+$('#idCocktail').val()),
            type: 'GET',
            data: "cocktail="+$('#idCocktail').val(),
            success: function (data) {
                alert('ok');
            }
        })
    });
});
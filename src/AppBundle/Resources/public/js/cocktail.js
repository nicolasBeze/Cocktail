$(document).ready(function() {

    $( "#buttonFormAdd" ).click(function() {

        if($('#formAdd').css('display') == 'none'){
            $('#formAdd').css("display","block");
        }else{
            $('#formAdd').css("display","none");
        }
    });

    $( "#makeCocktail" ).click(function() {
        id = $('#idCocktail').val();
        $.ajax({
            url: Routing.generate('makeCocktail', {cocktail: id}),
            type: 'POST',
            success: function () {
                alert('cocktail terminée');
            }
        })
    });
});
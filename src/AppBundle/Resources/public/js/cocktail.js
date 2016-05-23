$(document).ready(function() {

    var dcpt;
    var timer;

    $( "#buttonFormAdd" ).click(function() {

        if($('#formAdd').css('display') == 'none'){
            $('#formAdd').css("display","block");
        }else{
            $('#formAdd').css("display","none");
        }
    });

    $( "#makeCocktail" ).click(function() {
        dcpt = 22;
        $('#compte_a_rebours').css("display", "block");
        timer = setInterval(function(){ decompte() }, 1000);
        id = $('#idCocktail').val();
        $.ajax({
            url: Routing.generate('makeCocktail', {cocktail: id}),
            type: 'POST',
            success: function () {
                alert('cocktail terminée');
            }
        });
        $('#compte_a_rebours').css("display", "none");
    });
    

    function decompte()
    {
        var affiche = '';

        if (dcpt > 1) {
            affiche = 'Cocktail prêt dans ' + dcpt + ' secondes';
        }
        else {
            affiche = 'Cocktail prêt dans ' + dcpt + ' seconde';
        }
        $("#compte_a_rebours").html(affiche);
        dcpt -= 1;
        if (dcpt < 0) {
            clearInterval(timer);
        }

    }

});
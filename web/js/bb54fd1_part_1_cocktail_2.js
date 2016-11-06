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
        dcpt = $('#time').val();

        $('#compte_a_rebours').css("display", "block").css("background-color","#204d74");
        timer = setInterval(function(){ decompte() }, 1000);

        id = $('#idCocktail').val();
        $.ajax({
            url: Routing.generate('makeCocktail', {cocktail: id}),
            type: 'POST',
            success: function (data) {
                if(data == "erreur"){
                    clearInterval(timer);
                    $('#compte_a_rebours').css("background-color","#741a17").html('Fait la queue, soiffard!');
                    $("#compte_a_rebours").delay(4000).fadeOut(500);
                }else{
                    $('#compte_a_rebours').css("background-color","#4cae4c").html('Cocktail terminé!');
                    $("#compte_a_rebours").delay(4000).fadeOut(500);
                }
            }
        });

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
        if (dcpt < 1) {
            clearInterval(timer);
        }

    }

});
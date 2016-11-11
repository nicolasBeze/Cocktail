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
                if (data.success) {
                    $('#compte_a_rebours').css("background-color","#4cae4c").html('Cocktail terminé!');
                    $("#compte_a_rebours").delay(4000).fadeOut(500);
                } else {
                    clearInterval(timer);
                    $('#compte_a_rebours').css("background-color","#741a17").html(data.message);
                    $("#compte_a_rebours").delay(4000).fadeOut(500);
                }
            }
        });
    });

    $(document).on('submit', '#makeCustomCocktailForm', function (e) {
        e.preventDefault();
        var $infosBox = $('#compte_a_rebours');

        $.ajax({
            url: Routing.generate('makeCustomCocktail'),
            data: $(this).serializeArray(),
            type: 'POST',
            beforeSend: function() {
                $infosBox.show().css("background-color", "#204d74").html('Distribution en cours...');
            }
        }).done(function(data) {
            if (data.success) {
                $infosBox.css("background-color","#4cae4c").html('Cocktail terminé!');
                $infosBox.delay(4000).fadeOut(500);
            } else {
                clearInterval(timer);
                $infosBox.css("background-color","#741a17").html(data.message);
                $infosBox.delay(4000).fadeOut(500);
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

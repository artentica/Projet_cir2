$( document ).ready( function(){
	$('#Cetat').hide();
	
	$('#check_del').click( function(){
        var conf = confirm('Etes-vous sûr de vouloir supprimer le projet?');
        if (conf == true) { return true; } 
        else { return false; }
    });

	$('#lancement_all').click( function() {
        $('#Cetat').show();
        $.ajax({
          type: 'GET',
          url: 'recup.php?P=' + p + '&U=all',
          timeout: 25000,
          success: function(data) {
            $('#etat').html( data );
            //setTimeout( refresh(), 10000);
          },
          error: function() {
            alert('La requête n\'a pas abouti'); 
            //refresh();
          }
        });
    });

    $('.test-e').click( function() {
        //alert ( $( this ).attr('value') );
        $('#Cetat').show();
        $.ajax({
          type: 'GET',
          url: 'recup.php?P=' + p + '&U=' + $( this ).attr('value') ,
          timeout: 25000,
          success: function(data) {
            $('#etat').html( data );
            //setTimeout( refresh(), 10000);
          },
          error: function() {
            alert('La requête n\'a pas abouti'); 
            //refresh();
          }
        });
    });

    $('.raz').click( function(){
      var conf = confirm('Etes-vous sûr de vouloir remettre à zero les résultats?');
      if (conf == true) { 
        $.ajax({
          type: 'GET',
          url: 'raz_result.php?P=' + $( this ).attr('value') ,
          timeout: 25000,
          success: function(data) {
            alert('ok les résultats ont été reinitialisés.');
          },
          error: function() {
            alert('La requête n\'a pas abouti'); 
          }
        });
      } 
    });
});
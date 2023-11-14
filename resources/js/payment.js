import './bootstrap';
import '.jquery';

// Restricts input for each element in the set of matched elements to the given inputFilter.
$(document).ready(function(){

    $("#lot_number").inputFilter(function(value) {
      return /^\d*$/.test(value);
    });

});

$('#confirm-delete').on('show.bs.modal', function(e) {
  $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

  $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
});

var tblProperties = $("#tblProperties");
var tblPayments = $("#tblPayments");

$("#btnAceptPayment").on('click',function(event){
    //event.preventDefault();
    //if( ) 
    $("#formPayment").submit();
});

$("#btnPayment").on('click',function(event){
    event.preventDefault();
    if( tblProperties[0] != undefined && tblPayments.find('input[type=checkbox]:checked').length > 0 ){

        var items = tblPayments.find('input[type=checkbox]:checked');//.find('td');
        var tableConfirmation = $("<table class='table table-bordered table-hover'><thead><th>Año</th><th>Mes</th><th>Valor</th></thead><tbody></tbody></table>");
        var total = 0.0;

        for (var i = 0; i < items.length; i++){
            var rows = $(items[i]).parent().parent().find('td');
            total = total + parseFloat(rows[2].innerText);
            tableConfirmation.append('<tr><td>' + rows[0].innerText + '</td><td>'+ rows[1].innerText + '</td><td>' + rows[2].innerText + '</td></tr>'  );
        }

        tableConfirmation.append('<tfoot><tr><td><b>TOTAL</b></td><td></td><td><b>' + total.toFixed(2) + '</b></td></tr></tfoot>'  );
        debugger;
        $("#confirmPayment").find(".detalle").html('');
        $("#confirmPayment").find(".detalle").append(tableConfirmation);
          $("#confirmPayment").modal();
    }
    else {
        $("#myModal").modal();
    }
    return false;
})
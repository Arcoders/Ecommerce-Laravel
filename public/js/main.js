$.fn.editable.defaults.mode = 'inline';
$.fn.editable.defaults.ajaxOptions = {type: 'PUT'};

$(document).ready(function(){

  $('.set-guide-number').editable();
  $('.select-status').editable({
    source: [
      {value: 'creado', text: 'Creado'},
      {value: 'enviado', text: 'Enviado'},
      {value: 'Recibido', text: 'Recibido'}
    ]
  });

  $('.add-to-cart').on('submit', function(ev){
    ev.preventDefault();

    var $form = $(this);
    var $button = $form.find("[type='submit']");

    $.ajax({

      url: $form.attr('action'),
      method: $form.attr('method'),
      data: $form.serialize(),
      dataType: 'JSON',

      beforeSend: function(){
        $button.val('Cargando...');
      },
      success: function(data){
        $('.circle-shopping-cart').html(data.products_count).addClass('highlight');
        $button.css('background-color', '#00c853').val('Agregado...');
        setTimeout(function(){ restarButton($button); }, 2000);
      },
      error: function(error){
        $button.css('background-color', '#d50000').val('Hubo un error');
        setTimeout(function(){ restarButton($button); }, 2000);
      }

    });

    return false;
  });

  function restarButton($button){
    $button.val('Agregar Al carrito').attr('style', '');
    $('.circle-shopping-cart').removeClass('highlight');
  }

});

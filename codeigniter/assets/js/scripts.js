//função que valida a desativação do form
function disableFormOnSubmit(){

  $('form.form-disabled-on-load').submit(function(){
    loadOnDisabledElement($(this).find('[type="submit"]'));
  });

  $('a.form-disabled-on-load,.btn-spinner').click(function(){
    loadOnDisabledElement(this);

    $(this).parents('form:first').submit();
  });
}

//função que desabilita e adiciona o SVG no button ou link do form submit
function loadOnDisabledElement(element){
  $(element)
      .attr('disabled', true);

  if ($(element).find('.fa-spinner').length == 0) {
    $(element).prepend(iconLoading());
  }
}

//icone svg do button ou link do submit
function iconLoading() {
  return '<i class="fa fa-spin fa-spinner"></i> ';
}

// Remove o svg do button ou link do submit
function removeLoaderFromElement(element) {
  $(element).each(function(i, el) {
    if ($(el).is('form')) {
      $(el).find('[type="submit"]').find('.fa-spinner').remove();
      $(el).find('[type="submit"]').removeAttr('disabled');
    } else {
      $(element).find('.fa-spinner').remove();
      $(element).removeAttr('disabled');
    }
  });
}



(function(){
  disableFormOnSubmit();
  removeLoaderFromElement('.form-disabled-on-load');
  $('#form-submitting').on('click', function (e){
    e.preventDefault();
    e.stopPropagation();
    var form = $("form#form-pergunta");
    if(form.valid()){
      form.submit();
    }
  });


  $("form#form-pergunta").validate({
      debug: false,
      errorClass: "text-danger",
      errorElement: "span",
      errorPlacement: function (error, element) {
        if (element.hasClass('select2-hidden-accessible') && element.next('.select2-container').length) {
          error.insertAfter(element.next('.select2-container'));
        } else if (element.hasClass('form-check-input')) {
          error.insertAfter(element.closest('.form-check-group'));
        } else {
          error.insertAfter(element);
        }
      }
  });
  $('.form-check-input').each(function (index, element){
    $(element).rules('add', {
      required: true,
      messages: {
        required: "Selecione uma resposta",
      }
    });
  });

})();
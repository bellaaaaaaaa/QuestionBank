$().ready(function() {
  $('.on__file__import').on('change', function(e){
    let form = $($(this).data('target'));
    form.submit();
  });
});
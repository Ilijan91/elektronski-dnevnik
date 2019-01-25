$('.check-all').click(function() {
    var selector = $(this).is(':checked') ? ':not(:checked)' : ':checked';

    $('#main-container input[type="checkbox"]' + selector).each(function() {
        $(this).trigger('click');
    });
});
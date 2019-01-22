$('.check-all').click(function() {
    var selector = $(this).is(':checked') ? ':not(:checked)' : ':checked';

    $('#frontend input[type="checkbox"]' + selector).each(function() {
        $(this).trigger('click');
    });
});
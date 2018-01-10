$(document).ready(function() {
    var fields = $('*[data-field-zip-city]');

    fields.each(function(i, item) {

        var linkedField = $('*[data-field-zip-city="' + $(item).attr('data-linked-field') + '"]');

        console.info(linkedField);

        $(item).on('change', function(e) {
            var action = 'remove';
            var data = null;

            if (typeof e.added !== 'undefined') {
                action = 'add';
                data = e.added;
            } else {
                data = e.removed;
            }

            if (typeof(data.new) === 'undefined') {
                linkedField
                    .select2('data', data)
                    .data('syncData')(data, action);
            }
        });
    });
});

if (LI === undefined)
    var LI = {};

$(document).ready(function() {
    LI.handleZipCity();
}).on('sonata.add_element', function() {
    LI.handleZipCity();
});

LI.handleZipCity = function() {
    var fields = $('*[data-field-zip-city]');

    fields.each(function(i, item) {
        var groupFormGroup = $(item).closest('.sonata-ba-collapsed-fields');

        var linkedField = $(groupFormGroup).find('*[data-field-zip-city="' + $(item).attr('data-linked-field') + '"]');

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
};

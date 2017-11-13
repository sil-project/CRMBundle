var setupAutocompleteInputs = function() {

    var inputs = $('input.zipcity-autocomplete');

    if (inputs.length > 0) {
        $(inputs).each(setupAutocomplete);
    }
};

var setupAutocomplete = function(key, autocompleteInput) {

    autocompleteInput = $(autocompleteInput);

    if (!autocompleteInput.data('select2')) {

        var config = autocompleteInput.data('config');

        autocompleteInput.select2({
            placeholder: config.options.placeholder, // allowClear needs placeholder to work properly
            allowClear: config.options.allowClear,
            enable: config.options.allowclear,
            readonly: config.options.readonly,
            minimumInputLength: config.options.minimumInputLength,
            multiple: config.options.multiple,
            initSelection: function(element, callback) {
                var data = { id: element.val(), text: element.val() };
                callback(data);
            },
            width: config.options.width,
            dropdownAutoWidth: config.options.dropdownAutoWidth,
            containerCssClass: config.options.containerCssClass,
            dropdownCssClass: config.options.dropdownCssClass,
            ajax: {
                url: config.ajax.url,
                dataType: 'json',
                quietMillis: config.ajax.quietMillis,
                cache: config.ajax.cache,
                data: function(term, page) { // page is the one-based page number tracked by Select2
                    var data = {};

                    data[config.ajax.data.searchParamName] = term;
                    data[config.ajax.data.itemsParamName] = config.ajax.data.itemsPerPage;
                    data[config.ajax.data.pageParamName] = page;

                    $.extend(data, config.ajax.data.optional);

                    return data;
                },
                results: function(data, page) {
                    // notice we return the value of more so Select2 knows if more results can be loaded
                    return { results: data.items, more: data.more };
                }
            },
            formatResult: function(item) {
                return $('<div></div>')
                    .addClass(config.dropdownItemClass)
                    .html(item.label);
            },
            formatSelection: function(item) {
                return item[config.name];
            },
            escapeMarkup: function(m) { return m; }, // we do not want to escape markup since we are displaying html in results
            createSearchChoice: function(term, data) { // allow user to add custom data (not found in ajax request)
                if ($(data).filter(function() {
                        console.log(this);
                        return this[config.name].localeCompare(term) === 0;
                    }).length === 0) {
                    var choice = {
                        id: term,
                        label: term
                    };

                    choice[config.name] = term;

                    return choice;
                }
            }
        });

        if (config.linked) {
            autocompleteInput.on('change', function(e) {

                // remove input
                if (undefined !== e.removed && null !== e.removed) {
                    var removedItems = e.removed;
                    $('#' + config.id + '_hidden_inputs_wrap input:hidden').val('');
                }
                // add new input
                if (undefined !== e.added) {
                    var addedItems = e.added;
                    $('#' + config.id + '_hidden_inputs_wrap input:hidden').val(addedItems[config.name]);

                    // Change country according to the selected result
                    if (undefined !== addedItems.country_code) {
                        selectCountry(addedItems.country_code);
                    }

                    if (config.name == 'zip') {
                        // Change city according to the selected result
                        if (undefined !== addedItems.city) {
                            var data = { id: addedItems.city, city: addedItems.city };
                            $('#' + config.formId + '_' + config.cityField + '_autocomplete_input').select2('data', data);
                            $('#' + config.formId + '_' + config.cityField + '_hidden_inputs_wrap input:hidden').val(addedItems.city);
                        }
                    } else if (config.name == config.cityField) {
                        // Change zip according to the selected result
                        if (undefined !== addedItems.zip) {
                            var data = { id: addedItems.zip, zip: addedItems.zip };
                            $('#' + config.formId + '_' + config.zipField + '_autocomplete_input').select2('data', data);
                            $('#' + config.formId + '_' + config.zipField + '_hidden_inputs_wrap input:hidden').val(addedItems.zip);
                        }
                    }
                }
            });
        }

        function selectCountry(country_code) {
            var $select = $('select#' + config.formId + '_country');
            $select.find('option').filter(function() {
                return $(this).val() == country_code;
            }).prop('selected', true);
            $select.trigger('change');
        }
        // Initialise the autocomplete
        if (undefined !== config.value || '' != config.value) {
            var data = { id: config.value };
            data[config.name] = config.value;
            autocompleteInput.select2('data', data);
        }
        // remove unneeded autocomplete text input before form submit
        $('#' + config.id + '_autocomplete_input').closest('form').submit(function() {
            $('#' + config.id + '_autocomplete_input').remove();

            return true;
        });

    }
};

$(document).ready(setupAutocompleteInputs);
$(document).on('sonata-admin-setup-list-modal sonata-admin-append-form-element sonata.add_element', function(e) {
    var eventTarget = $(e.target);

    if (eventTarget.hasClass('field-container')) {
        setupAutocompleteInputs();
    }
});

(function($) {
    "use strict"

    // MAterial Date picker
    $('#mdate').bootstrapMaterialDatePicker({
        weekStart: 0,
        time: false
    });
    $('#timepicker').bootstrapMaterialDatePicker({
        format: 'HH:mm',
        time: true,
        date: false
    });
    $('#date-format').bootstrapMaterialDatePicker({
        format: 'DD MMMM YYYY hh:mm A',
        minDate: new Date()
        // format: 'dddd DD MMMM YYYY - HH:mm'
    });

    $('#date-format1').bootstrapMaterialDatePicker({
        format: 'DD MMMM YYYY hh:mm A',
        minDate: new Date()
        // format: 'dddd DD MMMM YYYY - HH:mm'
    });
    $('#date-format2').bootstrapMaterialDatePicker({
        format: 'DD MMMM YYYY hh:mm A',
        minDate: new Date()
        // format: 'dddd DD MMMM YYYY - HH:mm'
    });
    $('#date-format3').bootstrapMaterialDatePicker({
        format: 'DD MMMM YYYY hh:mm A',
        minDate: new Date()
        // format: 'dddd DD MMMM YYYY - HH:mm'
    });

    $('#min-date').bootstrapMaterialDatePicker({
        format: 'DD/MM/YYYY HH:mm',
        minDate: new Date()
    });

})(jQuery);
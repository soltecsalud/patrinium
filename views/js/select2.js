$(document).ready(function() {
    $('.prueba').select2({
        selectOnClose: true
    });
});

$(document).ready(function() {
    $('.select-modal').select2({
        dropdownParent: $("#myModal"),
        selectOnClose: true
    });
});
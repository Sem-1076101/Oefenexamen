jQuery('option').mousedown(function(e) {
    e.preventDefault();
    jQuery(this).prop('selected', !$(this).prop('selected'));
    return false;
});




$(function () {
    var content = "<input type=text class='newInput' onKeyDown='event.stopPropagation();' onKeyPress='addSelectInpKeyPress(this,event)' onClick='addSelectInpKeyPress(this,event)' placeholder='Nuevo'> <span class='glyphicon glyphicon-plus addnewicon' onClick='addSelectItem(this,event,1);'></span>";

    var divider = $('<option/>')
        .addClass('divider')
        .data('divider', true);

    var addoption = $('<option/>')
        .addClass('additem')
        .data('content', content);

    $('.selectpicker-option')
        .append(divider)
        .append(addoption)
        .selectpicker('refresh');
});

function addSelectItem(t, ev) {
    ev.stopPropagation();
    var txt = $(t).prev().val().replace(/[|]/g, "");
    if ($.trim(txt) == '') return;
    var p = $(t).closest('.bootstrap-select').find('select');
    var o = $('option', p).eq(-2);
    var newo = new Option(txt, txt);
    o.before(newo);
    p.find('option[value="'+txt+'"]' ).prop( 'selected', 'selected' );
    p.trigger('input');
    p.selectpicker('refresh');
}

function addSelectInpKeyPress(t, ev) {
    ev.stopPropagation();
    // do not allow pipe character
    if (ev.which == 124) ev.preventDefault();
    // enter character adds the option
    if (ev.which == 13) {
        ev.preventDefault();
        addSelectItem($(t).next(), ev);
    }
}
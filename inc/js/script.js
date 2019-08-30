jQuery( document ).ready(function() {
    var $groupCounter = 0;
    $( ".groups" ).on( "click", ".group__delete-button", function(e) {
        e.preventDefault();
        jQuery(this).closest('.group').remove();
    });
    $( ".groups" ).on( "change", ".group select", function(e) {
        var $value = $(this).val();
        $(this).closest('.group').find('input[type="text"]').val($value);
    });
    jQuery('.js-add-group-button').click(function(e){
        e.preventDefault();
        var $groups = $('.groups');
        var $newGroup = $('.new-group-tmpl .group').first().clone();
        $groupCounter++;
        $newGroup.find('select[name*="[input]"]').attr('name', 'mod-scss__groups[n'+$groupCounter+'][input]');
        $newGroup.find('input[name*="[output]"]').attr('name', 'mod-scss__groups[n'+$groupCounter+'][output]');
        $newGroup.find('input[name*="[minify]"]').attr('name', 'mod-scss__groups[n'+$groupCounter+'][minify]').attr('id', 'minify-checkbox-n'+$groupCounter);
        $newGroup.find('label[for*="minify"]').attr('for', 'minify-checkbox-n'+$groupCounter);
        $newGroup.find('input[type="text"]').val('');
        $newGroup.appendTo($groups);
    });
});
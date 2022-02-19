$( function() {
    $( "#station1_name" ).autocomplete({
        minLength: 3,
        autoFocus: true,
        source: stations,
        focus: function( event, ui ) {
            $( "#station1_name" ).val( ui.item.label );
            return false;
        },
        select: function( event, ui ) {
            $( "#station1_name" ).val( ui.item.label );
            $( "#station1_id" ).val( ui.item.value );

            return false;
        }
    })
    .autocomplete( "instance" )._renderItem = function( ul, item ) {
        return $( "<li>" )
        .append( "<div>" + item.label + "</div>" )
        .appendTo( ul );
    };
});

$( function() {
    $( "#station2_name" ).autocomplete({
        minLength: 3,
        autoFocus: true,
        source: stations,
        focus: function( event, ui ) {
            $( "#station2_name" ).val( ui.item.label );
            return false;
        },
        select: function( event, ui ) {
            $( "#station2_name" ).val( ui.item.label );
            $( "#station2_id" ).val( ui.item.value );

            return false;
        }
    })
    .autocomplete( "instance" )._renderItem = function( ul, item ) {
        return $( "<li>" )
        .append( "<div>" + item.label + "</div>" )
        .appendTo( ul );
    };
});
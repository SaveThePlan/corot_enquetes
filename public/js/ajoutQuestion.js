//toggle message and form, javascript enable
function init() {
    $('#jsrequired').hide();
    $('#content form').show();
    
    $(".question input[type=radio]").on('click', function(){
        checktype(this);
    });

    $("button.prop").on('click', function(){
        addProposition(this);
    });
};



function checktype(input) {
    
    switch ($(input).val()){
        case 'text':
            console.log('champ texte');
            $('.question .prop').hide();
            break;
        case 'nb':
            $('.question .prop').hide();
            console.log('champ nb');
            break;
        case 'qcm':
            $('.question .prop').show();
            console.log('qcm choix')
            break;
    }
    
};

function addProposition(button) {
    var input = $("input[name='proposition[]']")[0];
    var input2 = $(input).clone();
    $(input2).val("");
    $(button).parent().append($(input2));
}
















//call init function on document ready
$(document).ready(init);


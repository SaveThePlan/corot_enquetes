//var globale pour stocker le bloc à dupliquer
var blocSource; //stocke un clone du bloc "question" généré via ZF2

//toggle message and form, javascript enable
function init() {
    $('#jsrequired').hide();
    $('#content form').show();

    $(document).on('click', ".question input[type=radio]", function() {
        checktype(this);
    });

    $(document).on('click', "button.prop", function() {
        addProposition(this);
    });

    $("#ajoutquest").on('click', function() {
        addQuestion($('.question').length);
    });

    blocSource = $(".question").clone();
    $(".question").remove();
    addQuestion($(".question").length);

}
;


function checktype(input) {

    switch ($(input).val()) {
        case 'text':
//            $('.question .prop').hide();
            $(input).parent().parent().find('.prop').hide();
            break;
        case 'nb':
//            $('.question .prop').hide();
            $(input).parent().parent().find('.prop').hide();
            break;
        case 'qcm':
//            $('.question .prop').show();
            $(input).parent().parent().find('.prop').show();
            break;
    }

}
;

function addProposition(button) {
    var input = $("input[name='proposition[]']")[0];
    var input2 = $(input).clone();
    $(input2).val("");
    $(button).parent().append($(input2));
}





function addQuestion(numref) {
    var blocQuestion = $(blocSource).clone();

    //chgt attribut for des <label>
    var labels = $(blocQuestion).find('label[for]');

    labels.each(function() {
        $(this).attr('for', modifAttr($(this).attr('for'), numref));
    });

    //chgt attribut for des <input>
    var inputs = $(blocQuestion).find('input');
    inputs.each(function() {
        $(this).attr('name', modifAttr($(this).attr('name'), numref));
    });


    $("#questCont").append($(blocQuestion));
}


function modifAttr(string, num) {
    if (string.substr(-2, 2) === '[]') {
        var stringModif = string.substr(0, string.length - 2) + num + '[]';
    } else {
        var stringModif = string + num;
    }
    
    console.log(string + ' --> ' + stringModif);

    return stringModif;

}



//call init function on document ready
$(document).ready(init);


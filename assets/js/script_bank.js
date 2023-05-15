$(function(){

    $('input[id=account_number]').mask('000000000000-0', {reverse:true, placeholder:"0000000-0"});
    $('input[id=value_check]').mask('000.000.000.000.000,00', {reverse:true, placeholder:"0,00"});
});


function ModifyUser(name, divmod){
    $(".active").removeClass('active');
    $('.btn-outline-light').removeClass('btn-outline-light').addClass('btn-outline-info');
    $('#item-' + name).addClass('active');
    $('#btn-' + name).removeClass('btn-outline-info').addClass('btn-outline-light');

    var str = "";

    $('#'+divmod).html(str);
}
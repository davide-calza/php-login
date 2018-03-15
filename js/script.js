function ModifyUser(name, email, divmod) {
    $(".active").removeClass('active');
    $('.btn-outline-light').removeClass('btn-outline-light').addClass('btn-outline-info');
    $('#item-' + name).addClass('active');
    $('#btn-' + name).removeClass('btn-outline-info').addClass('btn-outline-light');

    const str =
        "<form id='form-modify-user'>" +
        "  <div class='form-group'>" +
        "    <label for='formGroupExampleInput'>Username</label>" +
        "    <input type='text' class='form-control' id='txt-username' placeholder='Enter Username' value='"+name+"'>" + 
        "  </div>" +
        "  <div class='form-group'>" +
        "    <label for='formGroupExampleInput2'>Email</label>" +
        "    <input type='text' class='form-control' id='txt-email' placeholder='Enter Email' value='"+email+"'>" +
        "  </div>" +
        "</form>";

    $('#' + divmod).html(str);
}
/**ModifyUser
 *
 * Print the modify user form
 * name   = name of the user to modify
 * email  = email of the user ti modify
 * divmod = div to append the form
 * err    = check if an error occurred
*/
function ModifyUser(name, email, divmod, err) {
    $(".active").removeClass('active');
    $('.btn-outline-light').removeClass('btn-outline-light').addClass('btn-outline-info');
    $('.badge-light').removeClass('badge-light').addClass('badge-info');
    $('#item-' + name).addClass('active');
    $('#btn-' + name).removeClass('btn-outline-info').addClass('btn-outline-light');
    $('#badge-' + name).removeClass('badge-info').addClass('badge-light');
    $('html, body').animate({scrollTop:0}, 'fast');

    str = "<form>" +
        "<div id='div-modify-user-title' class='card-header'><h2><strong>Modify User</strong></h2></div>" +
        "<div id='form-modify-user'>"+
        "  <div class='form-group'>" +
        "    <label for='lbl-username'>Username</label>" +
        "    <input type='text' class='form-control' name='txt-username' id='txt-username' placeholder='Enter Username' value='" + name + "'>" +
        "  </div>" +
        "  <div class='form-group'>" +
        "    <label for='lbl-email'>Email</label>" +
        "    <input type='email' class='form-control' id='txt-email' name='txt-email' placeholder='Enter Email' value='" + email + "'>" +
        "  </div>" +
        "  <br />" +
        "  <div class='form-group'>" +
        "    <label for='lbl-newpwd'>New Password</label>" +
        "    <input type='password' class='form-control' name='txt-newpwd' id='txt-newpwd' placeholder='Enter New Password'>" +
        "  </div>" +
        "  <div class='form-group'>" +
        "    <label for='lbl-retpwd'>Retype New Password</label>" +
        "    <input type='password' class='form-control' name='txt-retpwd' id='txt-retpwd' placeholder='Retype New Password' onkeyup='CheckNewPasswordRetype(\"txt-newpwd\", \"txt-retpwd\")'>" +
        "  </div>" +
        "  <br />" +
        "  <div class='row' id='div-modify-user-btns'> " +
        "    <div class='col-md-6'>" +
        "      <div class='input-group mb-3'>" +
        "         <div class='input-group-prepend'>" +
        "             <span class='input-group-text' id='basic-addon1'>Password</span>" +
        "         </div>" +
        "         <input type='password' class='form-control' name='txt-pwd' id='txt-pwd' aria-label='Password' aria-describedby='basic-addon1' placeholder='Enter your current Password'>" +
        "      </div>" +
        "    </div>" +
        "    <div class='col-md-6'>" +
        "      <button type='submit' class='btn btn-outline-success my-3 my-sm-0 mr-sm-3' id='btn-update' name='btn-update' value='" + name + "_" + email + "' formmethod='post'>Update User</button>" +
        "      <button type='submit' class='btn btn-outline-danger my-3 my-sm-0 mr-sm-3' id='btn-delete' name='btn-delete' value='" + name + "_" + email + "' formmethod='post'>Delete User</button>" +
        "      <button type='button' class='btn btn-outline-info' name='btn-cancel' onclick='CancelButton(\"" + divmod + "\")'>Cancel</button>" +
        "    </div>" +
        "  </div>" +
        "</div>"+
        "</form>";

    if(err){
        $('#' + divmod).html(str).hide().show();
    }
    else if($('#' + divmod).css('display') == 'none' || $('#' + divmod).html() == ""){

        $('#' + divmod).html(str).hide().show('slide', { direction: 'right' }, 200);
    }
    else{
        $('#' + divmod).html(str).hide(200).show(200);
    }
}

/**Add user
 *
 * Print the add user form
 * divmod = div to append the form
 * err    = check if an error occurred
 */
function AddUser(divmod, err) {
    $(".active").removeClass('active');
    $('.btn-outline-light').removeClass('btn-outline-light').addClass('btn-outline-info');
    $('.badge-light').removeClass('badge-light').addClass('badge-info');
    $('html, body').animate({scrollTop:0}, 'fast');

    str = "<form>" +
        "<div id='div-modify-user-title' class='card-header'><h2><strong>Add User</strong></h2></div>" +
        "<div id='form-modify-user'>" +
        "  <div class='form-group'>" +
        "    <label for='lbl-username'>Username</label>" +
        "    <input type='text' class='form-control' name='txt-username' id='txt-username' placeholder='Enter Username'>" +
        "  </div>" +
        "  <div class='form-group'>" +
        "    <label for='lbl-email'>Email</label>" +
        "    <input type='email' class='form-control' id='txt-email' name='txt-email' placeholder='Enter Email'>" +
        "  </div>" +
        "  <br />" +
        "  <div class='form-group'>" +
        "    <label for='lbl-newpwd'>Password</label>" +
        "    <input type='password' class='form-control' name='txt-newpwd' id='txt-newpwd' placeholder='Enter Password'>" +
        "  </div>" +
        "  <div class='form-group'>" +
        "    <label for='lbl-retpwd'>Retype Password</label>" +
        "    <input type='password' class='form-control' name='txt-retpwd' id='txt-retpwd' placeholder='Retype Password' onkeyup='CheckNewPasswordRetype(\"txt-newpwd\", \"txt-retpwd\")'>" +
        "  </div>" +
        "  <br />" +
        "  <div class='row' id='div-modify-user-btns'> " +
        "    <div class='col-md-6'>" +
        "      <div class='input-group mb-3'>" +
        "         <div class='input-group-prepend'>" +
        "             <span class='input-group-text' id='basic-addon1'>Password</span>" +
        "         </div>" +
        "         <input type='password' class='form-control' name='txt-pwd' id='txt-pwd' aria-label='Password' aria-describedby='basic-addon1' placeholder='Enter your current Password'>" +
        "      </div>" +
        "    </div>" +
        "    <div class='col-md-6'>" +
        "      <button type='submit' class='btn btn-outline-success my-3 my-sm-0 mr-sm-3' id='btn-add' name='btn-add' formmethod='post'>Add User</button>" +
        "      <button type='button' class='btn btn-outline-info' name='btn-cancel' onclick='CancelButton(\"" + divmod + "\")'>Cancel</button>" +
        "    </div>" +
        "  </div>" +
        "</div>" +
        "</form>";

    if (err) {
        $('#' + divmod).html(str).hide().show();
    }
    else if ($('#' + divmod).css('display') == 'none' || $('#' + divmod).html() == "") {

        $('#' + divmod).html(str).hide().show('slide', {direction: 'right'}, 200);
    }
    else {
        $('#' + divmod).html(str).hide(200).show(200);
    }
}

/**CheckNewPasswordRetype
 *
 * Check if two input forms have the same text
 * id1 = id of the first input
 * id2 = id of the second input
*/
function CheckNewPasswordRetype(id1, id2) {
    pw1 = $("#" + id1).val();
    pw2 = $("#" + id2).val();

    $("#" + id2).removeClass("is-invalid").removeClass("is-valid");
    if (pw2 === "" || pw2 === null) {
    }
    else if (pw1 === pw2) {
        $("#" + id2).addClass("is-valid");
    }
    else {
        $("#" + id2).addClass("is-invalid");
    }
}

/**CancelButton
 *
 * Manage the "cancel" button action
 * id = id of the button
*/
function CancelButton(id) {
    $('#' + id).hide('slide', { direction: 'right' }, 200);
    $(".active").removeClass('active');
    $('.btn-outline-light').removeClass('btn-outline-light').addClass('btn-outline-info');
}

/**ErrorAlert
 *
 * Show an error alert
 * form_id = id of the form to append the alert
 * msg     = message of the alert
 * txt_id  = id of the password input box to invalid
*/
function ErrorAlert(form_id, msg, txt_id) {
    $('#alert-mod-user-error').hide();
    str = '<div id="alert-mod-user-error" class="alert alert-danger alert-dismissible fade show" role="alert">' +
        '  <strong>Error!</strong> ' + msg +
        '  <button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
        '    <span aria-hidden="true">&times;</span>' +
        '  </button>' +
        '</div>';
    $('#' + form_id).prepend(str);
    $('#' + txt_id).addClass("is-invalid");
    $('#alert-mod-user-error').show('slide', { direction: 'up' }, 200);
}
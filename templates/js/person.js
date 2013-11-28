$(function () {
    $('input[name="radCountry"]').change(function () { // 选择国家事件

        if ($('input[name="lang"]').val() == 'cperson') {
            if ($('input[name="radCountry"]:checked').val() == '中国') {
                $('input[name="txtMobile"]').attr('require', 'true');
                $('input[name="txtMobile"]').parent().parent().find('td').eq(0).html('*');
            } else {
                $('input[name="txtMobile"]').attr('require', 'false');
                $('input[name="txtMobile"]').parent().parent().find('td').eq(0).html('');
            }
        }

        switch ($('input[name="radCountry"]:checked').val()) {
            case '中国': // 中国
            case 'China':
                if ($('select[name="selProvince"] option').length <= 1) { // 选择之后才加载中国下的省份
                    $.each(province, function () {
                        $('select[name="selProvince"]').append('<option value="' + this + '">' + this + '</option>');
                    });
                }
                $('[item="country"]').show();
                $('select[name="selCountry"]').hide();

                $('input[name="txtPostalCode"]').attr('regex', '/^\\d{4,}$/');
                break;
            case 'Other':
            case '其它': // 其它国家
                if ($('select[name="selCountry"] option').length <= 1) { // 选择其它国家之后才加载其它国家数据
                    $.each(country, function () {
                        if ($.trim(this.split('|')[1]).length > 0) {
                            $('select[name="selCountry"]').append('<option value="' + this.split('|')[0] + '">' + this.split('|')[1] + '</option>');
                        } else {
                            $('select[name="selCountry"]').append('<option value="' + this + '">' + this + '</option>');
                        }
                    });
                }
                $('[item="country"]').hide();
                $('select[name="selCountry"]').show();

                $('input[name="txtPostalCode"]').removeAttr('regex');
                break;
            default:
                $('[item="country"]').hide();
                $('select[name="selCountry"]').hide();

                $('input[name="txtPostalCode"]').removeAttr('regex');
                break;
        }
    });

    $('input[name="btnConfirm"]').click(function () {
        if (checkForm()) {
            var button = $('input[name="btnConfirm"]');
            var email = $('input[name="txtEmail"]');
            button.val(message.SUBMIT_BUTTON.split('|')[1]).attr('disabled', 'disabled');
            $.post('ajax.aspx', { op: 'VERIFY_AUTHENTIC_EMAIL', fid: $('input[name="fid"]').val(), emails: $.trim(email.val()) }, function (response) {
                var result = eval('(' + response + ')');

                switch (parseInt(result.result)) {
                    case 0:
                        var popup = window.popup = new Popup({ contentType: 2, isReloadOnClose: false, width: 340, height: 100 });
                        popup.setContent("contentHtml", $('[id="txtMessage"]').val());
                        popup.setContent("title", message.JUMP_MESSAGE_TITLE);
                        popup.build();
                        popup.show();
                        break;
                    case 1:
                        alert(message.ALREADY_EXISTS_EMAIL.replace('{0}', result.emails));
                        button.val(message.SUBMIT_BUTTON.split('|')[0]).removeAttr('disabled');
                        email.focus().select();
                        break;
                    case 2:
                        alert(message.NO_AUTHENTIC.replace('{0}', result.emails));
                        button.val(message.SUBMIT_BUTTON.split('|')[0]).removeAttr('disabled');
                        email.focus().select();
                        break;
                }
            });
            
        }
    });

    $('input[name="btnYes"], input[name="btnNo"]').live('click', function () {
        $('input[name="btnYes"]').attr('disabled', 'disabled');
        $('input[name="btnNo"]').attr('disabled', 'disabled');
        $('input[name="IsJump"]').val($(this).attr('name') == 'btnYes' ? '1' : '0');
        window.popup.close();
        window.popup = null;

        var country = $('input[name="radCountry"]:checked').val();

        switch (country) {
            case '中国':
            case 'China':
                $('input[name="txtCountry"]').val(country);
                $('input[name="txtBadge"]').val('card_r3_c3.jpg');
                break;
            case 'Other':
            case '其它':
                $('input[name="txtCountry"]').val($('select[name="selCountry"] :selected').text());
                $('select[name="selProvince"]').val('');
                $('input[name="txtCity"]').val('');
                $('input[name="txtBadge"]').val('card_r3_c2.jpg');
                break;
            default:
                $('input[name="txtCountry"]').val(country);
                $('select[name="selProvince"]').val('');
                $('input[name="txtCity"]').val('');
                $('input[name="txtBadge"]').val('card_r3_c2.jpg');
                break;
        }

        $.each($('[item^="question"]'), function () {
            var c = $(this);
            var array = new Array();

            $.each(c.find(':checked'), function () {
                var o = $(this);
                var input = o.parent().find('input[type="text"]');

                if (input.length > 0) { array.push(o.val() + '|' + $.trim(input.val())); } else { array.push(o.val()); }
            });

            $('input[name="txtQuestion' + c.attr('item').split('|')[1] + '"]').val(array.join(', '));
        });

        $('form').submit();
    });

    $('input[name="radCountry"]').change();

    loadData();
});

function loadData() {
    if ($.trim($('input[name="txtOrderID"]').val()).length > 0) {


            $.each(response.split('$$'), function () {
                var values = this.split('$');

                if (values.length == 3) {
                    values[0] = values[1];
                    values[1] = values[2];
                }

                if ($.trim(values[1]).length > 0) {
                    switch (values[0]) {
                        case 'Title': $('select[name="selTitle"]').val(values[1]); break;
                        case 'lName': $('input[name="txtLastName"]').val(values[1]); break;
                        case 'FName': $('input[name="txtFirstName"]').val(values[1]); break;
                        case 'Position': $('input[name="txtJob"]').val(values[1]); break;
                        case 'Company': $('input[name="txtCompany"]').val(values[1]); break;
                        case 'Address': $('input[name="txtAddress"]').val(values[1]); break;
                        case 'Country':
                            if (values[1] == 'China' || values[1] == 'Hong Kong' || values[1] == 'Macao' || values[1] == 'Taiwan' || values[1] == '中国' || values[1] == '香港' || values[1] == '澳门' || values[1] == '台湾') {
                                $('input[name="radCountry"][value="' + values[1] + '"]').attr('checked', true);
                                $('input[name="radCountry"]').change();
                            } else {
                                if ($('input[name="lang"]').val() == 'eperson') {
                                    $('input[id="radCountry5"]').attr('checked', true);
                                    $('input[name="radCountry"]').change();
                                    $('select[name="selCountry"] option[value="' + values[1] + '"]').attr('selected', true);
                                }
                            }
                            break;

                        case 'City': $('input[name="txtCity"]').val(values[1]); break;
                        case 'State': $('select[name="selProvince"]').val(values[1]); break;
                        case 'Postal': $('input[name="txtPostalCode"]').val(values[1]); break;
                        case 'Tel': $('input[name="txtTel"]').val(values[1]);
                            var tel = values[1].split('-');

                            if (tel.length == 3) {
                                $('input[name="txtTelCountry"]').val(tel[0]);
                                $('input[name="txtTelArea"]').val(tel[1]);
                                $('input[name="txtTel"]').val(tel[2]);
                            } else {
                                $('input[name="txtTelArea"]').val(tel[0]);
                                $('input[name="txtTel"]').val(tel[1]);
                            }
                            break;
                        case 'Fax':
                            var fax = values[1].split('-');

                            if (fax.length == 3) {
                                $('input[name="txtFaxCountry"]').val(fax[0]);
                                $('input[name="txtFaxArea"]').val(fax[1]);
                                $('input[name="txtFax"]').val(fax[2]);
                            } else {
                                $('input[name="txtFaxArea"]').val(fax[0]);
                                $('input[name="txtFax"]').val(fax[1]);
                            }
                            break;
                        case 'Mobile': $('input[name="txtMobile"]').val(values[1]); break;
                        case 'Email': $('input[name="txtEmail"]').val(values[1]); break;
                        case 'Web': $('input[name="txtWebsite"]').val(values[1]); break;
                    }
                }
            });

    }
}

function checkForm() {
    var error = true;

    $.each($('[require]:visible'), function () {
        var c = $(this);

        switch (c.attr('type')) {
            case 'checkbox':
            case 'radio':
                if ($('input[name="' + c.attr('name') + '"]:checked').length <= 0) {
                    alert(c.attr('message')); c.focus(); error = false; return false;
                } else {
                    if (c.attr('otherID') != undefined) {
                        var othersID = c.attr('otherID').split('|');

                        $.each(othersID, function () {
                            var o = this;

                            if ($('#' + o + '').attr('checked') == 'checked') {
                                var input = $('#' + o + '').parent().find('input[type="text"]');

                                if (input != undefined && $.trim(input.val()).length <= 0) {
                                    alert(input.attr('message')); input.focus(); error = false; return false;
                                }
                            }
                        });

                        if (!error) return false;
                    }
                }
                break;
            case 'select':
            case 'text':
                if ($.trim(c.val()).length <= 0) {
                    if (c.attr('require') == 'true' && c.attr('disabled') == undefined) {
                        alert(c.attr('message').split('|')[0]); c.focus(); error = false; return false;
                    }
                } else {
                    if (c.attr('regex') != undefined && !eval(c.attr('regex')).test($.trim(c.val()))) {
                        alert(c.attr('message').split('|')[1]); c.focus(); c.select(); error = false; return false;
                    } else {
                        if (c.attr('name') == 'txtConfirmEmail') {
                            if ($.trim($('input[name="txtEmail"]').val()) != $.trim(c.val())) {
                                alert(c.attr('message')); c.focus(); error = false; return false;
                            }
                        }
                    }
                }
                break;
        }
    });

    return error;
}
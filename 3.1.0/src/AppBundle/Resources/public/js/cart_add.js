
function wc_show_ticketbutton(typ) {

    if (typ) {
        $('#input_button_field').hide();
        return false;

    } else {
        $('.input_button_field').show();
        return true;
    }

}

function wc_cart_add_later(ele) {
    setTimeout(function () {
        wc_cartaddgroup_check(ele)
    }, 300);
}

function wc_cartadd_new(id) {

    if (!id && $('.hctwarinn.ckd').is('*')) {
        setTimeout(500);
        id = $('.hctwarinn.ckd').eq(0).attr('data_tid');

    } else if (id) {
        $('.ckd').removeClass('ckd');
        $('button[data_tid="' + id + '"]').addClass('ckd');
    }

    if (!id) {
        return false;
    }

    var load = wc_loaddiv();
    if (load) {
        wc_loaddiv(1);
    }
    ;

    var korb = get_wc_data(id);
    var wctov = $('.tik' + id).parents('.wct');
    wctov.find('.divload').show(0);

    var dateele = wctov.find('.tkdate');
    var datum = "";

    if (((korb['datum']['set'] == true) && (korb['datum']['val'] != "")) || korb['datum']['set'] == false) {

        if (korb['datum']['val']) {
            getdatum = '&da=' + korb['datum']['val'];
        } else {
            getdatum = '';
        }

        $.ajax({
            cache: false,
            type: "GET",
            data: "JSON=" + JSON.stringify(korb),
            dataType: 'json',
            url: "/app_dev.php/warenkorb/rein_json"
        }).done(
            function (data) {

                if (data.success == true) {
                    if (load) {
                        wc_loaddiv(2);
                    }

                    if($('aside.control-sidebar').is('*') && !$('aside.control-sidebar').hasClass('shown')){
                        $.AdminLTE.controlSidebar.open();
                        $('aside.control-sidebar').addClass('shown');
                    }


                    if (data.times) {
                        wc_ask_time(dateele, data.times);
                    }
                    get_wc_data(id, true);
                    wc_cartref();

                } else if (data.success == false) {

                    if (data.times) {

                        wc_ask_time(dateele, data.times);

                    }

                    if(data.error){
                        switch(data.error){
                            case 990:
                                wc_loaddiv();
                                break;
                        }
                    }

                } else {
                    wc_loaddiv(3);
                }

            });
    } else if ((korb['datum']['set'] == true) && (korb['datum']['val'] == "")) {

        if (load) {
            wc_loaddiv(6);
        }

    }

    wctov.find('.divload').hide(0);

    return true;
}

function get_wc_data(id, clear) {
    var array = {};
    array['anzahl'] = 0;
    array['tickets'] = [];
    var WarenKorb = $('.wct.kat' + id);
    if(clear == true){
        wc_show_button(WarenKorb, false);
    }
    array['kategorie'] = id;
    WarenKorb.find('.num').each(function () {
        if(clear == true){
            $(this).val(0);
        } else {

            var a = 0;
            a = parseInt($(this).val());
            if (a > 0) {
                array['anzahl'] += a;
                tid = parseInt($(this).attr('data-tid'));
                if (tid > 0) {
                    array['tickets'].push({'id': tid, 'an': a});
                }
            }

        }
    });

    array['datum'] = {};
    array['datum']['set'] = false;

    var dateele = WarenKorb.find('.tkdate');

    if (dateele.is('*') == true) {
        if(clear == true){
            dateele.val("");
            dateele.parents('.input_date_field').slideUp();
        } else {
            array['datum']['set'] = true;
            array['datum']['val'] = datum = dateele.val();
        }
    }


    array['zeit'] = {};
    array['zeit']['set'] = false;

    var timefield = WarenKorb.find('.input_time_field input:checked');
    if (timefield.is('*') == true) {
        if(clear == true){
            WarenKorb.find('.input_time_field').slideUp().find('.input_time_field .input_content').html("");
        } else {
            array['zeit']['set'] = true;
            array['zeit']['val'] = timefield.val();
        }
    }

    return array;
}

function wc_cartaddgroup_check(ele) {

    var load = wc_loaddiv();
    if (load) {
        wc_loaddiv(1);
    }

    if($.isNumeric(ele)){
        id = ele;
        var wctov = $('.wct.kat' + id);
    } else if(typeof ele === 'object') {
        var wctov = $(ele).parents('.wct');
        id = wctov.attr('data-kid');
    }

    wctov.find('.divload').show(0);
    tickets = get_wc_data(id);


    var dateele = wctov.find('.tkdate');
    var datum = "";
    if (dateele.is('*') == true) {

        datum = dateele.val();

    }

    var timefield = wctov.find('.input_time_field input:checked');
    var time = "";
    if (timefield.is('*') == true) {
        var time = timefield.val();
    }

    if (tickets['anzahl'] > 0) {
        if (((dateele.is('*') == true) && (datum != "")) || dateele.is('*') == false) {

            if (datum) {
                getdatum = '&da=' + datum;
            } else {

            }

            wc_show_button(wctov, 1);

        } else if ((dateele.is('*') == true) && (datum == "")) {

            dateele.parents('.input_date_field').slideDown();
            wc_show_button(wctov, 0);
            if (load) {
                wc_loaddiv(6);
            }
        }

    } else {

        dateele.parents('.input_date_field').slideUp();
        wc_show_button(wctov, 0);
    }

    wctov.find('.divload').hide(0);

    return true;
}
function wc_ask_time(id, times, message) {

    var inputfield = id.find('.input_time_field .input_content');
    var indexid =  id.attr('data-kid');
    if (times) {

        if (times.length > 0) {
            wc_loaddiv(6);
        } else {
            wc_loaddiv(4);
            var check = true;
        }

        inputfield.parent(".input_time_field").show();
        inputfield.html("").removeClass('col1 col2 col3 col4 col5').addClass('col' + times.length);

        times.forEach(function (element, index, array) {

            if (message == 'missing_time') {
                if (element.status == 1 && check) {
                    string = "<div class='btn-group' role='group'><input type='radio' checked class='wc_hidden checked' a id='wc_radio" + indexid + index + "' name='time' value='" + element.time + "'><label onclick='wc_cart_add_later(this)' class='fa fa-clock btn' for='wc_radio" + indexid + index + "'>" + element.time + "</label></div>";
                } else if (element.status == 1) {
                    string = "<div class='btn-group' role='group'><input type='radio' class='wc_hidden' id='wc_radio" + indexid + index + "' name='time' value='" + element.time + "'><label onclick='wc_cart_add_later(this)' class='fa fa-clock btn btn-default' for='wc_radio" + indexid + index + "'>" + element.time + "</label></div>";
                } else {
                    string = "<div class='btn-group' role='group'><input type='radio' class='wc_hidden readonly' c id='wc_radio" + indexid + index + "' name='time' value='" + element.time + "'><label class='fa fa-close btn' onclick='wc_cart_add_later(this)' for='wc_radio" + indexid + index + "'>" + element.time + "</label></div>";
                }
            } else {
                string = '<p><center><i class="fa fa-clock"></i> Öffnungszeit: ' + times[0].time + '</center></p><div class="ti-clear"></div>';
            }

            inputfield.append(string);
        });
        ;
    } else {
        inputfield.html("");
        wc_loaddiv(4);
    }
}

function checkForTime(ele, kid) {
    var ov = $('[name=datum' + kid + ']').parents('.wct');
    wc_loaddiv(5);
    $.ajax({
        cache: false,
        type: "GET",
        data: "kid=" + kid + "&da=" + ele,
        dataType: 'json',
        url: "/app_dev.php/warenkorb/rein_json"
    }).done(

        function (data) {

            if (data.success == true) {
                wc_show_button(ov, 1);
                wc_ask_time(ov, data.times, data.message);

            } else if (data.success == false) {

                if (data.times) {
                    wc_ask_time(ov, data.times, data.message);
                    wc_show_button(ov, 0);
                } else {
                    wc_show_button(ov, 1);
                    wc_ask_time(ov);
                    wc_loaddiv(4);
                }

            } else {

            }
        });
    ov.find('.tkdate').val(ele);
}
function wc_loaddiv(typ) {
    var div = $('#loaddiv');
    switch (typ) {
        case 1:
            $('.wct').addClass('wait');
            div.show(0).find('img').attr('src', '/images/icons/load-hct.gif').end().find('.well').hide(0).end().find('.wait').show(0).end();
            break;
        case 2:
            $('.wct').removeClass('wait');
            div.find('img').attr('src', '/images/icons/ready-hct.png').end().find('.well').hide(0).end().find('.ready').show(0).end().delay(1000).animate({opacity: 0}, 1000, function () {
                $(this).hide(0).css('opacity', 1);
            });
            break;
        case 3:
            $('.wct').removeClass('wait');
            div.find('img').attr('src', '/images/icons/abort-hct.jpg').end().find('.load, .ready, .check').hide(0).end().find('.abort').show(0).end().delay(1000).animate({opacity: 0}, 1000, function () {
                $(this).hide(0).css('opacity', 1);
            });
            break;
        case 4:
            $('.wct').removeClass('wait');
            div.hide(0);
            break;
        case 5:
            $('.wct').addClass('wait');
            div.show(0).find('img').attr('src', '/images/icons/load-hct.gif').end().find('.ready, .load, .abort, .date').hide(0).end().find('.check').show(0).end();
            break;
        case 6:
            $('.wct').removeClass('wait');
            div.find('img').attr('src', '/images/icons/load-hct.gif').show(0).end().find('.load, .abort, .check, .ready').hide(0).end().find('.date').show(0).end().delay(1000).animate({opacity: 0}, 1000, function () {
                $(this).hide(0).css('opacity', 1);
            });
            break;
        default:
            if (div.length > 0) {
                return true;
            } else {
                return false;
            }
            break;
    }
}

function wc_count() {
    var anza = 0;
    $('#mobilecart select.tinumber').each(function () {
        anza = anza + parseInt($(this).val());
    });
    $('#cartanzahl').html(anza + '<span class=icon-wc></span>');
}

$(document).ready(
    function () {

        if ($(".datepickerend").length > 0) {
            wc_cartoverview()
        }
    });

$(function () {
    var d = new Date();
    if ($(".datepicker").length > 0) {
        $(".datepicker").datepicker({
            altFormat: 'yy-mm-dd',
            numberOfMonths: 2,
            dateFormat: 'dd.mm.yy',
            minDate: d
        });
    }
    $('#ticketuebersicht').ready(function () {
        wc_cartoverview();
    });
    if ($(".datepickerin").length > 0) {
        $(".datepickerin").datepicker({
            altFormat: 'yy-mm-dd',
            numberOfMonths: 2,
            dateFormat: 'dd.mm.yy',
            minDate: d,
            beforeShowDay: $.datepicker.noWeekends
        });
    }
    if ($(".datepickerend").length > 0) {
        $(".datepickerend").datepicker({
            altFormat: 'yy-mm-dd',
            numberOfMonths: 2,
            dateFormat: 'dd.mm.yy',
            minDate: d,
            beforeShowDay: function (date) {
                var day = date.getDay();
                return [(day == 5 || day == 6), ''];
            }
        });
    }
    if ($(".datepickerweih").length > 0) {
        $(".datepickerweih").datepicker({
            altFormat: 'yy-mm-dd',
            numberOfMonths: 2,
            dateFormat: 'dd.mm.yy',
            minDate: new Date(2013, 10, 23),
            maxDate: new Date(2013, 11, 20),
            beforeShowDay: function (date) {
                var day = date.getDay();
                return [(day == 5 || day == 6), ''];
            }
        });
    }
});

function wc_show_button(ele, status) {


    button = ele.find('.hctwargroupinn');
    if (status == 1) {
        button.removeClass('uncl');
    } else {
        button.addClass('uncl');
    }

    return button;
}

function switchArten(ele){

    var element = $(ele);
    var aKArt= element.attr('data-akart');

    if(element.hasClass('transdiv')){
        element.removeClass('transdiv').find('.small-box-footer').html('ausblenden <i class="fa fa-arrow-circle-down"></i>');
        $('.art' + aKArt).slideDown('slow');
    } else {
        element.addClass('transdiv').find('.small-box-footer').html('einblenden <i class="fa fa-arrow-circle-up"></i>');
        $('.art' + aKArt).slideUp('slow');
    }

}
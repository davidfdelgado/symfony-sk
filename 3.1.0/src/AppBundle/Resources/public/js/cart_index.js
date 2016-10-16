function wc_cartref() {
    
    wc_cartoverview();

    $.ajax({
        cache: false,
        type: "GET",
        url: "/app_dev.php/warenkorb/index"
    }).done(function (datab, textStatus, jqXHR) {

        if(datab.html){
            $('#hctcart').html(datab.html);

            wc_anzahl = $('#wc_anzahl');
            if(wc_anzahl.is('*')){
                wc_anzahl.html(datab.warenkorb_size);
            }

        } else {
            $('#hctcart').html(datab);
        }
        return 3;

    });
}

function wc_cartoverview() {
    var tk = $("#ticketuebersicht");
    if(tk.is('*') == false) {
        return false
    }

    tk.addClass('loading');

    $.ajax({
        cache: false,
        type: "GET",
        url: "/app_dev.php/warenkorb/overview"
    }).done(function (datab, textStatus, jqXHR) {
        tk.html("").html(datab).removeClass('loading');

    });
    return 1;
}

function wc_cartcha(elem) {

    max_tk = 20;
    tkele = $(elem).parents('.tk');
    typ = $(elem).val();
    anzahlele = tkele.find('.ti_anzahl');
    anzahl = anzahlele.val();
    minus = tkele.find('.minus');
    plus = tkele.find('.plus');

    id = tkele.attr('data-wcid');

    if(typ == "+"){
        newanzahl = Math.min(parseInt(anzahl) + 1, max_tk);

        if(newanzahl > 0){
            minus.removeClass('uncl');
        }

        if(newanzahl < max_tk) {
            anzahlele.val(newanzahl);
            plus.removeClass('uncl');
        } else {
            anzahlele.val(newanzahl);
            plus.addClass('uncl');
        }

    } else if(typ == "-") {

        newanzahl = parseInt(anzahl) - 1;

        if(newanzahl < max_tk){
            plus.removeClass('uncl');
        }

        if(newanzahl > 0) {
            minus.removeClass('uncl');
            anzahlele.val(newanzahl);
        } else {
            minus.addClass('uncl');
        }

    }

    if( newanzahl ){
        waitTillRefresh(id, newanzahl);
    }

    return anzahl;
}

function wc_refresh(id, newanzahl){

    $.ajax({
        cache: false,
        type: "GET",
        data: "tid=" + id + "&an=" + newanzahl,
        url: "/app_dev.php/warenkorb/update"
    }).done(function () {
        wc_cartref()
    });
}

var timer;

function waitTillRefresh(a, b) {
    console.log(a);
    clearTimeout(timer);
    timer = setTimeout(function() {
        wc_refresh(a, b);
    }, 700);
}


function wc_cartdel(ele) {
    var tk = $(ele).parents('.tk');
    id = tk.attr('data-wcid');

    $('.loader').show();
    
    $.ajax({
        cache: false,
        type: "GET",
        data: "del=" + id,
        url: "/app_dev.php/warenkorb/rein_json"
    }).done(function (datac) {

        if(datac.success == true) {
            wc_cartref();
        }
    });
    
    return true;
}

$(document).ready(function () {
    wc_cartref();
});
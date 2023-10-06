var today = new Date();
var curHr = today.getHours();
if (curHr < 11) {
    $("#title_greet").html('Selamat Pagi,');
} else if (curHr >= 11 && curHr <= 15) {
    $("#title_greet").html('Selamat Siang,');
}else if (curHr >= 15 && curHr <= 19) {
    $("#title_greet").html('Selamat Sore,');
} else {
    $("#title_greet").html('Selamat Malam,');
}

function payment_content(cont){
    $('#address_content').hide();
    $('#payment_content').hide();
    $('#order_content').hide();
    $('#' + cont).show();
}

function validate_address(){
    let address = $('#address').val(),
    province = $('#province').val(),
    city = $('#city').val(),
    subdistrict= $('#subdistrict').val(),
    postcode= $('#postcode').val(),
    select_service= $('#select_service').val(),
    select_ekspedisi= $('#select_ekspedisi').val();

    if( address.length  > 0 && 
        province.length > 0 && 
        city.length > 0 && 
        subdistrict && 
        postcode.length > 0 &&
        select_service.length > 0 &&
        select_ekspedisi.length > 0) {
        payment_content('payment_content');
    }else{
        error_toastr('Lengkapi Data');
    }

}
function name_time()
{
    
}
function format_ribuan(nStr) {
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
}
toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "2000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};
function success_toastr(pesan){
    toastr.success(pesan, "Koperasi Bintang Laguboti");
}
function error_toastr(pesan){
    toastr.error(pesan, "Koperasi Bintang Laguboti");
}
function number_only(obj) {
    $('#' + obj).bind('keypress', function (event) {
        var regex = new RegExp("^[0-9]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });
}
function format_ribuan(nStr) {
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
}
function ribuan(obj) {
    $('#' + obj).keyup(function (event) {
        if (event.which >= 37 && event.which <= 40) return;
        // format number
        $(this).val(function (index, value) {
            return value
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        });
        var id = $(this).data("id-selector");
        var classs = $(this).data("class-selector");
        var value = $(this).val();
        var noCommas = value.replace(/,/g, "");
        $('#' + id).val(noCommas);
        $('.' + classs).val(noCommas);
    });
}
function obj_autosize(obj){
    autosize($('#' + obj));
}

function obj_time(obj){
    $("#" + obj).flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
    });
}

function obj_date_time(obj){
    $("#" + obj).flatpickr({
        dateFormat: "Y-m-d H:i",
        enableTime: true,
    });
}

function obj_date(obj){
    $("#" + obj).flatpickr({
        dateFormat: "Y-m-d",
    });
}
function obj_startdatenow(obj){
    $("#" + obj).flatpickr({
        dateFormat: "Y-m-d",
        minDate: "today"
    });
}
function obj_jstree(obj){
    $('#' + obj).jstree({
        "core" : {
            "themes" : {
                "responsive": false
            }
        },
        "types" : {
            "default" : {
                "icon" : "fa fa-folder text-warning"
            },
            "file" : {
                "icon" : "fa fa-file  text-warning"
            }
        },
        "plugins": ["types"]
    });
    
    // handle link clicks in tree nodes(support target="_blank" as well)
    $('#' + obj).on('select_node.jstree', function(e,data) {
        var link = $('#' + data.selected).find('a');
        if (link.attr("href") != "#" && link.attr("href") != "javascript:;" && link.attr("href") != "") {
            if (link.attr("target") == "_blank") {
                link.attr("href").target = "_blank";
            }
            document.location.href = link.attr("href");
            return false;
        }
    });
}
function obj_select(obj,title){
    $('#' + obj).select2({
        placeholder: title,
        language: {
            // You can find all of the options in the language files provided in the
            // build. They all must be functions that return the string that should be
            // displayed.
            "noResults": function(){
                return "Data Tidak ditemukan";
            },
            "inputTooShort": function () {
                return "Anda harus memasukkan setidaknya 1 karakter";
            }
        },
        width:'90%',
    });
}
function obj_select_ajax(obj,title,url){
    $('#' + obj).select2({
        placeholder: title,
        width:'90%',
        language: {
            // You can find all of the options in the language files provided in the
            // build. They all must be functions that return the string that should be
            // displayed.
            "noResults": function(){
                return "Data Tidak ditemukan";
            },
            "inputTooShort": function () {
                return "Anda harus memasukkan setidaknya 1 karakter";
            }
        },
        minimumInputLength: 1,
        ajax: {
            method:'POST',
            url: url,
            data: function (params) {
                var query = {
                    search: params.term
                }
                // Query parameters will be ?search=[term]&type=public
                return query;
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.title,
                            id: item.id
                        }
                    })
                };
            }
        }
    });
}
function obj_tagify(obj){
    new Tagify(obj);
}
function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
}
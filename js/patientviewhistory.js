//HistoryServiceAllmain();
loadhistory();
loadimages();
sumservice();
$(document).ready(function () {
    var service_id = $("#service_id").val();
    var height = $(window).height();
    var heightlayout = (height - 2);
    $("#layouts").layout({
        height: heightlayout
    });

    $(window).resize(function () {
        var height = $(window).height();
        var heightlayout = (height - 2);
        $("#layouts").layout({
            height: heightlayout
        });
    });

    $('#tt').tabs({
        border: false,
        onSelect: function (title, index) {
            if (index == 2) {
                loaddrug();
            } else if (index == 3) {
                loaddisease();
            }
        }
    });

    $("#popupaddservice").window({
        height: 400
    });

    $(".alert-bar").hide();

    $('#diaginsert').combobox({
        onChange: function (param) {
            getpricediag(param);
            //param.id = 2;
            //param.language = 'js';
        }
    });

    //ดึงข้อมูลยามาแสดง
    $('#druginsert').combobox({
        onChange: function (param) {
            getpricedrug(param);//ราคา
            getdetaildrug(param);//ข้อมูลยา
            //param.id = 2;
            //param.language = 'js';
        }
    });

});

function openpopupservicedetail() {
    $('#popupdetailservice').window('open');
    getdetailservice();
}

function getdetailservice() {
    var service_id = $("#service_id").val();
    var url = 'index.php?r=doctor/getdetailserviceview&service_id=' + service_id;
    $('#bodydetailservice').load(url);
}


/*Diag*/
function getpricediag(id) {
    var url = "index.php?r=patientdiag/getpricediag";
    var data = {id: id};
    $.post(url, data, function (datas) {
        //alert(datas);
        $('#pricediag').numberbox({
            value: datas
        });
    });
}

/*
 function loaddiag() {
 var url = "index.php?r=patientdiag/getdiag";
 var patient_id = $("#patient_id").val();
 var data = {patient_id: patient_id};
 
 $.post(url, data, function (result) {
 $("#result_diag").html(result);
 });
 }
 */

function openpopupservicediag() {
    $("#popupdetaildiag").window('open');
    loaddetaildiag();
}

function loaddetaildiag() {
    var service_id = $("#service_id").val();
    var url = 'index.php?r=patientdiag/getdetaildiagview&service_id=' + service_id;
    $('#bodydiagservice').load(url);
}

function deletediagservice(id) {
    var url = "index.php?r=patientdiag/deletediagservice";
    var data = {id: id};
    $.post(url, data, function (datas) {
        loaddetaildiag();
    });
}

function loaddrug() {
    var url = "index.php?r=patientdrug/getdrugview";
    var patient_id = $("#patient_id").val();
    var data = {patient_id: patient_id};

    $.post(url, data, function (result) {
        $("#result_drug").html(result);
    });
}


function loaddisease() {
    var url = "index.php?r=patientdisease/getdiseaseview";
    var patient_id = $("#patient_id").val();
    var data = {patient_id: patient_id};

    $.post(url, data, function (result) {
        $("#result_disease").html(result);
    });
}

/*CheckBody*/
function popupcheckbody(pid, name, lname) {
    $("#hradcheckbody").html("PID : " + pid + " ลูกค้า " + name + " " + lname);
    $("#popup_checkbody").modal();
    loadcheckbody();
}

function loadcheckbody() {
    var url = "index.php?r=checkbody/check";
    var patient_id = $("#patient_id").val();
    var data = {patient_id: patient_id};

    $.post(url, data, function (result) {
        $("#result_checkbody").html(result);
    });
}

function popuphistoryserviceall() {
    HistoryServiceAll();
    $("#popuphistoryall").modal();
}

function HistoryServiceAll() {
    var url = "index.php?r=historyservice/historyall";
    var patient_id = $("#patient_id").val();
    var data = {patient_id: patient_id};
    $.post(url, data, function (result) {
        $("#historyserviceall").html(result);
    });
}

function HistoryServiceAllmain() {
    var url = "index.php?r=historyservice/historyallmain";
    var patient_id = $("#patient_id").val();
    var data = {patient_id: patient_id};
    $.post(url, data, function (result) {
        $("#historyserviceallmain").html(result);
    });
}

function savediag() {
    var url = "index.php?r=PatientDiag/saveservicediag";
    var diagcode = $("#diaginsert").val();
    var diagprice = $("#pricediag").val();
    var service_id = $("#service_id").val();
    var patient_id = $("#patient_id").val();
    if (diagcode == "" || diagprice == "") {
        sweetAlert("Oops...", "กรอกข้อมูล * ไม่ครบ!", "error");
        return false;
    }

    var data = {
        patient_id: patient_id,
        diagcode: diagcode,
        diagprice: diagprice,
        service_id: service_id
    };

    $.post(url, data, function () {
        resetformdiag();
        Success();
        $("#popupadddiag").window('close');
    });
}

function resetformdiag() {
    $('#diaginsert').combobox({value: ''});
    $("#pricediag").numberbox({value: ''});
}

function saveserviceDetail() {
    var url = "index.php?r=doctor/saveservicedetail";
    var patient_id = $("#patient_id").val();
    var detail = $("#service_detail").val();
    var comment = $("#service_comment").val();
    var price = $("#service_price").val();
    var service_id = $("#service_id").val();
    if (detail == "" || price == "") {
        sweetAlert("Oops...", "กรอกข้อมูล * ไม่ครบ!", "error");
    } else {
        var data = {
            patient_id: patient_id,
            detail: detail,
            comment: comment,
            price: price,
            service_id: service_id
        };

        $.post(url, data, function () {
            resetserviceDetail();
            Success();
            $("#popupaddservice").window('close');
        });
    }
}

function resetserviceDetail() {
    $('#service_detail').textbox({value: ''});
    $('#service_comment').textbox({value: ''});
    $("#service_price").numberbox({value: ''});
}

function deletedetailservice(id) {
    var url = "index.php?r=doctor/deletedetailservice";
    var data = {id: id};
    $.post(url, data, function (datas) {
        getdetailservice();
    });
}

/*Drug Add*/
function getpricedrug(productid) {
    var url = "index.php?r=patientdrug/getpricedrug";
    var data = {productid: productid};
    $.post(url, data, function (datas) {
        //alert(datas);
        $('#pricedrug').numberbox({
            value: datas.price
        });
        $("#unit").html(datas.unit);
        $("#drug_number").numberbox({value: 1});
        calculatorDrug();
    }, 'json');
}

function getdetaildrug(productid) {
    var url = "index.php?r=patientdrug/getdetaildrug";
    var data = {productid: productid};
    $.post(url, data, function (datas) {
        $("#detaildrug").html(datas);
    });
}

function calculatorDrug() {
    var price = parseInt($('#pricedrug').val());
    var number = parseInt($('#drug_number').val());
    var total = (price * number);
    var totalprice = total.toFixed(2); // 1.24
    $("#pricedrugtotal").numberbox({value: totalprice});
}

function openpopupservicedrug() {
    $("#popupdetaildrug").window('open');
    loaddetaildrug();
}

function loaddetaildrug() {
    var service_id = $("#service_id").val();
    var url = 'index.php?r=patientdrug/getdetailservicedrugview&service_id=' + service_id;
    $('#bodydrugservice').load(url);
}

function resetserviceDrug() {
    $('#druginsert').combobox({value: ''});
    $('#drug_number').numberbox({value: ''});
    $('#pricedrug').numberbox({value: ''});
    $("#pricedrugtotal").numberbox({value: ''});
}

function saveDrug() {
    calculatorDrug();
    var url = "index.php?r=patientdrug/saveservicedrug";
    var druginsert = $('#druginsert').val();
    var drug_number = $('#drug_number').val();
    var pricedrug = $('#pricedrug').val();
    var pricedrugtotal = $("#pricedrugtotal").val();
    var patient_id = $("#patient_id").val();
    var service_id = $("#service_id").val();
    var data = {
        drug: druginsert,
        number: drug_number,
        price: pricedrug,
        total: pricedrugtotal,
        service_id: service_id,
        patient_id: patient_id
    };

    if (druginsert == "" || drug_number == "" || pricedrug == "" || pricedrugtotal == "") {
        sweetAlert("Oops...", "กรอกข้อมูล * ไม่ครบ!", "error");
        return false;
    }

    $.post(url, data, function (datas) {
        resetserviceDrug();
        $("#popupadddrug").window('close');
        Success();
    });

}


function openpopupservicedetaildrug() {
    $("#popupdetaildrug").window('open');
    loaddetaildrug();
}

function loaddetaildrug() {
    var service_id = $("#service_id").val();
    var url = 'index.php?r=patientdrug/getdetailservicedrugview&service_id=' + service_id;
    $('#bodydrugservice').load(url);
}

function deletedrugservice(id) {
    var url = "index.php?r=patientdrug/deletedrugservice";
    var data = {id: id};
    $.post(url, data, function (datas) {
        loaddetaildrug();
    });
}

function saveetc() {
    var url = "index.php?r=doctor/saveetc";
    var detail_etc = $('#detail_etc').val();
    var price_etc = $('#price_etc').val();
    var patient_id = $("#patient_id").val();
    var service_id = $("#service_id").val();
    var data = {
        detail_etc: detail_etc,
        price_etc: price_etc,
        service_id: service_id,
        patient_id: patient_id
    };
    
    if (detail_etc == "" || price_etc == "") {
        sweetAlert("Oops...", "กรอกข้อมูล * ไม่ครบ!", "error");
        return false;
    }

    $.post(url, data, function (datas) {
        resetserviceDrug();
        $("#popupaddetc").window('close');
        Success();
    });
}

function openpopupservicedetailetc() {
    $("#popupdetailetc").window('open');
    loaddetailetc();
}

function loaddetailetc() {
    var service_id = $("#service_id").val();
    var url = 'index.php?r=doctor/getdetailserviceetcview&service_id=' + service_id;
    $('#bodyetcservice').load(url);
}

function deleteEtcService(id) {
    var url = "index.php?r=doctor/deleteetcservice";
    var data = {id: id};
    $.post(url, data, function (datas) {
        loaddetailetc();
    });
}

function loadhistory() {
        var patient_id = $("#patient_id").val();
        var url = "index.php?r=patient/history";
        var data = {patient_id: patient_id};
        $.post(url, data, function (result) {
            $("#history").html(result);
        });
    }



function sumservice() {
        var service_id = $("#service_id").val();
        var url = "index.php?r=service/sumservice";
        var data = {service_id: service_id};
        $.post(url, data, function (result) {
            $("#sumservice").html(result);
        });
    }


/*เมื่อทำรายการเสร็จ*/
function Success() {
    $.messager.show({
        title: 'Alert',
        msg: '<i class="fa fa-check"></i> บันทึกข้อมูลสำเร็จ..',
        showType: 'fade',
        style: {
            right: '',
            bottom: ''
        }
    });
}

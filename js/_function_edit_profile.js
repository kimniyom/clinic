// JavaScript Document
// Author : kimniyom
// Date : 08/09/2556
// Time : 14.23.00

/******************************************* เช็คตัวเลข *************************************************/

/********************************************* Function เช็คค่าว่างหน้า From register *****************************/
function check_from() {

    with (register) {
        if (email.value == '') {
            email.focus();
            return false;
        } else if (alias.value == '') {
            alias.focus();
            return false;
        } else if (sex.value == '') {
            alert("ยังไม่ได้เลือกเพศ");
            return false;
        } else if (tel.value == '' || tel.value.length != '10') {
            tel.focus();
            return false;
        }
    }
}

				
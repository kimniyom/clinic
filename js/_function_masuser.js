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
        } else if (password.value == '') {
            password.focus();
            return false;
        } else if (name.value == '') {
            name.focus();
            return false;
        } else if (lname.value == '') {
            lname.focus();
            return false;
        } else if (sex.value == '') {
            alert("ยังไม่ได้เลือกเพศ");
            return false;
        } else if (tel.value == '' || tel.value.length != '10') {
            tel.focus();
            return false;
        } else if(walking.value == ''){
            walking.focus();
            return false;
        }
        
        if(login.checked == true){
            document.getElementById("login").value = "0";
        } else {
            document.getElementById("login").value = "1";
        }
        
        
    }
}

				
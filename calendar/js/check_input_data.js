function login_check() {
    if (document.loginForm.username.value == "") {
        swal("Error!", "กรุณากรอกชื่อผู้ใช้!", "warning");
        document.loginForm.username.focus();
        return false;
    } else if (document.loginForm.passwd.value == "") {
        swal("Error!", "กรุณากรอกรหัสผาน!", "warning");
        document.loginForm.passwd.focus();
        return false;
    } else if (document.loginForm.security_code.value == "") {
        swal("Error!", "กรุณากรอกรหัสยืนยัน!", "warning");
        document.loginForm.security_code.focus();
        return false;
    } else {
        sendpost();
        return false;
    }
}

function user_check() {
    if (document.user_Form.member_name.value == "") {
        swal("Error!", "กรุณากรอกชื่อผู้ใช้!", "warning");
        document.user_Form.member_name.focus();
        return false;
    } else if (document.user_Form.member_loginname.value == "") {
        swal("Error!", "กรุณากรอกรหัสผาน!", "warning");
        document.user_Form.member_loginname.focus();
        return false;
    } else if (document.user_Form.member_password.value == "") {
        swal("Error!", "กรุณากรอกรหัสยืนยัน!", "warning");
        document.user_Form.member_password.focus();
        return false;
    }
}

function manager_check() {
    if (document.myForm.manager_pname.value == "") {
        swal("Error!", "กรุณากรอกข้อมูลให้ครบด้วย!", "warning");
        document.myForm.manager_pname.focus();
        return false;
    } else if (document.myForm.manager_name.value == "") {
        swal("Error!", "กรุณากรอกข้อมูลให้ครบด้วย!", "warning");
        document.myForm.manager_name.focus();
        return false;
    } else if (document.myForm.manager_sname.value == "") {
        swal("Error!", "กรุณากรอกข้อมูลให้ครบด้วย!", "warning");
        document.myForm.manager_sname.focus();
        return false;
    } else if (document.myForm.manager_pos.value == "") {
        swal("Error!", "กรุณากรอกข้อมูลให้ครบด้วย!", "warning");
        document.myForm.manager_pos.focus();
        return false;
    } else if (document.myForm.secretary_id.value == "") {
        swal("Error!", "กรุณากรอกข้อมูลให้ครบด้วย!", "warning");
        document.myForm.secretary_id.focus();
        return false;
    }

}


function mcalendar_check() {
    var stH = document.myForm.stH.value;
    var stM = document.myForm.stM.value;

    var enH = document.myForm.enH.value;
    var enM = document.myForm.enM.value;

    if (stH > 0)
        sttime = (stH * 60) + (stM * 1);
    else sttime = stM;

    if (enH > 0)
        entime = (enH * 60) + (enM * 1);
    else entime = enM;

    if (document.myForm.manager_id.value == "") {
        swal("Error!", "กรุณากรอกข้อมูลให้ครบด้วย!", "warning");
        document.myForm.manager_id.focus();
        return false;
    } else if (document.myForm.calendar_stdate.value == "") {
        swal("Error!", "กรุณากรอกข้อมูลให้ครบด้วย!", "warning");
        document.myForm.calendar_stdate.focus();
        return false;
    } else if (sttime > 10000) {
        alert("Error : เวลาไมีถูกต้อง !");
        document.myForm.stH.focus();
        return false;
    } else if (document.myForm.calendar_title.value == "") {
        swal("Error!", "กรุณากรอกข้อมูลให้ครบด้วย!", "warning");
        document.myForm.calendar_title.focus();
        return false;
    } else if (document.myForm.calendar_detail.value == "") {
        swal("Error!", "กรุณากรอกข้อมูลให้ครบด้วย!", "warning");
        document.myForm.calendar_detail.focus();
        return false;
    } else if (document.myForm.calendar_location.value == "") {
        swal("Error!", "กรุณากรอกข้อมูลให้ครบด้วย!", "warning");
        document.myForm.calendar_location.focus();
        return false;
    } else if (document.myForm.calendar_own.value == "") {
        swal("Error!", "กรุณากรอกข้อมูลให้ครบด้วย!", "warning");
        document.myForm.calendar_own.focus();
        return false;
    }
}
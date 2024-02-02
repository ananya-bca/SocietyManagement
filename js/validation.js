// Form validation file using JavaScript

function login_validation(){
    let valid=true;

    let mail =document.getElementById('mail').value;
    let pwd = document.getElementById('pwd').value;
    
    if(mail==''){
        valid = false;
        document.getElementById('mail_err').innerHTML="* Please enter your e-mail";
    }
    // else{
    //     document.getElementById('mail_err').innerHTML='';
    // }

    if(pwd==''){
        valid = false;
        document.getElementById('pwd_err').innerHTML="* Please enter your password";
    }
    // else{
    //     document.getElementById('pwd_err').innerHTML='';
    // }

    return valid;
}


/* Registration form validation */
function valid_reg() {
    let valid = true;

    let member_name = document.getElementById('member_name').value;
    let email = document.getElementById('email').value;
    let contact = document.getElementById('contact').value;
    let pwd = document.getElementById('pwd').value;
    let wing = document.getElementById('wing').value;

    // 1. Member Name Validation
    let nameRegex = /^[a-zA-Z]+$/;
    if (member_name === '' || !nameRegex.test(member_name) || member_name.length < 5) {
        valid = false;
        document.getElementById('name_err').innerHTML = "* Please enter a valid name with at least 5 characters";
    } else {
        document.getElementById('name_err').innerHTML = '';
    }

    // 2. Contact Number Validation
    let contactRegex = /^[0-9]+$/;
    if (contact === '' || !contactRegex.test(contact) || contact.length !== 10) {
        valid = false;
        document.getElementById('contact_err').innerHTML = "* Please enter a valid 10-digit phone number";
    } else {
        document.getElementById('contact_err').innerHTML = '';
    }

    // 3. Email Validation
    let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email === '' || !emailRegex.test(email)) {
        valid = false;
        document.getElementById('mail_err').innerHTML = "* Please enter a valid email address";
    } else {
        document.getElementById('mail_err').innerHTML = '';
    }

    // 4. Password Validation
    let passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/;
    if (pwd === '' || !passwordRegex.test(pwd)) {
        valid = false;
        document.getElementById('pwd_err').innerHTML = "* please create a strong password with A-Z, a-z, 0-9 & symbols.";
    } else {
        document.getElementById('pwd_err').innerHTML = '';
    }

    if (!/^[A-Z]+$/.test(wing)) {
        document.getElementById('wing_err').innerHTML = "* Only capital letters are allowed";
        valid = false;
    }

    return valid;
}

function flat() {
    let valid = true;
    let wing = document.getElementById('wing').value;
    let flat_num = document.getElementById('flat_number').value;
    let flat_floor = document.getElementById('flat_floor').value;

    if (wing === 'dis' || wing === '') {
        document.getElementById('wing_err').innerHTML = "* Please select your wing";
        valid = false;
    }    
    if (wing === '') {
        document.getElementById('wing_err').innerHTML = "* Please select your wing";
        valid = false;
    }
    if (flat_num === '') {
        document.getElementById('flat_err').innerHTML = "* Please enter flat number";
        valid = false;
    }
    if (flat_floor === '') {
        document.getElementById('floor_err').innerHTML = "* Please enter floor number";
        valid = false;
    }
    return valid;
}

function wng() {
    let valid = true;
    let wingVal = document.getElementById('wing').value;

    if (wingVal === '') {
        document.getElementById('wing_err').innerHTML = "* Please enter wing";
        valid = false;
    } else {
        // Check if the value consists only of capital letters
        if (!/^[A-Z]+$/.test(wingVal)) {
            document.getElementById('wing_err').innerHTML = "* Only capital letters are allowed";
            valid = false;
        }
    }
    return valid;
}


function member() {
    let valid = true;
    let member_name = document.getElementById('member_name').value;
    let email = document.getElementById('email').value;
    let contact = document.getElementById('contact').value;
    let wing = document.getElementById('wing').value;
    let flat = document.getElementById('flat_number').value;
    let floor = document.getElementById('flat_floor').value; // Corrected ID
    let dt = document.getElementById('date').value;

    let nameRegex = /^[a-zA-Z]+$/;
    if (member_name === '' || !nameRegex.test(member_name) || member_name.length < 5) {
        valid = false;
        document.getElementById('name_err').innerHTML = "* Please enter a valid name with at least 5 characters";
    } else {
        document.getElementById('name_err').innerHTML = '';
    }

    let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email === '' || !emailRegex.test(email)) {
        valid = false;
        document.getElementById('mail_err').innerHTML = "* Please enter a valid email address";
    } else {
        document.getElementById('mail_err').innerHTML = '';
    }

    let contactRegex = /^[0-9]+$/;
    if (contact === '' || !contactRegex.test(contact) || contact.length !== 10) {
        valid = false;
        document.getElementById('contact_err').innerHTML = "* Please enter a valid 10-digit phone number";
    } else {
        document.getElementById('contact_err').innerHTML = '';
    }

    if (wing === 'dis' || wing === '') {
        document.getElementById('wing_err').innerHTML = "* Please select your wing";
        valid = false;
    } else {
        document.getElementById('wing_err').innerHTML = '';
    }

    if (flat === '' || !/^[0-9]+$/.test(flat)) {
        document.getElementById('flat_err').innerHTML = "* Please enter a valid flat number";
        valid = false;
    } else {
        document.getElementById('flat_err').innerHTML = '';
    }

    if (floor === '' || !/^[0-9]+$/.test(floor)) {
        document.getElementById('floor_err').innerHTML = "* Please enter a valid floor number";
        valid = false;
    } else {
        document.getElementById('floor_err').innerHTML = '';
    }

    if (dt === '') {
        document.getElementById('date_err').innerHTML = "* Please enter date";
        valid = false;
    } else {
        document.getElementById('date_err').innerHTML = '';
    }

    return valid;
}
// function bills(){
//     let valid = true;
//     let id = document.getElementById('member_id').value;
//     let bill_type = document.getElementById('bill_type').value;
//     let charge = document.getElementById('charge').value;

//     if (id === '' || !/^[0-9]+$/.test(id)) {
//         document.getElementById('id_err').innerHTML = "* Please enter a valid id";
//         valid = false;
//     } else {
//         document.getElementById('id_err').innerHTML = '';
//     }

//     if(bill_type == ''){
//         document.getElementById('bill_err').innerHTML = "* Please enter bill type";
//         valid = false;
//     }else {
//         document.getElementById('bill_err').innerHTML = '';
//     }

//     if (charge === '' || !/^[0-9]+$/.test(charge)) {
//         document.getElementById('charge_err').innerHTML = "* Please enter a valid charge of bill";
//         valid = false;
//     } else {
//         document.getElementById('charge_err').innerHTML = '';
//     }
//     return valid;
// }

function notice() {
    let valid = true;

    let not_name = document.getElementById('not_name').value;
    let not_sub = document.getElementById('not_sub').value;
    let notice_type = document.getElementById('notice_type').value;
    let member_id = document.getElementById('member_id').value;
    let dt = document.getElementById('dt').value;
    let msg = document.getElementById('msg').value;

    // 1. Notice Name Validation
    if (not_name === '' || not_name.length < 5) {
        valid = false;
        document.getElementById('not_name_err').innerHTML = "* Please enter a valid notice name with at least 5 characters";
    } else {
        document.getElementById('not_name_err').innerHTML = '';
    }

    // 2. Subject Validation
    if (not_sub === '' || not_sub.length < 5) {
        valid = false;
        document.getElementById('not_sub_err').innerHTML = "* Please enter a valid subject with at least 5 characters";
    } else {
        document.getElementById('not_sub_err').innerHTML = '';
    }

    // 3. Notice Type Validation
    if (notice_type === '' || (notice_type === 'Particular_member' && member_id === '')) {
        valid = false;
        document.getElementById('notice_type_err').innerHTML = "* Please select a valid notice type and provide member ID if needed";
    } else {
        document.getElementById('notice_type_err').innerHTML = '';
    }

    // 4. Date Validation (Optional)
    // You can add date validation if needed

    // 5. Message Validation
    if (msg === '' || msg.length < 20 || msg.length > 200) {
        valid = false;
        document.getElementById('msg_err').innerHTML = "* Please enter a message between 20 and 200 characters";
    } else {
        document.getElementById('msg_err').innerHTML = '';
    }

    return valid;
}

function visitor() {
    let name = document.getElementById("vis_name").value;
    let contact = document.getElementById("vis_contact").value;
    let wing = document.getElementById("vis_wing").value;
    let flat = document.getElementById("vis_flat").value;
    let floor = document.getElementById("vis_floor").value;

    let valid = true;

    let nameRegex = /^[a-zA-Z]+$/;
    if (name === '' || !nameRegex.test(name) || name.length < 5) {
        valid = false;
        document.getElementById('name_err').innerHTML = "* Please enter a valid name with at least 5 characters";
    } else {
        document.getElementById('name_err').innerHTML = '';
    }

    let contactRegex = /^[0-9]+$/;
    if (contact === '' || !contactRegex.test(contact) || contact.length !== 10) {
        valid = false;
        document.getElementById('contact_err').innerHTML = "* Please enter a valid 10-digit phone number";
    } else {
        document.getElementById('contact_err').innerHTML = '';
    }

    if (wing === 'dis' || wing === '') {
        document.getElementById('wing_err').innerHTML = "* Please select your wing";
        valid = false;
    } else {
        document.getElementById('wing_err').innerHTML = '';
    }
    if (flat === '' || !/^[0-9]+$/.test(flat)) {
        document.getElementById('flat_err').innerHTML = "* Please enter a valid flat number";
        valid = false;
    } else {
        document.getElementById('flat_err').innerHTML = '';
    }

    if (floor === '' || !/^[0-9]+$/.test(floor)) {
        document.getElementById('floor_err').innerHTML = "* Please enter a valid floor number";
        valid = false;
    } else {
        document.getElementById('floor_err').innerHTML = '';
    }

    return valid;
}

function complain() {
    let sub = document.getElementById("sub").value;
    let msg = document.getElementById("msg").value;

    let valid = true;

    if (sub === '' || sub.length < 5) {
        valid = false;
        document.getElementById('sub_err').innerHTML = "* Please enter a valid subject with at least 5 characters";
    } else {
        document.getElementById('sub_err').innerHTML = '';
    }

    if (msg === '' || msg.length < 20 || msg.length > 200) {
        valid = false;
        document.getElementById('msg_err').innerHTML = "* Please enter a message between 20 and 200 characters";
    } else {
        document.getElementById('msg_err').innerHTML = '';
    }
    
    return valid;
}

function change_pwd() {
    let valid = true;
    let newPwd = document.getElementById("newpwd").value;
    let confirmPwd = document.getElementById("confirmpwd").value;

    let passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/;
    if (newPwd === '' || !passwordRegex.test(newPwd)) {
        valid = false;
        document.getElementById('newPwd_err').innerHTML = "* please create a strong password with A-Z, a-z, 0-9 & symbols.";
    } else {
        document.getElementById('newPwd_err').innerHTML = '';
    }

    if(confirmPwd != newPwd){
        valid = false;
        document.getElementById("confirmPwd_err").innerHTML = "Password not match";
    }
    else{
        document.getElementById("confirmPwd_err").innerHTML = '';
    }
    return valid;
}

function edit_ac() {
    let valid = true;
    let member_name = document.getElementById("member_name").value;
    let email = document.getElementById("email").value;
    let contact = document.getElementById("contact").value;

    let nameRegex = /^[a-zA-Z]+$/;
    if (member_name === '' || !nameRegex.test(member_name) || member_name.length < 3) {
        valid = false;
        document.getElementById('name_err').innerHTML = "* Please enter a valid name with at least 5 characters";
    } else {
        document.getElementById('name_err').innerHTML = '';
    }

    // 2. Contact Number Validation
    let contactRegex = /^[0-9]+$/;
    if (contact === '' || !contactRegex.test(contact) || contact.length !== 10) {
        valid = false;
        document.getElementById('contact_err').innerHTML = "* Please enter a valid 10-digit phone number";
    } else {
        document.getElementById('contact_err').innerHTML = '';
    }

    // 3. Email Validation
    let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email === '' || !emailRegex.test(email)) {
        valid = false;
        document.getElementById('mail_err').innerHTML = "* Please enter a valid email address";
    } else {
        document.getElementById('mail_err').innerHTML = '';
    }

    return valid;

}

function contact_us(){
    let valid = true;
    let name = document.getElementById("name").value;
    let email = document.getElementById("email").value;
    let contact = document.getElementById("contact").value;
    let msg = document.getElementById("msg").value;

    let nameRegex = /^[a-zA-Z]+$/;
    if (name === '' || !nameRegex.test(name) || name.length < 5) {
        valid = false;
        document.getElementById('name_err').innerHTML = "* Please enter a valid name with at least 5 characters";
    } else {
        document.getElementById('name_err').innerHTML = '';
    }

    // 2. Contact Number Validation
    // let contactRegex = /^[0-9]+$/;
    if (contact === '' || contact.length !== 10) {
        valid = false;
        document.getElementById('contact_err').innerHTML = "* Please enter a valid 10-digit phone number";
    } else {
        document.getElementById('contact_err').innerHTML = '';
    }


    // 3. Email Validation
    let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email === '' || !emailRegex.test(email)) {
        valid = false;
        document.getElementById('mail_err').innerHTML = "* Please enter a valid email address";
    } else {
        document.getElementById('mail_err').innerHTML = '';
    }

    if (msg === '' || msg.length < 20 || msg.length > 200) {
        valid = false;
        document.getElementById('msg_err').innerHTML = "* Please enter a message between 20 and 200 characters";
    } else {
        document.getElementById('msg_err').innerHTML = '';
    }
    
    return valid;
}

function report() {
    let valid = true;

    let month = document.getElementById("month").value;
    let status = document.getElementById("status").value;

    if (status === 'dis' || status === '') {
        document.getElementById('status_err').innerHTML = "* Please select status";
        valid = false;
    } else {
        document.getElementById('status_err').innerHTML = '';
    }

    if (month === '') {
        document.getElementById('month_err').innerHTML = "* Please enter month";
        valid = false;
    } else {
        document.getElementById('month_err').innerHTML = '';
    }

    return valid;

}
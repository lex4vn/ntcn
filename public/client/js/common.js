function r_forcus() {
    document.getElementById("txtemail").value = '';
    document.getElementById("txtemail").setAttribute('style', 'color:#000; font-style:normal');
}
function r_blur() {
    if (document.getElementById("txtemail").value == '') {
        document.getElementById("txtemail").value = 'Nhập email để nhận tin miễn phí';
        document.getElementById("txtemail").removeAttribute('style');
    }
}
function subscribe_newsletter(){
    var email = document.getElementById('txtemail').value;
    if(email.length > 3){
        $.post(uri_root+"nhan-tin-mien-phi.html", {
            email:email
        }, function(data) {
            if(data=='success') {
                alert("Quý khách đã đăng ký thành công");
            }
            else if(data=='exist'){
                alert("Email này đã tồn tại");
            }
            else {
                alert('Địa chỉ email không hợp lệ');
            }

        });
    }else{
        alert('Vui lòng nhập địa chỉ email');
    }
}
function do_search() { var s = document.getElementById('txtSearch').value; if (s != '') window.location = uri_root+'tim-kiem.html?s=' + s; return false; } function killEnter(evt) { if (evt.keyCode == 13 || evt.which == 13) { do_search(); evt.preventDefault(); } return true; } function s_forcus() { document.getElementById("txtSearch").value = ''; } function s_blur() { if (document.getElementById("txtSearch").value == '') { document.getElementById("txtSearch").value = 'Tìm kiếm'; } }
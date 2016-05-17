$(document).ready(function() {
    if (typeof $.fn.iCheck !== 'undefined') {
        $('input').iCheck({
            checkboxClass: 'icheckbox_minimal-green',
            radioClass: 'iradio_minimal-green',
            increaseArea: '20%' // optional
        });
    }
});

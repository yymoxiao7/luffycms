$(document).ready(function() {
    if (typeof $.fn.iCheck !== 'undefined') {
        $('input').iCheck({
            checkboxClass: 'icheckbox_minimal-green',
            radioClass: 'iradio_minimal-green',
            increaseArea: '20%' // optional
        });
    }

    $('.delete').bind('click', function(event) {
        event.preventDefault();
        var $this = $(this);
        bootbox.confirm({
            size: 'small',
            message: "确认删除这条数据吗?",
            callback: function(result) {
                if(result == true){
                    $.ajax({
                            url: $this.attr('href'),
                            type: 'post',
                            dataType: 'json',
                        })
                        .done($.ajaxDoneResult)
                        .fail($.ajaxFailResult);
                }
            }
        });
    });
    // 日期
    if (typeof $.fn.datetimepicker !== 'undefined') {
        $('input.date').datetimepicker({
            format:'yyyy-mm-dd',
            language:'zh-CN',
            autoclose:true,
            minView:'month',
        });
    }

    if (typeof $.fn.luffyuploadpic !== 'undefined') {
        $("img.upload").luffyuploadpic();
    }
});

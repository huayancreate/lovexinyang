JuiDialog = {
    dialog: function (divId, title, url, fromId, gridId) {   //加载页面保存与修改操作
        JuiDialog.getPage(divId, url);
        $("#" + divId).dialog({
            title: title,
            buttons: {
                '保存': function () {
                    JuiDialog.save(url, fromId, divId, gridId);
                },
                "取消": function () {
                    $("#" + divId).empty();
                    $(this).dialog('close');
                }
            },
            close: function () {
                $("#" + divId).empty();
                $("#" + divId).dialog("close");
            }
        });
        JuiDialog.show(divId);
    },
    dialogView: function (divId, title, url) {   //加载页面并弹出展示
        JuiDialog.getPage(divId, url);
        $("#" + divId).dialog({
            title: title,
            buttons: [
                {
                    text: "关闭",
                    "class": 'btn btn-default',
                    click: function () {
                        $(this).dialog('close');
                        $("#" + divId).empty();
                    }
                }
            ],
            close: function () {
                $("#" + divId).empty();
                $("#" + divId).dialog("close");
            }
        });
        JuiDialog.show(divId);
    },
    show: function (divId) {    //打开弹出框
        $("#" + divId).dialog("open");
    },
    save: function (url, fromId, divId, gridId) {  //ajax POST 提交
        $.ajax({
            cache: true,
            type: "POST",
            url: "index.php?r=" + url,
            dataType: "json",
            data: $('#' + fromId).serialize(),
            async: false,
            error: function (request) {
                alert("Connection error");
            },
            success: function (data) {
                $("#" + divId).empty();
                $("#" + divId).dialog('close');
                $.pjax.reload({container: '#' + gridId});
            }
        });
    },
    getPage: function (divId, url) {   //加载页面填充div
        $.ajax({
            type: "get",
            url: "index.php?r=" + url,
            success: function (data) {
                $("#" + divId).html(data);
            }
        });
    },
    del: function (url, gridId) {   //删除操作
        $.ajax({
            type: "POST",
            url: "index.php?r=" + url,
            success: function (data) {
                $.pjax.reload({container: '#' + gridId});
            }
        });
    },

    showDialog: function (divId, title, pageUrl, submitUrl, fromId, gridId) {
        JuiDialog.getPage(divId, pageUrl);
        $("#" + divId).dialog({
            title: title,
            buttons: [
                {
                    text: "保存",
                    "class": 'btn btn-success',
                    click: function () {
                        JuiDialog.save(submitUrl, fromId, divId, gridId);
                    }
                },
                {
                    text: "取消",
                    "class": 'btn btn-danger',
                    click: function () {
                        $("#" + divId).empty();
                        $(this).dialog('close');
                    }
                }
            ]
        });
        JuiDialog.show(divId);
    }
};
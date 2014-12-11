/**
 * Created by liuweiisme on 2014-12-09.
 */
// plugin definitio
jQuery.showMap = function (id, mapUrl, valueId) {
    $('#' + id).iframeDialog({
        id: 'mapFrame',
        url: mapUrl,
        scrolling: 'no',
        /* jquery UI Dialog options */
        title: '地图',
        modal: true,
        resizable: true,
        width: 550,
        height: 520,
        close: function (event, ui) {
            var result = $("#iframeDialogMap").contents().find("#result").html();
            $("#" + valueId).html(result);
        }
    });
};
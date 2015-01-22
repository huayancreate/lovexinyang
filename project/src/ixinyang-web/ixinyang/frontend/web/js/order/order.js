/**
 * Created by pan on 2015/1/12.
 */
/**
 * Created by pan on 2015/1/10.
 */
define('order/order', function (a, b, c) {
    var sdiv,abuy,aadd,acollent,
        m = function (a) {
            this.initDom();
            this.initEnvent()
        };
    m.prototype = {
        initDom: function () {
            sdiv = $('#subdiv'),
                abuy = sdiv.find('a.oreder_btn'),
                aadd = sdiv.find('a.chartcar_btn'),
                acollent = sdiv.find('a.shouchang_btn');
        },
        initEnvent: function (a) {
            abuy.bind('click',function(){
                if(sdiv.find('#number').val()>=1){
                    var href = BASEURL  +  '/index.php?r=order/confirm&number='+sdiv.find('#number').val()
                    href += '&goodsID='+$(this).attr('data-value');
                    $(this).attr("href",href);
                }
            });
        }
    };
    var n = null;
    m.init = function (a) {
        return null == n && (n = new m(a)),
            n
    },c.exports = m
})
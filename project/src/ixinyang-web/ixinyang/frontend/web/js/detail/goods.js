/**
 * Created by pan on 2015/1/10.
 */
var  abar = $('.right_title'),
barheight = abar.offset().top,
bodyWidth = $('body').width();
$(window).on('scroll', function () {
    sTop = $(window).scrollTop();
    if (sTop >= barheight) {
        if (bodyWidth >= 1250)
            abar.addClass('right_title_scorll'),
                add_target_class(abar.find('ul a'), $(window).scrollTop());
    } else
        abar.removeClass('right_title_scorll'),abar.find('ul a:first-child').addClass('first').siblings().removeClass('first');

});

function add_target_class(a, b) {
    for (var c = this.get_href(a), d = 0; d < c.length; d++) {
        var e = c[d].top-80;
        if (d < c.length - 1) var f = c[d + 1].top;
        d === c.length - 1 ?
            (f = c[d].top-80, b > f ? a.eq(d).addClass('first').siblings().removeClass('first') : '')
            : b > e && f > b ? a.eq(d).addClass('first').siblings().removeClass('first')  : ''
    }
}

function get_href(abar) {
    var a = [];
    return abar.each(function () {
        var b,
            c = $(this),
            d = c.attr('href');
        d.indexOf('#') >= 0 && ( b = $(d).offset().top, a.push({
            obj: d,
            top: b
        }) )
    }),a
}

define('cartBtn', function (a, b, c) {
    var goto_cart = {
        goto_cart_api: function (a) {
            window.Ixy.app.iBar.addCart(a)
        },
        get_sku_json: function (a) { // 获取物品多型号的列表
            var b,
                c = this;
            b = a.attr('hashid'),
                $.getJSON(RM_SITE_MAIN_WEBBASEURL + 'i/deal/sku?hash_id=' + b + '&callback=?', null, function (b) {
                    var b = $.parseJSON(b);
                    if (1 === b.length) {
                        var d,
                            e;
                        d = b[0].sku_no,
                            a.attr('sku_no', d),
                            e = c.get_cart_info(a),
                            c.goto_cart_api(e)
                    } else if (b.length > 1) {
                        var f,
                            g = '';
                        $.each(b, function (a) {
                            var c = b[a],
                                d = c.sku_no,
                                e = c.attribute_name;
                            g += '<li><a href="javascript:;" sku_no="' + d + '">' + e + '</a></li>'
                        }),
                            f = '<ul class="sku_list">' + g + '</ul>',
                            a.after(f).fadeIn()
                    }
                    a.attr('loaded', 'true')
                })
        },
        get_cart_info: function (a) {  // 获取需要加入购物车的物品信息
            var b,
                c = a.parents('.bt_line'),
                d = a.parents('.subpage_top').find('.subpage_top_imgdiv img').attr('src'),  // 商品图片
                e = a.attr('sku_no'),
                f = a.parents('.bt_line').attr('data-value') || a.parents('.sku_list').prev('.gotocart_btn').attr('hashid'),
                g = ''; //getUrlArgs('from');
            return b = {
                elem: c,
                img: d,
                sku: e,
                gid: f,
                num: 1,
                from: g,
                which_cart: 'all'
            }
        },
        init: function (a) {
            var b = this;
            $(a.parent).delegate(a.self, 'click', function (a) {  // 为加入购物车按钮绑定click属性
                var c = $(this);
                a.preventDefault();
                var e = b.get_cart_info(c);
                b.goto_cart_api(e);
            })
        }
    };
    c.exports = goto_cart
}),
    define('detail/goods',['cartBtn'], function (a, b, c) {
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
                        href += '&goodsID='+$(this).parents('.bt_line').attr('data-value');
                        $(this).attr("href",href);
                    }
                });
            }
        };
        var n = null;
        m.init = function (a) {
            return null == n && (n = new m(a)),
                n
        },m.intCartBtn = function (c) {
            a('cartBtn').init(c);
        },c.exports = m
    })
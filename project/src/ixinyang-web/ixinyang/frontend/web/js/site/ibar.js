define('ibar-faq', function (a, b, c) {
    'use strict';
    var d = '<div class="dialog_ser"><div class="faq_title"><span class="title">请您选择咨询类型</span><span class="close"><img class="close_ser" src="http://chat.jumei.com/images/ser_close.jpg"></span></div><div class="faq_content" id="faq_content"></div></div>',
        e = $(d),
        f = {
            manager: function () {
                this.addContent(),
                    this.show(),
                    this.bindEvents()
            },
            content: [
                {
                    be: '售前咨询',
                    fe: '<a href="http://chat.jumei.com/custom?groupid=106" target="_blank">名品咨询</a><a href="http://chat.jumei.com/custom?groupid=107" target="_blank">化妆品咨询</a>'
                },
                {
                    be: '名品特卖',
                    fe: '<a href="http://chat.jumei.com/custom?groupid=108" target="_blank">名品配送</a><a href="http://chat.jumei.com/custom?groupid=109" target="_blank">名品售后</a><a href="http://chat.jumei.com/custom?groupid=110" target="_blank">产品问题</a>'
                },
                {
                    be: '化妆品业务',
                    fe: '<a href="http://chat.jumei.com/custom?groupid=111" target="_blank">配送服务</a><a href="http://chat.jumei.com/custom?groupid=112" target="_blank">售后服务</a><a href="http://chat.jumei.com/custom?groupid=113" target="_blank">产品问题</a>'
                },
                {
                    be: '会员服务',
                    fe: '<a href="http://chat.jumei.com/custom?groupid=104" target="_blank">会员服务</a>'
                },
                {
                    be: '投诉建议',
                    fe: '<a href="http://chat.jumei.com/custom?groupid=114" target="_blank">投诉快递</a><a href="http://chat.jumei.com/custom?groupid=115" target="_blank">投诉产品</a><a href="http://chat.jumei.com/custom?groupid=116" target="_blank">投诉客服</a><a href="http://chat.jumei.com/custom?groupid=117" target="_blank">投诉其他</a>'
                }
            ],
            show: function () {
                $.colorbox({
                    html: e,
                    scrolling: !1,
                    onLoad: function () {
                        $('#cboxClose').remove()
                    }
                })
            },
            addContent: function () {
                for (var a = this.content, b = a.length, c = '', d = 0; b > d; d++) c += '<li class="li_on">' + a[d].be + '</li>';
                e.find('#faq_content').html(c)
            },
            bindEvents: function () {
                var a = $('.dialog_ser').find('li'),
                    b = $('.dialog_ser').find('.close'),
                    c = this.content;
                a.hover(function () {
                    var a = $(this).index();
                    $(this).html(c[a].fe).addClass('li_on_hover')
                }, function () {
                    var a = $(this).index();
                    $(this).html(c[a].be).removeClass('li_on_hover')
                }),
                    b.bind('click', function () {
                        $('#colorbox').colorbox.close()
                    })
            }
        };
    f.init = function () {
        f.manager()
    },
        c.exports = f
}),
    define('ibar-history', function (a, b, c) {
        var d = {
            init: function (a) {
                var b = this;
                b.getHistoryData(function (c) {
                    b.renderHtml(c, a.container),
                        b.clearHistory(),
                        b.addCart()
                })
            },
            getHistoryData: function (a) {
                var b = RM_SITE_MAIN_WEBBASEURL + 'i/ajax/get_view_history?callback=?';
                $.getJSON(b, null, function (b) {
                    a.call(this, b)
                })
            },
            renderHtml: function (a, b) {
                var c = [
                ];
                if (c.push('<div class="ibar-moudle-wrap ibar_plugin" id="iBarHistroy">'), c.push('<h2 class="ibar_plugin_title"><span class="ibar_plugin_name">最近查看</span></h2>'), c.push('<div class="ibar_plugin_content">'), a && a.length > 0) {
                    c.push('<div class="ibar-history-head">共' + a.length + '件商品<a href="javascript:;" id="ibar-btn-clearhistory">清空</a></div>'),
                        c.push('<div class="ibar-moudle-product">');
                    for (var d in a) {
                        var e = a[d],
                            f = e.short_name,
                            g = e.type,
                            h = e.deal_hash_id || '',
                            i = e.product_id || '',
                            j = e.url,
                            k = e.image_100,
                            l = (e.buyer_number, e.discounted_price),
                            m = (e.discount, 'deal' == g ? h : i),
                            g = 'deal' == g ? 'deal' : 'product';
                        c.push('<div class="imp_item"><a href="' + j + '?from=ibar_view_recent_product" title="' + f + '" target="_blank" class="pic">'),
                            c.push('<img src="' + k + '" width="100" height="100"/></a><p class="tit"><a href="' + j + '?from=ibar_view_recent_product" title="' + f + '" target="_blank">'),
                            c.push(f + '</a></p><p class="price"><em>¥</em>' + l + '</p>'),
                            c.push('<a href="javascript:;" target="_blnak" class="imp-addCart" key="' + m + '" type="' + g + '" img="' + k + '">加入购物车</a>'),
                            c.push('<div class="sku_box"><select class="sku_select"><option value="0">型号选择</option></select></div></div>')
                    }
                    c.push('</div>')
                } else c.push('<div class="ibar-his-none">您最近没有浏览过小美家商品<br/>亲，快去逛逛吧！</div>');
                c.push('</div>'),
                    c.push('</div>'),
                    b.append(c.join(''))
            },
            clearHistory: function () {
                $('#ibar-btn-clearhistory').bind('click', function () {
                    $.getJSON(RM_SITE_MAIN_WEBBASEURL + 'i/deal/ajax_delete_history?callback=?', null, function () {
                        $('#iBarHistroy .ibar_plugin_content').html('<div class="ibar-his-none">您最近没有浏览过小美家商品<br/>亲，快去逛逛吧！</div>')
                    })
                })
            },
            getSku: function (a, b) {
                var c = 'http://www.' + RM_SITE_MAIN_TOPLEVELDOMAINNAME + '/i/ajax/get_sku_data';
                $.ajax({
                    url: c,
                    data: a,
                    type: 'get',
                    dataType: 'jsonp',
                    success: function (a) {
                        b.call(this, $.parseJSON(a))
                    }
                })
            },
            addCart: function () {
                var a = this,
                    b = $('.imp-addCart');
                b.click(function () {
                    var b = $(this),
                        c = b.attr('key'),
                        d = b.attr('type'),
                        e = b.attr('img'),
                        f = b.next().find('.sku_select'),
                        g = '';
                    return a.getSku({
                        id: c,
                        type: d
                    }, function (a) {
                        var h = a.length,
                            i = {
                                elem: null,
                                img: e,
                                sku: null,
                                hashid: 'product' == d ? '' : c,
                                num: 1,
                                from: getUrlArgs('from') + '|ibar_view_recent_cart_button'
                            };
                        if (1 == h) {
                            var j = a[0].sku_sellable;
                            if (0 == j) return b.html('已抢光').addClass('sold_out'),
                                void 0;
                            i.elem = b,
                                i.sku = a[0].sku_no,
                                Ixy.app.iBar.addCart(i)
                        } else {
                            for (var k in a) a[k].sku_sellable > 0 && (g += '<option value="' + a[k].sku_no + '">' + a[k].sku_attribute + '</option>');
                            '' != g ? (b.hide(), f.append(g).show())  : b.addClass('sold_out').html('已抢光'),
                                f.change(function () {
                                    var a = $(this).val();
                                    0 != a && (i.elem = f, i.sku = a, Ixy.app.iBar.addCart(i))
                                })
                        }
                    }),
                        !1
                })
            }
        };
        c.exports = d
    }),
    define('ibar-favorite', function (a, b, c) {
        function d(a) {
            var b = a.onSale,
                c = a.willSale,
                d = [
                ];
            if (d.push('<div class="ibar-moudle-wrap ibar_plugin" id="iBarFavorite">'), d.push('<h2 class="ibar_plugin_title"><span class="ibar_plugin_name">今日疯抢</span></h2>'), d.push('<div class="ibar_plugin_content">'), b && b.length) {
                d.push('<div class="ibar-moudle-product">');
                for (var e in b) {
                    var f = b[e].discount > 9.5 ? '' : b[e].discount;
                    d.push('<div class="imp_item"><a href="' + b[e].url + '?from=ibar_mywish_onsale" title="' + b[e].deal_name + '" target="_blank" class="pic">'),
                        d.push('<img src="' + b[e].pic + '" width="100" height="100"/></a>'),
                        d.push('<p class="tit"><a href="' + b[e].url + '?from=ibar_mywish_onsale" title="' + b[e].deal_name + '" target="_blank">'),
                        d.push('<span>' + f + '折/</span>' + b[e].deal_name + '</a>'),
                        d.push('</p><p class="price"><em>¥</em>' + b[e].discounted_price + '<del>¥' + b[e].original_price + '</del></p><a href="javascript:;" class="imp-addCart" sku="' + b[e].sku_no + '" hashid="' + b[e].hash_id + '" img="' + b[e].pic + '">加入购物车</a>'),
                        d.push('</div>')
                }
                d.push('</div>')
            } else c.length ? d.push('<div class="ibar-nothing"><div class="txt">您没有在售中的<br/><span>心愿商品喔！</span></div></div>')  : d.push('<div class="ibar-nothing"><div class="txt">您的心愿单没商品<br/><span>快去添加吧</span></div></div>');
            if (b.length || c.length) {
                if (d.push('<div class="ibar-moudle-product soon">'), d.push('<h2>即将开抢</h2>'), c.length) for (var e in c) {
                    var g = 0 == c[e].is_published_price ? '??' : c[e].discounted_price;
                    d.push('<div class="imp_item">'),
                        d.push('<div class="imp-starttime">' + c[e].start_time + '开抢</div>'),
                        d.push('<a href="' + c[e].url + '?from=ibar_mywish_willsale" title="' + c[e].deal_name + '"  target="_blank" class="pic">'),
                        d.push('<img src="' + c[e].pic + '" width="100" height="100"/></a><p class="tit"><a href="' + c[e].url + '?from=ibar_mywish_willsale" title="' + c[e].deal_name + '" target="_blank">' + c[e].deal_name + '</a>'),
                        d.push('<p class="wish-num">已有' + c[e].wish_number + '人许愿</p>'),
                        d.push('</p><p class="price"><em>¥</em>' + g + '<del>¥' + c[e].original_price + '</del></p>'),
                        d.push('</div>')
                } else d.push('<div class="ibar-nothing"><div class="txt">没有即将开抢的<br/><span>心愿商品喔！</span></div></div></div>');
                d.push('</div>')
            }
            return d.push('</div></div>'),
                d.join('')
        }
        var e = {
            init: function (a) {
                $.getJSON(RM_SITE_MAIN_WEBBASEURL + '/i/ajax/sidebar_wishdeal?callback=?', null, function (b) {
                    var c = d(b);
                    a.container.append(c),
                        $('.imp-addCart').click(function () {
                            var a = $(this).attr('sku'),
                                b = $(this).attr('hashid'),
                                c = $(this).attr('img'),
                                d = {
                                    elem: $(this),
                                    img: c,
                                    sku: a,
                                    hashid: b,
                                    from: 'ibar_addcart',
                                    num: 1,
                                    which_cart: 'all'
                                };
                            Ixy.app.iBar.addCart(d)
                        })
                })
            }
        };
        c.exports = e
    }),
    define('ibar-asset', function (a, b, c) {
        function d(a) {
            var b = [
                ],
                c = a.red_envelope_count,
                d = a.promocards_count,
                e = a.account;
            if (red_envelope_list = a.red_envelope_list, promocards_list = a.promocards_list, b.push('<div class="ibar-Asset-wrap ibar-moudle-wrap ibar_plugin" id="iBarAsset">'), b.push('<h2 class="ibar_plugin_title"><span class="ibar_plugin_name">我的财产</span></h2>'), b.push('<div class="ibar_plugin_content">'), b.push('<div class="ia-head-list clearfix">'), b.push('<a href="http://www.' + RM_SITE_MAIN_TOPLEVELDOMAINNAME + '/i/membership/show_promocards?from=ibar_property_xianjinquan" target="_blank" class="ihl-quan fl"><div class="num">' + d + '</div><div class="text">现金券</div></a>'), b.push('<a href="http://www.' + RM_SITE_MAIN_TOPLEVELDOMAINNAME + '/i/membership/show_red_envelope?from=ibar_property_hongbao"  target="_blank" class="ihl-hg fl"><div class="num">' + c + '</div><div class="text">红包</div></a>'), b.push('<a href="http://www.' + RM_SITE_MAIN_TOPLEVELDOMAINNAME + '/i/account/balance?from=ibar_property_yue" target="_blank" class="ihl-money fl"><div class="num">¥' + e + '</div><div class="text">余额</div></div>'), b.push('</a>'), b.push('<div class="ga-expiredsoon">'), b.push('<div class="es-head">即将过期现金券</div>'), promocards_list && promocards_list.length) {
                b.push('<div class="ia-coupon-list">');
                for (var f in promocards_list) b.push('<div class="icl-item">'),
                    b.push('<p class="name">' + promocards_list[f].title + '</p>'),
                    b.push('<div class="clearfix"><span class="sale fl">' + promocards_list[f].satisfied + '</span><span class="pri fr"><em>¥</em>' + promocards_list[f].amount + '</span></div>'),
                    b.push('<p class="exprietime">过期时间  ' + promocards_list[f].expire_time + '</span></p>'),
                    b.push('</div>');
                promocards_list.length > 2 && b.push('<a href="http://www.' + RM_SITE_MAIN_TOPLEVELDOMAINNAME + '/i/membership/show_promocards?from=ibar_property_xianjinquan_more" target="_blank" class="ga-view-more">查看更多</a>'),
                    b.push('</div>')
            } else b.push('<div class="ia-none">您还没有可用的现金券哦！</div>');
            if (b.push('</div>'), b.push('<div class="ga-expiredsoon">'), b.push('<div class="es-head">即将过期红包</div>'), red_envelope_list && red_envelope_list.length) {
                b.push('<div class="ga-hongbao-list">');
                for (var f in red_envelope_list) b.push('<div class="ihl-item">'),
                    b.push('<div class="pri"><em>¥</em>' + red_envelope_list[f].amount + '</span></div>'),
                    b.push('<p class="info">' + red_envelope_list[f].satisfied + '</p>'),
                    b.push('<p class="exprietime">过期时间  ' + red_envelope_list[f].expire_time + '</p>'),
                    b.push('</div>');
                red_envelope_list.length > 2 && b.push('<a href="http://www.' + RM_SITE_MAIN_TOPLEVELDOMAINNAME + '/i/membership/show_red_envelope?from=ibar_property_hongbao_more" target="_blank" class="ga-view-more">查看更多</a>'),
                    b.push('</div>')
            } else b.push('<div class="ia-none">您还没有可用的红包哦！</div>');
            return b.push('</div>'),
                b.push('</div></div>'),
                b.join('')
        }
        var e = {
            init: function (a) {
                $.getJSON(RM_SITE_MAIN_WEBBASEURL + 'i/ajax/sidebar_property?callback=?', null, function (b) {
                    var c = d(b);
                    a.container.append(c)
                })
            }
        };
        c.exports = e
    }),
    define('ibar-cart', function (a, b, c) {
        var d = function (a, b, c) {
                for (var d = 0, e = a, f = 0; f < a.length; f++) if (a.charCodeAt(f) > 256 ? d += 2 : d++, d > b) {
                    e = a.slice(0, f) + (c || '…');
                    break
                }
                return e
            },
            e = {
                product: '聚美优品',
                media: '名品特卖',
                global: {
                    name: '海外直邮',
                    group: !0
                },
                promo_cards: '聚美红包'
            },
            f = [
                'product',
                'media',
                'global',
                'promo_cards'
            ],
            g = function (a, b) {
                var c = null,
                    d = null;
                for (var e in f) {
                    if (a === f[e]) return c;
                    d = b.find('.ibar_cart_' + f[e]),
                        d.length > 1 ? c = $(d[d.length - 1])  : 1 == d.length && (c = d)
                }
            },
            h = function (a) {
                var b = e[a],
                    c = typeof b;
                return 'string' === c ? b : 'object' === c ? b.name : null
            },
            i = function (a) {
                var b = e[a],
                    c = typeof b;
                return 'string' === c ? !1 : 'object' === c && b.group ? !0 : !1
            },
            j = 0,
            k = function (a) {
                var b,
                    c,
                    d,
                    e,
                    f,
                    g,
                    h = null,
                    i = parseInt(1000 * a);
                return c = i,
                c > 0 && (b = parseInt(c / 86400000).toString(), b = b.length > 1 ? b : '0' + b, c %= 86400000, d = parseInt(c / 3600000).toString(), d = d.length > 1 ? d : '0' + d, c %= 3600000, e = parseInt(c / 60000).toString(), e = e.length > 1 ? e : '0' + e, f = parseInt(c % 60000 / 100), c = parseInt(f / 10), g = f - 10 * c, c = c.toString().length > 1 ? c : '0' + c, h = {
                    minute: e,
                    second: c,
                    milisec: g
                }),
                    h
            },
            l = {
                frame: '<div class=\'ibar_plugin ibar_cart_content\'><div class=\'ibar_plugin_title\'><span class=\'ibar_plugin_name\'>购物车<span class=\'ibar_cart_timer\'></span></span></div><div class=\'ibar_plugin_content\'><div class=\'ibar_cart_group_container\'></div><div class=\'ibar_cart_handler\'><div class=\'ibar_cart_handler_header clearfix\'><span class=\'ibar_cart_handler_header_left\'>共 <span class=\'ibar_cart_total_quantity ibar_pink\'>0</span> 件商品</span><span class=\'ibar_cart_total_price ibar_pink\'></span></div><a class=\'ibar_cart_go_btn\' href=\'http://cart.jumei.com/i/cart/show?from=ibar_cart_button\' target=\'_blank\'>去购物车结算</a></div></div></div>',
                dealItem: '<li class=\'ibar_cart_item clearfix\'><div class=\'ibar_cart_item_pic\'><a target=\'_blank\'><img src=\'\' alt=\'\'><span class=\'ibar_cart_item_tag png\'></span></a></div><div class=\'ibar_cart_item_desc\'><span class=\'ibar_cart_item_name_wrapper\'><span class=\'ibar_cart_item_global\'>[极速免税店]</span><a class=\'ibar_cart_item_name\' target=\'_blank\'></a></span><div class=\'ibar_cart_item_sku ibar_text_ellipsis\'><span></span></div><div class=\'ibar_cart_item_price ibar_pink\'><span class=\'unit_price\'></span><span class=\'unit_plus\'> x </span><span class=\'ibar_cart_item_count\'></span></div></div></li>',
                cbitems: '<li class=\'ibar_cart_cbitems ibar_cart_item\'><ul class=\'clearfix ibar_cart_cbitems_content\'></ul><div class=\'ibar_cart_item_price\'><span class=\'ibar_cb_tips\'>组合购买价</span><span class=\'unit_price ibar_pink\'></span><span class=\'unit_plus\'> x </span><span class=\'ibar_cart_item_count\'></span></div></li>',
                cartGroup: '<div class=\'ibar_cart_group\'><div class=\'ibar_cart_group_header clearfix\'><span class=\'ibar_cart_group_title\'></span><span class=\'ibar_cart_group_shop ibar_text_ellipsis\'></span><span class=\'ibar_cart_group_baoyou ibar_pink\'></span></div><ul class=\'ibar_cart_group_items\'></ul></div>',
                loadingText: '<p class=\'ibar_cart_loading_text\'>正在为您努力地加载数据！</p>'
            },
            m = function (a) {
                this.element = {
                },
                    this.id = a.id || this.id,
                    this.draw(a.container),
                    this.fixIE(),
                    this.initTimer(),
                    this.render(),
                    this.bindEvents()
            };
        m.prototype = {
            id: 'iBarCart',
            draw: function (a) {
                var b = $(l.frame).attr('id', this.id);
                this.element.root = b,
                    this.element.groupContainer = b.find('.ibar_cart_group_container'),
                    this.element.cartTimer = b.find('.ibar_cart_timer'),
                    this.element.handlebar = b.find('.ibar_cart_handler'),
                    this.element.handlebarQuanity = b.find('.ibar_cart_total_quantity'),
                    this.element.handlebarPrice = b.find('.ibar_cart_total_price'),
                    $(a).append(b)
            },
            fixIE: function () {
                var a = !!~navigator.userAgent.toLowerCase().indexOf('msie 6.0');
                a && this.element.groupContainer.hover(function () {
                    $(this).addClass('ibar_cart_group_container_hover_ie6')
                }, function () {
                    $(this).removeClass('ibar_cart_group_container_hover_ie6')
                })
            },
            bindEvents: function () {
                var a = this,
                    b = $('#iBar');
                Ixy.app && Ixy.app.iBar && Ixy.app.iBar.cartUpdate(function () {
                    a.render()
                }),
                    b.bind('afterreopenplugin', function (b, c) {
                        'iBarCart' === c && a.fixHandlerPos()
                    })
            },
            render: function () {
                this.clear(),
                    this.toggleCartState('loading'),
                    this.getAjaxData({ _ajax_: 1,which_cart: 'all'}, function (a) {
                        Ixy.app && Ixy.app.iBar && Ixy.app.iBar.cartNumberUpdate(a.quantity || 0),
                            a.quantity > 0 ? (this.toggleCartState('show'),
                                    this.refreshTimer(a.etime),
                                    this.renderGroups(a, this.element.groupContainer),
                                    this.refreshHandler(a),
                                    this.fixHandlerPos()
                                )
                             : this.toggleCartState('empty')
                    }, this)
            },
            fixHandlerPos: function () {
                var a,
                    b = this.element,
                    c = b.root.find('.ibar_plugin_content').outerHeight(),
                    d = b.handlebar.outerHeight();
                    b.groupContainer.css({
                        position: 'static'
                    }),
                    a = b.groupContainer.outerHeight(),
                    c > a + d ? (b.groupContainer.css({
                        position: 'relative'
                    }), b.handlebar.removeClass('ibar_cart_handler_fixed').addClass('ibar_cart_handler_attached').css({
                        top: a
                    }))  : (b.groupContainer.css({
                        position: 'absolute'
                    }), b.handlebar.removeClass('ibar_cart_handler_attached').addClass('ibar_cart_handler_fixed').css({
                        top: 'auto'
                    }))
            },
            toggleCartState: function (a) {
                'empty' === a ? (this.element.groupContainer.addClass('ibar_cart_empty').removeClass('ibar_cart_loding'), this.element.handlebar.hide(), this.element.cartTimer.hide())  : 'show' === a ? (this.element.groupContainer.removeClass('ibar_cart_empty').removeClass('ibar_cart_loding'), this.element.handlebar.show(), this.element.cartTimer.show())  : 'loading' === a && (this.element.groupContainer.addClass('ibar_cart_loding').append($(l.loadingText)), this.element.handlebar.hide(), this.element.cartTimer.hide())
            },
            clear: function () {
                this.element.handlebarQuanity.text(0),
                    this.element.handlebarPrice.text('￥0'),
                    this.element.groupContainer.empty()
            },
            initTimer: function () {
                var a = this,
                    b = this.cartTimerInterval = function () {
                        j -= 0.1;
                        var b = k(j);
                        b ? a.renderTimer(b.minute, b.second, b.milisec, j)  : a.renderTimer(0, 0, 0, j)
                    };
                setInterval(b, 100)
            },
            renderTimer: function (a, b, c, d) {
                var e = '';
                e = d > 0 ? '<span class=\'ibar_pink\'>' + a + '分' + b + '.' + c + '秒</span>后清空' : '已超时，请尽快结算',
                e && this.element.cartTimer.html(e)
            },
            refreshTimer: function (a, b) {
                !b && window.global_cart_count && (global_cart_count = a),
                    j = a
            },
            refreshHandler: function (a) {
                a && (this.element.handlebarQuanity.text(a.quantity), this.element.handlebarPrice.text('￥' + new Number(a.total_amount).toFixed(2)))
            },
            renderItem: function (a, b) {// 展现购物车商品
                if (a) {
                    var c = $(l.dealItem),
                        e = d(a.short_name, 32);
                    if ('retail_global' === a.item_category && c.find('.ibar_cart_item_global').css({
                            display: 'inline'
                        }), a.url = - 1 === String.prototype.indexOf.call(a.url, '?') ? a.url + '?from=ibar_cart' : a.url + '&from=ibar_cart', c.find('.ibar_cart_item_pic a,.ibar_cart_item_name').attr({
                            title: a.short_name,
                            href: a.url
                        }), c.find('.ibar_cart_item_name').html(e), c.find('.ibar_cart_item_pic img').attr({
                            alt: a.short_name,
                            src: a.image_100
                        }), a.attribute || a.capacity) {
                        var f = a.attribute + (a.capacity ? ' ' + a.capacity : '');
                        c.find('.ibar_cart_item_sku span').text('型号：' + f).attr('title', f)
                    }
                    c.find('.ibar_cart_item_price .unit_price').text('￥' + new Number(a.item_discount_price).toFixed(2)),
                        c.find('.ibar_cart_item_count').text(a.quantity),
                    a.sale_status && c.find('.ibar_cart_item_tag').addClass('ibar_cart_item_tag_active ibar_cart_item_tag_soldout'),
                        b.append(c)
                }
            },
            renderGroups: function (a, b) {
                if (a) for (var c in a) {
                    var d = i(c);
                    if (h(c)) if (d === !0) for (var e in a[c]) this.renderGroup(c, a[c][e], b);
                    else d === !1 && this.renderGroup(c, a[c], b)
                }
            },
            renderGroupBySeq: function (a, b, c) {
                var d = g(b, c);
                d ? d.after(a)  : c.prepend(a)
            },
            renderGroup: function (a, b, c) {
                if (b && b.items && b.items.length) {
                    var d = $(l.cartGroup).addClass('ibar_cart_' + a);
                    d.find('.ibar_cart_group_title').text(h(a)),
                        d.find('.ibar_cart_group_baoyou').html(b.delivery_fee_desc),
                    b.name && d.find('.ibar_cart_group_shop').text(b.name).attr('title', b.name + ' 发货');
                    var e = d.find('.ibar_cart_group_items');
                    for (var f in b.items) b.items[f].is_cb ? this.renderCbGroup(e, b.items[f])  : this.renderItem(b.items[f], e);
                    this.renderGroupBySeq(d, a, c)
                }
            },
            renderCbGroup: function (a, b) {
                var c = null,
                    d = $(l.cbitems);
                d.find('.ibar_cart_item_price .unit_price').text('￥' + new Number(b.item_price).toFixed(2)),
                    d.find('.ibar_cart_item_count').text(b.quantity),
                b.sale_status && d.addClass('ibar_cart_gb_gray'),
                    c = d.find('.ibar_cart_cbitems_content');
                for (var e = 0, f = b.sub_items.length; f > e; e++) this.renderItem(b.sub_items[e], c);
                a.append(d)
            },
            getAjaxData: function (a, b, c) {//读取购物车
                return window.DEBUGING ? (b.call(c || this, mockData), void 0)  :
                    ( $.getJSON(  // 购物车抓取数据
                        'http://cart.' + '/i/ajax/get_cart_data_right?callback=?', // url
                        a,
                        function (a) {
                            a && b.call(c || this, a)
                        }),
                        void 0 )
            }
        };
        var n = null;
        m.init = function (a) {
            return null == n && (n = new m(a)),
                n
        },
            c.exports = m
    }),
    define('ibar-monitor', function (a, b, c) {
    'use strict';
    var d = function () {
        window._gaq && $('#iBar div.ibar_main_panel').find('a').bind('mousedown', function () {
            var a = $(this).parent() [0].className,
                b = a.match(/mpbtn_(\w+)\b/);
            b && (b = 'ibar_' + b[1], 'gotop' !== b && window._gaq.push(['_trackEvent',
                b,
                'clicked']))
        })
    };
    c.exports = d
}),
define('ibar-fly', function (a, b) {
    var c = $(window),
        d = {
            targeter: null,
            bubbler: null,
            bubbleAni: function (a, b) {
                var d = this;
                a.fadeOut(10, function () {
                    a.css({
                        width: '45px',
                        height: '45px'
                    }),
                        setTimeout(function () {
                            var a = d.targeter.offset();
                            a = {
                                left: a.left - c.scrollLeft(),
                                top: a.top - c.scrollTop()
                            },
                                d.bubbler.css({
                                    position: 'fixed',
                                    display: 'block',
                                    opacity: 1,
                                    top: a.top - 13,
                                    left: a.left + 4
                                }).animate({
                                    top: a.top - 40,
                                    opacity: 0
                                }, {
                                    duration: 800,
                                    complete: function () {
                                        d.bubbler.hide(),
                                        b && b()
                                    }
                                })
                        }, 300)
                })
            },
            cartScale: function () {
                var a = this;
                a.targeter.css({
                    zIndex: 9992
                }),
                    a.targeter.animate({
                        scale: 0.3
                    }, {
                        duration: 100,
                        step: function (b) {
                            a.targeter.css('transform', 'scale(' + (1 + b) + ')')
                        }
                    }).animate({
                        scale: 0.3
                    }, {
                        duration: 500,
                        step: function (b) {
                            a.targeter.css('transform', 'scale(' + (1.3 - b) + ')')
                        }
                    })
            },
            main: function (a) {
                var b = this;
                b.targeter = a.targeter,
                    b.starter = a.starter,
                    b.bubbler = a.bubbler;
                var d,
                    e = a.flyer,
                    f = a.start,
                    g = a.target,
                    h = a.complete,
                    i = {
                        left: f.left,
                        top: f.top
                    },
                    j = {
                        left: g.left,
                        top: g.top
                    },
                    k = a.unAnim,
                    l = a.isIE6,
                    m = a.speed ? a.speed : 1,
                    n = void 0 === a.bubble ? !0 : a.bubble,
                    o = (a.hideDelay ? a.hideDelay : '', l ? !1 : !0),
                    p = a.targetOffset || {
                            left: 0,
                            top: 0
                        },
                    q = a.flyerOffset || {
                            left: 0,
                            top: 0
                        },
                    r = a.flyerResize || {
                            x: 15,
                            y: 15
                        };
                e.css({
                    left: f.left - c.scrollLeft(),
                    top: f.top - c.scrollTop(),
                    position: o ? 'fixed' : 'absolute'
                }),
                    o ? (i = {
                        left: f.left - c.scrollLeft(),
                        top: f.top - c.scrollTop()
                    }, g && (j = {
                        left: parseFloat(g.left - c.scrollLeft() + p.left),
                        top: parseFloat(g.top - c.scrollTop() + p.top)
                    }))  : g && (j = {
                        left: parseFloat(g.left + p.left),
                        top: parseFloat(g.top + p.top)
                    });
                var s = o ? 0 : c.scrollTop(),
                    t = Math.min(i.top, j.top) - Math.abs(i.left - j.left) * (1 / 3);
                s > t && (i.left == j.left && (t = j.top), t = Math.min(s, Math.min(i.top, j.top))),
                    m = l ? m : m / 2;
                var u = Math.sqrt(Math.pow(i.top - j.top, 2) + Math.pow(i.left - j.left, 2)),
                    v = Math.ceil(Math.min(Math.max(Math.log(u) / 0.05 - 75, 30), 100) / m) + 5,
                    w = i.top == t ? 0 : - Math.sqrt((j.top - t) / (i.top - t)),
                    x = (w * i.left - j.left) / (w - 1),
                    y = j.left == x ? 0 : (j.top - t) / Math.pow(j.left - x, 2),
                    z = Math.cos,
                    A = Math.PI,
                    B = (Math.min, Math.pow),
                    C = - 1;
                if (r && (d = {
                        x: e.width(),
                        y: e.height()
                    }), k) b.bubbleAni(e, h);
                else var D = setInterval(function () {
                    ++C;
                    var a = i.left + (j.left - i.left) * C / v,
                        c = 0 == y ? i.top + (j.top - i.top) * C / v : y * B(a - x, 2) + t,
                        f = {
                            left: a,
                            top: c
                        };
                    if (r) {
                        var g = v / 2,
                            k = r.x - (r.x - d.x) * z(g > C ? 0 : (C - g) / (v - g) * A / 2),
                            l = r.y - (r.y - d.y) * z(g > C ? 0 : (C - g) / (v - g) * A / 2);
                        e.css({
                            width: k + 'px',
                            height: l + 'px'
                        })
                    }
                    e.css({
                        left: f.left + q.left + 'px',
                        top: f.top + q.top + 'px'
                    }),
                    C == v - 1 && b.cartScale(),
                    C == v && (clearInterval(D), n ? b.bubbleAni(e, h)  : h && h())
                }, 16)
            }
        };
    b.main = function (a) {
        d.main(a)
    }
}), define('gotop', [
    'util'
], function (a) {
    a('util');
    var b,
        c = {
            position: {
                bottom: '0px',
                right: '0px'
            },
            fixed: !0,
            isAnim: !1
        },
        d = !1,
        e = !0,
        f = $(window),
        g = Math.round(f.height() / 2);
    $.easing.easeOutStrong = function (a) {
        return 1 - --a * a * a * a
    };
    var h = function () {
            b.is(':animated') && b.stop(!0, !0)
        },
        i = function () {
            f.bind('scroll.gotop', function () {
                var a = $(this).scrollTop();
                a > g ? d || (d = !0, h(), b.css('visibility', 'visible'), b.fadeIn())  : d && (d = !1, h(), b.fadeOut(400, function () {
                    b.css({
                        visibility: 'hidden',
                        display: 'block'
                    })
                }))
            })
        },
        j = function () {
            f.unbind('scroll.gotop')
        },
        k = function (a) {
            b.find('a.btn_gotop').bind('click.gotop', function (c) {
                var d;
                j(),
                    b.css({
                        visibility: 'hidden',
                        display: 'block'
                    }),
                    a.isAnim ? (d = Math.round(0.33 * f.scrollTop()), $('body,html').animate({
                        scrollTop: 0
                    }, d, 'easeOutStrong', function () {
                        i()
                    }))  : (f.scrollTop(0), i()),
                    c.preventDefault()
            })
        },
        l = function (a, d) {
            $.isPlainObject(a) && (d = a, a = null),
                d = d || {
                };
            var f,
                g = $.extend({
                }, c, d),
                h = g.position;
            b = $('#gotop'),
            b.length || (e = !1, b = $('<div class="gotop" id="gotop" style="display:none;"><a href="javascript:;" class="btn_gotop">返回顶部</a></div>')),
            g.fixed && (a && (a = $(a).eq(0), f = Math.round(a.outerWidth() / 2), b.css({
                marginLeft: f + parseInt(h.left) + 'px'
            }), h.left = '50%'), e || b.appendTo(document.body), Ixy.util.fixed(b[0], h)),
                i(),
                k(g),
                g.target = a,
                this.__o__ = g
        };
    l.prototype = {
        position: function (a) {
            var c,
                d = this.__o__.target;
            d && (c = Math.round(d.outerWidth() / 2), b.css({
                marginLeft: c + parseInt(a.left) + 'px'
            }), a.left = '50%'),
                Ixy.util.fixed(b[0], a)
        }
    },
        window.Ixy = window.Ixy || {
        },
        window.Ixy.ui = window.Ixy.ui || {
        },
        window.Ixy.ui.Gotop = l
}),
 define('util', function () {
    'use strict';
    window.Ixy = window.Ixy || {
    },
        Ixy.using = function () {
            var a,
                b,
                c,
                d,
                e = arguments,
                f = this;
            if (c = e[0], d = e[1], c && c.indexOf('.')) for (b = c.split('.'), a = 'Ixy' == b[0] ? 1 : 0; a < b.length; a++) {
                if (!f[b[a]] && d) return null;
                f[b[a]] = f[b[a]] || {
                },
                    f = f[b[a]]
            } else f[c] = f[c] || {
            };
            return f
        },
        function (a) {
            a.cookie = {
                set: function (a, b, c) {
                    c || (c = {
                    });
                    var d = new Date,
                        e = window.location.hostname.split('.').slice( - 2).join('.'),
                        f = c.exp;
                    'number' == typeof f ? d.setTime(d.getTime() + 3600000 * f)  : 'forever' === f ? d.setFullYear(d.getFullYear() + 50)  : null === b ? (b = '', d.setTime(d.getTime() - 3600000))  : d = f instanceof Date ? f : '',
                        document.cookie = a + '=' + encodeURIComponent(b) + (d && '; expires=' + d.toUTCString()) + '; domain=' + (c.domain || e) + '; path=' + (c.path || '/') + (c.secure ? '; secure' : '')
                },
                get: function (a) {
                    a += '=';
                    for (var b, c = (document.cookie || '').split(';'), d = a.length, e = c.length; e--; ) if (b = c[e].replace(/^\s+/, ''), b.slice(0, d) === a) return decodeURIComponent(b.slice(d)).replace(/\s+$/, '');
                    return ''
                }
            }
        }(Ixy.using('util')),
        function (a) {
            $.extend(a, {
                throttle: function (a, b) {
                    var c;
                    return function () {
                        var d = this,
                            e = arguments;
                        clearTimeout(c),
                            c = setTimeout(function () {
                                a.apply(d, e)
                            }, b)
                    }
                },
                fixed: function (a, b) {
                    var c,
                        d,
                        e,
                        f,
                        g,
                        h = document.documentElement,
                        i = a.style,
                        j = !!~navigator.userAgent.toLowerCase().indexOf('msie 6.0');
                    b ? (d = b.top, e = b.bottom, f = b.right, g = b.left)  : (d = '0px', g = '0px'),
                        void 0 !== g ? i.left = g : i.right = f,
                        j ? ('fixed' !== h.currentStyle.backgroundAttachment && (h.style.backgroundImage = 'url(about:blank)', h.style.backgroundAttachment = 'fixed'), void 0 !== d ? b = parseInt(d)  : void 0 !== e && (c = a.offsetHeight, c || (i.visibility = 'hidden', i.display = 'block', c = a.offsetHeight, i.visibility = '', i.display = 'none'), b = h.clientHeight - c - parseInt(e), window.onresize = function () {
                            b = h.clientHeight - c - parseInt(e),
                                i.setExpression('top', 'fuckIE6=document.documentElement.scrollTop + ' + b + ' + "px"')
                        }), 'BODY' !== a.parentNode.tagName && document.body.appendChild(a), i.position = 'absolute', i.setExpression('top', 'fuckIE6=document.documentElement.scrollTop + ' + b + ' + "px"'))  : (i.position = 'fixed', void 0 !== d ? i.top = d : i.bottom = e)
                },
                capitalize: function (a) {
                    var b = a.charAt(0);
                    return b.toUpperCase() + a.replace(b, '')
                },
                parseUrl: function (a, b) {
                    a = a || (b ? window.location.hash : window.location.search);
                    var c,
                        d,
                        e,
                        f,
                        g,
                        h,
                        i = b ? '#' : '?',
                        j = {
                        },
                        k = 0;
                    if (!~a.indexOf(i) || a.slice( - 1) === i) return j;
                    for (c = a.slice(a.indexOf(i) + 1), d = c.split('&'), e = d.length; e > k; k++) f = d[k],
                        g = f.indexOf('='),
                        h = f.slice(0, g),
                        j[h] = f.slice(g + 1);
                    return j
                },
                findNumIndex: function (a) {
                    for (var b, c = 0; c < a.length; c++) if (b = a.charAt(c), b.match(/^\d$/g)) return c;
                    return - 1
                },
                reallength: function (a) {
                    return a.replace(/[^\x00-\xff]/g, '^^').length
                },
                clipstring: function (a, b) {
                    if (!a || !b) return '';
                    var c = 0,
                        d = 0,
                        e = '';
                    for (d = 0; d < a.length; d++) {
                        if (a.charCodeAt(d) > 255 ? c += 2 : c++, c > b) return e + '..';
                        e += a.charAt(d)
                    }
                    return a
                },
                replaceNotNumber: function (a) {
                    return a = a.replace(/[^\d.]/g, ''),
                        a = a.replace(/^\./g, ''),
                        a = a.replace(/\.{2,}/g, '.'),
                        a.replace('.', '$#$').replace(/\./g, '').replace('$#$', '.')
                },
                gotoAnchor: function (a) {
                    var b = $(a);
                    if (!(b.length < 0)) {
                        var c = $(window),
                            d = $(window.document.documentElement),
                            e = navigator.userAgent.toLowerCase();
                        e.indexOf('webkit') > - 1 && (d = $(window.document.body));
                        var f = b.offset(),
                            g = f.top - c.scrollTop(),
                            h = c.height() - g;
                        h < b.outerHeight() && d.animate({
                            scrollTop: f.top
                        }, 'normal')
                    }
                },
                getDifTime: function (a, b) {
                    var c,
                        d,
                        e,
                        f,
                        g,
                        h = {
                            DD: '00',
                            D: '0',
                            HH: '00',
                            MM: '00',
                            SS: '00',
                            TT: '00',
                            H: '0',
                            M: '0',
                            S: '0',
                            T: '0'
                        },
                        a = parseInt(1000 * a),
                        d = a;
                    return d > 0 ? (c = parseInt(d / 86400000).toString(), h.DD = h.D = c, c.toString().length < 2 && (h.DD = '0' + c), d %= 86400000, e = parseInt(d / 3600000).toString(), h.HH = h.H = e, e.toString().length < 2 && (h.HH = '0' + e), d %= 3600000, f = parseInt(d / 60000).toString(), h.MM = h.M = f, f.toString().length < 2 && (h.MM = '0' + f), g = parseInt(d % 60000 / 100), d = parseInt(g / 10), h.TT = h.T = g - 10 * d, h.SS = h.S = d, d.toString().length < 2 && (h.SS = '0' + d), b.replace(/\b[DHMST]+\b/g, function (a) {
                        return h[a] || 0
                    }))  : ''
                },
                addFavorite: function (a, b) {
                    try {
                        window.external.addFavorite(a, b)
                    } catch (c) {
                        try {
                            window.sidebar.addPanel(b, a, '')
                        } catch (d) {
                            alert('您的浏览器不支持点击收藏')
                        }
                    }
                },
                hoverIntent: function (a, b) {
                    var c = {
                        interval: 100,
                        sensitivity: 6,
                        timeout: 0
                    };
                    c = $.extend(c, b);
                    var d,
                        e,
                        f,
                        g,
                        h = function (a) {
                            d = a.pageX,
                                e = a.pageY
                        },
                        i = function (a, b) {
                            return b.hoverIntent_t = clearTimeout(b.hoverIntent_t),
                                Math.sqrt((f - d) * (f - d) + (g - e) * (g - e)) < c.sensitivity ? ($(b).off('mousemove.hoverIntent', h), b.hoverIntent_s = !0, c.over.apply(b, [
                                    a
                                ]))  : (f = d, g = e, b.hoverIntent_t = setTimeout(function () {
                                    i(a, b)
                                }, c.interval), void 0)
                        },
                        j = function (a, b) {
                            return b.hoverIntent_t = clearTimeout(b.hoverIntent_t),
                                b.hoverIntent_s = !1,
                                c.out.apply(b, [
                                    a
                                ])
                        },
                        k = function (a) {
                            var b = $.extend({
                                }, a),
                                d = this;
                            d.hoverIntent_t && (d.hoverIntent_t = clearTimeout(d.hoverIntent_t)),
                                'mouseenter' === a.type ? (f = b.pageX, g = b.pageY, $(d).on('mousemove.hoverIntent', h), d.hoverIntent_s || (d.hoverIntent_t = setTimeout(function () {
                                    i(b, d)
                                }, c.interval)))  : ($(d).off('mousemove.hoverIntent', h), d.hoverIntent_s && (d.hoverIntent_t = setTimeout(function () {
                                    j(b, d)
                                }, c.timeout)))
                        };
                    return a.on({
                        'mouseenter.hoverIntent': k,
                        'mouseleave.hoverIntent': k
                    }, c.selector)
                }
            })
        }(Ixy.using('util'))
}),
define('ibar', [
    'util',
    'gotop',
    'ibar-fly',
    'ibar-monitor',
    'ibar-cart',
    'ibar-asset',
    'ibar-favorite',
    'ibar-history',
    'ibar-faq'
], function (a) {
    'use strict';
    a('util'),
        a('gotop');
    var b,
        c,
        d,
        e,
        f,
        g,
        h,
        i,
        j,
        k,
        l,
        m,
        n,
        o,
        p,
        q,
        r,
        s,
        t,
        u,
        v,
        w,
        x,
        y,
        z,
        A,
        B = a('ibar-fly'),
        C = a('ibar-monitor'),
        E = !0,
        F = window.location.hostname.split('.').slice( - 2).join('.'),
        G = {
            iBarCart: a('ibar-cart'),
            iBarAsset: a('ibar-asset'),
            iBarFavorite: a('ibar-favorite'),
            iBarHistroy: a('ibar-history'),
            iBarFaq: a('ibar-faq')
        },
        H = {
            zIndex: 9990,
            compactWidth: 1050
            //addCartAjaxUrl: 'http://cart.' + F + '/i/cart/ajax_add_to_cart'
        },
        I = [
            '普通会员',
            '黄金会员',
            '白金会员',
            '钻石会员'
        ],
        J = !1,
        K = Ixy.util,
        L = K.throttle,
        M = $(window),
        N = $(document.body),
        O = 0,
        P = 0,
        Q = [
        ],
        R = !!~navigator.userAgent.toLowerCase().indexOf('msie 6.0'),
        S = {
            getCookie: function (a) {
                a = ' ' + a + '=';
                var b = document.cookie,
                    c = b.indexOf(a),
                    d = b.indexOf(';', c),
                    e = '';
                return ~c && (~d || (d = b.length), e = b.slice(c + a.length, d)),
                    decodeURIComponent(e)
            },
            createiBar: function (a) {
                var b,
                    c,
                    d = S.getCookie('userAccount'), // 判断是否登录
                    e = 'status_logout',
                    f = '<p>您好！请&nbsp;<a href="' + BASEURL + '/index.php?r=site/login">登录</a>&nbsp;|&nbsp;<a href="' + BASEURL + '/index.php?r=site/signup">注册</a></p>',
                    g = 'images/logo.jpg',
                    h = M.height();
                a.isLogin = '' !== d,
                a.isLogin && (g = S.getCookie('avatar_small'),  e = 'status_login', f = '<ul class="user_info"><li>用户名：' + d + '</li>'  + '</ul>'),
                    b = '<div class="ibar" id="iBar" style="z-index:' + a.zIndex + ';height:' + h + 'px;">'
                    + '<div class="ibar_main_panel">' + '<ul class="ibar_mp_center">'
                    + '<li class="mpbtn_login"><a href="http://www.' + F + '/i/account/login"><s></s>登录</a></li>'
                    + '<li class="mpbtn_cart"><a href="#" data-plugin="iBarCart"><s></s><span class="text">购物车</span><span class="cart_num">0</span></a></li>'
                    + '<li class="mpbtn_asset">' + '<a href="#" data-judgelogin="1" data-plugin="iBarAsset"><s></s>我的资产</a>'
                    + '<div class="mp_tooltip">我的资产<s class="icon_arrow_right_black"></s></div>' + '</li>'
                    + '<li class="mpbtn_favorite">' + '<a href="#" data-judgelogin="1" data-plugin="iBarFavorite"><s></s>我的收藏</a>'
                    + '<div class="mp_tooltip">我的收藏<s class="icon_arrow_right_black"></s></div>' + '</li>'
                    + '<li class="mpbtn_recharge">' + '<a href="#" data-plugin="iBarRecharge"><s></s><span class="text">会</span></a>' + '<div class="mp_tooltip">我的会员卡<s class="icon_arrow_right_black"></s></div>' + '</li>' + '</ul>'
                    + '<ul class="ibar_mp_bottom">' + '<li class="mpbtn_qrcode">' + '<a href="#"><s></s>手机聚美</a>'
                    + '<div class="mp_qrcode"><img src="http://s0.jmstatic.com/templates/jumei/images/ibar/placeholder.png" data-lazysrc="http://s0.jmstatic.com/templates/jumei/images/ibar/qrcode.png" width="148" height="175" /><s class="icon_arrow_white"></s></div>' + '</li>'
                    + '<li class="mpbtn_gotop" id="gotop">' + '<a href="#" class="btn_gotop"><s></s>返回顶部</a>' + '<div class="mp_tooltip">返回顶部<s class="icon_arrow_right_black"></s></div>' + '</li>' + '</ul>' + '</div>'
                    + '<div class="ibar_login_box ' + e + '">' + '<div class="avatar_box">' + '<p class="avatar_imgbox"><img src="' + g + '" alt="头像" width="62" height="62" /></p>' + f + '</div>' + '<div class="login_btnbox">'
                    + '<a href="http://www.' + F + '/i/order/list" class="login_order" target="_blank">我的订单</a>'
                    + '<a href="http://www.' + F + '/i/product/fav_products" class="login_favorite" target="_blank">我的收藏</a>' + '</div>'
                    + '<s class="icon_arrow_white"></s>' + '<a href="javascript:;" class="ibar_closebtn" title="关闭"></a>' + '</div>' + '<div class="ibar_sub_panel">' + '<a href="javascript:;" class="ibar_closebtn" title="关闭"></a>' + '<span class="ibar_loading_text">正在为您努力加载数据！</span>'  + '</div>',
                    N.append(b),
                g || $.ajax({
                    url: 'http://www.' + F + '/i/ajax/syncCookie',
                    dataType: 'jsonp',
                    success: function (a) {
                        a.avatar_small && ($('#iBar .avatar_imgbox img') [0].src = a.avatar_small)
                    }
                })
            },
            createAnimElem: function () {
                var a = '<div style="width:45px;height:45px;border-radius:50%;background:#fff;position:absolute;display:none;overflow:hidden;border:1px solid #ed145b;z-index:9992;"><img width="45" height="45"></div>';
                return $(a)
            },
            configAnim: function (a) {
                var b = a.animElem,
                    c = (a.sourceElem, a.numProxyElem),
                    d = a.sourcePos,
                    e = a.targetPos,
                    f = a.animElem.width(),
                    g = a.sourceElem.width() / 2 - f / 2,
                    h = {
                        top: d.top,
                        left: d.left + g
                    },
                    j = {
                        top: d.top - f - 10,
                        left: h.left
                    };
                b.css({
                    position: 'absolute',
                    display: 'block',
                    top: h.top + 'px',
                    left: h.left + 'px',
                    opacity: 0
                }).animate({
                    top: j.top + 'px',
                    opacity: 1
                }, 300, function () {
                    var a = $(this);
                    B.main({
                        flyer: a,
                        starter: null,
                        bubbler: c,
                        targeter: $('li.mpbtn_cart a s'),
                        start: j,
                        target: e,
                        unAnim: !1,
                        bubble: !0,
                        speed: 4,
                        isIE6: R,
                        hideDelay: '',
                        targetOffset: {
                            left: 12,
                            top: 28
                        },
                        complete: function () {
                            i.text(O),
                                a.remove()
                        }
                    })
                })
            },
            getAddCartData: function (a) {
                var c,
                    d,
                    e = 'http://cart.' + F + '/i/cart/new_items/',
                    f = '',
                    g = 0;
                if (a.multiple) {
                    for (c = a.sku.length; c > g; g++) d = 0 === parseInt(a.hashid[g]) ? '' : a.hashid[g],
                        f += a.sku[g] + ',' + d + ',' + a.num[g] + '|';
                    f = f.slice(0, f.length - 1)
                } else a.combt ? f = a.combt : (d = 0 === parseInt(a.hashid) ? '' : a.hashid, f = a.sku + ',' + d + ',' + a.num);
                J ? window.location.href = e + f + '?from=' + a.from : $.ajax({
                    url: A,
                    data: {
                        _ajax_: 1,
                        items: f,
                        which_cart: a.which_cart,
                        from: a.from
                    },
                    dataType: 'jsonp',
                    success: function (c) {
                        'success' === c.type ? (O = c.cart_item_number, a.callback(), b.trigger('likecartadd'))  : b.trigger('likecarterror', c)
                    },
                    error: function () {
                        window.location.href = e + f + '?from=' + a.from
                    }
                })
            },
            addCartCallback: function (a) {
                var b,
                    c = $.isArray(a.num) ? a.num.length : a.num,
                    d = $(a.elem),
                    e = d.offset(),
                    g = f.offset(),
                    h = {
                    };
                e.top = e.top - d.outerHeight(),
                d.is(':hidden') && (d.css({
                    visibility: 'hidden',
                    display: 'block'
                }), e = d.offset(), e.top = e.top - d.outerHeight(), d.css({
                    visibility: '',
                    display: 'none'
                })),
                m || (m = $('<div style="width:13px;height:13px;line-height:13px;z-index:9991;border-radius:50%;background:#ed145b;position:absolute;display:none;overflow:hidden;border:2px solid #ed145b;color:#fff;text-align: center"/>'), N.append(m)),
                    m.text(c),
                l || (l = S.createAnimElem()),
                    b = l.clone(),
                    b.find('img') [0].src = a.img,
                    N.append(b),
                    h = {
                        animElem: b,
                        sourceElem: d,
                        numProxyElem: m,
                        sourcePos: e,
                        targetPos: g
                    },
                    S.configAnim(h)
            },
            slideMainPanel: function (a) {
                var b = a ? y + 'px' : '0px';
                c.is(':animated') && c.stop(!0, !0),
                    c.animate({
                        left: b
                    }, 200)
            },
            slideCartItem: function (a) {
                var b = a ? 0 - y + 'px' : '0px',
                    c = function () {
                        f[a ? 'addClass' : 'removeClass']('mpbtn_cart_compact')
                    };
                f.is(':animated') && f.stop(!0, !0),
                    f.animate({
                        left: b
                    }, 200, c)
            },
            initMainPanel: function (a) {
                var d,
                    e = M.width();
                b.unbind('mouseenter.slidemainpanel mouseleave.slidemainpanel'),
                    e < a.compactWidth ? (d = parseInt(c.css('left')), 0 === d && S.slideMainPanel(!0), S.slideCartItem(!0), S.bindMainPanelSlide())  : (d = parseInt(f.css('left')), S.slideMainPanel(!1), 0 !== d && S.slideCartItem(!1))
            },
            bindMainPanelSlide: function () {
                b.bind('mouseenter.slidemainpanel', function () {
                    clearTimeout(x);
                    var a = parseInt(c.css('left'));
                    0 !== a && (w = setTimeout(function () {
                        S.slideMainPanel(!1),
                            S.slideCartItem(!1)
                    }, 200))
                }).bind('mouseleave.slidemainpanel', function () {
                    clearTimeout(w);
                    var a = parseInt(c.css('left'));
                    h.is(':hidden') && g.is(':hidden') && 0 === a && (x = setTimeout(function () {
                        S.slideMainPanel(!0),
                            S.slideCartItem(!0)
                    }, 200))
                })
            },
            initPluginLayout: function () {
                var a,
                    b,
                    c = document.head || document.getElementsByTagName('head') [0] || document.documentElement,
                    d = '.ibar .ibar_sub_panel .ibar_plugin_content',
                    e = M.height() - 39;
                e = Math.max(e, 600),
                    a = 'height:' + e + 'px;overflow-y:auto;',
                    b = document.createElement('style'),
                    b.type = 'text/css',
                    void 0 !== b.textContent ? b.textContent = d + '{' + a + '}' : b.styleSheet.addRule(d, a, 0),
                    c.appendChild(b)
            },
            reComputedPluginLayout: function (a) {
                var b = a.find('.ibar_plugin_title'),
                    c = a.find('.ibar_plugin_content'),
                    d = M.height();
                c.css({
                    height: d - b.outerHeight() + 'px',
                    'overflow-y': 'auto'
                })
            },
            initPlugins: function (a) {
                var c,
                    d = $(a),
                    e = $(a).attr('data-plugin'),
                    f = Q.length,
                    h = 0;
                if (e && G[e]) if (c = $('#' + e), g.children('div').hide(), j.filter('.current').removeClass('current'), d.addClass('current'), c.length) {
                    if (c.show(), b.trigger('likepanelopen', e), 'iBarCart' === e && O !== P) for (P = O; f > h; h++) Q[h]();
                    S.reComputedPluginLayout(c),
                        b.trigger('afterreopenplugin', e)
                } else setTimeout(function () {
                    G[e].init({
                        container: g
                    });
                    var a = $('#' + e);
                    a.length && M.height() < 650 && S.reComputedPluginLayout(a),
                        b.trigger('likepanelopen', e)
                }, 10)
            },
            slideCallback: function (a) {
                S.initPlugins(a),
                    N.bind('click.closesubpanel', function (a) {
                        var c = a.target;
                        c === b[0] || $.contains(b[0], c) || (S.slideSubPanel(), N.unbind('click.closeloginbox'), b.trigger('mouseleave.slidemainpanel'))
                    })
            },
            slideSubPanel: function (a) {
                var c,
                    d = g.is(':visible');  // g --- ibar_sub_panel div  |  并判断是否显示还是隐藏
                    a && ( c = $(a).parents('li').find('div.mp_tooltip'),
                        c.length && c.stop(!0, !0).css('visibility', 'hidden') ),  //对mp_tooltip 进行隐藏操作
                    d ?
                        a ? S.initPlugins(a)  :   // a 存在，进行初始化，不存在，则隐藏操作
                            (g.animate({left: '0px'}, 250, function () {
                                    g.hide(),
                                    j.filter('.current').removeClass('current'),  // j=>a 标签  c.find('ul.ibar_mp_center').find('a')
                                    b.trigger('mouseleave.slidemainpanel') // b 标签 $('#iBar')
                                }), N.unbind('click.closesubpanel' )  // 解除  click 下的 closesubpanel  事件
                        )
                      : ( g.children('div').hide(), g.css('display', 'block').animate({  //展现  ibar_sub_panel
                        left: 0 - z + 'px'
                        }, 200, function () {
                            S.slideCallback(a)   // animate 调用 函数
                        }) )
            },
            showTooltip: function () {
                var a = this;
                r = setTimeout(function () {
                    var b,
                        c = $(a).find('div.mp_tooltip');
                    c.length && (b = parseInt(c.css('left')), c.css({
                        left: b - 30 + 'px',
                        opacity: 0,
                        visibility: 'visible'
                    }).animate({
                        left: b + 'px',
                        opacity: 1
                    }, 300))
                }, 150)
            },
            hideTooltip: function () {
                var a,
                    b = $(this).find('div.mp_tooltip');
                b.length && (clearTimeout(r), a = parseInt(b.css('left')), b.animate({
                    left: a - 30 + 'px',
                    opacity: 0
                }, 300, function () {
                    b.css({
                        visibility: 'hidden',
                        left: '',
                        opacity: ''
                    })
                }))
            },
            showSignBox: function (a) {
                var c = $(a),
                    d = c.offset().top;
                d -= M.scrollTop(),
                    h.css({
                        top: d + 'px',
                        display: 'block'
                    }),
                    N.bind('click.closeloginbox', function (a) {
                        var c = a.target;
                        c === b[0] || $.contains(b[0], c) || (S.hideSignBox(), N.unbind('click.closeloginbox'))
                    })
            },
            hideSignBox: function () {
                h.is(':visible') && (h.hide(), N.unbind('click.hideloginbox'), b.trigger('mouseleave.slidemainpanel'))
            },
            showQrcode: function () {
                clearTimeout(v),
                    u = setTimeout(function () {
                        var a;
                        o.show(),
                        p && (a = p.attr('data-lazysrc'), p[0].src = a, p.removeAttr('data-lazysrc'), p = null)
                    }, 150)
            },
            hideQrcode: function () {
                clearTimeout(u),
                    v = setTimeout(function () {
                        o.hide()
                    }, 150)
            },
            initCartNum: function () {
                var a = 'http://cart.' + F + '/i/ajax/get_cart_data_right';
                $.ajax({
                    url: a,
                    data: {
                        show_type: 'all_quantity',
                        _ajax_: 1,
                        which_cart: 'all'
                    },
                    dataType: 'jsonp',
                    success: function (a) {
                        a && i.text(a.quantity)
                    }
                })
            },
            initDom: function () {
                b = $('#iBar'),
                    c = b.find('div.ibar_main_panel'),
                    d = c.find('li'),
                    e = c.find('li.mpbtn_login').find('a'),
                    f = c.find('li.mpbtn_cart'),
                    g = b.find('div.ibar_sub_panel'),
                    h = b.find('div.ibar_login_box'),
                    i = c.find('span.cart_num'),
                    j = c.find('ul.ibar_mp_center').find('a'),
                    n = c.find('li.mpbtn_qrcode'),
                    o = c.find('div.mp_qrcode'),
                    p = o.find('img'),
                    k = c.find('li.mpbtn_support').find('a')
            },
            initEvent: function (a) {
                //赋予绑定事件 j : ur 下的a 标签
                j.bind('click', function (b) {
                    var c = $(this),
                        d = void 0 !== c.attr('data-plugin'), //是否含有data-plugin 属性
                        e = parseInt(c.attr('data-judgelogin'));  //默认为1
                    d && (
                        1 === e ?
                             a.isLogin ? S.slideSubPanel(this)//如果已登录  直接调用slideSubPanel
                              : (S.hideSignBox(), S.showSignBox(this))  // 未登录  直接展示
                        :  S.slideSubPanel(this) ),
                        b.preventDefault()  // 取消事件默认动作
                }).bind('mouseleave', function () {
                    clearTimeout(s),
                        t = setTimeout(function () {
                            S.hideSignBox()
                        }, 200)
                }),
                    k.bind('click', function (a) {
                        G.iBarFaq.init(),
                            a.preventDefault()
                    }),
                    d.bind('mouseenter', S.showTooltip).bind('mouseleave', S.hideTooltip),
                    n.bind('mouseenter', S.showQrcode).bind('mouseleave', S.hideQrcode),
                    e.bind('mouseenter', function () {
                        var a = this;
                        clearTimeout(t),
                            s = setTimeout(function () {
                                S.showSignBox(a)
                            }, 200)
                    }),
                    h.bind('mouseenter', function () {
                        clearTimeout(t)
                    }).bind('mouseleave', function () {
                        clearTimeout(s),
                            t = setTimeout(function () {
                                S.hideSignBox()
                            }, 200)
                    }),
                    h.find('a.ibar_closebtn').bind('click', function (a) {
                        S.hideSignBox(),
                            a.preventDefault()
                    }),
                    g.find('a.ibar_closebtn').bind('click', function (a) {
                        S.slideSubPanel(),
                        a.preventDefault()
                    })
            },
            hiddenNavEleven: function () {
                var a = window.RM_SERVER_TIME || window.ofs_now_time;
                a > 1415721599 && $('.mpbtn_eleven, .mpbtn_strategy, .yixing').css({
                    visibility: 'hidden'
                })
            },
            init: function (a) {
                J || ($('html,body').css('height', '100%'), S.createiBar(a), S.initDom(), K.fixed(b[0], {
                    top: '0px',
                    right: '0px'
                }), b.css('display', 'block'),
                    //A = a.addCartAjaxUrl,
                    y = c.outerWidth(), z = g.outerWidth(),
                    S.initPluginLayout(),
                    void 0 !== window.__cartNumber__ && i.text(window.__cartNumber__), window.__initiBar__ = !0,
                    S.initEvent(a),
                    S.initMainPanel(a),
                    M.bind('resize.ibar', L(function () {
                    g.is(':visible') && (g.css({
                        display: 'none',
                        left: '0px'
                    }), N.unbind('click.closesubpanel')),
                        S.initMainPanel(a),
                        b.css('height', M.height() + 'px')
                    }, 50)),
                    new Ixy.ui.Gotop({
                    fixed: !1
                    }),
                 C())
            }
        },
        T = function (a) {
            var divB = $.extend({
            }, H, a);// H ,a 合并赋给divB
            this.__o__ = divB,
                $(function () {
                    S.init(divB)
                })
        };
    T.addCart = function (a) {
        E && (E = !1, a.callback = function () {
            S.addCartCallback(a)
        }, S.getAddCartData(a), setTimeout(function () {
            E = !0
        }, 2000))
    },
        T.cartUpdate = function (a) {
            'function' == typeof a && Q.push(a)
        },
        T.cartNumberUpdate = function (a) {
            i && i.text(a)
        },
        T.prototype = {
            on: function (a, c) {
                if (this.__o__) {
                    var d = this;
                    b.bind('like' + a, function (b, e) {
                        b.type = a,
                        'string' == typeof e && (b.pluginName = e),
                            c.call(d, b),
                            b.stopPropagation()
                    })
                }
                return this
            },
            un: function (a) {
                return this.__o__ && this.__o__.target.unbind('like' + a),
                    this
            }
        },
        window.Ixy = window.Ixy || {
        },
        window.Ixy.app = window.Ixy.app || {
        },
        window.Ixy.app.iBar = T
});

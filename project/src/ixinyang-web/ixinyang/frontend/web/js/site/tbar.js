    define('tbar-msg', function (a, b, c) {
        var aurl,
            l = {
                msgbox: '<div class="dropdown-menu--msglist dropdown-menu  dropdown-menu--text"><a class="view-all" target="_blank" href="/message/">查看全部</a>',
                ulmsg:'<ur></ur>',
                nomsg:'<p class="no-msg">暂无新消息</p>'
            },
            m = function (a) {
                this.element = {
                },
                    this.id = a.id || this.id,
                    this.draw(a),
                    this.render()
            };
        m.prototype = {
            id: 'tBarMsg',
            draw: function (a) {
                var b = $(l.msgbox).attr('id', this.id);
                this.element.msglist = b,
                   b.append(l.nomsg);
                    //this.element.msglist = b.find('.dropdown-menu--msglist'),
                    $(a).append(b)
            },
            render: function () {
                this.getAjaxData({}, function (obj) {
                    if(obj!=null){
                        this.element.msglist.find('p').remove();
                        this.element.msglist.append(l.ulmsg),
                        ulmsg = this.element.msglist.find('ur');
                        $(obj).each(function(index) {
                            var ali  ='<li class="current"><a href="'+aurl+ obj[index].msgid +'" target="_blank">'+obj[index].content+'</a></li>';
                            ulmsg.append(ali);
                        });
                    }else{
                        this.element.msglist.append(l.nomsg);
                    }
                }, this)
            },
            clear: function () {
                this.element.msglist.find('ur').remove();
            },
            getAjaxData: function (a, b, c) {//读取消息
                return   $.getJSON(
                        BASEURL + '/index.php?r=message/getmsg', // url
                        a,
                        function (a) {
                            a && b.call(c || this, a)
                        });
            }
        };
        var n = null;
        m.init = function (a) {
            return null == n && (n = new m(a)),
                n
        }, c.exports = m
    }),
define('tbar', [
    'tbar-msg'
    ],
    function (a) {
    'use strict';
    var b,
        c, d, e, f, h, t,
        y,
        H = {
            zIndex: 9999,
            compactWidth: 1050
        },
        G = {
            tBarMsg: a('tbar-msg')
        },
        M = $(window),
        N = $(document.body),
        O = 0,
        P = 0,
        Q = [
        ],
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
            initPlugins: function (a) {
                var c,
                    d = $(a),
                    e = $(a).attr('data-plugin'),
                    f = Q.length,
                    h = 0;
                if (e && G[e])
                    if (c = $('#' + e),  c.length ) {

                    } else{
                        G[e].init(a);
                        var a = $('#' + e);
                        a.length && a.show()
                    }
            },
            showMsgBox: function (a) {
                var c = $(a),
                    d = c.offset().left;
                    e = $(a).attr('data-plugin'),
                    h = $('#' + e),  // 消息盒子
                    h.css({
                        left: d + 'px',
                        display: 'block'
                    })
            },
            hideMsgBox: function () {
                h = c.find('div.dropdown-menu--msglist')
                h.is(':visible') && ( h.hide() )
            },
            initDom: function () {
                b = $('#topBar'),
                    c = b.find('a.dropdown-toggle'),
                    d = c.find('span.badge-success')
            },
            initEvent: function (a) {
                //赋予消息绑定事件
                c.bind('mouseenter', function (b) {
                    var c = $(this),
                        d = void 0 !== c.attr('data-plugin'); //是否含有data-plugin 属性
                        h = c.find('div.dropdown-menu--msglist')
                        a.isLogin && h.length==0 ? S.initPlugins(this) :
                        S.hideMsgBox(), S.showMsgBox(this)   //   直接展示
                        , b.preventDefault()  // 取消事件默认动作
                }).bind('mouseleave', function () {
                        t = setTimeout(function () {
                            S.hideMsgBox()
                        }, 200)
                })
            },
            init: function (a) {
                var b,
                    c,
                    d = S.getCookie('userAccount'); // 判断是否登录
                    a.isLogin = true// '' !== d,
                    S.initDom(),
                    S.initEvent(a)
            }
        },
        Tbar = function (a) {
            var divB = $.extend({
            }, H, a);
            this.__o__ = divB,
                $(function () {
                    S.init(divB)
                })
        };
        window.Ixy = window.Ixy || {
        },
        window.Ixy.app = window.Ixy.app || {
        },
        window.Ixy.app.tBar = Tbar
});

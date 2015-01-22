    define('tbar-msg', function (require, exports, module) {
        require("http://localhost:1337/socket.io/socket.io.js");
        var aurl,  socket,
            l = {
                msgbox: '<div class="dropdown-menu--msglist dropdown-menu  dropdown-menu--text"><a class="view-all" target="_blank" href="/message/">查看全部</a>',
                ulmsg:'<ur></ur>',
                nomsg:'<p class="no-msg">暂无新消息</p>'
            },
            m = function (a,userkey) {
                this.element = {
                },
                    this.id = a.id || this.id,
                    this.draw(a),
                    this.render(),
                    this.initSocket(userkey)
            };
        m.prototype = {
            id: 'tBarMsg',
            draw: function (a) {
                var b = $(l.msgbox).attr('id', this.id);
                this.element.msglist = b,
                this.element.span = $(a),
                b.append(l.nomsg);
                    //this.element.msglist = b.find('.dropdown-menu--msglist'),
                    $(a).parent().append(b)
            },
            render: function () {
                this.getAjaxData({}, function (obj) {
                    this.drawMsgList(obj);
                }, this)
            },
            clear: function () {
                this.element.msglist.find('ur').remove();
            },
            drawMsgList : function(obj){
                var b = $('#topBar'),
                    fspan = b.find('span.dropdown-toggle'),
                    pdiv = b.find('#tBarMsg');
                if(obj!=null){
                    pdiv.find('p').remove();
                    pdiv.append(l.ulmsg),
                    ulmsg = pdiv.find('ur');
                    var i = fspan.find('.badge-success').text();
                    i==''?i=0:i;
                    $(obj).each(function(index) {
                        var ali  ='<li class="current"><a href="'+aurl+ obj[index].msgid +'" target="_blank">'+obj[index].content+'</a></li>';
                        ulmsg.append(ali);
                        i++;
                    });
                    fspan.find('i').removeClass('icon-animated-vertical').addClass('icon-animated-vertical');
                    i > 0 && fspan.find('.badge-success').show().text(i);
                }else{
                    pdiv.append(l.nomsg);
                }
            },
            getAjaxData: function (a, b, c) {//读取消息
                return   $.getJSON(
                        BASEURL + '/index.php?r=message/getmsg', // url
                        a,
                        function (a) {
                            a && b.call(c || this, a)
                        });
            },
            initSocket :  function(userkey){
                socket = io.connect('http://localhost:1337');
                socket.on(userkey, function (data) {
                    m.prototype.drawMsgList(eval('(' + data + ')'));
                });
                socket.on('sys_message', function (data) {
                    m.prototype.drawMsgList(eval('(' + data + ')'));
                });
            },
            emit : function() {
                socket.emit('my other event', $('#input1').val());
            }
    };
        var n = null;
        m.init = function (a,userkey) {
            return null == n && (n = new m(a,userkey)),
                n
        }, module.exports = m
    }),
define('site/tbar', [
    'tbar-msg'
    ],
    function (a) {
    'use strict';
    var b,
        c, d, e, f, h, t, g, i, j, k,
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
            initPlugins: function (a,userkey) {
                var c,
                    d = $(a),
                    e = $(a).attr('data-plugin'),
                    h = 0;
                if (e && G[e]){
                    e == 'tBarMsg' ? G[e].init(a,userkey):   G[e].init(a);
                }
            },
            initMsgBox: function(userkey){
                var c = f.find('.dropdown-toggle'),
                    d = void 0 !== c.attr('data-plugin'); //是否含有data-plugin 属性
                h = c.find('div.dropdown-menu--msglist'),
                S.initPlugins(c,userkey)
            },
            showMsgBox: function (a) {
                    e = c.attr('data-plugin'),
                    h = $('#' + e),  // 消息盒子
                    h.fadeIn()// ,
                    c.addClass('dropdown--open');
            },
            hideMsgBox: function () {
                h = f.find('div.dropdown-menu--msglist')
                h.is(':visible') && ( h.hide() ),
                c.removeClass('dropdown--open');
            },
            initDom: function () {
                b = $('#topBar'),
                    f = b.find('a.dropdown-a'),
                    c = b.find('span.dropdown-toggle'),
                    d = c.find('span.badge-success'),
                    g = b.find('span.dropdown-a'), // 我的爱生活
                    i = $('#HeaderSearchTab'), // 搜索
                    j = i.find('li.trigger'),
                    k = $('#searchBtn'); // 搜索
            },
            initEvent: function (a) {
                //赋予消息绑定事件
                f.bind('mouseenter', function (b) {
                        S.hideMsgBox(), S.showMsgBox(this)   //   直接展示
                        , b.preventDefault()  // 取消事件默认动作
                }).bind('mouseleave', function () {
                        t = setTimeout(function () {
                            S.hideMsgBox()
                        }, 200)
                }),
                //赋予 我的爱生活 导航框事件
                    g.bind('mouseenter',function(){
                        $(this).addClass('dropdown--open'),
                        $('#account-menu').show();
                    }).bind('mouseleave', function () {
                        $(this).removeClass('dropdown--open'),
                        $('#account-menu').hide();;
                    }) ,
                    i.bind('mouseenter',function(){
                        $(this).addClass('tab-hover') ;
                    }).bind('mouseleave', function () {
                        $(this).removeClass('tab-hover') ;
                    }),
                    j.bind('mouseenter',function(){
                        $(this).addClass('selected');
                    }).bind('mouseleave', function () {
                        $(this).removeClass('selected');
                    }).bind('click',function(){
                        $(this).parent().prepend($(this));
                        i.removeClass('tab-hover');
                        $(this).text()=='商品'?i.next('input').attr('placeholder','请输入商品名称')
                            :i.next('input').attr('placeholder','请输入店铺名称');
                        placeholders(i.next('input'));
                    }),
                    j.parent().bind('mouseleave',function(){
                          $(this).find('li:first').addClass('selected');
                    }),
                    k.click(function(){
                        if($.trim(i.next('input').val())!="" && $.trim(i.next('input').val())!="请输入店铺名称"
                            && $.trim(i.next('input').val())!="请输入商品名称"){
                            var sform = $('#searchForm');
                                sform.find('input[name="type"]').val(i.find('li.selected').attr('data-searchtype')),
                                sform.submit();
                        }else{
                            i.next('input').focus();return false;
                        }
                    }),
                    //监听回车
                    $(document).ready(function() {
                     $(document).keydown(function(e) {
                     if (e.keyCode == 13) {
                         if($.trim(i.next('input').val())!="" && $.trim(i.next('input').val())!="请输入店铺名称"
                             && $.trim(i.next('input').val())!="请输入商品名称"){
                             var sform = $('#searchForm');
                             sform.find('input[name="type"]').val(i.find('li.selected').attr('data-searchtype')),
                                 sform.submit();
                         }else{
                             i.next('input').focus();return false;
                         }
                     }
                     });
                     });

            },
            init: function (a) {
                var b,
                    c,
                    d = '18715110787'//S.getCookie('userAccount'); // 判断是否登录
                    a.isLogin = '' !== d,
                    S.initDom(),
                    a.isLogin  && S.initMsgBox(d)  ,
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

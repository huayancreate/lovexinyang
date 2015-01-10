/*!
 * jQuery JavaScript Library v1.4.2
 * http://jquery.com/
 *
 * Copyright 2010, John Resig
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * Includes Sizzle.js
 * http://sizzlejs.com/
 * Copyright 2010, The Dojo Foundation
 * Released under the MIT, BSD, and GPL Licenses.
 *
 * Date: Sat Feb 13 22:33:48 2010 -0500
 */
(function (A, w) {
    function ma() {
        if (!c.isReady) {
            try {
                s.documentElement.doScroll('left')
            } catch (a) {
                setTimeout(ma, 1);
                return
            }
            c.ready()
        }
    }
    function Qa(a, b) {
        b.src ? c.ajax({
            url: b.src,
            async: false,
            dataType: 'script'
        })  : c.globalEval(b.text || b.textContent || b.innerHTML || '');
        b.parentNode && b.parentNode.removeChild(b)
    }
    function X(a, b, d, f, e, j) {
        var i = a.length;
        if (typeof b === 'object') {
            for (var o in b) X(a, o, b[o], f, e, d);
            return a
        }
        if (d !== w) {
            f = !j && f && c.isFunction(d);
            for (o = 0; o < i; o++) e(a[o], b, f ? d.call(a[o], o, e(a[o], b))  : d, j);
            return a
        }
        return i ?
            e(a[0], b)  : w
    }
    function J() {
        return (new Date).getTime()
    }
    function Y() {
        return false
    }
    function Z() {
        return true
    }
    function na(a, b, d) {
        d[0].type = a;
        return c.event.handle.apply(b, d)
    }
    function oa(a) {
        var b,
            d = [
            ],
            f = [
            ],
            e = arguments,
            j,
            i,
            o,
            k,
            n,
            r;
        i = c.data(this, 'events');
        if (!(a.liveFired === this || !i || !i.live || a.button && a.type === 'click')) {
            a.liveFired = this;
            var u = i.live.slice(0);
            for (k = 0; k < u.length; k++) {
                i = u[k];
                i.origType.replace(O, '') === a.type ? f.push(i.selector)  : u.splice(k--, 1)
            }
            j = c(a.target).closest(f, a.currentTarget);
            n = 0;
            for (r =
                     j.length; n < r; n++) for (k = 0; k < u.length; k++) {
                i = u[k];
                if (j[n].selector === i.selector) {
                    o = j[n].elem;
                    f = null;
                    if (i.preType === 'mouseenter' || i.preType === 'mouseleave') f = c(a.relatedTarget).closest(i.selector) [0];
                    if (!f || f !== o) d.push({
                        elem: o,
                        handleObj: i
                    })
                }
            }
            n = 0;
            for (r = d.length; n < r; n++) {
                j = d[n];
                a.currentTarget = j.elem;
                a.data = j.handleObj.data;
                a.handleObj = j.handleObj;
                if (j.handleObj.origHandler.apply(j.elem, e) === false) {
                    b = false;
                    break
                }
            }
            return b
        }
    }
    function pa(a, b) {
        return 'live.' + (a && a !== '*' ? a + '.' : '') + b.replace(/\./g, '`').replace(/ /g, '&')
    }
    function qa(a) {
        return !a || !a.parentNode || a.parentNode.nodeType === 11
    }
    function ra(a, b) {
        var d = 0;
        b.each(function () {
            if (this.nodeName === (a[d] && a[d].nodeName)) {
                var f = c.data(a[d++]),
                    e = c.data(this, f);
                if (f = f && f.events) {
                    delete e.handle;
                    e.events = {
                    };
                    for (var j in f) for (var i in f[j]) c.event.add(this, j, f[j][i], f[j][i].data)
                }
            }
        })
    }
    function sa(a, b, d) {
        var f,
            e,
            j;
        b = b && b[0] ? b[0].ownerDocument || b[0] : s;
        if (a.length === 1 && typeof a[0] === 'string' && a[0].length < 512 && b === s && !ta.test(a[0]) && (c.support.checkClone || !ua.test(a[0]))) {
            e =
                true;
            if (j = c.fragments[a[0]]) if (j !== 1) f = j
        }
        if (!f) {
            f = b.createDocumentFragment();
            c.clean(a, b, f, d)
        }
        if (e) c.fragments[a[0]] = j ? f : 1;
        return {
            fragment: f,
            cacheable: e
        }
    }
    function K(a, b) {
        var d = {
        };
        c.each(va.concat.apply([], va.slice(0, b)), function () {
            d[this] = a
        });
        return d
    }
    function wa(a) {
        return 'scrollTo' in a && a.document ? a : a.nodeType === 9 ? a.defaultView || a.parentWindow : false
    }
    var c = function (a, b) {
            return new c.fn.init(a, b)
        },
        Ra = A.jQuery,
        Sa = A.$,
        s = A.document,
        T,
        Ta = /^[^<]*(<[\w\W]+>)[^>]*$|^#([\w-]+)$/,
        Ua = /^.[^:#\[\.,]*$/,
        Va = /\S/,
        Wa = /^(\s|\u00A0)+|(\s|\u00A0)+$/g,
        Xa = /^<(\w+)\s*\/?>(?:<\/\1>)?$/,
        P = navigator.userAgent,
        xa = false,
        Q = [
        ],
        L,
        $ = Object.prototype.toString,
        aa = Object.prototype.hasOwnProperty,
        ba = Array.prototype.push,
        R = Array.prototype.slice,
        ya = Array.prototype.indexOf;
    c.fn = c.prototype = {
        init: function (a, b) {
            var d,
                f;
            if (!a) return this;
            if (a.nodeType) {
                this.context = this[0] = a;
                this.length = 1;
                return this
            }
            if (a === 'body' && !b) {
                this.context = s;
                this[0] = s.body;
                this.selector = 'body';
                this.length = 1;
                return this
            }
            if (typeof a === 'string') if ((d = Ta.exec(a)) && (d[1] || !b)) if (d[1]) {
                f = b ? b.ownerDocument || b : s;
                if (a = Xa.exec(a)) if (c.isPlainObject(b)) {
                    a = [
                        s.createElement(a[1])
                    ];
                    c.fn.attr.call(a, b, true)
                } else a = [
                    f.createElement(a[1])
                ];
                else {
                    a = sa([d[1]], [
                        f
                    ]);
                    a = (a.cacheable ? a.fragment.cloneNode(true)  : a.fragment).childNodes
                }
                return c.merge(this, a)
            } else {
                if (b = s.getElementById(d[2])) {
                    if (b.id !== d[2]) return T.find(a);
                    this.length = 1;
                    this[0] = b
                }
                this.context = s;
                this.selector = a;
                return this
            } else if (!b && /^\w+$/.test(a)) {
                this.selector = a;
                this.context = s;
                a = s.getElementsByTagName(a);
                return c.merge(this, a)
            } else return !b || b.jquery ? (b || T).find(a)  : c(b).find(a);
            else if (c.isFunction(a)) return T.ready(a);
            if (a.selector !== w) {
                this.selector = a.selector;
                this.context = a.context
            }
            return c.makeArray(a, this)
        },
        selector: '',
        jquery: '1.4.2',
        length: 0,
        size: function () {
            return this.length
        },
        toArray: function () {
            return R.call(this, 0)
        },
        get: function (a) {
            return a == null ? this.toArray()  : a < 0 ? this.slice(a) [0] : this[a]
        },
        pushStack: function (a, b, d) {
            var f = c();
            c.isArray(a) ? ba.apply(f, a)  : c.merge(f, a);
            f.prevObject = this;
            f.context = this.context;
            if (b ===
                'find') f.selector = this.selector + (this.selector ? ' ' : '') + d;
            else if (b) f.selector = this.selector + '.' + b + '(' + d + ')';
            return f
        },
        each: function (a, b) {
            return c.each(this, a, b)
        },
        ready: function (a) {
            c.bindReady();
            if (c.isReady) a.call(s, c);
            else Q && Q.push(a);
            return this
        },
        eq: function (a) {
            return a === - 1 ? this.slice(a)  : this.slice(a, + a + 1)
        },
        first: function () {
            return this.eq(0)
        },
        last: function () {
            return this.eq( - 1)
        },
        slice: function () {
            return this.pushStack(R.apply(this, arguments), 'slice', R.call(arguments).join(','))
        },
        map: function (a) {
            return this.pushStack(c.map(this, function (b, d) {
                return a.call(b, d, b)
            }))
        },
        end: function () {
            return this.prevObject || c(null)
        },
        push: ba,
        sort: [
        ].sort,
        splice: [
        ].splice
    };
    c.fn.init.prototype = c.fn;
    c.extend = c.fn.extend = function () {
        var a = arguments[0] || {
                },
            b = 1,
            d = arguments.length,
            f = false,
            e,
            j,
            i,
            o;
        if (typeof a === 'boolean') {
            f = a;
            a = arguments[1] || {
            };
            b = 2
        }
        if (typeof a !== 'object' && !c.isFunction(a)) a = {
        };
        if (d === b) {
            a = this;
            --b
        }
        for (; b < d; b++) if ((e = arguments[b]) != null) for (j in e) {
            i = a[j];
            o = e[j];
            if (a !== o) if (f && o && (c.isPlainObject(o) || c.isArray(o))) {
                i = i && (c.isPlainObject(i) ||
                c.isArray(i)) ? i : c.isArray(o) ? [
                ] : {
                };
                a[j] = c.extend(f, i, o)
            } else if (o !== w) a[j] = o
        }
        return a
    };
    c.extend({
        noConflict: function (a) {
            A.$ = Sa;
            if (a) A.jQuery = Ra;
            return c
        },
        isReady: false,
        ready: function () {
            if (!c.isReady) {
                if (!s.body) return setTimeout(c.ready, 13);
                c.isReady = true;
                if (Q) {
                    for (var a, b = 0; a = Q[b++]; ) a.call(s, c);
                    Q = null
                }
                c.fn.triggerHandler && c(s).triggerHandler('ready')
            }
        },
        bindReady: function () {
            if (!xa) {
                xa = true;
                if (s.readyState === 'complete') return c.ready();
                if (s.addEventListener) {
                    s.addEventListener('DOMContentLoaded', L, false);
                    A.addEventListener('load', c.ready, false)
                } else if (s.attachEvent) {
                    s.attachEvent('onreadystatechange', L);
                    A.attachEvent('onload', c.ready);
                    var a = false;
                    try {
                        a = A.frameElement == null
                    } catch (b) {
                    }
                    s.documentElement.doScroll && a && ma()
                }
            }
        },
        isFunction: function (a) {
            return $.call(a) === '[object Function]'
        },
        isArray: function (a) {
            return $.call(a) === '[object Array]'
        },
        isPlainObject: function (a) {
            if (!a || $.call(a) !== '[object Object]' || a.nodeType || a.setInterval) return false;
            if (a.constructor && !aa.call(a, 'constructor') && !aa.call(a.constructor.prototype, 'isPrototypeOf')) return false;
            var b;
            for (b in a);
            return b === w || aa.call(a, b)
        },
        isEmptyObject: function (a) {
            for (var b in a) return false;
            return true
        },
        error: function (a) {
            throw a;
        },
        parseJSON: function (a) {
            if (typeof a !== 'string' || !a) return null;
            a = c.trim(a);
            if (/^[\],:{}\s]*$/.test(a.replace(/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g, '@').replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']').replace(/(?:^|:|,)(?:\s*\[)+/g, ''))) return A.JSON && A.JSON.parse ? A.JSON.parse(a)  : (new Function('return ' +
            a)) ();
            else c.error('Invalid JSON: ' + a)
        },
        noop: function () {
        },
        globalEval: function (a) {
            if (a && Va.test(a)) {
                var b = s.getElementsByTagName('head') [0] || s.documentElement,
                    d = s.createElement('script');
                d.type = 'text/javascript';
                if (c.support.scriptEval) d.appendChild(s.createTextNode(a));
                else d.text = a;
                b.insertBefore(d, b.firstChild);
                b.removeChild(d)
            }
        },
        nodeName: function (a, b) {
            return a.nodeName && a.nodeName.toUpperCase() === b.toUpperCase()
        },
        each: function (a, b, d) {
            var f,
                e = 0,
                j = a.length,
                i = j === w || c.isFunction(a);
            if (d) if (i) for (f in a) {
                if (b.apply(a[f], d) === false) break
            } else for (; e < j; ) {
                if (b.apply(a[e++], d) === false) break
            } else if (i) for (f in a) {
                if (b.call(a[f], f, a[f]) === false) break
            } else for (d = a[0]; e < j && b.call(d, e, d) !== false; d = a[++e]);
            return a
        },
        trim: function (a) {
            return (a || '').replace(Wa, '')
        },
        makeArray: function (a, b) {
            b = b || [];
            if (a != null) a.length == null || typeof a === 'string' || c.isFunction(a) || typeof a !== 'function' && a.setInterval ? ba.call(b, a)  : c.merge(b, a);
            return b
        },
        inArray: function (a, b) {
            if (b.indexOf) return b.indexOf(a);
            for (var d = 0, f = b.length; d < f; d++) if (b[d] ===
                a) return d;
            return - 1
        },
        merge: function (a, b) {
            var d = a.length,
                f = 0;
            if (typeof b.length === 'number') for (var e = b.length; f < e; f++) a[d++] = b[f];
            else for (; b[f] !== w; ) a[d++] = b[f++];
            a.length = d;
            return a
        },
        grep: function (a, b, d) {
            for (var f = [
            ], e = 0, j = a.length; e < j; e++) !d !== !b(a[e], e) && f.push(a[e]);
            return f
        },
        map: function (a, b, d) {
            for (var f = [
            ], e, j = 0, i = a.length; j < i; j++) {
                e = b(a[j], j, d);
                if (e != null) f[f.length] = e
            }
            return f.concat.apply([], f)
        },
        guid: 1,
        proxy: function (a, b, d) {
            if (arguments.length === 2) if (typeof b === 'string') {
                d = a;
                a = d[b];
                b = w
            } else if (b &&
                !c.isFunction(b)) {
                d = b;
                b = w
            }
            if (!b && a) b = function () {
                return a.apply(d || this, arguments)
            };
            if (a) b.guid = a.guid = a.guid || b.guid || c.guid++;
            return b
        },
        uaMatch: function (a) {
            a = a.toLowerCase();
            a = /(webkit)[ \/]([\w.]+)/.exec(a) || /(opera)(?:.*version)?[ \/]([\w.]+)/.exec(a) || /(msie) ([\w.]+)/.exec(a) || !/compatible/.test(a) && /(mozilla)(?:.*? rv:([\w.]+))?/.exec(a) || [];
            return {
                browser: a[1] || '',
                version: a[2] || '0'
            }
        },
        browser: {
        }
    });
    P = c.uaMatch(P);
    if (P.browser) {
        c.browser[P.browser] = true;
        c.browser.version = P.version
    }
    if (c.browser.webkit) c.browser.safari =
        true;
    if (ya) c.inArray = function (a, b) {
        return ya.call(b, a)
    };
    T = c(s);
    if (s.addEventListener) L = function () {
        s.removeEventListener('DOMContentLoaded', L, false);
        c.ready()
    };
    else if (s.attachEvent) L = function () {
        if (s.readyState === 'complete') {
            s.detachEvent('onreadystatechange', L);
            c.ready()
        }
    };
    (function () {
        c.support = {
        };
        var a = s.documentElement,
            b = s.createElement('script'),
            d = s.createElement('div'),
            f = 'script' + J();
        d.style.display = 'none';
        d.innerHTML = '   <link/><table></table><a href=\'/a\' style=\'color:red;float:left;opacity:.55;\'>a</a><input type=\'checkbox\'/>';
        var e = d.getElementsByTagName('*'),
            j = d.getElementsByTagName('a') [0];
        if (!(!e || !e.length || !j)) {
            c.support = {
                leadingWhitespace: d.firstChild.nodeType === 3,
                tbody: !d.getElementsByTagName('tbody').length,
                htmlSerialize: !!d.getElementsByTagName('link').length,
                style: /red/.test(j.getAttribute('style')),
                hrefNormalized: j.getAttribute('href') === '/a',
                opacity: /^0.55$/.test(j.style.opacity),
                cssFloat: !!j.style.cssFloat,
                checkOn: d.getElementsByTagName('input') [0].value === 'on',
                optSelected: s.createElement('select').appendChild(s.createElement('option')).selected,
                parentNode: d.removeChild(d.appendChild(s.createElement('div'))).parentNode === null,
                deleteExpando: true,
                checkClone: false,
                scriptEval: false,
                noCloneEvent: true,
                boxModel: null
            };
            b.type = 'text/javascript';
            try {
                b.appendChild(s.createTextNode('window.' + f + '=1;'))
            } catch (i) {
            }
            a.insertBefore(b, a.firstChild);
            if (A[f]) {
                c.support.scriptEval = true;
                delete A[f]
            }
            try {
                delete b.test
            } catch (o) {
                c.support.deleteExpando = false
            }
            a.removeChild(b);
            if (d.attachEvent && d.fireEvent) {
                d.attachEvent('onclick', function k() {
                    c.support.noCloneEvent =
                        false;
                    d.detachEvent('onclick', k)
                });
                d.cloneNode(true).fireEvent('onclick')
            }
            d = s.createElement('div');
            d.innerHTML = '<input type=\'radio\' name=\'radiotest\' checked=\'checked\'/>';
            a = s.createDocumentFragment();
            a.appendChild(d.firstChild);
            c.support.checkClone = a.cloneNode(true).cloneNode(true).lastChild.checked;
            c(function () {
                var k = s.createElement('div');
                k.style.width = k.style.paddingLeft = '1px';
                s.body.appendChild(k);
                c.boxModel = c.support.boxModel = k.offsetWidth === 2;
                s.body.removeChild(k).style.display = 'none'
            });
            a = function (k) {
                var n =
                    s.createElement('div');
                k = 'on' + k;
                var r = k in n;
                if (!r) {
                    n.setAttribute(k, 'return;');
                    r = typeof n[k] === 'function'
                }
                return r
            };
            c.support.submitBubbles = a('submit');
            c.support.changeBubbles = a('change');
            a = b = d = e = j = null
        }
    }) ();
    c.props = {
        'for': 'htmlFor',
        'class': 'className',
        readonly: 'readOnly',
        maxlength: 'maxLength',
        cellspacing: 'cellSpacing',
        rowspan: 'rowSpan',
        colspan: 'colSpan',
        tabindex: 'tabIndex',
        usemap: 'useMap',
        frameborder: 'frameBorder'
    };
    var G = 'jQuery' + J(),
        Ya = 0,
        za = {
        };
    c.extend({
        cache: {
        },
        expando: G,
        noData: {
            embed: true,
            object: true,
            applet: true
        },
        data: function (a, b, d) {
            if (!(a.nodeName && c.noData[a.nodeName.toLowerCase()])) {
                a = a == A ? za : a;
                var f = a[G],
                    e = c.cache;
                if (!f && typeof b === 'string' && d === w) return null;
                f || (f = ++Ya);
                if (typeof b === 'object') {
                    a[G] = f;
                    e[f] = c.extend(true, {
                    }, b)
                } else if (!e[f]) {
                    a[G] = f;
                    e[f] = {
                    }
                }
                a = e[f];
                if (d !== w) a[b] = d;
                return typeof b === 'string' ? a[b] : a
            }
        },
        removeData: function (a, b) {
            if (!(a.nodeName && c.noData[a.nodeName.toLowerCase()])) {
                a = a == A ? za : a;
                var d = a[G],
                    f = c.cache,
                    e = f[d];
                if (b) {
                    if (e) {
                        delete e[b];
                        c.isEmptyObject(e) && c.removeData(a)
                    }
                } else {
                    if (c.support.deleteExpando) delete a[c.expando];
                    else a.removeAttribute && a.removeAttribute(c.expando);
                    delete f[d]
                }
            }
        }
    });
    c.fn.extend({
        data: function (a, b) {
            if (typeof a === 'undefined' && this.length) return c.data(this[0]);
            else if (typeof a === 'object') return this.each(function () {
                c.data(this, a)
            });
            var d = a.split('.');
            d[1] = d[1] ? '.' + d[1] : '';
            if (b === w) {
                var f = this.triggerHandler('getData' + d[1] + '!', [
                    d[0]
                ]);
                if (f === w && this.length) f = c.data(this[0], a);
                return f === w && d[1] ? this.data(d[0])  : f
            } else return this.trigger('setData' + d[1] + '!', [
                d[0],
                b
            ]).each(function () {
                c.data(this, a, b)
            })
        },
        removeData: function (a) {
            return this.each(function () {
                c.removeData(this, a)
            })
        }
    });
    c.extend({
        queue: function (a, b, d) {
            if (a) {
                b = (b || 'fx') + 'queue';
                var f = c.data(a, b);
                if (!d) return f || [];
                if (!f || c.isArray(d)) f = c.data(a, b, c.makeArray(d));
                else f.push(d);
                return f
            }
        },
        dequeue: function (a, b) {
            b = b || 'fx';
            var d = c.queue(a, b),
                f = d.shift();
            if (f === 'inprogress') f = d.shift();
            if (f) {
                b === 'fx' && d.unshift('inprogress');
                f.call(a, function () {
                    c.dequeue(a, b)
                })
            }
        }
    });
    c.fn.extend({
        queue: function (a, b) {
            if (typeof a !== 'string') {
                b = a;
                a = 'fx'
            }
            if (b ===
                w) return c.queue(this[0], a);
            return this.each(function () {
                var d = c.queue(this, a, b);
                a === 'fx' && d[0] !== 'inprogress' && c.dequeue(this, a)
            })
        },
        dequeue: function (a) {
            return this.each(function () {
                c.dequeue(this, a)
            })
        },
        delay: function (a, b) {
            a = c.fx ? c.fx.speeds[a] || a : a;
            b = b || 'fx';
            return this.queue(b, function () {
                var d = this;
                setTimeout(function () {
                    c.dequeue(d, b)
                }, a)
            })
        },
        clearQueue: function (a) {
            return this.queue(a || 'fx', [
            ])
        }
    });
    var Aa = /[\n\t]/g,
        ca = /\s+/,
        Za = /\r/g,
        $a = /href|src|style/,
        ab = /(button|input)/i,
        bb = /(button|input|object|select|textarea)/i,
        cb = /^(a|area)$/i,
        Ba = /radio|checkbox/;
    c.fn.extend({
        attr: function (a, b) {
            return X(this, a, b, true, c.attr)
        },
        removeAttr: function (a) {
            return this.each(function () {
                c.attr(this, a, '');
                this.nodeType === 1 && this.removeAttribute(a)
            })
        },
        addClass: function (a) {
            if (c.isFunction(a)) return this.each(function (n) {
                var r = c(this);
                r.addClass(a.call(this, n, r.attr('class')))
            });
            if (a && typeof a === 'string') for (var b = (a || '').split(ca), d = 0, f = this.length; d < f; d++) {
                var e = this[d];
                if (e.nodeType === 1) if (e.className) {
                    for (var j = ' ' + e.className + ' ', i = e.className, o = 0, k = b.length; o < k; o++) if (j.indexOf(' ' + b[o] + ' ') < 0) i += ' ' + b[o];
                    e.className = c.trim(i)
                } else e.className = a
            }
            return this
        },
        removeClass: function (a) {
            if (c.isFunction(a)) return this.each(function (k) {
                var n = c(this);
                n.removeClass(a.call(this, k, n.attr('class')))
            });
            if (a && typeof a === 'string' || a === w) for (var b = (a || '').split(ca), d = 0, f = this.length; d < f; d++) {
                var e = this[d];
                if (e.nodeType === 1 && e.className) if (a) {
                    for (var j = (' ' + e.className + ' ').replace(Aa, ' '), i = 0, o = b.length; i < o; i++) j = j.replace(' ' + b[i] + ' ', ' ');
                    e.className = c.trim(j)
                } else e.className = ''
            }
            return this
        },
        toggleClass: function (a, b) {
            var d = typeof a,
                f = typeof b === 'boolean';
            if (c.isFunction(a)) return this.each(function (e) {
                var j = c(this);
                j.toggleClass(a.call(this, e, j.attr('class'), b), b)
            });
            return this.each(function () {
                if (d === 'string') for (var e, j = 0, i = c(this), o = b, k = a.split(ca); e = k[j++]; ) {
                    o = f ? o : !i.hasClass(e);
                    i[o ? 'addClass' : 'removeClass'](e)
                } else if (d === 'undefined' || d === 'boolean') {
                    this.className && c.data(this, '__className__', this.className);
                    this.className =
                        this.className || a === false ? '' : c.data(this, '__className__') || ''
                }
            })
        },
        hasClass: function (a) {
            a = ' ' + a + ' ';
            for (var b = 0, d = this.length; b < d; b++) if ((' ' + this[b].className + ' ').replace(Aa, ' ').indexOf(a) > - 1) return true;
            return false
        },
        val: function (a) {
            if (a === w) {
                var b = this[0];
                if (b) {
                    if (c.nodeName(b, 'option')) return (b.attributes.value || {
                    }).specified ? b.value : b.text;
                    if (c.nodeName(b, 'select')) {
                        var d = b.selectedIndex,
                            f = [
                            ],
                            e = b.options;
                        b = b.type === 'select-one';
                        if (d < 0) return null;
                        var j = b ? d : 0;
                        for (d = b ? d + 1 : e.length; j < d; j++) {
                            var i =
                                e[j];
                            if (i.selected) {
                                a = c(i).val();
                                if (b) return a;
                                f.push(a)
                            }
                        }
                        return f
                    }
                    if (Ba.test(b.type) && !c.support.checkOn) return b.getAttribute('value') === null ? 'on' : b.value;
                    return (b.value || '').replace(Za, '')
                }
                return w
            }
            var o = c.isFunction(a);
            return this.each(function (k) {
                var n = c(this),
                    r = a;
                if (this.nodeType === 1) {
                    if (o) r = a.call(this, k, n.val());
                    if (typeof r === 'number') r += '';
                    if (c.isArray(r) && Ba.test(this.type)) this.checked = c.inArray(n.val(), r) >= 0;
                    else if (c.nodeName(this, 'select')) {
                        var u = c.makeArray(r);
                        c('option', this).each(function () {
                            this.selected =
                                c.inArray(c(this).val(), u) >= 0
                        });
                        if (!u.length) this.selectedIndex = - 1
                    } else this.value = r
                }
            })
        }
    });
    c.extend({
        attrFn: {
            val: true,
            css: true,
            html: true,
            text: true,
            data: true,
            width: true,
            height: true,
            offset: true
        },
        attr: function (a, b, d, f) {
            if (!a || a.nodeType === 3 || a.nodeType === 8) return w;
            if (f && b in c.attrFn) return c(a) [b](d);
            f = a.nodeType !== 1 || !c.isXMLDoc(a);
            var e = d !== w;
            b = f && c.props[b] || b;
            if (a.nodeType === 1) {
                var j = $a.test(b);
                if (b in a && f && !j) {
                    if (e) {
                        b === 'type' && ab.test(a.nodeName) && a.parentNode && c.error('type property can\'t be changed');
                        a[b] = d
                    }
                    if (c.nodeName(a, 'form') && a.getAttributeNode(b)) return a.getAttributeNode(b).nodeValue;
                    if (b === 'tabIndex') return (b = a.getAttributeNode('tabIndex')) && b.specified ? b.value : bb.test(a.nodeName) || cb.test(a.nodeName) && a.href ? 0 : w;
                    return a[b]
                }
                if (!c.support.style && f && b === 'style') {
                    if (e) a.style.cssText = '' + d;
                    return a.style.cssText
                }
                e && a.setAttribute(b, '' + d);
                a = !c.support.hrefNormalized && f && j ? a.getAttribute(b, 2)  : a.getAttribute(b);
                return a === null ? w : a
            }
            return c.style(a, b, d)
        }
    });
    var O = /\.(.*)$/,
        db = function (a) {
            return a.replace(/[^\w\s\.\|`]/g, function (b) {
                return '\\' + b
            })
        };
    c.event = {
        add: function (a, b, d, f) {
            if (!(a.nodeType === 3 || a.nodeType === 8)) {
                if (a.setInterval && a !== A && !a.frameElement) a = A;
                var e,
                    j;
                if (d.handler) {
                    e = d;
                    d = e.handler
                }
                if (!d.guid) d.guid = c.guid++;
                if (j = c.data(a)) {
                    var i = j.events = j.events || {
                        },
                        o = j.handle;
                    if (!o) j.handle = o = function () {
                        return typeof c !== 'undefined' && !c.event.triggered ? c.event.handle.apply(o.elem, arguments)  : w
                    };
                    o.elem = a;
                    b = b.split(' ');
                    for (var k, n = 0, r; k = b[n++]; ) {
                        j = e ? c.extend({
                        }, e)  : {
                            handler: d,
                            data: f
                        };
                        if (k.indexOf('.') > - 1) {
                            r = k.split('.');
                            k = r.shift();
                            j.namespace = r.slice(0).sort().join('.')
                        } else {
                            r = [
                            ];
                            j.namespace = ''
                        }
                        j.type = k;
                        j.guid = d.guid;
                        var u = i[k],
                            z = c.event.special[k] || {
                                };
                        if (!u) {
                            u = i[k] = [
                            ];
                            if (!z.setup || z.setup.call(a, f, r, o) === false) if (a.addEventListener) a.addEventListener(k, o, false);
                            else a.attachEvent && a.attachEvent('on' + k, o)
                        }
                        if (z.add) {
                            z.add.call(a, j);
                            if (!j.handler.guid) j.handler.guid = d.guid
                        }
                        u.push(j);
                        c.event.global[k] = true
                    }
                    a = null
                }
            }
        },
        global: {
        },
        remove: function (a, b, d, f) {
            if (!(a.nodeType === 3 || a.nodeType === 8)) {
                var e,
                    j = 0,
                    i,
                    o,
                    k,
                    n,
                    r,
                    u,
                    z = c.data(a),
                    C = z && z.events;
                if (z && C) {
                    if (b && b.type) {
                        d = b.handler;
                        b = b.type
                    }
                    if (!b || typeof b === 'string' && b.charAt(0) === '.') {
                        b = b || '';
                        for (e in C) c.event.remove(a, e + b)
                    } else {
                        for (b = b.split(' '); e = b[j++]; ) {
                            n = e;
                            i = e.indexOf('.') < 0;
                            o = [
                            ];
                            if (!i) {
                                o = e.split('.');
                                e = o.shift();
                                k = new RegExp('(^|\\.)' + c.map(o.slice(0).sort(), db).join('\\.(?:.*\\.)?') + '(\\.|$)')
                            }
                            if (r = C[e]) if (d) {
                                n = c.event.special[e] || {
                                };
                                for (B = f || 0; B < r.length; B++) {
                                    u = r[B];
                                    if (d.guid === u.guid) {
                                        if (i || k.test(u.namespace)) {
                                            f == null && r.splice(B--, 1);
                                            n.remove && n.remove.call(a, u)
                                        }
                                        if (f !=
                                            null) break
                                    }
                                }
                                if (r.length === 0 || f != null && r.length === 1) {
                                    if (!n.teardown || n.teardown.call(a, o) === false) Ca(a, e, z.handle);
                                    delete C[e]
                                }
                            } else for (var B = 0; B < r.length; B++) {
                                u = r[B];
                                if (i || k.test(u.namespace)) {
                                    c.event.remove(a, n, u.handler, B);
                                    r.splice(B--, 1)
                                }
                            }
                        }
                        if (c.isEmptyObject(C)) {
                            if (b = z.handle) b.elem = null;
                            delete z.events;
                            delete z.handle;
                            c.isEmptyObject(z) && c.removeData(a)
                        }
                    }
                }
            }
        },
        trigger: function (a, b, d, f) {
            var e = a.type || a;
            if (!f) {
                a = typeof a === 'object' ? a[G] ? a : c.extend(c.Event(e), a)  : c.Event(e);
                if (e.indexOf('!') >= 0) {
                    a.type =
                        e = e.slice(0, - 1);
                    a.exclusive = true
                }
                if (!d) {
                    a.stopPropagation();
                    c.event.global[e] && c.each(c.cache, function () {
                        this.events && this.events[e] && c.event.trigger(a, b, this.handle.elem)
                    })
                }
                if (!d || d.nodeType === 3 || d.nodeType === 8) return w;
                a.result = w;
                a.target = d;
                b = c.makeArray(b);
                b.unshift(a)
            }
            a.currentTarget = d;
            (f = c.data(d, 'handle')) && f.apply(d, b);
            f = d.parentNode || d.ownerDocument;
            try {
                if (!(d && d.nodeName && c.noData[d.nodeName.toLowerCase()])) if (d['on' + e] && d['on' + e].apply(d, b) === false) a.result = false
            } catch (j) {
            }
            if (!a.isPropagationStopped() &&
                f) c.event.trigger(a, b, f, true);
            else if (!a.isDefaultPrevented()) {
                f = a.target;
                var i,
                    o = c.nodeName(f, 'a') && e === 'click',
                    k = c.event.special[e] || {
                        };
                if ((!k._default || k._default.call(d, a) === false) && !o && !(f && f.nodeName && c.noData[f.nodeName.toLowerCase()])) {
                    try {
                        if (f[e]) {
                            if (i = f['on' + e]) f['on' + e] = null;
                            c.event.triggered = true;
                            f[e]()
                        }
                    } catch (n) {
                    }
                    if (i) f['on' + e] = i;
                    c.event.triggered = false
                }
            }
        },
        handle: function (a) {
            var b,
                d,
                f,
                e;
            a = arguments[0] = c.event.fix(a || A.event);
            a.currentTarget = this;
            b = a.type.indexOf('.') < 0 && !a.exclusive;
            if (!b) {
                d = a.type.split('.');
                a.type = d.shift();
                f = new RegExp('(^|\\.)' + d.slice(0).sort().join('\\.(?:.*\\.)?') + '(\\.|$)')
            }
            e = c.data(this, 'events');
            d = e[a.type];
            if (e && d) {
                d = d.slice(0);
                e = 0;
                for (var j = d.length; e < j; e++) {
                    var i = d[e];
                    if (b || f.test(i.namespace)) {
                        a.handler = i.handler;
                        a.data = i.data;
                        a.handleObj = i;
                        i = i.handler.apply(this, arguments);
                        if (i !== w) {
                            a.result = i;
                            if (i === false) {
                                a.preventDefault();
                                a.stopPropagation()
                            }
                        }
                        if (a.isImmediatePropagationStopped()) break
                    }
                }
            }
            return a.result
        },
        props: 'altKey attrChange attrName bubbles button cancelable charCode clientX clientY ctrlKey currentTarget data detail eventPhase fromElement handler keyCode layerX layerY metaKey newValue offsetX offsetY originalTarget pageX pageY prevValue relatedNode relatedTarget screenX screenY shiftKey srcElement target toElement view wheelDelta which'.split(' '),
        fix: function (a) {
            if (a[G]) return a;
            var b = a;
            a = c.Event(b);
            for (var d = this.props.length, f; d; ) {
                f = this.props[--d];
                a[f] = b[f]
            }
            if (!a.target) a.target = a.srcElement || s;
            if (a.target.nodeType === 3) a.target = a.target.parentNode;
            if (!a.relatedTarget && a.fromElement) a.relatedTarget = a.fromElement === a.target ? a.toElement : a.fromElement;
            if (a.pageX == null && a.clientX != null) {
                b = s.documentElement;
                d = s.body;
                a.pageX = a.clientX + (b && b.scrollLeft || d && d.scrollLeft || 0) - (b && b.clientLeft || d && d.clientLeft || 0);
                a.pageY = a.clientY + (b && b.scrollTop ||
                d && d.scrollTop || 0) - (b && b.clientTop || d && d.clientTop || 0)
            }
            if (!a.which && (a.charCode || a.charCode === 0 ? a.charCode : a.keyCode)) a.which = a.charCode || a.keyCode;
            if (!a.metaKey && a.ctrlKey) a.metaKey = a.ctrlKey;
            if (!a.which && a.button !== w) a.which = a.button & 1 ? 1 : a.button & 2 ? 3 : a.button & 4 ? 2 : 0;
            return a
        },
        guid: 100000000,
        proxy: c.proxy,
        special: {
            ready: {
                setup: c.bindReady,
                teardown: c.noop
            },
            live: {
                add: function (a) {
                    c.event.add(this, a.origType, c.extend({
                    }, a, {
                        handler: oa
                    }))
                },
                remove: function (a) {
                    var b = true,
                        d = a.origType.replace(O, '');
                    c.each(c.data(this, 'events').live || [], function () {
                        if (d === this.origType.replace(O, '')) return b = false
                    });
                    b && c.event.remove(this, a.origType, oa)
                }
            },
            beforeunload: {
                setup: function (a, b, d) {
                    if (this.setInterval) this.onbeforeunload = d;
                    return false
                },
                teardown: function (a, b) {
                    if (this.onbeforeunload === b) this.onbeforeunload = null
                }
            }
        }
    };
    var Ca = s.removeEventListener ? function (a, b, d) {
        a.removeEventListener(b, d, false)
    }
        : function (a, b, d) {
        a.detachEvent('on' + b, d)
    };
    c.Event = function (a) {
        if (!this.preventDefault) return new c.Event(a);
        if (a && a.type) {
            this.originalEvent =
                a;
            this.type = a.type
        } else this.type = a;
        this.timeStamp = J();
        this[G] = true
    };
    c.Event.prototype = {
        preventDefault: function () {
            this.isDefaultPrevented = Z;
            var a = this.originalEvent;
            if (a) {
                a.preventDefault && a.preventDefault();
                a.returnValue = false
            }
        },
        stopPropagation: function () {
            this.isPropagationStopped = Z;
            var a = this.originalEvent;
            if (a) {
                a.stopPropagation && a.stopPropagation();
                a.cancelBubble = true
            }
        },
        stopImmediatePropagation: function () {
            this.isImmediatePropagationStopped = Z;
            this.stopPropagation()
        },
        isDefaultPrevented: Y,
        isPropagationStopped: Y,
        isImmediatePropagationStopped: Y
    };
    var Da = function (a) {
            var b = a.relatedTarget;
            try {
                for (; b && b !== this; ) b = b.parentNode;
                if (b !== this) {
                    a.type = a.data;
                    c.event.handle.apply(this, arguments)
                }
            } catch (d) {
            }
        },
        Ea = function (a) {
            a.type = a.data;
            c.event.handle.apply(this, arguments)
        };
    c.each({
        mouseenter: 'mouseover',
        mouseleave: 'mouseout'
    }, function (a, b) {
        c.event.special[a] = {
            setup: function (d) {
                c.event.add(this, b, d && d.selector ? Ea : Da, a)
            },
            teardown: function (d) {
                c.event.remove(this, b, d && d.selector ? Ea : Da)
            }
        }
    });
    if (!c.support.submitBubbles) c.event.special.submit =
    {
        setup: function () {
            if (this.nodeName.toLowerCase() !== 'form') {
                c.event.add(this, 'click.specialSubmit', function (a) {
                    var b = a.target,
                        d = b.type;
                    if ((d === 'submit' || d === 'image') && c(b).closest('form').length) return na('submit', this, arguments)
                });
                c.event.add(this, 'keypress.specialSubmit', function (a) {
                    var b = a.target,
                        d = b.type;
                    if ((d === 'text' || d === 'password') && c(b).closest('form').length && a.keyCode === 13) return na('submit', this, arguments)
                })
            } else return false
        },
        teardown: function () {
            c.event.remove(this, '.specialSubmit')
        }
    };
    if (!c.support.changeBubbles) {
        var da = /textarea|input|select/i,
            ea,
            Fa = function (a) {
                var b = a.type,
                    d = a.value;
                if (b === 'radio' || b === 'checkbox') d = a.checked;
                else if (b === 'select-multiple') d = a.selectedIndex > - 1 ? c.map(a.options, function (f) {
                    return f.selected
                }).join('-')  : '';
                else if (a.nodeName.toLowerCase() === 'select') d = a.selectedIndex;
                return d
            },
            fa = function (a, b) {
                var d = a.target,
                    f,
                    e;
                if (!(!da.test(d.nodeName) || d.readOnly)) {
                    f = c.data(d, '_change_data');
                    e = Fa(d);
                    if (a.type !== 'focusout' || d.type !== 'radio') c.data(d, '_change_data', e);
                    if (!(f === w || e === f)) if (f != null || e) {
                        a.type = 'change';
                        return c.event.trigger(a, b, d)
                    }
                }
            };
        c.event.special.change = {
            filters: {
                focusout: fa,
                click: function (a) {
                    var b = a.target,
                        d = b.type;
                    if (d === 'radio' || d === 'checkbox' || b.nodeName.toLowerCase() === 'select') return fa.call(this, a)
                },
                keydown: function (a) {
                    var b = a.target,
                        d = b.type;
                    if (a.keyCode === 13 && b.nodeName.toLowerCase() !== 'textarea' || a.keyCode === 32 && (d === 'checkbox' || d === 'radio') || d === 'select-multiple') return fa.call(this, a)
                },
                beforeactivate: function (a) {
                    a = a.target;
                    c.data(a, '_change_data', Fa(a))
                }
            },
            setup: function () {
                if (this.type === 'file') return false;
                for (var a in ea) c.event.add(this, a + '.specialChange', ea[a]);
                return da.test(this.nodeName)
            },
            teardown: function () {
                c.event.remove(this, '.specialChange');
                return da.test(this.nodeName)
            }
        };
        ea = c.event.special.change.filters
    }
    s.addEventListener && c.each({
        focus: 'focusin',
        blur: 'focusout'
    }, function (a, b) {
        function d(f) {
            f = c.event.fix(f);
            f.type = b;
            return c.event.handle.call(this, f)
        }
        c.event.special[b] = {
            setup: function () {
                this.addEventListener(a, d, true)
            },
            teardown: function () {
                this.removeEventListener(a, d, true)
            }
        }
    });
    c.each(['bind',
        'one'], function (a, b) {
        c.fn[b] = function (d, f, e) {
            if (typeof d === 'object') {
                for (var j in d) this[b](j, f, d[j], e);
                return this
            }
            if (c.isFunction(f)) {
                e = f;
                f = w
            }
            var i = b === 'one' ? c.proxy(e, function (k) {
                c(this).unbind(k, i);
                return e.apply(this, arguments)
            })  : e;
            if (d === 'unload' && b !== 'one') this.one(d, f, e);
            else {
                j = 0;
                for (var o = this.length; j < o; j++) c.event.add(this[j], d, i, f)
            }
            return this
        }
    });
    c.fn.extend({
        unbind: function (a, b) {
            if (typeof a === 'object' &&
                !a.preventDefault) for (var d in a) this.unbind(d, a[d]);
            else {
                d = 0;
                for (var f = this.length; d < f; d++) c.event.remove(this[d], a, b)
            }
            return this
        },
        delegate: function (a, b, d, f) {
            return this.live(b, d, f, a)
        },
        undelegate: function (a, b, d) {
            return arguments.length === 0 ? this.unbind('live')  : this.die(b, null, d, a)
        },
        trigger: function (a, b) {
            return this.each(function () {
                c.event.trigger(a, b, this)
            })
        },
        triggerHandler: function (a, b) {
            if (this[0]) {
                a = c.Event(a);
                a.preventDefault();
                a.stopPropagation();
                c.event.trigger(a, b, this[0]);
                return a.result
            }
        },
        toggle: function (a) {
            for (var b = arguments, d = 1; d < b.length; ) c.proxy(a, b[d++]);
            return this.click(c.proxy(a, function (f) {
                var e = (c.data(this, 'lastToggle' + a.guid) || 0) % d;
                c.data(this, 'lastToggle' + a.guid, e + 1);
                f.preventDefault();
                return b[e].apply(this, arguments) || false
            }))
        },
        hover: function (a, b) {
            return this.mouseenter(a).mouseleave(b || a)
        }
    });
    var Ga = {
        focus: 'focusin',
        blur: 'focusout',
        mouseenter: 'mouseover',
        mouseleave: 'mouseout'
    };
    c.each(['live',
        'die'], function (a, b) {
        c.fn[b] = function (d, f, e, j) {
            var i,
                o = 0,
                k,
                n,
                r = j || this.selector,
                u = j ? this : c(this.context);
            if (c.isFunction(f)) {
                e = f;
                f = w
            }
            for (d = (d || '').split(' '); (i = d[o++]) != null; ) {
                j = O.exec(i);
                k = '';
                if (j) {
                    k = j[0];
                    i = i.replace(O, '')
                }
                if (i === 'hover') d.push('mouseenter' + k, 'mouseleave' + k);
                else {
                    n = i;
                    if (i === 'focus' || i === 'blur') {
                        d.push(Ga[i] + k);
                        i += k
                    } else i = (Ga[i] || i) + k;
                    b === 'live' ? u.each(function () {
                        c.event.add(this, pa(i, r), {
                            data: f,
                            selector: r,
                            handler: e,
                            origType: i,
                            origHandler: e,
                            preType: n
                        })
                    })  : u.unbind(pa(i, r), e)
                }
            }
            return this
        }
    });
    c.each('blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error'.split(' '), function (a, b) {
        c.fn[b] = function (d) {
            return d ? this.bind(b, d)  : this.trigger(b)
        };
        if (c.attrFn) c.attrFn[b] = true
    });
    A.attachEvent && !A.addEventListener && A.attachEvent('onunload', function () {
        for (var a in c.cache) if (c.cache[a].handle) try {
            c.event.remove(c.cache[a].handle.elem)
        } catch (b) {
        }
    });
    (function () {
        function a(g) {
            for (var h = '', l, m = 0; g[m]; m++) {
                l = g[m];
                if (l.nodeType === 3 || l.nodeType === 4) h += l.nodeValue;
                else if (l.nodeType !== 8) h += a(l.childNodes)
            }
            return h
        }
        function b(g, h, l, m, q, p) {
            q = 0;
            for (var v = m.length; q < v; q++) {
                var t = m[q];
                if (t) {
                    t = t[g];
                    for (var y = false; t; ) {
                        if (t.sizcache === l) {
                            y = m[t.sizset];
                            break
                        }
                        if (t.nodeType === 1 && !p) {
                            t.sizcache = l;
                            t.sizset = q
                        }
                        if (t.nodeName.toLowerCase() === h) {
                            y = t;
                            break
                        }
                        t = t[g]
                    }
                    m[q] = y
                }
            }
        }
        function d(g, h, l, m, q, p) {
            q = 0;
            for (var v = m.length; q < v; q++) {
                var t = m[q];
                if (t) {
                    t = t[g];
                    for (var y = false; t; ) {
                        if (t.sizcache === l) {
                            y = m[t.sizset];
                            break
                        }
                        if (t.nodeType === 1) {
                            if (!p) {
                                t.sizcache = l;
                                t.sizset = q
                            }
                            if (typeof h !== 'string') {
                                if (t === h) {
                                    y = true;
                                    break
                                }
                            } else if (k.filter(h, [
                                    t
                                ]).length > 0) {
                                y = t;
                                break
                            }
                        }
                        t = t[g]
                    }
                    m[q] = y
                }
            }
        }
        var f = /((?:\((?:\([^()]+\)|[^()]+)+\)|\[(?:\[[^[\]]*\]|['"][^'"]*['"]|[^[\]'"]+)+\]|\\.|[^ >+~,(\[\\]+)+|[>+~])(\s*,\s*)?((?:.|\r|\n)*)/g,
            e = 0,
            j = Object.prototype.toString,
            i = false,
            o = true;
        [
            0,
            0
        ].sort(function () {
                o = false;
                return 0
            });
        var k = function (g, h, l, m) {
            l = l || [];
            var q = h = h || s;
            if (h.nodeType !== 1 && h.nodeType !== 9) return [];
            if (!g || typeof g !== 'string') return l;
            for (var p = [
            ], v, t, y, S, H = true, M = x(h), I = g; (f.exec(''), v = f.exec(I)) !== null; ) {
                I = v[3];
                p.push(v[1]);
                if (v[2]) {
                    S = v[3];
                    break
                }
            }
            if (p.length > 1 && r.exec(g)) if (p.length === 2 && n.relative[p[0]]) t = ga(p[0] + p[1], h);
            else for (t = n.relative[p[0]] ? [
                    h
                ] : k(p.shift(), h); p.length; ) {
                    g = p.shift();
                    if (n.relative[g]) g += p.shift();
                    t = ga(g, t)
                } else {
                if (!m && p.length > 1 && h.nodeType === 9 && !M && n.match.ID.test(p[0]) && !n.match.ID.test(p[p.length - 1])) {
                    v = k.find(p.shift(), h, M);
                    h = v.expr ? k.filter(v.expr, v.set) [0] : v.set[0]
                }
                if (h) {
                    v = m ? {
                        expr: p.pop(),
                        set: z(m)
                    }
                        : k.find(p.pop(), p.length === 1 && (p[0] === '~' || p[0] === '+') && h.parentNode ? h.parentNode : h, M);
                    t = v.expr ? k.filter(v.expr, v.set)  : v.set;
                    if (p.length > 0) y = z(t);
                    else H = false;
                    for (; p.length; ) {
                        var D = p.pop();
                        v = D;
                        if (n.relative[D]) v = p.pop();
                        else D = '';
                        if (v == null) v = h;
                        n.relative[D](y, v, M)
                    }
                } else y = [
                ]
            }
            y || (y = t);
            y || k.error(D ||
            g);
            if (j.call(y) === '[object Array]') if (H) if (h && h.nodeType === 1) for (g = 0; y[g] != null; g++) {
                if (y[g] && (y[g] === true || y[g].nodeType === 1 && E(h, y[g]))) l.push(t[g])
            } else for (g = 0; y[g] != null; g++) y[g] && y[g].nodeType === 1 && l.push(t[g]);
            else l.push.apply(l, y);
            else z(y, l);
            if (S) {
                k(S, q, l, m);
                k.uniqueSort(l)
            }
            return l
        };
        k.uniqueSort = function (g) {
            if (B) {
                i = o;
                g.sort(B);
                if (i) for (var h = 1; h < g.length; h++) g[h] === g[h - 1] && g.splice(h--, 1)
            }
            return g
        };
        k.matches = function (g, h) {
            return k(g, null, null, h)
        };
        k.find = function (g, h, l) {
            var m,
                q;
            if (!g) return [];
            for (var p = 0, v = n.order.length; p < v; p++) {
                var t = n.order[p];
                if (q = n.leftMatch[t].exec(g)) {
                    var y = q[1];
                    q.splice(1, 1);
                    if (y.substr(y.length - 1) !== '\\') {
                        q[1] = (q[1] || '').replace(/\\/g, '');
                        m = n.find[t](q, h, l);
                        if (m != null) {
                            g = g.replace(n.match[t], '');
                            break
                        }
                    }
                }
            }
            m || (m = h.getElementsByTagName('*'));
            return {
                set: m,
                expr: g
            }
        };
        k.filter = function (g, h, l, m) {
            for (var q = g, p = [
            ], v = h, t, y, S = h && h[0] && x(h[0]); g && h.length; ) {
                for (var H in n.filter) if ((t = n.leftMatch[H].exec(g)) != null && t[2]) {
                    var M = n.filter[H],
                        I,
                        D;
                    D = t[1];
                    y = false;
                    t.splice(1, 1);
                    if (D.substr(D.length -
                        1) !== '\\') {
                        if (v === p) p = [
                        ];
                        if (n.preFilter[H]) if (t = n.preFilter[H](t, v, l, p, m, S)) {
                            if (t === true) continue
                        } else y = I = true;
                        if (t) for (var U = 0; (D = v[U]) != null; U++) if (D) {
                            I = M(D, t, U, v);
                            var Ha = m ^ !!I;
                            if (l && I != null) if (Ha) y = true;
                            else v[U] = false;
                            else if (Ha) {
                                p.push(D);
                                y = true
                            }
                        }
                        if (I !== w) {
                            l || (v = p);
                            g = g.replace(n.match[H], '');
                            if (!y) return [];
                            break
                        }
                    }
                }
                if (g === q) if (y == null) k.error(g);
                else break;
                q = g
            }
            return v
        };
        k.error = function (g) {
            throw 'Syntax error, unrecognized expression: ' + g;
        };
        var n = k.selectors = {
                order: [
                    'ID',
                    'NAME',
                    'TAG'
                ],
                match: {
                    ID: /#((?:[\w\u00c0-\uFFFF-]|\\.)+)/,
                    CLASS: /\.((?:[\w\u00c0-\uFFFF-]|\\.)+)/,
                    NAME: /\[name=['"]*((?:[\w\u00c0-\uFFFF-]|\\.)+)['"]*\]/,
                    ATTR: /\[\s*((?:[\w\u00c0-\uFFFF-]|\\.)+)\s*(?:(\S?=)\s*(['"]*)(.*?)\3|)\s*\]/,
                    TAG: /^((?:[\w\u00c0-\uFFFF\*-]|\\.)+)/,
                    CHILD: /:(only|nth|last|first)-child(?:\((even|odd|[\dn+-]*)\))?/,
                    POS: /:(nth|eq|gt|lt|first|last|even|odd)(?:\((\d*)\))?(?=[^-]|$)/,
                    PSEUDO: /:((?:[\w\u00c0-\uFFFF-]|\\.)+)(?:\((['"]?)((?:\([^\)]+\)|[^\(\)]*)+)\2\))?/
                },
                leftMatch: {
                },
                attrMap: {
                    'class': 'className',
                    'for': 'htmlFor'
                },
                attrHandle: {
                    href: function (g) {
                        return g.getAttribute('href')
                    }
                },
                relative: {
                    '+': function (g, h) {
                        var l = typeof h === 'string',
                            m = l && !/\W/.test(h);
                        l = l && !m;
                        if (m) h = h.toLowerCase();
                        m = 0;
                        for (var q = g.length, p; m < q; m++) if (p = g[m]) {
                            for (; (p = p.previousSibling) && p.nodeType !== 1; );
                            g[m] = l || p && p.nodeName.toLowerCase() === h ? p || false : p === h
                        }
                        l && k.filter(h, g, true)
                    },
                    '>': function (g, h) {
                        var l = typeof h === 'string';
                        if (l && !/\W/.test(h)) {
                            h = h.toLowerCase();
                            for (var m = 0, q = g.length; m < q; m++) {
                                var p = g[m];
                                if (p) {
                                    l = p.parentNode;
                                    g[m] = l.nodeName.toLowerCase() === h ? l : false
                                }
                            }
                        } else {
                            m = 0;
                            for (q = g.length; m < q; m++) if (p = g[m]) g[m] =
                                l ? p.parentNode : p.parentNode === h;
                            l && k.filter(h, g, true)
                        }
                    },
                    '': function (g, h, l) {
                        var m = e++,
                            q = d;
                        if (typeof h === 'string' && !/\W/.test(h)) {
                            var p = h = h.toLowerCase();
                            q = b
                        }
                        q('parentNode', h, m, g, p, l)
                    },
                    '~': function (g, h, l) {
                        var m = e++,
                            q = d;
                        if (typeof h === 'string' && !/\W/.test(h)) {
                            var p = h = h.toLowerCase();
                            q = b
                        }
                        q('previousSibling', h, m, g, p, l)
                    }
                },
                find: {
                    ID: function (g, h, l) {
                        if (typeof h.getElementById !== 'undefined' && !l) return (g = h.getElementById(g[1])) ? [
                            g
                        ] : [
                        ]
                    },
                    NAME: function (g, h) {
                        if (typeof h.getElementsByName !== 'undefined') {
                            var l = [
                            ];
                            h = h.getElementsByName(g[1]);
                            for (var m = 0, q = h.length; m < q; m++) h[m].getAttribute('name') === g[1] && l.push(h[m]);
                            return l.length === 0 ? null : l
                        }
                    },
                    TAG: function (g, h) {
                        return h.getElementsByTagName(g[1])
                    }
                },
                preFilter: {
                    CLASS: function (g, h, l, m, q, p) {
                        g = ' ' + g[1].replace(/\\/g, '') + ' ';
                        if (p) return g;
                        p = 0;
                        for (var v; (v = h[p]) != null; p++) if (v) if (q ^ (v.className && (' ' + v.className + ' ').replace(/[\t\n]/g, ' ').indexOf(g) >= 0)) l || m.push(v);
                        else if (l) h[p] = false;
                        return false
                    },
                    ID: function (g) {
                        return g[1].replace(/\\/g, '')
                    },
                    TAG: function (g) {
                        return g[1].toLowerCase()
                    },
                    CHILD: function (g) {
                        if (g[1] === 'nth') {
                            var h = /(-?)(\d*)n((?:\+|-)?\d*)/.exec(g[2] === 'even' && '2n' || g[2] === 'odd' && '2n+1' || !/\D/.test(g[2]) && '0n+' + g[2] || g[2]);
                            g[2] = h[1] + (h[2] || 1) - 0;
                            g[3] = h[3] - 0
                        }
                        g[0] = e++;
                        return g
                    },
                    ATTR: function (g, h, l, m, q, p) {
                        h = g[1].replace(/\\/g, '');
                        if (!p && n.attrMap[h]) g[1] = n.attrMap[h];
                        if (g[2] === '~=') g[4] = ' ' + g[4] + ' ';
                        return g
                    },
                    PSEUDO: function (g, h, l, m, q) {
                        if (g[1] === 'not') if ((f.exec(g[3]) || '').length > 1 || /^\w/.test(g[3])) g[3] = k(g[3], null, null, h);
                        else {
                            g = k.filter(g[3], h, l, true ^ q);
                            l || m.push.apply(m, g);
                            return false
                        } else if (n.match.POS.test(g[0]) || n.match.CHILD.test(g[0])) return true;
                        return g
                    },
                    POS: function (g) {
                        g.unshift(true);
                        return g
                    }
                },
                filters: {
                    enabled: function (g) {
                        return g.disabled === false && g.type !== 'hidden'
                    },
                    disabled: function (g) {
                        return g.disabled === true
                    },
                    checked: function (g) {
                        return g.checked === true
                    },
                    selected: function (g) {
                        return g.selected === true
                    },
                    parent: function (g) {
                        return !!g.firstChild
                    },
                    empty: function (g) {
                        return !g.firstChild
                    },
                    has: function (g, h, l) {
                        return !!k(l[3], g).length
                    },
                    header: function (g) {
                        return /h\d/i.test(g.nodeName)
                    },
                    text: function (g) {
                        return 'text' === g.type
                    },
                    radio: function (g) {
                        return 'radio' === g.type
                    },
                    checkbox: function (g) {
                        return 'checkbox' === g.type
                    },
                    file: function (g) {
                        return 'file' === g.type
                    },
                    password: function (g) {
                        return 'password' === g.type
                    },
                    submit: function (g) {
                        return 'submit' === g.type
                    },
                    image: function (g) {
                        return 'image' === g.type
                    },
                    reset: function (g) {
                        return 'reset' === g.type
                    },
                    button: function (g) {
                        return 'button' === g.type || g.nodeName.toLowerCase() === 'button'
                    },
                    input: function (g) {
                        return /input|select|textarea|button/i.test(g.nodeName)
                    }
                },
                setFilters: {
                    first: function (g, h) {
                        return h === 0
                    },
                    last: function (g, h, l, m) {
                        return h === m.length - 1
                    },
                    even: function (g, h) {
                        return h % 2 === 0
                    },
                    odd: function (g, h) {
                        return h % 2 === 1
                    },
                    lt: function (g, h, l) {
                        return h < l[3] - 0
                    },
                    gt: function (g, h, l) {
                        return h > l[3] - 0
                    },
                    nth: function (g, h, l) {
                        return l[3] - 0 === h
                    },
                    eq: function (g, h, l) {
                        return l[3] - 0 === h
                    }
                },
                filter: {
                    PSEUDO: function (g, h, l, m) {
                        var q = h[1],
                            p = n.filters[q];
                        if (p) return p(g, l, h, m);
                        else if (q === 'contains') return (g.textContent || g.innerText || a([g]) || '').indexOf(h[3]) >= 0;
                        else if (q === 'not') {
                            h =
                                h[3];
                            l = 0;
                            for (m = h.length; l < m; l++) if (h[l] === g) return false;
                            return true
                        } else k.error('Syntax error, unrecognized expression: ' + q)
                    },
                    CHILD: function (g, h) {
                        var l = h[1],
                            m = g;
                        switch (l) {
                            case 'only':
                            case 'first':
                                for (; m = m.previousSibling; ) if (m.nodeType === 1) return false;
                                if (l === 'first') return true;
                                m = g;
                            case 'last':
                                for (; m = m.nextSibling; ) if (m.nodeType === 1) return false;
                                return true;
                            case 'nth':
                                l = h[2];
                                var q = h[3];
                                if (l === 1 && q === 0) return true;
                                h = h[0];
                                var p = g.parentNode;
                                if (p && (p.sizcache !== h || !g.nodeIndex)) {
                                    var v = 0;
                                    for (m = p.firstChild; m; m =
                                        m.nextSibling) if (m.nodeType === 1) m.nodeIndex = ++v;
                                    p.sizcache = h
                                }
                                g = g.nodeIndex - q;
                                return l === 0 ? g === 0 : g % l === 0 && g / l >= 0
                        }
                    },
                    ID: function (g, h) {
                        return g.nodeType === 1 && g.getAttribute('id') === h
                    },
                    TAG: function (g, h) {
                        return h === '*' && g.nodeType === 1 || g.nodeName.toLowerCase() === h
                    },
                    CLASS: function (g, h) {
                        return (' ' + (g.className || g.getAttribute('class')) + ' ').indexOf(h) > - 1
                    },
                    ATTR: function (g, h) {
                        var l = h[1];
                        g = n.attrHandle[l] ? n.attrHandle[l](g)  : g[l] != null ? g[l] : g.getAttribute(l);
                        l = g + '';
                        var m = h[2];
                        h = h[4];
                        return g == null ? m === '!=' : m ===
                        '=' ? l === h : m === '*=' ? l.indexOf(h) >= 0 : m === '~=' ? (' ' + l + ' ').indexOf(h) >= 0 : !h ? l && g !== false : m === '!=' ? l !== h : m === '^=' ? l.indexOf(h) === 0 : m === '$=' ? l.substr(l.length - h.length) === h : m === '|=' ? l === h || l.substr(0, h.length + 1) === h + '-' : false
                    },
                    POS: function (g, h, l, m) {
                        var q = n.setFilters[h[2]];
                        if (q) return q(g, l, h, m)
                    }
                }
            },
            r = n.match.POS;
        for (var u in n.match) {
            n.match[u] = new RegExp(n.match[u].source + /(?![^\[]*\])(?![^\(]*\))/.source);
            n.leftMatch[u] = new RegExp(/(^(?:.|\r|\n)*?)/.source + n.match[u].source.replace(/\\(\d+)/g, function (g, h) {
                return '\\' + (h - 0 + 1)
            }))
        }
        var z = function (g, h) {
            g = Array.prototype.slice.call(g, 0);
            if (h) {
                h.push.apply(h, g);
                return h
            }
            return g
        };
        try {
            Array.prototype.slice.call(s.documentElement.childNodes, 0)
        } catch (C) {
            z = function (g, h) {
                h = h || [];
                if (j.call(g) === '[object Array]') Array.prototype.push.apply(h, g);
                else if (typeof g.length === 'number') for (var l = 0, m = g.length; l < m; l++) h.push(g[l]);
                else for (l = 0; g[l]; l++) h.push(g[l]);
                return h
            }
        }
        var B;
        if (s.documentElement.compareDocumentPosition) B = function (g, h) {
            if (!g.compareDocumentPosition ||
                !h.compareDocumentPosition) {
                if (g == h) i = true;
                return g.compareDocumentPosition ? - 1 : 1
            }
            g = g.compareDocumentPosition(h) & 4 ? - 1 : g === h ? 0 : 1;
            if (g === 0) i = true;
            return g
        };
        else if ('sourceIndex' in s.documentElement) B = function (g, h) {
            if (!g.sourceIndex || !h.sourceIndex) {
                if (g == h) i = true;
                return g.sourceIndex ? - 1 : 1
            }
            g = g.sourceIndex - h.sourceIndex;
            if (g === 0) i = true;
            return g
        };
        else if (s.createRange) B = function (g, h) {
            if (!g.ownerDocument || !h.ownerDocument) {
                if (g == h) i = true;
                return g.ownerDocument ? - 1 : 1
            }
            var l = g.ownerDocument.createRange(),
                m =
                    h.ownerDocument.createRange();
            l.setStart(g, 0);
            l.setEnd(g, 0);
            m.setStart(h, 0);
            m.setEnd(h, 0);
            g = l.compareBoundaryPoints(Range.START_TO_END, m);
            if (g === 0) i = true;
            return g
        };
        (function () {
            var g = s.createElement('div'),
                h = 'script' + (new Date).getTime();
            g.innerHTML = '<a name=\'' + h + '\'/>';
            var l = s.documentElement;
            l.insertBefore(g, l.firstChild);
            if (s.getElementById(h)) {
                n.find.ID = function (m, q, p) {
                    if (typeof q.getElementById !== 'undefined' && !p) return (q = q.getElementById(m[1])) ? q.id === m[1] || typeof q.getAttributeNode !== 'undefined' &&
                    q.getAttributeNode('id').nodeValue === m[1] ? [
                        q
                    ] : w : [
                    ]
                };
                n.filter.ID = function (m, q) {
                    var p = typeof m.getAttributeNode !== 'undefined' && m.getAttributeNode('id');
                    return m.nodeType === 1 && p && p.nodeValue === q
                }
            }
            l.removeChild(g);
            l = g = null
        }) ();
        (function () {
            var g = s.createElement('div');
            g.appendChild(s.createComment(''));
            if (g.getElementsByTagName('*').length > 0) n.find.TAG = function (h, l) {
                l = l.getElementsByTagName(h[1]);
                if (h[1] === '*') {
                    h = [
                    ];
                    for (var m = 0; l[m]; m++) l[m].nodeType === 1 && h.push(l[m]);
                    l = h
                }
                return l
            };
            g.innerHTML = '<a href=\'#\'></a>';
            if (g.firstChild && typeof g.firstChild.getAttribute !== 'undefined' && g.firstChild.getAttribute('href') !== '#') n.attrHandle.href = function (h) {
                return h.getAttribute('href', 2)
            };
            g = null
        }) ();
        s.querySelectorAll && function () {
            var g = k,
                h = s.createElement('div');
            h.innerHTML = '<p class=\'TEST\'></p>';
            if (!(h.querySelectorAll && h.querySelectorAll('.TEST').length === 0)) {
                k = function (m, q, p, v) {
                    q = q || s;
                    if (!v && q.nodeType === 9 && !x(q)) try {
                        return z(q.querySelectorAll(m), p)
                    } catch (t) {
                    }
                    return g(m, q, p, v)
                };
                for (var l in g) k[l] = g[l];
                h = null
            }
        }();
        (function () {
            var g = s.createElement('div');
            g.innerHTML = '<div class=\'test e\'></div><div class=\'test\'></div>';
            if (!(!g.getElementsByClassName || g.getElementsByClassName('e').length === 0)) {
                g.lastChild.className = 'e';
                if (g.getElementsByClassName('e').length !== 1) {
                    n.order.splice(1, 0, 'CLASS');
                    n.find.CLASS = function (h, l, m) {
                        if (typeof l.getElementsByClassName !== 'undefined' && !m) return l.getElementsByClassName(h[1])
                    };
                    g = null
                }
            }
        }) ();
        var E = s.compareDocumentPosition ? function (g, h) {
                return !!(g.compareDocumentPosition(h) & 16)
            }
                :
                function (g, h) {
                    return g !== h && (g.contains ? g.contains(h)  : true)
                },
            x = function (g) {
                return (g = (g ? g.ownerDocument || g : 0).documentElement) ? g.nodeName !== 'HTML' : false
            },
            ga = function (g, h) {
                var l = [
                    ],
                    m = '',
                    q;
                for (h = h.nodeType ? [
                    h
                ] : h; q = n.match.PSEUDO.exec(g); ) {
                    m += q[0];
                    g = g.replace(n.match.PSEUDO, '')
                }
                g = n.relative[g] ? g + '*' : g;
                q = 0;
                for (var p = h.length; q < p; q++) k(g, h[q], l);
                return k.filter(m, l)
            };
        c.find = k;
        c.expr = k.selectors;
        c.expr[':'] = c.expr.filters;
        c.unique = k.uniqueSort;
        c.text = a;
        c.isXMLDoc = x;
        c.contains = E
    }) (); var eb = /Until$/, fb = /^(?:parents|prevUntil|prevAll)/, gb = /,/; R = Array.prototype.slice; var Ia = function (a, b, d) {
        if (c.isFunction(b)) return c.grep(a, function (e, j) {
            return !!b.call(e, j, e) === d
        });
        else if (b.nodeType) return c.grep(a, function (e) {
            return e === b === d
        });
        else if (typeof b === 'string') {
            var f = c.grep(a, function (e) {
                return e.nodeType === 1
            });
            if (Ua.test(b)) return c.filter(b, f, !d);
            else b = c.filter(b, f)
        }
        return c.grep(a, function (e) {
            return c.inArray(e, b) >= 0 === d
        })
    }; c.fn.extend({
        find: function (a) {
            for (var b = this.pushStack('', 'find', a), d = 0, f = 0, e = this.length; f < e; f++) {
                d = b.length;
                c.find(a, this[f], b);
                if (f > 0) for (var j = d; j < b.length; j++) for (var i = 0; i < d; i++) if (b[i] === b[j]) {
                    b.splice(j--, 1);
                    break
                }
            }
            return b
        },
        has: function (a) {
            var b = c(a);
            return this.filter(function () {
                for (var d = 0, f = b.length; d < f; d++) if (c.contains(this, b[d])) return true
            })
        },
        not: function (a) {
            return this.pushStack(Ia(this, a, false), 'not', a)
        },
        filter: function (a) {
            return this.pushStack(Ia(this, a, true), 'filter', a)
        },
        is: function (a) {
            return !!a && c.filter(a, this).length > 0
        },
        closest: function (a, b) {
            if (c.isArray(a)) {
                var d = [
                    ],
                    f = this[0],
                    e,
                    j =
                    {
                    },
                    i;
                if (f && a.length) {
                    e = 0;
                    for (var o = a.length; e < o; e++) {
                        i = a[e];
                        j[i] || (j[i] = c.expr.match.POS.test(i) ? c(i, b || this.context)  : i)
                    }
                    for (; f && f.ownerDocument && f !== b; ) {
                        for (i in j) {
                            e = j[i];
                            if (e.jquery ? e.index(f) > - 1 : c(f).is(e)) {
                                d.push({
                                    selector: i,
                                    elem: f
                                });
                                delete j[i]
                            }
                        }
                        f = f.parentNode
                    }
                }
                return d
            }
            var k = c.expr.match.POS.test(a) ? c(a, b || this.context)  : null;
            return this.map(function (n, r) {
                for (; r && r.ownerDocument && r !== b; ) {
                    if (k ? k.index(r) > - 1 : c(r).is(a)) return r;
                    r = r.parentNode
                }
                return null
            })
        },
        index: function (a) {
            if (!a || typeof a ===
                'string') return c.inArray(this[0], a ? c(a)  : this.parent().children());
            return c.inArray(a.jquery ? a[0] : a, this)
        },
        add: function (a, b) {
            a = typeof a === 'string' ? c(a, b || this.context)  : c.makeArray(a);
            b = c.merge(this.get(), a);
            return this.pushStack(qa(a[0]) || qa(b[0]) ? b : c.unique(b))
        },
        andSelf: function () {
            return this.add(this.prevObject)
        }
    }); c.each({
        parent: function (a) {
            return (a = a.parentNode) && a.nodeType !== 11 ? a : null
        },
        parents: function (a) {
            return c.dir(a, 'parentNode')
        },
        parentsUntil: function (a, b, d) {
            return c.dir(a, 'parentNode', d)
        },
        next: function (a) {
            return c.nth(a, 2, 'nextSibling')
        },
        prev: function (a) {
            return c.nth(a, 2, 'previousSibling')
        },
        nextAll: function (a) {
            return c.dir(a, 'nextSibling')
        },
        prevAll: function (a) {
            return c.dir(a, 'previousSibling')
        },
        nextUntil: function (a, b, d) {
            return c.dir(a, 'nextSibling', d)
        },
        prevUntil: function (a, b, d) {
            return c.dir(a, 'previousSibling', d)
        },
        siblings: function (a) {
            return c.sibling(a.parentNode.firstChild, a)
        },
        children: function (a) {
            return c.sibling(a.firstChild)
        },
        contents: function (a) {
            return c.nodeName(a, 'iframe') ?
            a.contentDocument || a.contentWindow.document : c.makeArray(a.childNodes)
        }
    }, function (a, b) {
        c.fn[a] = function (d, f) {
            var e = c.map(this, b, d);
            eb.test(a) || (f = d);
            if (f && typeof f === 'string') e = c.filter(f, e);
            e = this.length > 1 ? c.unique(e)  : e;
            if ((this.length > 1 || gb.test(f)) && fb.test(a)) e = e.reverse();
            return this.pushStack(e, a, R.call(arguments).join(','))
        }
    }); c.extend({
        filter: function (a, b, d) {
            if (d) a = ':not(' + a + ')';
            return c.find.matches(a, b)
        },
        dir: function (a, b, d) {
            var f = [
            ];
            for (a = a[b]; a && a.nodeType !== 9 && (d === w || a.nodeType !== 1 || !c(a).is(d)); ) {
                a.nodeType ===
                1 && f.push(a);
                a = a[b]
            }
            return f
        },
        nth: function (a, b, d) {
            b = b || 1;
            for (var f = 0; a; a = a[d]) if (a.nodeType === 1 && ++f === b) break;
            return a
        },
        sibling: function (a, b) {
            for (var d = [
            ]; a; a = a.nextSibling) a.nodeType === 1 && a !== b && d.push(a);
            return d
        }
    }); var Ja = / jQuery\d+="(?:\d+|null)"/g, V = /^\s+/, Ka = /(<([\w:]+)[^>]*?)\/>/g, hb = /^(?:area|br|col|embed|hr|img|input|link|meta|param)$/i, La = /<([\w:]+)/, ib = /<tbody/i, jb = /<|&#?\w+;/, ta = /<script|<object|<embed|<option|<style/i, ua = /checked\s*(?:[^=]|=\s*.checked.)/i, Ma = function (a, b, d) {
        return hb.test(d) ?
            a : b + '></' + d + '>'
    }, F = {
        option: [
            1,
            '<select multiple=\'multiple\'>',
            '</select>'
        ],
        legend: [
            1,
            '<fieldset>',
            '</fieldset>'
        ],
        thead: [
            1,
            '<table>',
            '</table>'
        ],
        tr: [
            2,
            '<table><tbody>',
            '</tbody></table>'
        ],
        td: [
            3,
            '<table><tbody><tr>',
            '</tr></tbody></table>'
        ],
        col: [
            2,
            '<table><tbody></tbody><colgroup>',
            '</colgroup></table>'
        ],
        area: [
            1,
            '<map>',
            '</map>'
        ],
        _default: [
            0,
            '',
            ''
        ]
    }; F.optgroup = F.option; F.tbody = F.tfoot = F.colgroup = F.caption = F.thead; F.th = F.td; if (!c.support.htmlSerialize) F._default = [
        1,
        'div<div>',
        '</div>'
    ]; c.fn.extend({
        text: function (a) {
            if (c.isFunction(a)) return this.each(function (b) {
                var d =
                    c(this);
                d.text(a.call(this, b, d.text()))
            });
            if (typeof a !== 'object' && a !== w) return this.empty().append((this[0] && this[0].ownerDocument || s).createTextNode(a));
            return c.text(this)
        },
        wrapAll: function (a) {
            if (c.isFunction(a)) return this.each(function (d) {
                c(this).wrapAll(a.call(this, d))
            });
            if (this[0]) {
                var b = c(a, this[0].ownerDocument).eq(0).clone(true);
                this[0].parentNode && b.insertBefore(this[0]);
                b.map(function () {
                    for (var d = this; d.firstChild && d.firstChild.nodeType === 1; ) d = d.firstChild;
                    return d
                }).append(this)
            }
            return this
        },
        wrapInner: function (a) {
            if (c.isFunction(a)) return this.each(function (b) {
                c(this).wrapInner(a.call(this, b))
            });
            return this.each(function () {
                var b = c(this),
                    d = b.contents();
                d.length ? d.wrapAll(a)  : b.append(a)
            })
        },
        wrap: function (a) {
            return this.each(function () {
                c(this).wrapAll(a)
            })
        },
        unwrap: function () {
            return this.parent().each(function () {
                c.nodeName(this, 'body') || c(this).replaceWith(this.childNodes)
            }).end()
        },
        append: function () {
            return this.domManip(arguments, true, function (a) {
                this.nodeType === 1 && this.appendChild(a)
            })
        },
        prepend: function () {
            return this.domManip(arguments, true, function (a) {
                this.nodeType === 1 && this.insertBefore(a, this.firstChild)
            })
        },
        before: function () {
            if (this[0] && this[0].parentNode) return this.domManip(arguments, false, function (b) {
                this.parentNode.insertBefore(b, this)
            });
            else if (arguments.length) {
                var a = c(arguments[0]);
                a.push.apply(a, this.toArray());
                return this.pushStack(a, 'before', arguments)
            }
        },
        after: function () {
            if (this[0] && this[0].parentNode) return this.domManip(arguments, false, function (b) {
                this.parentNode.insertBefore(b, this.nextSibling)
            });
            else if (arguments.length) {
                var a = this.pushStack(this, 'after', arguments);
                a.push.apply(a, c(arguments[0]).toArray());
                return a
            }
        },
        remove: function (a, b) {
            for (var d = 0, f; (f = this[d]) != null; d++) if (!a || c.filter(a, [
                    f
                ]).length) {
                if (!b && f.nodeType === 1) {
                    c.cleanData(f.getElementsByTagName('*'));
                    c.cleanData([f])
                }
                f.parentNode && f.parentNode.removeChild(f)
            }
            return this
        },
        empty: function () {
            for (var a = 0, b; (b = this[a]) != null; a++) for (b.nodeType === 1 && c.cleanData(b.getElementsByTagName('*')); b.firstChild; ) b.removeChild(b.firstChild);
            return this
        },
        clone: function (a) {
            var b = this.map(function () {
                if (!c.support.noCloneEvent && !c.isXMLDoc(this)) {
                    var d = this.outerHTML,
                        f = this.ownerDocument;
                    if (!d) {
                        d = f.createElement('div');
                        d.appendChild(this.cloneNode(true));
                        d = d.innerHTML
                    }
                    return c.clean([d.replace(Ja, '').replace(/=([^="'>\s]+\/)>/g, '="$1">').replace(V, '')], f) [0]
                } else return this.cloneNode(true)
            });
            if (a === true) {
                ra(this, b);
                ra(this.find('*'), b.find('*'))
            }
            return b
        },
        html: function (a) {
            if (a === w) return this[0] && this[0].nodeType === 1 ? this[0].innerHTML.replace(Ja, '')  : null;
            else if (typeof a === 'string' && !ta.test(a) && (c.support.leadingWhitespace || !V.test(a)) && !F[(La.exec(a) || ['',
                    '']) [1].toLowerCase()]) {
                a = a.replace(Ka, Ma);
                try {
                    for (var b = 0, d = this.length; b < d; b++) if (this[b].nodeType === 1) {
                        c.cleanData(this[b].getElementsByTagName('*'));
                        this[b].innerHTML = a
                    }
                } catch (f) {
                    this.empty().append(a)
                }
            } else c.isFunction(a) ? this.each(function (e) {
                var j = c(this),
                    i = j.html();
                j.empty().append(function () {
                    return a.call(this, e, i)
                })
            })  : this.empty().append(a);
            return this
        },
        replaceWith: function (a) {
            if (this[0] &&
                this[0].parentNode) {
                if (c.isFunction(a)) return this.each(function (b) {
                    var d = c(this),
                        f = d.html();
                    d.replaceWith(a.call(this, b, f))
                });
                if (typeof a !== 'string') a = c(a).detach();
                return this.each(function () {
                    var b = this.nextSibling,
                        d = this.parentNode;
                    c(this).remove();
                    b ? c(b).before(a)  : c(d).append(a)
                })
            } else return this.pushStack(c(c.isFunction(a) ? a()  : a), 'replaceWith', a)
        },
        detach: function (a) {
            return this.remove(a, true)
        },
        domManip: function (a, b, d) {
            function f(u) {
                return c.nodeName(u, 'table') ? u.getElementsByTagName('tbody') [0] ||
                u.appendChild(u.ownerDocument.createElement('tbody'))  : u
            }
            var e,
                j,
                i = a[0],
                o = [
                ],
                k;
            if (!c.support.checkClone && arguments.length === 3 && typeof i === 'string' && ua.test(i)) return this.each(function () {
                c(this).domManip(a, b, d, true)
            });
            if (c.isFunction(i)) return this.each(function (u) {
                var z = c(this);
                a[0] = i.call(this, u, b ? z.html()  : w);
                z.domManip(a, b, d)
            });
            if (this[0]) {
                e = i && i.parentNode;
                e = c.support.parentNode && e && e.nodeType === 11 && e.childNodes.length === this.length ? {
                    fragment: e
                }
                    : sa(a, this, o);
                k = e.fragment;
                if (j = k.childNodes.length ===
                    1 ? (k = k.firstChild)  : k.firstChild) {
                    b = b && c.nodeName(j, 'tr');
                    for (var n = 0, r = this.length; n < r; n++) d.call(b ? f(this[n], j)  : this[n], n > 0 || e.cacheable || this.length > 1 ? k.cloneNode(true)  : k)
                }
                o.length && c.each(o, Qa)
            }
            return this
        }
    }); c.fragments = {
    }; c.each({
        appendTo: 'append',
        prependTo: 'prepend',
        insertBefore: 'before',
        insertAfter: 'after',
        replaceAll: 'replaceWith'
    }, function (a, b) {
        c.fn[a] = function (d) {
            var f = [
            ];
            d = c(d);
            var e = this.length === 1 && this[0].parentNode;
            if (e && e.nodeType === 11 && e.childNodes.length === 1 && d.length === 1) {
                d[b](this[0]);
                return this
            } else {
                e = 0;
                for (var j = d.length; e < j; e++) {
                    var i = (e > 0 ? this.clone(true)  : this).get();
                    c.fn[b].apply(c(d[e]), i);
                    f = f.concat(i)
                }
                return this.pushStack(f, a, d.selector)
            }
        }
    }); c.extend({
        clean: function (a, b, d, f) {
            b = b || s;
            if (typeof b.createElement === 'undefined') b = b.ownerDocument || b[0] && b[0].ownerDocument || s;
            for (var e = [
            ], j = 0, i; (i = a[j]) != null; j++) {
                if (typeof i === 'number') i += '';
                if (i) {
                    if (typeof i === 'string' && !jb.test(i)) i = b.createTextNode(i);
                    else if (typeof i === 'string') {
                        i = i.replace(Ka, Ma);
                        var o = (La.exec(i) || ['',
                                '']) [1].toLowerCase(),
                            k = F[o] || F._default,
                            n = k[0],
                            r = b.createElement('div');
                        for (r.innerHTML = k[1] + i + k[2]; n--; ) r = r.lastChild;
                        if (!c.support.tbody) {
                            n = ib.test(i);
                            o = o === 'table' && !n ? r.firstChild && r.firstChild.childNodes : k[1] === '<table>' && !n ? r.childNodes : [
                            ];
                            for (k = o.length - 1; k >= 0; --k) c.nodeName(o[k], 'tbody') && !o[k].childNodes.length && o[k].parentNode.removeChild(o[k])
                        }
                        !c.support.leadingWhitespace && V.test(i) && r.insertBefore(b.createTextNode(V.exec(i) [0]), r.firstChild);
                        i = r.childNodes
                    }
                    if (i.nodeType) e.push(i);
                    else e =
                        c.merge(e, i)
                }
            }
            if (d) for (j = 0; e[j]; j++) if (f && c.nodeName(e[j], 'script') && (!e[j].type || e[j].type.toLowerCase() === 'text/javascript')) f.push(e[j].parentNode ? e[j].parentNode.removeChild(e[j])  : e[j]);
            else {
                e[j].nodeType === 1 && e.splice.apply(e, [
                    j + 1,
                    0
                ].concat(c.makeArray(e[j].getElementsByTagName('script'))));
                d.appendChild(e[j])
            }
            return e
        },
        cleanData: function (a) {
            for (var b, d, f = c.cache, e = c.event.special, j = c.support.deleteExpando, i = 0, o; (o = a[i]) != null; i++) if (d = o[c.expando]) {
                b = f[d];
                if (b.events) for (var k in b.events) e[k] ?
                    c.event.remove(o, k)  : Ca(o, k, b.handle);
                if (j) delete o[c.expando];
                else o.removeAttribute && o.removeAttribute(c.expando);
                delete f[d]
            }
        }
    }); var kb = /z-?index|font-?weight|opacity|zoom|line-?height/i, Na = /alpha\([^)]*\)/, Oa = /opacity=([^)]*)/, ha = /float/i, ia = /-([a-z])/gi, lb = /([A-Z])/g, mb = /^-?\d+(?:px)?$/i, nb = /^-?\d/, ob = {
        position: 'absolute',
        visibility: 'hidden',
        display: 'block'
    }, pb = [
        'Left',
        'Right'
    ], qb = [
        'Top',
        'Bottom'
    ], rb = s.defaultView && s.defaultView.getComputedStyle, Pa = c.support.cssFloat ? 'cssFloat' : 'styleFloat', ja =
        function (a, b) {
            return b.toUpperCase()
        }; c.fn.css = function (a, b) {
        return X(this, a, b, true, function (d, f, e) {
            if (e === w) return c.curCSS(d, f);
            if (typeof e === 'number' && !kb.test(f)) e += 'px';
            c.style(d, f, e)
        })
    }; c.extend({
        style: function (a, b, d) {
            if (!a || a.nodeType === 3 || a.nodeType === 8) return w;
            if ((b === 'width' || b === 'height') && parseFloat(d) < 0) d = w;
            var f = a.style || a,
                e = d !== w;
            if (!c.support.opacity && b === 'opacity') {
                if (e) {
                    f.zoom = 1;
                    b = parseInt(d, 10) + '' === 'NaN' ? '' : 'alpha(opacity=' + d * 100 + ')';
                    a = f.filter || c.curCSS(a, 'filter') || '';
                    f.filter =
                        Na.test(a) ? a.replace(Na, b)  : b
                }
                return f.filter && f.filter.indexOf('opacity=') >= 0 ? parseFloat(Oa.exec(f.filter) [1]) / 100 + '' : ''
            }
            if (ha.test(b)) b = Pa;
            b = b.replace(ia, ja);
            if (e) f[b] = d;
            return f[b]
        },
        css: function (a, b, d, f) {
            if (b === 'width' || b === 'height') {
                var e,
                    j = b === 'width' ? pb : qb;
                function i() {
                    e = b === 'width' ? a.offsetWidth : a.offsetHeight;
                    f !== 'border' && c.each(j, function () {
                        f || (e -= parseFloat(c.curCSS(a, 'padding' + this, true)) || 0);
                        if (f === 'margin') e += parseFloat(c.curCSS(a, 'margin' + this, true)) || 0;
                        else e -= parseFloat(c.curCSS(a, 'border' + this + 'Width', true)) || 0
                    })
                }
                a.offsetWidth !== 0 ? i()  : c.swap(a, ob, i);
                return Math.max(0, Math.round(e))
            }
            return c.curCSS(a, b, d)
        },
        curCSS: function (a, b, d) {
            var f,
                e = a.style;
            if (!c.support.opacity && b === 'opacity' && a.currentStyle) {
                f = Oa.test(a.currentStyle.filter || '') ? parseFloat(RegExp.$1) / 100 + '' : '';
                return f === '' ? '1' : f
            }
            if (ha.test(b)) b = Pa;
            if (!d && e && e[b]) f = e[b];
            else if (rb) {
                if (ha.test(b)) b = 'float';
                b = b.replace(lb, '-$1').toLowerCase();
                e = a.ownerDocument.defaultView;
                if (!e) return null;
                if (a = e.getComputedStyle(a, null)) f =
                    a.getPropertyValue(b);
                if (b === 'opacity' && f === '') f = '1'
            } else if (a.currentStyle) {
                d = b.replace(ia, ja);
                f = a.currentStyle[b] || a.currentStyle[d];
                if (!mb.test(f) && nb.test(f)) {
                    b = e.left;
                    var j = a.runtimeStyle.left;
                    a.runtimeStyle.left = a.currentStyle.left;
                    e.left = d === 'fontSize' ? '1em' : f || 0;
                    f = e.pixelLeft + 'px';
                    e.left = b;
                    a.runtimeStyle.left = j
                }
            }
            return f
        },
        swap: function (a, b, d) {
            var f = {
            };
            for (var e in b) {
                f[e] = a.style[e];
                a.style[e] = b[e]
            }
            d.call(a);
            for (e in b) a.style[e] = f[e]
        }
    }); if (c.expr && c.expr.filters) {
        c.expr.filters.hidden = function (a) {
            var b =
                    a.offsetWidth,
                d = a.offsetHeight,
                f = a.nodeName.toLowerCase() === 'tr';
            return b === 0 && d === 0 && !f ? true : b > 0 && d > 0 && !f ? false : c.curCSS(a, 'display') === 'none'
        };
        c.expr.filters.visible = function (a) {
            return !c.expr.filters.hidden(a)
        }
    }
    var sb = J(), tb = /<script(.|\s)*?\/script>/gi, ub = /select|textarea/i, vb = /color|date|datetime|email|hidden|month|number|password|range|search|tel|text|time|url|week/i, N = /=\?(&|$)/, ka = /\?/, wb = /(\?|&)_=.*?(&|$)/, xb = /^(\w+:)?\/\/([^\/?#]+)/, yb = /%20/g, zb = c.fn.load; c.fn.extend({
        load: function (a, b, d) {
            if (typeof a !==
                'string') return zb.call(this, a);
            else if (!this.length) return this;
            var f = a.indexOf(' ');
            if (f >= 0) {
                var e = a.slice(f, a.length);
                a = a.slice(0, f)
            }
            f = 'GET';
            if (b) if (c.isFunction(b)) {
                d = b;
                b = null
            } else if (typeof b === 'object') {
                b = c.param(b, c.ajaxSettings.traditional);
                f = 'POST'
            }
            var j = this;
            c.ajax({
                url: a,
                type: f,
                dataType: 'html',
                data: b,
                complete: function (i, o) {
                    if (o === 'success' || o === 'notmodified') j.html(e ? c('<div />').append(i.responseText.replace(tb, '')).find(e)  : i.responseText);
                    d && j.each(d, [
                        i.responseText,
                        o,
                        i
                    ])
                }
            });
            return this
        },
        serialize: function () {
            return c.param(this.serializeArray())
        },
        serializeArray: function () {
            return this.map(function () {
                return this.elements ? c.makeArray(this.elements)  : this
            }).filter(function () {
                return this.name && !this.disabled && (this.checked || ub.test(this.nodeName) || vb.test(this.type))
            }).map(function (a, b) {
                a = c(this).val();
                return a == null ? null : c.isArray(a) ? c.map(a, function (d) {
                    return {
                        name: b.name,
                        value: d
                    }
                })  : {
                    name: b.name,
                    value: a
                }
            }).get()
        }
    }); c.each('ajaxStart ajaxStop ajaxComplete ajaxError ajaxSuccess ajaxSend'.split(' '), function (a, b) {
        c.fn[b] = function (d) {
            return this.bind(b, d)
        }
    }); c.extend({
        get: function (a, b, d, f) {
            if (c.isFunction(b)) {
                f = f || d;
                d = b;
                b = null
            }
            return c.ajax({
                type: 'GET',
                url: a,
                data: b,
                success: d,
                dataType: f
            })
        },
        getScript: function (a, b) {
            return c.get(a, null, b, 'script')
        },
        getJSON: function (a, b, d) {
            return c.get(a, b, d, 'json')
        },
        post: function (a, b, d, f) {
            if (c.isFunction(b)) {
                f = f || d;
                d = b;
                b = {
                }
            }
            return c.ajax({
                type: 'POST',
                url: a,
                data: b,
                success: d,
                dataType: f
            })
        },
        ajaxSetup: function (a) {
            c.extend(c.ajaxSettings, a)
        },
        ajaxSettings: {
            url: location.href,
            global: true,
            type: 'GET',
            contentType: 'application/x-www-form-urlencoded',
            processData: true,
            async: true,
            xhr: A.XMLHttpRequest && (A.location.protocol !== 'file:' || !A.ActiveXObject) ? function () {
                return new A.XMLHttpRequest
            }
                : function () {
                try {
                    return new A.ActiveXObject('Microsoft.XMLHTTP')
                } catch (a) {
                }
            },
            accepts: {
                xml: 'application/xml, text/xml',
                html: 'text/html',
                script: 'text/javascript, application/javascript',
                json: 'application/json, text/javascript',
                text: 'text/plain',
                _default: '*/*'
            }
        },
        lastModified: {
        },
        etag: {
        },
        ajax: function (a) {
            function b() {
                e.success &&
                e.success.call(k, o, i, x);
                e.global && f('ajaxSuccess', [
                    x,
                    e
                ])
            }
            function d() {
                e.complete && e.complete.call(k, x, i);
                e.global && f('ajaxComplete', [
                    x,
                    e
                ]);
                e.global && !--c.active && c.event.trigger('ajaxStop')
            }
            function f(q, p) {
                (e.context ? c(e.context)  : c.event).trigger(q, p)
            }
            var e = c.extend(true, {
                }, c.ajaxSettings, a),
                j,
                i,
                o,
                k = a && a.context || e,
                n = e.type.toUpperCase();
            if (e.data && e.processData && typeof e.data !== 'string') e.data = c.param(e.data, e.traditional);
            if (e.dataType === 'jsonp') {
                if (n === 'GET') N.test(e.url) || (e.url += (ka.test(e.url) ?
                    '&' : '?') + (e.jsonp || 'callback') + '=?');
                else if (!e.data || !N.test(e.data)) e.data = (e.data ? e.data + '&' : '') + (e.jsonp || 'callback') + '=?';
                e.dataType = 'json'
            }
            if (e.dataType === 'json' && (e.data && N.test(e.data) || N.test(e.url))) {
                j = e.jsonpCallback || 'jsonp' + sb++;
                if (e.data) e.data = (e.data + '').replace(N, '=' + j + '$1');
                e.url = e.url.replace(N, '=' + j + '$1');
                e.dataType = 'script';
                A[j] = A[j] || function (q) {
                    o = q;
                    b();
                    d();
                    A[j] = w;
                    try {
                        delete A[j]
                    } catch (p) {
                    }
                    z && z.removeChild(C)
                }
            }
            if (e.dataType === 'script' && e.cache === null) e.cache = false;
            if (e.cache ===
                false && n === 'GET') {
                var r = J(),
                    u = e.url.replace(wb, '$1_=' + r + '$2');
                e.url = u + (u === e.url ? (ka.test(e.url) ? '&' : '?') + '_=' + r : '')
            }
            if (e.data && n === 'GET') e.url += (ka.test(e.url) ? '&' : '?') + e.data;
            e.global && !c.active++ && c.event.trigger('ajaxStart');
            r = (r = xb.exec(e.url)) && (r[1] && r[1] !== location.protocol || r[2] !== location.host);
            if (e.dataType === 'script' && n === 'GET' && r) {
                var z = s.getElementsByTagName('head') [0] || s.documentElement,
                    C = s.createElement('script');
                C.src = e.url;
                if (e.scriptCharset) C.charset = e.scriptCharset;
                if (!j) {
                    var B =
                        false;
                    C.onload = C.onreadystatechange = function () {
                        if (!B && (!this.readyState || this.readyState === 'loaded' || this.readyState === 'complete')) {
                            B = true;
                            b();
                            d();
                            C.onload = C.onreadystatechange = null;
                            z && C.parentNode && z.removeChild(C)
                        }
                    }
                }
                z.insertBefore(C, z.firstChild);
                return w
            }
            var E = false,
                x = e.xhr();
            if (x) {
                e.username ? x.open(n, e.url, e.async, e.username, e.password)  : x.open(n, e.url, e.async);
                try {
                    if (e.data || a && a.contentType) x.setRequestHeader('Content-Type', e.contentType);
                    if (e.ifModified) {
                        c.lastModified[e.url] && x.setRequestHeader('If-Modified-Since', c.lastModified[e.url]);
                        c.etag[e.url] && x.setRequestHeader('If-None-Match', c.etag[e.url])
                    }
                    r || x.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                    x.setRequestHeader('Accept', e.dataType && e.accepts[e.dataType] ? e.accepts[e.dataType] + ', */*' : e.accepts._default)
                } catch (ga) {
                }
                if (e.beforeSend && e.beforeSend.call(k, x, e) === false) {
                    e.global && !--c.active && c.event.trigger('ajaxStop');
                    x.abort();
                    return false
                }
                e.global && f('ajaxSend', [
                    x,
                    e
                ]);
                var g = x.onreadystatechange = function (q) {
                    if (!x || x.readyState === 0 || q === 'abort') {
                        E ||
                        d();
                        E = true;
                        if (x) x.onreadystatechange = c.noop
                    } else if (!E && x && (x.readyState === 4 || q === 'timeout')) {
                        E = true;
                        x.onreadystatechange = c.noop;
                        i = q === 'timeout' ? 'timeout' : !c.httpSuccess(x) ? 'error' : e.ifModified && c.httpNotModified(x, e.url) ? 'notmodified' : 'success';
                        var p;
                        if (i === 'success') try {
                            o = c.httpData(x, e.dataType, e)
                        } catch (v) {
                            i = 'parsererror';
                            p = v
                        }
                        if (i === 'success' || i === 'notmodified') j || b();
                        else c.handleError(e, x, i, p);
                        d();
                        q === 'timeout' && x.abort();
                        if (e.async) x = null
                    }
                };
                try {
                    var h = x.abort;
                    x.abort = function () {
                        x && h.call(x);
                        g('abort')
                    }
                } catch (l) {
                }
                e.async && e.timeout > 0 && setTimeout(function () {
                    x && !E && g('timeout')
                }, e.timeout);
                try {
                    x.send(n === 'POST' || n === 'PUT' || n === 'DELETE' ? e.data : null)
                } catch (m) {
                    c.handleError(e, x, null, m);
                    d()
                }
                e.async || g();
                return x
            }
        },
        handleError: function (a, b, d, f) {
            if (a.error) a.error.call(a.context || a, b, d, f);
            if (a.global) (a.context ? c(a.context)  : c.event).trigger('ajaxError', [
                b,
                a,
                f
            ])
        },
        active: 0,
        httpSuccess: function (a) {
            try {
                return !a.status && location.protocol === 'file:' || a.status >= 200 && a.status < 300 || a.status === 304 || a.status ===
                1223 || a.status === 0
            } catch (b) {
            }
            return false
        },
        httpNotModified: function (a, b) {
            var d = a.getResponseHeader('Last-Modified'),
                f = a.getResponseHeader('Etag');
            if (d) c.lastModified[b] = d;
            if (f) c.etag[b] = f;
            return a.status === 304 || a.status === 0
        },
        httpData: function (a, b, d) {
            var f = a.getResponseHeader('content-type') || '',
                e = b === 'xml' || !b && f.indexOf('xml') >= 0;
            a = e ? a.responseXML : a.responseText;
            e && a.documentElement.nodeName === 'parsererror' && c.error('parsererror');
            if (d && d.dataFilter) a = d.dataFilter(a, b);
            if (typeof a === 'string') if (b ===
                'json' || !b && f.indexOf('json') >= 0) a = c.parseJSON(a);
            else if (b === 'script' || !b && f.indexOf('javascript') >= 0) c.globalEval(a);
            return a
        },
        param: function (a, b) {
            function d(i, o) {
                if (c.isArray(o)) c.each(o, function (k, n) {
                    b || /\[\]$/.test(i) ? f(i, n)  : d(i + '[' + (typeof n === 'object' || c.isArray(n) ? k : '') + ']', n)
                });
                else !b && o != null && typeof o === 'object' ? c.each(o, function (k, n) {
                    d(i + '[' + k + ']', n)
                })  : f(i, o)
            }
            function f(i, o) {
                o = c.isFunction(o) ? o()  : o;
                e[e.length] = encodeURIComponent(i) + '=' + encodeURIComponent(o)
            }
            var e = [
            ];
            if (b === w) b = c.ajaxSettings.traditional;
            if (c.isArray(a) || a.jquery) c.each(a, function () {
                f(this.name, this.value)
            });
            else for (var j in a) d(j, a[j]);
            return e.join('&').replace(yb, '+')
        }
    }); var la = {
    }, Ab = /toggle|show|hide/, Bb = /^([+-]=)?([\d+-.]+)(.*)$/, W, va = [
        ['height',
            'marginTop',
            'marginBottom',
            'paddingTop',
            'paddingBottom'],
        [
            'width',
            'marginLeft',
            'marginRight',
            'paddingLeft',
            'paddingRight'
        ],
        [
            'opacity'
        ]
    ]; c.fn.extend({
        show: function (a, b) {
            if (a || a === 0) return this.animate(K('show', 3), a, b);
            else {
                a = 0;
                for (b = this.length; a < b; a++) {
                    var d = c.data(this[a], 'olddisplay');
                    this[a].style.display = d || '';
                    if (c.css(this[a], 'display') === 'none') {
                        d = this[a].nodeName;
                        var f;
                        if (la[d]) f = la[d];
                        else {
                            var e = c('<' + d + ' />').appendTo('body');
                            f = e.css('display');
                            if (f === 'none') f = 'block';
                            e.remove();
                            la[d] = f
                        }
                        c.data(this[a], 'olddisplay', f)
                    }
                }
                a = 0;
                for (b = this.length; a < b; a++) this[a].style.display = c.data(this[a], 'olddisplay') || '';
                return this
            }
        },
        hide: function (a, b) {
            if (a || a === 0) return this.animate(K('hide', 3), a, b);
            else {
                a = 0;
                for (b = this.length; a < b; a++) {
                    var d = c.data(this[a], 'olddisplay');
                    !d && d !== 'none' && c.data(this[a], 'olddisplay', c.css(this[a], 'display'))
                }
                a = 0;
                for (b = this.length; a < b; a++) this[a].style.display = 'none';
                return this
            }
        },
        _toggle: c.fn.toggle,
        toggle: function (a, b) {
            var d = typeof a === 'boolean';
            if (c.isFunction(a) && c.isFunction(b)) this._toggle.apply(this, arguments);
            else a == null || d ? this.each(function () {
                var f = d ? a : c(this).is(':hidden');
                c(this) [f ? 'show' : 'hide']()
            })  : this.animate(K('toggle', 3), a, b);
            return this
        },
        fadeTo: function (a, b, d) {
            return this.filter(':hidden').css('opacity', 0).show().end().animate({
                opacity: b
            }, a, d)
        },
        animate: function (a, b, d, f) {
            var e = c.speed(b, d, f);
            if (c.isEmptyObject(a)) return this.each(e.complete);
            return this[e.queue === false ? 'each' : 'queue'](function () {
                var j = c.extend({
                    }, e),
                    i,
                    o = this.nodeType === 1 && c(this).is(':hidden'),
                    k = this;
                for (i in a) {
                    var n = i.replace(ia, ja);
                    if (i !== n) {
                        a[n] = a[i];
                        delete a[i];
                        i = n
                    }
                    if (a[i] === 'hide' && o || a[i] === 'show' && !o) return j.complete.call(this);
                    if ((i === 'height' || i === 'width') && this.style) {
                        j.display = c.css(this, 'display');
                        j.overflow = this.style.overflow
                    }
                    if (c.isArray(a[i])) {
                        (j.specialEasing =
                            j.specialEasing || {
                            }) [i] = a[i][1];
                        a[i] = a[i][0]
                    }
                }
                if (j.overflow != null) this.style.overflow = 'hidden';
                j.curAnim = c.extend({
                }, a);
                c.each(a, function (r, u) {
                    var z = new c.fx(k, j, r);
                    if (Ab.test(u)) z[u === 'toggle' ? o ? 'show' : 'hide' : u](a);
                    else {
                        var C = Bb.exec(u),
                            B = z.cur(true) || 0;
                        if (C) {
                            u = parseFloat(C[2]);
                            var E = C[3] || 'px';
                            if (E !== 'px') {
                                k.style[r] = (u || 1) + E;
                                B = (u || 1) / z.cur(true) * B;
                                k.style[r] = B + E
                            }
                            if (C[1]) u = (C[1] === '-=' ? - 1 : 1) * u + B;
                            z.custom(B, u, E)
                        } else z.custom(B, u, '')
                    }
                });
                return true
            })
        },
        stop: function (a, b) {
            var d = c.timers;
            a && this.queue([]);
            this.each(function () {
                for (var f = d.length - 1; f >= 0; f--) if (d[f].elem === this) {
                    b && d[f](true);
                    d.splice(f, 1)
                }
            });
            b || this.dequeue();
            return this
        }
    }); c.each({
        slideDown: K('show', 1),
        slideUp: K('hide', 1),
        slideToggle: K('toggle', 1),
        fadeIn: {
            opacity: 'show'
        },
        fadeOut: {
            opacity: 'hide'
        }
    }, function (a, b) {
        c.fn[a] = function (d, f) {
            return this.animate(b, d, f)
        }
    }); c.extend({
        speed: function (a, b, d) {
            var f = a && typeof a === 'object' ? a : {
                complete: d || !d && b || c.isFunction(a) && a,
                duration: a,
                easing: d && b || b && !c.isFunction(b) && b
            };
            f.duration = c.fx.off ? 0 : typeof f.duration ===
            'number' ? f.duration : c.fx.speeds[f.duration] || c.fx.speeds._default;
            f.old = f.complete;
            f.complete = function () {
                f.queue !== false && c(this).dequeue();
                c.isFunction(f.old) && f.old.call(this)
            };
            return f
        },
        easing: {
            linear: function (a, b, d, f) {
                return d + f * a
            },
            swing: function (a, b, d, f) {
                return ( - Math.cos(a * Math.PI) / 2 + 0.5) * f + d
            }
        },
        timers: [
        ],
        fx: function (a, b, d) {
            this.options = b;
            this.elem = a;
            this.prop = d;
            if (!b.orig) b.orig = {
            }
        }
    }); c.fx.prototype = {
        update: function () {
            this.options.step && this.options.step.call(this.elem, this.now, this);
            (c.fx.step[this.prop] ||
            c.fx.step._default) (this);
            if ((this.prop === 'height' || this.prop === 'width') && this.elem.style) this.elem.style.display = 'block'
        },
        cur: function (a) {
            if (this.elem[this.prop] != null && (!this.elem.style || this.elem.style[this.prop] == null)) return this.elem[this.prop];
            return (a = parseFloat(c.css(this.elem, this.prop, a))) && a > - 10000 ? a : parseFloat(c.curCSS(this.elem, this.prop)) || 0
        },
        custom: function (a, b, d) {
            function f(j) {
                return e.step(j)
            }
            this.startTime = J();
            this.start = a;
            this.end = b;
            this.unit = d || this.unit || 'px';
            this.now = this.start;
            this.pos = this.state = 0;
            var e = this;
            f.elem = this.elem;
            if (f() && c.timers.push(f) && !W) W = setInterval(c.fx.tick, 13)
        },
        show: function () {
            this.options.orig[this.prop] = c.style(this.elem, this.prop);
            this.options.show = true;
            this.custom(this.prop === 'width' || this.prop === 'height' ? 1 : 0, this.cur());
            c(this.elem).show()
        },
        hide: function () {
            this.options.orig[this.prop] = c.style(this.elem, this.prop);
            this.options.hide = true;
            this.custom(this.cur(), 0)
        },
        step: function (a) {
            var b = J(),
                d = true;
            if (a || b >= this.options.duration + this.startTime) {
                this.now =
                    this.end;
                this.pos = this.state = 1;
                this.update();
                this.options.curAnim[this.prop] = true;
                for (var f in this.options.curAnim) if (this.options.curAnim[f] !== true) d = false;
                if (d) {
                    if (this.options.display != null) {
                        this.elem.style.overflow = this.options.overflow;
                        a = c.data(this.elem, 'olddisplay');
                        this.elem.style.display = a ? a : this.options.display;
                        if (c.css(this.elem, 'display') === 'none') this.elem.style.display = 'block'
                    }
                    this.options.hide && c(this.elem).hide();
                    if (this.options.hide || this.options.show) for (var e in this.options.curAnim) c.style(this.elem, e, this.options.orig[e]);
                    this.options.complete.call(this.elem)
                }
                return false
            } else {
                e = b - this.startTime;
                this.state = e / this.options.duration;
                a = this.options.easing || (c.easing.swing ? 'swing' : 'linear');
                this.pos = c.easing[this.options.specialEasing && this.options.specialEasing[this.prop] || a](this.state, e, 0, 1, this.options.duration);
                this.now = this.start + (this.end - this.start) * this.pos;
                this.update()
            }
            return true
        }
    }; c.extend(c.fx, {
        tick: function () {
            for (var a = c.timers, b = 0; b < a.length; b++) a[b]() || a.splice(b--, 1);
            a.length ||
            c.fx.stop()
        },
        stop: function () {
            clearInterval(W);
            W = null
        },
        speeds: {
            slow: 600,
            fast: 200,
            _default: 400
        },
        step: {
            opacity: function (a) {
                c.style(a.elem, 'opacity', a.now)
            },
            _default: function (a) {
                if (a.elem.style && a.elem.style[a.prop] != null) a.elem.style[a.prop] = (a.prop === 'width' || a.prop === 'height' ? Math.max(0, a.now)  : a.now) + a.unit;
                else a.elem[a.prop] = a.now
            }
        }
    }); if (c.expr && c.expr.filters) c.expr.filters.animated = function (a) {
        return c.grep(c.timers, function (b) {
            return a === b.elem
        }).length
    }; c.fn.offset = 'getBoundingClientRect' in s.documentElement ?
        function (a) {
            var b = this[0];
            if (a) return this.each(function (e) {
                c.offset.setOffset(this, a, e)
            });
            if (!b || !b.ownerDocument) return null;
            if (b === b.ownerDocument.body) return c.offset.bodyOffset(b);
            var d = b.getBoundingClientRect(),
                f = b.ownerDocument;
            b = f.body;
            f = f.documentElement;
            return {
                top: d.top + (self.pageYOffset || c.support.boxModel && f.scrollTop || b.scrollTop) - (f.clientTop || b.clientTop || 0),
                left: d.left + (self.pageXOffset || c.support.boxModel && f.scrollLeft || b.scrollLeft) - (f.clientLeft || b.clientLeft || 0)
            }
        }
        : function (a) {
        var b =
            this[0];
        if (a) return this.each(function (r) {
            c.offset.setOffset(this, a, r)
        });
        if (!b || !b.ownerDocument) return null;
        if (b === b.ownerDocument.body) return c.offset.bodyOffset(b);
        c.offset.initialize();
        var d = b.offsetParent,
            f = b,
            e = b.ownerDocument,
            j,
            i = e.documentElement,
            o = e.body;
        f = (e = e.defaultView) ? e.getComputedStyle(b, null)  : b.currentStyle;
        for (var k = b.offsetTop, n = b.offsetLeft; (b = b.parentNode) && b !== o && b !== i; ) {
            if (c.offset.supportsFixedPosition && f.position === 'fixed') break;
            j = e ? e.getComputedStyle(b, null)  : b.currentStyle;
            k -= b.scrollTop;
            n -= b.scrollLeft;
            if (b === d) {
                k += b.offsetTop;
                n += b.offsetLeft;
                if (c.offset.doesNotAddBorder && !(c.offset.doesAddBorderForTableAndCells && /^t(able|d|h)$/i.test(b.nodeName))) {
                    k += parseFloat(j.borderTopWidth) || 0;
                    n += parseFloat(j.borderLeftWidth) || 0
                }
                f = d;
                d = b.offsetParent
            }
            if (c.offset.subtractsBorderForOverflowNotVisible && j.overflow !== 'visible') {
                k += parseFloat(j.borderTopWidth) || 0;
                n += parseFloat(j.borderLeftWidth) || 0
            }
            f = j
        }
        if (f.position === 'relative' || f.position === 'static') {
            k += o.offsetTop;
            n += o.offsetLeft
        }
        if (c.offset.supportsFixedPosition &&
            f.position === 'fixed') {
            k += Math.max(i.scrollTop, o.scrollTop);
            n += Math.max(i.scrollLeft, o.scrollLeft)
        }
        return {
            top: k,
            left: n
        }
    }; c.offset = {
        initialize: function () {
            var a = s.body,
                b = s.createElement('div'),
                d,
                f,
                e,
                j = parseFloat(c.curCSS(a, 'marginTop', true)) || 0;
            c.extend(b.style, {
                position: 'absolute',
                top: 0,
                left: 0,
                margin: 0,
                border: 0,
                width: '1px',
                height: '1px',
                visibility: 'hidden'
            });
            b.innerHTML = '<div style=\'position:absolute;top:0;left:0;margin:0;border:5px solid #000;padding:0;width:1px;height:1px;\'><div></div></div><table style=\'position:absolute;top:0;left:0;margin:0;border:5px solid #000;padding:0;width:1px;height:1px;\' cellpadding=\'0\' cellspacing=\'0\'><tr><td></td></tr></table>';
            a.insertBefore(b, a.firstChild);
            d = b.firstChild;
            f = d.firstChild;
            e = d.nextSibling.firstChild.firstChild;
            this.doesNotAddBorder = f.offsetTop !== 5;
            this.doesAddBorderForTableAndCells = e.offsetTop === 5;
            f.style.position = 'fixed';
            f.style.top = '20px';
            this.supportsFixedPosition = f.offsetTop === 20 || f.offsetTop === 15;
            f.style.position = f.style.top = '';
            d.style.overflow = 'hidden';
            d.style.position = 'relative';
            this.subtractsBorderForOverflowNotVisible = f.offsetTop === - 5;
            this.doesNotIncludeMarginInBodyOffset = a.offsetTop !== j;
            a.removeChild(b);
            c.offset.initialize = c.noop
        },
        bodyOffset: function (a) {
            var b = a.offsetTop,
                d = a.offsetLeft;
            c.offset.initialize();
            if (c.offset.doesNotIncludeMarginInBodyOffset) {
                b += parseFloat(c.curCSS(a, 'marginTop', true)) || 0;
                d += parseFloat(c.curCSS(a, 'marginLeft', true)) || 0
            }
            return {
                top: b,
                left: d
            }
        },
        setOffset: function (a, b, d) {
            if (/static/.test(c.curCSS(a, 'position'))) a.style.position = 'relative';
            var f = c(a),
                e = f.offset(),
                j = parseInt(c.curCSS(a, 'top', true), 10) || 0,
                i = parseInt(c.curCSS(a, 'left', true), 10) || 0;
            if (c.isFunction(b)) b = b.call(a, d, e);
            d = {
                top: b.top - e.top + j,
                left: b.left - e.left + i
            };
            'using' in b ? b.using.call(a, d)  : f.css(d)
        }
    }; c.fn.extend({
        position: function () {
            if (!this[0]) return null;
            var a = this[0],
                b = this.offsetParent(),
                d = this.offset(),
                f = /^body|html$/i.test(b[0].nodeName) ? {
                    top: 0,
                    left: 0
                }
                    : b.offset();
            d.top -= parseFloat(c.curCSS(a, 'marginTop', true)) || 0;
            d.left -= parseFloat(c.curCSS(a, 'marginLeft', true)) || 0;
            f.top += parseFloat(c.curCSS(b[0], 'borderTopWidth', true)) || 0;
            f.left += parseFloat(c.curCSS(b[0], 'borderLeftWidth', true)) || 0;
            return {
                top: d.top -
                f.top,
                left: d.left - f.left
            }
        },
        offsetParent: function () {
            return this.map(function () {
                for (var a = this.offsetParent || s.body; a && !/^body|html$/i.test(a.nodeName) && c.css(a, 'position') === 'static'; ) a = a.offsetParent;
                return a
            })
        }
    }); c.each(['Left',
        'Top'], function (a, b) {
        var d = 'scroll' + b;
        c.fn[d] = function (f) {
            var e = this[0],
                j;
            if (!e) return null;
            if (f !== w) return this.each(function () {
                if (j = wa(this)) j.scrollTo(!a ? f : c(j).scrollLeft(), a ? f : c(j).scrollTop());
                else this[d] = f
            });
            else return (j = wa(e)) ? 'pageXOffset' in j ? j[a ? 'pageYOffset' :
                'pageXOffset'] : c.support.boxModel && j.document.documentElement[d] || j.document.body[d] : e[d]
        }
    }); c.each(['Height',
        'Width'], function (a, b) {
        var d = b.toLowerCase();
        c.fn['inner' + b] = function () {
            return this[0] ? c.css(this[0], d, false, 'padding')  : null
        };
        c.fn['outer' + b] = function (f) {
            return this[0] ? c.css(this[0], d, false, f ? 'margin' : 'border')  : null
        };
        c.fn[d] = function (f) {
            var e = this[0];
            if (!e) return f == null ? null : this;
            if (c.isFunction(f)) return this.each(function (j) {
                var i = c(this);
                i[d](f.call(this, j, i[d]()))
            });
            return 'scrollTo' in e && e.document ? e.document.compatMode === 'CSS1Compat' && e.document.documentElement['client' + b] || e.document.body['client' + b] : e.nodeType === 9 ? Math.max(e.documentElement['client' + b], e.body['scroll' + b], e.documentElement['scroll' + b], e.body['offset' + b], e.documentElement['offset' + b])  : f === w ? c.css(e, d)  : this.css(d, typeof f === 'string' ? f : f + 'px')
        }
    }); A.jQuery = A.$ = c
}) (window);
function getUrlArgs(a) {
    var b = window.location.href;
    return new RegExp('[?&]' + a + '=([^&]+).*', 'gi').test(b) ? RegExp.$1 : ''
}
!function (a, b) {
    function c(b, c) {
        return b = b ? ' id="' + X + b + '"' : '',
            c = c ? ' style="' + c + '"' : '',
            a('<div' + b + c + '/>')
    }
    function d(a, b) {
        return b = b === U ? s.width()  : s.height(),
            'string' == typeof a ? Math.round(/%/.test(a) ? b / 100 * parseInt(a, 10)  : parseInt(a, 10))  : a
    }
    function e(a) {
        return I.photo || /\.(gif|png|jpg|jpeg|bmp)(?:\?([^#]*))?(?:#(\.*))?$/i.test(a)
    }
    function f(b) {
        for (var c in b) a.isFunction(b[c]) && 'on' !== c.substring(0, 2) && (b[c] = b[c].call(G));
        return b.rel = b.rel || G.rel || T,
            b.href = b.href || a(G).attr('href'),
            b.title = b.title || G.title,
            b
    }
    function g(b, c) {
        c && c.call(G),
            a.event.trigger(b)
    }
    function h() {
        var a,
            b,
            c,
            d = X + 'Slideshow_',
            e = 'click.' + X;
        I.slideshow && r[1] && (b = function () {
            y.text(I.slideshowStop).unbind(e).bind($, function () {
                (H < r.length - 1 || I.loop) && (a = setTimeout(L.next, I.slideshowSpeed))
            }).bind(Z, function () {
                clearTimeout(a)
            }).one(e + ' ' + _, c),
                k.removeClass(d + 'off').addClass(d + 'on'),
                a = setTimeout(L.next, I.slideshowSpeed)
        }, c = function () {
            clearTimeout(a),
                y.text(I.slideshowStart).unbind([$,
                    Z,
                    _,
                    e].join(' ')).one(e, b),
                k.removeClass(d + 'on').addClass(d + 'off')
        }, I.slideshowAuto ? b()  : c())
    }
    function i(b) {
        if (!gb) {
            if (G = b, I = f(a.extend({
                }, a.data(G, W))), r = a(G), H = 0, I.rel !== T && (r = a('.' + hb).filter(function () {
                    return (a.data(this, W).rel || this.rel) === I.rel
                }), H = r.index(G), - 1 === H && (r = r.add(G), H = r.length - 1)), !J) {
                if (J = K = S, k.show(), I.returnFocus) try {
                    G.blur(),
                        a(G).one(ab, function () {
                            try {
                                this.focus()
                            } catch (a) {
                            }
                        })
                } catch (c) {
                }
                j.css({
                    opacity: 0.7,
                    cursor: I.overlayClose ? 'pointer' : R
                }).show(),
                    I.w = d(I.initialWidth, U),
                    I.h = d(I.initialHeight, Q),
                    L.position(0),
                eb && s.bind(P + fb + ' scroll.' + fb, function () {
                    j.css({
                        width: s.width(),
                        height: s.height(),
                        top: s.scrollTop(),
                        left: s.scrollLeft()
                    })
                }).trigger('scroll.' + fb),
                    g(Y, I.onOpen),
                    x.add(A).add(z).add(y).add(w).hide(),
                    B.html(I.close).show()
            }
            L.load(S)
        }
    }
    var j,
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
        B,
        C,
        D,
        E,
        F,
        G,
        H,
        I,
        J,
        K,
        L,
        M = 'none',
        N = 'LoadedContent',
        O = !1,
        P = 'resize.',
        Q = 'y',
        R = 'auto',
        S = !0,
        T = 'nofollow',
        U = 'x',
        V = {
            transition: 'elastic',
            speed: 300,
            width: O,
            initialWidth: '600',
            innerWidth: O,
            maxWidth: O,
            height: O,
            initialHeight: '450',
            innerHeight: O,
            maxHeight: O,
            scalePhotos: S,
            scrolling: S,
            inline: O,
            html: O,
            iframe: O,
            photo: O,
            href: O,
            title: O,
            rel: O,
            opacity: 0.9,
            preloading: S,
            current: 'image {current} of {total}',
            previous: '上一个',
            next: '下一个',
            close: '关闭',
            open: O,
            returnFocus: S,
            loop: S,
            slideshow: O,
            slideshowAuto: S,
            slideshowSpeed: 2500,
            slideshowStart: 'start slideshow',
            slideshowStop: 'stop slideshow',
            onOpen: O,
            onLoad: O,
            onComplete: O,
            onCleanup: O,
            onClosed: O,
            overlayClose: S,
            escKey: S,
            arrowKey: S
        },
        W = 'colorbox',
        X = 'cbox',
        Y = X + '_open',
        Z = X + '_load',
        $ = X + '_complete',
        _ = X + '_cleanup',
        ab = X + '_closed',
        bb = X + '_purge',
        cb = X + '_loaded',
        db = a.browser.msie && !a.support.opacity,
        eb = db && a.browser.version < 7,
        fb = X + '_IE6',
        gb = O,
        hb = X + 'Element';
    L = a.fn[W] = a[W] = function (b, c) {
        var d,
            e = this;
        return !e[0] && e.selector ? e : (b = b || {
        }, c && (b.onComplete = c), e[0] && void 0 !== e.selector || (e = a('<a/>'), b.open = S), e.each(function () {
            a.data(this, W, a.extend({
            }, a.data(this, W) || V, b)),
                a(this).addClass(hb)
        }), d = b.open, a.isFunction(d) && (d = d.call(e)), d && i(e[0]), e)
    },
        L.init = function () {
            var d = 'hover',
                e = 'clear:left';
            s = a(b),
                k = c().attr({
                    id: W,
                    'class': db ? X + 'IE' : ''
                }),
                j = c('Overlay', eb ? 'position:absolute' : '').hide(),
                l = c('Wrapper'),
                m = c('Content').append(t = c(N, 'width:0; height:0; overflow:hidden'), v = c('LoadingOverlay').add(c('LoadingGraphic')), w = c('Title'), x = c('Current'), z = c('Next'), A = c('Previous'), y = c('Slideshow').bind(Y, h), B = c('Close')),
                l.append(c().append(c('TopLeft'), n = c('TopCenter'), c('TopRight')), c(O, e).append(o = c('MiddleLeft'), m, p = c('MiddleRight')), c(O, e).append(c('BottomLeft'), q = c('BottomCenter'), c('BottomRight'))).children().children().css({
                    'float': 'left'
                }),
                u = c(O, 'position:absolute; width:9999px; visibility:hidden; display:none'),
                a('body').prepend(j, k.append(l, u)),
                m.children().hover(function () {
                    a(this).addClass(d)
                }, function () {
                    a(this).removeClass(d)
                }).addClass(d),
                C = n.height() + q.height() + m.outerHeight(S) - m.height(),
                D = o.width() + p.width() + m.outerWidth(S) - m.width(),
                E = t.outerHeight(S),
                F = t.outerWidth(S),
                k.css({
                    'padding-bottom': C,
                    'padding-right': D
                }).hide(),
                z.click(L.next),
                A.click(L.prev),
                B.click(L.close),
                m.children().removeClass(d),
                a('.' + hb).live('click', function (a) {
                    0 !== a.button && 'undefined' != typeof a.button || a.ctrlKey || a.shiftKey || a.altKey || (a.preventDefault(), i(this))
                }),
                j.click(function () {
                    I && I.overlayClose && L.close()
                }),
                a(document).bind('keydown', function (a) {
                    J && I.escKey && 27 === a.keyCode && (a.preventDefault(), L.close()),
                    J && I.arrowKey && !K && r[1] && (37 === a.keyCode && (H || I.loop) ? (a.preventDefault(), A.click())  : 39 === a.keyCode && (H < r.length - 1 || I.loop) && (a.preventDefault(), z.click()))
                })
        },
        L.remove = function () {
            k.add(j).remove(),
                a('.' + hb).die('click').removeData(W).removeClass(hb)
        },
        L.position = function (a, b) {
            function c(a) {
                n[0].style.width = q[0].style.width = m[0].style.width = a.style.width,
                    v[0].style.height = v[1].style.height = m[0].style.height = o[0].style.height = p[0].style.height = a.style.height
            }
            var d,
                e = Math.max(document.documentElement.clientHeight - I.h - E - C, 0) / 2 + s.scrollTop(),
                f = Math.max(s.width() - I.w - F - D, 0) / 2 + s.scrollLeft();
            d = k.width() === I.w + F && k.height() === I.h + E ? 0 : a,
                l[0].style.width = l[0].style.height = '9999px',
                k.dequeue().animate({
                    width: I.w + F,
                    height: I.h + E,
                    top: e,
                    left: f
                }, {
                    duration: d,
                    complete: function () {
                        c(this),
                            K = O,
                            l[0].style.width = I.w + F + D + 'px',
                            l[0].style.height = I.h + E + C + 'px',
                        b && b()
                    },
                    step: function () {
                        c(this)
                    }
                })
        },
        L.resize = function (a) {
            J && (a = a || {
            }, a.width && (I.w = d(a.width, U) - F - D), a.innerWidth && (I.w = d(a.innerWidth, U)), t.css({
                width: I.w
            }), a.height && (I.h = d(a.height, Q) - E - C), a.innerHeight && (I.h = d(a.innerHeight, Q)), a.innerHeight || a.height || (a = t.wrapInner('<div style=\'overflow:auto\'></div>').children(), I.h = a.height(), a.replaceWith(a.children())), t.css({
                height: I.h
            }), L.position(I.transition === M ? 0 : I.speed))
        },
        L.prep = function (b) {
            function d(b) {
                var c,
                    d,
                    f,
                    j,
                    l = r.length,
                    m = I.loop;
                L.position(b, function () {
                    function b() {
                        db && k[0].style.removeAttribute('filter')
                    }
                    J && (db && h && t.fadeIn(100), t.show(), g(cb), w.show().html(I.title), l > 1 && ('string' == typeof I.current && x.html(I.current.replace(/\{current\}/, H + 1).replace(/\{total\}/, l)).show(), z[m || l - 1 > H ? 'show' : 'hide']().html(I.next), A[m || H ? 'show' : 'hide']().html(I.previous), c = H ? r[H - 1] : r[l - 1], f = l - 1 > H ? r[H + 1] : r[0], I.slideshow && y.show(), I.preloading && (j = a.data(f, W).href || f.href, d = a.data(c, W).href || c.href, j = a.isFunction(j) ? j.call(f)  : j, d = a.isFunction(d) ? d.call(c)  : d, e(j) && (a('<img/>') [0].src = j), e(d) && (a('<img/>') [0].src = d))), v.hide(), 'fade' === I.transition ? k.fadeTo(i, 1, function () {
                        b()
                    })  : b(), s.bind(P + X, function () {
                        L.position(0)
                    }), g($, I.onComplete))
                })
            }
            var f = 'hidden';
            if (J) {
                var h,
                    i = I.transition === M ? 0 : I.speed;
                s.unbind(P + X),
                    t.remove(),
                    t = c(N).html(b),
                    t.hide().appendTo(u.show()).css({
                        width: function () {
                            return I.w = I.w || t.width(),
                                I.w = I.mw && I.mw < I.w ? I.mw : I.w,
                                I.w
                        }(),
                        overflow: I.scrolling ? R : f
                    }).css({
                        height: function () {
                            return I.h = I.h || t.height(),
                                I.h = I.mh && I.mh < I.h ? I.mh : I.h,
                                I.h
                        }()
                    }).prependTo(m),
                    u.hide(),
                    a('#' + X + 'Photo').css({
                        cssFloat: M,
                        marginLeft: R,
                        marginRight: R
                    }),
                eb && a('select').not(k.find('select')).filter(function () {
                    return this.style.visibility !== f
                }).css({
                    visibility: f
                }).one(_, function () {
                    this.style.visibility = 'inherit'
                }),
                    'fade' === I.transition ? k.fadeTo(i, 0, function () {
                        d(0)
                    })  : d(i)
            }
        },
        L.load = function (b) {
            var h,
                i,
                j,
                l = L.prep;
            K = S,
                G = r[H],
            b || (I = f(a.extend({
            }, a.data(G, W)))),
                g(bb),
                g(Z, I.onLoad),
                I.h = I.height ? d(I.height, Q) - E - C : I.innerHeight && d(I.innerHeight, Q),
                I.w = I.width ? d(I.width, U) - F - D : I.innerWidth && d(I.innerWidth, U),
                I.mw = I.w,
                I.mh = I.h,
            I.maxWidth && (I.mw = d(I.maxWidth, U) - F - D, I.mw = I.w && I.w < I.mw ? I.w : I.mw),
            I.maxHeight && (I.mh = d(I.maxHeight, Q) - E - C, I.mh = I.h && I.h < I.mh ? I.h : I.mh),
                h = I.href,
                v.show(),
                I.inline ? (c().hide().insertBefore(a(h) [0]).one(bb, function () {
                    a(this).replaceWith(t.children())
                }), l(a(h)))  : I.iframe ? (k.one(cb, function () {
                    var b = a('<iframe frameborder=\'0\' style=\'width:100%; height:100%; border:0; display:block\'/>') [0];
                    b.name = X + + new Date,
                        b.src = I.href,
                    I.scrolling || (b.scrolling = 'no'),
                    db && (b.allowtransparency = 'true'),
                        a(b).appendTo(t).one(bb, function () {
                            b.src = '//about:blank'
                        })
                }), l(' '))  : I.html ? l(I.html)  : e(h) ? (i = new Image, i.onload = function () {
                    var b;
                    i.onload = null,
                        i.id = X + 'Photo',
                        a(i).css({
                            border: M,
                            display: 'block',
                            cssFloat: 'left'
                        }),
                    I.scalePhotos && (j = function () {
                        i.height -= i.height * b,
                            i.width -= i.width * b
                    }, I.mw && i.width > I.mw && (b = (i.width - I.mw) / i.width, j()), I.mh && i.height > I.mh && (b = (i.height - I.mh) / i.height, j())),
                    I.h && (i.style.marginTop = Math.max(I.h - i.height, 0) / 2 + 'px'),
                    r[1] && (H < r.length - 1 || I.loop) && a(i).css({
                        cursor: 'pointer'
                    }).click(L.next),
                    db && (i.style.msInterpolationMode = 'bicubic'),
                        setTimeout(function () {
                            l(i)
                        }, 1)
                }, setTimeout(function () {
                    i.src = h
                }, 1))  : h && u.load(h, function (b, c, d) {
                    l('error' === c ? 'Request unsuccessful: ' + d.statusText : a(this).children())
                })
        },
        L.next = function () {
            K || (H = H < r.length - 1 ? H + 1 : 0, L.load())
        },
        L.prev = function () {
            K || (H = H ? H - 1 : r.length - 1, L.load())
        },
        L.close = function () {
            J && !gb && (gb = S, J = O, g(_, I.onCleanup), s.unbind('.' + X + ' .' + fb), j.fadeTo('fast', 0), k.stop().fadeTo('fast', 0, function () {
                g(bb),
                    t.remove(),
                    k.add(j).css({
                        opacity: 1,
                        cursor: R
                    }).hide(),
                    setTimeout(function () {
                        gb = O,
                            g(ab, I.onClosed)
                    }, 1)
            }))
        },
        L.element = function () {
            return a(G)
        },
        L.settings = V,
        a(L.init)
}(jQuery, this), function (a) {
    function b(b) {
        var c = a(this),
            d = null,
            e = [
            ],
            f = null,
            g = null,
            h = a.extend({
                rowSelector: '> li',
                submenuSelector: '*',
                submenuDirection: 'right',
                tolerance: 75,
                enter: a.noop,
                exit: a.noop,
                activate: a.noop,
                deactivate: a.noop,
                exitMenu: a.noop
            }, b),
            i = h.exit,
            j = null;
        h.exit = function (a) {
            function b() {
                d && h.deactivate(d),
                    d = null
            }
            j && clearTimeout(j);
            var c = e[e.length - 1],
                f = e[0];
            c && f && c.x - f.x > 0 ? j = setTimeout(function () {
                i(a, b)
            }, l)  : i(a, b)
        };
        var k = 3,
            l = 300,
            m = function (a) {
                e.push({
                    x: a.pageX,
                    y: a.pageY
                }),
                e.length > k && e.shift()
            },
            n = function () {
                g && clearTimeout(g),
                h.exitMenu(this) && (d && h.deactivate(d), d = null)
            },
            o = function () {
                g && clearTimeout(g),
                    h.enter(this),
                    s(this)
            },
            p = function () {
                h.exit(this)
            },
            q = function () {
                r(this)
            },
            r = function (a) {
                a != d && (d && h.deactivate(d), h.activate(a), d = a)
            },
            s = function (a) {
                var b = t();
                b ? g = setTimeout(function () {
                    s(a)
                }, b)  : r(a)
            },
            t = function () {
                function b(a, b) {
                    return (b.y - a.y) / (b.x - a.x)
                }
                if (!d || !a(d).is(h.submenuSelector)) return 0;
                var g = c.offset(),
                    i = {
                        x: g.left,
                        y: g.top - h.tolerance
                    },
                    j = {
                        x: g.left + c.outerWidth(),
                        y: i.y
                    },
                    k = {
                        x: g.left,
                        y: g.top + c.outerHeight() + h.tolerance
                    },
                    m = {
                        x: g.left + c.outerWidth(),
                        y: k.y
                    },
                    n = e[e.length - 1],
                    o = e[0];
                if (!n) return 0;
                if (o || (o = n), o.x < g.left || o.x > m.x || o.y < g.top || o.y > m.y) return 0;
                if (f && n.x == f.x && n.y == f.y) return 0;
                var p = j,
                    q = m;
                'left' == h.submenuDirection ? (p = k, q = i)  : 'below' == h.submenuDirection ? (p = m, q = k)  : 'above' == h.submenuDirection && (p = i, q = j);
                var r = b(n, p),
                    s = b(n, q),
                    t = b(o, p),
                    u = b(o, q);
                return t > r && s > u ? (f = n, l)  : (f = null, 0)
            };
        c.mouseleave(n).find(h.rowSelector).mouseenter(o).mouseleave(p).click(q),
            a(document).mousemove(m)
    }
    a.fn.menuAim = function (a) {
        return this.each(function () {
            b.call(this, a)
        }),
            this
    }
}(jQuery), $.fn.watch = function (a, b, c, d) {
    function e(a) {
        var b = $(this),
            c = b.data(a),
            d = !1,
            e = 0;
        for (e; e < c.props.length; e++) {
            var f = b.css(c.props[e]);
            if (c.vals[e] != f) {
                c.vals[e] = f,
                    d = !0;
                break
            }
        }
        if (d && c.func) {
            var g = this;
            c.func.call(g, c, e)
        }
    }
    return c || (c = 200),
    d || (d = '_watcher'),
        this.each(function () {
            var f = this,
                g = $(this),
                h = function () {
                    e.call(f, d)
                },
                i = null;
            $.browser.mozilla ? g.bind('DOMAttrModified.' + d, h)  : i = setInterval(h, c);
            var j = {
                id: i,
                props: a.split(','),
                func: b,
                vals: [
                ]
            };
            $.each(j.props, function (a) {
                j.vals[a] = g.css(j.props[a])
            }),
                g.data(d, j)
        })
}, $.fn.unwatch = function (a) {
    return this.each(function () {
        var b = $(this).data(a),
            c = $(this);
        c.removeData(),
            $.browser.mozilla ? c.unbind('DOMAttrModified.' + a, fnc)  : clearInterval(b.id)
    }),
        this
}, function (a) {
    a.fn.lazyload = function (b) {
        var c = {
            threshold: 0,
            failurelimit: 0,
            event: 'scroll',
            effect: 'show',
            container: window
        };
        b && a.extend(c, b);
        var d = this;
        if ('scroll' == c.event) {
            var e = function () {
                var b = 0;
                d.each(function () {
                    if (a.abovethetop(this, c) || a.leftofbegin(this, c));
                    else if (a.belowthefold(this, c) || a.rightoffold(this, c)) {
                        if (b++ > c.failurelimit) return !1
                    } else a(this).trigger('appear')
                });
                var e = a.grep(d, function (a) {
                    return !a.loaded
                });
                d = a(e)
            };
            if (a.browser.msie && '6.0' == a.browser.version) {
                var f = - 1,
                    g = null,
                    h = a(window);
                a(c.container).bind('scroll', function () {
                    null != g && clearTimeout(g),
                        g = setTimeout(function () {
                            g = null;
                            var a = h.scrollTop();
                            a != f && e(),
                                f = a
                        }, 200)
                })
            } else a(c.container).bind('scroll', e)
        }
        return this.each(function () {
            var b = this;
            void 0 == a(b).attr('original') && a(b).attr('original', a(b).attr('src')),
                'scroll' != c.event || void 0 == a(b).attr('src') || c.placeholder == a(b).attr('src') || a.abovethetop(b, c) || a.leftofbegin(b, c) || a.belowthefold(b, c) || a.rightoffold(b, c) ? (c.placeholder && a(b).attr('src', c.placeholder), b.loaded = !1)  : b.loaded = !1,
                a(b).one('appear', function () {
                    this.loaded && - 1 != this.loaded || a('<img />').bind('load', function () {
                        a(b).hide().attr('src', a(b).attr('original')) [c.effect](c.effectspeed),
                            b.loaded = !0
                    }).attr('src', a(b).attr('original'))
                }),
            'scroll' != c.event && a(b).bind(c.event, function () {
                b.loaded || a(b).trigger('appear')
            })
        }),
            a(c.container).trigger(c.event),
            this
    },
        a.fn.lazyload_textarea = function (b) {
            var c = {
                threshold: 0,
                failurelimit: 0,
                event: 'scroll',
                effect: 'show',
                container: window
            };
            b && a.extend(c, b);
            var d = this;
            if ('scroll' == c.event) {
                var e = function () {
                    var b = 0;
                    d.each(function () {
                        if (a.abovethetop(this, c) || a.leftofbegin(this, c));
                        else if (a.belowthefold(this, c) || a.rightoffold(this, c)) {
                            if (b++ > c.failurelimit) return !1
                        } else a(this).trigger('appear')
                    });
                    var e = a.grep(d, function (b) {
                        return a(b).hasClass('lazyload')
                    });
                    d = a(e)
                };
                if (a.browser.msie && '6.0' == a.browser.version) {
                    var f = - 1,
                        g = null,
                        h = a(window);
                    a(c.container).bind('scroll', function () {
                        null != g && clearTimeout(g),
                            g = setTimeout(function () {
                                g = null;
                                var a = h.scrollTop();
                                a != f && e(),
                                    f = a
                            }, 200)
                    })
                } else a(c.container).bind('scroll', e)
            }
            return this.each(function () {
                var b = this;
                a(b).one('appear', function () {
                    a(b).parent().html(a(this).val()),
                        a(b).removeClass('lazyload')
                })
            }),
                a(c.container).trigger(c.event),
                this
        },
        a.belowthefold = function (b, c) {
            if (void 0 === c.container || c.container === window) var d = a(window).height() + a(window).scrollTop();
            else var d = a(c.container).offset().top + a(c.container).height();
            return d <= a(b).offset().top - c.threshold
        },
        a.rightoffold = function (b, c) {
            if (void 0 === c.container || c.container === window) var d = a(window).width() + a(window).scrollLeft();
            else var d = a(c.container).offset().left + a(c.container).width();
            return d <= a(b).offset().left - c.threshold
        },
        a.abovethetop = function (b, c) {
            if (void 0 === c.container || c.container === window) var d = a(window).scrollTop();
            else var d = a(c.container).offset().top;
            return d >= a(b).offset().top + c.threshold + a(b).height()
        },
        a.leftofbegin = function (b, c) {
            if (void 0 === c.container || c.container === window) var d = a(window).scrollLeft();
            else var d = a(c.container).offset().left;
            return d >= a(b).offset().left + c.threshold + a(b).width()
        },
        a.extend(a.expr[':'], {
            'below-the-fold': '$.belowthefold(a, {threshold : 0, container: window})',
            'above-the-fold': '!$.belowthefold(a, {threshold : 0, container: window})',
            'right-of-fold': '$.rightoffold(a, {threshold : 0, container: window})',
            'left-of-fold': '!$.rightoffold(a, {threshold : 0, container: window})'
        })
}(jQuery), jQuery.fn.extend({
    everyTime: function (a, b, c, d) {
        return this.each(function () {
            jQuery.timer.add(this, a, b, c, d)
        })
    },
    oneTime: function (a, b, c) {
        return this.each(function () {
            jQuery.timer.add(this, a, b, c, 1)
        })
    },
    stopTime: function (a, b) {
        return this.each(function () {
            jQuery.timer.remove(this, a, b)
        })
    }
}), jQuery.extend({
    timer: {
        global: [
        ],
        guid: 1,
        dataKey: 'jQuery.timer',
        regex: /^([0-9]+(?:\.[0-9]*)?)\s*(.*s)?$/,
        powers: {
            ms: 1,
            cs: 10,
            ds: 100,
            s: 1000,
            das: 10000,
            hs: 100000,
            ks: 1000000
        },
        timeParse: function (a) {
            if (void 0 == a || null == a) return null;
            var b = this.regex.exec(jQuery.trim(a.toString()));
            if (b[2]) {
                var c = parseFloat(b[1]),
                    d = this.powers[b[2]] || 1;
                return c * d
            }
            return a
        },
        add: function (a, b, c, d, e) {
            var f = 0;
            if (jQuery.isFunction(c) && (e || (e = d), d = c, c = b), b = jQuery.timer.timeParse(b), !('number' != typeof b || isNaN(b) || 0 > b)) {
                ('number' != typeof e || isNaN(e) || 0 > e) && (e = 0),
                    e = e || 0;
                var g = jQuery.data(a, this.dataKey) || jQuery.data(a, this.dataKey, {
                    });
                g[c] || (g[c] = {
                }),
                    d.timerID = d.timerID || this.guid++;
                var h = function () {
                    (++f > e && 0 !== e || d.call(a, f) === !1) && jQuery.timer.remove(a, c, d)
                };
                h.timerID = d.timerID,
                g[c][d.timerID] || (g[c][d.timerID] = window.setInterval(h, b)),
                    this.global.push(a)
            }
        },
        remove: function (a, b, c) {
            var d,
                e = jQuery.data(a, this.dataKey);
            if (e) {
                if (b) {
                    if (e[b]) {
                        if (c) c.timerID && (window.clearInterval(e[b][c.timerID]), delete e[b][c.timerID]);
                        else for (var c in e[b]) window.clearInterval(e[b][c]),
                            delete e[b][c];
                        for (d in e[b]) break;
                        d || (d = null, delete e[b])
                    }
                } else for (b in e) this.remove(a, b, c);
                for (d in e) break;
                d || jQuery.removeData(a, this.dataKey)
            }
        }
    }
}), jQuery(window).bind('unload', function () {
    jQuery.each(jQuery.timer.global, function (a, b) {
        jQuery.timer.remove(b)
    })
}), jQuery.cookie = function (a, b, c) {
    if ('undefined' == typeof b) {
        var d = null;
        if (document.cookie && '' != document.cookie) for (var e = document.cookie.split(';'), f = 0; f < e.length; f++) {
            var g = jQuery.trim(e[f]);
            if (g.substring(0, a.length + 1) == a + '=') {
                d = decodeURIComponent(g.substring(a.length + 1));
                break
            }
        }
        return d
    }
    c = c || {
    },
    null === b && (b = '', c = $.extend({
    }, c), c.expires = - 1);
    var h = '';
    if (c.expires && ('number' == typeof c.expires || c.expires.toUTCString)) {
        var i;
        'number' == typeof c.expires ? (i = new Date, i.setTime(i.getTime() + 1000 * 60 * 60 * 24 * c.expires))  : i = c.expires,
            h = '; expires=' + i.toUTCString()
    }
    var j = c.path ? '; path=' + c.path : '',
        k = c.domain ? '; domain=' + c.domain : '',
        l = c.secure ? '; secure' : '';
    document.cookie = [
        a,
        '=',
        encodeURIComponent(b),
        h,
        j,
        k,
        l
    ].join('')
}, function (a) {
    imageSlidePlayer = function (b, c) {
        this.obj = b,
            this.n = 0,
            this.j = 0,
            this.first_show = 1;
        var d,
            e = this,
            f = {
                fontsize: 12,
                left: 10,
                bottom: 15,
                time: 5000,
                autosize: 0
            };
        this.config = a.extend(f, c),
            this.count = a(this.obj + ' li').size(),
            14 == this.config.fontsize ? (this.height = 23, this.right = 6, this.bottom = 15)  : (this.height = 21, this.right = 6, this.bottom = 10),
            this.factory = function () {
                a(this.obj).css({
                    position: 'relative',
                    zIndex: '0',
                    overflow: 'hidden',
                    height: a(this.obj + ' ul').height() + 'px'
                }),
                    a(this.obj).prepend('<div class=\'img_slider_trigger\' style=\'position:absolute;z-index:20;left:' + this.config.left + 'px;bottom:' + this.config.bottom + 'px\'></div>'),
                    a(this.obj + ' ul').css({
                        position: 'relative',
                        zIndex: '0',
                        margin: '0',
                        padding: '0',
                        overflow: 'hidden',
                        width: '100%'
                    }),
                    a(this.obj + ' li').css({
                        position: 'absolute',
                        top: '0',
                        left: '0',
                        width: '100%',
                        height: '100%',
                        overflow: 'hidden'
                    }).hide().each(function (b) {
                        a(e.obj + ' div').append('<a>' + (b + 1) + '</a>')
                    }),
                    a(this.obj + ' img').css({
                        border: 'none'
                    }),
                this.config.autosize && a(this.obj + ' img').css({
                    width: '100%',
                    height: '100%'
                }),
                    this.resetclass(this.obj + ' div a', 0);
                var b = a(this.obj + ' p');
                b.size() > 0 && (a(this.obj).prepend('<div class=\'dkTitleBg\'></div>'), a(this.obj + ' .dkTitleBg').css({
                    position: 'absolute',
                    margin: '0',
                    padding: '0',
                    zIndex: '1',
                    bottom: '0',
                    left: '0',
                    width: '100%',
                    height: e.height + 'px',
                    overflow: 'hidden',
                    opacity: '0.4'
                }), a.browser.msie && 6 == a.browser.version ? a(this.obj + ' .dkTitleBg').css('filter', 'progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\'' + RM_IMGDIR + '/mall/mall_dot.png\');')  : a(this.obj + ' .dkTitleBg').css({
                    background: 'url(' + RM_IMGDIR + '/mall/mall_dot.png) no-repeat'
                }), a(this.obj).prepend('<div class=\'dkTitle\'></div>'), b.each(function (b) {
                    a(this).appendTo(a(e.obj + ' .dkTitle')).css({
                        position: 'absolute',
                        margin: '0',
                        padding: '0',
                        zIndex: '2',
                        bottom: '0',
                        left: '0',
                        width: '100%',
                        height: e.height + 'px',
                        lineHeight: e.height + 'px',
                        fontSize: e.config.fontsize + 'px',
                        textIndent: '5px',
                        textDecoration: 'none',
                        color: '#FFFFFF',
                        background: 'none',
                        opacity: '1',
                        overflow: 'hidden'
                    }),
                    0 != b && a(this).hide()
                })),
                    this.slide(),
                    this.addhover(),
                    d = setInterval(this.autoplay, this.config.time),
                    a(e.obj + ' div a').eq(0).triggerHandler('mouseover')
            },
            this.slide = function () {
                a(this.obj + ' div a').mouseover(function () {
                    e.j = a(this).text() - 1,
                        e.n = e.j,
                    e.j >= e.count || (e.first_show ? (e.first_show = 0, a(e.obj + ' li:eq(' + e.j + ')').show().siblings('li').hide())  : a(e.obj + ' li:eq(' + e.j + ')').fadeIn('200').siblings('li').fadeOut('200'), a(e.obj + ' .dkTitle p:eq(' + e.j + ')').show().siblings().hide(), e.resetclass(e.obj + ' div a', e.j))
                })
            },
            this.addhover = function () {
                a(this.obj).hover(function () {
                    clearInterval(d)
                }, function () {
                    d = setInterval(e.autoplay, e.config.time)
                })
            },
            this.autoplay = function () {
                e.n = e.n >= e.count - 1 ? 0 : ++e.n,
                    a(e.obj + ' div a').eq(e.n).triggerHandler('mouseover')
            },
            this.resetclass = function (b, c) {
                a(b).removeClass('mall_dot_hover').addClass('mall_dot'),
                    a(b).eq(c).addClass('mall_dot_hover'),
                a.browser.msie && 6 == a.browser.version && a('.img_slider_trigger').css('zoom', '1')
            },
            this.factory()
    }
}(jQuery),
    function (a) {
    var b = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=',
        c = function (a) {
            a = a.replace(/\x0d\x0a/g, '\n');
            for (var b = '', c = 0; c < a.length; c++) {
                var d = a.charCodeAt(c);
                128 > d ? b += String.fromCharCode(d)  : d > 127 && 2048 > d ? (b += String.fromCharCode(192 | d >> 6), b += String.fromCharCode(128 | 63 & d))  : (b += String.fromCharCode(224 | d >> 12), b += String.fromCharCode(128 | 63 & d >> 6), b += String.fromCharCode(128 | 63 & d))
            }
            return b
        },
        d = function (a) {
            for (var b = '', c = 0, d = c1 = c2 = 0; c < a.length; ) d = a.charCodeAt(c),
                128 > d ? (b += String.fromCharCode(d), c++)  : d > 191 && 224 > d ? (c2 = a.charCodeAt(c + 1), b += String.fromCharCode((31 & d) << 6 | 63 & c2), c += 2)  : (c2 = a.charCodeAt(c + 1), c3 = a.charCodeAt(c + 2), b += String.fromCharCode((15 & d) << 12 | (63 & c2) << 6 | 63 & c3), c += 3);
            return b
        };
    a.extend({
        base64Encode: function (a) {
            var d,
                e,
                f,
                g,
                h,
                i,
                j,
                k = '',
                l = 0;
            for (a = c(a); l < a.length; ) d = a.charCodeAt(l++),
                e = a.charCodeAt(l++),
                f = a.charCodeAt(l++),
                g = d >> 2,
                h = (3 & d) << 4 | e >> 4,
                i = (15 & e) << 2 | f >> 6,
                j = 63 & f,
                isNaN(e) ? i = j = 64 : isNaN(f) && (j = 64),
                k = k + b.charAt(g) + b.charAt(h) + b.charAt(i) + b.charAt(j);
            return k
        },
        base64Decode: function (a) {
            var c,
                e,
                f,
                g,
                h,
                i,
                j,
                k = '',
                l = 0;
            for (a = a.replace(/[^A-Za-z0-9\+\/\=]/g, ''); l < a.length; ) g = b.indexOf(a.charAt(l++)),
                h = b.indexOf(a.charAt(l++)),
                i = b.indexOf(a.charAt(l++)),
                j = b.indexOf(a.charAt(l++)),
                c = g << 2 | h >> 4,
                e = (15 & h) << 4 | i >> 2,
                f = (3 & i) << 6 | j,
                k += String.fromCharCode(c),
            64 != i && (k += String.fromCharCode(e)),
            64 != j && (k += String.fromCharCode(f));
            return k = d(k)
        }
    })
}(jQuery), function ($) {
    $.fn.jSort = function (options) {
        var options = $.extend({
            sort_by: 'p',
            item: 'div',
            order: 'asc',
            is_num: !1
        }, options);
        return this.each(function () {
            var hndl = this,
                titles = [
                ],
                i = 0;
            $(this).find(options.item).each(function () {
                var a = $(this).find(options.sort_by).text().toLowerCase();
                titles.push([a,
                    i]),
                    $(this).attr('rel', 'sort' + i),
                    i++
            }),
                this.sortNum = function (a, b) {
                    return eval(a[0] - b[0])
                },
                this.sortABC = function (a, b) {
                    return a[0] > b[0] ? 1 : - 1
                },
                options.is_num ? titles.sort(hndl.sortNum)  : titles.sort(hndl.sortABC),
            'desc' == options.order && (options.is_num ? titles.reverse(hndl.sortNum)  : titles.reverse(hndl.sortABC));
            for (var t = titles.length; t > 0; t--) {
                var el = $(hndl).find(options.item + '[rel=\'sort' + titles[t - 1][1] + '\']');
                $(hndl).prepend(el)
            }
        })
    }
}(jQuery), function (a) {
    HtmlSlidePlayer = function (b, c) {
        this.obj = b,
            this.n = 0,
            this.j = 0,
            this.first_show = 1;
        var d,
            e = this,
            f = this.obj,
            g = {
                fontsize: 12,
                right: 10,
                bottom: 15,
                time: 5000,
                autosize: 0,
                slidearrow: !1,
                dot: !0
            };
        this.config = a.extend(g, c),
            this.count = a(f + ' li').length,
            this.factory = function () {
                a(f).css({
                    position: 'relative'
                });
                var b = a('<div class=\'slide_control\'></div>');
                a(f).prepend(b),
                this.config.dot || b.hide(),
                    a(f + ' li').css({
                        position: 'absolute',
                        top: '0',
                        left: '0',
                        width: '100%',
                        height: '100%',
                        overflow: 'hidden'
                    }).hide().each(function (a) {
                        b.append('<a>' + (a + 1) + '</a>')
                    }),
                this.count <= 1 && b.hide(),
                    this.resetclass(f + ' .slide_control a', 0);
                var c = a(f + ' li').first(),
                    e = a('img[lazyload]', c);
                a.each(e, function () {
                    a(this).attr('src', a(this).attr('lazyload')).removeAttr('lazyload')
                }),
                c.length > 0 && c.attr('lazyload') && c.css('background-image', 'url(' + c.attr('lazyload') + ')').removeAttr('lazyload'),
                    this.slide(),
                    this.slidearrow(),
                    d = setInterval(this.autoplay, this.config.time),
                    a(f + ' .slide_control a').eq(0).triggerHandler('mouseover')
            },
            this.slidearrow = function () {
                var b,
                    c;
                if (this.config.slidearrow) b = a('<em class="slidearrow slidearrow_l"><</em>'),
                    c = a('<em class="slidearrow slidearrow_r">></em>'),
                    a(f).append(b).append(c);
                else {
                    var d = a(f).find('.img_slider_btn');
                    d.length && (b = d.eq(0), c = d.eq(1))
                }
                c && b && (c.bind('click', function () {
                    e.n == e.count - 1 ? a(f + ' .slide_control a').eq(0).triggerHandler('mouseover')  : a(f + ' .slide_control a').eq(e.n + 1).triggerHandler('mouseover')
                }), b.bind('click', function () {
                    0 == e.n ? a(f + ' .slide_control a').eq(e.count - 1).triggerHandler('mouseover')  : a(f + ' .slide_control a').eq(e.n - 1).triggerHandler('mouseover')
                }))
            },
            this.slide = function () {
                a(f + ' .slide_control a').lazyhover(function () {
                    if (e.j = a(this).text() - 1, e.n = e.j, !(e.j >= e.count)) {
                        if (e.first_show) e.first_show = 0,
                            a(f + ' li:eq(' + e.j + ')').show().siblings('li').hide();
                        else {
                            var b,
                                c = a(f + ' li:eq(' + e.j + ')');
                            e.count >= e.j + 1 && (b = a(f + ' li:eq(' + (e.j + 1) + ')')),
                                c.fadeIn('200').siblings('li').fadeOut('200');
                            var d = a('img[lazyload]', c);
                            a.each(d, function () {
                                a(this).attr('src', a(this).attr('lazyload')).removeAttr('lazyload')
                            });
                            var g,
                                h = c.attr('lazyload');
                            if (h || (g = c.find('a'), h = g.attr('lazyload')), void 0 != h && (g ? g.css('background', 'url(' + h + ') no-repeat center 0').removeAttr('lazyload')  : c.css('background-image', 'url(' + h + ')').removeAttr('lazyload'), void 0 != b && b.length >= 1)) {
                                var i,
                                    j = b.attr('lazyload');
                                j || (i = b.find('a'), j = g.attr('lazyload')),
                                void 0 != j && (i ? i.css('background', 'url(' + j + ') no-repeat center 0').removeAttr('lazyload')  : b.css('background-image', 'url(' + j + ')').removeAttr('lazyload'))
                            }
                        }
                        e.resetclass(f + ' .slide_control a', e.j)
                    }
                }, 200, 500)
            };
        var h = a(f + ' li').length;
        a(a(f) [0]).mouseover(function () {
            clearInterval(d),
            h > 1 && a(f + ' .img_slider_btn').css('display', 'block')
        }).mouseout(function () {
            d = setInterval(e.autoplay, e.config.time),
            h > 1 && a(f + ' .img_slider_btn').hide()
        }),
            this.autoplay = function () {
                e.n = e.n >= e.count - 1 ? 0 : ++e.n,
                    a(f + ' .slide_control a').eq(e.n).triggerHandler('mouseover')
            },
            this.resetclass = function (b, c) {
                a(b).removeClass('mall_dot_hover').addClass('mall_dot'),
                    a(b).eq(c).addClass('mall_dot_hover'),
                a.browser.msie && 6 == a.browser.version && a('.img_slider_trigger').css('zoom', '1')
            },
            this.factory()
    }
}(jQuery), $(function () {
    $.fn.lazyhover = function (a, b, c) {
        var d,
            e = $(this),
            f = 1,
            g = function (b) {
                return clearTimeout(d),
                f || e.removeData('timer'),
                    f ? a.apply(b)  : null
            },
            h = b || 0,
            i = c || 500,
            j = function (a) {
                d && clearTimeout(d),
                    d = setTimeout(function () {
                        g(a)
                    }, f ? h : i),
                    e.data('timer', d)
            };
        e.hover(function () {
            f = 1,
                j(this)
        }, function () {
            f = 0,
                j(this)
        })
    }
}), function (a) {
    a.fn.hoverLazy = function (b) {
        var c = a.extend({
            current: 'hover',
            delay: 20
        }, b || {
        });
        a.each(this, function () {
            var b = null,
                d = null,
                e = !1;
            a(this).bind('mouseover', function () {
                if (e) clearTimeout(d);
                else {
                    var f = a(this);
                    b = setTimeout(function () {
                        f.addClass(c.current),
                            e = !0
                    }, c.delay)
                }
            }).bind('mouseout', function () {
                if (e) {
                    var f = a(this);
                    d = setTimeout(function () {
                        f.removeClass(c.current),
                            e = !1
                    }, c.delay)
                } else clearTimeout(b)
            })
        })
    }
}(jQuery), function (a) {
    a.fn.hoverIntent = function (b, c) {
        var d = {
            sensitivity: 7,
            interval: 100,
            timeout: 0
        };
        d = a.extend(d, c ? {
            over: b,
            out: c
        }
            : b);
        var e,
            f,
            g,
            h,
            i = function (a) {
                e = a.pageX,
                    f = a.pageY
            },
            j = function (b, c) {
                return c.hoverIntent_t = clearTimeout(c.hoverIntent_t),
                    Math.abs(g - e) + Math.abs(h - f) < d.sensitivity ? (a(c).unbind('mousemove', i), c.hoverIntent_s = 1, d.over.apply(c, [
                        b
                    ]))  : (g = e, h = f, c.hoverIntent_t = setTimeout(function () {
                        j(b, c)
                    }, d.interval), void 0)
            },
            k = function (a, b) {
                return b.hoverIntent_t = clearTimeout(b.hoverIntent_t),
                    b.hoverIntent_s = 0,
                    d.out.apply(b, [
                        a
                    ])
            },
            l = function (b) {
                var c = jQuery.extend({
                    }, b),
                    e = this;
                e.hoverIntent_t && (e.hoverIntent_t = clearTimeout(e.hoverIntent_t)),
                    'mouseenter' == b.type ? (g = c.pageX, h = c.pageY, a(e).bind('mousemove', i), 1 != e.hoverIntent_s && (e.hoverIntent_t = setTimeout(function () {
                        j(c, e)
                    }, d.interval)))  : (a(e).unbind('mousemove', i), 1 == e.hoverIntent_s && (e.hoverIntent_t = setTimeout(function () {
                        k(c, e)
                    }, d.timeout)))
            };
        return this.bind('mouseenter', l).bind('mouseleave', l)
    }
}(jQuery), function (a) {
    function b(a, b, c) {
        switch (b) {
            case 'crop':
                a = a.wrap('<div class="jq-ss-crop">').parent().css({
                    overflow: 'hidden',
                    'float': 'left'
                });
            case 'resize':
                return a.css(c);
            case 'simple':
                return a.wrap('<div class="jq-ss-simple">').parent();
            case 'link':
                if (a.is('img')) return a.wrap('<a target="_blank" class="jq-ss-link">').parent().each(function () {
                    this.href = this.firstChild.src
                });
            default:
                return a
        }
    }
    var c = {
        elements: 'img',
        itemSize: {
            height: 72,
            width: 148
        },
        view: null,
        navigators: null,
        navigationMode: 's',
        speed: 600,
        wrappers: 'simple',
        circular: !1,
        easing: 'linear',
        axis: 'x',
        margin: !0,
        start: null,
        setWidth: !1
    };
    a.fn.scrollShow = function (d) {
        return d = a.extend({
        }, c, d),
            this.each(function () {
                function c(a) {
                    return e(a + 'Left') + e(a + 'Right')
                }
                function e(a) {
                    return parseInt(j.css(a)) || 0
                }
                function f(a) {
                    return a.data.pos = l + a.data.dir,
                        g(a)
                }
                function g(a) {
                    var b = 'number' == typeof a ? a : a.data.pos;
                    return 0 > b ? b = 0 == l && d.circular ? k : 0 : b > k && (b = l == k && d.circular ? 0 : k),
                        i.stop().scrollTo(j[b], d),
                        l = b,
                        !1
                }
                var h = this,
                    i = d.view ? a(d.view, this)  : this,
                    j = a(d.elements, i),
                    k = j.length,
                    l = 0;
                a.each(d.wrappers.split(/\s*,\s*/), function (a, c) {
                    j = b(j, c, d.itemSize)
                }),
                    j.css(d.itemSize),
                d.navigators || (d.navigators = '', d.navigationMode = 'r'),
                d.navigators.constructor != Array && (d.navigators = [
                    d.navigators
                ]),
                    a.each(d.navigationMode.split(''), function (b, c) {
                        switch (c.charAt(0)) {
                            case 's':
                                a(d.navigators[b], h).eq(0).bind('click', {
                                    dir: - 1
                                }, f).end().eq(1).bind('click', {
                                    dir: 1
                                }, f);
                                break;
                            case 'r':
                                var e = a(d.navigators[b] || j, h),
                                    i = j.length / e.length;
                                if (1 / 0 === i) return;
                                e.each(function (b) {
                                    a(this).bind('click', {
                                        pos: Math.floor(i * b)
                                    }, g)
                                })
                        }
                    }), function (a, b) {
                    var f = a.width() + c('margin') + c('padding') + e('border');
                    do b -= f;
                    while (b > 0 && k--);
                    if (d.setWidth) {
                        do if (a = a.parent(), a[0] == i[0]) return;
                        while (a.length > 1);
                        a.width(f * j.length)
                    }
                }(j, i.width()), null != d.start && g(d.start)
            })
    }
}(jQuery),
    function (a) {
        a.scrollTo = function (b, c) {
            return a('html,body').scrollTo(b, c)
        },
            a.fn.scrollTo = function (b, c) {
                return c = a.extend({
                    axis: 'y',
                    speed: 1
                }, c || {
                }),
                2 != c.axis.length && (c.queue = !1),
                c.queue && (c.speed = Math.ceil(c.speed / 2)),
                    this.each(function () {
                        function d(b, d) {
                            var j = 'x' == d ? 'Left' : 'Top',
                                k = j.toLowerCase(),
                                l = 'scroll' + j;
                            i[l] = f ? f[k] + (g.is('html,body') ? 0 : g[0][l] - g.offset() [k])  : h,
                            c.margin && 'object' == typeof h && (i[l] -= parseInt(a(h).css('margin' + j)) || 0),
                            !b && c.queue && (g[0][l] != i[l] && e(c.onAfterFirst), delete i[l])
                        }
                        function e(a) {
                            g.animate(i, c.speed, c.easing, a)
                        }
                        var f,
                            g = a(this),
                            h = b,
                            i = {
                            };
                        switch (typeof h) {
                            case 'string':
                                if (/^([+-]=)?\d+(px)?$/.test(h)) break;
                                h = a(h, this);
                            case 'object':
                                f = a(h).offset()
                        }
                        a.each(c.axis.split(''), d),
                            e(c.onAfter)
                    })
            }
    }(jQuery),
    function (a) {
        var b = a.browser.msie && a.browser.version < 8,
            c = 4;
        a.watermarker = function () {
        },
            a.extend(a.watermarker, {
                defaults: {
                    color: '#999',
                    left: 0,
                    top: 0,
                    fallback: !1,
                    animDuration: 300,
                    minOpacity: 0.6
                },
                setDefaults: function (b) {
                    a.extend(a.watermarker.defaults, b)
                },
                checkVal: function (b, c) {
                    return 0 == b.length ? a(c).show()  : a(c).hide(),
                    b.length > 0
                },
                html5_support: function () {
                    var a = document.createElement('input');
                    return 'placeholder' in a
                }
            }),
            a.fn.watermark = function (d, e) {
                var e,
                    f;
                return e = a.extend(a.watermarker.defaults, e),
                    f = this.filter('textarea, input:not(:checkbox,:radio,:file,:submit,:reset)'),
                    e.fallback && a.watermarker.html5_support() ? this : (f.each(function () {
                        var f,
                            g,
                            h,
                            i,
                            j,
                            k,
                            l = 0;
                        f = a(this),
                        'processed' != f.attr('data-jq-watermark') && (g = void 0 != f.attr('placeholder') && '' != f.attr('placeholder') ? 'placeholder' : 'title', h = void 0 === d || '' === d ? a(this).attr(g)  : d, i = a('<span class="watermark_container"></span>'), j = a('<span class="watermark">' + h + '</span>'), 'placeholder' == g && f.removeAttr('placeholder'), i.css({
                            display: 'inline-block',
                            position: 'relative'
                        }), 'true' == f.attr('data-percent-width') && i.css('width', '100%'), 'true' == f.attr('data-percent-height') && i.css('height', '100%'), b && i.css({
                            zoom: 1,
                            display: 'inline'
                        }), f.wrap(i).attr('data-jq-watermark', 'processed'), 'textarea' == this.nodeName.toLowerCase() ? (e_height = f.css('line-height'), e_height = 'normal' === e_height ? parseInt(f.css('font-size'))  : e_height, l = 'auto' != f.css('padding-top') ? parseInt(f.css('padding-top'))  : 0)  : (e_height = f.outerHeight(), 0 >= e_height && (e_height = 'auto' != f.css('padding-top') ? parseInt(f.css('padding-top'))  : 0, e_height += 'auto' != f.css('padding-bottom') ? parseInt(f.css('padding-bottom'))  : 0, e_height += 'auto' != f.css('height') ? parseInt(f.css('height'))  : 0)), l += 'auto' != f.css('margin-top') ? parseInt(f.css('margin-top'))  : 0, k = 'auto' != f.css('margin-left') ? parseInt(f.css('margin-left'))  : 0, k += 'auto' != f.css('padding-left') ? parseInt(f.css('padding-left'))  : 0, j.css({
                            position: 'absolute',
                            display: 'block',
                            fontFamily: f.css('font-family'),
                            fontSize: f.css('font-size'),
                            color: e.color,
                            left: c + e.left + k,
                            top: e.top + l,
                            height: e_height,
                            lineHeight: e_height + 'px',
                            textAlign: 'left',
                            pointerEvents: 'none'
                        }).data('jq_watermark_element', f), a.watermarker.checkVal(f.val(), j), j.click(function () {
                            a(a(this).data('jq_watermark_element')).trigger('click').trigger('focus')
                        }), f.before(j).bind('focus.jq_watermark', function () {
                            a.watermarker.checkVal(a(this).val(), j) || j.stop().fadeTo(e.animDuration, e.minOpacity)
                        }).bind('blur.jq_watermark change.jq_watermark', function () {
                            a.watermarker.checkVal(a(this).val(), j) || j.stop().fadeTo(e.animDuration, 1)
                        }).bind('keydown.jq_watermark, paste.jq_watermark', function () {
                            a(j).hide()
                        }).bind('keyup.jq_watermark', function () {
                            a.watermarker.checkVal(a(this).val(), j)
                        }))
                    }), this)
            },
            a(function () {
                a('.jq_watermark').watermark()
            })
    }(jQuery),
    function (a) {
        a.fn.free_shipping = function (b) {
            b = a.extend({
            }, a.fn.free_shipping.defaultOpts, b || {
            }),
                a(this).each(function () {
                    var c = a(this);
                    c.before('<div class="' + b.className + '">&nbsp;</div>'),
                    callback && callback.apply(this, b)
                })
        },
            a.fn.free_shipping.defaultOpts = {
                className: 'free_shipping_ico',
                callback: null
            },
            a(function () {
                a('#newdeal_deal_price').free_shipping()
            })
    }(jQuery),
    function () {
        'use strict';
        var a = {
            auto: !0,
            interval: 3000,
            duration: 600,
            index: !0,
            nav: !0,
            effects: 'fade',
            imglazyload: !1,
            easing: 'swing',
            init: null
        };
        ~navigator.userAgent.toLowerCase().indexOf('msie 6.0') && document.execCommand('BackgroundImageCache', !1, !0);
        var b = {
            switchHandle: function (a, c) {
                var d = a.effects,
                    e = !1,
                    f = 'number' == typeof c ? c : $(c).attr('data-index'),
                    g = b.patterns[d];
                void 0 === f && (e = ~c.className.indexOf('prev') ? !0 : !1),
                a.isAnim || g(a, f, e)
            },
            loadImg: function (a) {
                $('img', a).each(function () {
                    var a = $(this),
                        b = a.attr('data-lazysrc');
                    b && (this.src = b, a.removeAttr('data-lazysrc'))
                })
            },
            initIndex: function (a) {
                var c,
                    d,
                    e = 0,
                    f = '',
                    g = a.itemElem.length,
                    h = a.index;
                for ('expandSlideX' === a.effects && g--; g > e; e++) f += '<a href="#"' + (0 === e ? ' class="current"' : '') + (h ? '' : ' style="display:none"') + ' data-index="' + e + '">' + (e + 1) + '</a>';
                return c = $('<div class="sc_index">' + f + '</div>').appendTo(a.target).find('a'),
                h && c.bind('mouseover.switchable', function () {
                    var c = this;
                    d = setTimeout(function () {
                        b.switchHandle(a, c)
                    }, 200)
                }).bind('mouseout.switchable', function () {
                    clearTimeout(d),
                        d = null
                }).bind('click.switchable', function (a) {
                    a.preventDefault()
                }),
                    c
            },
            initNav: function (a) {
                var c,
                    d,
                    e = a.target;
                return a.nav ? (d = '<a href="#" class="sc_prev" style="display:none"></a><a href="#" class="sc_next" style="display:none"></a>', c = $(d).appendTo(e), e.bind('mouseenter.switchable', function () {
                    c.show()
                }).bind('mouseleave.switchable', function () {
                    c.hide()
                }))  : c = $('a.sc_prev,a.sc_next', e),
                    c.bind('click.switchable', function (c) {
                        b.switchHandle(a, this),
                            c.preventDefault()
                    }),
                    c
            },
            initLayout: function (a) {
                var b,
                    c,
                    d,
                    e = a.itemElem,
                    f = e.outerWidth(),
                    g = e.outerHeight(),
                    h = a.effects,
                    i = 'expandSlideX' === h,
                    j = '0px';
                return 2 === e.length && (h = a.effects = 'slideX', i = !1),
                    'slideX' === h || i ? (b = f, c = 'width', d = 'left')  : 'slideY' === h && (b = g, c = 'height', d = 'none'),
                i && (e.each(function (a) {
                    $(this).attr('data-index', a)
                }), a.index = !1),
                    a.containerElem.css({
                        overflow: 'hidden',
                        position: 'relative',
                        width: f + 'px',
                        height: g + 'px'
                    }),
                    e.css({
                        'float': d,
                        display: 'block'
                    }),
                i && (a.containerElem.css('overflow', 'visible'), a.listElem.prepend(e.last().clone()), j = 0 - b + 'px', e = a.itemElem = a.listElem.children('li')),
                    a.listElem.css(c, b * e.length + 'px').css({
                        position: 'absolute',
                        top: '0px',
                        left: j
                    }),
                    b
            },
            clear: function (a) {
                clearInterval(a.timer),
                    a.timer = null
            },
            autoRun: function (a) {
                a.timer = setInterval(function () {
                    b.patterns[a.effects](a, void 0, !1)
                }, a.interval)
            },
            addElems: function (a, b, c) {
                for (var d = a.size, e = a.listElem, f = parseInt(e.css('width')), g = parseInt(e.css('left')), h = b.length, i = 0; h > i; i++) e[c ? 'prepend' : 'append'](b[i]),
                    f += d,
                c && (g -= d),
                    e.css({
                        width: f + 'px',
                        left: g + 'px'
                    })
            },
            removeElems: function (a, b, c) {
                for (var d = a.size, e = a.listElem, f = parseInt(e.css('width')), g = parseInt(e.css('left')), h = b.length, i = 0; h > i; i++) f -= d,
                c || (g += d),
                    b[i].remove(),
                    e.css({
                        width: f + 'px',
                        left: g + 'px'
                    });
                h && (a.itemElem = e.children('li'))
            },
            refreshItem: function (a, c, d) {
                var e,
                    f,
                    g,
                    h,
                    i,
                    j = (a.size, a.itemElem),
                    k = a.indexElem,
                    l = (a.listElem, c),
                    m = j.length > k.length,
                    n = [
                    ],
                    o = [
                    ];
                return m ? (o.push(j[d ? 'last' : 'first']()), e = j.eq(d ? 0 : l + 1))  : e = j.eq(l),
                    f = parseInt(e.attr('data-index')),
                l !== f && (e = j.filter(function () {
                    var a = $(this).attr('data-index');
                    return a = + a,
                    a === l
                })),
                    g = e[d ? 'prev' : 'next'](),
                g.length || (h = j[d ? 'last' : 'first'](), m && (h = h[d ? 'prev' : 'next']()), i = h.clone(), n.push(i), o.push(h)),
                    b.addElems(a, n, d),
                    function () {
                        a.isAnim = !1,
                            b.removeElems(a, o, d),
                            a.target.trigger('likechange')
                    }
            },
            patterns: {
                fade: function (a, b, c) {
                    var d,
                        e,
                        f = a.itemElem,
                        g = a.indexElem,
                        h = g.filter('.current'),
                        i = parseInt(h.attr('data-index')),
                        j = f.length - 1;
                    i !== b && (void 0 === b && (b = c ? 0 === i ? j : i - 1 : i === j ? 0 : i + 1), d = f.eq(i), e = f.eq(b), e.css('display', 'block').trigger('loadimg').next().trigger('loadimg'), a.isAnim = !0, d.fadeOut(a.duration, function () {
                        a.isAnim = !1,
                            d.css('zIndex', '1'),
                            e.css('zIndex', '2'),
                            a.target.trigger('likechange')
                    }), g.eq(i).removeClass('current'), g.eq(b).addClass('current').trigger('likeinit'))
                }
            },
            init: function (a) {
                'fade' !== a.effects ? a.size = b.initLayout(a)  : a.itemElem.css({
                    position: 'absolute',
                    display: 'none',
                    zIndex: '1',
                    top: '0px',
                    left: '0px'
                }).eq(0).css({
                    display: 'block',
                    zIndex: '2'
                }),
                    a.indexElem = b.initIndex(a),
                    a.navElem = b.initNav(a),
                a.imglazyload && a.itemElem.slice(2).one('loadimg', function () {
                    b.loadImg(this)
                }),
                a.init && (a.init.call(target[0]), delete a.init),
                a.auto && (a.target.bind('mouseenter.switchable', function () {
                    b.clear(a)
                }).bind('mouseleave.switchableauto', function () {
                    b.autoRun(a)
                }), b.autoRun(a))
            }
        };
        $.each({
            slideX: [
                'left',
                'width'
            ],
            slideY: [
                'top',
                'height'
            ],
            expandSlideX: [
                'left',
                'width'
            ]
        }, function (a, c) {
            var d = c[0],
                e = c[1];
            b.patterns[a] = function (c, f, g) {
                var h,
                    i,
                    j,
                    k = c.itemElem,
                    l = c.listElem,
                    m = c.indexElem,
                    n = m.length - 1,
                    o = void 0 !== f,
                    p = m.filter('.current'),
                    q = parseInt(p.attr('data-index')),
                    r = c.size,
                    s = parseFloat(l.css(e)),
                    t = parseFloat(l.css(d)),
                    u = 1,
                    v = {
                    },
                    w = function () {
                        c.isAnim = !1,
                            c.target.trigger('likechange')
                    };
                f = + f,
                q !== f && (o ? f > q ? (g = !1, u = f - q)  : (g = !0, u = q - f)  : f = g ? 0 === q ? n : q - 1 : q === n ? 0 : q + 1, j = r * u, g ? ('expandSlideX' === a ? w = b.refreshItem(c, f, g)  : 0 === q && (h = k.last(), i = '-' + s + 'px', w = function () {
                    c.isAnim = !1,
                        l.css(d, '-' + (s - r) + 'px'),
                        h.css('position', '').css(d, ''),
                        c.target.trigger('likechange')
                }), t = parseFloat(l.css(d)), t += j)  : ('expandSlideX' === a ? w = b.refreshItem(c, f, g)  : q === n && (h = k.first(), i = s + 'px', w = function () {
                    c.isAnim = !1,
                        l.css(d, '0px'),
                        h.css('position', '').css(d, ''),
                        c.target.trigger('likechange')
                }), t = parseFloat(l.css(d)), t -= j), v[d] = t + 'px', h && h.css('position', 'relative').css(d, i), c.isAnim = !0, l.animate(v, c.duration, c.easing, w), k.eq(f).trigger('loadimg').next().trigger('loadimg'), m.eq(q).removeClass('current'), m.eq(f).addClass('current').trigger('likeinit'))
            }
        });
        var c = function (c, d) {
            if (c = $(c).eq(0), d = d || {
                }, c.length) {
                var e = $.extend({
                    }, a, d),
                    f = c.children('div.sc_container'),
                    g = f.children('ul'),
                    h = g.children('li');
                this.__o__ = e,
                h.length < 2 || ($.extend(e, {
                    target: c,
                    containerElem: f,
                    listElem: g,
                    itemElem: h,
                    indexElem: null,
                    navElem: null,
                    size: null,
                    timer: null,
                    isAnim: !1
                }), b.init(e))
            }
        };
        c.prototype = {
            destroy: function () {
                if (this.__o__) {
                    var a = this.__o__,
                        c = a.target;
                    a.auto && b.clear(a),
                        c.unbind('mouseenter.switchable').unbind('mouseleave.switchable').unbind('mouseleave.switchableauto').unbind('likechange'),
                    a.nav && a.navElem.remove(),
                    a.index && a.indexElem.remove(),
                    a.imglazyload && a.itemElem.slice(2).unbind('loadimg'),
                        this.__o__ = a = null,
                        delete this.__o__
                }
            },
            on: function (a, b) {
                if (!this.__o__) return this;
                var c = this,
                    d = c.__o__,
                    e = 'init' === a,
                    f = d.indexElem,
                    g = e ? f.not('.current')  : d.target,
                    h = e ? 'one' : 'bind';
                return g[h]('like' + a, function (e) {
                    e.index = parseInt(f.filter('.current').attr('data-index')),
                        e.target = d.itemElem[e.index],
                        e.type = a,
                        b.call(c, e),
                        e.stopPropagation()
                }),
                    this
            },
            un: function (a) {
                return this.__o__ && this.__o__.target.bind('like' + a),
                    this
            },
            change: function (a) {
                this.__o__ && b.switchHandle(this.__o__, + a)
            },
            pause: function () {
                var a = this.__o__;
                a && (b.clear(a), a.auto && a.target.unbind('mouseleave.switchableauto'))
            },
            play: function () {
                var a = this.__o__;
                a && (b.autoRun(a), a.auto && a.target.bind('mouseleave.switchableauto', function () {
                    b.autoRun(a)
                }))
            }
        },
            window.Ixy = window.Ixy || {
            },
            window.Ixy.ui = window.Ixy.ui || {
            },
            window.Ixy.ui.Switchable = c
    }(),
    function (a) {
        'function' == typeof define && define.amd ? define(['jquery'], a)  : a(jQuery)
    }(function (a) {
        !function () {
            var b = {
            };
            a.each(['Quad',
                'Cubic',
                'Quart',
                'Quint',
                'Expo'], function (a, c) {
                b[c] = function (b) {
                    return Math.pow(b, a + 2)
                }
            }),
                a.extend(b, {
                    Sine: function (a) {
                        return 1 - Math.cos(a * Math.PI / 2)
                    },
                    Circ: function (a) {
                        return 1 - Math.sqrt(1 - a * a)
                    },
                    Elastic: function (a) {
                        return 0 === a || 1 === a ? a : - Math.pow(2, 8 * (a - 1)) * Math.sin((80 * (a - 1) - 7.5) * Math.PI / 15)
                    },
                    Back: function (a) {
                        return a * a * (3 * a - 2)
                    },
                    Bounce: function (a) {
                        for (var b, c = 4; a < ((b = Math.pow(2, --c)) - 1) / 11; );
                        return 1 / Math.pow(4, 3 - c) - 7.5625 * Math.pow((3 * b - 2) / 22 - a, 2)
                    }
                }),
                a.each(b, function (b, c) {
                    a.easing['easeIn' + b] = c,
                        a.easing['easeOut' + b] = function (a) {
                            return 1 - c(1 - a)
                        },
                        a.easing['easeInOut' + b] = function (a) {
                            return 0.5 > a ? c(2 * a) / 2 : 1 - c( - 2 * a + 2) / 2
                        }
                })
        }(),
            a.effects
    });
function jsonpcallback() {
}
function searchCallback(a, b) {
    var c = $('#' + b),
        d = '',
        e = 0,
        f = !1;
    for (var g in a) {
        var h = a[g];
        e++;
        var i = '',
            j = h.q,
            k = '';
        parseInt(h.at) >= 0 && (i = '约' + h.at + '件'),
        void 0 != h.cn && (f || (d += '<div title="' + h.q + '" pos=' + e + ' class="' + k + '"><span>' + j + '</span><label>' + i + '</label></div>'), k = 'cat', j = '在<em>' + h.cn + '</em>分类中搜索', parseInt(h.ct) >= 0 && (i = '约' + h.ct + '件'), f = !0),
            d += '<div title="' + h.q + '" pos=' + e + ' class="' + k + '" cid="' + h.c_id + '"><span>' + j + '</span><label>' + i + '</label></div>'
    }
    e > 0 && c.html(d);
    var l = $('div', c);
    $('div.cat:last', c).css('border-bottom', 'solid 1px #ddd'),
        l.hover(function () {
            $(this).addClass('selected').siblings().removeClass('selected')
        }),
        l.bind('click', function () {
            var a = $(this).attr('title'),
                d = $(this).attr('cid');
            if ('undefined' != d && c.prev().find('[name=cat]').val(d), c.prev().find('[name=search]').val(a), '' == a) alert('搜索字数太少，会影响到搜索结果，重新填写一下吧');
            else {
                var e = 'foot_search_pop_div' == b ? 'btmlist' : 'toplist',
                    f = 'search_' + e + '_' + a + '_word_pos_' + $(this).attr('pos');
                c.prev().find('[name=from]').val(f),
                    c.prev().submit()
            }
        }),
        e > 0 ? c.addClass('search_result_pop').removeClass('search_result_pop_a')  : c.addClass('search_result_pop_a').removeClass('search_result_pop')
}
function mall_search_validate(a) {
    var b = a.search;
    if ('' == b.value) return alert('搜索字数太少，会影响到搜索结果，重新填写一下吧'),
        !1;
    var c = a.from;
    if ('' == c.value) {
        var d = 'top' == $(a).attr('pos') ? 'topbar' : 'btmbar';
        c.value = 'search_' + d + '_' + b.value + '_word_pos1'
    }
    $('<input type=\'hidden\' name=\'bid\' value=\'1\'></input>').appendTo('form#mall_search_form')
}
function get_default_word() {
}
function checkHover(a, b) {
    return 'mouseover' == getEvent(a).type ? !(contains(b, getEvent(a).relatedTarget || getEvent(a).fromElement) || (getEvent(a).relatedTarget || getEvent(a).fromElement) === b)  : !(contains(b, getEvent(a).relatedTarget || getEvent(a).toElement) || (getEvent(a).relatedTarget || getEvent(a).toElement) === b)
}
function contains(a, b) {
    return a.contains ? a != b && a.contains(b)  : !!(16 & a.compareDocumentPosition(b))
}
function getEvent(a) {
    return a || window.event
}
function getCur_location(a) {
    var b = $.cookie('default_site_25') || '',
        c = RM_SITE_MAIN_WEBBASEURL + 'i/ajax/getsite?callback=?';
    '' === b ? $.getJSON(c, function (c) {
        b = c.site,
            a(b)
    })  : a(b)
}
window.Ixy || (window.Ixy = new Object),
    window.debug = function (a) {
        window.console && window.console.log && window.console.log(a)
    },
    window.parseBool = function (a) {
        return 'true' == a || 1 == a ? !0 : 'false' == a || 0 == a ? !1 : void 0
    },
    jQuery.fn.hasAttr = function (a) {
        var b = jQuery(null).not(document);
        return this.each(function () {
            $(this).attr(a) && (b = b.add($(this)))
        }),
            b
    },
    jQuery.fn.bubbleSort = function (a) {
        for (var b, c = a.length, d = 0; c - 2 > d; d++) for (var e = c - 1; e >= 1; e--) a[e].val < a[e - 1].val && (b = a[e], a[e] = a[e - 1], a[e - 1] = b);
        return a
    },
    function (a) {
        var b,
            c = [
            ],
            d = !1,
            e = function (e) {
                c.push(e),
                d || (d = !0, a.getJSON('http://search.jumei.com/ajax_get_default_word?callback=?', {
                }, function (a) {
                    b = a.content;
                    for (var d = c.length, e = 0; d > e; e++) c[e](b)
                }))
            };
        a.fn.extend({
            JumeiSearch: function (c) {
                return this.each(function () {
                    var d,
                        f,
                        g = a(this),
                        h = a(this).parent().next(),
                        i = a(this).next(),
                        j = a(this).next().next(),
                        k = - 1,
                        l = null;
                    '' == g.val() && (b ? g.attr('default_val', b).val(b)  : e(function (a) {
                        g.attr('default_val', a).val(a)
                    })),
                        g.focus(function () {
                            g.val() == g.attr('default_val') && g.val(''),
                                setTimeout(function () {
                                    a.getJSON('http://search.jumei.com/ajax_get_assoc_word?search=' + encodeURI(g.val()) + '&container=' + c + '&callback=?', function () {
                                    })
                                }, 100),
                                g.addClass('focus')
                        }).keydown(function (b) {
                            if (9 == b.keyCode) return h.addClass('search_result_pop_a').removeClass('search_result_pop'),
                                !1;
                            f = a.trim(g.val());
                            var d = a('div', h),
                                e = '',
                                l = '',
                                m = '';
                            return 40 == b.keyCode && (k = k + 1 == d.length ? - 1 : k, k++, d.removeClass('selected').eq(k).addClass('selected'), d.length > 0 && (e = d.eq(k).attr('title'), g.val(e), d.eq(k).hasClass('cat') ? j.val(d.eq(k).attr('cid'))  : j.val(''), l = 'foot_search_pop_div' == c ? 'btmlist' : 'toplist', m = 'search_' + l + '_' + e + '_word_pos_' + d.eq(k).attr('pos'), i.val(m))),
                                38 == b.keyCode ? (k = 0 > k ? d.length - 1 : k, k--, d.removeClass('selected').eq(k).addClass('selected'), d.length > 0 && (e = d.eq(k).attr('title'), g.val(e), d.eq(k).hasClass('cat') ? j.val(d.eq(k).attr('cid'))  : j.val(''), l = 'foot_search_pop_div' == c ? 'btmlist' : 'toplist', m = 'search_' + l + '_' + e + '_word_pos_' + d.eq(k).attr('pos'), i.val(m)), !1)  : void 0
                        }).keyup(function (b) {
                            if (clearTimeout(l), 13 != b.keyCode && 37 != b.keyCode && 38 != b.keyCode && 39 != b.keyCode && 40 != b.keyCode && 9 != b.keyCode) {
                                d = a.trim(g.val()),
                                    d.substring(0, 1);
                                var e = !0;
                                e && (k = - 1, d = encodeURI(d), l = setTimeout(function () {
                                    a.getJSON('http://search.jumei.com/ajax_get_assoc_word?search=' + d + '&container=' + c + '&callback=?', function () {
                                    })
                                }, 100))
                            }
                        }).blur(function () {
                            '' == a(this).val() && '' != g.attr('default_val') && a(this).val(g.attr('default_val')),
                                k = - 1,
                                g.removeClass('focus')
                        }),
                        a('body').click(function () {
                            h.removeClass('search_result_pop').addClass('search_result_pop_a')
                        })
                })
            }
        })
    }(jQuery);
var global_cart_count = 0,
    cart_timer = [
    ],
    now_time,
    global_server_time = 0;
Ixy.Core = {
    global_ajax: !0,
    afterInitFunctions: [
    ],
    init: function () {
        Ixy.Core.getServerTime(),
        Ixy.Core.global_ajax && Ixy.Core.getCartData(),
            Ixy.Core.enableHeaderTitle(),
            Ixy.Core.enableMyJumeiNavigationMenu(),
            Ixy.Core.enableSidebar(),
            Ixy.Core.enableBookmark(),
            Ixy.Core.enableCopySharingToPasteboard(),
            Ixy.Core.imgSliders(),
        Ixy.Core.global_ajax && Ixy.Core.load_cart_items(),
            Ixy.Core.enablesSearch(),
            Ixy.Core.enableFooter(),
            Ixy.Core.detectDevice(),
            Ixy.Core.enableGAads(),
            Ixy.Core.enableGAVirtualPageViewTracking(),
            Ixy.Core.enableMembership(),
            Ixy.Core.enableNewHeader(),
            Ixy.Core.referer(),
            Ixy.Core.headCategory(),
            Ixy.Core.globalJump(),
            Ixy.Core.refererFix(),
            Ixy.Core.redEnvelop(),
            Ixy.Core.popsubAct(),
            Ixy.Core.searchAlink(),
            Ixy.Core.customerWake()
    },
    redEnvelop: function () {
        function a(a) {
            for (var a = a.toLowerCase(), b = 0; b < navigator.plugins.length; b++) if (navigator.plugins[b].name.toLowerCase().indexOf(a) > - 1) return !0;
            return !1
        }
        function b(a) {
            try {
                return new ActiveXObject(a),
                    !0
            } catch (b) {
                return !1
            }
        }
        function c(c) {
            var d = a(c);
            return d || (d = b('ShockwaveFlash.ShockwaveFlash')),
                d
        }
        function d() {
            $('.nUREClose').click(function () {
                $(this).parent().hide(),
                    $('.newUserShade').hide(),
                'email' == new_user_registerType_24 && (location.href = new_user_redirct_24 || '/')
            }),
                $('.nuPointer').click(function () {
                    $.getJSON(RM_SITE_MAIN_WEBBASEURL + 'i/ajax/new_user_cash_ticket?callback=?', {
                        type: 'r'
                    }),
                    'undefined' != typeof new_user_control_24 && '0' == M && (r = parseInt(getCookie('bubbleTime')), v = setInterval(k, 1000), document.cookie = 'isBubble=1;domain=' + s + ';path=/', document.cookie = 'bubbleTime=' + getCookie('bubbleTime') + ';domain=' + s + ';path=/', document.cookie = 'bubbleAmount=165;domain=' + s + ';path=/'),
                        $('.nuReceive').empty().html('<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" class="nuObject"><param name="movie" value="http://p0.jmstatic.com/templates/jumei/images/account/newUser/hide.swf"><param name="wmode" value="transparent"><param name="bgcolor" value="red"><embed src="http://p0.jmstatic.com/templates/jumei/images/account/newUser/hide.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" class="nuObject" wmode="transparent"></object>').show().parent().find('.nuReceive').fadeOut(500, function () {
                            $('.nugoShopping').fadeIn(100, function () {
                                $('.nuReceive').hide(),
                                    $('.nuNotice').text('去购物立享专属福利').fadeIn(),
                                    $('.nUREClose').click(function () {
                                        $(this).parent().hide(),
                                            $('.newUserShade').hide()
                                    })
                            }),
                                $('.nuPointer').hide()
                        }),
                        $('.nugoShopping,.nuNotice').click(function () {
                            'email' == new_user_registerType_24 ? location.href = new_user_redirct_24 || '/' : $('.newUserRedEnvelope,.newUserShade').hide()
                        })
                })
        }
        function e() {
            $.getJSON(RM_SITE_MAIN_WEBBASEURL + 'i/ajax/get_top15_info?callback=?', function (a) {
                var b = '',
                    c = '',
                    d = 1,
                    e = 1;
                N = a.length;
                for (var f = 0; N > f; ) 4 != d ? (b += '<li>' + a[f].replace('original', 'src') + '</li>', d++, f++)  : (d = 1, f += 3);
                for (var f = 3; N > f; ) 4 != e ? (c += '<li>' + a[f].replace('original', 'src') + '</li>', e++, f++)  : (e = 1, f += 3);
                $('.sell-list').html(b + c)
            })
        }
        function f(a) {
            var b = '<div class="proItem">';
            return b += '<div class="pic"><a href="' + a.url + '" target="_blank"><img src="' + a.img + '" alt=""></a></div>',
                b += '<div class="side_item">',
                b += '<p class="side_title"><a href="' + a.url + '" target="_blank">' + a.title + '</a></p>',
                b += '<p class="side_price"><em>¥' + a.discounted_price + '</em></p>',
                b += '</div>',
                b += '</div>'
        }
        function g(a) {
            var b = 1;
            O = a.length;
            for (var c = 0; O > c; c++) {
                var d = a[c];
                Q += f(d),
                    0 == b % 6 ? Q += '</li><li class="clearfix">' : c == O && (Q += '</li><li class="clearfix">'),
                    b++
            }
            Q = Q.substring(0, Q.length - 21),
                $('.broList').html(Q)
        }
        function h(a, b, c, d) {
            var e = 0,
                f = 240,
                g = 720 * Math.ceil(b / 6);
            a.css('width', g + 'px'),
                c.click(function () {
                    e++,
                        g > 3 * e * f ? a.animate({
                            'margin-left': - (3 * e * f) + 'px'
                        }, 400)  : e = Math.ceil(b / 6) - 1
                }),
                d.click(function () {
                    e--,
                        3 * e * f >= 0 ? a.animate({
                            'margin-left': - (3 * e * f) + 'px'
                        }, 400)  : e = 0
                })
        }
        function i(a, b) {
            a.click(function () {
                b.hide(),
                    $('.newUserShade').hide()
            })
        }
        function j() {
            clearInterval(u);
            var a = Math.floor(n / 3600),
                b = Math.floor(n % 3600 / 60),
                c = n % 3600 % 60;
            10 > a ? l.eq(0).text('0' + a)  : l.eq(0).text(a),
                10 > b ? l.eq(1).text('0' + b)  : l.eq(1).text(b),
                10 > c ? l.eq(2).text('0' + c)  : l.eq(2).text(c),
                n--,
            n > 0 && (u = setInterval(j, 1000))
        }
        function k() {
            clearInterval(v),
                document.cookie = 'bubbleTime=' + r + ';domain=' + s + ';path=/',
                o = Math.floor(r / 3600),
                p = Math.floor(r % 3600 / 60),
                q = r % 3600 % 60,
                10 > o ? m.eq(0).text('0' + o)  : m.eq(0).text(o),
                10 > p ? m.eq(1).text('0' + p)  : m.eq(1).text(p),
                10 > q ? m.eq(2).text('0' + q)  : m.eq(2).text(q),
                r--,
            r > 0 && (v = setInterval(k, 1000))
        }
        - 1 != location.href.indexOf('search.jumei.com') && $('.header_wide_lv1 .envelopeBubble').css({
            right: '280px',
            top: '32px',
            background: 'url(http://p0.jmstatic.com/templates/jumei/images/account/newUser/newuserretrimealert.png?v2) no-repeat',
            'z-index': '30'
        }),
        ( - 1 != location.href.indexOf('pop.jumei.com') || - 1 != location.href.indexOf('activity_guarantee')) && $('.header_wide_lv1 .envelopeBubble').css({
            right: '120px',
            top: '32px',
            background: 'url(http://p0.jmstatic.com/templates/jumei/images/account/newUser/newuserretrimealert2.png) no-repeat',
            'z-index': '30'
        });
        var l,
            m,
            n,
            o,
            p,
            q,
            r,
            s,
            t = getCookie('uid') || 0,
            u = null,
            v = null,
            w = parseInt(getCookie('register_time')) || 0,
            x = parseInt(getCookie('first_visit_time')) || 0,
            y = Math.ceil((new Date).getTime() / 1000),
            z = $('.answerCash .select_a'),
            A = $('.answerCash .select_b'),
            B = $('.shouquan'),
            C = $('.shouquan .cash_btn'),
            D = $('.cash_5'),
            E = $('.go_shopping'),
            F = $('.qi_wen .select_a'),
            G = $('.qi_wen .select_b'),
            H = $('.genuine'),
            I = $('.genuine .cash_10'),
            J = $('.qi_wenquan'),
            K = $('.xiang_quan'),
            L = ($('.two_seven2'), $('.two_seven3'), $('.newUserCash')),
            M = ($('.lastCash'), $('.se_shop'), getCookie('isBubble') || 0),
            N = (getCookie('bubbleTime') || 0, getCookie('bubbleAmount') || 0, 15),
            O = 10,
            P = window.location.hostname.split('.');
        P = P.slice( - 2),
            s = P.join('.'),
        - 1 != location.href.indexOf('search') && $('.header_wide_lv1 .envelopeBubble').css({
            right: '280px',
            top: '32px',
            background: 'url(http://p0.jmstatic.com/templates/jumei/images/account/newUser/newuserretrimealert.png?v2) no-repeat',
            'z-index': '30'
        }),
            c('Flash') ? $('.newUserRedEnvelope').show()  : ($('.newUserRedEnvelope').hide(), $('.newUserRedEnvelopeRes').show(), $('.nURECloseRes').click(function () {
                $(this).parent().hide(),
                    $('.newUserShade').css('display', 'none'),
                'email' == new_user_registerType_24 && (location.href = new_user_redirct_24 || '/')
            }), $('.nuReceiveRes').click(function () {
                $.getJSON(RM_SITE_MAIN_WEBBASEURL + 'i/ajax/new_user_cash_ticket?callback=?', {
                    type: 'r'
                }),
                'undefined' != typeof new_user_control_24 && '0' == M && (document.cookie = 'isBubble=1;domain=' + s + ';path=/', document.cookie = 'bubbleTime=' + getCookie('bubbleTime') + ';domain=' + s + ';path=/', document.cookie = 'bubbleAmount=165;domain=' + s + ';path=/'),
                    $('.nugoShoppingRes,.nuNoticeRes').css('display', 'block'),
                    $('.nuNoticeRes').css('z-index', '1000000'),
                    $('.nuNoticeRes').text('去购物立享专属福利').fadeIn(),
                    $('.nURECloseRes').click(function () {
                        $(this).parent().hide(),
                            $('.newUserShadeRes').hide()
                    })
            }), $('.nugoShoppingRes,.nuNoticeRes').click(function () {
                'email' == new_user_registerType_24 ? location.href = new_user_redirct_24 || '/' : $('.newUserRedEnvelopeRes,.newUserShade').hide()
            })),
            d();
        var Q = '<li class="clearfix">',
            R = {
                answerA: function (a, b, c, d) {
                    a.click(function () {
                        $.getJSON(RM_SITE_MAIN_WEBBASEURL + 'i/ajax/new_user_cash_ticket?callback=?', {
                            type: c
                        }, function (a) {
                            - 3 == a.errno && location.reload()
                        }),
                            a.parent().hide(),
                            b.show(),
                            document.cookie = 'bubbleAmount=' + d + ';domain=' + s + ';path=/'
                    })
                },
                answerB: function (a, b, c, d, e, f) {
                    a.click(function () {
                        console.log(f),
                            $.getJSON(RM_SITE_MAIN_WEBBASEURL + 'i/ajax/new_user_cash_ticket?callback=?', {
                                type: e
                            }, function (a) {
                                - 3 == a.errno && location.reload()
                            }),
                            a.parent().hide(),
                            b.show(),
                            document.cookie = 'bubbleAmount=' + f + ';domain=' + s + ';path=/'
                    }),
                        c.click(function () {
                            b.hide(),
                                d.show()
                        })
                }
            },
            S = $('.broList'),
            T = $('.browseHisBox .nuCashBangNext'),
            U = $('.browseHisBox .nuCashBangPrev'),
            V = $('.sell-list'),
            W = $('.nuCashBang7 .nuCashBangNext'),
            X = $('.nuCashBang7 .nuCashBangPrev');
        if (0 == w && !$.cookie('isTime8') && !$.cookie('isTime3') && y - x > 86400 && 604800 > y - x && ($('.lastCash,.newUserShade').show(), $('.lastCash').find('.seven_litle span').text('160'), $('.cash_buta').show(), $.getJSON(RM_SITE_MAIN_WEBBASEURL + 'i/ajax/get_new_pop?callback=?', function (a) {
                0 == a.type ? ($('.lastCash .nuCashBang7').show(), e(), h(V, N, W, X))  : 1 == a.type && ($('.lastCash .browseHisBox').show(), g(a.data), h(S, O, T, U));
                var b = new Date;
                b.setTime(1000 * (x + 777600)),
                    document.cookie = 'isTime8=7; expires=' + b.toGMTString() + '; path=/; domain=' + s
            }), $('.nuCashClose').click(function () {
                $(this).parent().hide(),
                    $('.newUserShade').hide()
            })), t && 777600 > y - w) {
            var Y = $('.item_ijumei').position().left + 76;
            $('.envelopeBubble').css('left', Y),
                $('.envelopeBubble').hover(function () {
                    $('.header_list_jumei').hide()
                }),
                $('.ebClose').click(function () {
                    $('.envelopeBubble,.ebtime').fadeOut(200),
                        document.cookie = 'isBubble=0;domain=' + s + ';path=/'
                }),
            'undefined' != typeof new_user_control_24 && '0' == M && $.getJSON(RM_SITE_MAIN_WEBBASEURL + 'i/ajax/get_air_bubble_status?callback=?', {
                control: new_user_control_24,
                action: new_user_action_24
            }, function (a) {
                '0' == a.errno ? (m = $('.ebtime span'), $('.ebbmont span').eq(1).text(a.amount), $('.envelopeBubble,.ebtime').show(), r = parseInt(a.time), v = setInterval(k, 1000), document.cookie = 'isBubble=1;domain=' + s + ';path=/', document.cookie = 'bubbleTime=' + a.time + ';domain=' + s + ';path=/', document.cookie = 'bubbleAmount=' + a.amount + ';domain=' + s + ';path=/')  : M = '0'
            }),
            '1' == M && (m = $('.ebtime span'), $('.ebbmont span').eq(1).text(getCookie('bubbleAmount')), $('.envelopeBubble,.ebtime').show(), r = parseInt(getCookie('bubbleTime')), v = setInterval(k, 1000)),
            'undefined' != typeof new_user_control_24 && (!$.cookie('isTime1') && y - w > 600 && 3000 > y - w && ($.getJSON(RM_SITE_MAIN_WEBBASEURL + 'i/ajax/get_float_status?callback=?', {
                control: new_user_control_24,
                action: new_user_action_24
            }, function (a) {
                if ('0' == a.errno && '0' == a.draw_type && '1' == a.float_type) {
                    e();
                    var b = 0,
                        c = 240,
                        d = 720 * Math.ceil(N / 6);
                    n = parseInt(a.time),
                        $('.sell-list').css('width', d + 'px'),
                        $('.newUserCash,.newUserShade,.nuCashBang').show(),
                        $('.newUserCash').css({
                            background: 'url(http://p0.jmstatic.com/templates/jumei/images/account/newUser/raider-bg.jpg) no-repeat'
                        }),
                        $('.nuCashBang .nuCashBangNext').click(function () {
                            b++,
                                d > 3 * b * c ? $('.sell-list').animate({
                                    'margin-left': - (3 * b * c) + 'px'
                                }, 400)  : b = Math.ceil(N / 6) - 1
                        }),
                        $('.nuCashBang .nuCashBangPrev').click(function () {
                            b--,
                                3 * b * c >= 0 ? $('.sell-list').animate({
                                    'margin-left': - (3 * b * c) + 'px'
                                }, 400)  : b = 0
                        })
                } else '0' == a.errno && 'r' == a.draw_type && ($('.newUserCash,.newUserShade').show(), $('.newUserCash').css({
                    background: 'url(http://p0.jmstatic.com/templates/jumei/images/account/newUser/raider-bg.jpg) no-repeat'
                }), $('.newUserCash,.answerCash').show(), R.answerA(z, D, 'r', '165'), R.answerB(A, B, C, D, 'r', '165'), i(E, L));
                var f = new Date;
                f.setTime(1000 * (w + 777600)),
                    document.cookie = 'isTime1=15; expires=' + f.toGMTString() + '; path=/; domain=' + s
            }), $('.nuCashClose').click(function () {
                $(this).parent().hide(),
                    $('.newUserShade').hide()
            })), !$.cookie('isTime2') && y - w > 3600 && 86400 > y - w && ($.getJSON(RM_SITE_MAIN_WEBBASEURL + 'i/ajax/get_float_status?callback=?', {
                control: new_user_control_24,
                action: new_user_action_24
            }, function (a) {
                n = parseInt(a.time),
                    l = $('.nuCashTime span'),
                    $('.nuCashTime').show(),
                    u = setInterval(j, 1000);
                var b = a.amount;
                '0' == a.errno && '0' == a.draw_type && '2' == a.float_type ? $.getJSON(RM_SITE_MAIN_WEBBASEURL + 'i/ajax/get_new_pop?callback=?', function (a) {
                    if (0 == a.type) {
                        e();
                        var c = 0,
                            d = 240,
                            f = 720 * Math.ceil(N / 6);
                        $('.sell-list').css('width', f + 'px'),
                            $('.nuCashNum').text(b),
                            $('.newUserCash,.newUserShade,.nuCashBang').show(),
                            $('.newUserCash').css({
                                background: 'url(http://p0.jmstatic.com/templates/jumei/images/account/newUser/jiaoyin1117.jpg) no-repeat'
                            }),
                            $('.nuCashBang .nuCashBangNext').click(function () {
                                c++,
                                    f > 3 * c * d ? $('.sell-list').animate({
                                        'margin-left': - (3 * c * d) + 'px'
                                    }, 400)  : c = Math.ceil(N / 6) - 1
                            }),
                            $('.nuCashBang .nuCashBangPrev').click(function () {
                                c--,
                                    3 * c * d >= 0 ? $('.sell-list').animate({
                                        'margin-left': - (3 * c * d) + 'px'
                                    }, 400)  : c = 0
                            })
                    } else 1 == a.type && ($('.nuCashNum').text(b), $('.newUserCash,.newUserShade').show(), $('.newUserCash').css({
                        background: 'url(http://p0.jmstatic.com/templates/jumei/images/account/newUser/jiaoyin1117.jpg) no-repeat'
                    }), $('.newUserCash .browseHisBox').show(), g(a.data), h(S, O, T, U))
                })  : '0' == a.errno && 'r_10' == a.draw_type && ($('.nuCashNum').text(b), $('.newUserCash,.newUserShade').show(), $('.newUserCash').css({
                    background: 'url(http://p0.jmstatic.com/templates/jumei/images/account/newUser/jiaoyin1117.jpg) no-repeat'
                }), $('.newUserCash,.qi_wen').show(), R.answerA(F, J, 'r_10', '170'), R.answerB(G, H, I, J, 'r_10', '170'), i(K, L));
                var c = new Date;
                c.setTime(1000 * (w + 777600)),
                    document.cookie = 'isTime2=24; expires=' + c.toGMTString() + '; path=/; domain=' + s
            }), $('.nuCashClose').click(function () {
                $(this).parent().hide(),
                    $('.newUserShade').hide()
            })), !$.cookie('isTime3') && y - w > 86400 && 604800 > y - w && $.getJSON(RM_SITE_MAIN_WEBBASEURL + 'i/ajax/get_without_order?callback=?', function (a) {
                if ('0' == a.errno) {
                    $('.lastCash,.newUserShade').show(),
                        $('.lastCash').find('.seven_litle span').text('165'),
                        $('.cash_but').show(),
                        $('.cash_but').one('click', function () {
                            $('.cash_but').text('领取成功'),
                                $('.receive_sucess').fadeIn(400),
                                $.getJSON(RM_SITE_MAIN_WEBBASEURL + 'i/ajax/new_user_cash_ticket?callback=?', {
                                    type: 'r_160'
                                }, function (a) {
                                    - 3 == a.errno ? location.reload()  : - 1 == a.errno ? $('.cash_but').text('网络忙，重新领')  : 0 == a.errno && (document.cookie = 'bubbleTime=86400;domain=' + s + ';path=/', document.cookie = 'bubbleAmount=165;domain=' + s + ';path=/')
                                })
                        }),
                        $('.nuCashClose').click(function () {
                            $(this).parent().hide(),
                                $('.newUserShade').hide()
                        }),
                        $.getJSON(RM_SITE_MAIN_WEBBASEURL + 'i/ajax/get_new_pop?callback=?', function (a) {
                            0 == a.type ? ($('.lastCash .nuCashBang7').show(), e(), h(V, N, W, X))  : 1 == a.type && ($('.lastCash .browseHisBox').show(), g(a.data), h(S, O, T, U))
                        });
                    var b = new Date;
                    b.setTime(1000 * (w + 777600)),
                        document.cookie = 'isTime3=7; expires=' + b.toGMTString() + '; path=/; domain=' + s
                }
            }))
        }
    },
    customerWake: function () {
        function a() {
            var a = $('.customer_yuan .user_head'),
                b = '';
            p && q ? (b += '<dt><img src="' + decodeURIComponent(p) + '" alt="" /></dt>', b += '<dd class="padtop">' + q + '</dd>', b += '<dd><span>用户ID：</span>' + o + '</dd>', a.append(b))  : $.getJSON('http://www.' + m + '/i/ajax/syncCookie?callback=?', function (c) {
                b += '<dt><img src="' + c.avatar_small + '" alt="" /></dt>',
                    b += '<dd class="padtop">' + c.nickname + '</dd>',
                    b += '<dd><span>用户ID：</span>' + c.uid + '</dd>',
                    a.append(b)
            })
        }
        function b(a) {
            for (var a = a.toLowerCase(), b = 0; b < navigator.plugins.length; b++) if (navigator.plugins[b].name.toLowerCase().indexOf(a) > - 1) return !0;
            return !1
        }
        function c(a) {
            try {
                return new ActiveXObject(a),
                    !0
            } catch (b) {
                return !1
            }
        }
        function d(a) {
            var d = b(a);
            return d || (d = c('ShockwaveFlash.ShockwaveFlash')),
                d
        }
        function e() {
            d('Flash') ? ($('.cutomer_flash_bg').show(400), $('.fPointer').click(function () {
                $.getJSON(RM_SITE_MAIN_WEBBASEURL + 'i/ajax/send_160_promo_card?callback=?', function (a) {
                    1 == a.errno && $('.f_receive').empty().html('<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" class="nuObject"><param name="movie" value="http://p0.jmstatic.com/templates/jumei/images/account/newUser/hide.swf"><param name="wmode" value="transparent"><param name="bgcolor" value="red"><embed src="http://p0.jmstatic.com/templates/jumei/images/account/newUser/hide.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" class="nuObject" wmode="transparent"></object>').show().parent().find('.f_receive').fadeOut(500, function () {
                        j.hide(400),
                            l.show(400)
                    })
                })
            }))  : ($('.cutomer_wuflash').show(400), $('.cutomer_wuflash .p_receive').click(function () {
                $.getJSON(RM_SITE_MAIN_WEBBASEURL + 'i/ajax/send_160_promo_card?callback=?', function (a) {
                    1 == a.errno && (j.hide(400), l.show(400))
                })
            }))
        }
        function f() {
            var a = ($('.customer_logo'), $('.customer_yuan')),
                b = $('.customer_yuan .user_wenzi');
            j = $('.customer_pop'),
                k = $('.customer_shade'),
                l = $('.customer_cash'),
                cZhenpin = $('.cutomer_zhen'),
                $('.customer_colsed').hide();
            var c = {
                    redYuan: 1,
                    brandZi: 2,
                    dialogTwo: 10,
                    dialogTwoZi: 11,
                    dialogThree: 23
                },
                d = 0,
                f = setInterval(function () {
                    d++,
                        d == c.redYuan ? a.fadeIn(600)  : d == c.brandZi ? b.fadeIn(600)  : d == c.dialogTwo ? ($('.customer_logo,.customer_yuan').hide(300), $('.cutomer_zhen').show(600))  : d == c.dialogTwoZi ? $('.zhenpin_title').slideDown()  : d == c.dialogThree && ($('.customer_colsed').show(), $('.customer_next2').hide(), $('.cutomer_zhen').hide(400), e(), clearInterval(f))
                }, 1000);
            l.click(function () {
                l.hide(),
                    k.hide(),
                    h('olduser'),
                    h('cash160')
            }),
                $('.customer_yuan .customer_next').click(function () {
                    $('.customer_logo,.customer_yuan').hide(300),
                        d = c.dialogTwo - 1,
                        cZhenpin.show(600)
                }),
                $('.customer_pop .cash_volume').click(function () {
                    d = c.dialogThree - 1,
                        $('.customer_logo,.customer_yuan').hide(300),
                        $('.cutomer_zhen').hide(300),
                        e()
                })
        }
        function g() {
            $('.customer_colsed').click(function () {
                j.hide(),
                    l.hide(),
                    k.hide(),
                    h('olduser'),
                    s = null
            })
        }
        function h(a) {
            $.cookie(a, '1', {
                expires: 100,
                path: '/',
                domain: m
            })
        }
        var i,
            j,
            k,
            l,
            m,
            n = '<div class="customer_shade">                    </div>                    <div class="customer_pop">                        <div class="customer_colsed"></div>                        <div class="customer_logo"></div>                        <div class="customer_yuan">                            <div class="customer_next"></div>                            <dl class="user_head clearfix">                            </dl>                            <div class="user_wenzi">                                <p>我们深知您希望看到更多正品低价的商品，</p>                                <p>在不断努力下，近期聚美又为您引进了</p>                                <p>伊丽莎白雅顿、茱莉蔻、DHC、玉兰油、欧莱雅、欧珀莱</p>                                <p>等几十家国际知名品牌。</p>                            </div>                            <div class="cash_volume"></div>                        </div>                        <div class="cutomer_zhen">                            <div class="zhenpin_title">                                <p>我们也深知您一直被化妆品验真问题困扰</p>                                <p>聚美配合百余家品牌官方推出了品牌真品防伪码</p>                                <p class="subtitle">只为让您享受到无忧、放心的美丽。</p>                            </div>                            <div class="cutomer_product">                                <div class="img1"></div>                                <div class="img2"></div>                            </div>                            <div class="cash_volume"></div>                        </div>                        <div class="cutomer_flash_bg">                            <div class="f_receive">                                <embed src="http://p0.jmstatic.com/templates/jumei/images/account/newUser/show.swf" quality="high" align="middle" allowScriptAccess="always" allowFullScreen="true" mode="transparent" type="application/x-shockwave-flash" class="nuObject" wmode="transparent"></embed>                            </div>                            <div class="fPointer"></div>                        </div>                        <div class="cutomer_wuflash">                            <div class="p_receive"></div>                        </div>                    </div>                    <div class="customer_cash">                    </div>',
            o = getCookie('uid') || 0,
            p = getCookie('avatar_small') || 0,
            q = getCookie('nickname') || 0,
            r = window.location.hostname.split('.');
        r = r.slice( - 2),
            m = r.join('.');
        var s = null;
        o && !$.cookie('olduser') && $.getJSON(RM_SITE_MAIN_WEBBASEURL + 'i/ajax/get_awakening_popping?callback=?', function (b) {
            1 == b.errno && (i = $('body'), i.append(n), a(), f(), g())
        })
    },
    searchAlink: function () {
        var a,
            b = window.location.hostname.split('.'),
            b = b.slice( - 2),
            a = b.join('.');
        $('.header_searchbox a,.top_search_hot a').each(function () {
            $(this).click(function (b) {
                var c = b || window.event;
                c.preventDefault(),
                    document.cookie = 'isSellCheck=0;domain=' + a + ';path=/',
                    window.open($(this).attr('href'))
            })
        }),
            $('#mall_search_form,.header_searchbox form').submit(function () {
                document.cookie = 'isSellCheck=0;domain=' + a + ';path=/'
            })
    },
    headCategory: function () {
        $('#Category').length > 0 && ($('#Category').hoverIntent({
            interval: 100,
            over: function () {
                $(this).addClass('hover'),
                    $('#angRate').addClass('upAng')
            },
            timeout: 600,
            out: function () {
                $(this).removeClass('hover'),
                    $('#angRate').removeClass(),
                    $('#header_Form_Search_top_div').attr('class', 'search_result_pop_a')
            }
        }), $('#headerFormSearch').JumeiSearch('header_Form_Search_top_div'))
    },
    referer: function () {
        var a = getUrlArgs('etc_n'),
            b = getUrlArgs('referer'),
            c = getUrlArgs('r'),
            d = getUrlArgs('referer_id'),
            e = '';
        '' != a && (e += '&etc_n=' + a),
        '' != b && (e += '&referer=' + b),
        '' != c && (e += '&r=' + c),
        '' != d && (e += '&referer_id=' + d),
        '' != e && $.getJSON('http://www.' + RM_SITE_MAIN_TOPLEVELDOMAINNAME + '/referer_site.php?callback=?' + e, {
        }, function () {
        })
    },
    getCartData: function () {
        cart_timer = $('.cart_left_time');
        var a = function (a, b) {
            var c,
                d,
                e,
                f,
                g,
                h,
                i;
            a = parseInt(1000 * a),
                d = a,
                d > 0 ? (c = parseInt(d / 86400000).toString(), c = c.length > 1 ? c : '0' + c, d %= 86400000, e = parseInt(d / 3600000).toString(), e = e.length > 1 ? e : '0' + e, d %= 3600000, f = parseInt(d / 60000).toString(), f = f.length > 1 ? f : '0' + f, g = parseInt(d % 60000 / 100), d = parseInt(g / 10), h = g - 10 * d, d = d.toString().length > 1 ? d : '0' + d, i = f + '分' + d + '.' + h + '秒', '.jmb-cart-bag .cart_left_time' == b.selector ? $(b).html('<span>' + i + '</span>内可结算')  : $(b).html('<span>' + i + '</span> 后购物车将被清空,请及时结算'))  : $(b).html('')
        };
        $.getJSON('http://cart.jumei.com/i/ajax/get_cart_data/?callback=?', {
            _ajax_: 1,
            which_cart: 'all'
        }, function (a) {
            if ('string' == typeof a) var a = $.parseJSON(a);
            global_cart_count = a.etime;
            var b = a.quantity;
            b > 0 && ($('.jmb-cart-bag').removeClass('empty'), $('#cart .num').html(b).show(), $('#nav_cart_num').html(b).show(), $('#jmb-cart-num').text(b).show()),
                void 0 === window.__initiBar__ ? (window.__cartNumber__ = b, window.__cartTime__ = global_cart_count)  : $('#iBar span.cart_num').text(b)
        }),
        cart_timer.length > 0 && setInterval(function () {
            var b = cart_timer.length;
            now_time = (new Date).getTime(),
                global_cart_count -= 0.1;
            for (var c = 0; b > c; c++) global_cart_count > 0 ? a(global_cart_count, cart_timer[c])  : '.jmb-cart-bag .cart_left_time' == cart_timer[c].selector ? $(cart_timer[c]).html('')  : $(cart_timer[c]).html('已超过购物车商品保留时间，请尽快结算。')
        }, 100)
    },
    jmCart: function () {
        var a = '<div id="jm-bottom-cart">                                    <div class="jm-bottom-cart">                                        <a class="jmb-cart-bag empty" target="_blank">                                            <span class="jmb-cart-num" id="jmb-cart-num">0</span>                                            <span class="jmb-cart-go-icon"></span>                                            <div class="cart_left_time"></div>                                        </a>                                        <div class="jmb-cart-empty box-shadow" id="jmb-cart-empty">                                        </div>                                        <div class="jmb-cart-content box-shadow">                                            <div class="jmb-cart-head">                                            <div class="cart_left_time"></div>                                            </div>                                            <div class="jmb-cart-center">                                            </div>                                            <div class="jmb-cart-bottom">                                                <span class="jmb-total-price"><em></em></span>                                                <a href="http://cart.jumei.com/i/cart/show?from=jumei_bottom_cart_button" target="_blank" title="去购物车结算" class="jmb-cart-toCart"></a>                                            </div>                                        </div>                                    </div>                                </div>',
            b = function () {
                $('body').append(a),
                    $('#jm-bottom-cart').fadeIn(400)
            };
        b();
        var c = $('#jm-bottom-cart'),
            d = (c.find('.jmb-cart-content'), c.find('.jmb-cart-center')),
            e = c.find('.jmb-cart-head'),
            f = c.find('.jmb-cart-bottom'),
            g = c.find('.jmb-total-price'),
            h = c.find('#jmb-cart-num'),
            i = c.find('.jmb-cart-bag'),
            j = c.find('.jmb-cart-empty'),
            k = $('.jmb-cart-bag .cart_left_time'),
            l = $('.jmb-cart-head .cart_left_time');
        cart_timer.push(k),
            cart_timer.push(l);
        var m = function () {
                $.getJSON('http://cart.jumei.com/i/ajax/get_cart_data/?callback=?', {
                    _ajax_: 1,
                    which_cart: 'all'
                }, function (a) {
                    if ('string' == typeof a) var a = $.parseJSON(a);
                    global_cart_count = a.etime;
                    var b = a.details,
                        c = a.quantity,
                        j = a.total_amount,
                        l = '';
                    h.text(c).show();
                    var m = 0,
                        n = 0;
                    for (var o in b) {
                        var p = b[o],
                            q = p.url,
                            r = p.image_60,
                            s = p.item_discount_price,
                            t = p.quantity,
                            u = (p.sku_no, p.deal_hash_id, p.short_name);
                        l += '<div class="jmb-cart-item"><div class="pic"><a href="' + q + '?from=jumei_bottom_cart_product_list' + '" target="_blank" title="' + u + '"><img src="' + r + '" alt="' + u + '"/></a></div>',
                            l += '<div class="name"><a href="' + q + '?from=jumei_bottom_cart_product_list' + '" target="_blank" alt="' + u + '" class="name" title="' + u + '">' + u + '</a></div>',
                            l += '<div class="price"><span>￥' + s + '</span><span class="price_plus"> x </span><span class="price_num">' + t + '</span></div></div></div>',
                            m += 80,
                            n += 1
                    }
                    d.html(l),
                        $('.jmb-cart-item a').click(function () {
                            _gaq.push('_trackEvent', 'jumei_bottom_cart_product_list', 'clicked')
                        }),
                    n >= 5 && (m = 400),
                        400 == m ? d.css('width', '286px')  : d.css('width', '280px'),
                        g.html('共计 <em>¥' + j + '</em>'),
                        d.animate({
                            height: m + 'px'
                        }, 300),
                        c > 0 ? (e.show(), f.show(), k.hide(), i.removeClass('empty'))  : i.addClass('empty')
                }),
                i.hasClass('empty') && j.html('<span class="empty-icon"></span>还没有商品，先去挑选商品吧!').animate({
                    bottom: '20px'
                }, 200, function () {
                })
            },
            n = function () {
                d.animate({
                    height: '0px'
                }, 300, function () {
                    d.html('')
                }),
                    e.hide(),
                    f.hide(),
                    k.show(),
                    j.html('').animate({
                        bottom: '0px'
                    }, 200, function () {
                    })
            };
        c.hoverIntent({
            interval: 100,
            over: m,
            timeout: 120,
            out: n
        }),
            i.click(function () {
                if (i.hasClass('empty')) return !1;
                _gaq.push('_trackEvent', 'jumei_bottom_cart_bar', 'clicked');
                var a = 'http://cart.jumei.com/i/cart/show?from=jumei_bottom_cart_bar';
                $(this).attr('href', a)
            }),
            $('.jmb-cart-toCart').click(function () {
                _gaq.push('_trackEvent', 'jumei_bottom_cart_button', 'clicked')
            })
    },
    jmAddButtomCart: function (a, b, c) {
        var d = $('<img class="jmb-cart-img" src="' + a + '"/ width="45" height="45">'),
            e = $('#jm-bottom-cart .jmb-cart-bag');
        e.removeClass('empty');
        var f = 0,
            g = 0;
        e && (g = e.offset().top - 80, f = e.offset().left + 20);
        var h = $('#jmb-cart-empty'),
            i = $('#jmb-cart-num'),
            j = b.pageX - 45,
            k = b.pageY - 45;
        d.css({
            top: k,
            left: j
        }).appendTo($('body')),
            d.animate({
                opacity: 1,
                top: k - 45
            }, 500).animate({
                top: g,
                left: f
            }, 600, function () {
                h.addClass('on').animate({
                    bottom: '8px'
                }, 100)
            }).animate({
                top: '+=80px',
                opacity: 0
            }, 500, function () {
                h.removeClass('on').animate({
                    bottom: '0'
                }, 100),
                    i.text(c).show(),
                    $(this).remove(),
                    global_cart_count = 1200
            })
    },
    GetProductImageBase: function (a, b) {
        var c = '000000000' + a;
        c = c.substring(c.length - 9);
        var d = new Array;
        d.push(c.substring(0, 3)),
            d.push(c.substring(3, 6));
        var e = d.join('/') + '/' + a + '_std/' + a + '_' + b + '_' + b + '.jpg';
        return e
    },
    GetPopImageBase: function (a) {
        var b = '000000000' + a;
        b = b.substring(b.length - 9);
        var c = new Array;
        c.push(b.substring(0, 3)),
            c.push(b.substring(3, 6));
        var d = c.join('/') + '/' + a + '_std/' + a + '_pop_300_400_3.jpg';
        return d
    },
    GetGridImg: function (a) {
        var a = a,
            b = new Array;
        b.push(a.substr(0, 1) + a.substr( - 1)),
            b.push(a.substr(1, 1) + a.substr( - 2, 1)),
            b.push(a);
        var c = 'deal_product/' + b.join('/') + '/' + a + '-grid.jpg';
        return c
    },
    enablesSearch: function () {
        $('#mall_search_input').JumeiSearch('top_search_pop_div'),
            $('#mall_search_input1').JumeiSearch('top_search_pop_div1')
    },
    enableHijacking: function () {
        top.location != location && (top.location.href = location.href + '?from=hijacking');
        var a = function () {
            var a = 'dMKAvkGl',
                b = !1,
                c = getCookie('bid');
            'file:' != location.protocol && ('string' != typeof c && b || 'string' == typeof c && c.substring(0, 8) != a) && (location.href += (/\?/.test(location.href) ? '&' : '?') + '_r=' + Math.random().toString(16).substring(2))
        };
        'undefined' != typeof getCookie && a();
        var b = document,
            c = b.write,
            d = {
                RM_SITE_MAIN_TOPLEVELDOMAINNAME: 1,
                'baidu.com': 1,
                'google.com': 1,
                'google-analytics.com': 1,
                'googleadservices.com': 1,
                'emarbox.com': 1,
                'jmstatic.com': 1,
                'tanx.com': 1,
                'g.doubleclick.net': 1
            },
            e = function (a, b) {
                _gaq.push(['_trackEvent',
                    'hijacking',
                    b,
                    a])
            },
            f = /<script.*?src\=["']?([^"'\s>]+)/gi,
            g = /(.+?)\.([^\/]+).+/;
        b.write = function (a) {
            try {
                for (var b, h = [
                ], i = [
                ]; b = f.exec(a); ) d[(g.exec(b) || []) [2]] ? h.push(b)  : i.push(b);
                i.length > 0 && e([i[0],
                    h[0] || ''].join('~_~'), location.href);
                try {
                    c.call(this, a)
                } catch (j) {
                    c(a)
                }
            } catch (j) {
                c(a),
                    e(j.name + ':' + j.message, location.href)
            }
        }
    },
    ga_event: function (a, b, c) {
        _gaq.push(['_trackEvent',
            a,
            b,
            c])
    },
    request_url: function (a) {
        var b,
            a = a,
            c = new Object;
        if ( - 1 != a.indexOf('?')) {
            var d = a.substr(a.indexOf('?') + 1, a.length - a.indexOf('?'));
            b = d.split('&');
            for (var e = 0; e < b.length; e++) c[b[e].split('=') [0]] = b[e].split('=') [1]
        }
        return c
    },
    afterInitCall: function (a) {
        Ixy.Core.afterInitFunctions.push(a)
    },
    enableCopySharingToPasteboard: function () {
        var a = $('#share-copy-button');
        a.length > 0 && a.click(function (a) {
            a.preventDefault();
            var b = $('#share-copy-text');
            if (b && b.length) try {
                var c = b[0].createTextRange();
                c.execCommand('Copy'),
                    alert('复制成功！')
            } catch (d) {
                alert('对不起，您的浏览器不支持复制按钮，请选择左边文字进行复制和粘贴。'),
                    b.select()
            }
        })
    },
    load_cart_items: function () {
        var a = $('#cart'),
            b = $('#cart_content');
        if (b.length < 1) return !1;
        a.click(function () {
            _gaq.push('_trackEvent', 'jumei_head_cart_bar', 'clicked')
        }),
            $('.cart_btn', a).click(function () {
                _gaq.push('_trackEvent', 'jumei_head_cart_button', 'clicked')
            });
        var c = b.find('span.num_all'),
            d = b.find('span.total_price'),
            e = b.find('div.cart_content_center'),
            f = $('#cart .num'),
            g = $('#nav_cart_num'),
            h = function (a) {
                0 == a ? ($('#cart_box').parent().hasClass('cart_box_flag') || f && f.hide(), g && g.hide())  : (f && f.show().html(a), g && g.show().html(a))
            },
            i = function () {
                function a(a, b) {
                    var c = a.url,
                        d = a.image_60,
                        e = a.item_discount_price,
                        f = a.quantity,
                        g = (a.sku_no, a.deal_hash_id, a.short_name),
                        h = '';
                    c += c.indexOf('?') > - 1 ? '&from=home_cart_float' : '?from=home_cart_float',
                        h += '<div class="cart_con_over cart_con_single"><div class="single_pic"><a href="' + c + '" target="_blank" alt="' + g + '"><img src="' + d + '" /></a></div>',
                        h += '<div class="single_info"><a href="' + c + '" target="_blank" alt="' + g + '" class="name">' + g + '</a>',
                        h += '<span class="price">￥' + e + '</span><span class="price_plus"> x </span><span class="price_num">' + f + '</span></div></div>',
                        b.append(h)
                }
                function f(a, b) {
                    for (var c = 0, d = '<div class=\'cart_con_over cart_con_group\'>', e = a.sub_items; c < e.length; c++) {
                        var f = e[c],
                            g = f.url,
                            h = f.image_60,
                            i = (f.item_discount_price, f.quantity),
                            j = f.short_name;
                        g += g.indexOf('?') > - 1 ? '&from=home_cart_float' : '?from=home_cart_float',
                            d += '<div class="cart_con_single"><div class="single_pic"><a href="' + g + '" target="_blank" alt="' + j + '"><img src="' + h + '" /></a></div>',
                            d += '<div class="single_info"><a href="' + g + '" target="_blank" alt="' + j + '" class="name">' + j + '<em>x' + i + '</em></a></div></div>'
                    }
                    var k = '<div class=\'group_count\'><span>组合购买价 </span><span class=\'group_count_price\'><em>¥' + a.item_price + '</em>x' + a.quantity + '</span>' + '</div></div>';
                    d += k,
                        b.append(d)
                }
                $.getJSON('http://cart.jumei.com/i/ajax/get_cart_data/?callback=?', {
                    _ajax_: 1,
                    which_cart: 'all'
                }, function (g) {
                    if ('string' == typeof g) var g = $.parseJSON(g);
                    global_cart_count = g.etime;
                    var j = g.details,
                        k = g.quantity,
                        l = g.total_amount;
                    if (h(k), 0 == k) return b.find('div.cart_content_null').show(),
                        b.find('div.cart_content_all').hide(),
                        h(0),
                        !1;
                    c.html(k),
                        d.html(l),
                        e.empty();
                    for (var m in j) j[m].is_cb ? '1' == j[m].is_cb && f(j[m], e)  : a(j[m], e);
                    b.find('div.cart_content_null').hide(),
                        $('div.cart_con_single a').click(function () {
                            _gaq.push('_trackEvent', 'jumei_head_cart_product_list', 'clicked')
                        }),
                        e.find('div.cart_con_single').each(function () {
                            var a = $(this),
                                b = a.find('a.delete');
                            b.click(function (a) {
                                a.preventDefault();
                                var b = $(this).attr('item_key');
                                $.getJSON('http://cart.' + RM_SITE_MAIN_TOPLEVELDOMAINNAME + '/i/cart/ajax_update_cart?callback=?', {
                                    _ajax_: 1,
                                    item_key: b,
                                    item_quantity: 0
                                }, function (a) {
                                    a && 'success' == a.status && i()
                                })
                            })
                        }),
                        b.find('div.cart_content_all').show()
                })
            };
        a.hover(function () {
            _gaq.push(['_trackEvent',
                'load_cart',
                'ajax_load_cart',
                RM_CONTROL]),
                i(),
                b.show(),
                b.hover(function () {
                    $(this).show(),
                        $(this).find('.cart_con_over').hover(function () {
                            $(this).addClass('single_hover')
                        }, function () {
                            $(this).removeClass('single_hover')
                        })
                }, function () {
                    $(this).hide()
                })
        }, function () {
            b.hide()
        }),
            $('#cart_box').hover(function () {
                $(this).addClass('car-current')
            }, function () {
                $(this).removeClass('car-current')
            })
    },
    clearAdhocNotification: function (a, b) {
        b ? a.find('.notification_center').remove()  : a.children('.notification_center').remove()
    },
    postAdhocNotification: function (a, b, c, d, e) {
        var f = d.message,
            g = d.type || 'information',
            e = void 0 != e ? e : !1,
            b = void 0 != b ? b : !0,
            c = void 0 != c ? c : 'append',
            d = $('<div class=\'notification_center\'><div class=\'message\'></div><div class=\'clear\'></div></div>');
        $(d).find('.message').html(f),
            'success' == g ? $(d).addClass('success_notification')  : 'error' == g ? $(d).addClass('error_notification')  : 'warning' == g ? $(d).addClass('warning_notification')  : 'information' == g && $(d).addClass('information_notification'),
            'prepend' == c ? (a.children('.notification_center').remove(), a.prepend(d))  : 'append' == c ? (a.children('.notification_center').remove(), a.append(d))  : 'before' == c ? (a.siblings('.notification_center').remove(), a.before(d))  : 'after' == c && (a.siblings('.notification_center').remove(), a.after(d)),
        e && $(window).scrollTop($(d).offset().top - 50),
        b && $(d).oneTime(1000, function () {
            $(d).remove()
        })
    },
    jsonToString: function (a) {
        var b = this;
        switch (typeof a) {
            case 'string':
                return '"' + a.replace(/(["\\])/g, '\\$1') + '"';
            case 'array':
                return '[' + a.map(b.jsonToString).join(',') + ']';
            case 'object':
                if (a instanceof Array) {
                    for (var c = [
                    ], d = a.length, e = 0; d > e; e++) c.push(b.jsonToString(a[e]));
                    return '[' + c.join(',') + ']'
                }
                if (null == a) return 'null';
                var f = [
                ];
                for (var g in a) f.push(b.jsonToString(g) + ':' + b.jsonToString(a[g]));
                return String.fromCharCode(123) + f.join(',') + String.fromCharCode(125);
            case 'number':
                return a;
            case !1:
                return a
        }
    },
    submitForm: function (a, b, c) {
        for (var a = $(a); a.size() && !a.is('form'); ) a = a.parent();
        if (a.is('form')) {
            if (c && !c(a)) return;
            if (b) for (var d in b) {
                var e = $('[name=' + d + ']', a);
                e.size() || (e = $('<input type=\'hidden\' name=\'' + d + '\' />').appendTo(a)),
                    e.val(b[d])
            }
            return a.submit(),
                !0
        }
    },
    copyToClipboard: function (a) {
        void 0 != window.clipboardData ? (window.clipboardData.setData('Text', $(a).val()), Ixy.Core.postAdhocNotification($('#view_url'), !0, 'append', {
            type: 'success',
            isAttached: !0,
            message: '分享链接已经拷贝到剪贴板中，您可以在其他网站中粘贴此链接'
        }))  : (Ixy.Core.postAdhocNotification($('#view_url'), !0, 'append', {
            type: 'success',
            isAttached: !0,
            message: '您可以把选中的链接内容拷贝粘贴到想分享的网站中'
        }), a.focus(), a.select())
    },
    lightbox: {
        popBox: '<div id="lightbox"><iframe id="lightbox_pal"></iframe></div>',
        init: function (a) {
            return $(Ixy.Core.lightbox.popBox).appendTo('body'),
                a.obj ? (a.obj.appendTo($('#lightbox')), Ixy.Core.lightbox.fx(a))  : a.url ? (a.url = a.url + '&nocache' + Math.random(), $('#lightbox').load(a.url, function () {
                    Ixy.Core.lightbox.fx(a),
                        a.callback ? a.callback()  : function () {
                            return !0
                        }
                }))  : ($(Ixy.Core.lightbox[a.type](a.msg, a.state)).appendTo($('#lightbox')), Ixy.Core.lightbox.fx(a)),
                !1
        },
        fx: function (a) {
            a.shadow && !$('#lightbox_shadow') [0] && $('body').append('<div id="lightbox_shadow"><iframe frameborder="0"></iframe></div>'),
            $('#lightbox_shadow') [0] && $('#lightbox_shadow').height($('body').outerHeight() > $(window).height() ? $('body').outerHeight()  : $(window).height()).find('iframe').height($('#lightbox_shadow').height());
            var b = $('#lightbox');
            b.css({
                left: '50%',
                margin: '-' + b.height() / 2 + 'px 0 0 -' + b.width() / 2 + 'px'
            }),
            a.sTop && b.css({
                top: a.sTop + 'px',
                marginTop: '0px'
            }),
            window.XMLHttpRequest || (function (b) {
                $(window).scroll(function () {
                    b.css({
                        marginTop: 0,
                        top: (a.sTop ? a.sTop : ($(window).height() - b.height()) / 2 - 0) - 0 + $(window).scrollTop() + 'px'
                    })
                })
            }(b), $(window).scroll()),
                $('#lightbox_pal').css({
                    height: b.height(),
                    width: b.width()
                }),
                window.onresize = function (a) {
                    return function () {
                        Ixy.Core.lightbox.fx(a)
                    }
                }(a),
                b = null
        },
        quit: function () {
            var a = arguments;
            return window.onresize = null,
                $('#lightbox').fadeOut('fast', function () {
                    $('#lightbox').remove(),
                    (0 == a.length || 'function' == typeof a[0] && !a[1] || 0 == a.length) && $('#lightbox_shadow').remove(),
                    'function' == typeof a[0] && a[0](),
                        a = null
                }),
                !1
        }
    },
    enableGAVirtualPageViewTracking: function () {
        with (window) if ('undefined' != typeof window.RM_VIRTUAL && RM_VIRTUAL.length > 0) {
            var i;
            for (i = 0; i < RM_VIRTUAL.length; i++) _gaq.push(['_trackPageview',
                RM_VIRTUAL[i] + '.virtual'])
        }
    },
    enableWaitingPay: function () {
        function a(a, b, c) {
            var d = $('#home_notice'),
                e = RM_UID,
                b = b,
                f = $.cookie('hn' + e) || '',
                g = $.cookie('f_o_p_c'),
                h = '',
                c = c,
                i = $.cookie('newuser');
            return i && ($.colorbox({
                html: '<div class="newuser_tip"><a href="http://www.jumei.com/i/membership/show_promocards?from=home_index_top_tips_promocards" target="_blank" class="newuser_btn"></a></div>',
                overlayClose: !1,
                onLoad: function () {
                    $('#cboxContent').addClass('nweuser_cbx'),
                        $('.nweuser_cbx #cboxClose').click(function () {
                            $.cookie('newuser', null, {
                                expires: 0,
                                path: '/',
                                domain: RM_SITE_MAIN_TOPLEVELDOMAINNAME
                            })
                        })
                },
                onClosed: function () {
                    $('#cboxContent').removeClass('nweuser_cbx')
                }
            }), $('.newuser_btn').click(function () {
                $.cookie('newuser', null, {
                    expires: 0,
                    path: '/',
                    domain: RM_SITE_MAIN_TOPLEVELDOMAINNAME
                })
            })),
            c && (h += '<div id="modify_password" name="mp" class="box_yellow">您的登录密码可能存在安全隐患，小美强烈建议您立即                <a href="/i/account/password" target="_blank" style="margin-left:10px;">更换密码&rsaquo;&rsaquo;</a>                                    <div class="close J_Close"><img src="http://p0.jmstatic.com/templates/jumei/images/waiting_pay_close.jpg" alt=""></div>                              </div>'),
                a ? (d.append(h), $('.J_Close,a', d).bind('click', function () {
                    var a = $(this).parent().next();
                    return c && $.ajax({
                        url: '/i/ajax/hide_dangerous_tips',
                        success: function () {
                            a.length ? $(this).parent().fadeOut(400, function () {
                                a.fadeIn(600)
                            })  : $(this).parent().fadeTo(400, 0, function () {
                                $(this).slideUp(400)
                            })
                        }
                    }),
                        a.length ? $(this).parent().fadeOut(400, function () {
                            a.fadeIn(600)
                        })  : $(this).parent().fadeTo(400, 0, function () {
                            $(this).slideUp(400)
                        }),
                        !1
                }), $(':first', d).slideDown(), void 0)  : ('1' == g && (h += '<div id="coupon_tips" name="f_o_p_c" class="box_yellow">欢迎来到聚美的大家庭！小美特地奉上50元优惠券大礼包！（今晚24点激活后可以使用）                <a href="/i/membership/show_promocards" target="_blank" style="margin-left:10px;">点击查看&rsaquo;&rsaquo;</a>                                    <div class="close J_Close"><img src="http://p0.jmstatic.com/templates/jumei/images/waiting_pay_close.jpg" alt=""></div>                              </div>'), - 1 == f.indexOf('mb') && 0 == b.is_bind && (h += '<div id="mobile_bind" name="mb" class="box_yellow">                        您尚未绑定手机号，为保障账户及资金安全，请您尽快绑定                        <a href="/i/account/mobile_bind?from=home_banner" target="_blank" style="margin-left:10px;">立即绑定&rsaquo;&rsaquo;</a>                        <div class="close J_Close"><img src="http://p0.jmstatic.com/templates/jumei/images/waiting_pay_close.jpg" alt=""></div>                  </div>'), - 1 == f.indexOf('wp') && b.new_order_number > 0 && (h += '<div id="waiting_pay" name="wp" class="box_yellow J_WaitingPay">                                    您有' + b.new_order_number + '个订单等待支付，                                    <a href="http://www.jumei.com/i/order/list?from=home_banner" target="_blank">点击此处付款</a>。商品被抢光后未支付的订单将被取消。                                    <div class="close J_Close"><img src="http://p0.jmstatic.com/templates/jumei/images/waiting_pay_close.jpg" alt=""></div>                              </div>'), - 1 == f.indexOf('sn') && b.subscribe_already_sale_number > 0 && (h += '<div id="sale_notice" name="sn" class="box_yellow">                                您订阅的' + b.subscribe_already_sale_product_ids[0].short_name + '等商品今天开售,赶紧抢购吧!                                <a href="http://www.jumei.com/i/deal/' + b.subscribe_already_sale_product_ids[0].hash_id + '.html">点击查看</a>                               <div class="close J_Close"><img src="http://p0.jmstatic.com/templates/jumei/images/waiting_pay_close.jpg" alt=""></div>                             </div>'), - 1 == f.indexOf('ce') && b.promo_card_number > 0 && (h += '<div id="cash_expired" name="ce" class="box_yellow">                                您有' + b.promo_card_number + '张现金券（总价值' + b.promo_card_amount + '元）即将过期，请及时使用！<a href="http://www.jumei.com/i/membership/show_promocards?from=home_index_top_tips_promocards">点击此处查看</a>                                <div class="close J_Close"><img src="http://p0.jmstatic.com/templates/jumei/images/waiting_pay_close.jpg" alt=""></div>                             </div>'), '' != h && (d.append(h), $('.J_Close,a', d).bind('click', function () {
                    var a = $(this).parent().next(),
                        b = $(this).parent().attr('name'),
                        d = $.cookie('hn' + e) || '',
                        f = d + b;
                    return c && $(this).hasClass('J_Close') && $.ajax({
                        url: '/i/ajax/hide_dangerous_tips',
                        success: function () {
                            a.length ? $(this).parent().fadeOut(400, function () {
                                a.fadeIn(600)
                            })  : $(this).parent().fadeTo(400, 0, function () {
                                $(this).slideUp(400)
                            })
                        }
                    }),
                        'coupon_tips' == $(this).parent().attr('id') ? $.cookie('f_o_p_c', '2')  : $.cookie('hn' + e, f, {
                            expires: 1,
                            path: '/',
                            domain: RM_SITE_MAIN_TOPLEVELDOMAINNAME
                        }),
                        a.length ? $(this).parent().fadeOut(400, function () {
                            a.fadeIn(600)
                        })  : $(this).parent().fadeTo(400, 0, function () {
                            $(this).slideUp(400)
                        }),
                    $(this).attr('href') && window.open($(this).attr('href')),
                        !1
                }), $(':first', d).slideDown()), void 0)
        }
        function b(a) {
            var b = $('#header_notice'),
                c = RM_UID,
                a = a,
                d = $.cookie('on' + c) || '',
                e = $.cookie('f_o_p_c'),
                f = '',
                g = '';
            - 1 == d.indexOf('wp') && a.new_order_number > 0 && (f += '<p name="wp">您有<span class="nums">' + a.new_order_number + '</span>笔订单未支付！<a href="http://www.jumei.com/i/order/list?from=home_index_top_suspension_nopayment" target="_blank">立即支付</a></p>'),
            ('Account' == RM_CONTROL || 'Order' == RM_CONTROL) && $.ajax({
                url: '/i/account/ajax_is_mobile_bind?uid=' + c,
                success: function (a) {
                    var a = $.parseJSON(a);
                    null != a && ('1' == e && (g += '<div id="coupon_tips" name="f_o_p_c" class="box_yellow" style="margin-bottom: 20px;">欢迎来到聚美的大家庭！小美特地奉上50元优惠券大礼包！（今晚24点激活后可以使用）                                        <a href="/i/membership/show_promocards" target="_blank" style="margin-left:10px;">点击查看&rsaquo;&rsaquo;</a>                                        <div class="close J_Close"><img src="/templates/jumei/images/waiting_pay_close.jpg" alt=""></div>                                  </div>'), 0 == a.is_bind && (g += '<div id="mobile_bind" name="mb" class="box_yellow" style="margin-bottom: 20px;display: none;">                                您尚未绑定手机号，为保障账户及资金安全，请您尽快绑定                                <a href="/i/account/mobile_bind?from=home_banner" target="_blank" style="margin-left:10px;">立即绑定&rsaquo;&rsaquo;</a>                                <div class="close J_Close"><img src="/templates/jumei/images/waiting_pay_close.jpg" alt=""></div>                             </div>', $('#main').before(g), $('div.box_yellow .J_Close').click(function () {
                        $(this).parent().hide(),
                        'coupon_tips' == $(this).parent().attr('id') && ($('#mobile_bind').show(), $.cookie('f_o_p_c', '2', {
                            expires: 1,
                            path: '/',
                            domain: RM_SITE_MAIN_TOPLEVELDOMAINNAME
                        }))
                    })))
                }
            }),
            '' != f && ($('.cntBox', b).append(f), $('.cntBox a', b).bind('click', function () {
                var b = $(this).parent().attr('name'),
                    d = $.cookie('on' + c) || '',
                    e = d + b;
                return $.cookie('on' + c, e, {
                    expires: 1,
                    path: '/',
                    domain: RM_SITE_MAIN_TOPLEVELDOMAINNAME
                }),
                $(this).parent().siblings().length && $(this).parent().remove() || a.fadeOut(400),
                    window.open($(this).attr('href')),
                    !1
            }), $('.close-ico', b).bind('click', function () {
                return b.fadeOut(400),
                    $.cookie('f_o_p_c', '2', {
                        expires: 1,
                        path: '/',
                        domain: RM_SITE_MAIN_TOPLEVELDOMAINNAME
                    }),
                    $.cookie('on' + c, 'wpcesn', {
                        expires: 1,
                        path: '/',
                        domain: RM_SITE_MAIN_TOPLEVELDOMAINNAME
                    }),
                    !1
            }), b.fadeIn(600))
        }
        var c = $.cookie('uid'),
            d = !1,
            e = $.cookie('HIDE_DANGEROUS_TIPS') || !1;
        e || $.getJSON(RM_SITE_MAIN_WEBBASEURL + 'i/ajax/is_dangerous_user?callback=?', null, function (a) {
            var a = $.parseJSON(a);
            'DANGEROUS' == a.status && (d = !0)
        }),
            $.getJSON(RM_SITE_MAIN_WEBBASEURL + 'i/account/ajax_user_notice_message?callback=?', null, function (e) {
                var f;
                f = e,
                'Home' == RM_CONTROL && c && a(!1, f, d) || 'Cart' != RM_CONTROL && 'Home' != RM_CONTROL && c && b(f) || 'Deal' == RM_CONTROL && c && a(!0, f, d)
            })
    },
    enableFooter: function () {
        var a,
            b,
            c = $('#footer_container'),
            d = $('#footer_textarea'),
            e = c.find('textarea').val(),
            f = $(window),
            g = 'Home' == RM_CONTROL ? !0 : !1,
            h = !1,
            i = !1;
        g && (a = $('#home_main_bottom'), b = a.find('textarea').val());
        var j = function () {
            var j = f.scrollTop(),
                k = j + f.height(),
                l = c.offset().top;
            if (g && a.length) {
                var m = a.offset().top;
                k + 500 > m && !h && (a.html(b), h = !0)
            }
            if (k + 500 > l && !i && (d.html(e), i = !0, $('.footer_friend_link').length > 0)) {
                var n = $('.footer_friend_link').clone();
                $('#footer').append(n),
                    $('.footer_friend_link').first().remove();
                var o = $('#footer_firend_ul'),
                    p = o.find('li').height(),
                    q = o.find('li').length;
                o.height(p * q);
                var r = 1;
                q > 1 && o.everyTime(5000, 'footer_firend_ul', function () {
                    o.animate({
                        'margin-top': '-' + p * r
                    }, 'fast'),
                        r == q - 1 ? r = 0 : r++
                })
            }
        };
        f.scroll(function () {
            j()
        })
    },
    detectDevice: function () {
        var a = navigator.userAgent.toLowerCase();
        if ('ipad' == a.match(/iPad/i)) {
            var b = '';
            b += '<div class="ipad_box" id="ipad_box"><div class="ipad_main">',
                b += '<a href="javascript:;" class="ipad_close" id="ipad_close"><img src="http://images.jumei.com/activity/ipad_pic/ipad_close.jpg" /></a>',
                b += '<div class="ipad_content"><div class="ipad_first"><span class="ipad_txt">推荐使用<span style="color:#ed145b;">聚美iPad客户端</span></span>',
                b += '<a href="https://itunes.apple.com/cn/app/ju-mei-you-pin-hd/id592077507?mt=8" target="_blank" class="ipad_btn"><img src="http://images.jumei.com/activity/ipad_pic/ipad_btn.jpg"/></a>',
                b += '</div><div class="ipad_notice"><span>大屏浏览，畅爽体验</span><span class="line">|</span><span>超多客户端独享优惠</span><span class="line">|</span><span>随时掌握订单状态</span>',
                b += '</div></div></div></div>',
                $('body').prepend(b),
                $('#ipad_close').click(function () {
                    $('#ipad_box').animate({
                        height: '0'
                    }, 500)
                })
        }
    },
    imgSliders: function () {
        var a = $('.img_slider', 'body');
        a.length > 0 && a.each(function (a) {
            var b = $(this),
                c = b.parent(),
                d = 'img_slider_' + a;
            c.attr('id', d),
                new HtmlSlidePlayer('#' + d, {
                    autosize: 0,
                    fontsize: 12,
                    time: 5000
                })
        })
    },
    enableGAads: function () {
        var a = $('<div style="display:inline;visibility: hidden;"><img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/991625942/?label=AbcyCJKGhwIQ1oXs2AM&amp;guid=ON&amp;script=0"/></div>');
        $(a).appendTo('body')
    },
    enableMembership: function () {
        $('.cart_membership').length > 0 && $('.cart_membership').hover(function () {
            $(this).find('i.icon') && $(this).find('.membership_box').show()
        }, function () {
            $(this).find('.membership_box').hide()
        })
    },
    enableNewHeader: function () {
        $('.new_menu_box').hover(function () {
            $(this).find('.header_list').length > 0 && ($(this).addClass('new_menu_hover'), $(this).find('.header_list').show())
        }, function () {
            $(this).removeClass('new_menu_hover'),
                $('.header_list').hide()
        }),
            $('.new_user_login .header_list .er_box').hover(function () {
                $(this).find('span').show()
            }, function () {
                $(this).find('span').hide()
            })
    },
    getServerTime: function () {
        $.getJSON(RM_SITE_MAIN_WEBBASEURL + 'serverinfo.php?callback=?', {
        }, function (a) {
            global_server_time = a.timestamp
        }),
            setInterval(function () {
                global_server_time += 1
            }, 1000)
    },
    getBaoyouControl: function () {
        var a = {
            tag: 1,
            price: 39
        };
        return a
    },
    getChimaControl: function () {
        var a = {
            tag: 1,
            timeout: 500
        };
        return a
    },
    globalJump: function () {
        var a = $.cookie('default_site_25') || '';
        '' == a && $.getJSON(RM_SITE_MAIN_WEBBASEURL + 'i/ajax/getsite?callback=?', function (b) {
            a = b.site
        });
        var b = window.location.host.slice(0, window.location.host.indexOf('.'));
        ('bj' == b || 'sh' == b || 'gz' == b || 'cd' == b) && b != a && ($.cookie('default_site_25', b, {
            expires: 1,
            path: '/',
            domain: RM_SITE_MAIN_TOPLEVELDOMAINNAME
        }), a = b),
            $('body').delegate('a,area', 'click', function () {
                '' == a && (a = 'www');
                var b = $(this).attr('href') || '';
                if (b.indexOf('/i/deal/mobile_subscribe') < 0 && '' != b) {
                    var c = new RegExp('^(http://)(huodong(?=.jumei.com)|www(?=.jumei.com/i/deal))(.*)$', 'i'),
                        b = b.replace(c, '$1' + a + '$3');
                    $(this).attr('href', b)
                }
                var d = b.match(new RegExp('http://([^.]+)..*')),
                    e = '';
                if (d && (e = d[1]), 'www' !== e && 'cart' !== e && 'bj' !== e && 'cd' !== e && 'gz' !== e && 'sh' !== e && 'ajax' !== e && '' != e && b.indexOf('site') <= 0) {
                    var f = b.split('#'),
                        g = '';
                    void 0 != f[1] && (g = '#' + f[1]),
                        b.indexOf('?') > 0 ? $(this).attr('href', f[0].replace(/(^\s+)|(\s+$)/g, '') + '&site=' + a + g)  : $(this).attr('href', f[0].replace(/(^\s+)|(\s+$)/g, '') + '?site=' + a + g)
                }
            })
    },
    refererFix: function () {
        var a = getUrlArgs('referer'),
            b = getUrlArgs('etc_n');
        '' != a && $.cookie('referer_site', a, {
            expires: 1,
            path: '/',
            domain: '.jumei.com'
        }),
        '' != b && $.cookie('etc_n', 'true', {
            expires: 1,
            path: '/',
            domain: '.jumei.com'
        })
    },
    popsubAct: function () {
        var a = $('#header_pop_subAct'),
            b = function () {
                $(this).addClass('hover').siblings('li').removeClass('hover');
                var b = $(this).find('.pop_act_area');
                b.length ? (a.html(b.val()), a.slideDown('fast'))  : a.slideUp('fast')
            },
            c = function () {
                $(this).find('.channel_nav_list li').removeClass('hover'),
                    a.slideUp('fast')
            };
        $('.channel_nav_list li').hoverIntent({
            interval: 100,
            over: b,
            timeout: 0,
            out: function () {
            }
        }),
            $('.channel_nav_list_wrap').hoverIntent({
                interval: 0,
                over: function () {
                },
                timeout: 100,
                out: c
            })
    }
},
    $(function () {
        $('.new_submenu .beauty-new-icon').hasClass('new_selectedMod') && $('.beauty-new-icon').find('.new-icon').hide(),
        $('.new_submenu>li').not($('.beauty-new-icon')).hasClass('new_selectedMod') && $('.new_submenu').find('.new-icon').show()
    }),
    $(function () {
        function a(a) {
            this.id = $(a.id)
        }
        a.prototype = {
            init: function () {
                var a = this;
                a.check_tab_del(),
                    a.check_tab(),
                    a.click_btn()
            },
            check_tab_del: function () {
                var a = this,
                    b = a.id,
                    c = b.find('.look_all'),
                    d = null,
                    e = b.find('.class_list_wrap'),
                    f = e.find('textarea').eq(0);
                a.id.bind('mouseenter', function () {
                    clearTimeout(d),
                        d = setTimeout(function () {
                            c.addClass('cur'),
                                a.loadDom(f),
                                e.slideDown(300)
                        }, 200)
                }).bind('mouseleave', function () {
                    clearTimeout(d),
                        d = setTimeout(function () {
                            e.slideUp(300, function () {
                                c.removeClass('cur')
                            })
                        }, 200)
                })
            },
            check_tab: function () {
                function a(a) {
                    var c = $(a),
                        d = c.index(),
                        e = f.eq(d),
                        g = f.eq(d).find('textarea');
                    f.css('left', '0'),
                        c.hasClass('current') ? f.css('left', '10px')  : e.animate({
                            left: '10px'
                        }, 800),
                        c.addClass('current').siblings().removeClass('current'),
                        e.addClass('current').siblings().removeClass('current'),
                    f.eq(d).attr('load') || (b.loadDom(g), f.eq(d).attr('load', 'loaded'))
                }
                var b = this,
                    c = b.id,
                    d = c.find('.pop_list'),
                    e = c.find('.pop_item_wrap'),
                    f = e.find('.pop_item');
                d.menuAim({
                    submenuDirection: 'left',
                    rowSelector: '> li',
                    activate: a,
                    tolerance: 300
                })
            },
            loadDom: function (a) {
                var b,
                    c = a.val();
                a[0] && 'TEXTAREA' !== a[0].tagName || (b = a.parent(), b.html(c), a.remove())
            },
            click_btn: function () {
                var a = this.id,
                    b = a.find('.close'),
                    c = a.find('.class_list_wrap'),
                    d = a.find('.look_all'),
                    e = null;
                b.bind('click', function () {
                    clearTimeout(e),
                        e = setTimeout(function () {
                            c.slideUp(300, function () {
                                d.removeClass('cur')
                            })
                        }, 200)
                })
            }
        };
        var b = new a({
            id: '#look_all_box'
        });
        b.init()
    }),
    $(function () {
        function a(a) {
            this.id = $('#' + a),
                this.items = this.id.find('li')
        }
        var b = [
            ],
            c = 0,
            d = 0,
            e = !1,
            f = null,
            g = null;
        a.prototype = {
            init: function () {
                if (0 != $('#icon_wrap').length) {
                    var a = this;
                    this.each_aW();
                    var b = $.cookie('demoCookie'),
                        c = $.cookie('demoCookie1');
                    b && 'null' != b || (f = setInterval(function () {
                        a.autoPlay()
                    }, 2000)),
                        'Pop' == RM_CONTROL ? (c && 'null' != c || (f = setInterval(function () {
                            a.autoPlay()
                        }, 2000)), $.cookie('demoCookie1', '1', {
                            expires: 1000,
                            path: '/',
                            domain: RM_SITE_MAIN_TOPLEVELDOMAINNAME
                        }))  : this.setCookies(),
                        this.mouseEvent()
                }
            },
            each_aW: function () {
                this.items.each(function () {
                    var a = $(this),
                        c = a.find('a').width();
                    b.push(c)
                })
            },
            autoPlay: function () {
                d++,
                    d > 6 ? (clearInterval(f), f = null, this.setDefault(), e = !0)  : (c > 2 && (c = 0), this.autoMove(c), c++)
            },
            setDefault: function () {
                this.items.stop().animate({
                    width: '30px'
                }, 300)
            },
            autoMove: function (a) {
                var c = b[a];
                this.items.eq(a).stop().animate({
                    width: c + 'px'
                }, 300),
                    this.items.eq(a).siblings().stop().animate({
                        width: '30px'
                    }, 300)
            },
            mouseEvent: function () {
                var a = this;
                this.items.bind('mouseenter', function () {
                    if (clearInterval(f), clearTimeout(g), 30 == $(this).width() && (e = !0), 0 == e) g = setTimeout(function () {
                        a.setDefault()
                    }, 200),
                        e = !0;
                    else {
                        var b = $(this),
                            c = b.index();
                        g = setTimeout(function () {
                            a.autoMove(c)
                        }, 200),
                            e = !1
                    }
                }).bind('mouseleave', function () {
                    clearInterval(f),
                        clearTimeout(g),
                        a.setDefault(),
                        e = !0
                })
            },
            setCookies: function () {
                $.cookie('demoCookie', '0', {
                    expires: 1000,
                    path: '/',
                    domain: RM_SITE_MAIN_TOPLEVELDOMAINNAME
                })
            }
        };
        var h = new a('icon_wrap');
        h.init()
    }),
    $(function () {
        function a(a) {
            this.target = $(a)
        }
        a.prototype = {
            init: function () {
                this.mouseEvent()
            },
            mouseEvent: function () {
                var a,
                    b;
                this.target.delegate('img', 'mouseenter', function () {
                    a = $(this).width(),
                        b = $(this).height(),
                        $(this).animate({
                            width: 1.01 * a + 'px',
                            height: 1.01 * b + 'px',
                            opacity: 1,
                            filter: 'alpha(opacity:100)',
                            'margin-left': - (0.01 * b / 2) + 'px',
                            'margin-top': - (0.01 * b / 2) + 'px'
                        }, 100)
                }).delegate('img', 'mouseleave', function () {
                    $(this).animate({
                        width: a + 'px',
                        height: b + 'px',
                        filter: 'alpha(opacity:90)',
                        'margin-left': 0,
                        opacity: 0.9,
                        'margin-top': 0
                    }, 100)
                })
            }
        },
            new a('#header_pop_subAct')
    }),
    $(function () {
        function a(a, b) {
            this.target = $(a),
                this.mall_nav_list = this.target.find('.mall_nav_list'),
                this.current = this.target.find('.current'),
                this.li = this.target.find('li'),
                this.step = b,
                this.mallLine = $('.mall_line')
        }
        a.prototype = {
            init: function () {
                this.current.length > 0 && (this.setDefault(), this.mouseEvent())
            },
            setDefault: function (a) {
                var b = this.current.index(),
                    c = void 0 == arguments[0] ? b : a;
                lineWidth = this.li.eq(c).find('a').innerWidth(),
                    lineLeft = this.getLineLeft(c),
                    this.mallLine.stop(!1, !0).animate({
                        width: lineWidth + 'px',
                        left: lineLeft + 'px'
                    }, 200)
            },
            getLineLeft: function (a) {
                var b = 0;
                if (0 == c) return b = 0,
                    void 0;
                for (var c = 0; a > c; c++) b += this.li.eq(c).outerWidth(!0);
                return b + this.step
            },
            mouseEvent: function () {
                var a = this,
                    b = this.current,
                    c = this.li,
                    d = this.mallLine,
                    e = this.step;
                this.li.bind('mouseenter', function () {
                    var b = $(this).index();
                    $(this).addClass('hover'),
                        a.getLineLeft(b),
                        a.setDefault(b)
                }).bind('mouseleave', function () {
                    $(this).removeClass('hover')
                }),
                    this.mall_nav_list.bind('mouseleave', function () {
                        if (b.length <= 0) {
                            var f = c.eq(0).width();
                            d.stop(!1, !0).animate({
                                left: e + 'px',
                                width: f + 'px'
                            }, 200)
                        } else {
                            var g = b.index();
                            a.setDefault(g)
                        }
                    })
            }
        };
        var b = new a('#mall_nav_box', 26);
        b.init()
    }),
    $(function () {
        var a,
            b = $('#container');
        if (('Home' === window.RM_CONTROL && 'show' === window.RM_ACTION || 'Deal' === window.RM_CONTROL && 'detail' === window.RM_ACTION) && ('Home' === window.RM_CONTROL ? (a = '<a href="http://www.diaochapai.net/survey962903" target="_blank" class="Questionnaire" id="Questionnaire"></a>', b.append(a))  : (a = '<a href="http://www.diaochapai.net/survey962914" target="_blank" class="Questionnaire" id="Questionnaire"></a>', b.append(a), $('.abt-set-back').length <= 0 && $('#Questionnaire').css('margin-left', '490px'))), 'Mall' === window.RM_CONTROL) {
            switch (window.RM_ACTION) {
                case 'scp':
                    a = '<a href="http://www.diaochapai.net/survey962891" target="_blank" class="Mall_Questionnaire_right" id="Questionnaire"></a>';
                    break;
                case 'xihu':
                    a = '<a href="http://www.diaochapai.net/survey962722" target="_blank" class="Mall_Questionnaire_left" id="Questionnaire"></a>';
                    break;
                case 'products':
                    a = '<a href="http://www.diaochapai.net/survey962724" target="_blank" class="Mall_Questionnaire_left" id="Questionnaire"></a>';
                    break;
                case 'show':
                    a = '<a href="http://www.diaochapai.net/survey962843" target="_blank" class="Mall_Questionnaire_right" id="Questionnaire"></a>';
                    break;
                case 'flagship_product':
                    a = '<a href="http://www.diaochapai.net/survey962731" target="_blank" class="Mall_Questionnaire_right" id="Questionnaire"></a>';
                    break;
                case 'product':
                    a = '<a href="http://www.diaochapai.net/survey962731" target="_blank" class="Mall_Questionnaire_right" id="Questionnaire"></a>'
            }
            b.append(a)
        }
        $('#Questionnaire').length > 0 && $('#footer_container').length > 0 && $(window).scroll(function () {
            var a = $('#Questionnaire'),
                b = $(window).height(),
                c = $(window).scrollTop(),
                d = $('#footer_container').offset().top;
            d > c + b ? a.fadeIn()  : a.fadeOut()
        })
    }), $(function () {
    function a() {
        b.bind('mouseenter', function () {
            clearTimeout(c),
                c = setTimeout(function () {
                    bz_list.slideDown()
                }, 200)
        }).bind('mouseleave', function () {
            clearTimeout(c),
                c = setTimeout(function () {
                    bz_list.slideUp()
                }, 200)
        })
    }
    var b = $('#zpbz'),
        c = null;
    bz_list = b.find('.bz_list'),
    0 !== b.length && a()
});

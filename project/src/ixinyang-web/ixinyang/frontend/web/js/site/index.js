/**
 * Created by pan on 2014/12/26.
 */

$("#content img").lazyload({
    threshold: 100,
    effect      : "fadeIn"
});
 
$(window).resize(function () {
    bodyWidth = $('body').width();
    winHeight = $(window).height();
    sideRemain = (bodyWidth - 1000) / 2;
    if (bodyWidth >= 1250 && $(window).scrollTop() > winHeight)
        $('#home_nav_bar').show();
    else
        $('#home_nav_bar').hide()
}).trigger('resize');

$(window).on('scroll', function () {
    var sTop = $(window).scrollTop();
    winHeight = $(window).height()-180;
    bodyWidth = $('body').width();
    var a = $('#home_nav_bar');
    if (sTop > winHeight) {
        if (bodyWidth >= 1250)
            a.show(), $('.header_center_title').css('position','fixed');
    } else
        $('#home_nav_bar').hide(), $('.header_center_title').css('position','');
    add_target_class(a.find('a'), $(window).scrollTop());
});

function add_target_class(a, b) {
    for (var c = this.get_href(a), d = 0; d < c.length; d++) {
        var e = c[d].top-20;
        if (d < c.length - 1) var f = c[d + 1].top;
        d === c.length - 1 ? (f = c[d].top, b >= f ? a.eq(d).addClass('leftbar_listhover '+ a.eq(d).attr('id') +'hover')  : a.eq(d).removeClass('leftbar_listhover '+ a.eq(d).attr('id') +'hover'))  : b >= e && f > b ? a.eq(d).addClass('leftbar_listhover '+ a.eq(d).attr('id') +'hover')  : a.eq(d).removeClass('leftbar_listhover '+ a.eq(d).attr('id') +'hover')
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




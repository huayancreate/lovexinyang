define('common/slide', function (a, b, c) {

var ie6 = !-[1,] && !window.XMLHttpRequest;
var userAgent = navigator.userAgent.toLowerCase();
var browser = {
    ie8: /msie 8/.test(userAgent),
    ie7: /msie 7/.test(userAgent)
};
//Slide func
$.fn.slide=function(){
    var defaults,opts,data_opts,$this,$p_img,// 父级图片
        t,n=0,count,$nav,$p,$n,DelayObj,Delay=false;
    defaults={
        fade:true,
        auto:true,
        time:4000,
        action:'mouseover'
    };
    $this=$(this);
    data_opts=$this.data('slide')||{};
    opts=$.extend({},defaults,data_opts);
    $p_img=$this.find('.subpage_top_imgdiv img');
    $nav = $(this).find('.subpage_top_thumbnail');
    if($nav.find('li').length){
        count = $nav.find('li').length;
    }
    $p=$(this).find('.ui-slider__control--left');
    $n=$(this).find('.ui-slider__control--right');
    if(opts.auto){  // 自动轮转
        t = setInterval(function(){showAuto()}, opts.time);
        $this.mouseenter(function(){
            clearInterval(t);
        }).mouseleave(function(){
            t=setInterval(function(){showAuto()},opts.time);
        })
    };
    $p.click(function(){showPre()});
    $n.click(function(){showAuto()});
    function showAuto(){
          n=n>=(count - 1) ? 0 : ++n;$nav.find('a').eq(n).trigger('click');
    };
    function showPre(){
        n=n<=0 ? (count - 1) : --n;$nav.find('a').eq(n).trigger('click')
    };
    $nav.find('a').each(function(index) {
        $(this).on(opts.action,function(){
            $nav.find('img').filter(function() {
                return $(this).data('order')==index
            }).parent().addClass('active').parent().siblings().find('a').removeClass('active');
            $p_img.attr('src',$nav.find('.active img').data('src'));
            n = $nav.find('.active img').data('order');
            $p_img.attr('slide-to',$nav.find('.active img').data('order'));
        })
    });
};
    var m = null ;
    m = function(){
        $('.subpage_top_left').each(function() {$(this).slide()});
    } ;
    c.exports = m
});




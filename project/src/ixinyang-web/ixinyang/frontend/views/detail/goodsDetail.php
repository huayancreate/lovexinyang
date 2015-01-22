<?php
$this->title = '商品详情';
?>
<?php $this->registerCssFile("css/ProductSubpage.css"); ?>

<?php include '/../layouts/topbar.php';?>
<script>
    seajs.use('detail/goods', function (main) {
        main.init();
        main.intCartBtn({
            parent: '.subpage_top',
            self: '.chartcar_btn'
        });
    });
    seajs.use('common/slide', function (a) {
        a();
    });
</script>
<section>
<div class="wrap_content_box productsubpage_content">
<div class="position_menu">当前位置：<a href="#">首页</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;<a href="#">美食</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;<a href="#">锅大侠火锅</a>
</div>
<!--顶部位置导航  end-->

<section class="subpage_top">
    <aside class="subpage_top_left" data-slide='{"action":"click mouseenter","time":"4000"}'>
        <figure>
            <div class="subpage_top_imgdiv">
                <a class="ui-slider__control ui-slider__control--left" onselectstart="return false;"></a>
                <a class="ui-slider__control ui-slider__control--right" onselectstart="return false;"></a>
                <img width="430px" height="417px;" data-slide-to="0" src="images/Product01.jpg" />
            </div>
            <figcaption class="subpage_top_thumbnail">
                <ul>
                    <li><a href="javascript:void(0)" class="active" ><img src="images/small02.jpg" data-src="images/Product01.jpg" data-order="0"/></a></li>
                    <li><a href="javascript:void(0)" ><img src="images/small01.jpg" data-src="images/small01.jpg" data-order="1"/></a></li>
                    <li><a href="javascript:void(0)" ><img src="images/small03.jpg" data-src="images/small03.jpg" data-order="2"/></a></li>
                    <li><a href="javascript:void(0)" ><img src="images/small03.jpg" data-src="images/small03.jpg" data-order="3"/></a></li>
                    <li><a href="javascript:void(0)" ><img src="images/small04.jpg" data-src="images/small04.jpg" data-order="4"/></a></li>
                    <div class="clearfloat"></div>
                </ul>
                <div class="clearfloat"></div>
            </figcaption>
        </figure>
    </aside><!--左侧商品图片和缩略图-->

    <article class="subpage_top_right">
        <figure class="subpage_top_right_descripe">
            <h1>【浉河区】锅大侠火锅</h1>
            <p>仅售59元！价值175.5元的锅大侠火锅2-3人套餐，2张积分券可升级，提供免费WiFi。5年发展，品牌升级,30余种自助小料水果无限量供应，免费赠送2份开心开胃小吃，美味齐分享！免费提供
                WIFII，2张积分券可升级4-6人餐！</p>
        </figure>
        <figure class="subpage_top_right_message">
            <div class="divline">
                <span class="m_left"><mark>￥<b>59</b></mark><i>原价：￥175.5</i></span>
                <span class="m_right">已售：<em>40572</em></span>
                <div class="clearfloat"></div>
            </div>
            <div class="divline">
				  <span class="m_left">
				    评价：<span class="pingfen_show"><span class="pingfen_show_on" style="width:90%"></span></span> <span>&nbsp;&nbsp;<em>4.5</em>分</span> <span><em>92%</em>好评（<em>15367</em>人评价） </span>
				  </span>
                <span class="m_right norm">收藏：<em>2456</em></span>
                <div class="clearfloat"></div>
            </div>
            <div class="divline"><span>商家：锅大侠火锅</span><span>电话：0376-6508099</span></div>
            <div class="divline"><b>（注：本商品由锅大侠火锅提供，并提供售后服务，最终解释权归锅大侠火锅所有！！！）</b></div>
        </figure>
        <figure class="subpage_top_right_ordersis" id="subdiv">
            <table>
                <tr>
                    <td class="ord_le">套餐：</td>
                    <td class="ord_ri"><ul><li><a class="first">2—3人套餐&nbsp;59元</a></li><li><a>6—7人套餐&nbsp;175元</a></li><li><a>10—12人套餐&nbsp;328元</a></li><li><a>15—20人套餐&nbsp;576元</a></li><div class="clearfloat"></div></ul></td>
                </tr>
                <tr>
                    <td class="ord_le2">数量：</td>
                    <td class="ord_ri"><span class="less_more">－</span><input id="number" type="text" value="1" /><span class="less_more">+</span><div class="clearfloat"></div></td>
                </tr>
            </table>
            <div class="bt_line" data-value="1">
                <a class="oreder_btn" href="javascript:void(0)"></a>
                <a class="chartcar_btn" href="javascript:void(0)"></a>
                <a class="shouchang_btn" href="javascript:void(0)"></a></div>
        </figure>
    </article><!--右侧商品和订单详细说明-->
    <div class="clearfloat"></div>
</section>
<!--top 商品订单信息  end-->

<section class="subpage_middle_otherproduct">
    <div class="subpage_middle_title"><span>该商家的其他商品</span></div>
    <article class="subpage_middle_content">
        <ul class="subpage_middle_productwrap">
            <li>
                <figure>
                    <a href="javascript:void(0)"><img src="images/other01.jpg" /></a>
                    <div class="productwrap_texttop">
                        <div class="productwrap_name" title="【浉河区】金粒香糕点坊"><a href="javascript:void(0)">【浉河区】金粒香糕点坊</a></div>
                        <div class="productwrap_descrip">水果蛋糕，约8英寸，圆。另有10寸和12寸双层水果蛋糕，欢迎品尝</div>
                    </div>
                    <div class="productwrap_texbottom">
                        <div class="productwrap_price">￥<strong>49</strong></div>
                        <div class="productwrap_sales">已售出：235</div>
                        <div class="clearfloat"></div>
                    </div>
                </figure>
            </li>
            <li>
                <figure>
                    <a href="javascript:void(0)"><img src="images/other02.jpg" /></a>
                    <div class="productwrap_texttop">
                        <div class="productwrap_name" title="【浉河区】蛮子特色热干面"><a href="javascript:void(0)">【浉河区】蛮子特色热干面</a></div>
                        <div class="productwrap_descrip">滋味鲜美，价格便宜，邀您品鉴</div>
                    </div>
                    <div class="productwrap_texbottom">
                        <div class="productwrap_price">￥<strong>5.9</strong></div>
                        <div class="productwrap_sales">已售出：265</div>
                        <div class="clearfloat"></div>
                    </div>
                </figure>
            </li>
            <li>
                <figure>
                    <a href="javascript:void(0)"><img src="images/other03.jpg" /></a>
                    <div class="productwrap_texttop">
                        <div class="productwrap_name" title="【浉河区】王家老太镇江锅盖面"><a href="javascript:void(0)">【浉河区】王家老太镇江锅盖面</a></div>
                        <div class="productwrap_descrip">全部2选1，提供免费WiFi，精致美味，幸福滋味</div>
                    </div>
                    <div class="productwrap_texbottom">
                        <div class="productwrap_price">￥<strong>9.9</strong></div>
                        <div class="productwrap_sales">已售出：1874</div>
                        <div class="clearfloat"></div>
                    </div>
                </figure>
            </li>
            <li>
                <figure>
                    <a href="javascript:void(0)"><img src="images/other04.jpg" /></a>
                    <div class="productwrap_texttop">
                        <div class="productwrap_name" title="【浉河区】巴哥手撕烤兔"><a href="javascript:void(0)">【浉河区】巴哥手撕烤兔</a></div>
                        <div class="productwrap_descrip">麻辣兔腿，提供免费WiFi，享受美味，从此开始</div>
                    </div>
                    <div class="productwrap_texbottom">
                        <div class="productwrap_price">￥<strong>7.9</strong></div>
                        <div class="productwrap_sales">已售出：2098</div>
                        <div class="clearfloat"></div>
                    </div>
                </figure>
            </li>
            <div class="clearfloat"></div>
        </ul>
        <div class="subpage_middle_more"><a href="javascript:void(0)">查看剩余12件商品</a></div>
        <div class="subpage_middle_souqi"><a href="javascript:void(0)"></a></div> <!-- 收起剩余商品按钮-->
    </article>
</section>
<!--middle 商家其他商品  end-->

<section class="subpage_down">
<article class="">
<hgroup class="right_title">
    <ul>
    <a class="first"  href="#subpage_location">商家位置</a>
    <a href="#subpage_orderlist">商品详情</a>
    <a href="#subpage_notice">购买须知</a>
    <a href="#subpage_introduction">店铺介绍</a>
    <a href="#subpage_review">用户评价（<strong>148756</strong>）</a>
    </ul>
    <div style="" class="buy-group" id="J-nav-buy">
        <a class="oreder_btn_float" href="javascript:void(0)">立即购买</a>
    </div>
</hgroup>

<section class="subpage_content" id="subpage_location">
    <h2 class="content-title">商家位置</h2>
    <ul class="location">
        <li>
            <div class="subpage_content_caption">锅大侠火锅（信阳一店）</div>
            <div class="subpage_content_wrap">
                <div class="divline">
				           <span>
				              评价：<span class="pingfen_show"><span class="pingfen_show_on" style="width:80%"></span></span> <span>&nbsp;&nbsp;<em>4.0</em>分</span> <span><em>637</em>人评价</span><span>好评率：<em>90%</em>&nbsp;&nbsp;<em>高于</em>&nbsp;&nbsp;同行业<em>3.5%</em>&nbsp;&nbsp;<em>↑</em></span>
				            </span>
                </div>
                <div class="divline">地址：浉河区胜利路步行街新天地1期三楼（新玛特商场北门）</div>
                <div class="divline">电话：0376-6211877</div>
                <div class="location_others"><a href="javascript:void(0)" class="first">查看地图</a>|<a href="javascript:void(0)">公交/驾车</a>|<a href="javascript:void(0)">信息报错</a></div>
            </div>
            <div class="location_btn"><a href="javascript:void(0)">申请本店会员</a></div>
        </li>
        <li>
            <div class="subpage_content_caption">锅大侠火锅（信阳二店）</div>
            <div class="subpage_content_wrap">
                <div class="divline">
				           <span>
				              评价：<span class="pingfen_show"><span class="pingfen_show_on" style="width:70%"></span></span> <span>&nbsp;&nbsp;<em>3.5</em>分</span> <span><em>1965</em>人评价</span><span>好评率：<em>80%</em>&nbsp;&nbsp;<em>低于</em>&nbsp;&nbsp;同行业<em>0.5%</em>&nbsp;&nbsp;<em>↓</em></span>
				            </span>
                </div>
                <div class="divline">地址：浉河区信阳万家灯火步行街沃尔玛超市旁</div>
                <div class="divline">电话：0376-6508099</div>
                <div class="location_others"><a href="javascript:void(0)" class="first">查看地图</a>|<a href="javascript:void(0)">公交/驾车</a>|<a href="javascript:void(0)">信息报错</a></div>
            </div>
            <div class="location_btn"><a href="javascript:void(0)">申请本店会员</a></div>
        </li>
    </ul>
    <div class="location_map"><img src="images/map.jpg" /></div>
    <div class="location_map_text">注：地图位置坐标仅供参考，具体情况以实际道路标识信息为准</div>
</section>
<!--商家位置  end-->

<section class="subpage_content" id="subpage_orderlist">
    <h2 class="content-title">商品详情</h2>
    <div class="subpage_content_caption">基本信息</div>
    <div class="subpage_content_wrap">
        <table>
            <tr><th colspan="2">套餐内容</th><th>单价</th><th>数量</th><th>小计</th></tr>
            <tr><td><strong>锅底</strong></td><td>传统鸳鸯锅</td><td>￥18</td><td>1份</td><td>￥18</td></tr>
            <tr><td rowspan="5"><strong>荤菜</strong></td><td>羔羊肉卷</td><td>￥10.5</td><td>1份</td><td>￥10.5</td></tr>
            <tr><td>精品肥牛</td><td>￥10.5</td><td>1份</td><td>￥10.5</td></tr>
            <tr><td>撒尿牛肉丸</td><td>￥9</td><td>1份</td><td>￥9</td></tr>
            <tr><td>鱼豆腐</td><td>￥4</td><td>1份</td><td>￥4</td></tr>
            <tr><td>鸭血</td><td>￥2.5</td><td>1份</td><td>￥2.5</td></tr>
            <tr><td rowspan="8"><strong>素菜</strong></td><td>金针菇</td><td>￥4.5</td><td>1份</td><td>￥4.5</td></tr>
            <tr><td>川粉</td><td>￥2.5</td><td>1份</td><td>￥2.5</td></tr>
            <tr><td>千张</td><td>￥3</td><td>1份</td><td>￥3</td></tr>
            <tr><td>面筋</td><td>￥2.5</td><td>1份</td><td>￥2.5</td></tr>
            <tr><td>生菜</td><td>￥2.5</td><td>1份</td><td>￥2.5</td></tr>
            <tr><td>土豆</td><td>￥2</td><td>1份</td><td>￥2</td></tr>
            <tr><td>冬瓜</td><td>￥2</td><td>1份</td><td>￥2</td></tr>
            <tr><td>烩面</td><td>￥2</td><td>1份</td><td>￥2</td></tr>
        </table>
        <div class="floatright_text">总价：<b>￥59</b></div>
    </div>
    <div class="subpage_content_caption">实物照片</div>
    <div class="subpage_content_wrap">
        <ul class="pro_img">
            <li>生菜<img src="images/01.jpg" title="生菜" alt="生菜" /></li>
            <li>金针菇<img src="images/02.jpg" title="金针菇" alt="金针菇" /></li>
            <li>羊肉卷<img src="images/03.jpg" title="羊肉卷" alt="羊肉卷" /></li>
        </ul>
    </div>
</section>
<!--本单详情  end-->

<section  class="subpage_content" id="subpage_notice">
    <h2 class="content-title">购买须知</h2>
    <div class="subpage_content_caption">使用说明</div>
    <div class="subpage_content_wrap">
        <p>1、无需预约，消费高峰时可能需要等位；<br />2、使用日期不限，自下订单之日起每日10:00-22:00间均可使用，订单默认有效期为7天，7日内未使用者订单自动取消；<br />
            3、2014年12月24日至12月25日、2015年1月1日不享受此折扣，具体折扣详询商检。</p>
    </div>
    <div class="subpage_content_caption">温馨提示</div>
    <div class="subpage_content_wrap">
        <p>1、仅限堂食，不提供餐前外带，餐毕未吃完可免费打包；<br />2、每桌可赠送2种开心开胃小吃（卤水花生、开胃鸭锁骨、凉拌木耳、手剥糖蒜可重复4选2）；<br />3、单份订单进店使用多人台或大圆台就餐，需到店内+9元现金更换加大锅底；<br />4、因洛阳地区和信阳地区区域差异，个别菜品单价略有出入，具体以本页面售卖明细与单价为准，本站下订单用户不可同时享受
            商家其他优惠；<br />5、方案内人数免费提供餐具，超出人数详询商家；<br />6、酒水饮料等问题，请致电商家咨询，以商家反馈为准；<br />7、如部分菜品因时令或其他不可抗因素导致无法提供，店内会用等价菜品替换，具体事宜请与店内协商；<br />8、商家店内无包间；<br />9、套餐包含1份餐巾纸，如需增加，需到店另付0.5元/份。</p>
    </div>
    <div class="subpage_content_caption">商家服务</div>
    <div class="subpage_content_wrap">
        <p>1、提供免费WiFi；<br />2、停车位收费标准：电讯商家。</p>
    </div>
</section>
<!--购买须知  end-->

<section  class="subpage_content" id="subpage_introduction">
    <h2 class="content-title">店铺介绍</h2>
    <div class="subpage_content_caption">店铺介绍</div>
    <div class="subpage_content_wrap">
        <p>锅大侠火锅成立于2009年9月，是一家以经营火锅为主题的全国休闲连锁餐厅。锅大侠火锅经过不断探索、改良、刻苦钻研，结合现代营养学，应用最新烹饪技术精心制作而成。富含维生素、蛋白质、锌、钙等多种营养成分。具有开胃、养颜、食后不上火等特点。餐厅以都市时尚风格为装饰主题、为您提供休闲、聚会、购物小憩、情侣约会等快捷舒适的用餐场所。同时将以专业、专注细节及低廉的价格为您提供一流的服务。锅大侠火锅成立伊始，就确立了“立足河南，辐射全国”的发展战略，立志将“锅大侠”品牌塑造成民族餐饮行业的“百年老店”，为中国餐饮行业的发展做出贡献。经过3年的成长与发展，逐步建立和完善了公司的组织架构和业务体系，确立了在郑州本土火锅业的地位。</p>
        <br />
        <p>从2010年开始，每年以3-5的开店的速度迈进市场，用近5-10年的时间完成全国市场30-50家店的战略布局。雄厚的实力是锅大侠的立身之本，务实创新、追求卓越是公司发展的不懈动力。在激烈的市场竞争中，锅大侠火锅正以良好的声誉、创新的经营模式、健康、平稳、快速发展，为全体员工与合作伙伴共同创造更加辉煌的明天！</p>
        <br />
        <p><img src="images/111.jpg" /></p>  <br />
        <p><img src="images/222.jpg" /></p>
    </div>
</section>
<!--商家介绍  end-->

<section  class="subpage_content" id="subpage_review">
    <h2 class="content-title">用户评价</h2>
    <div class="subpage_content_wrap">
        <div class="review_top_message">
            <div class="m_logo"><img src="images/pro_logo.jpg" /></div>
            <div class="spite_line"></div>
            <div class="m_box">
                <figure>
                    <figcaption class="m_box_pingfen"><span class="m_box_pingfen_show"><span class="m_box_pingfen_show_on" style="width:80%"></span></span><span><b>4.0</b>分</span></figcaption>
                    <h2>描述相符：4.5分&nbsp;&nbsp;服务：3.5分&nbsp;&nbsp;环境：4.0分</h2>
                    <div>共<em>17493</em>人评价</div>
                    <div class="review_btn"><a href="#">我要评论</a></div>
                </figure>
            </div>
            <div class="clearfloat"></div>
        </div></div><!--review_top_message-->
    <article class="review_down">
        <div class="review_down_title">
            <a class="first" href="javascript:void(0)">全部（<strong>23568</strong>）</a><a href="javascript:void(0)">好评（<strong>22641</strong>）</a><a href="javascript:void(0)">中评（<strong>8641</strong>）</a><a href="javascript:void(0)">差评（<strong>141</strong>）</a><a href="javascript:void(0)">有图（<strong>10851</strong>）</a>
            <select><option selected>默认排序</option><option>按时间升序↑</option><option>按时间降序↓</option><option>按回复递增↑</option><option>按回复递减↓</option><option>按评价递增↑</option><option>按评价递减↓</option></select>
        </div>
        <ul class="review_content">
            <li>
                <div class="subpage_content_wrap">
                    <aside class="review_content_left">
                        <span class="pingfen_show"><span class="pingfen_show_on" style="width:100%"></span></span>&nbsp;&nbsp;&nbsp;<span><b>5.0</b>分</span>
                    </aside>
                    <article class="review_content_right">
                        <figure class="review_content_titlename">
                            <div class="divline"><h3>aHs845852083</h3><div class="clearfloat"></div></div>
                            <figcaption>2014-11-25</figcaption>
                        </figure>
                        <p>不错，味道很好，服务态度也很好，我们两个人吃的很撑还没有吃完，西瓜不错，送的小块鸭架好辣！好评！</p>
                        <figure class="review_content_titlename">
                            <div class="divline"><a class="image" href="javascript:void(0)"><img src="images/s01.jpg" /></a><a class="image" href="javascript:void(0)"><img src="images/s02.jpg" /></a><div class="clearfloat"></div></div>
                            <figcaption>锅大侠火锅（信阳一店）</figcaption>
                        </figure>
                        <p class="shangjia">商家回复：谢谢亲的反馈，我们会努力的改正自己的缺陷，让您在我店用餐更加舒心，期待您的再次光临。</p>
                    </article>
                    <div class="clearfloat"></div>
                </div>
            </li>

            <li>
                <div class="subpage_content_wrap">
                    <aside class="review_content_left">
                        <span class="pingfen_show"><span class="pingfen_show_on" style="width:90%"></span></span>&nbsp;&nbsp;&nbsp;<span><b>4.5</b>分</span>
                    </aside>
                    <article class="review_content_right">
                        <figure class="review_content_titlename">
                            <div class="divline"><h3>哎！吃货一个</h3><div class="clearfloat"></div></div>
                            <figcaption>2014-11-25</figcaption>
                        </figure>
                        <p>菜分量有点少，本来要三个人一起来的幸好只来了两个我俩就都吃光了 哎也许是我饭量大。自助酱料棒，酱料也好吃！</p>
                        <figure class="review_content_titlename">
                            <figcaption>锅大侠火锅（信阳一店）</figcaption>
                        </figure>
                    </article>
                    <div class="clearfloat"></div>
                </div>
            </li>

            <li>
                <div class="subpage_content_wrap">
                    <aside class="review_content_left">
                        <span class="pingfen_show"><span class="pingfen_show_on" style="width:80%"></span></span>&nbsp;&nbsp;&nbsp;<span><b>4.0</b>分</span>
                    </aside>
                    <article class="review_content_right">
                        <figure class="review_content_titlename">
                            <div class="divline"><h3>小的小二郎</h3><div class="clearfloat"></div></div>
                            <figcaption>2014-11-24</figcaption>
                        </figure>
                        <p>不是第一次来，来了好多次，这次咨询了会员卡，想长期办理，味道很不错，酱料很醇厚，特别是芝麻，香菇，菌类的酱料，西瓜很甜，上菜及时，就是点菜时有时候半天找不到人服务还得自己去柜台，总之很不错。</p>
                        <figure class="review_content_titlename">
                            <div class="divline"><a class="image" href="javascript:void(0)"><img src="images/s03.jpg" /></a><a class="image" href="javascript:void(0)"><img src="images/s04.jpg" /></a><a class="image" href="javascript:void(0)"><img src="images/s05.jpg" /></a><a class="image" href="javascript:void(0)"><img src="images/s06.jpg" /></a><a class="image" href="javascript:void(0)"><img src="images/s07.jpg" /></a><div class="clearfloat"></div></div>
                            <figcaption>锅大侠火锅（信阳二店）</figcaption>
                        </figure>
                    </article>
                    <div class="clearfloat"></div>
                </div>
            </li>

            <li>
                <div class="subpage_content_wrap">
                    <aside class="review_content_left">
                        <span class="pingfen_show"><span class="pingfen_show_on" style="width:20%"></span></span>&nbsp;&nbsp;&nbsp;<span><b>1.0</b>分</span>
                    </aside>
                    <article class="review_content_right">
                        <figure class="review_content_titlename">
                            <div class="divline"><h3>翠*^白</h3><div class="clearfloat"></div></div>
                            <figcaption>2014-11-25</figcaption>
                        </figure>
                        <p>口味一般般……不是很划算，套餐里量少，还都是不好吃的~销量底的东西~服务员态度不好，，锅底上来还有只小虫子……无语了，差评！！！</p>
                        <figure class="review_content_titlename">
                            <figcaption>锅大侠火锅（信阳一店）</figcaption>
                        </figure>
                        <p class="shangjia">商家回复：谢谢亲的反馈，我们会努力的改正自己的缺陷，让您在我店用餐更加舒心，期待您的再次光临。</p>
                        <section class="reply_show">
                            <ul>
                                <li>
                                    <figure class="review_content_titlename">
                                        <div class="divline"><h3>翠*^白</h3><div class="clearfloat"></div></div>
                                        <figcaption>2014-11-30</figcaption>
                                    </figure>
                                    <p>额。。。</p>
                                </li>
                            </ul>
                        </section><!--用户回复展现-->
                    </article>
                    <div class="clearfloat"></div>
                </div>
            </li>
        </ul>
        <div class="rangpage"><a class="first">首页</a><a class="first">上一页</a><a href="javascript:void(0)">1</a><a href="javascript:void(0)">2</a><a href="javascript:void(0)">3</a>...&nbsp;&nbsp;<a href="javascript:void(0)">22</a><a href="javascript:void(0)">下一页</a><a href="javascript:void(0)">尾页</a></div>
    </article><!--评论内容展现-->
</section>
<!--用户评论  end-->
</article><!--右侧商家、商品、评论信息-->
<div class="clearfloat"></div>
</section>
<!--down 商家、用户评论&商品详情  end-->
</div>
</section>
<!--section  主体内容  end-->



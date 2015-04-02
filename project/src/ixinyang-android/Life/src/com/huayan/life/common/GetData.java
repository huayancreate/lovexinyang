package com.huayan.life.common;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;

import com.alibaba.fastjson.JSON;
import com.huayan.life.model.AlbumImage;
import com.huayan.life.model.Banner;
import com.huayan.life.model.Business;
import com.huayan.life.model.Category;
import com.huayan.life.model.Codes;
import com.huayan.life.model.Counties;
import com.huayan.life.model.Goods;
import com.huayan.life.model.MemberCard;
import com.huayan.life.model.MyLocation;
import com.huayan.life.model.Notice;
import com.huayan.life.model.Order;
import com.huayan.life.model.OrderIntroduce;
import com.huayan.life.model.Regional;
import com.huayan.life.model.Shop;

public class GetData {

	public static String getCategoryList() {
		List<Category> categoryList=new ArrayList<Category>();
		for(int i=0;i<10;i++){
			Category  cate=new Category();
		
			 if(i%3==0){
				 cate.setCategoryName("美食");
				 cate.setParentCategoryId(0);
			 }else if(i%3==1){
				 cate.setCategoryName("火锅");
				 cate.setParentCategoryId(1);
			 }else if(i%3==2){
				 cate.setCategoryName("自助餐");
				 cate.setParentCategoryId(1);
			 }
			 	categoryList.add(cate);
		}
		
		 HashMap<String, Object> temp = new HashMap<String, Object>(); 
		 temp.put("recordList", categoryList);
		 temp.put("pageCount", 4);
		 
		 HashMap<String, Object> map = new HashMap<String, Object>(); 
		 map.put("success", true);
		 map.put("content",temp);
		String json =JSON.toJSONString(map);
		return json;
}
	
	public static String getRegionalList() {
		List<Regional> categoryList=new ArrayList<Regional>();
		for(int i=0;i<4;i++){
			Regional  reg=new Regional();
		
			reg.setCityID(i);
			reg.setName("合肥");
			for (int j = 0; j < 5; j++) {
				Counties cou = new Counties();
				if (j == 1) {
					cou.setName("高新区");
				} else if (j == 2) {
					cou.setName("蜀山区");
				} else if (j == 3) {
					cou.setName("包河区");
				} else if (j == 4) {
					cou.setName("庐阳区");
				}
				for (int k = 0; k < 5; k++) {
					Business bus = new Business();
					if (k == 1) {
						bus.setName("中科大");
					} else if (k == 2) {
						bus.setName("三里庵");
					} else if (k == 3) {
						bus.setName("望潜交口");
					} else if (k == 4) {
						bus.setName("明珠广场");
					}
					cou.setBusiness(bus);
				}
				reg.setCounties(cou);
			}
			 	categoryList.add(reg);
		}
		
		 HashMap<String, Object> temp = new HashMap<String, Object>(); 
		 temp.put("recordList", categoryList);
		 temp.put("pageCount", 4);
		 
		 HashMap<String, Object> map = new HashMap<String, Object>(); 
		 map.put("success", true);
		 map.put("content",temp);
		String json =JSON.toJSONString(map);
		return json;
}
	
	
	public static String getOrders(int type) {
		List<Order> orderList = new ArrayList<Order>();
	
		for (int i = 0; i <7; i++) {
			Order order = new Order();
			order.setType(type);
			order.setOrderID(i+11+"");
			order.setName( "丽江龙继斑鱼庄");
			order.setPrice( "68");
			order.setUnitPrice("34");
			order.setNum(i+1);
			order.setCommentScore(2);
			
			
			if(type==0){
				if (i % 6 == 0) {
					order.setIsBookmark(0);
					order.setGoodsImg("http://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXhttp://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXXXchXXXXXXXXXXXX_!!16336700-0-rate.jpgXXchXXXXXXXXXXXX_!!16336700-0-rate.jpg");
					order.setTypeName("待付款");
				} else if(i % 6 == 1) {
					order.setIsBookmark(1);
					order.setGoodsImg("http://img.taobaocdn.com/bao/uploaded/i2/18783042962806492/TB2HqSYXVXXXXXDXXXXXXXXXXXX_!!1060668783-0-rate.jpg");
					order.setTypeName("已评价");
				}else if(i % 6 == 2) {
					order.setIsBookmark(0);
					order.setGoodsImg("http://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXhttp://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXXXchXXXXXXXXXXXX_!!16336700-0-rate.jpgXXchXXXXXXXXXXXX_!!16336700-0-rate.jpg");
					order.setTypeName("待评价");
				}else if(i % 6 == 3) {
					order.setIsBookmark(0);
					order.setGoodsImg("http://img.taobaocdn.com/bao/uploaded/i2/18783042962806492/TB2HqSYXVXXXXXDXXXXXXXXXXXX_!!1060668783-0-rate.jpg");
					order.setTypeName("已退款");
				}else if(i % 6 == 4) {
					order.setIsBookmark(1);
					order.setGoodsImg("http://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXhttp://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXXXchXXXXXXXXXXXX_!!16336700-0-rate.jpgXXchXXXXXXXXXXXX_!!16336700-0-rate.jpg");
					order.setTypeName("未消费");
				}else if(i%6==5){
					order.setIsBookmark(0);
					order.setGoodsImg("http://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXhttp://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXXXchXXXXXXXXXXXX_!!16336700-0-rate.jpgXXchXXXXXXXXXXXX_!!16336700-0-rate.jpg");
					order.setTypeName("退款中");
				}
			}else if(type==1){
				order.setIsBookmark(0);
				order.setGoodsImg("http://img.taobaocdn.com/bao/uploaded/i2/18783042962806492/TB2HqSYXVXXXXXDXXXXXXXXXXXX_!!1060668783-0-rate.jpg");
				order.setTypeName("待付款");
			}else if(type==2){
				order.setIsBookmark(1);
				order.setGoodsImg("http://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXhttp://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXXXchXXXXXXXXXXXX_!!16336700-0-rate.jpgXXchXXXXXXXXXXXX_!!16336700-0-rate.jpg");
				order.setTypeName("未消费");
			}else if(type==3){
				order.setIsBookmark(0);
				order.setGoodsImg("http://img.taobaocdn.com/bao/uploaded/i2/18783042962806492/TB2HqSYXVXXXXXDXXXXXXXXXXXX_!!1060668783-0-rate.jpg");
				order.setTypeName("待评价");
			}else if(type==4){
				if(i%2==0){
					order.setIsBookmark(1);
					order.setGoodsImg("http://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXhttp://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXXXchXXXXXXXXXXXX_!!16336700-0-rate.jpgXXchXXXXXXXXXXXX_!!16336700-0-rate.jpg");
					order.setTypeName("已退款");
				}else if(i%2==1){
					order.setIsBookmark(0);
					order.setGoodsImg("http://img.taobaocdn.com/bao/uploaded/i2/18783042962806492/TB2HqSYXVXXXXXDXXXXXXXXXXXX_!!1060668783-0-rate.jpg");
					order.setTypeName("退款中");
				}
			}
			orderList.add(order);
		}
		
		 HashMap<String, Object> temp = new HashMap<String, Object>(); 
		 temp.put("recordList", orderList);
		 temp.put("pageCount", 4);
		 
		 HashMap<String, Object> map = new HashMap<String, Object>(); 
		 map.put("success", true);
		 map.put("content",temp);
		String json =JSON.toJSONString(map);
		return json;
	}


	public static String getOrdersList() {
		List<OrderIntroduce> orderList = new ArrayList<OrderIntroduce>();
	
		for (int i = 0; i <3; i++) {
			OrderIntroduce order = new OrderIntroduce();
			order.setGoodsID(i+11);
			order.setDetailsID(i);
			order.setNum(i+1);
			if (i == 0) {
				order.setShopName( "丽江龙继斑鱼庄");
				order.setPrice( "68");
				order.setName("肯德基套餐15元");
				order.setTypeName("已退款");
				order.setGoodsImg("http://img.taobaocdn.com/bao/uploaded/i4/17106063041957283/TB2k9mpbpXXXXXIXpXXXXXXXXXX_!!160557106-0-rate.jpg");
			} else if (i == 1) {
				order.setShopName( "丽江龙继斑鱼庄");
				order.setPrice( "58");
				order.setName("肯德基套餐25元");
				order.setTypeName("未消费");
				order.setGoodsImg("http://img.taobaocdn.com/bao/uploaded/i4/17106063041957283/TB2k9mpbpXXXXXIXpXXXXXXXXXX_!!160557106-0-rate.jpg");
			} else if (i == 2) {
				order.setShopName( "肯德基KFC");
				order.setPrice( "28");
				order.setName("肯德基套餐12元");
				order.setTypeName("待评价");
				order.setGoodsImg("http://img.taobaocdn.com/bao/uploaded/i4/18180057890273054/TB2rpH0aVXXXXcAXXXXXXXXXXXX_!!100458180-0-rate.jpg");
			}
			orderList.add(order);
		}
		
		 HashMap<String, Object> temp = new HashMap<String, Object>(); 
		 temp.put("recordList", orderList);
		 temp.put("orderTime", "2015-01-21");
		 temp.put("orderTel", "13855117363");
		 temp.put("num", 6);
		 temp.put("price", "154");		 
		 
		 
		 HashMap<String, Object> map = new HashMap<String, Object>(); 
		 map.put("success", true);
		 map.put("content",temp);
		String json =JSON.toJSONString(map);
		return json;
	}
	
	
	public static String getOrdersDetail(int type) {
	
		List<Codes> orderList = new ArrayList<Codes>();
		for (int i = 0; i <2; i++) {
			Codes code = new Codes();
			code.setGoodsPassword("2568941255"+i);
			if(type==1){
				code.setStatus("已使用");
			}else  if(type==2){
				code.setStatus("未消费");
			}else  if(type==3){
				code.setStatus("已退款");
			}
			
			orderList.add(code);
		}
		
		 HashMap<String, Object> temp = new HashMap<String, Object>(); 
		 temp.put("orderTime", "2015-01-21");
		 temp.put("orderTel", "13855117363");
		 temp.put("num", 2);
		 temp.put("totalPrice", "170");		 
		 temp.put("name", "肯德基套餐12元");
		 temp.put("goodsImg", "http://img.taobaocdn.com/bao/uploaded/i4/18180057890273054/TB2rpH0aVXXXXcAXXXXXXXXXXXX_!!100458180-0-rate.jpg");
		 temp.put("des","肯德基KFC肯德基KFC");
		 temp.put("price", "235");
		 temp.put("discountPrice", "85");
		 temp.put("goodsEndTime", "2015-01-31");
		 temp.put("commentScore", 2);
		 temp.put("codes", orderList);
		 
		 HashMap<String, Object> map = new HashMap<String, Object>(); 
		 map.put("success", true);
		 map.put("content",temp);
		String json =JSON.toJSONString(map);
		return json;
	}
	
	
	//美食 1   酒店2  电影 3   休闲娱乐 4   生活服务  5   丽人 6   
	public static ArrayList<HashMap<String, String>> getHomePageList() {
		ArrayList<HashMap<String, String>> ret = new ArrayList<HashMap<String, String>>();
		HashMap<String, String> hm;
		for (int i = 0; i <6; i++) {
			hm = new HashMap<String, String>();
			if(i ==3){
				hm.put("type","休闲娱乐");
				hm.put("typeId","4");
			}
			if(i ==4){
				hm.put("type","生活服务");
				hm.put("typeId","5");
			}
			if(i ==5){
				hm.put("type","丽人");
				hm.put("typeId","6");
			}
			if (i ==0) {
				hm.put("type","美食");
				hm.put("typeId","1");
			} 
			if(i ==1) {
				hm.put("type","酒店");
				hm.put("typeId","2");
			}
			if(i ==2){
				hm.put("type","电影");
				hm.put("typeId","3");
			}
			
			ret.add(hm);
		}
		return ret;
	}


	public static ArrayList<HashMap<String, String>> getEvaluationList(int n) {
		ArrayList<HashMap<String, String>> ret = new ArrayList<HashMap<String, String>>();
		HashMap<String, String> hm;
		for (int i = 0; i < n; i++) {
			hm = new HashMap<String, String>();
			hm.put("nickname", "wzz_rj0902");
			hm.put("rating", "4.6");
			hm.put("date", "2014-08-28");
			hm.put("des", "运气很好，来拍照的那天，这家到了好多新款的衣服，都是全新的啊，哈哈哈，人品大爆发啊！！化妆师美眉给我推荐的这款古装特别喜欢，朋友说，够味道，哈哈哈哈哈哈！！！这里忍不住要嘚瑟一下，说说这次拍摄的感受吧，首先：地方还算比较好找，在步行街上，逛个街就直接到了，化妆的小美女，蛮热情的，技术也好，天气有点冷，给我倒茶送水的，拍摄全程照顾的我都有点不好意思了，摄影师废话不多，拍的很认真，感觉比较专业吧，全程消费金额也不多，选了那么多照片才600多，比我之前拍的几次都便宜，照片挺满意，几个朋友看了也说不错，唯一一点觉得不好，就是这家的档期有点难约到，拍的人比较多吧，提前两周才约到的，哎，没办法~下次春天了，我来拍套外景，哈哈！");		
			ret.add(hm);
		}
		return ret;
	}
	
	public static String getBanner(){
		List<Banner> bannerList=new ArrayList<Banner>();
		for(int i=0;i<4;i++){
				Banner  banner=new Banner();
				banner.setType(i);
				banner.setID(12+i);
				if(i%2==0){
					banner.setImg("http://img.taobaocdn.com/bao/uploaded/i4/18180057890273054/TB2rpH0aVXXXXcAXXXXXXXXXXXX_!!100458180-0-rate.jpg");
					banner.setPath("http://img.taobaocdn.com/bao/uploaded/i4/18180057890273054/TB2rpH0aVXXXXcAXXXXXXXXXXXX_!!100458180-0-rate.jpg");
				}else{
					banner.setImg("http://img.taobaocdn.com/bao/uploaded/i4/17106063041957283/TB2k9mpbpXXXXXIXpXXXXXXXXXX_!!160557106-0-rate.jpg");
					banner.setPath("http://img.taobaocdn.com/bao/uploaded/i4/17106063041957283/TB2k9mpbpXXXXXIXpXXXXXXXXXX_!!160557106-0-rate.jpg");
				}
				bannerList.add(banner);
		}
		
		 HashMap<String, Object> temp = new HashMap<String, Object>(); 
		 temp.put("recordList", bannerList);
		 
		 HashMap<String, Object> map = new HashMap<String, Object>(); 
		 map.put("success", true);
		 map.put("content",temp);
		String json =JSON.toJSONString(map);
		return json;
	}
	
	
	public static String getShopList(){
		List<Shop> shopList=new ArrayList<Shop>();
		for(int i=0;i<4;i++){
				Shop  shop=new Shop();
				shop.setShopID(i+11);
				if(i%2==0){
					shop.setImg("http://img.taobaocdn.com/bao/uploaded/i4/18180057890273054/TB2rpH0aVXXXXcAXXXXXXXXXXXX_!!100458180-0-rate.jpg");
				}else{
					shop.setImg("http://img.taobaocdn.com/bao/uploaded/i4/17106063041957283/TB2k9mpbpXXXXXIXpXXXXXXXXXX_!!160557106-0-rate.jpg");
				}
				shop.setShopName("达芙妮旗舰店");
				shop.setCommentNum(231);
				MyLocation lo=new MyLocation();
				lo.setLatitude(31.86);
				lo.setLongitude(117.27);
				shop.setLocation(lo);
				shop.setCommentScore(3.0f);
				shop.setType("鞋店");
				shop.setRegion("之心城");
				shopList.add(shop);
		}
		
		 HashMap<String, Object> temp = new HashMap<String, Object>(); 
		 temp.put("recordList", shopList);
		 temp.put("pageCount", 4);
		 
		 HashMap<String, Object> map = new HashMap<String, Object>(); 
		 map.put("success", true);
		 map.put("content",temp);
		String json =JSON.toJSONString(map);
		return json;
	}
	
	
	public static String getMembershipList(){
		List<MemberCard> shopList=new ArrayList<MemberCard>();
		for(int i=0;i<4;i++){
			MemberCard  member=new MemberCard();
			member.setCardID(7+i);
				if(i%2==0){
					member.setImg("http://img.taobaocdn.com/bao/uploaded/i4/18180057890273054/TB2rpH0aVXXXXcAXXXXXXXXXXXX_!!100458180-0-rate.jpg");
				}else{
					member.setImg("http://img.taobaocdn.com/bao/uploaded/i4/17106063041957283/TB2k9mpbpXXXXXIXpXXXXXXXXXX_!!160557106-0-rate.jpg");
				}
				member.setShopName("达芙妮旗舰店");
				member.setShopid(i+11);
				member.setGrowthValue("324");
				member.setLevel("VIP1/8.5折");
				member.setNumber("NO.1548697448"+i);
				shopList.add(member);
		}
		
		 HashMap<String, Object> temp = new HashMap<String, Object>(); 
		 temp.put("recordList", shopList);
		 temp.put("pageCount", 4);
		 
		 HashMap<String, Object> map = new HashMap<String, Object>(); 
		 map.put("success", true);
		 map.put("content",temp);
		String json =JSON.toJSONString(map);
		return json;
	}
	
	public static String getCategoryGoodsList(){
		List<Goods> shopList=new ArrayList<Goods>();
		for(int i=0;i<4;i++){
			Goods  goods=new Goods();
			goods.setGoodsID(i+11);
				if(i%2==0){
					goods.setShopImg("http://img.taobaocdn.com/bao/uploaded/i4/18180057890273054/TB2rpH0aVXXXXcAXXXXXXXXXXXX_!!100458180-0-rate.jpg");
				}else{
					goods.setShopImg("http://img.taobaocdn.com/bao/uploaded/i4/17106063041957283/TB2k9mpbpXXXXXIXpXXXXXXXXXX_!!160557106-0-rate.jpg");
				}
				goods.setName("水果旗舰店");
				MyLocation lo=new MyLocation();
				lo.setLatitude(31.86);
				lo.setLongitude(117.27);
				goods.setLocation(lo);
				goods.setDes("仅售39.9元！价值136元的双人套餐，有赠品，提供免费WiFi。");
				goods.setDiscountPrice("21");
				goods.setPrice("53");
				goods.setSalesNum(256);
				goods.setCommentScore(3.0f);
				shopList.add(goods);
		}
		
		 HashMap<String, Object> temp = new HashMap<String, Object>(); 
		 temp.put("recordList", shopList);
		 temp.put("pageCount", 4);
		 
		 HashMap<String, Object> map = new HashMap<String, Object>(); 
		 map.put("success", true);
		 map.put("content",temp);
		String json =JSON.toJSONString(map);
		return json;
	}
	
	public static String getGoodsList(){
		List<Goods> shopList=new ArrayList<Goods>();
		for(int i=0;i<4;i++){
			Goods  goods=new Goods();
			goods.setGoodsID(i+11);
				if(i%2==0){
					goods.setShopImg("http://img.taobaocdn.com/bao/uploaded/i4/18180057890273054/TB2rpH0aVXXXXcAXXXXXXXXXXXX_!!100458180-0-rate.jpg");
				}else{
					goods.setShopImg("http://img.taobaocdn.com/bao/uploaded/i4/17106063041957283/TB2k9mpbpXXXXXIXpXXXXXXXXXX_!!160557106-0-rate.jpg");
				}
				goods.setName("水果旗舰店");
				MyLocation lo=new MyLocation();
				lo.setLatitude(31.86);
				lo.setLongitude(117.27);
				goods.setLocation(lo);
				goods.setDes("仅售39.9元！价值136元的双人套餐，有赠品，提供免费WiFi。");
				goods.setDiscountPrice("21");
				goods.setPrice("53");
				goods.setSalesNum(256);
				goods.setCommentScore(3.0f);
				shopList.add(goods);
		}
		
		List<AlbumImage> images=new ArrayList<AlbumImage>();
		for(int i=0;i<6;i++){
			AlbumImage img=new AlbumImage();
			if(i%2==0){
				img.setTitle(i+1+"石榴很好，又红又甜");
				img.setImgurl("http://img.taobaocdn.com/bao/uploaded/i4/18180057890273054/TB2rpH0aVXXXXcAXXXXXXXXXXXX_!!100458180-0-rate.jpg");
			}else{
				img.setTitle(i+1+"橙子味道很好，很满意");
				img.setImgurl("http://img.taobaocdn.com/bao/uploaded/i4/17106063041957283/TB2k9mpbpXXXXXIXpXXXXXXXXXX_!!160557106-0-rate.jpg");
			}
			img.setID(i);
			images.add(img);
		}
		 HashMap<String, Object> temp = new HashMap<String, Object>(); 
		 temp.put("otherGoodsList", shopList);
		 temp.put("name", "蜀味香火锅");
		 temp.put("commentScore", 4.5f);
		 temp.put("commentNum", 425);
		 temp.put("tel", "13855117363");
		 temp.put("address", "瑶海区站西路与北一环交口向北100米新亚汽车站斜对面");
		 temp.put("evaluationNum", 362);
		 temp.put("imgs", images);
		 temp.put("isBookmark", 1);
		 temp.put("pageCount", 4);
		 
		 HashMap<String, Object> map = new HashMap<String, Object>(); 
		 map.put("success", true);
		 map.put("content",temp);
		String json =JSON.toJSONString(map);
		return json;
	}
	
	
	public static String getOtherGoodsList(){
		List<Goods> shopList=new ArrayList<Goods>();
		for(int i=0;i<4;i++){
			Goods  goods=new Goods();
			goods.setGoodsID(i+11);
				if(i%2==0){
					goods.setShopImg("http://img.taobaocdn.com/bao/uploaded/i4/18180057890273054/TB2rpH0aVXXXXcAXXXXXXXXXXXX_!!100458180-0-rate.jpg");
				}else{
					goods.setShopImg("http://img.taobaocdn.com/bao/uploaded/i4/17106063041957283/TB2k9mpbpXXXXXIXpXXXXXXXXXX_!!160557106-0-rate.jpg");
				}
				goods.setName("水果旗舰店");
				MyLocation lo=new MyLocation();
				lo.setLatitude(31.86);
				lo.setLongitude(117.27);
				goods.setLocation(lo);
				goods.setDes("仅售39.9元！价值136元的双人套餐，有赠品，提供免费WiFi。");
				goods.setDiscountPrice("21");
				goods.setPrice("53");
				goods.setSalesNum(256);
				goods.setCommentScore(3.0f);
				shopList.add(goods);
		}
		
		List<AlbumImage> images=new ArrayList<AlbumImage>();
		for(int i=0;i<6;i++){
			AlbumImage img=new AlbumImage();
			if(i%2==0){
				img.setTitle(i+1+"石榴很好，又红又甜");
				img.setImgurl("http://img.taobaocdn.com/bao/uploaded/i4/18180057890273054/TB2rpH0aVXXXXcAXXXXXXXXXXXX_!!100458180-0-rate.jpg");
			}else{
				img.setTitle(i+1+"橙子味道很好，很满意");
				img.setImgurl("http://img.taobaocdn.com/bao/uploaded/i4/17106063041957283/TB2k9mpbpXXXXXIXpXXXXXXXXXX_!!160557106-0-rate.jpg");
			}
			img.setID(i);
			images.add(img);
		}
		 HashMap<String, Object> temp = new HashMap<String, Object>(); 
		 temp.put("goodsList", shopList);
		 temp.put("name", "蜀留香自助火锅");
		 temp.put("introduction", "蜀留香自助火锅位于三里庵商圈紧邻国购广场和之心城大洋百货，交通便利，无限量的上等食材，醇正的口味，嗨动全城！蜀留香采用正宗川味麻辣锅底，百余种菜品供您自由选择搭配。优质肉类、上等海味，珍馐美味，新鲜食材、营养丰富，水果、饮料、冰淇淋免费畅享。自酿啤酒，德式工艺，杀口力强，让您超值享受！愿您吃的痛快，喝的爽快。");
		 temp.put("commentScore", 4.5f);
		 temp.put("commentNum", 425);
		 temp.put("tel", "13855117363");
		 MyLocation lo=new MyLocation();
		lo.setLatitude(31.86);
		lo.setLongitude(117.27);
		 temp.put("location",lo);
		 temp.put("price", 268);
		 temp.put("discountPrice", 108);
		 temp.put("address", "瑶海区站西路与北一环交口向北100米新亚汽车站斜对面");
		 temp.put("imgs", images);
		 temp.put("pageCount", 4);
		 temp.put("buyNotice", " 周末、法定节假日通用"+
"\u0009使用时间：09:00-21:00\u0009预约提醒：电话预约，请至少提前24小时致电商家预约，预约逾期不保留\u0009使用规则：每张美团券限制2人入镜，不允许超出人数限制\u0009本单需一次性拍摄完成"+
"\u0009美团券密码一旦验证即代表消费成功，不可申请“随时退款”和“过期退款”，请您合理安排验证时间"+
"\u0009特别提醒：为了保证您的权益，请选择美团网线上支付，用户与美团以外的任何第三方发生的交易行为如出现问题，美团网都不承担责任，谢谢您的理解与支持！");
		 
		 
		 HashMap<String, Object> map = new HashMap<String, Object>(); 
		 map.put("success", true);
		 map.put("content",temp);
		String json =JSON.toJSONString(map);
		return json;
	}
	
	
		public static String getNoticeList() {
			List<Notice> noticeList=new ArrayList<Notice>();
			for(int i=0;i<4;i++){
				Notice  notice=new Notice();
					notice.setID(i+11);
					notice.setContent("您收藏过的《0048》香辣虾3-4人餐又开团了，去看看吧！");
					notice.setTime("2014-09-04");
					noticeList.add(notice);
			}
			
			 HashMap<String, Object> temp = new HashMap<String, Object>(); 
			 temp.put("recordList", null);
			 temp.put("pageCount", 4);
			 
			 HashMap<String, Object> map = new HashMap<String, Object>(); 
			 map.put("success", true);
			 map.put("content",temp);
			String json =JSON.toJSONString(map);
			return json;
	}
		
		public static String delNoticeList() {
		
			 HashMap<String, Object> temp = new HashMap<String, Object>(); 
			 temp.put("result", true);
			 temp.put("message", "消息清空成功！");
			 
			 HashMap<String, Object> map = new HashMap<String, Object>(); 
			 map.put("success", true);
			 map.put("content",temp);
			String json =JSON.toJSONString(map);
			return json;
	}
	
}

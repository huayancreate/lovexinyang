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
				 cate.setCategoryName("��ʳ");
				 cate.setParentCategoryId(0);
			 }else if(i%3==1){
				 cate.setCategoryName("���");
				 cate.setParentCategoryId(1);
			 }else if(i%3==2){
				 cate.setCategoryName("������");
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
			reg.setName("�Ϸ�");
			for (int j = 0; j < 5; j++) {
				Counties cou = new Counties();
				if (j == 1) {
					cou.setName("������");
				} else if (j == 2) {
					cou.setName("��ɽ��");
				} else if (j == 3) {
					cou.setName("������");
				} else if (j == 4) {
					cou.setName("®����");
				}
				for (int k = 0; k < 5; k++) {
					Business bus = new Business();
					if (k == 1) {
						bus.setName("�пƴ�");
					} else if (k == 2) {
						bus.setName("������");
					} else if (k == 3) {
						bus.setName("��Ǳ����");
					} else if (k == 4) {
						bus.setName("����㳡");
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
			order.setName( "�������̰���ׯ");
			order.setPrice( "68");
			order.setUnitPrice("34");
			order.setNum(i+1);
			order.setCommentScore(2);
			
			
			if(type==0){
				if (i % 6 == 0) {
					order.setIsBookmark(0);
					order.setGoodsImg("http://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXhttp://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXXXchXXXXXXXXXXXX_!!16336700-0-rate.jpgXXchXXXXXXXXXXXX_!!16336700-0-rate.jpg");
					order.setTypeName("������");
				} else if(i % 6 == 1) {
					order.setIsBookmark(1);
					order.setGoodsImg("http://img.taobaocdn.com/bao/uploaded/i2/18783042962806492/TB2HqSYXVXXXXXDXXXXXXXXXXXX_!!1060668783-0-rate.jpg");
					order.setTypeName("������");
				}else if(i % 6 == 2) {
					order.setIsBookmark(0);
					order.setGoodsImg("http://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXhttp://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXXXchXXXXXXXXXXXX_!!16336700-0-rate.jpgXXchXXXXXXXXXXXX_!!16336700-0-rate.jpg");
					order.setTypeName("������");
				}else if(i % 6 == 3) {
					order.setIsBookmark(0);
					order.setGoodsImg("http://img.taobaocdn.com/bao/uploaded/i2/18783042962806492/TB2HqSYXVXXXXXDXXXXXXXXXXXX_!!1060668783-0-rate.jpg");
					order.setTypeName("���˿�");
				}else if(i % 6 == 4) {
					order.setIsBookmark(1);
					order.setGoodsImg("http://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXhttp://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXXXchXXXXXXXXXXXX_!!16336700-0-rate.jpgXXchXXXXXXXXXXXX_!!16336700-0-rate.jpg");
					order.setTypeName("δ����");
				}else if(i%6==5){
					order.setIsBookmark(0);
					order.setGoodsImg("http://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXhttp://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXXXchXXXXXXXXXXXX_!!16336700-0-rate.jpgXXchXXXXXXXXXXXX_!!16336700-0-rate.jpg");
					order.setTypeName("�˿���");
				}
			}else if(type==1){
				order.setIsBookmark(0);
				order.setGoodsImg("http://img.taobaocdn.com/bao/uploaded/i2/18783042962806492/TB2HqSYXVXXXXXDXXXXXXXXXXXX_!!1060668783-0-rate.jpg");
				order.setTypeName("������");
			}else if(type==2){
				order.setIsBookmark(1);
				order.setGoodsImg("http://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXhttp://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXXXchXXXXXXXXXXXX_!!16336700-0-rate.jpgXXchXXXXXXXXXXXX_!!16336700-0-rate.jpg");
				order.setTypeName("δ����");
			}else if(type==3){
				order.setIsBookmark(0);
				order.setGoodsImg("http://img.taobaocdn.com/bao/uploaded/i2/18783042962806492/TB2HqSYXVXXXXXDXXXXXXXXXXXX_!!1060668783-0-rate.jpg");
				order.setTypeName("������");
			}else if(type==4){
				if(i%2==0){
					order.setIsBookmark(1);
					order.setGoodsImg("http://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXhttp://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXXXchXXXXXXXXXXXX_!!16336700-0-rate.jpgXXchXXXXXXXXXXXX_!!16336700-0-rate.jpg");
					order.setTypeName("���˿�");
				}else if(i%2==1){
					order.setIsBookmark(0);
					order.setGoodsImg("http://img.taobaocdn.com/bao/uploaded/i2/18783042962806492/TB2HqSYXVXXXXXDXXXXXXXXXXXX_!!1060668783-0-rate.jpg");
					order.setTypeName("�˿���");
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
				order.setShopName( "�������̰���ׯ");
				order.setPrice( "68");
				order.setName("�ϵ»��ײ�15Ԫ");
				order.setTypeName("���˿�");
				order.setGoodsImg("http://img.taobaocdn.com/bao/uploaded/i4/17106063041957283/TB2k9mpbpXXXXXIXpXXXXXXXXXX_!!160557106-0-rate.jpg");
			} else if (i == 1) {
				order.setShopName( "�������̰���ׯ");
				order.setPrice( "58");
				order.setName("�ϵ»��ײ�25Ԫ");
				order.setTypeName("δ����");
				order.setGoodsImg("http://img.taobaocdn.com/bao/uploaded/i4/17106063041957283/TB2k9mpbpXXXXXIXpXXXXXXXXXX_!!160557106-0-rate.jpg");
			} else if (i == 2) {
				order.setShopName( "�ϵ»�KFC");
				order.setPrice( "28");
				order.setName("�ϵ»��ײ�12Ԫ");
				order.setTypeName("������");
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
				code.setStatus("��ʹ��");
			}else  if(type==2){
				code.setStatus("δ����");
			}else  if(type==3){
				code.setStatus("���˿�");
			}
			
			orderList.add(code);
		}
		
		 HashMap<String, Object> temp = new HashMap<String, Object>(); 
		 temp.put("orderTime", "2015-01-21");
		 temp.put("orderTel", "13855117363");
		 temp.put("num", 2);
		 temp.put("totalPrice", "170");		 
		 temp.put("name", "�ϵ»��ײ�12Ԫ");
		 temp.put("goodsImg", "http://img.taobaocdn.com/bao/uploaded/i4/18180057890273054/TB2rpH0aVXXXXcAXXXXXXXXXXXX_!!100458180-0-rate.jpg");
		 temp.put("des","�ϵ»�KFC�ϵ»�KFC");
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
	
	
	//��ʳ 1   �Ƶ�2  ��Ӱ 3   �������� 4   �������  5   ���� 6   
	public static ArrayList<HashMap<String, String>> getHomePageList() {
		ArrayList<HashMap<String, String>> ret = new ArrayList<HashMap<String, String>>();
		HashMap<String, String> hm;
		for (int i = 0; i <6; i++) {
			hm = new HashMap<String, String>();
			if(i ==3){
				hm.put("type","��������");
				hm.put("typeId","4");
			}
			if(i ==4){
				hm.put("type","�������");
				hm.put("typeId","5");
			}
			if(i ==5){
				hm.put("type","����");
				hm.put("typeId","6");
			}
			if (i ==0) {
				hm.put("type","��ʳ");
				hm.put("typeId","1");
			} 
			if(i ==1) {
				hm.put("type","�Ƶ�");
				hm.put("typeId","2");
			}
			if(i ==2){
				hm.put("type","��Ӱ");
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
			hm.put("des", "�����ܺã������յ����죬��ҵ��˺ö��¿���·�������ȫ�µİ�������������Ʒ�󱬷���������ױʦ��ü�����Ƽ�������װ�ر�ϲ��������˵����ζ���������������������������̲�סҪ�Nɪһ�£�˵˵�������ĸ��ܰɣ����ȣ��ط�����ȽϺ��ң��ڲ��н��ϣ�����־�ֱ�ӵ��ˣ���ױ��С��Ů��������ģ�����Ҳ�ã������е��䣬���ҵ�����ˮ�ģ�����ȫ���չ˵��Ҷ��е㲻����˼�ˣ���Ӱʦ�ϻ����࣬�ĵĺ����棬�о��Ƚ�רҵ�ɣ�ȫ�����ѽ��Ҳ���࣬ѡ����ô����Ƭ��600�࣬����֮ǰ�ĵļ��ζ����ˣ���Ƭͦ���⣬�������ѿ���Ҳ˵����Ψһһ����ò��ã�������ҵĵ����е���Լ�����ĵ��˱Ƚ϶�ɣ���ǰ���ܲ�Լ���ģ�����û�취~�´δ����ˣ����������⾰��������");		
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
				shop.setShopName("��ܽ���콢��");
				shop.setCommentNum(231);
				MyLocation lo=new MyLocation();
				lo.setLatitude(31.86);
				lo.setLongitude(117.27);
				shop.setLocation(lo);
				shop.setCommentScore(3.0f);
				shop.setType("Ь��");
				shop.setRegion("֮�ĳ�");
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
				member.setShopName("��ܽ���콢��");
				member.setShopid(i+11);
				member.setGrowthValue("324");
				member.setLevel("VIP1/8.5��");
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
				goods.setName("ˮ���콢��");
				MyLocation lo=new MyLocation();
				lo.setLatitude(31.86);
				lo.setLongitude(117.27);
				goods.setLocation(lo);
				goods.setDes("����39.9Ԫ����ֵ136Ԫ��˫���ײͣ�����Ʒ���ṩ���WiFi��");
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
				goods.setName("ˮ���콢��");
				MyLocation lo=new MyLocation();
				lo.setLatitude(31.86);
				lo.setLongitude(117.27);
				goods.setLocation(lo);
				goods.setDes("����39.9Ԫ����ֵ136Ԫ��˫���ײͣ�����Ʒ���ṩ���WiFi��");
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
				img.setTitle(i+1+"ʯ��ܺã��ֺ�����");
				img.setImgurl("http://img.taobaocdn.com/bao/uploaded/i4/18180057890273054/TB2rpH0aVXXXXcAXXXXXXXXXXXX_!!100458180-0-rate.jpg");
			}else{
				img.setTitle(i+1+"����ζ���ܺã�������");
				img.setImgurl("http://img.taobaocdn.com/bao/uploaded/i4/17106063041957283/TB2k9mpbpXXXXXIXpXXXXXXXXXX_!!160557106-0-rate.jpg");
			}
			img.setID(i);
			images.add(img);
		}
		 HashMap<String, Object> temp = new HashMap<String, Object>(); 
		 temp.put("otherGoodsList", shopList);
		 temp.put("name", "��ζ����");
		 temp.put("commentScore", 4.5f);
		 temp.put("commentNum", 425);
		 temp.put("tel", "13855117363");
		 temp.put("address", "������վ��·�뱱һ��������100����������վб����");
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
				goods.setName("ˮ���콢��");
				MyLocation lo=new MyLocation();
				lo.setLatitude(31.86);
				lo.setLongitude(117.27);
				goods.setLocation(lo);
				goods.setDes("����39.9Ԫ����ֵ136Ԫ��˫���ײͣ�����Ʒ���ṩ���WiFi��");
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
				img.setTitle(i+1+"ʯ��ܺã��ֺ�����");
				img.setImgurl("http://img.taobaocdn.com/bao/uploaded/i4/18180057890273054/TB2rpH0aVXXXXcAXXXXXXXXXXXX_!!100458180-0-rate.jpg");
			}else{
				img.setTitle(i+1+"����ζ���ܺã�������");
				img.setImgurl("http://img.taobaocdn.com/bao/uploaded/i4/17106063041957283/TB2k9mpbpXXXXXIXpXXXXXXXXXX_!!160557106-0-rate.jpg");
			}
			img.setID(i);
			images.add(img);
		}
		 HashMap<String, Object> temp = new HashMap<String, Object>(); 
		 temp.put("goodsList", shopList);
		 temp.put("name", "�������������");
		 temp.put("introduction", "�������������λ����������Ȧ���ڹ����㳡��֮�ĳǴ���ٻ�����ͨ���������������ϵ�ʳ�ģ������Ŀ�ζ���˶�ȫ�ǣ�������������ڴ�ζ�������ף������ֲ�Ʒ��������ѡ����䡣�������ࡢ�ϵȺ�ζ��������ζ������ʳ�ġ�Ӫ���ḻ��ˮ�������ϡ��������ѳ�������ơ�ƣ���ʽ���գ�ɱ����ǿ��������ֵ���ܣ�Ը���Ե�ʹ�죬�ȵ�ˬ�졣");
		 temp.put("commentScore", 4.5f);
		 temp.put("commentNum", 425);
		 temp.put("tel", "13855117363");
		 MyLocation lo=new MyLocation();
		lo.setLatitude(31.86);
		lo.setLongitude(117.27);
		 temp.put("location",lo);
		 temp.put("price", 268);
		 temp.put("discountPrice", 108);
		 temp.put("address", "������վ��·�뱱һ��������100����������վб����");
		 temp.put("imgs", images);
		 temp.put("pageCount", 4);
		 temp.put("buyNotice", " ��ĩ�������ڼ���ͨ��"+
"\u0009ʹ��ʱ�䣺09:00-21:00\u0009ԤԼ���ѣ��绰ԤԼ����������ǰ24Сʱ�µ��̼�ԤԼ��ԤԼ���ڲ�����\u0009ʹ�ù���ÿ������ȯ����2���뾵������������������\u0009������һ�����������"+
"\u0009����ȯ����һ����֤���������ѳɹ����������롰��ʱ�˿�͡������˿��������������֤ʱ��"+
"\u0009�ر����ѣ�Ϊ�˱�֤����Ȩ�棬��ѡ������������֧�����û�������������κε����������Ľ�����Ϊ��������⣬�����������е����Σ�лл���������֧�֣�");
		 
		 
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
					notice.setContent("���ղع��ġ�0048������Ϻ3-4�˲��ֿ����ˣ�ȥ�����ɣ�");
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
			 temp.put("message", "��Ϣ��ճɹ���");
			 
			 HashMap<String, Object> map = new HashMap<String, Object>(); 
			 map.put("success", true);
			 map.put("content",temp);
			String json =JSON.toJSONString(map);
			return json;
	}
	
}

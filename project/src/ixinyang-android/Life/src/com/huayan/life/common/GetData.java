package com.huayan.life.common;

import java.util.ArrayList;
import java.util.HashMap;

public class GetData {

	public static ArrayList<HashMap<String, String>> getSimulationNews(int n) {
		ArrayList<HashMap<String, String>> ret = new ArrayList<HashMap<String, String>>();
		HashMap<String, String> hm;
		for (int i = 0; i < n; i++) {
			hm = new HashMap<String, String>();
			if (i % 2 == 0) {
				hm.put("uri",
						"http://images.china.cn/attachement/jpg/site1000/20131029/001fd04cfc4813d9af0118.jpg");
			} else {
				hm.put("uri",
						"http://photocdn.sohu.com/20131101/Img389373139.jpg");
			}
			hm.put("title", "国内成品油价两连跌几成定局");
			hm.put("content", "国内成品油今日迎调价窗口，机构预计每升降价0.1元。");
			hm.put("review", i + "跟帖");
			ret.add(hm);
		}
		return ret;
	}

	public static ArrayList<HashMap<String, String>> getLuckDraw(int n) {
		ArrayList<HashMap<String, String>> ret = new ArrayList<HashMap<String, String>>();
		HashMap<String, String> hm;
		for (int i = 0; i < n; i++) {
			hm = new HashMap<String, String>();
			if (i % 2 == 0) {
				hm.put("uri",
						"http://img.taobaocdn.com/bao/uploaded/i1/15700043372811105/TB2sI9VXVXXhttp://img.taobaocdn.com/bao/uploaded/i1/15700043372811105/TB2sI9VXVXXXXchXXXXXXXXXXXX_!!15335700-0-rate.jpgXXchXXXXXXXXXXXX_!!15335700-0-rate.jpg");

			} else {
				hm.put("uri",
						"http://img.taobaocdn.com/bao/uploaded/i2/18783042962806492/TB2HqSYXVXXXXXDXXXXXXXXXXXX_!!1060568783-0-rate.jpg");
			}
			hm.put("title", "全新iPad mini");
			hm.put("time", "抽奖时间：2014-07-25");
			hm.put("num", "抽奖号：6207" + i);
			ret.add(hm);
		}
		return ret;
	}

	public static ArrayList<HashMap<String, String>> getNearList(int n) {
		ArrayList<HashMap<String, String>> ret = new ArrayList<HashMap<String, String>>();
		HashMap<String, String> hm;
		for (int i = 0; i < n; i++) {
			hm = new HashMap<String, String>();
			if (i % 2 == 0) {
				hm.put("path",
						"http://img.taobaocdn.com/bao/uploaded/i1/15700043372811105/TB2sI9VXVXXXXchXXXXXXXXXXXX_!!15335700-0-rate.jpg");

			} else {
				hm.put("path",
						"http://img.taobaocdn.com/bao/uploaded/i2/18783042962806492/TB2HqSYXVXXXXXDXXXXXXXXXXXX_!!1060568783-0-rate.jpg");
			}
			hm.put("tit", "金仕堡健身会所金仕堡健身会所");
			hm.put("descr", "瑶海区长江东路1137号圣大国际商贸中心708.709室");
			hm.put("near", "1.5km");
			hm.put("price", "98");
			hm.put("oldPrice", "289");
			hm.put("fen", "4.8分");
			hm.put("pingjia", "712");
			ret.add(hm);
		}
		return ret;
	}

	public static ArrayList<HashMap<String, String>> getRecommendList(int n) {
		ArrayList<HashMap<String, String>> ret = new ArrayList<HashMap<String, String>>();
		HashMap<String, String> hm;
		for (int i = 0; i < n; i++) {
			hm = new HashMap<String, String>();
			if (i % 2 == 0) {
				hm.put("path",
						"http://img.taobaocdn.com/bao/uploaded/i1/15700043372811105/TB2sI9VXVXXXXchXXXXXXXXXXXX_!!15335700-0-rate.jpg");

			} else {
				hm.put("path",
						"http://img.taobaocdn.com/bao/uploaded/i2/18783042962806492/TB2HqSYXVXXXXXDXXXXXXXXXXXX_!!1060568783-0-rate.jpg");
			}
			hm.put("tit", "金仕堡健身会所");
			hm.put("descr", "瑶海区长江东路1137号圣大国际商贸中心708.709室");
			hm.put("near", "3.2km");
			hm.put("price", "98");
			hm.put("oldPrice", "289元");
			hm.put("yishou", "421");
			ret.add(hm);
		}
		return ret;
	}
	

	public static ArrayList<HashMap<String, String>> getHomePageList(int n) {
		ArrayList<HashMap<String, String>> ret = new ArrayList<HashMap<String, String>>();
		HashMap<String, String> hm;
		for (int i = 0; i < n; i++) {
			hm = new HashMap<String, String>();
			if (i % 3==2) {
				hm.put("type","美食");
			} else if(i % 3==1) {
				hm.put("type","酒店");
			}else{
				hm.put("type","门票");
			}
			ret.add(hm);
		}
		return ret;
	}

	public static ArrayList<HashMap<String, String>> getStoreList(int n) {
		ArrayList<HashMap<String, String>> ret = new ArrayList<HashMap<String, String>>();
		HashMap<String, String> hm;
		for (int i = 0; i < n; i++) {
			hm = new HashMap<String, String>();
			if (i % 2 == 0) {
				hm.put("uri",
						"http://img.taobaocdn.com/bao/uploaded/i1/15700043372811105/TB2sI9VXVXXXXchXXXXXXXXXXXX_!!15335700-0-rate.jpg");

			} else {
				hm.put("uri",
						"http://img.taobaocdn.com/bao/uploaded/i2/18783042962806492/TB2HqSYXVXXXXXDXXXXXXXXXXXX_!!1060568783-0-rate.jpg");
			}
			hm.put("ping", "116评价");
			hm.put("title1", "苹果专卖店");
			hm.put("rab", "3");
			hm.put("cate", "数码产品");
			hm.put("qu", "宿州路");
			hm.put("ju", "4.8km");
			ret.add(hm);
		}
		return ret;
	}

	public static ArrayList<HashMap<String, String>> getVoucherList(int n) {
		ArrayList<HashMap<String, String>> ret = new ArrayList<HashMap<String, String>>();
		HashMap<String, String> hm;
		for (int i = 0; i < n; i++) {
			hm = new HashMap<String, String>();
			hm.put("title", "团购客户端收购代金券");
			hm.put("mian", "￥５");
			hm.put("pwd", "密码：821850153245");
			hm.put("conditions", "满38元可用，限手机客户端使用");
			hm.put("time", "还有7天过期");
			hm.put("validity", "有效期至2014-08-19");
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
			hm.put("rating", "4.5");
			hm.put("date", "2014-08-28");
			hm.put("des", "门店服务还不错，下次还来光顾，满38元可用，限手机客户端使用。瑶海区长江东路1137号圣大国际商贸中心708.709室");
			ret.add(hm);
		}
		return ret;
	}
	
	public static ArrayList<HashMap<String, String>> getGroupPurchase(int n) {
		ArrayList<HashMap<String, String>> ret = new ArrayList<HashMap<String, String>>();
		HashMap<String, String> hm;
		for (int i = 0; i < n; i++) {
			hm = new HashMap<String, String>();
			hm.put("title", "【瑶海区】长江东路1137号圣大国际商贸中心708.709室");
			hm.put("price", "98元");
			hm.put("oldprice", "258元");
			ret.add(hm);
		}
		return ret;
	}
	
	public static ArrayList<HashMap<String, String>> getMembershipCard(int n) {
		ArrayList<HashMap<String, String>> ret = new ArrayList<HashMap<String, String>>();
		HashMap<String, String> hm;
		for (int i = 0; i < n; i++) {
			hm = new HashMap<String, String>();
			if (i % 2 == 0) {
				hm.put("path",
						"http://img.taobaocdn.com/bao/uploaded/i1/15700043372811105/TB2sI9VXVXXXXchXXXXXXXXXXXX_!!15335700-0-rate.jpg");
			} else {
				hm.put("path",
						"http://img.taobaocdn.com/bao/uploaded/i2/18783042962806492/TB2HqSYXVXXXXXDXXXXXXXXXXXX_!!1060568783-0-rate.jpg");
			}
			hm.put("title", "爱时尚生活包铺");
			hm.put("number", "NO.153006790799"+i);
			hm.put("discount", "全店9.5折");
			ret.add(hm);
		}
		return ret;
	}
	
	public static ArrayList<HashMap<String, String>> getNoticeList(int n) {
		ArrayList<HashMap<String, String>> ret = new ArrayList<HashMap<String, String>>();
		HashMap<String, String> hm;
		for (int i = 0; i < n; i++) {
			hm = new HashMap<String, String>();
			hm.put("title", "您收藏过的《0048》香辣虾3-4人餐又开团了，去看看吧！");
			hm.put("time", "2014-09-04");
			ret.add(hm);
		}
		return ret;
	}
	
}

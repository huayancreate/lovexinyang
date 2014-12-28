package com.huayan.life.common;

import java.util.ArrayList;
import java.util.HashMap;

public class GetData {

	public static ArrayList<HashMap<String, String>> getOrders(int n,int type) {
		ArrayList<HashMap<String, String>> ret = new ArrayList<HashMap<String, String>>();
		HashMap<String, String> hm;
		for (int i = 0; i < n; i++) {
			hm = new HashMap<String, String>();
			hm.put("title", "丽江龙继斑鱼庄");
			hm.put("price", "68元");
			hm.put("num", i+1+"" );
			hm.put("score", "2分");
			if(type==0){
				if (i % 6 == 0) {
					hm.put("uri",
							"http://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXhttp://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXXXchXXXXXXXXXXXX_!!16336700-0-rate.jpgXXchXXXXXXXXXXXX_!!16336700-0-rate.jpg");
					hm.put("cate", "待付款");
				} else if(i % 6 == 1) {
					hm.put("uri",
							"http://img.taobaocdn.com/bao/uploaded/i2/18783042962806492/TB2HqSYXVXXXXXDXXXXXXXXXXXX_!!1060668783-0-rate.jpg");
					hm.put("cate", "已评价");
				}else if(i % 6 == 2) {
					hm.put("uri",
							"http://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXhttp://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXXXchXXXXXXXXXXXX_!!16336700-0-rate.jpgXXchXXXXXXXXXXXX_!!16336700-0-rate.jpg");
					hm.put("cate", "待评价");
				}else if(i % 6 == 3) {
					hm.put("uri",
							"http://img.taobaocdn.com/bao/uploaded/i2/18783042962806492/TB2HqSYXVXXXXXDXXXXXXXXXXXX_!!1060668783-0-rate.jpg");
					hm.put("cate", "已退款");
				}else if(i % 6 == 4) {
					hm.put("uri",
							"http://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXhttp://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXXXchXXXXXXXXXXXX_!!16336700-0-rate.jpgXXchXXXXXXXXXXXX_!!16336700-0-rate.jpg");
					hm.put("cate", "未消费");
				}else if(i%6==5){
					hm.put("uri",
							"http://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXhttp://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXXXchXXXXXXXXXXXX_!!16336700-0-rate.jpgXXchXXXXXXXXXXXX_!!16336700-0-rate.jpg");
					hm.put("cate", "退款中");
				}
			}else if(type==1){
				hm.put("uri",
						"http://img.taobaocdn.com/bao/uploaded/i2/18783042962806492/TB2HqSYXVXXXXXDXXXXXXXXXXXX_!!1060668783-0-rate.jpg");
				hm.put("cate", "待付款");
			}else if(type==2){
				hm.put("uri","http://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXhttp://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXXXchXXXXXXXXXXXX_!!16336700-0-rate.jpgXXchXXXXXXXXXXXX_!!16336700-0-rate.jpg");
				hm.put("cate", "未消费");
			}else if(type==3){
				hm.put("uri",
						"http://img.taobaocdn.com/bao/uploaded/i2/18783042962806492/TB2HqSYXVXXXXXDXXXXXXXXXXXX_!!1060668783-0-rate.jpg");
				hm.put("cate", "待评价");
			}else if(type==4){
				if(i%2==0){
					hm.put("uri","http://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXhttp://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXXXchXXXXXXXXXXXX_!!16336700-0-rate.jpgXXchXXXXXXXXXXXX_!!16336700-0-rate.jpg");
					hm.put("cate", "已退款");
				}else if(i%2==1){
					hm.put("uri",
							"http://img.taobaocdn.com/bao/uploaded/i2/18783042962806492/TB2HqSYXVXXXXXDXXXXXXXXXXXX_!!1060668783-0-rate.jpg");
					hm.put("cate", "退款中");
				}
			}
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
						"http://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXhttp://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXXXchXXXXXXXXXXXX_!!16336700-0-rate.jpgXXchXXXXXXXXXXXX_!!16336700-0-rate.jpg");

			} else {
				hm.put("uri",
						"http://img.taobaocdn.com/bao/uploaded/i2/18783042962806492/TB2HqSYXVXXXXXDXXXXXXXXXXXX_!!1060668783-0-rate.jpg");
			}
			hm.put("title", "全新iPad mini");
			hm.put("time", "抽奖时间：2014-07-26");
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
						"http://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXXXchXXXXXXXXXXXX_!!16336700-0-rate.jpg");

			} else {
				hm.put("path",
						"http://img.taobaocdn.com/bao/uploaded/i2/18783042962806492/TB2HqSYXVXXXXXDXXXXXXXXXXXX_!!1060668783-0-rate.jpg");
			}
			hm.put("tit", "金仕堡健身会所金仕堡健身会所");
			hm.put("descr", "瑶海区长江东路1137号圣大国际商贸中心708.709室");
			hm.put("near", "1.6km");
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
			hm.put("yishou", i +"");
			if (i % 2 == 0) {
				hm.put("path",
						"http://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXXXchXXXXXXXXXXXX_!!16336700-0-rate.jpg");

			} else {
				hm.put("path",
						"http://img.taobaocdn.com/bao/uploaded/i2/18783042962806492/TB2HqSYXVXXXXXDXXXXXXXXXXXX_!!1060668783-0-rate.jpg");
			}
			hm.put("tit", "金仕堡健身会所");
			hm.put("descr", "瑶海区长江东路1137号圣大国际商贸中心708.709室");
			hm.put("near", "3.2km");
			hm.put("price", "98");
			hm.put("oldPrice", "289元");
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
						"http://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXXXchXXXXXXXXXXXX_!!16336700-0-rate.jpg");

			} else {
				hm.put("uri",
						"http://img.taobaocdn.com/bao/uploaded/i2/18783042962806492/TB2HqSYXVXXXXXDXXXXXXXXXXXX_!!1060668783-0-rate.jpg");
			}
			hm.put("ping", "116评价");
			hm.put("title1", "贝斯特韦斯特精品酒店合肥市");
			hm.put("rab", "4.6");
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
			hm.put("pwd", "密码：821860163246");
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
			hm.put("rating", "4.6");
			hm.put("date", "2014-08-28");
			hm.put("des", "运气很好，来拍照的那天，这家到了好多新款的衣服，都是全新的啊，哈哈哈，人品大爆发啊！！化妆师美眉给我推荐的这款古装特别喜欢，朋友说，够味道，哈哈哈哈哈哈！！！这里忍不住要嘚瑟一下，说说这次拍摄的感受吧，首先：地方还算比较好找，在步行街上，逛个街就直接到了，化妆的小美女，蛮热情的，技术也好，天气有点冷，给我倒茶送水的，拍摄全程照顾的我都有点不好意思了，摄影师废话不多，拍的很认真，感觉比较专业吧，全程消费金额也不多，选了那么多照片才600多，比我之前拍的几次都便宜，照片挺满意，几个朋友看了也说不错，唯一一点觉得不好，就是这家的档期有点难约到，拍的人比较多吧，提前两周才约到的，哎，没办法~下次春天了，我来拍套外景，哈哈！");		
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
			hm.put("oldprice", "268元");
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
						"http://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXXXchXXXXXXXXXXXX_!!16336700-0-rate.jpg");
			} else {
				hm.put("path",
						"http://img.taobaocdn.com/bao/uploaded/i2/18783042962806492/TB2HqSYXVXXXXXDXXXXXXXXXXXX_!!1060668783-0-rate.jpg");
			}
			hm.put("title", "爱时尚生活包铺");
			hm.put("number", "NO.163006790799"+i);
			hm.put("discount", "全店9.6折");
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

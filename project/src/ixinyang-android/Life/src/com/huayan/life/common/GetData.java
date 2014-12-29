package com.huayan.life.common;

import java.util.ArrayList;
import java.util.HashMap;

public class GetData {

	public static ArrayList<HashMap<String, String>> getOrders(int n,int type) {
		ArrayList<HashMap<String, String>> ret = new ArrayList<HashMap<String, String>>();
		HashMap<String, String> hm;
		for (int i = 0; i < n; i++) {
			hm = new HashMap<String, String>();
			hm.put("title", "�������̰���ׯ");
			hm.put("price", "68Ԫ");
			hm.put("num", i+1+"" );
			hm.put("score", "2��");
			if(type==0){
				if (i % 6 == 0) {
					hm.put("uri",
							"http://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXhttp://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXXXchXXXXXXXXXXXX_!!16336700-0-rate.jpgXXchXXXXXXXXXXXX_!!16336700-0-rate.jpg");
					hm.put("cate", "������");
				} else if(i % 6 == 1) {
					hm.put("uri",
							"http://img.taobaocdn.com/bao/uploaded/i2/18783042962806492/TB2HqSYXVXXXXXDXXXXXXXXXXXX_!!1060668783-0-rate.jpg");
					hm.put("cate", "������");
				}else if(i % 6 == 2) {
					hm.put("uri",
							"http://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXhttp://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXXXchXXXXXXXXXXXX_!!16336700-0-rate.jpgXXchXXXXXXXXXXXX_!!16336700-0-rate.jpg");
					hm.put("cate", "������");
				}else if(i % 6 == 3) {
					hm.put("uri",
							"http://img.taobaocdn.com/bao/uploaded/i2/18783042962806492/TB2HqSYXVXXXXXDXXXXXXXXXXXX_!!1060668783-0-rate.jpg");
					hm.put("cate", "���˿�");
				}else if(i % 6 == 4) {
					hm.put("uri",
							"http://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXhttp://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXXXchXXXXXXXXXXXX_!!16336700-0-rate.jpgXXchXXXXXXXXXXXX_!!16336700-0-rate.jpg");
					hm.put("cate", "δ����");
				}else if(i%6==5){
					hm.put("uri",
							"http://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXhttp://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXXXchXXXXXXXXXXXX_!!16336700-0-rate.jpgXXchXXXXXXXXXXXX_!!16336700-0-rate.jpg");
					hm.put("cate", "�˿���");
				}
			}else if(type==1){
				hm.put("uri",
						"http://img.taobaocdn.com/bao/uploaded/i2/18783042962806492/TB2HqSYXVXXXXXDXXXXXXXXXXXX_!!1060668783-0-rate.jpg");
				hm.put("cate", "������");
			}else if(type==2){
				hm.put("uri","http://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXhttp://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXXXchXXXXXXXXXXXX_!!16336700-0-rate.jpgXXchXXXXXXXXXXXX_!!16336700-0-rate.jpg");
				hm.put("cate", "δ����");
			}else if(type==3){
				hm.put("uri",
						"http://img.taobaocdn.com/bao/uploaded/i2/18783042962806492/TB2HqSYXVXXXXXDXXXXXXXXXXXX_!!1060668783-0-rate.jpg");
				hm.put("cate", "������");
			}else if(type==4){
				if(i%2==0){
					hm.put("uri","http://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXhttp://img.taobaocdn.com/bao/uploaded/i1/16700043372811106/TB2sI9VXVXXXXchXXXXXXXXXXXX_!!16336700-0-rate.jpgXXchXXXXXXXXXXXX_!!16336700-0-rate.jpg");
					hm.put("cate", "���˿�");
				}else if(i%2==1){
					hm.put("uri",
							"http://img.taobaocdn.com/bao/uploaded/i2/18783042962806492/TB2HqSYXVXXXXXDXXXXXXXXXXXX_!!1060668783-0-rate.jpg");
					hm.put("cate", "�˿���");
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
			hm.put("title", "ȫ��iPad mini");
			hm.put("time", "�齱ʱ�䣺2014-07-26");
			hm.put("num", "�齱�ţ�6207" + i);
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
			hm.put("tit", "���˱�����������˱��������");
			hm.put("descr", "������������·1137��ʥ�������ó����708.709��");
			hm.put("near", "1.6km");
			hm.put("price", "98");
			hm.put("oldPrice", "289");
			hm.put("fen", "4.8��");
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
			hm.put("tit", "���˱��������");
			hm.put("descr", "������������·1137��ʥ�������ó����708.709��");
			hm.put("near", "3.2km");
			hm.put("price", "98");
			hm.put("oldPrice", "289Ԫ");
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
				hm.put("type","��ʳ");
			} else if(i % 3==1) {
				hm.put("type","�Ƶ�");
			}else{
				hm.put("type","��Ʊ");
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
			hm.put("ping", "116����");
			hm.put("title1", "��˹��Τ˹�ؾ�Ʒ�Ƶ�Ϸ���");
			hm.put("rab", "4.6");
			hm.put("cate", "�����Ʒ");
			hm.put("qu", "����·");
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
			hm.put("title", "�Ź��ͻ����չ�����ȯ");
			hm.put("mian", "����");
			hm.put("pwd", "���룺821860163246");
			hm.put("conditions", "��38Ԫ���ã����ֻ��ͻ���ʹ��");
			hm.put("time", "����7�����");
			hm.put("validity", "��Ч����2014-08-19");
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
	
	public static ArrayList<HashMap<String, String>> getGroupPurchase(int n) {
		ArrayList<HashMap<String, String>> ret = new ArrayList<HashMap<String, String>>();
		HashMap<String, String> hm;
		for (int i = 0; i < n; i++) {
			hm = new HashMap<String, String>();
			hm.put("title", "����������������·1137��ʥ�������ó����708.709��");
			hm.put("price", "98Ԫ");
			hm.put("oldprice", "268Ԫ");
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
			hm.put("title", "��ʱ���������");
			hm.put("number", "NO.163006790799"+i);
			hm.put("discount", "ȫ��9.6��");
			ret.add(hm);
		}
		return ret;
	}
	
	public static ArrayList<HashMap<String, String>> getNoticeList(int n) {
		ArrayList<HashMap<String, String>> ret = new ArrayList<HashMap<String, String>>();
		HashMap<String, String> hm;
		for (int i = 0; i < n; i++) {
			hm = new HashMap<String, String>();
			hm.put("title", "���ղع��ġ�0048������Ϻ3-4�˲��ֿ����ˣ�ȥ�����ɣ�");
			hm.put("time", "2014-09-04");
			ret.add(hm);
		}
		return ret;
	}
	
}

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
			hm.put("title", "���ڳ�Ʒ�ͼ����������ɶ���");
			hm.put("content", "���ڳ�Ʒ�ͽ���ӭ���۴��ڣ�����Ԥ��ÿ������0.1Ԫ��");
			hm.put("review", i + "����");
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
			hm.put("title", "ȫ��iPad mini");
			hm.put("time", "�齱ʱ�䣺2014-07-25");
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
						"http://img.taobaocdn.com/bao/uploaded/i1/15700043372811105/TB2sI9VXVXXXXchXXXXXXXXXXXX_!!15335700-0-rate.jpg");

			} else {
				hm.put("path",
						"http://img.taobaocdn.com/bao/uploaded/i2/18783042962806492/TB2HqSYXVXXXXXDXXXXXXXXXXXX_!!1060568783-0-rate.jpg");
			}
			hm.put("tit", "���˱�����������˱��������");
			hm.put("descr", "������������·1137��ʥ�������ó����708.709��");
			hm.put("near", "1.5km");
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
			if (i % 2 == 0) {
				hm.put("path",
						"http://img.taobaocdn.com/bao/uploaded/i1/15700043372811105/TB2sI9VXVXXXXchXXXXXXXXXXXX_!!15335700-0-rate.jpg");

			} else {
				hm.put("path",
						"http://img.taobaocdn.com/bao/uploaded/i2/18783042962806492/TB2HqSYXVXXXXXDXXXXXXXXXXXX_!!1060568783-0-rate.jpg");
			}
			hm.put("tit", "���˱��������");
			hm.put("descr", "������������·1137��ʥ�������ó����708.709��");
			hm.put("near", "3.2km");
			hm.put("price", "98");
			hm.put("oldPrice", "289Ԫ");
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
						"http://img.taobaocdn.com/bao/uploaded/i1/15700043372811105/TB2sI9VXVXXXXchXXXXXXXXXXXX_!!15335700-0-rate.jpg");

			} else {
				hm.put("uri",
						"http://img.taobaocdn.com/bao/uploaded/i2/18783042962806492/TB2HqSYXVXXXXXDXXXXXXXXXXXX_!!1060568783-0-rate.jpg");
			}
			hm.put("ping", "116����");
			hm.put("title1", "ƻ��ר����");
			hm.put("rab", "3");
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
			hm.put("pwd", "���룺821850153245");
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
			hm.put("rating", "4.5");
			hm.put("date", "2014-08-28");
			hm.put("des", "�����ܺã������յ����죬��ҵ��˺ö��¿���·�������ȫ�µİ�������������Ʒ�󱬷���������ױʦ��ü�����Ƽ�������װ�ر�ϲ��������˵����ζ���������������������������̲�סҪ�Nɪһ�£�˵˵�������ĸ��ܰɣ����ȣ��ط�����ȽϺ��ң��ڲ��н��ϣ�����־�ֱ�ӵ��ˣ���ױ��С��Ů��������ģ�����Ҳ�ã������е��䣬���ҵ�����ˮ�ģ�����ȫ���չ˵��Ҷ��е㲻����˼�ˣ���Ӱʦ�ϻ����࣬�ĵĺ����棬�о��Ƚ�רҵ�ɣ�ȫ�����ѽ��Ҳ���࣬ѡ����ô����Ƭ��500�࣬����֮ǰ�ĵļ��ζ����ˣ���Ƭͦ���⣬�������ѿ���Ҳ˵����Ψһһ����ò��ã�������ҵĵ����е���Լ�����ĵ��˱Ƚ϶�ɣ���ǰ���ܲ�Լ���ģ�����û�취~�´δ����ˣ����������⾰��������");		
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
			hm.put("oldprice", "258Ԫ");
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
			hm.put("title", "��ʱ���������");
			hm.put("number", "NO.153006790799"+i);
			hm.put("discount", "ȫ��9.5��");
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

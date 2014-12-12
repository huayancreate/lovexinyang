package util;

import java.util.ArrayList;
import java.util.List;

import org.apache.http.message.BasicNameValuePair;
import org.json.JSONException;
import org.json.JSONObject;


public class DBOperation {

	public DBOperation() {}

	public  String PATH ="http://114.215.135.88:8080/ixinyang/";
	private static String USERINFOACTION = "UserInfoAction_isUser.action"; // 登录接口
	private static String GOODSDETAILACTION="GoodsDetailAction";//商品详情
	
	
//	public Contact getContactByShopId(int goodsId) {
//		Contact myContact = null;
//		List<BasicNameValuePair> params = new ArrayList<BasicNameValuePair>();
//		String json = "";
//		try {
//			JSONObject jsonObj = new JSONObject();
//			jsonObj.put("shopId", goodsId);
//			json = jsonObj.toString();
//		} catch (JSONException e) {
//			e.printStackTrace();
//		}
//		params.add(new BasicNameValuePair("jsonStr", json));
//		String jsonString = HttpUtils.doPostUrl(PATH + GOODSDETAILACTION,params);
//		if (jsonString != null)
//			myContact = JsonTools.getContactByShopId(jsonString);
//		return myContact;
//	}
	
}

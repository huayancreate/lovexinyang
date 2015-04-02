package util;



public class JsonTools {

	
//	public static Contact getContactByShopId(String jsonString) {
//		Contact contact = null;
//		try {
//			contact = new Contact();
//			JSONObject jsonObject = new JSONObject(jsonString);
//			JSONObject msgObject = jsonObject.getJSONObject("Contact");
//			contact.setShopId(msgObject.getInt("shopId"));
//			contact.setFax(msgObject.getString("fax"));
//			contact.setMessage(msgObject.getString("message"));
//			contact.setMicroblog(msgObject.getString("microblog"));
//			contact.setOther(msgObject.getString("other"));
//			contact.setPhone(msgObject.getString("phone"));
//			contact.setQq(msgObject.getString("qq"));
//			return contact;
//		} catch (JSONException e) {
//			e.printStackTrace();
//		}
//		return null;
//	}

	
	/**
	 * 获取对象数据
	 * 
	 * @param key
	 * @param jsonString
	 * @return
	 */
//	public static User select(String jsonString) {
//		User user = null;
//		try {
//			user = new User();
//			JSONObject jsonObject = new JSONObject(jsonString);
//			JSONObject userObject = jsonObject.getJSONObject("User");
//			user.setUserId(userObject.getInt("userId"));
//			user.setUserName(userObject.getString("userName"));
//			user.setUserPassword(userObject.getString("userPassword"));
//			return user;
//		} catch (JSONException e) {
//			e.printStackTrace();
//		}
//		return null;
//	}
//
//	/**
//	 * 获得消息List
//	 * 
//	 * @param jsonString
//	 * @return
//	 */
//	public static List<WXMessage> getMessages(String jsonString) {
//		List<WXMessage> list = new ArrayList<WXMessage>();
//		try {
//			JSONObject jsonObject = new JSONObject(jsonString);
//			JSONArray jsonArray = jsonObject.getJSONArray("WXMessagelist");
//			for (int i = 0; i < jsonArray.length(); i++) {
//				JSONObject msgObject = jsonArray.getJSONObject(i);
//				WXMessage msg = new WXMessage();
//				msg.setIconId(msgObject.getString("iconId"));
//				msg.setMessageId(msgObject.getInt("messageId"));
//				msg.setMessageContent(msgObject.getString("messageContent"));
//				msg.setMessageTitle(msgObject.getString("messageTitle"));
//				msg.setMessageTime(msgObject.getString("messageTime"));
//				msg.setSendId(msgObject.getInt("sendId"));
//				list.add(msg);
//			}
//		} catch (JSONException e) {
//			e.printStackTrace();
//		}
//		return list;
//	}

}

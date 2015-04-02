package util;

public class StringUtility {

	public static String changePhone(String phone) {
		String result;
		String headStr = phone.substring(0, 2);
		String endStr = phone.substring(7, 10);
		result = headStr + "****" + endStr;
		return result;
	}
}

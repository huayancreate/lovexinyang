package util;

import java.util.regex.Matcher;
import java.util.regex.Pattern;

public class RegExpValidator {

		/**
		 * 验证邮箱
		 * 
		 * @param 待验证的字符串
		 * @return 如果是符合的字符串,返回 <b>true </b>,否则为 <b>false </b>
		 */
		public static boolean isEmail(String str) {
			String regex = "^([\\w-\\.]+)@((\\[[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}\\.)|(([\\w-]+\\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\\]?)$";
			return match(regex, str);
		}

		/**
		 * 验证IP地址
		 * 
		 * @param 待验证的字符串
		 * @return 如果是符合格式的字符串,返回 <b>true </b>,否则为 <b>false </b>
		 */
		public static boolean isIP(String str) {
			String num = "(25[0-5]|2[0-4]\\d|[0-1]\\d{2}|[1-9]?\\d)";
			String regex = "^" + num + "\\." + num + "\\." + num + "\\." + num
					+ "$";
			return match(regex, str);
		}

		/**
		 * 验证网址Url
		 * 
		 * @param 待验证的字符串
		 * @return 如果是符合格式的字符串,返回 <b>true </b>,否则为 <b>false </b>
		 */
		public static boolean IsUrl(String str) {
			String regex = "http(s)?://([\\w-]+\\.)+[\\w-]+(/[\\w- ./?%&=]*)?";
			return match(regex, str);
		}

		/**
		 * 验证电话号码
		 * 
		 * @param 待验证的字符串
		 * @return 如果是符合格式的字符串,返回 <b>true </b>,否则为 <b>false </b>
		 */
		public static boolean IsTelephone(String str) {
			
			String regex = "^(\\d{3,4}-)?\\d{6,8}$";
			// String regex = "^\\d{1,18}$";
			return match(regex, str);
		}

		/**
		 * 验证输入密码条件(字符与数据同时出现)
		 * 
		 * @param 待验证的字符串
		 * @return 如果是符合格式的字符串,返回 <b>true </b>,否则为 <b>false </b>
		 */
		public static boolean IsPassword(String str) {
			String regex = "[A-Za-z]+[0-9]";
			return match(regex, str);
		}

		/**
		 * 验证输入密码长度 (6-18位)
		 * 
		 * @param 待验证的字符串
		 * @return 如果是符合格式的字符串,返回 <b>true </b>,否则为 <b>false </b>
		 */
		public static boolean IsPasswLength(String str) {
			String regex = "^\\d{6,18}$";
			return match(regex, str);
		}

		/**
		 * 验证输入邮政编号
		 * 
		 * @param 待验证的字符串
		 * @return 如果是符合格式的字符串,返回 <b>true </b>,否则为 <b>false </b>
		 */
		public static boolean IsPostalcode(String str) {
			String regex = "^\\d{6}$";
			return match(regex, str);
		}

		/**
		 * 验证输入手机号码
		 * 
		 * @param 待验证的字符串
		 * @return 如果是符合格式的字符串,返回 <b>true </b>,否则为 <b>false </b>
		 */
		public static boolean IsHandset(String str) {
			String regex = "^((13[0-9])|(15[^4,\\D])|(18[0-9]))\\d{8}$";//精确验证手机号码
			// String regex = "^\\d{1,18}$";
			
			return match(regex, str);
		}

		/**
		 * 验证输入身份证号
		 * 
		 * @param 待验证的字符串
		 * @return 如果是符合格式的字符串,返回 <b>true </b>,否则为 <b>false </b>
		 */
		public static boolean IsIDcard(String str) {
			String regex = "(^\\d{18}$)|(^\\d{15}$)";
			return match(regex, str);
		}

		/**
		 * 验证输入两位小数
		 * 
		 * @param 待验证的字符串
		 * @return 如果是符合格式的字符串,返回 <b>true </b>,否则为 <b>false </b>
		 */
		public static boolean IsDecimal(String str) {
			String regex = "^[0-9]+(.[0-9]{2})?$";
			return match(regex, str);
		}

		/**
		 * 验证输入一年的12个月
		 * 
		 * @param 待验证的字符串
		 * @return 如果是符合格式的字符串,返回 <b>true </b>,否则为 <b>false </b>
		 */
		public static boolean IsMonth(String str) {
			String regex = "^(0?[[1-9]|1[0-2])$";
			return match(regex, str);
		}

		/**
		 * 验证输入一个月的31天
		 * 
		 * @param 待验证的字符串
		 * @return 如果是符合格式的字符串,返回 <b>true </b>,否则为 <b>false </b>
		 */
		public static boolean IsDay(String str) {
			String regex = "^((0?[1-9])|((1|2)[0-9])|30|31)$";
			return match(regex, str);
		}

		/**
		 * 验证日期时间
		 * 
		 * @param 待验证的字符串
		 * @return 如果是符合网址格式的字符串,返回 <b>true </b>,否则为 <b>false </b>
		 */
		public static boolean isDate(String str) {
			String regex = "^((((1[6-9]|[2-9]\\d)\\d{2})-(0?[13578]|1[02])-(0?[1-9]|[12]\\d|3[01]))|(((1[6-9]|[2-9]\\d)\\d{2})-(0?[13456789]|1[012])-(0?[1-9]|[12]\\d|30))|(((1[6-9]|[2-9]\\d)\\d{2})-0?2-(0?[1-9]|1\\d|2[0-8]))|(((1[6-9]|[2-9]\\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))-0?2-29-)) (20|21|22|23|[0-1]?\\d):[0-5]?\\d:[0-5]?\\d$";
			return match(regex, str);
		}

		/**
		 * 验证数字输入
		 * 
		 * @param 待验证的字符串
		 * @return 如果是符合格式的字符串,返回 <b>true </b>,否则为 <b>false </b>
		 */
		public static boolean IsNumber(String str) {
			String regex = "^[0-9]*$";
			return match(regex, str);
		}

		/**
		 * 验证非零的正整数
		 * 
		 * @param 待验证的字符串
		 * @return 如果是符合格式的字符串,返回 <b>true </b>,否则为 <b>false </b>
		 */
		public static boolean IsIntNumber(String str) {
			String regex = "^\\+?[1-9][0-9]*$";
			return match(regex, str);
		}

		/**
		 * 验证大写字母
		 * 
		 * @param 待验证的字符串
		 * @return 如果是符合格式的字符串,返回 <b>true </b>,否则为 <b>false </b>
		 */
		public static boolean IsUpChar(String str) {
			String regex = "^[A-Z]+$";
			return match(regex, str);
		}

		/**
		 * 验证小写字母
		 * 
		 * @param 待验证的字符串
		 * @return 如果是符合格式的字符串,返回 <b>true </b>,否则为 <b>false </b>
		 */
		public static boolean IsLowChar(String str) {
			String regex = "^[a-z]+$";
			return match(regex, str);
		}

		/**
		 * 验证验证输入字母
		 * 
		 * @param 待验证的字符串
		 * @return 如果是符合格式的字符串,返回 <b>true </b>,否则为 <b>false </b>
		 */
		public static boolean IsLetter(String str) {
			String regex = "^[A-Za-z]+$";
			return match(regex, str);
		}

		/**
		 * 验证验证输入汉字
		 * 
		 * @param 待验证的字符串
		 * @return 如果是符合格式的字符串,返回 <b>true </b>,否则为 <b>false </b>
		 */
		public static boolean IsChinese(String str) {
			String regex = "^[\u4e00-\u9fa5],{0,}$";
			return match(regex, str);
		}

		/**
		 * 验证验证输入字符串
		 * 
		 * @param 待验证的字符串
		 * @return 如果是符合格式的字符串,返回 <b>true </b>,否则为 <b>false </b>
		 */
		public static boolean IsLength(String str) {
			String regex = "^.{8,}$";
			return match(regex, str);
		}

		/**
		 * @param regex
		 *            正则表达式字符串
		 * @param str
		 *            要匹配的字符串
		 * @return 如果str 符合 regex的正则表达式格式,返回true, 否则返回 false;
		 */
		private static boolean match(String regex, String str) {
			Pattern pattern = Pattern.compile(regex);
			Matcher matcher = pattern.matcher(str);
			return matcher.matches();
		}
		

		/**
		 * 检查字符串是否含有HTML标签  
		 * @param value
		 * @return
		 */
		public static boolean checkHtmlTag(String str){   
			String regex = "^[a-zA-Z0-9],{0,}$";
			return match(regex, str);
		}   
		
		/**
		 * 检查输入的数据中是否有特殊字符
		 * 
		 * @param qString
		 *            要检查的数据
		 * @param regx
		 *            特殊字符正则表达式
		 * @return boolean 如果包含正则表达式 <code> regx </code> 中定义的特殊字符，

返回true； 否则返回false
		 */
		public static boolean hasCrossScriptRisk(String qString, String regx) {
			if (qString != null) {
				qString = qString.trim();
				Pattern p = Pattern.compile(regx, Pattern.CASE_INSENSITIVE);
				Matcher m = p.matcher(qString);
				return m.find();
			}
			return false;
		}
		
		/**
		 * 检查输入的数据中是否有特殊字符
		 * 
		 * @param qString
		 *            要检查的数据
		 * @param regx
		 *            特殊字符正则表达式
		 * @return boolean 如果包含正则表达式 <code> regx </code> 中定义的特殊字符，

返回true； 否则返回false
		 */
		public static boolean checkString(String qString){
			String regx = "!|！|@|◎|#|＃|(\\$)|￥|%|％|(\\^)|……|(\\&)|※|(\\*)|×|(\\()|（|(\\))|）|_|——|(\\+)|＋|(\\|)|§ ";
			return hasCrossScriptRisk(qString,regx);
		}
}

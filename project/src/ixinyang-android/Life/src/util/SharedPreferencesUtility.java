package util;

import android.content.Context;
import android.content.SharedPreferences;
import android.content.SharedPreferences.Editor;

public class SharedPreferencesUtility {
	
	public static final  String CURRENT_PAGE="currentPage";
	public static final  String PAGE_COUNT="pageCount";
	public static final String  CURRENT_CONTEXT="MembershipCard";
	public static final String  STORE_lIST="StoreList";
	public static final String  GOODS_lIST="GoodsList";
	public static final String  ORDERS_lIST="OrdersList";
	public static final String  RECOMMENDDAILY_lIST="recommendDailyList";
	public static final String  SHOP_lIST="shopList";
	public static final String  CATEGORYACTIVITY="categoryActivity";
	public static final String NOTICEACTIVITY="noticeActivity";
	
	public static final int  BOOKMARK=0;
	public static final int  RECOMMENDDAILY=1;
	
	public static final int  COLLECTION=0;
	public static final int  STORE=1;
	
	public static void saveData(String currentContext,String key,int value ,Context context) {
		SharedPreferences preferences =context.getSharedPreferences(currentContext,Context.MODE_PRIVATE);
		Editor editor = preferences.edit();
		editor.putInt(key, value);
		editor.commit();
	}
	
	/**
	 * 清空SharedPreferences中的数据
	 */
	public static void removeSharedPreferences(Context context,String key){
		SharedPreferences sp = context.getSharedPreferences(key, Context.MODE_PRIVATE);  
        Editor editor = sp.edit();  
        editor.remove(SharedPreferencesUtility.CURRENT_PAGE);
        editor.remove(SharedPreferencesUtility.PAGE_COUNT);
        editor.commit();
	}

}

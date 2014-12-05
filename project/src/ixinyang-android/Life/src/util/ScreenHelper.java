package util;

import android.content.Context;
import android.view.WindowManager;

public class ScreenHelper {
	
	/**
	 * 当前屏幕宽度与设计宽度的比例
	 */
	public static float scalex;
	/**
	 * 当前屏幕高度和设计宽度的比例
	 */
	public static float scaleY;
	/**
	 * 获取屏幕宽度
	 * @param context
	 * @return
	 */
	public static int getScreenWidth(Context context){
		int ret = 0;
		WindowManager windowManager = (WindowManager) context.getSystemService(Context.WINDOW_SERVICE);
    	ret = windowManager.getDefaultDisplay().getWidth();
		return ret;
	}
	
	/**
	 * 获取屏幕高度
	 * @param context
	 * @return
	 */
	public static int getScreenHeight(Context context){
		int ret = 0;		
		WindowManager windowManager = (WindowManager) context.getSystemService(Context.WINDOW_SERVICE);
    	ret = windowManager.getDefaultDisplay().getHeight();
		return ret;
	}
}

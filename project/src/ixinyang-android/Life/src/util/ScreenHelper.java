package util;

import android.content.Context;
import android.view.WindowManager;

public class ScreenHelper {
	
	/**
	 * ��ǰ��Ļ�������ƿ�ȵı���
	 */
	public static float scalex;
	/**
	 * ��ǰ��Ļ�߶Ⱥ���ƿ�ȵı���
	 */
	public static float scaleY;
	/**
	 * ��ȡ��Ļ���
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
	 * ��ȡ��Ļ�߶�
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

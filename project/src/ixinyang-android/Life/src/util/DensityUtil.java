package util;

import android.content.Context;


/**
 *px ��dp֮��ת�� 		
 * @author Administrator
 *
 */
public class DensityUtil {

	
	
	    /**
	     * �����ֻ��ķֱ��ʴ� dp �ĵ�Ԫת��px
	     * @param context
	     * @param dpValue
	     * @return
	     */
	    public static int dip2px(Context context,float dpValue)
	    {
	    	final float scale=context.getResources().getDisplayMetrics().density;
	    	return (int)(dpValue*scale+0.5f);
	    }
	    
	    /**
	     * �����ֻ��ķֱ���px �ĵ�Ԫת��dp
	     * @param context
	     * @param pxValue
	     * @return
	     */
	    public static int px2dp(Context context,float pxValue)
	    {
	      final float scale=	context.getResources().getDisplayMetrics().density;
	      return (int)(pxValue/scale+0.5f);
	    }
	    
}

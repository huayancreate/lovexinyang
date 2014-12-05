package util;

import android.content.Context;


/**
 *px 和dp之间转换 		
 * @author Administrator
 *
 */
public class DensityUtil {

	
	
	    /**
	     * 根据手机的分辨率从 dp 的单元转成px
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
	     * 根据手机的分辨率px 的单元转成dp
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

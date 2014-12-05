package util;


/**
 * 公共静态类
 * @author chen
 * @date 2012-10-25 下午3:13:44
 */
public final class C {
	/**
	 * 显示屏信息
	 * @author chen
	 * @date 2012-10-25 下午3:15:23
	 */
    public static final class display {
        /** 屏幕分辨率宽度 */
    	public static int widthPixels = 0;
    	/** 屏幕分辨率高度 */
    	public static int heightPixels = 0;
    	
    	/** 容器宽度 */
    	public static int contentWidth = 0;
    	/** 容器高度 */
    	public static int contentHeight = 0;
    	
    }
    
    /** google 统计前缀*/
    public static final String GA_TITLE = "/Android/app/";
    
    /**
     * 网络连接
     * @author chen
     * @date 2012-10-25 下午3:14:36
     */
    public static final class http {
    	/** 服务器地址 */
    	public static String http_request_head = "http://192.168.0.186/";
    	
    	/** 替换https 为http */
    	public static String httpPic(){
    		if(http_request_head.startsWith("https:")) return http_request_head.replaceAll("https:", "http:");
    		return http_request_head;
    	}
    }
    public static final class message_title {
    	public static final String success = "SUCCESS";
    }
}
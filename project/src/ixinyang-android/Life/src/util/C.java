package util;


/**
 * ������̬��
 * @author chen
 * @date 2012-10-25 ����3:13:44
 */
public final class C {
	/**
	 * ��ʾ����Ϣ
	 * @author chen
	 * @date 2012-10-25 ����3:15:23
	 */
    public static final class display {
        /** ��Ļ�ֱ��ʿ�� */
    	public static int widthPixels = 0;
    	/** ��Ļ�ֱ��ʸ߶� */
    	public static int heightPixels = 0;
    	
    	/** ������� */
    	public static int contentWidth = 0;
    	/** �����߶� */
    	public static int contentHeight = 0;
    	
    }
    
    /** google ͳ��ǰ׺*/
    public static final String GA_TITLE = "/Android/app/";
    
    /**
     * ��������
     * @author chen
     * @date 2012-10-25 ����3:14:36
     */
    public static final class http {
    	/** ��������ַ */
    	public static String http_request_head = "http://192.168.0.186/";
    	
    	/** �滻https Ϊhttp */
    	public static String httpPic(){
    		if(http_request_head.startsWith("https:")) return http_request_head.replaceAll("https:", "http:");
    		return http_request_head;
    	}
    }
    public static final class message_title {
    	public static final String success = "SUCCESS";
    }
}
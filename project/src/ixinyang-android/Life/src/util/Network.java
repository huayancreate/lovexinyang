package util;

import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.net.wifi.WifiManager;

/**
 * 
 * �������
 * @author Administrator
 *
 */
public class Network {
	
	/** ���粻���� */
	public static final int NONETWORK= 0;
	/** ��wifi���� */
	public static final int WIFI = 1;
	/** ����wifi���� */
	public static final int NOWIFI = 2;

	/**
	 * ������������ ���ж��Ƿ���wifi����
	 * @param context
	 * @return <li>û�����磺Network.NONETWORK;</li> <li>wifi ���ӣ�Network.WIFI;</li> <li>mobile ���ӣ�Network.NOWIFI</li>
	 */
	public static int checkNetWorkType(Context context) {
	    
		if (!checkNetWork(context)) {
			return Network.NONETWORK;
		}
		ConnectivityManager cm = (ConnectivityManager) context.getSystemService(Context.CONNECTIVITY_SERVICE);
//		cm.getNetworkInfo(ConnectivityManager.TYPE_MOBILE);
		if (cm.getNetworkInfo(ConnectivityManager.TYPE_WIFI).isConnectedOrConnecting())
			return Network.WIFI;
		else
			return Network.NOWIFI;
	}
	
	/**
	 * ��������Ƿ�����
	 * @param context
	 * @return
	 */
	public static boolean checkNetWork(Context context){
		// 1.��������豸������
		ConnectivityManager cm = (ConnectivityManager) context.getSystemService(Context.CONNECTIVITY_SERVICE);
		if(cm == null){
			return false;
		}
		NetworkInfo ni = cm.getActiveNetworkInfo();
		if(ni == null || !ni.isAvailable()){
			return false;
		}
		return true;
	}
	
	/**
	 * �ж�wifi�Ƿ�����
	 * @return
	 */
	public static boolean isWifiConnected(Context context) {
		WifiManager manager = (WifiManager) context.getSystemService(Context.WIFI_SERVICE);
		return manager.isWifiEnabled();
	}
	
}

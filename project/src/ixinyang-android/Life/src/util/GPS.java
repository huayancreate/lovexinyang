package util;

import android.content.Context;
import android.location.LocationManager;

/**
 * 
 * ���GPS
 * @author Administrator
 *
 */
public class GPS {
	public static boolean openGPS(Context context) { 
		LocationManager locationManager = (LocationManager) context.getSystemService(Context.LOCATION_SERVICE);
		if (locationManager.isProviderEnabled(android.location.LocationManager.GPS_PROVIDER) || 
			locationManager.isProviderEnabled(android.location.LocationManager.NETWORK_PROVIDER)) {
//			Toast.makeText(this, " λ��Դ�����ã� ", Toast.LENGTH_SHORT).show();
			return true;
		}
//		Toast.makeText(context, "�_����λ�����ʹ��ԓ���ܣ� ", Toast.LENGTH_SHORT).show();
//		// ת�� GPS ���ý���
//		Intent intent = new Intent(Settings.ACTION_SECURITY_SETTINGS);
//		startActivityForResult(intent, 0);
		return false;
    }
}

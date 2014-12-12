package util;

import android.content.Context;
import android.location.LocationManager;

/**
 * 
 * 检测GPS
 * @author Administrator
 *
 */
public class GPS {
	public static boolean openGPS(Context context) { 
		LocationManager locationManager = (LocationManager) context.getSystemService(Context.LOCATION_SERVICE);
		if (locationManager.isProviderEnabled(android.location.LocationManager.GPS_PROVIDER) || 
			locationManager.isProviderEnabled(android.location.LocationManager.NETWORK_PROVIDER)) {
//			Toast.makeText(this, " 位置源已设置！ ", Toast.LENGTH_SHORT).show();
			return true;
		}
//		Toast.makeText(context, "開啟定位后才能使用該功能！ ", Toast.LENGTH_SHORT).show();
//		// 转至 GPS 设置界面
//		Intent intent = new Intent(Settings.ACTION_SECURITY_SETTINGS);
//		startActivityForResult(intent, 0);
		return false;
    }
}

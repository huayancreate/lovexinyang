package util;

import com.baidu.mapapi.model.LatLng;
import com.huayan.life.model.MyLocation;

import android.content.Context;
import android.location.Criteria;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.Bundle;
import android.widget.Toast;

public class GetLocation {

	LocationManager locationManager;
	Context context;

	public GetLocation(Context context) {
		this.context = context;
	}

	public  void getLocation() {
		String serviceName = Context.LOCATION_SERVICE;
		locationManager = (LocationManager) context.getSystemService(serviceName);
		Criteria criteria = new Criteria();
		criteria.setAccuracy(Criteria.ACCURACY_FINE);
		criteria.setAltitudeRequired(false);
		criteria.setBearingRequired(false);
		criteria.setCostAllowed(true);
		criteria.setPowerRequirement(Criteria.POWER_LOW);
		String provider = locationManager.getBestProvider(criteria, true);
		openGPS();
		if (provider != null) {
			Location location = locationManager.getLastKnownLocation(provider);
			updateWithNewLocation(location);
			locationManager.requestLocationUpdates(provider, 2000, 10,locationListener);
		} else {
			updateWithNewLocation(null);
		}
	}

	private final LocationListener locationListener = new LocationListener() {
		public void onLocationChanged(Location location) {
			updateWithNewLocation(location);
		}

		public void onProviderDisabled(String provider) {
			updateWithNewLocation(null);
		}

		public void onProviderEnabled(String provider) {
		}

		public void onStatusChanged(String provider, int status, Bundle extras) {
		}
	};

	private void updateWithNewLocation(Location location) {
		if (location != null) {
			MyLocation loc=new MyLocation();
			loc.setLongitude(location.getLongitude());
			loc.setLatitude(location.getLatitude());
			ShareUtil.saveMyLocation(loc, context);		
		}	
	}
	
	
	  public double getDistance(LatLng start,LatLng end){  
	        double lat1 = (Math.PI/180)*start.latitude;  
	        double lat2 = (Math.PI/180)*end.latitude;  
	          
	        double lon1 = (Math.PI/180)*start.longitude;  
	        double lon2 = (Math.PI/180)*end.longitude;  
     
	        //地球半径  
	        double R = 6371;  
	        //两点间距离 km，如果想要米的话，结果*1000就可以了  
	        double d =  Math.acos(Math.sin(lat1)*Math.sin(lat2)+Math.cos(lat1)*Math.cos(lat2)*Math.cos(lon2-lon1))*R;  
	        return d*1000;  
	   }
	  
	private void openGPS() {
		if (locationManager.isProviderEnabled(android.location.LocationManager.GPS_PROVIDER)
				|| locationManager.isProviderEnabled(android.location.LocationManager.NETWORK_PROVIDER)) {
			return;
		}
		Toast.makeText(context, "请开启GPS和网络！", Toast.LENGTH_SHORT).show();
	}
	
}

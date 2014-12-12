package util;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.UnsupportedEncodingException;
import java.util.List;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;
import org.apache.http.params.HttpConnectionParams;
import org.apache.http.params.HttpParams;
import org.apache.http.util.EntityUtils;

import android.graphics.Bitmap;
import android.graphics.BitmapFactory;

public class HttpUtils {

	public static String doGetUrl(String url) {
		try {
		StringBuilder sb = new StringBuilder();
		HttpClient client = new DefaultHttpClient();
		HttpParams httpParams = client.getParams();

		// �������糬ʱ����
		HttpConnectionParams.setConnectionTimeout(httpParams, 3000);
		HttpConnectionParams.setSoTimeout(httpParams, 5000);
		HttpResponse response = client.execute(new HttpGet(url));
		HttpEntity entity = response.getEntity();
		if (entity != null) {
			BufferedReader reader = new BufferedReader(new InputStreamReader(entity.getContent(), "UTF-8"), 8192);
			String line = null;
			while ((line = reader.readLine()) != null) {
				sb.append(line + "\n");
			}
			reader.close();
		}
		return sb.toString();
		}catch (Exception e) {
			e.printStackTrace();
		}
		return null;
	}
	
	public static  String doPostUrl(String path,List<BasicNameValuePair> params) {
		// ����һ������
		HttpPost httpPost = new HttpPost(path);
		try {
			// ���ñ���
			httpPost.setEntity(new UrlEncodedFormEntity(params, "UTF-8"));
			// �������� ����÷���
			HttpClient httpClient = new DefaultHttpClient();
			HttpResponse httpResponse = httpClient.execute(httpPost);
			// �������ص�����
			if (httpResponse.getStatusLine().getStatusCode() != 404) {// �жϷ�����״̬
				String result = EntityUtils.toString(httpResponse.getEntity());
				return result;
			}
		} catch (UnsupportedEncodingException e) {
			e.printStackTrace();
		} catch (ClientProtocolException e) {
			e.printStackTrace();
		} catch (IOException e) {
			e.printStackTrace();
		}
		return null;
	}
	
	public static Bitmap getBitmapFromServer(String imagePath) { 
      
	     HttpGet get = new HttpGet(imagePath); 
	     HttpClient client = new DefaultHttpClient(); 
	     Bitmap pic = null; 
	     try { 
	         HttpResponse response = client.execute(get); 
	         HttpEntity entity = response.getEntity(); 
	         InputStream is = entity.getContent(); 	          
	         pic = BitmapFactory.decodeStream(is);   	          
	     } catch (ClientProtocolException e) { 
	         e.printStackTrace(); 
	     } catch (IOException e) { 
	         e.printStackTrace(); 
	     } 
	     return pic; 
	 } 
	
}

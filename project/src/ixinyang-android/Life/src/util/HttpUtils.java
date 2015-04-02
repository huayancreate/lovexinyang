package util;

import com.loopj.android.http.AsyncHttpClient;
import com.loopj.android.http.AsyncHttpResponseHandler;
import com.loopj.android.http.RequestParams;

/**
 * @author wzz
 * @date 2014-12-31
 */
public class HttpUtils {

	private static String BASEPATH = "http://114.215.135.88:8080/huayan-web/";
	private static AsyncHttpClient client = new AsyncHttpClient();

	public static void get(String url, RequestParams params,AsyncHttpResponseHandler responseHandler) {
		client.get(getAbsoluteUrl(url), params, responseHandler);
	}

	public static void post(String url, RequestParams params,AsyncHttpResponseHandler responseHandler) {
		client.post(getAbsoluteUrl(url), params, responseHandler);
	}

	private static  String getAbsoluteUrl(String relativeUrl) {
		return BASEPATH + relativeUrl;
	}
}

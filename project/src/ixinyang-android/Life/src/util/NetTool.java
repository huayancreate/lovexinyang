package util;

import java.io.ByteArrayOutputStream;
import java.io.DataOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.net.HttpURLConnection;
import java.net.SocketTimeoutException;
import java.net.URL;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;
import org.apache.http.params.CoreConnectionPNames;
import org.json.JSONArray;
import org.json.JSONObject;

import util.bean.FormFile;
import util.exception.HttpException;
import android.app.Activity;
import android.app.AlertDialog;
import android.app.AlertDialog.Builder;
import android.content.Context;
import android.content.DialogInterface;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.view.Gravity;
import android.view.ViewGroup.LayoutParams;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.Toast;

import com.huayan.life.Activity.R;



/**
 * ������������
 */
public class NetTool {
	
	

	/** OK: Success! */
	public static final int OK = 200;
	/** Not Modified: There was no new data to return. */
	public static final int NOT_MODIFIED = 304;
	/**
	 * Bad Request: The request was invalid. An accompanying error message will
	 * explain why. This is the status code will be returned during rate
	 * limiting.
	 */
	public static final int BAD_REQUEST = 400;
	/** Not Authorized: Authentication credentials were missing or incorrect. */
	public static final int NOT_AUTHORIZED = 401;
	/**
	 * Forbidden: The request is understood, but it has been refused. An
	 * accompanying error message will explain why.
	 */
	public static final int FORBIDDEN = 403;
	/**
	 * Not Found: The URI requested is invalid or the resource requested, such
	 * as a user, does not exists.
	 */
	public static final int NOT_FOUND = 404;
	/**
	 * Not Acceptable: Returned by the Search API when an invalid format is
	 * specified in the request.
	 */
	public static final int NOT_ACCEPTABLE = 406;
	/**
	 * Internal Server Error: Something is broken. Please post to the group so
	 * the Weibo team can investigate.
	 */
	public static final int INTERNAL_SERVER_ERROR = 500;
	/** Bad Gateway: Weibo is down or being upgraded. */
	public static final int BAD_GATEWAY = 502;
	/**
	 * Service Unavailable: The Weibo servers are up, but overloaded with
	 * requests. Try again later. The search and trend methods use this to
	 * indicate when you are being rate limited.
	 */
	public static final int SERVICE_UNAVAILABLE = 503;
	
	/**
	 * @readImageData  ��ȡ�������ϵ�ͼƬ
	 * @param imagePath ����·�� 
	 * @return
	 */
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
	
	/**
	 * @readImageData  ��ȡ�������ϵ�ͼƬ
	 * @param path ����·��
	 * @return ͼƬ����������
	 *  
	 */
	 public static byte[] readImageData(String path) throws Exception
	 {
		  //������������
		 URL url=new URL(path);
		 HttpURLConnection httpUrl=(HttpURLConnection) url.openConnection();
		 httpUrl.setChunkedStreamingMode(1024*10);
		 httpUrl.setRequestMethod("GET");
		 httpUrl.setReadTimeout(6000);
		 if(httpUrl.getResponseCode()==200)//��ʶ200 ��ʾ����ɹ�
		 {
			InputStream is=   httpUrl.getInputStream();
			return readStream(is);
		 }
		 
		 return null;
	 }
	 
	 /**
	  * @sendGetRequest  ����get����
	  * @param path ����·��
	  * @return ����������
	  * @throws Exception
	  *  
	  */
	 public static InputStream sendGetRequest(String path)throws Exception
	 {
		 URL url=new URL(path);
		 HttpURLConnection httpUrl=(HttpURLConnection) url.openConnection();
		 httpUrl.setChunkedStreamingMode(1024*10);
		 httpUrl.setRequestMethod("GET");
		 httpUrl.setReadTimeout(6000);
		 if(httpUrl.getResponseCode()==200)//��ʶ200 ��ʾ����ɹ�
		 {
			InputStream is=   httpUrl.getInputStream();
			return is;
		 }
		 return null;
	 }
	 /**
	  * @readHtmlContent  ��ȡ�������ϵ�html��������
	  * @param path ����·��
	  * @return �ַ����� html��������
	  */
	 public static String readHtmlContent(String method) throws Exception
	 {
		 
		     URL url=new URL(NetTool.httpPath(method));
		     HttpURLConnection httpUrl= (HttpURLConnection) url.openConnection();
		     httpUrl.setRequestMethod("GET");
             httpUrl.setReadTimeout(6000);
             if(httpUrl.getResponseCode()==200)
             {
            	  InputStream is= httpUrl.getInputStream();
            	 byte[] data= readStream(is);
                 return new String(data);
             }
		     return null;
	 }
	 /**
	  * @readStream ��ȡ������������
	  * @param is ����������
	  * @return ����������
	  */
	 public static byte[] readStream(InputStream is) throws Exception
	 {
		  ByteArrayOutputStream bos=new ByteArrayOutputStream();
		     byte[] data=new byte[1024];
		     int len=-1;
		     while((len=is.read(data))!=-1)
		     {
		    	 bos.write(data, 0, len);
		     }
		    byte [] d= bos.toByteArray();
		    is.close();
		    bos.close();
		    return d;	 
	 }
	 
	 /**
	  * @sendPostToInternetWithParam ����post����Internet������
	  * @param path ����·��
	  * @param params �������
	  * @return ����������
	  */
	 public static InputStream sendPostToInternetWithParam(String method,Map<String,String> params)throws Exception
	 {
		  URL url=new URL(NetTool.httpPath(method));
		  HttpURLConnection httpUrl= (HttpURLConnection) url.openConnection();
		  httpUrl.setRequestMethod("POST");
		  httpUrl.setDoOutput(true);//ע�� ����post����������� �����Ϊtrue
		  httpUrl.setUseCaches(false);//�رջ���
		  httpUrl.setReadTimeout(6000);
		  
		  //�������ֵ
		  StringBuffer sb=new StringBuffer();
		  for(Map.Entry<String, String> entry : params.entrySet())
		  {
			  sb.append(entry.getKey()).append("=").append(entry.getValue()).append("&");
		  }
		  sb.deleteCharAt(sb.length()-1);
		  
		  httpUrl.setRequestProperty("Accept-Language", "zh-CN");
		  httpUrl.setRequestProperty("User-Agent", " Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; MALN; Media Center PC 6.0)");
		  httpUrl.setRequestProperty("Content-Type", "application/x-www-form-urlencoded");
		  httpUrl.setRequestProperty("Content-Length", String.valueOf(sb.toString().getBytes().length));
		  httpUrl.setRequestProperty("Connection", "Keep-Alive");
		  httpUrl.setRequestProperty("Cache-Control", "no-cache");
		  
		  //���ݰ�
		  DataOutputStream dos=new DataOutputStream(httpUrl.getOutputStream());
		  dos.write(sb.toString().getBytes());
		  dos.close();
		  if(httpUrl.getResponseCode()!=200)
		  {
			   throw new Exception("����urlʧ��");
		  }
		 return httpUrl.getInputStream();
	 }
	 
	 /**
	  * @httpClientSendPost httpClient �������post���� (android����)
	  * @param path ����·��
	  * @param params �������
	  * @return ����������
	  */
	 public static InputStream httpClientSendPost(String method,Map<String,Object> params)throws Exception
	 {
		 //1. ����Post����
		 HttpPost post=new HttpPost(NetTool.httpPath(method));
		
		 //2.�󶨲�����post������
		 if(params!=null)
		 {
		 List<NameValuePair> parameters=new ArrayList<NameValuePair>();
		 for(Map.Entry<String, Object> entry : params.entrySet())
		 {
		 parameters.add(new BasicNameValuePair(entry.getKey(), entry.getValue().toString()));
		 }
		 post.setEntity(new UrlEncodedFormEntity(parameters, "UTF-8"));
		 }
		 
		 try {
			// ����post����
			 HttpClient httpClient=	 new DefaultHttpClient();
			 //���ӳ�ʱ
			httpClient.getParams().setParameter(CoreConnectionPNames.CONNECTION_TIMEOUT,30000);//6�볬ʱ
			 //����ʱ
			httpClient.getParams().setParameter(CoreConnectionPNames.SO_TIMEOUT,5000);
			 HttpResponse  response=httpClient.execute(post);
			 int stateCode=response.getStatusLine().getStatusCode();
			 HandleResponseStatusCode(stateCode);
			 if(stateCode==200)
			 {
				 return response.getEntity().getContent();
			 }
		} catch (SocketTimeoutException e) {
			 throw new HttpException("�������ӳ�ʱ����������������!");
		}catch(ClientProtocolException cpe)
		{
			throw new HttpException("����ʱ,������!");
		}
		 return null;
	 }
	 
	 /**
	  * ����xml���ݵ�������
	  * @param path ����·��
	  * @param xmlData xml��������
	  * @return ����������
	  * @throws Exception
	  */
	 public static InputStream sendXMLDataToInternet(String method,byte [] xmlData)throws Exception
	 {
		 URL url=new URL(NetTool.httpPath(method));
		 HttpURLConnection httpUrl=(HttpURLConnection) url.openConnection();
		 httpUrl.setRequestMethod("POST");
		 httpUrl.setReadTimeout(6000);
		 httpUrl.setDoOutput(true);
		 httpUrl.setUseCaches(false);
		 httpUrl.setRequestProperty("Accept-Language", "zh-CN");
		 httpUrl.setRequestProperty("User-Agent", " Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; MALN; Media Center PC 6.0)");
		 httpUrl.setRequestProperty("Content-Type", "text/xml;charset=UTF-8");//�������ͱ��xml��ʽ
		 httpUrl.setRequestProperty("Content-Length",String.valueOf(xmlData.length));
		 httpUrl.setRequestProperty("Connection", "Keep-Alive");
		 httpUrl.setRequestProperty("Cache-Control", "no-cache");
		 
		 //��OutPutStream ������ݰ��� ���ͻ�����
		 DataOutputStream dos=new DataOutputStream(httpUrl.getOutputStream());
		 dos.write(xmlData);
		 dos.close();
		 if(httpUrl.getResponseCode()!=200)
		 {
			  throw new Exception("����Urlʧ��");
		 }
		 return httpUrl.getInputStream();
	 }
	 
	
	 
	 
	 /**
	  * @fileUplod �ļ��ϴ�
	  * @param path ����·��
	  * @param params �������
	  * @param formFile ����Ϣ
	  * @return ����������
	  */
	 public static InputStream fileUplod(String method,Map<String,Object> params,FormFile formFile) throws Exception
	 {
		 String  boundary="---------------------------7dcf54d03c2";
		 String formData="multipart/form-data";
		 
		 URL url=new URL(C.http.httpPic()+method);
		 HttpURLConnection httpUrl=(HttpURLConnection) url.openConnection();
		 httpUrl.setRequestMethod("POST");
		 httpUrl.setDoOutput(true);//����post����ʱ �������õ�
		 httpUrl.setDoInput(true);
		 httpUrl.setUseCaches(false);
		 httpUrl.setChunkedStreamingMode(1024);
		 httpUrl.setRequestProperty("Accept-Language", "zh-CN");
		 httpUrl.setRequestProperty("User-Agent", "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; MALN; Media Center PC 6.0)");
		 httpUrl.setRequestProperty("Content-Type", formData+";  boundary="+boundary);
		 httpUrl.setRequestProperty("Connection", "Keep-Alive");
		 httpUrl.setRequestProperty("Cache-Control", "no-cache");
		 
		 //�������
		 StringBuffer paramsSB=new StringBuffer();
		 
		 for(Map.Entry<String, Object> entry : params.entrySet())
		 {
			 paramsSB.append("--"+boundary).append("\r\n");
			 paramsSB.append("Content-Disposition: form-data; name=\""+entry.getKey()+"\"");
			 paramsSB.append("\r\n\r\n").append(entry.getValue()).append("\r\n");
		 }
		 DataOutputStream dos=new DataOutputStream(httpUrl.getOutputStream());
		 dos.write(paramsSB.toString().getBytes());
		 
		 //�ļ�����
		 StringBuffer fileSB=new StringBuffer();
		 fileSB.append("--"+boundary).append("\r\n");
		 fileSB.append("Content-Disposition: form-data; name=\""+formFile.getFormName()+"\"; filename=\""+formFile.getFileName()+"\"");
		 fileSB.append("\r\n").append("Content-Type: "+formFile.getContentType());
		 fileSB.append("\r\n\r\n");
		 dos.write(fileSB.toString().getBytes());
		 
		 if(formFile.getInputStream()!=null)
		 {
			 byte [] data=new byte[1024];
			 int len=-1;
			 while((len=formFile.getInputStream().read(data))!=-1)
			 {
				 
				 dos.write(data, 0, len);//ByteArrayOutputStream
			 }
		 }else
		 {
		   dos.write(formFile.getData());//�ļ�����
		 }
		 
		 //����
		 StringBuffer endSB=new StringBuffer();
		 endSB.append("\r\n");
		 endSB.append("--"+boundary).append("--");
		 
		 
		 dos.write(endSB.toString().getBytes());
		 dos.close();
		 if(httpUrl.getResponseCode()!=200)
		 {
			  throw new Exception("����Urlʧ��");
		 }
		 return httpUrl.getInputStream();
	 }
	 

	 
	 
	 /**
		 * Handle Status code
		 * 
		 * @param statusCode
		 *            ��Ӧ��״̬��
		 * @param res
		 *            ��������Ӧ
		 * @throws HttpException
		 *             ����Ӧ�벻Ϊ200ʱ���ᱨ�����쳣:<br />
		 *             <li>HttpRequestException, ͨ������������Ĵ���,����������� ��ַ����404��, �׳����쳣,
		 *             ���ȼ��request log, ȷ�ϲ�����Ϊ����������ʧ��</li> <li>HttpAuthException,
		 *             ͨ��������Authʧ��, ���������֤��¼���û���/����/KEY��</li> <li>
		 *             HttpRefusedException, ͨ�������ڷ��������ܵ�����, ���ܾ�����, ���Ƕ���ԭ��, ����ԭ��
		 *             �������᷵�ؾܾ�����, ����HttpRefusedException#getError#getMessage�鿴</li>
		 *             <li>HttpServerException, ͨ�������ڷ�������������ʱ, �����������Ƿ��������ṩ����</li>
		 *             <li>HttpException, ����δ֪����.</li>
		 */
		private static void HandleResponseStatusCode(int statusCode)
				throws HttpException {
			String msg = getCause(statusCode) + "\n";

			switch (statusCode) {
			// It's OK, do nothing
			case OK:
				break;

			// Mine mistake, Check the Log
			case NOT_MODIFIED:
			case BAD_REQUEST:
			case NOT_FOUND:
			case NOT_ACCEPTABLE:
				throw new HttpException(msg);

				// UserName/Password incorrect
			case NOT_AUTHORIZED:
				throw new HttpException(msg );

				// Server will return a error message, use
				// HttpRefusedException#getError() to see.
			case FORBIDDEN:
				throw new HttpException(msg);

				// Something wrong with server
			case INTERNAL_SERVER_ERROR:
			case BAD_GATEWAY:
			case SERVICE_UNAVAILABLE:
				throw new HttpException(msg);

				// Others
			default:
				throw new HttpException(msg);
			}
		}
		/**
		 * ����HTTP������
		 * 
		 * @param statusCode
		 * @return
		 */
		private static String getCause(int statusCode) {
			String cause = null;
			switch (statusCode) {
			case NOT_MODIFIED:
				break;
			case BAD_REQUEST:
				cause = "The request was invalid.  An accompanying error message will explain why. This is the status code will be returned during rate limiting.";
				break;
			case NOT_AUTHORIZED:
				cause = "Authentication credentials were missing or incorrect.";
				break;
			case FORBIDDEN:
				cause = "The request is understood, but it has been refused.  An accompanying error message will explain why.";
				break;
			case NOT_FOUND:
				cause = "The URI requested is invalid or the resource requested, such as a user, does not exists.";
				break;
			case NOT_ACCEPTABLE:
				cause = "Returned by the Search API when an invalid format is specified in the request.";
				break;
			case INTERNAL_SERVER_ERROR:
				cause = "Something is broken.  Please post to the group so the Weibo team can investigate.";
				break;
			case BAD_GATEWAY:
				cause = "Weibo is down or being upgraded.";
				break;
			case SERVICE_UNAVAILABLE:
				cause = "Service Unavailable: The Weibo servers are up, but overloaded with requests. Try again later. The search and trend methods use this to indicate when you are being rate limited.";
				break;
			default:
				cause = "";
			}
			return statusCode + ":" + cause;
		}
		
		 public static Builder getAlertBuilder(Context context,String title,String message)
		 {
			 return new AlertDialog.Builder(context).setTitle(title==null ? "��ʾ" : title).setMessage(message);
		 }
		 //��ʾ toastЧ��
		 public static void showToast(Context context,String text)
		 {
			Toast toast= Toast.makeText(context, text, Toast.LENGTH_LONG);
			toast.setGravity(Gravity.CENTER, 0, 0);
			LinearLayout linearLayout=(LinearLayout) toast.getView();
			linearLayout.setOrientation(LinearLayout.HORIZONTAL);
			ImageView imageView=new ImageView(context);
			imageView.setLayoutParams(new LayoutParams(LayoutParams.WRAP_CONTENT,LayoutParams.WRAP_CONTENT));
			imageView.setImageResource(R.drawable.icon);
			linearLayout.addView(imageView, 0);
			toast.setView(linearLayout);
			toast.show();
		 }
		//��ʾ toastЧ��
		 public static void showToast(Context context,int text)
		 {
			
			Toast toast= Toast.makeText(context, text, Toast.LENGTH_LONG);
			toast.setGravity(Gravity.CENTER, 0, 0);
			LinearLayout linearLayout=(LinearLayout) toast.getView();
			linearLayout.setOrientation(LinearLayout.HORIZONTAL);
			ImageView imageView=new ImageView(context);
			imageView.setLayoutParams(new LayoutParams(LayoutParams.WRAP_CONTENT,LayoutParams.WRAP_CONTENT));
			imageView.setImageResource(R.drawable.icon);
			linearLayout.addView(imageView, 0);
			toast.setView(linearLayout);
			toast.show();
		 }
		 /**
		  * ��ʾ�Ƿ� ���˵����������
		  * @param activity ��ǰactivity����
		  */
		 public static void showMain(final Activity activity)
		 {
				Builder builder = NetTool.getAlertBuilder(activity, null, "   ȷ�����˵���������  ");
				builder.setIcon(R.drawable.icon);
				builder.setPositiveButton("ȷ��", new DialogInterface.OnClickListener() {
					public void onClick(DialogInterface dialog, int which) {
						activity.finish();
						dialog.cancel();
						
					}
				}).setNeutralButton("ȡ��", new DialogInterface.OnClickListener() {
					public void onClick(DialogInterface dialog, int which) {
						dialog.cancel();
					}
				}).show();
		 }
		 
		 
		 
		 public static String httpPath(String method)
		 {
			 return C.http.httpPic()+method;
		 }
		 
		 /**
		  *  json Object ����
		  * @param method
		  * @param params
		  * @return
		  * @throws Exception
		  */
		 public static JSONObject getJSONObject(String method,HashMap<String,Object> params) throws Exception
		 {
			  InputStream is= httpClientSendPost(method, params);
			  byte [] data=  readStream(is);
			  JSONObject jsonObject=new JSONObject(new String(data,"UTF-8"));
			  return jsonObject;
		 }
		 
		 /**
		  * json Object �������
		  * @param method
		  * @param params
		  * @return
		  * @throws Exception
		  */
		 public static JSONArray getJSONArray(String method,HashMap<String,Object> params) throws Exception
		 {
			  InputStream is= httpClientSendPost(method, params);
			  byte [] data=  readStream(is);
			  JSONArray jsonArray=new JSONArray(new String(data,"UTF-8"));
			  return jsonArray;
		 }

		 public static String getResultString(String method,HashMap<String,Object> params) throws Exception
		 {
				  InputStream is= httpClientSendPost(method, params);
				  byte [] data=  readStream(is);
				  return new String(data,"UTF-8");
			 
		 }
		 
}

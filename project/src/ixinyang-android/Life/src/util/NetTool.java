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
 * 互联网辅助类
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
	 * @readImageData  获取服务器上的图片
	 * @param imagePath 请求路劲 
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
	 * @readImageData  获取服务器上的图片
	 * @param path 请求路劲
	 * @return 图片二进制数据
	 *  
	 */
	 public static byte[] readImageData(String path) throws Exception
	 {
		  //如何请求服务器
		 URL url=new URL(path);
		 HttpURLConnection httpUrl=(HttpURLConnection) url.openConnection();
		 httpUrl.setChunkedStreamingMode(1024*10);
		 httpUrl.setRequestMethod("GET");
		 httpUrl.setReadTimeout(6000);
		 if(httpUrl.getResponseCode()==200)//标识200 表示请求成功
		 {
			InputStream is=   httpUrl.getInputStream();
			return readStream(is);
		 }
		 
		 return null;
	 }
	 
	 /**
	  * @sendGetRequest  发送get请求
	  * @param path 请求路劲
	  * @return 输入流对象
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
		 if(httpUrl.getResponseCode()==200)//标识200 表示请求成功
		 {
			InputStream is=   httpUrl.getInputStream();
			return is;
		 }
		 return null;
	 }
	 /**
	  * @readHtmlContent  读取互联网上的html代码内容
	  * @param path 请求路劲
	  * @return 字符串： html代码内容
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
	  * @readStream 读取输入流中数据
	  * @param is 输入流对象
	  * @return 二进制数据
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
	  * @sendPostToInternetWithParam 发送post请求到Internet服务器
	  * @param path 请求路劲
	  * @param params 请求参数
	  * @return 输入流对象
	  */
	 public static InputStream sendPostToInternetWithParam(String method,Map<String,String> params)throws Exception
	 {
		  URL url=new URL(NetTool.httpPath(method));
		  HttpURLConnection httpUrl= (HttpURLConnection) url.openConnection();
		  httpUrl.setRequestMethod("POST");
		  httpUrl.setDoOutput(true);//注意 发送post请求必须设置 输出流为true
		  httpUrl.setUseCaches(false);//关闭缓存
		  httpUrl.setReadTimeout(6000);
		  
		  //请求参数值
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
		  
		  //数据包
		  DataOutputStream dos=new DataOutputStream(httpUrl.getOutputStream());
		  dos.write(sb.toString().getBytes());
		  dos.close();
		  if(httpUrl.getResponseCode()!=200)
		  {
			   throw new Exception("请求url失败");
		  }
		 return httpUrl.getInputStream();
	 }
	 
	 /**
	  * @httpClientSendPost httpClient 组件发送post请求 (android集成)
	  * @param path 请求路劲
	  * @param params 请求参数
	  * @return 输入流对象
	  */
	 public static InputStream httpClientSendPost(String method,Map<String,Object> params)throws Exception
	 {
		 //1. 创建Post对象
		 HttpPost post=new HttpPost(NetTool.httpPath(method));
		
		 //2.绑定参数到post请求上
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
			// 发送post请求
			 HttpClient httpClient=	 new DefaultHttpClient();
			 //连接超时
			httpClient.getParams().setParameter(CoreConnectionPNames.CONNECTION_TIMEOUT,30000);//6秒超时
			 //请求超时
			httpClient.getParams().setParameter(CoreConnectionPNames.SO_TIMEOUT,5000);
			 HttpResponse  response=httpClient.execute(post);
			 int stateCode=response.getStatusLine().getStatusCode();
			 HandleResponseStatusCode(stateCode);
			 if(stateCode==200)
			 {
				 return response.getEntity().getContent();
			 }
		} catch (SocketTimeoutException e) {
			 throw new HttpException("网络连接超时，请设置网络连接!");
		}catch(ClientProtocolException cpe)
		{
			throw new HttpException("请求超时,请重试!");
		}
		 return null;
	 }
	 
	 /**
	  * 发送xml数据到服务器
	  * @param path 请求路劲
	  * @param xmlData xml内容数据
	  * @return 输入流对象
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
		 httpUrl.setRequestProperty("Content-Type", "text/xml;charset=UTF-8");//内容类型变成xml方式
		 httpUrl.setRequestProperty("Content-Length",String.valueOf(xmlData.length));
		 httpUrl.setRequestProperty("Connection", "Keep-Alive");
		 httpUrl.setRequestProperty("Cache-Control", "no-cache");
		 
		 //将OutPutStream 变成数据包流 发送互联网
		 DataOutputStream dos=new DataOutputStream(httpUrl.getOutputStream());
		 dos.write(xmlData);
		 dos.close();
		 if(httpUrl.getResponseCode()!=200)
		 {
			  throw new Exception("请求Url失败");
		 }
		 return httpUrl.getInputStream();
	 }
	 
	
	 
	 
	 /**
	  * @fileUplod 文件上传
	  * @param path 请求路劲
	  * @param params 请求参数
	  * @param formFile 表单信息
	  * @return 输入流对象
	  */
	 public static InputStream fileUplod(String method,Map<String,Object> params,FormFile formFile) throws Exception
	 {
		 String  boundary="---------------------------7dcf54d03c2";
		 String formData="multipart/form-data";
		 
		 URL url=new URL(C.http.httpPic()+method);
		 HttpURLConnection httpUrl=(HttpURLConnection) url.openConnection();
		 httpUrl.setRequestMethod("POST");
		 httpUrl.setDoOutput(true);//设置post请求时 必须设置的
		 httpUrl.setDoInput(true);
		 httpUrl.setUseCaches(false);
		 httpUrl.setChunkedStreamingMode(1024);
		 httpUrl.setRequestProperty("Accept-Language", "zh-CN");
		 httpUrl.setRequestProperty("User-Agent", "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; MALN; Media Center PC 6.0)");
		 httpUrl.setRequestProperty("Content-Type", formData+";  boundary="+boundary);
		 httpUrl.setRequestProperty("Connection", "Keep-Alive");
		 httpUrl.setRequestProperty("Cache-Control", "no-cache");
		 
		 //请求参数
		 StringBuffer paramsSB=new StringBuffer();
		 
		 for(Map.Entry<String, Object> entry : params.entrySet())
		 {
			 paramsSB.append("--"+boundary).append("\r\n");
			 paramsSB.append("Content-Disposition: form-data; name=\""+entry.getKey()+"\"");
			 paramsSB.append("\r\n\r\n").append(entry.getValue()).append("\r\n");
		 }
		 DataOutputStream dos=new DataOutputStream(httpUrl.getOutputStream());
		 dos.write(paramsSB.toString().getBytes());
		 
		 //文件参数
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
		   dos.write(formFile.getData());//文件数据
		 }
		 
		 //结束
		 StringBuffer endSB=new StringBuffer();
		 endSB.append("\r\n");
		 endSB.append("--"+boundary).append("--");
		 
		 
		 dos.write(endSB.toString().getBytes());
		 dos.close();
		 if(httpUrl.getResponseCode()!=200)
		 {
			  throw new Exception("请求Url失败");
		 }
		 return httpUrl.getInputStream();
	 }
	 

	 
	 
	 /**
		 * Handle Status code
		 * 
		 * @param statusCode
		 *            响应的状态码
		 * @param res
		 *            服务器响应
		 * @throws HttpException
		 *             当响应码不为200时都会报出此异常:<br />
		 *             <li>HttpRequestException, 通常发生在请求的错误,如请求错误了 网址导致404等, 抛出此异常,
		 *             首先检查request log, 确认不是人为错误导致请求失败</li> <li>HttpAuthException,
		 *             通常发生在Auth失败, 检查用于验证登录的用户名/密码/KEY等</li> <li>
		 *             HttpRefusedException, 通常发生在服务器接受到请求, 但拒绝请求, 可是多种原因, 具体原因
		 *             服务器会返回拒绝理由, 调用HttpRefusedException#getError#getMessage查看</li>
		 *             <li>HttpServerException, 通常发生在服务器发生错误时, 检查服务器端是否在正常提供服务</li>
		 *             <li>HttpException, 其他未知错误.</li>
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
		 * 解析HTTP错误码
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
			 return new AlertDialog.Builder(context).setTitle(title==null ? "提示" : title).setMessage(message);
		 }
		 //显示 toast效果
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
		//显示 toast效果
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
		  * 提示是否 回退到主界面操作
		  * @param activity 当前activity对象
		  */
		 public static void showMain(final Activity activity)
		 {
				Builder builder = NetTool.getAlertBuilder(activity, null, "   确定回退到主界面吗  ");
				builder.setIcon(R.drawable.icon);
				builder.setPositiveButton("确定", new DialogInterface.OnClickListener() {
					public void onClick(DialogInterface dialog, int which) {
						activity.finish();
						dialog.cancel();
						
					}
				}).setNeutralButton("取消", new DialogInterface.OnClickListener() {
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
		  *  json Object 对象
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
		  * json Object 数组对象
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

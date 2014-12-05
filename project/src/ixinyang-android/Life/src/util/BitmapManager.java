package util;
import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.lang.ref.SoftReference;
import java.net.URL;
import java.net.URLEncoder;
import java.util.Collections;
import java.util.HashMap;
import java.util.Map;
import java.util.WeakHashMap;
import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;

import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.os.Environment;
import android.os.Handler;
import android.os.Message;
import android.os.StatFs;
import android.view.View;
import android.widget.ImageView;

import com.huayan.life.Activity.BaseActivity;



/**
 * 加载异步图片 
 */
public enum BitmapManager {
	INSTANCE;
	/** debug 是否开启 调试log ：false*/
	private static boolean debug = false;
	private final Map<String, SoftReference<Bitmap>> cache;
	private final ExecutorService pool;
	/** 缓存图片控件对象 */
	private Map<ImageView, String> imageMap = Collections
			.synchronizedMap(new WeakHashMap<ImageView, String>());
	
	private static int FREE_SD_SPACE_NEEDED_TO_CACHE = 1;
	private static int MB = 1024 * 1024;
	/** 缓存目录	 */
	public static String DIR = Environment.getExternalStorageDirectory().getPath()
			+ "/Android/data/"+BaseActivity.class.getPackage().toString().replace("package ", "").trim()+"/cache/image";

	/** 测试用 */
	private static String tag = "BitmapManager";
	
	 BitmapManager() {
		cache = new HashMap<String, SoftReference<Bitmap>>();
		pool = Executors.newFixedThreadPool(10);
	}

	/**
	 * 1.加载图片，优先加载本地缓存图片
	 * 
	 * @param url
	 * @param imageView
	 * @param width
	 * @param height
	 */
	public void loadBitmap(String url, final ImageView imageView,
			final int width, final int height, int defaultImageId, boolean isCache) {
		Bitmap bitmap = null;
		if (imageView == null) return;
		if(url==null) {
			imageView.setImageResource(defaultImageId);
			return;
		}
		url = C.http.httpPic() + url;
		imageMap.put(imageView, url);
		bitmap = getBitmapFromCache(url); // 获取缓存
		if (bitmap != null) {
			imageView.setImageBitmap(bitmap);
			imageView.setVisibility(View.VISIBLE);
		} else {
			if (isCache) { // 如果开启缓存本地情况 进行取本地数据
				bitmap = getLocalBitmap(url);
			}
			if (null != bitmap) {
				imageView.setImageBitmap(bitmap);
				imageView.setVisibility(View.VISIBLE);
				url = picName(url);
				cache.put(url, new SoftReference<Bitmap>(bitmap)); // 加入内存
			} else {
				imageView.setImageResource(defaultImageId);
				queueJob(url, imageView, width, height, defaultImageId, isCache); // 获取网络图片
			}
		}
		
	}
	
	/**
	 * 2.获取程序内存Cache的缓存图片
	 * @param url
	 * @return
	 */
	public Bitmap getBitmapFromCache(String url) {
		url = picName(url);
		if (cache.containsKey(url)) {
			return cache.get(url).get();
		}
		return null;
	}
	
	/**
	 * 3.获取 本地缓存图片
	 * 
	 * @param url
	 * @return
	 */
	public Bitmap getLocalBitmap(String url) {
		Bitmap map = null;
		url = picName(url);
		if(url == null || url.equals("null")) return null;
		String localUrl = URLEncoder.encode(url);
		if (Exist(localUrl))
			map = BitmapFactory.decodeFile(DIR + "/" + localUrl);
		return map;
	}
	
	/**
	 * 4.开启线程
	 * @param url
	 * @param imageView
	 * @param width
	 * @param height
	 */
	public void queueJob(final String url, final ImageView imageView,
			final int width, final int height, final int defaultImageId, final boolean isCache) {
		final Handler handler = new Handler() {
			@Override
			public void handleMessage(Message msg) {
				String tag = imageMap.get(imageView);
				if (tag != null && tag.equals(url)) {
					if (msg.obj != null) {
						imageView.setImageBitmap((Bitmap) msg.obj);
						imageView.setVisibility(View.VISIBLE);
					} else {
						imageView.setImageResource(defaultImageId);
						if(debug)Log.d(tag, "fail " + url);
					}
				}
			}
		};
		pool.submit(new Runnable() {
			@Override
			public void run() {
				Bitmap bmp = downloadBitmap(url, width, height, isCache);
				Message message = Message.obtain();
				message.obj = bmp;
				if(debug)Log.d(tag, "Item downloaded: " + url);
				handler.sendMessage(message);
			}
		});
	}
	

	/**
	 * 5.下载网络图片
	 * 
	 * @param url
	 * @param width
	 * @param height
	 * @return
	 */
	private Bitmap downloadBitmap(String url, int width, int height, boolean isCache) {
		String downUrl = url;
		try {
			url = picName(url);
			if(url == null || url.equals("null")) return null;
			Bitmap bitmap = BitmapFactory.decodeStream((InputStream) new URL(downUrl).getContent());
			// bitmap = Bitmap.createScaledBitmap(bitmap, width, height, true);
			
			cache.put(url, new SoftReference<Bitmap>(bitmap));
			if(isCache)
				saveBmpToSd(bitmap, URLEncoder.encode(url));
			return bitmap;
		} catch (IOException e){
			if(debug)Log.e(tag, "downloadBitmap:IOException");
		} catch (Exception e) {
			if(debug)Log.e(tag, "downloadBitmap:Exception");
		}
		return null;
	}

	/**
	 * 6.保存图片到本地缓存
	 * 
	 * @param bm
	 * @param url
	 */
	public static void saveBmpToSd(Bitmap bm, String url) {
		if(url == null ||url.equals("null")) return;
		if (bm == null) {
			if(debug)Log.w(tag, " trying to savenull bitmap");
			return;
		}
		// 判断sdcard上的空间
		if (FREE_SD_SPACE_NEEDED_TO_CACHE > freeSpaceOnSd()) {
			if(debug)Log.w(tag, "Low free space onsd, do not cache");
			return;
		}
		if (!Environment.MEDIA_MOUNTED.equals(Environment
				.getExternalStorageState()))
			return;
		if(debug)Log.i(tag, "path:"+Environment.getExternalStorageDirectory().getPath());
		String filename = url;
		// 目录不存在就创建
		File dirPath = new File(DIR);
		if (!dirPath.exists()) {
			dirPath.mkdirs();
		}

		File file = new File(DIR + "/" + filename);
		try {
			file.createNewFile();
			OutputStream outStream = new FileOutputStream(file);
			String picType = url.substring(url.lastIndexOf("_")+1).toLowerCase();
			if(picType.equals("png"))
				bm.compress(Bitmap.CompressFormat.PNG, 80, outStream);
			else //if (picType.equals("jpg")||picType.equals("jpeg"))
				bm.compress(Bitmap.CompressFormat.JPEG, 80, outStream);
			outStream.flush();
			outStream.close();

			if(debug)Log.i(tag, "Image saved tosd");
		} catch (FileNotFoundException e) {
			if(debug)Log.w(tag, "FileNotFoundException");
		} catch (IOException e) {
			if(debug)Log.w(tag, "IOException");
		}
	}
	
	/**
	 * 计算sdcard上的剩余空间
	 * 
	 * @return
	 */
	private static int freeSpaceOnSd() {
		StatFs stat = new StatFs(Environment.getExternalStorageDirectory()
				.getPath());
		double sdFreeMB = ((double) stat.getAvailableBlocks() * (double) stat
				.getBlockSize()) / MB;

		return (int) sdFreeMB;
	}

	/**
	 * 判断本地是否有该url对应图片
	 * @param url
	 * @return
	 */
	private static boolean Exist(String url) {
		File file = new File(DIR + "/" + url);
		return file.exists();
	}
	
	/**
	 * 格式化图片名称
	 * @param url
	 * @return
	 */
	private String picName(String url){
		if(debug)Log.d(tag, url);
		url = url.replace("\\", "/");
		url = url.substring(url.lastIndexOf("/")+1);
		if(url.equals("null")) return null;
		url = url.substring(0,url.lastIndexOf("."))+"_"+url.substring(url.lastIndexOf(".")+1);
		return url;
	}

}
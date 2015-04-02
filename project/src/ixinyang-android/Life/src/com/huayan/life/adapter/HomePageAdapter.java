package com.huayan.life.adapter;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;

import org.apache.http.Header;

import util.HttpUrl;
import util.HttpUtils;
import android.annotation.SuppressLint;
import android.content.Context;
import android.graphics.Bitmap;
import android.os.Handler;
import android.os.Message;
import android.support.v4.view.ViewPager.OnPageChangeListener;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.ViewGroup.LayoutParams;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;

import com.huayan.life.R;
import com.huayan.life.view.AdvViewPager;
import com.loopj.android.http.JsonHttpResponseHandler;
import com.loopj.android.http.RequestParams;
import com.nostra13.universalimageloader.cache.memory.impl.WeakMemoryCache;
import com.nostra13.universalimageloader.core.DisplayImageOptions;
import com.nostra13.universalimageloader.core.ImageLoader;
import com.nostra13.universalimageloader.core.ImageLoaderConfiguration;
import com.nostra13.universalimageloader.core.assist.ImageScaleType;
import com.nostra13.universalimageloader.core.assist.QueueProcessingType;
import com.nostra13.universalimageloader.core.display.RoundedBitmapDisplayer;

@SuppressLint("HandlerLeak")
public class HomePageAdapter extends BaseAdapter {

	private Context context;
	private List<HashMap<String, String>> list;
	private ImageLoader imageLoader = null;
	private DisplayImageOptions options = null;
	private int currentPage = 0;
	//美食 1   酒店2  电影 3   休闲娱乐 4   生活服务  5   丽人 6   
	

	@SuppressWarnings("deprecation")
	public HomePageAdapter(Context context, List<HashMap<String, String>> news) {
		this.context = context;
		this.list = news;
		imageLoader = ImageLoader.getInstance();
		ImageLoaderConfiguration config = new ImageLoaderConfiguration.Builder(
				context)
				.memoryCacheExtraOptions(480, 800)//即保存的每个缓存文件的最大长宽
				.threadPoolSize(3)// 线程池内加载的数量
				.threadPriority(Thread.NORM_PRIORITY - 2)
				.denyCacheImageMultipleSizesInMemory()
				.memoryCache(new WeakMemoryCache())
				.memoryCacheSize(2 * 1024 * 1024)
				.writeDebugLogs() // Remove for release app
				.tasksProcessingOrder(QueueProcessingType.LIFO).build();
		imageLoader.init(config);

		options = new DisplayImageOptions.Builder()
				.showImageOnLoading(R.drawable.pic)// 设置图片在下载期间显示的图片
				.showImageForEmptyUri(R.drawable.pic)	// 设置图片Uri为空或是错误的时候显示的图片
				.showImageOnFail(R.drawable.pic)// 设置图片加载/解码过程中错误时候显示的图片
				.displayer(new RoundedBitmapDisplayer(0xff000000, 10))
				.bitmapConfig(Bitmap.Config.RGB_565)
				.imageScaleType(ImageScaleType.IN_SAMPLE_INT)
				.cacheOnDisc(true)
				.build();
	}

	@Override
	public int getCount() {
		return list.size();
	}

	@Override
	public HashMap<String, String> getItem(int position) {
		return list.get(position);
	}

	@Override
	public long getItemId(int position) {
		return position;
	}

	@Override
	public View getView(int position, View convertView, ViewGroup parent) {
		final CacheView cacheView;
		if (convertView == null) {
			convertView = LayoutInflater.from(context).inflate(R.layout.item_store_category, null);
			cacheView = new CacheView();
			cacheView.tv_type = (TextView) convertView.findViewById(R.id.tv_type);
			cacheView.adv_type = (AdvViewPager) convertView.findViewById(R.id.adv_type);
			cacheView.vg_type = (ViewGroup) convertView.findViewById(R.id.vg_type);			
			convertView.setTag(cacheView);
		} else {
			cacheView = (CacheView) convertView.getTag();			
		}
		
		String type=getItem(position).get("type");
		LinearLayout.LayoutParams lp = new LinearLayout.LayoutParams(LinearLayout.LayoutParams.WRAP_CONTENT, LinearLayout.LayoutParams.WRAP_CONTENT);  
	
		if(type.length()>2){
			lp.setMargins(3, 0, 3, 0);  
		}else{
			lp.setMargins(8, 0, 8, 0);  
		}
		cacheView.tv_type.setLayoutParams(lp);
		cacheView.tv_type.setText(type);

		 final List<View> advs = new ArrayList<View>();		
		
		RequestParams params = new RequestParams(); // 绑定参数	
		params.put("isSuggest", 1);
		String typeId=getItem(position).get("typeId");
		params.put("type", typeId);//类别
		params.put("opeType", "getList");
		params.put("requestType", 1);
		params.put("mobile", 1);
		 
		 HttpUtils.post(HttpUrl.GOODSACTION, params, new JsonHttpResponseHandler(){

			@Override
			public void onSuccess(int statusCode, Header[] arg1, String responseString) {
				 if(statusCode==200){
//						try {
//							JSONObject obj =  JSON.parseObject(responseString);
//							Boolean result=obj.getBoolean("success");
//							if(result){
//							String content=obj.getString("content");													
//							JSONObject objContent=JSON.parseObject(content);
//							
//							JSONArray arr = objContent.getJSONArray("recordList");	
//							  String jsonString=arr.toString();
//							  List<Goods> goodsList=JSON.parseArray(jsonString, Goods.class);
//							
//							 for (int i = 0; i < goodsList.size(); i++) {
//								 Goods goods=goodsList.get(i);
//								ImageView iv = new ImageView(context);		
//								imageLoader.displayImage(goods.getShopImg(),iv, options);
//								advs.add(iv);
//								}							
//							}else{
//								Toast.makeText(context, context.getResources().getString(R.string.dialog_title_getDataFail), Toast.LENGTH_SHORT).show();
//							}							
//						} catch (JSONException e) {
//							e.printStackTrace();
//						}
				 }			
			}
			
			@Override
			public void onFailure(int statusCode, Header[] arg1, String responseString,Throwable error) {
					error.printStackTrace();
					
					for (int i = 0; i < 3; i++) {
						ImageView iv = new ImageView(context);
						if (i % 3 == 2) {
							iv.setBackgroundResource(R.drawable.advertising_default_3);
						} else if (i % 3 == 1) {
							iv.setBackgroundResource(R.drawable.advertising_default_2);
						} else {
							iv.setBackgroundResource(R.drawable.advertising_default_1);
						}
						advs.add(iv);
					}
					
					final ImageView[] imageViews = new ImageView[advs.size()];
					ImageView imageView;
					cacheView.vg_type.removeAllViews();
					
					for (int i = 0; i < advs.size(); i++) {
						imageView = new ImageView(context);						
						imageView.setLayoutParams(new LayoutParams(20, 20));
						imageViews[i] = imageView;
						if (i == 0) {
							imageViews[i].setBackgroundResource(R.drawable.banner_dian_focus);
						} else {
							imageViews[i].setBackgroundResource(R.drawable.banner_dian_blur);
						}				
						cacheView.vg_type.addView(imageViews[i]);
					}

					cacheView.adv_type.setAdapter(new AdvAdapter(advs));
					cacheView.adv_type.setOnPageChangeListener(new OnPageChangeListener() {

						@Override
						public void onPageSelected(int arg0) {
							currentPage = arg0;
							for (int i = 0; i < advs.size(); i++) {
								if (i == arg0) {
									imageViews[i].setBackgroundResource(R.drawable.banner_dian_focus);
								} else {
									imageViews[i].setBackgroundResource(R.drawable.banner_dian_blur);
								}
							}
						}

						@Override
						public void onPageScrolled(int arg0, float arg1, int arg2) {

						}

						@Override
						public void onPageScrollStateChanged(int arg0) {

						}
					});
			}			 
		 });		

//		final ImageView[] imageViews = new ImageView[advs.size()];
//		ImageView imageView;
//		for (int i = 0; i < advs.size(); i++) {
//			imageView = new ImageView(context);
//			imageView.setLayoutParams(new LayoutParams(20, 20));
//			imageViews[i] = imageView;
//			if (i == 0) {
//				imageViews[i].setBackgroundResource(R.drawable.banner_dian_focus);
//			} else {
//				imageViews[i].setBackgroundResource(R.drawable.banner_dian_blur);
//			}
//			cacheView.vg_type.addView(imageViews[i]);
//		}
//
//		cacheView.adv_type.setAdapter(new AdvAdapter2(advs));
//		cacheView.adv_type.setOnPageChangeListener(new OnPageChangeListener() {
//
//			@Override
//			public void onPageSelected(int arg0) {
//				currentPage = arg0;
//				for (int i = 0; i < advs.size(); i++) {
//					if (i == arg0) {
//						imageViews[i].setBackgroundResource(R.drawable.banner_dian_focus);
//					} else {
//						imageViews[i].setBackgroundResource(R.drawable.banner_dian_blur);
//					}
//				}
//			}
//
//			@Override
//			public void onPageScrolled(int arg0, float arg1, int arg2) {
//
//			}
//
//			@Override
//			public void onPageScrollStateChanged(int arg0) {
//
//			}
//		});

		final Handler handler = new Handler() {
			@Override
			public void handleMessage(Message msg) {
				cacheView.adv_type.setCurrentItem(msg.what);
				super.handleMessage(msg);
			}
		};
		
		new Thread(new Runnable() {
			@Override
			public void run() {
				while (true) {
					try {
						Thread.sleep(10000);
						currentPage++;
						if (currentPage > advs.size() - 1) {
							currentPage = 0;
						}
						handler.sendEmptyMessage(currentPage);
					} catch (InterruptedException e) {
						e.printStackTrace();
					}
				}
			}
		}).start();
		return convertView;
	}

	private static class CacheView {
		TextView tv_type;
		AdvViewPager adv_type;
		ViewGroup vg_type;
	}	
}

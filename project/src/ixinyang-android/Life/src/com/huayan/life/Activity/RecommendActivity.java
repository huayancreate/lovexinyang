package com.huayan.life.Activity;

import java.util.ArrayList;
import java.util.List;

import org.apache.http.Header;

import util.HttpUrl;
import util.HttpUtils;
import android.annotation.SuppressLint;
import android.graphics.Bitmap;
import android.os.Bundle;
import android.os.Handler;
import android.os.Message;
import android.support.v4.view.ViewPager;
import android.support.v4.view.ViewPager.OnPageChangeListener;
import android.view.LayoutInflater;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.ViewGroup;
import android.view.ViewGroup.LayoutParams;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.RelativeLayout;
import android.widget.Toast;

import com.alibaba.fastjson.JSON;
import com.alibaba.fastjson.JSONArray;
import com.alibaba.fastjson.JSONException;
import com.alibaba.fastjson.JSONObject;
import com.handmark.pulltorefresh.library.PullToRefreshBase.Mode;
import com.handmark.pulltorefresh.library.PullToRefreshListView;
import com.huayan.life.R;
import com.huayan.life.adapter.AdvAdapter;
import com.huayan.life.adapter.HomePageAdapter;
import com.huayan.life.adapter.MyPagerAdapter;
import com.huayan.life.common.GetData;
import com.huayan.life.model.Banner;
import com.huayan.life.view.AdvViewPager;
import com.loopj.android.http.JsonHttpResponseHandler;
import com.loopj.android.http.RequestParams;
import com.nostra13.universalimageloader.core.DisplayImageOptions;
import com.nostra13.universalimageloader.core.assist.ImageScaleType;
import com.nostra13.universalimageloader.core.display.RoundedBitmapDisplayer;

/**
 * 
 * @author wzz
 *首页
 */
@SuppressLint("HandlerLeak")
public class RecommendActivity extends BaseActivity implements OnClickListener {

	public static final int HTTP_REQUEST_SUCCESS = -1;
	public static final int HTTP_REQUEST_ERROR = 0;

	private ViewPager vpViewPager = null;
	private List<View> views = null;
	private PullToRefreshListView ptrlvHeadLineNews = null;
	private HomePageAdapter newAdapter = null;

	private AdvViewPager vpAdv = null;
	private ViewGroup vg = null;
	private ImageView[] imageViews = null;
	private List<View> advs = null;
	private int currentPage = 0;
	Handler myHandler;
	List <Banner> bannerList=null;
	private DisplayImageOptions options = null;

	@SuppressWarnings("deprecation")
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_recommend);
		
		options = new DisplayImageOptions.Builder()
		.showImageOnLoading(R.drawable.pic)// 设置图片在下载期间显示的图片
		.showImageForEmptyUri(R.drawable.pic)	// 设置图片Uri为空或是错误的时候显示的图片
		.showImageOnFail(R.drawable.pic)// 设置图片加载/解码过程中错误时候显示的图片
		.displayer(new RoundedBitmapDisplayer(0xff000000, 10))
		.bitmapConfig(Bitmap.Config.RGB_565)
		.imageScaleType(ImageScaleType.IN_SAMPLE_INT)
		.cacheOnDisc(true)
		.build();
		
		views = new ArrayList<View>();
		views.add(LayoutInflater.from(this).inflate(R.layout.head_lines, null));
		vpViewPager = (ViewPager) findViewById(R.id.adv_pager);
		vpViewPager.setAdapter(new MyPagerAdapter(views));
		vpViewPager.setOnPageChangeListener(new MyOnPageChangeListener());
		((LinearLayout) findViewById(R.id.ll_city)).setOnClickListener(this);
		((ImageView)findViewById(R.id.iv_search)).setOnClickListener(this);
		
		MyPagerAdapter myPagerAdapter = (MyPagerAdapter) vpViewPager.getAdapter();
		View v1 = myPagerAdapter.getItemAtPosition(0);
		
		ptrlvHeadLineNews = (PullToRefreshListView) v1.findViewById(R.id.ptrlvHeadLineNews);
		newAdapter = new HomePageAdapter(this, GetData.getHomePageList());
		initPullToRefreshListView(ptrlvHeadLineNews, newAdapter);
		
		ptrlvHeadLineNews.setOnItemClickListener(new OnItemClickListener() {
			@Override
			public void onItemClick(AdapterView<?> parent, View view,	int position, long id) {			
				jumpToActivity(RecommendActivity.this,CategoryActivity.class);
			}
		});
	}	
	
	/**
	 * 初始化PullToRefreshListView<br>
	 * 初始化在PullToRefreshListView中的ViewPager广告栏
	 * 
	 * @param rtflv
	 * @param adapter
	 */
	private void initPullToRefreshListView(PullToRefreshListView rtflv,HomePageAdapter adapter) {
		rtflv.setMode(Mode.BOTH);
//		rtflv.setOnRefreshListener(new MyOnRefreshListener3(rtflv,RecommendActivity.this, newAdapter));
		rtflv.setAdapter(adapter);

		if (rtflv.getId() == R.id.ptrlvHeadLineNews) {
			RelativeLayout rlAdv = (RelativeLayout) LayoutInflater.from(this)
					.inflate(R.layout.sliding_advertisement, null);
			vpAdv = (AdvViewPager)rlAdv.findViewById(R.id.vpAdv);
			vg = (ViewGroup)rlAdv.findViewById(R.id.viewGroup);

			advs = new ArrayList<View>();
			
			getBannerList();
			myHandler = new Handler() {
				@Override
				public void handleMessage(Message msg) {
					if (msg.what == 0x01) {
						Bundle bundle=msg.getData();
						String jsonStr=bundle.getString("jsonString");
						bannerList=  JSON.parseArray(jsonStr, Banner.class);		
//						for(int i=0;i<bannerList.size();i++){
//							Banner  ban=bannerList.get(i);
//							ImageView	iv = new ImageView(context);
//							imageLoader.displayImage(ban.getImg(),iv, options);
//							advs.add(iv);
//						}
						
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
						
						vpAdv.setAdapter(new AdvAdapter(advs));
						vpAdv.setOnPageChangeListener(new OnPageChangeListener() {

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

						imageViews = new ImageView[advs.size()];
						ImageView imageView;
						for (int i = 0; i < advs.size(); i++) {
							imageView = new ImageView(context);
							imageView.setLayoutParams(new LayoutParams(20, 20));
							imageViews[i] = imageView;
							if (i == 0) {
								imageViews[i].setBackgroundResource(R.drawable.banner_dian_focus);
							} else {
								imageViews[i].setBackgroundResource(R.drawable.banner_dian_blur);
							}
							vg.addView(imageViews[i]);
						}
						
					}
					super.handleMessage(msg);
				}
			};

//			vpAdv.setAdapter(new AdvAdapter(advs));
//			vpAdv.setOnPageChangeListener(new OnPageChangeListener() {
//
//				@Override
//				public void onPageSelected(int arg0) {
//					currentPage = arg0;
//					for (int i = 0; i < advs.size(); i++) {
//						if (i == arg0) {
//							imageViews[i].setBackgroundResource(R.drawable.banner_dian_focus);
//						} else {
//							imageViews[i].setBackgroundResource(R.drawable.banner_dian_blur);
//						}
//					}
//				}
//
//				@Override
//				public void onPageScrolled(int arg0, float arg1, int arg2) {
//
//				}
//
//				@Override
//				public void onPageScrollStateChanged(int arg0) {
//
//				}
//			});
//
//			imageViews = new ImageView[advs.size()];
//			ImageView imageView;
//			for (int i = 0; i < advs.size(); i++) {
//				imageView = new ImageView(this);
//				imageView.setLayoutParams(new LayoutParams(20, 20));
//				imageViews[i] = imageView;
//				if (i == 0) {
//					imageViews[i].setBackgroundResource(R.drawable.banner_dian_focus);
//				} else {
//					imageViews[i].setBackgroundResource(R.drawable.banner_dian_blur);
//				}
//				vg.addView(imageViews[i]);
//			}

			rtflv.getRefreshableView().addHeaderView(rlAdv, null, false);

			final Handler handler = new Handler() {
				@Override
				public void handleMessage(Message msg) {
					vpAdv.setCurrentItem(msg.what);
					super.handleMessage(msg);
				}
			};
			new Thread(new Runnable() {

				@Override
				public void run() {
					while (true) {
						try {
							Thread.sleep(5000);
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
		}
	}

		
	private void getBannerList() {		
		RequestParams params = new RequestParams(); // 绑定参数
		params.put("type", 1);
		params.put("opeType", "getBannerList");
		params.put("requestType", 1);
		params.put("mobile", 1);
		 
		 HttpUtils.post(HttpUrl.ADVACTION, params, new JsonHttpResponseHandler(){

			@Override
			public void onSuccess(int statusCode, Header[] arg1, String responseString) {
				 if(statusCode==200){
					/*	try {
							JSONObject obj =  JSON.parseObject(responseString);
							Boolean result=obj.getBoolean("success");
							if(result){
							String content=obj.getString("content");													
							JSONObject objContent=JSON.parseObject(content);				
							
							JSONArray arr = objContent.getJSONArray("recordList");	
							 final String jsonString=arr.toString();
							
							new Thread(new Runnable() {
								public void run() {
									Message msg = myHandler.obtainMessage();
									Bundle bd=new Bundle();
									bd.putString("jsonString", jsonString);
									msg.setData(bd);
									msg.what = 0x01;
									msg.sendToTarget();
								}
							}).start();
							}else{
								Toast.makeText(context, context.getResources().getString(R.string.dialog_title_getDataFail), Toast.LENGTH_SHORT).show();
							}											
						} catch (JSONException e) {
							e.printStackTrace();
						}*/
				 }			
			}
			
			@Override
			public void onFailure(int statusCode, Header[] arg1, String responseString,Throwable error) {
					error.printStackTrace();
					
					String json=GetData.getBanner();
					try {
						JSONObject obj =  JSON.parseObject(json);
						Boolean result=obj.getBoolean("success");
						if(result){
						String content=obj.getString("content");													
						JSONObject objContent=JSON.parseObject(content);				
						
						JSONArray arr = objContent.getJSONArray("recordList");	
						 final String jsonString=arr.toString();
						
						new Thread(new Runnable() {
							public void run() {
								Message msg = myHandler.obtainMessage();
								Bundle data=new Bundle();
								data.putString("jsonString", jsonString);
								msg.setData(data);
								msg.what = 0x01;
								msg.sendToTarget();
							}
						}).start();
						}else{
							Toast.makeText(context, context.getResources().getString(R.string.dialog_title_getDataFail), Toast.LENGTH_SHORT).show();
						}											
					} catch (JSONException e) {
						e.printStackTrace();
					}
	
			}			 
		 });
	}
	
	
	
	class MyOnPageChangeListener implements OnPageChangeListener {
		@Override
		public void onPageSelected(int arg0) {
		}

		@Override
		public void onPageScrolled(int arg0, float arg1, int arg2) {

		}

		@Override
		public void onPageScrollStateChanged(int arg0) {

		}
	}

	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.ll_city:
			//城市选择去除  只能选择信阳各个区
			break;
		case R.id.iv_search:
			jumpToActivity(RecommendActivity.this, QueryActivity.class);
			break;
		default:
			break;
		}
	}

}

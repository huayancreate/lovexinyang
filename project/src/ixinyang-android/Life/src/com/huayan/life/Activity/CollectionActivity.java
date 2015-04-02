package com.huayan.life.Activity;

import java.util.ArrayList;
import java.util.List;

import org.apache.http.Header;

import util.HttpUrl;
import util.HttpUtils;
import util.SharedPreferencesUtility;
import android.annotation.SuppressLint;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.BitmapFactory;
import android.graphics.Matrix;
import android.os.Bundle;
import android.os.Handler;
import android.os.Message;
import android.support.v4.view.ViewPager;
import android.support.v4.view.ViewPager.OnPageChangeListener;
import android.util.DisplayMetrics;
import android.view.LayoutInflater;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.animation.Animation;
import android.view.animation.TranslateAnimation;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.alibaba.fastjson.JSON;
import com.alibaba.fastjson.JSONArray;
import com.alibaba.fastjson.JSONException;
import com.alibaba.fastjson.JSONObject;
import com.handmark.pulltorefresh.library.PullToRefreshBase.Mode;
import com.handmark.pulltorefresh.library.PullToRefreshListView;
import com.huayan.life.R;
import com.huayan.life.adapter.MyPagerAdapter;
import com.huayan.life.adapter.NearTuanGouAdapter;
import com.huayan.life.adapter.StoreListAdapter;
import com.huayan.life.common.GetData;
import com.huayan.life.common.MyOnRefreshListener5;
import com.huayan.life.common.MyOnRefreshListener9;
import com.huayan.life.model.Goods;
import com.huayan.life.model.Shop;
import com.loopj.android.http.JsonHttpResponseHandler;
import com.loopj.android.http.RequestParams;

/**
 * 收藏管理
 * 
 * @author wzz
 *
 */
@SuppressLint("HandlerLeak")
public class CollectionActivity extends BaseActivity implements OnClickListener {
	private ViewPager vpViewPager = null;
	private List<View> views = null;

	private int offset; // 间隔
	private int cursorWidth; // 游标的长度
	private int originalIndex = 0;
	private ImageView cursor = null;
	private Animation animation = null;
	private PullToRefreshListView ptrlvFilm = null;//商品
	private PullToRefreshListView ptrlvHotel = null;//店铺
	private StoreListAdapter storeListAdapter;
	private NearTuanGouAdapter nearAdapter;
	Handler myHandler;
	int currentPage=0;
	int totalPage=0;
	List <Shop> shopList=null;
	
	Handler mHandler;
	int page=0;
	int allPage=0;
	List <Goods> goodsList=null;
	
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_order);
		((TextView) findViewById(R.id.tvTag1)).setOnClickListener(this);
		((TextView) findViewById(R.id.tvTag2)).setOnClickListener(this);
		((ImageView) findViewById(R.id.go_back)).setOnClickListener(this);
		((TextView) findViewById(R.id.header_name)).setText(getString(R.string.my_daijin));

		views = new ArrayList<View>();
		views.add(LayoutInflater.from(this).inflate(R.layout.film_seat, null));
		views.add(LayoutInflater.from(this).inflate(R.layout.hotel_reservation,null));

		vpViewPager = (ViewPager) findViewById(R.id.vp_ViewPager1);
		vpViewPager.setAdapter(new MyPagerAdapter(views));
		vpViewPager.setOnPageChangeListener(new MyOnPageChangeListener());
		initCursor(views.size());
		MyPagerAdapter myPagerAdapter = (MyPagerAdapter) vpViewPager.getAdapter();
		View v1 = myPagerAdapter.getItemAtPosition(0);
		View v2 = myPagerAdapter.getItemAtPosition(1);
		ptrlvFilm = (PullToRefreshListView) v1.findViewById(R.id.ptrlvEntertainmentFilm);
		ptrlvHotel = (PullToRefreshListView) v2.findViewById(R.id.ptrlvHotel);

		SharedPreferencesUtility.removeSharedPreferences(context,SharedPreferencesUtility.STORE_lIST);
		//获取storeList
		SharedPreferences sp = getSharedPreferences(SharedPreferencesUtility.STORE_lIST, MODE_PRIVATE);
		currentPage=sp.getInt(SharedPreferencesUtility.CURRENT_PAGE, 0);
		totalPage=sp.getInt(SharedPreferencesUtility.PAGE_COUNT, 0);
		if((totalPage!=0&&totalPage!=currentPage)||(currentPage==0)){		
				myHandler = new Handler() {
					@Override
					public void handleMessage(Message msg) {
						if (msg.what == 0x14) {
							currentPage++;
							SharedPreferencesUtility.saveData(SharedPreferencesUtility.STORE_lIST,SharedPreferencesUtility.CURRENT_PAGE, currentPage, context);
							Bundle bundle=msg.getData();
							String jsonStr=bundle.getString("jsonString");
							int pageCount=bundle.getInt("pageCount");
							SharedPreferencesUtility.saveData(SharedPreferencesUtility.STORE_lIST,SharedPreferencesUtility.PAGE_COUNT, pageCount, context);
							shopList=  JSON.parseArray(jsonStr, Shop.class);		
							storeListAdapter=new StoreListAdapter(context, shopList);
							initPullToRefreshListView(ptrlvHotel, storeListAdapter);
						}
						super.handleMessage(msg);
					}
				};
				getStoreList(context,myHandler,currentPage);//得到数据
		}else{
			Toast.makeText(this, getResources().getString(R.string.no_newData), Toast.LENGTH_SHORT).show();
		}
		
		SharedPreferencesUtility.removeSharedPreferences(context,SharedPreferencesUtility.GOODS_lIST);
		//获取goodsList
		SharedPreferences sharePre = getSharedPreferences(SharedPreferencesUtility.GOODS_lIST, MODE_PRIVATE);
		page=sharePre.getInt(SharedPreferencesUtility.CURRENT_PAGE, 0);
		allPage=sharePre.getInt(SharedPreferencesUtility.PAGE_COUNT, 0);
		if((allPage!=0&&allPage!=page)||(page==0)){
			mHandler = new Handler() {
					@Override
					public void handleMessage(Message msg) {
						if (msg.what == 0x15) {
							page++;
							SharedPreferencesUtility.saveData(SharedPreferencesUtility.GOODS_lIST,SharedPreferencesUtility.CURRENT_PAGE, page, context);
							Bundle bundle=msg.getData();
							String jsonStr=bundle.getString("jsonString");
							int pageCount=bundle.getInt("pageCount");
							SharedPreferencesUtility.saveData(SharedPreferencesUtility.GOODS_lIST,SharedPreferencesUtility.PAGE_COUNT, pageCount, context);
							goodsList=  JSON.parseArray(jsonStr, Goods.class);		
							nearAdapter =new NearTuanGouAdapter(context, goodsList);
							initPullToRefreshListView1(ptrlvFilm, nearAdapter);
						}
						super.handleMessage(msg);
					}
				};
			getGoodsList(context,mHandler,page);//得到数据		
		}else{
			Toast.makeText(this, getResources().getString(R.string.no_newData), Toast.LENGTH_SHORT).show();
		}	
		
		ptrlvFilm.setOnItemClickListener(new OnItemClickListener() {

			@Override
			public void onItemClick(AdapterView<?> adapter, View view, int position,long arg3) {
				Goods  goods=nearAdapter.getItem(position); 
				Intent intent = new Intent(CollectionActivity.this,GroupPurchaseActivity.class);
				intent.putExtra("goodsID", goods.getGoodsID());
				startActivity(intent);
			}
		});
		
		ptrlvHotel.setOnItemClickListener(new OnItemClickListener() {

			@Override
			public void onItemClick(AdapterView<?> adapter, View view, int position,long arg3) {
				Shop  shop=storeListAdapter.getItem(position); 
				Intent intent = new Intent(CollectionActivity.this,StoreDetailActivity.class);
				intent.putExtra("shopID", shop.getShopID());
				startActivity(intent);
			}
		});

	}
	
	public static  void getStoreList(final Context mContext,final Handler handler,int currentPage){
//		User myUser =ShareUtil.readUser(mContext);

		RequestParams params = new RequestParams(); // 绑定参数	
//		params.put("username", myUser.getUsername());
//		params.put("token", myUser.getToken());
		params.put("page", currentPage);
		params.put("rows", 10);
		params.put("opeType", "getShopList");
		params.put("requestType", 1);
		params.put("mobile", 1);
		 
		 HttpUtils.post(HttpUrl.BOOKMARKACTION, params, new JsonHttpResponseHandler(){

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
//							final int  pageCount=objContent.getInteger("pageCount");
////							int recordCount=objContent.getInteger("recordCount");	//总条数
//							
//							JSONArray arr = objContent.getJSONArray("recordList");	
//							 final String jsonString=arr.toString();
//							
//							new Thread(new Runnable() {
//								public void run() {
//									Message msg = handler.obtainMessage();
//									Bundle bd=new Bundle();
//									bd.putString("jsonString", jsonString);
//									bd.putInt("pageCount", pageCount);
//									msg.setData(bd);
//									msg.what = 0x14;
//									msg.sendToTarget();
//								}
//							}).start();
//							}else{
//								Toast.makeText(mContext, mContext.getResources().getString(R.string.dialog_title_getDataFail), Toast.LENGTH_SHORT).show();
//							}							
//						} catch (JSONException e) {
//							e.printStackTrace();
//						}
				 }			
			}
			
			@Override
			public void onFailure(int statusCode, Header[] arg1, String responseString,Throwable error) {
					error.printStackTrace();
					try {
						JSONObject obj =  JSON.parseObject(GetData.getShopList());
						Boolean result=obj.getBoolean("success");
						if(result){
						String content=obj.getString("content");													
						JSONObject objContent=JSON.parseObject(content);
						
						final int  pageCount=objContent.getInteger("pageCount");
//						int recordCount=objContent.getInteger("recordCount");	//总条数
						
						JSONArray arr = objContent.getJSONArray("recordList");	
						 final String jsonString=arr.toString();
						
						new Thread(new Runnable() {
							public void run() {
								Message msg = handler.obtainMessage();
								Bundle bd=new Bundle();
								bd.putString("jsonString", jsonString);
								bd.putInt("pageCount", pageCount);
								msg.setData(bd);
								msg.what = 0x14;
								msg.sendToTarget();
							}
						}).start();
						}else{
							Toast.makeText(mContext, mContext.getResources().getString(R.string.dialog_title_getDataFail), Toast.LENGTH_SHORT).show();
						}							
					} catch (JSONException e) {
						e.printStackTrace();
					}
			}			 
		 });
}	
	
	public static  void getGoodsList(final Context mContext,final Handler handler,int currentPage){
//		User myUser =ShareUtil.readUser(mContext);

		RequestParams params = new RequestParams(); // 绑定参数	
//		params.put("username", myUser.getUsername());
//		params.put("token", myUser.getToken());
		params.put("page", currentPage);
		params.put("rows", 10);
		params.put("opeType", "getGoodsList");
		params.put("requestType", 1);
		params.put("mobile", 1);
		 
		 HttpUtils.post(HttpUrl.BOOKMARKACTION, params, new JsonHttpResponseHandler(){

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
//							final int  pageCount=objContent.getInteger("pageCount");
////							int recordCount=objContent.getInteger("recordCount");	//总条数
//							
//							JSONArray arr = objContent.getJSONArray("recordList");	
//							 final String jsonString=arr.toString();
//							
//							new Thread(new Runnable() {
//								public void run() {
//									Message msg = handler.obtainMessage();
//									Bundle bd=new Bundle();
//									bd.putString("jsonString", jsonString);
//									bd.putInt("pageCount", pageCount);
//									msg.setData(bd);
//									msg.what = 0x15;
//									msg.sendToTarget();
//								}
//							}).start();
//							}else{
//								Toast.makeText(mContext, mContext.getResources().getString(R.string.dialog_title_getDataFail), Toast.LENGTH_SHORT).show();
//							}							
//						} catch (JSONException e) {
//							e.printStackTrace();
//						}
				 }			
			}
			
			@Override
			public void onFailure(int statusCode, Header[] arg1, String responseString,Throwable error) {
					error.printStackTrace();
					try {
						JSONObject obj =  JSON.parseObject(GetData.getCategoryGoodsList());
						Boolean result=obj.getBoolean("success");
						if(result){
						String content=obj.getString("content");													
						JSONObject objContent=JSON.parseObject(content);
						
						final int  pageCount=objContent.getInteger("pageCount");
//						int recordCount=objContent.getInteger("recordCount");	//总条数
						
						JSONArray arr = objContent.getJSONArray("recordList");	
						 final String jsonString=arr.toString();
						
						new Thread(new Runnable() {
							public void run() {
								Message msg = handler.obtainMessage();
								Bundle bd=new Bundle();
								bd.putString("jsonString", jsonString);
								bd.putInt("pageCount", pageCount);
								msg.setData(bd);
								msg.what = 0x15;
								msg.sendToTarget();
							}
						}).start();
						}else{
							Toast.makeText(mContext, mContext.getResources().getString(R.string.dialog_title_getDataFail), Toast.LENGTH_SHORT).show();
						}							
					} catch (JSONException e) {
						e.printStackTrace();
					}
			}			 
		 });
}
	
	private void initCursor(int tagNum) {
		cursorWidth = BitmapFactory.decodeResource(getResources(),
				R.drawable.cursor).getWidth();
		DisplayMetrics dm = new DisplayMetrics();
		getWindowManager().getDefaultDisplay().getMetrics(dm);
		offset = ((dm.widthPixels / tagNum) - cursorWidth) / 2;
		cursor = (ImageView) findViewById(R.id.ivCursor);
		Matrix matrix = new Matrix();
		matrix.setTranslate(offset, 0);
		cursor.setImageMatrix(matrix);
	}

	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.tvTag1:
			vpViewPager.setCurrentItem(0);
			break;
		case R.id.tvTag2:
			vpViewPager.setCurrentItem(1);
			break;
		case R.id.go_back:
			finish();
			break;
		}
	}
	
	private void initPullToRefreshListView1(PullToRefreshListView rtflv,NearTuanGouAdapter adapter) {
		rtflv.setMode(Mode.BOTH);
		rtflv.setOnRefreshListener(new MyOnRefreshListener9(rtflv,CollectionActivity.this,nearAdapter,SharedPreferencesUtility.BOOKMARK));
		rtflv.setAdapter(adapter);
	}
	
	private void initPullToRefreshListView(PullToRefreshListView rtflv,StoreListAdapter adapter) {
		rtflv.setMode(Mode.BOTH);
		rtflv.setOnRefreshListener(new MyOnRefreshListener5(rtflv,CollectionActivity.this,storeListAdapter,SharedPreferencesUtility.COLLECTION));
		rtflv.setAdapter(adapter);
	}

	class MyOnPageChangeListener implements OnPageChangeListener {
		@Override
		public void onPageSelected(int arg0) {
			int one = 2 * offset + cursorWidth;
			int two = one * 2;

			switch (originalIndex) {
			case 0:
				if (arg0 == 1) {
					animation = new TranslateAnimation(0, one, 0, 0);
				}
				if (arg0 == 2) {
					animation = new TranslateAnimation(0, two, 0, 0);
				}
				break;
			case 1:
				if (arg0 == 0) {
					animation = new TranslateAnimation(one, 0, 0, 0);
				}
				if (arg0 == 2) {
					animation = new TranslateAnimation(one, two, 0, 0);
				}
				break;
			case 2:
				if (arg0 == 1) {
					animation = new TranslateAnimation(two, one, 0, 0);
				}
				if (arg0 == 0) {
					animation = new TranslateAnimation(two, 0, 0, 0);
				}
				break;
			}
			animation.setFillAfter(true);
			animation.setDuration(300);
			cursor.startAnimation(animation);

			originalIndex = arg0;
		}

		@Override
		public void onPageScrolled(int arg0, float arg1, int arg2) {

		}

		@Override
		public void onPageScrollStateChanged(int arg0) {

		}

	}


}

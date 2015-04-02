package com.huayan.life.Activity;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;

import org.apache.http.Header;

import util.HttpUrl;
import util.HttpUtils;
import util.SharedPreferencesUtility;
import android.annotation.SuppressLint;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.drawable.BitmapDrawable;
import android.os.Bundle;
import android.os.Handler;
import android.os.Message;
import android.view.LayoutInflater;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.FrameLayout;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.ListView;
import android.widget.PopupWindow;
import android.widget.RelativeLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.alibaba.fastjson.JSON;
import com.alibaba.fastjson.JSONArray;
import com.alibaba.fastjson.JSONException;
import com.alibaba.fastjson.JSONObject;
import com.handmark.pulltorefresh.library.PullToRefreshBase.Mode;
import com.handmark.pulltorefresh.library.PullToRefreshListView;
import com.huayan.life.R;
import com.huayan.life.adapter.CategoryListAdapter;
import com.huayan.life.adapter.StoreListAdapter;
import com.huayan.life.common.GetData;
import com.huayan.life.common.MyOnRefreshListener5;
import com.huayan.life.model.Shop;
import com.loopj.android.http.JsonHttpResponseHandler;
import com.loopj.android.http.RequestParams;

/**
 * 商家
 * @author wzz
 *
 */
@SuppressLint("HandlerLeak")
public class StoreActivity extends BaseActivity implements OnClickListener {

	private PullToRefreshListView ptrlvHeadLineNews = null;
	private StoreListAdapter newAdapter = null;

	private LinearLayout public_menu;
	private ArrayList<HashMap<String, Object>> itemList;
	private TextView text1;
	private TextView text2;
	private TextView text3;
	private LinearLayout linLayout;
	private LinearLayout layout;
	private ListView rootList;
	private String title[] = { "全部分类", "美食", "酒店", "电影", "休闲娱乐", "生活服务", "丽人" };
	private FrameLayout flChild;
	private ListView childList;
	private PopupWindow mPopWin;
	static Handler myHandler;
	int currentPage=0;
	int totalPage=0;
	List <Shop> shopList=null;

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_store);
		((ImageView) findViewById(R.id.iv_search)).setOnClickListener(this);
		ptrlvHeadLineNews = (PullToRefreshListView) findViewById(R.id.ptrlvStoreType);
		
		SharedPreferencesUtility.removeSharedPreferences(context,SharedPreferencesUtility.SHOP_lIST);
		//获取数据
				SharedPreferences sp = getSharedPreferences(SharedPreferencesUtility.SHOP_lIST, MODE_PRIVATE);
				currentPage=sp.getInt(SharedPreferencesUtility.CURRENT_PAGE, 0);
				totalPage=sp.getInt(SharedPreferencesUtility.PAGE_COUNT, 0);
				if((totalPage!=0&&totalPage!=currentPage)||(currentPage==0)){						
						myHandler = new Handler() {
							@Override
							public void handleMessage(Message msg) {
								if (msg.what == 0x04) {
									currentPage++;
									SharedPreferencesUtility.saveData(SharedPreferencesUtility.SHOP_lIST,SharedPreferencesUtility.CURRENT_PAGE, currentPage, context);
									Bundle bundle=msg.getData();
									String jsonStr=bundle.getString("jsonString");
									int pageCount=bundle.getInt("pageCount");
									SharedPreferencesUtility.saveData(SharedPreferencesUtility.SHOP_lIST,SharedPreferencesUtility.PAGE_COUNT, pageCount, context);
									shopList=  JSON.parseArray(jsonStr, Shop.class);		
									newAdapter=new StoreListAdapter(context, shopList);
									initPullToRefreshListView(ptrlvHeadLineNews, newAdapter);
								}
								super.handleMessage(msg);
							}
						};
						getShopList(context,myHandler,currentPage);//得到数据	
						}else{
					Toast.makeText(this, getResources().getString(R.string.no_newData), Toast.LENGTH_SHORT).show();
				}
		
		initPopupWindow();
		ptrlvHeadLineNews.setOnItemClickListener(new OnItemClickListener() {
			@Override
			public void onItemClick(AdapterView<?> arg0, View view,int position, long id) {
				Shop  shop=newAdapter.getItem(position); 
				Intent intent = new Intent(StoreActivity.this,StoreDetailActivity.class);
				intent.putExtra("shopID", shop.getShopID());
				startActivity(intent);
			}
		});
	}

	
	public static  void getShopList(final Context mContext,final Handler handler,int currentPage){
		RequestParams params = new RequestParams(); // 绑定参数	
		params.put("page", currentPage);
		params.put("rows", 10);
		params.put("opeType", "getList");
		params.put("requestType", 1);
		params.put("mobile", 1);
		 
		 HttpUtils.post(HttpUrl.SHOPACTION, params, new JsonHttpResponseHandler(){

			@Override
			public void onSuccess(int statusCode, Header[] arg1, String responseString) {
//				 if(statusCode==200){
//						try {
//							JSONObject obj =  JSON.parseObject(responseString);
//							Boolean result=obj.getBoolean("success");
//				 			if(result){
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
//									msg.what = 0x04;
//									msg.sendToTarget();
//								}
//							}).start();
//							}else{
//								Toast.makeText(mContext, mContext.getResources().getString(R.string.dialog_title_getDataFail), Toast.LENGTH_SHORT).show();
//							}							
//						} catch (JSONException e) {
//							e.printStackTrace();
//						}
//				 }			
			}
			
			@Override
			public void onFailure(int statusCode, Header[] arg1, String responseString,Throwable error) {
					error.printStackTrace();		
					
					String json=GetData.getShopList();
					try {
						JSONObject obj =  JSON.parseObject(json);
						Boolean result=obj.getBoolean("success");
						if(result){
						String content=obj.getString("content");													
						JSONObject objContent=JSON.parseObject(content);	
						
						final int  pageCount=objContent.getInteger("pageCount");
						JSONArray arr = objContent.getJSONArray("recordList");	
						 final String jsonString=arr.toString();
						
						new Thread(new Runnable() {
							public void run() {
								Message msg = handler.obtainMessage();
								Bundle data=new Bundle();
								data.putString("jsonString", jsonString);
								data.putInt("pageCount", pageCount);
								msg.setData(data);
								msg.what = 0x04;
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
	
	private void initPopupWindow() {
		public_menu = (LinearLayout) findViewById(R.id.public_menu);
		itemList = new ArrayList<HashMap<String, Object>>();
		text1 = (TextView) public_menu.findViewById(R.id.text1);
		text2 = (TextView) public_menu.findViewById(R.id.text2);
		text3 = (TextView) public_menu.findViewById(R.id.text3);
		linLayout = (LinearLayout) findViewById(R.id.store);

		text1.setOnClickListener(new OnClickListener() {

			@Override
			public void onClick(View v) {
				showPopupWindow(text1, linLayout.getWidth(),
						linLayout.getHeight());
			}
		});

		text2.setOnClickListener(new OnClickListener() {

			@Override
			public void onClick(View v) {
				showPopupWindow(text2, linLayout.getWidth(),
						linLayout.getHeight());
			}
		});

		text3.setOnClickListener(new OnClickListener() {

			@Override
			public void onClick(View v) {
				showPopupWindow(text2, linLayout.getWidth(),linLayout.getHeight());
			}
		});
	}

	private void showPopupWindow(TextView txtView, int width, int height) {

		itemList = new ArrayList<HashMap<String, Object>>();
		layout = (LinearLayout) LayoutInflater.from(StoreActivity.this)
				.inflate(R.layout.popup_category, null);
		rootList = (ListView) layout.findViewById(R.id.rootcategory);
		for (int i = 0; i < title.length; i++) {
			HashMap<String, Object> items = new HashMap<String, Object>();
			items.put("name", title[i]);
			items.put("count", i * 5);
			itemList.add(items);
		}

		CategoryListAdapter cla = new CategoryListAdapter(StoreActivity.this,
				itemList);
		rootList.setAdapter(cla);

		flChild = (FrameLayout) layout.findViewById(R.id.child_lay);
		childList = (ListView) layout.findViewById(R.id.childcategory);
		childList.setAdapter(cla);
		flChild.setVisibility(View.INVISIBLE);

		mPopWin = new PopupWindow(layout, width * 9 / 10, height / 2, true);
		mPopWin.setBackgroundDrawable(new BitmapDrawable());
		mPopWin.showAsDropDown(txtView, 5, 1);
		mPopWin.update();

		rootList.setOnItemClickListener(new android.widget.AdapterView.OnItemClickListener() {

			@Override
			public void onItemClick(AdapterView<?> parent, View view,
					int position, long id) {
				flChild.setVisibility(View.VISIBLE);
				childList
						.setOnItemClickListener(new android.widget.AdapterView.OnItemClickListener() {
							@Override
							public void onItemClick(AdapterView<?> parent,
									View view, int position, long id) {
								layout.setVisibility(View.GONE);
							}
						});
			}
		});
	}

	private void initPullToRefreshListView(PullToRefreshListView rtflv,	StoreListAdapter adapter) {
		rtflv.setMode(Mode.BOTH);
		rtflv.setOnRefreshListener(new MyOnRefreshListener5(rtflv, this,adapter,SharedPreferencesUtility.STORE));
		rtflv.setAdapter(adapter);
		// 添加其他模块控件
		RelativeLayout relRefresh = (RelativeLayout) LayoutInflater.from(this)
				.inflate(R.layout.refresh_address, null);
		rtflv.getRefreshableView().addHeaderView(relRefresh, null, false);

		// 更新地址
		relRefresh.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				// TODO 更新当前位置

			}
		});
	}

	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.iv_search:
			jumpToActivity(StoreActivity.this, QueryActivity.class);
			break;
		}
	}

}

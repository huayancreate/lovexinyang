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
import android.widget.LinearLayout;
import android.widget.ListView;
import android.widget.PopupWindow;
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
import com.huayan.life.adapter.RecommendAdapter;
import com.huayan.life.common.GetData;
import com.huayan.life.common.MyOnRefreshListener6;
import com.huayan.life.model.Category;
import com.huayan.life.model.Counties;
import com.huayan.life.model.Goods;
import com.huayan.life.model.Regional;
import com.loopj.android.http.JsonHttpResponseHandler;
import com.loopj.android.http.RequestParams;

/**
 * 商品类别列表
 * @author wzz
 *
 */
@SuppressLint("HandlerLeak")
public class CategoryActivity extends BaseActivity {

	private PullToRefreshListView ptrlvHeadLineNews = null;
	private RecommendAdapter newAdapter = null;

	private LinearLayout public_menu;
	private ArrayList<HashMap<String, Object>> itemList;
	private ArrayList<HashMap<String, Object>> subList;
	private TextView text1;
	private TextView text2;
	private TextView text3;
	private LinearLayout linLayout;
	private LinearLayout layout;
	private ListView rootList;
	private String sort[]={ "智能排序", "好评优先", "离我最近", "人均最低"};
	private FrameLayout flChild;
	private ListView childList;
	private PopupWindow mPopWin;
	List<Goods> goodsList=null;
	static Handler myHandler,typeHandler,regHandler;
	int currentPage=0;
	int totalPage=0;
	String search=null;
	
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_category);
		initView();
		initPopupWindow();
		getRegional();//获取区域
		getType();//获取类别
		
		SharedPreferencesUtility.removeSharedPreferences(context,SharedPreferencesUtility.CATEGORYACTIVITY);
		//获取数据
		SharedPreferences sp = getSharedPreferences(SharedPreferencesUtility.CATEGORYACTIVITY, MODE_PRIVATE);
		currentPage=sp.getInt(SharedPreferencesUtility.CURRENT_PAGE, 0);
		totalPage=sp.getInt(SharedPreferencesUtility.PAGE_COUNT, 0);
		if((totalPage!=0&&totalPage!=currentPage)||(currentPage==0)){						
				myHandler = new Handler() {
					@Override
					public void handleMessage(Message msg) {
						if (msg.what == 0x08) {
							currentPage++;
							SharedPreferencesUtility.saveData(SharedPreferencesUtility.CATEGORYACTIVITY,SharedPreferencesUtility.CURRENT_PAGE, currentPage, context);
							Bundle bundle=msg.getData();
							String jsonStr=bundle.getString("jsonString");
							int pageCount=bundle.getInt("pageCount");
							SharedPreferencesUtility.saveData(SharedPreferencesUtility.CATEGORYACTIVITY,SharedPreferencesUtility.PAGE_COUNT, pageCount, context);
							goodsList=  JSON.parseArray(jsonStr, Goods.class);		
							newAdapter = new RecommendAdapter(context, goodsList);
							initPullToRefreshListView(ptrlvHeadLineNews, newAdapter);
						}
						super.handleMessage(msg);
					}
				};
				getCategoryGoodsList(context,myHandler,currentPage,search);//得到数据	
				}else{
			Toast.makeText(this, getResources().getString(R.string.no_newData), Toast.LENGTH_SHORT).show();
		}		
		
	}

	public static  void getCategoryGoodsList(final Context mContext,final Handler handler,int currentPage,String searchString){
		RequestParams params = new RequestParams(); // 绑定参数	
		params.put("isSuggest", 0);
		params.put("searchString", searchString);
		params.put("page", currentPage);
		params.put("rows", 10);
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
//									msg.what = 0x08;
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
					String json=GetData.getCategoryGoodsList();
					try {
						JSONObject obj =  JSON.parseObject(json);
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
								msg.what = 0x08;
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
	
	private void initView(){
		ptrlvHeadLineNews = (PullToRefreshListView) findViewById(R.id.ptrlvStoreCategory);
		ptrlvHeadLineNews.setOnItemClickListener(new OnItemClickListener() {
			@Override
			public void onItemClick(AdapterView<?> adapter, View view, int position,long arg3) {
				Goods  goods=newAdapter.getItem(position); 
				Intent intent = new Intent(CategoryActivity.this,GroupPurchaseActivity.class);
				intent.putExtra("goodsID", goods.getGoodsID());
				startActivity(intent);
			}
		});

		LinearLayout ll_back = (LinearLayout) findViewById(R.id.ll_back);
		ll_back.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				finish();
			}
		});
	}
	
	private void initPopupWindow() {
		public_menu = (LinearLayout) findViewById(R.id.public_menu);
		text1 = (TextView) public_menu.findViewById(R.id.text1);
		text2 = (TextView) public_menu.findViewById(R.id.text2);
		text3 = (TextView) public_menu.findViewById(R.id.text3);
		linLayout = (LinearLayout) findViewById(R.id.ll_food);

		typeHandler = new Handler() {
			@Override
			public void handleMessage(Message msg) {
				if (msg.what == 0x010) {
					Bundle bundle=msg.getData();
					final String jsonStr=bundle.getString("jsonString");
					
					text1.setOnClickListener(new OnClickListener() {
						@Override
						public void onClick(View v) {
							showPopupWindow(text1,1,jsonStr, linLayout.getWidth(),linLayout.getHeight());
						}
					});
				}
				super.handleMessage(msg);
			}
		};

		regHandler = new Handler() {
			@Override
			public void handleMessage(Message msg) {
				if (msg.what == 0x012) {
					Bundle bundle=msg.getData();
					final String jsonStr=bundle.getString("jsonString");
					
					text2.setOnClickListener(new OnClickListener() {
						@Override
						public void onClick(View v) {
							showPopupWindow(text2,2,jsonStr, linLayout.getWidth(),
									linLayout.getHeight());
						}
					});
				}
				super.handleMessage(msg);
			}
		};
		

		text3.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				showPopupWindow(text3,3,"", linLayout.getWidth(),
						linLayout.getHeight());
			}
		});
	}

	private void showPopupWindow(TextView txtView,int type ,String jsonString, int width, int height) {
	
		itemList = new ArrayList<HashMap<String, Object>>();
		subList = new ArrayList<HashMap<String,Object>>();
		layout = (LinearLayout) LayoutInflater.from(CategoryActivity.this).inflate(R.layout.popup_category, null);
		rootList = (ListView) layout.findViewById(R.id.rootcategory);
		
		flChild = (FrameLayout) layout.findViewById(R.id.child_lay);
		childList = (ListView) layout.findViewById(R.id.childcategory);
		flChild.setVisibility(View.INVISIBLE);
		if (type == 1) {
			List<Category> categoryList = JSON.parseArray(jsonString,Category.class);
			for (int i = 0; i < categoryList.size(); i++) {
				Category  category=categoryList.get(i);
				HashMap<String, Object> items = new HashMap<String, Object>();
				if(category.getParentCategoryId()==0){
					items.put("name",category.getCategoryName() );
					items.put("count", i * 5);
					itemList.add(items);
				}else{
					items.put("name",category.getCategoryName() );
					items.put("count", i * 5);
					subList.add(items);
				}
			}
		}else if(type==2){
			List<Regional> regList = JSON.parseArray(jsonString,Regional.class);
			for (int i = 0; i < regList.size(); i++) {
					Regional  reg=regList.get(i);
					HashMap<String, Object> items = new HashMap<String, Object>();
					HashMap<String, Object> subItems = new HashMap<String, Object>();
					Counties cou=reg.getCounties();
					items.put("name",cou.getName());
					items.put("count", i * 5);
					itemList.add(items);
			
					subItems.put("name",cou.getBusiness().getName() );
					subItems.put("count", i * 5);
					subList.add(subItems);
			}
		}else if(type==3){
			for (int i = 0; i < sort.length; i++) {
				HashMap<String, Object> items = new HashMap<String, Object>();
				items.put("name",sort[i]);
				items.put("count", i * 5);
				itemList.add(items);
			}
		}
		CategoryListAdapter cla = new CategoryListAdapter(context, itemList);
		rootList.setAdapter(cla);
		
		final CategoryListAdapter  childAdapter=new CategoryListAdapter(context, subList);
		childList.setAdapter(childAdapter);
	
		rootList.setOnItemClickListener(new android.widget.AdapterView.OnItemClickListener() {

			@Override
			public void onItemClick(AdapterView<?> parent, View view,int position, long id) {
				flChild.setVisibility(View.VISIBLE);
				childList.setOnItemClickListener(new android.widget.AdapterView.OnItemClickListener() {
							@Override
							public void onItemClick(AdapterView<?> parent,View view, int position, long id) {
								layout.setVisibility(View.GONE);
								HashMap<String, Object> hm= childAdapter.getItem(position);
								 search=hm.get("name").toString();								
							}
						});
			}
		});
		mPopWin = new PopupWindow(layout, width * 9 / 10, height / 2, true);
		mPopWin.setBackgroundDrawable(new BitmapDrawable());
		mPopWin.showAsDropDown(txtView, 5, 1);
		mPopWin.update();
	}
	

	private void initPullToRefreshListView(PullToRefreshListView rtflv,RecommendAdapter adapter) {
		rtflv.setMode(Mode.BOTH);
		rtflv.setOnRefreshListener(new MyOnRefreshListener6(rtflv, this,adapter,search));
		rtflv.setAdapter(adapter);
	}

	//商品类别
	private void getType(){
		RequestParams params = new RequestParams(); // 绑定参数	
		params.put("categoryType", 1);
		params.put("opeType", "getType");
		params.put("requestType", 1);
		params.put("mobile", 1);
		 
		 HttpUtils.post(HttpUrl.BASEACTION, params, new JsonHttpResponseHandler(){
			@Override
			public void onSuccess(int statusCode, Header[] arg1, String responseString) {
				 if(statusCode==200){
				 }			
			}
			
			@Override
			public void onFailure(int statusCode, Header[] arg1, String responseString,Throwable error) {
					error.printStackTrace();
					String json=GetData.getCategoryList();
					try {
							JSONObject obj = JSON.parseObject(json);
							Boolean result = obj.getBoolean("success");
							if (result) {
								String content = obj.getString("content");
								JSONObject objContent = JSON.parseObject(content);

								JSONArray arr = objContent.getJSONArray("recordList");
								final String jsonString = arr.toString();
								new Thread(new Runnable() {
									public void run() {
										Message msg = typeHandler.obtainMessage();
										Bundle bd=new Bundle();
										bd.putString("jsonString", jsonString);
										msg.setData(bd);
										msg.what = 0x010;
										msg.sendToTarget();
									}
								}).start();
							} else {
								Toast.makeText(context,context.getResources().getString(R.string.dialog_title_getDataFail),Toast.LENGTH_SHORT).show();
							}
					} catch (JSONException e) {
						e.printStackTrace();
					}
			}			 
		 });
	}
	
	private void getRegional(){
		RequestParams params = new RequestParams(); // 绑定参数	
		params.put("cityID", 1);
		params.put("opeType", "getRegion");
		params.put("requestType", 1);
		params.put("mobile", 1);
		 
		 HttpUtils.post(HttpUrl.BASEACTION, params, new JsonHttpResponseHandler(){
			@Override
			public void onSuccess(int statusCode, Header[] arg1, String responseString) {
				 if(statusCode==200){
				 }			
			}
			
			@Override
			public void onFailure(int statusCode, Header[] arg1, String responseString,Throwable error) {
					error.printStackTrace();
					String json=GetData.getRegionalList();
					try {
							JSONObject obj = JSON.parseObject(json);
							Boolean result = obj.getBoolean("success");
							if (result) {
								String content = obj.getString("content");
								JSONObject objContent = JSON.parseObject(content);

								JSONArray arr = objContent.getJSONArray("recordList");
								final String jsonString = arr.toString();
								new Thread(new Runnable() {
									public void run() {
										Message msg = regHandler.obtainMessage();
										Bundle bd=new Bundle();
										bd.putString("jsonString", jsonString);
										msg.setData(bd);
										msg.what = 0x012;
										msg.sendToTarget();
									}
								}).start();
							} else {
								Toast.makeText(context,context.getResources().getString(R.string.dialog_title_getDataFail),Toast.LENGTH_SHORT).show();
							}
					} catch (JSONException e) {
						e.printStackTrace();
					}
			}			 
		 });
	}
	
}

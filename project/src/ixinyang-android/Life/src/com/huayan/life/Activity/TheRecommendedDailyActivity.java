package com.huayan.life.Activity;

import java.util.List;

import org.apache.http.Header;

import util.HttpUrl;
import util.HttpUtils;
import util.SharedPreferencesUtility;
import android.annotation.SuppressLint;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.os.Handler;
import android.os.Message;
import android.view.LayoutInflater;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.ImageView;
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
import com.huayan.life.adapter.NearTuanGouAdapter;
import com.huayan.life.common.GetData;
import com.huayan.life.common.MyOnRefreshListener9;
import com.huayan.life.model.Goods;
import com.loopj.android.http.JsonHttpResponseHandler;
import com.loopj.android.http.RequestParams;

/**
 * 每日推荐
 * @author wzz
 *
 */
@SuppressLint("HandlerLeak")
public class TheRecommendedDailyActivity extends BaseActivity  implements OnClickListener{

	private PullToRefreshListView ptrlvHeadLineNews = null;
	private NearTuanGouAdapter  dailyAdapter = null;
	private List <Goods>  goodsList=null;
	Handler myHandler;
	int currentPage=0;
	int totalPage=0;
	
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_daily_recommend);
		initView();
		
		SharedPreferencesUtility.removeSharedPreferences(context,SharedPreferencesUtility.RECOMMENDDAILY_lIST);
		
		SharedPreferences sp = getSharedPreferences(SharedPreferencesUtility.RECOMMENDDAILY_lIST, MODE_PRIVATE);
		currentPage=sp.getInt(SharedPreferencesUtility.CURRENT_PAGE, 0);
		totalPage=sp.getInt(SharedPreferencesUtility.PAGE_COUNT, 0);
		if((totalPage!=0&&totalPage!=currentPage)||(currentPage==0)){	
				myHandler = new Handler() {
					@Override
					public void handleMessage(Message msg) {
						if (msg.what == 0x17) {
							currentPage++;
							SharedPreferencesUtility.saveData(SharedPreferencesUtility.RECOMMENDDAILY_lIST,SharedPreferencesUtility.CURRENT_PAGE, currentPage, context);
							Bundle bundle=msg.getData();
							String jsonStr=bundle.getString("jsonString");
							int pageCount=bundle.getInt("pageCount");
							SharedPreferencesUtility.saveData(SharedPreferencesUtility.RECOMMENDDAILY_lIST,SharedPreferencesUtility.PAGE_COUNT, pageCount, context);
							goodsList=  JSON.parseArray(jsonStr, Goods.class);		
							dailyAdapter = new NearTuanGouAdapter(context,goodsList);		
							initPullToRefreshListView(ptrlvHeadLineNews, dailyAdapter);
						}
						super.handleMessage(msg);
					}
				};
				getRecommendDailyList(context,myHandler,currentPage);//得到数据		
		}else{
			Toast.makeText(this, getResources().getString(R.string.no_newData), Toast.LENGTH_SHORT).show();
		}
			
		ptrlvHeadLineNews.setOnItemClickListener(new OnItemClickListener() {
			@Override
			public void onItemClick(AdapterView<?> arg0, View view,	int position, long id) {				
				Goods  goods=dailyAdapter.getItem(position); 
				Intent intent = new Intent(TheRecommendedDailyActivity.this,GroupPurchaseActivity.class);
				intent.putExtra("goodsID", goods.getGoodsID());
				startActivity(intent);
				
			}
		});		
	}

	public static  void getRecommendDailyList(final Context mContext,final Handler handler,int currentPage){
//		User myUser =ShareUtil.readUser(mContext);
		
		RequestParams params = new RequestParams(); // 绑定参数	
//		params.put("username", myUser.getUsername());
//		params.put("token", myUser.getToken());
		params.put("page", currentPage);
		params.put("rows", 10);
		params.put("opeType", "getRecommendDailyList");
		params.put("requestType", 1);
		params.put("mobile", 1);
		 
		 HttpUtils.post(HttpUrl.RECOMMENDDAILYACTION, params, new JsonHttpResponseHandler(){

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
//									msg.what = 0x17;
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
								msg.what = 0x17;
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
		ptrlvHeadLineNews = (PullToRefreshListView) findViewById(R.id.ptrlvdaily_recommend);
		((ImageView) findViewById(R.id.go_back)).setOnClickListener(this);;
		((TextView) findViewById(R.id.header_name)).setText(getString(R.string.tuijian));	
	}
	
	private void initPullToRefreshListView(PullToRefreshListView rtflv,NearTuanGouAdapter adapter) {
		rtflv.setMode(Mode.BOTH);
		rtflv.setOnRefreshListener(new MyOnRefreshListener9(rtflv,this,dailyAdapter,SharedPreferencesUtility.RECOMMENDDAILY));
		rtflv.setAdapter(adapter);
		RelativeLayout  buyRelativeLayout = (RelativeLayout) LayoutInflater.from(this).inflate(R.layout.tuijian_layout, null);
		//添加其他模块控件
		rtflv.getRefreshableView().addHeaderView(buyRelativeLayout, null, false);
	}

	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.go_back:
			finish();
			break;
		}		
	}

}

package com.huayan.life.Activity;

import java.util.List;

import org.apache.http.Header;

import util.HttpUrl;
import util.HttpUtils;
import util.SharedPreferencesUtility;
import android.annotation.SuppressLint;
import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.os.Handler;
import android.os.Message;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.TextView;
import android.widget.Toast;

import com.alibaba.fastjson.JSON;
import com.alibaba.fastjson.JSONArray;
import com.alibaba.fastjson.JSONException;
import com.alibaba.fastjson.JSONObject;
import com.handmark.pulltorefresh.library.PullToRefreshBase.Mode;
import com.handmark.pulltorefresh.library.PullToRefreshListView;
import com.huayan.life.R;
import com.huayan.life.adapter.OrderListAdapter;
import com.huayan.life.common.GetData;
import com.huayan.life.common.OrderOnRefreshListener2;
import com.huayan.life.model.Order;
import com.loopj.android.http.JsonHttpResponseHandler;
import com.loopj.android.http.RequestParams;

@SuppressLint({ "ValidFragment", "HandlerLeak" })
public class MyFragment extends Fragment  {

	private Activity mActivity;
	private View mView;
	private int mIndex;
	private PullToRefreshListView mListView;
	private OrderListAdapter newAdapter = null;

	Handler myHandler;
	int currentPage=0;
	int totalPage=0;
	List <Order> orderList=null;
	
	public MyFragment(Activity activity, int index) {
		mActivity = activity;
		mIndex = index;
	}

	@Override
	public View onCreateView(LayoutInflater inflater, ViewGroup container,
			Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreateView(inflater, container, savedInstanceState);
		mView = inflater.inflate(R.layout.film_seat, null);
		initList();
		return mView;
	}

	/* 然后， 我们来给mList添加一些要显示的数据 */
	private void initList() {
		mListView = (PullToRefreshListView) mView.findViewById(R.id.ptrlvEntertainmentFilm);
		
		SharedPreferencesUtility.removeSharedPreferences(mActivity,SharedPreferencesUtility.ORDERS_lIST);
		//获取storeList
				SharedPreferences sp =mActivity.getSharedPreferences(SharedPreferencesUtility.ORDERS_lIST, Context.MODE_PRIVATE);
				currentPage=sp.getInt(SharedPreferencesUtility.CURRENT_PAGE, 0);
				totalPage=sp.getInt(SharedPreferencesUtility.PAGE_COUNT, 0);
				if((totalPage!=0&&totalPage!=currentPage)||(currentPage==0)){		
						myHandler = new Handler() {
							@Override
							public void handleMessage(Message msg) {
								if (msg.what == 0x16) {
									currentPage++;
									SharedPreferencesUtility.saveData(SharedPreferencesUtility.ORDERS_lIST,SharedPreferencesUtility.CURRENT_PAGE, currentPage, mActivity);
									Bundle bundle=msg.getData();
									String jsonStr=bundle.getString("jsonString");
									int pageCount=bundle.getInt("pageCount");
									SharedPreferencesUtility.saveData(SharedPreferencesUtility.ORDERS_lIST,SharedPreferencesUtility.PAGE_COUNT, pageCount, mActivity);
									orderList=  JSON.parseArray(jsonStr, Order.class);		
									newAdapter = new OrderListAdapter(mActivity,orderList);
									initPullToRefreshListView(mListView,newAdapter);
								}
								super.handleMessage(msg);
							}
						};
						getOrderList(mActivity, myHandler, currentPage, mIndex);//得到数据		
				}else{
					Toast.makeText(mActivity, getResources().getString(R.string.no_newData), Toast.LENGTH_SHORT).show();
				}
				
		mListView.setOnItemClickListener(new OnItemClickListener() {
			@Override
			public void onItemClick(AdapterView<?> parent, View view, int position,long arg3) {
				
				Order  order=newAdapter.getItem(position); 				
			    TextView text = (TextView) view.findViewById(R.id.tv_order_category);
			    String category=text.getText().toString();
			    Intent  intent = new Intent(mActivity, OrderIntroductionActivity.class); //订单介绍
			    intent.putExtra("orderID", order.getOrderID());
			    intent.putExtra("category", category);
				startActivity(intent);
			}
		});
	}
	
	private void initPullToRefreshListView(PullToRefreshListView rtflv,OrderListAdapter adapter) {
		rtflv.setMode(Mode.BOTH);
		rtflv.setOnRefreshListener(new OrderOnRefreshListener2(rtflv,mActivity,newAdapter,mIndex));
		rtflv.setAdapter(adapter);
	}
	
	public static  void getOrderList(final Context mContext,final Handler handler,int currentPage,final int type){
//		User myUser =ShareUtil.readUser(mContext);

		RequestParams params = new RequestParams(); // 绑定参数	
//		params.put("username", myUser.getUsername());
//		params.put("token", myUser.getToken());
		params.put("page", currentPage);
		params.put("rows", 10);
		params.put("opeType", "getList");
		params.put("requestType", 1);
		params.put("mobile", 1);
		params.put("type", type);
		 
		 HttpUtils.post(HttpUrl.ORDERACTION, params, new JsonHttpResponseHandler(){

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
//									msg.what = 0x16;
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
						JSONObject obj =  JSON.parseObject(GetData.getOrders(type));
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
								msg.what = 0x16;
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

}

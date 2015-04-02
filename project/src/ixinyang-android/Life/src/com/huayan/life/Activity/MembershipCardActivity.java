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
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.AdapterView.OnItemLongClickListener;
import android.widget.ImageButton;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import com.alibaba.fastjson.JSON;
import com.alibaba.fastjson.JSONArray;
import com.alibaba.fastjson.JSONException;
import com.alibaba.fastjson.JSONObject;
import com.handmark.pulltorefresh.library.PullToRefreshBase.Mode;
import com.handmark.pulltorefresh.library.PullToRefreshListView;
import com.huayan.life.R;
import com.huayan.life.adapter.MembershipCardAdapter;
import com.huayan.life.common.GetData;
import com.huayan.life.common.MyOnRefreshListener8;
import com.huayan.life.model.MemberCard;
import com.loopj.android.http.JsonHttpResponseHandler;
import com.loopj.android.http.RequestParams;

/**
 * 会员卡
 * @author wzz
 *
 */
@SuppressLint("HandlerLeak")
public class MembershipCardActivity extends BaseActivity implements OnClickListener {

	private PullToRefreshListView ptrlvHeadLineNews = null;
	private MembershipCardAdapter newAdapter = null;
	List<MemberCard> listCard=null;
	Handler myHandler;
	int currentPage=0;
	int totalPage=0;
	
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_membership_card);
		ptrlvHeadLineNews = (PullToRefreshListView) findViewById(R.id.ptrlv_membership_card);
		((ImageButton)findViewById(R.id.ib_fanhui)).setOnClickListener(this);
		SharedPreferencesUtility.removeSharedPreferences(context,SharedPreferencesUtility.CURRENT_CONTEXT);
		
		SharedPreferences sp = getSharedPreferences(SharedPreferencesUtility.CURRENT_CONTEXT, MODE_PRIVATE);
		currentPage=sp.getInt(SharedPreferencesUtility.CURRENT_PAGE, 0);
		totalPage=sp.getInt(SharedPreferencesUtility.PAGE_COUNT, 0);
		if((totalPage!=0&&totalPage!=currentPage)||(currentPage==0)){		
				myHandler = new Handler() {
					@Override
					public void handleMessage(Message msg) {
						if (msg.what == 0x11) {
							currentPage++;
							SharedPreferencesUtility.saveData(SharedPreferencesUtility.CURRENT_CONTEXT,SharedPreferencesUtility.CURRENT_PAGE, currentPage, context);
							Bundle bundle=msg.getData();
							String jsonStr=bundle.getString("jsonString");
							int pageCount=bundle.getInt("pageCount");
							SharedPreferencesUtility.saveData(SharedPreferencesUtility.CURRENT_CONTEXT,SharedPreferencesUtility.PAGE_COUNT, pageCount, context);
							listCard=  JSON.parseArray(jsonStr, MemberCard.class);		
							newAdapter = new MembershipCardAdapter(context,listCard);
							initPullToRefreshListView(ptrlvHeadLineNews, newAdapter);
						}
						super.handleMessage(msg);
					}
				};
				getMemberCardList(context,myHandler,currentPage);//得到数据		
		}else{
			Toast.makeText(this, getResources().getString(R.string.no_newData), Toast.LENGTH_SHORT).show();
		}
		
		ptrlvHeadLineNews.setOnItemClickListener(new OnItemClickListener() {
			@Override
			public void onItemClick(AdapterView<?> parent, View view, int position,long arg3) {
				//会员卡详情页
				MemberCard  memberCard=newAdapter.getItem(position); 
				Intent intent = new Intent(MembershipCardActivity.this,MembershipDetailActivity.class);
				intent.putExtra("cardID", memberCard.getCardID());
				startActivity(intent);
			}			
		});
		
		
		ListView actualListView = ptrlvHeadLineNews.getRefreshableView();	
		actualListView.setOnItemLongClickListener(new OnItemLongClickListener() {
			@Override
			public boolean onItemLongClick(AdapterView<?> adapter, View v,final int position, long arg3) {
				TextView tv_delete=(TextView)v.findViewById(R.id.tv_delete);
				tv_delete.setVisibility(View.VISIBLE);
				
				tv_delete.setOnClickListener(new OnClickListener() {
					@Override
					public void onClick(View v) {
						// TODO 删除
						listCard.remove(position);
						newAdapter.notifyDataSetChanged();
					}
				});
				return true;
			}
		});

	}

	private void initPullToRefreshListView(PullToRefreshListView rtflv,	MembershipCardAdapter adapter) {
		rtflv.setMode(Mode.BOTH);
		rtflv.setOnRefreshListener(new MyOnRefreshListener8(rtflv,this,newAdapter));
		rtflv.setAdapter(adapter);
	}
	
	public static  void getMemberCardList(final Context mContext,final Handler handler,int currentPage){
//			User myUser =ShareUtil.readUser(mContext);

			RequestParams params = new RequestParams(); // 绑定参数	
//			params.put("username", myUser.getUsername());
//			params.put("token", myUser.getToken());
			params.put("page", currentPage);
			params.put("rows", 10);
			params.put("opeType", "getCardList");
			params.put("requestType", 1);
			params.put("mobile", 1);
			 
			 HttpUtils.post(HttpUrl.MEMBERCARDACTION, params, new JsonHttpResponseHandler(){

				@Override
				public void onSuccess(int statusCode, Header[] arg1, String responseString) {
					 if(statusCode==200){
//							try {
//								JSONObject obj =  JSON.parseObject(responseString);
//								Boolean result=obj.getBoolean("success");
//								if(result){
//								String content=obj.getString("content");													
//								JSONObject objContent=JSON.parseObject(content);
//								
//								final int  pageCount=objContent.getInteger("pageCount");
////								int recordCount=objContent.getInteger("recordCount");	//总条数
//								
//								JSONArray arr = objContent.getJSONArray("recordList");	
//								 final String jsonString=arr.toString();
//								
//								new Thread(new Runnable() {
//									public void run() {
//										Message msg = handler.obtainMessage();
//										Bundle bd=new Bundle();
//										bd.putString("jsonString", jsonString);
//										bd.putInt("pageCount", pageCount);
//										msg.setData(bd);
//										msg.what = 0x11;
//										msg.sendToTarget();
//									}
//								}).start();
//								}else{
//									Toast.makeText(mContext, mContext.getResources().getString(R.string.dialog_title_getDataFail), Toast.LENGTH_SHORT).show();
//								}							
//							} catch (JSONException e) {
//								e.printStackTrace();
//							}
					 }			
				}
				
				@Override
				public void onFailure(int statusCode, Header[] arg1, String responseString,Throwable error) {
						error.printStackTrace();
						try {
							JSONObject obj =  JSON.parseObject(GetData.getMembershipList());
							Boolean result=obj.getBoolean("success");
							if(result){
							String content=obj.getString("content");													
							JSONObject objContent=JSON.parseObject(content);
							
							final int  pageCount=objContent.getInteger("pageCount");
//							int recordCount=objContent.getInteger("recordCount");	//总条数
							
							JSONArray arr = objContent.getJSONArray("recordList");	
							 final String jsonString=arr.toString();
							
							new Thread(new Runnable() {
								public void run() {
									Message msg = handler.obtainMessage();
									Bundle bd=new Bundle();
									bd.putString("jsonString", jsonString);
									bd.putInt("pageCount", pageCount);
									msg.setData(bd);
									msg.what = 0x11;
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
	
	
	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.ib_fanhui:
			finish();
			break;
		}
	}
	
}

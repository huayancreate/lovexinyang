package com.huayan.life.Activity;

import java.util.List;

import org.apache.http.Header;

import util.HttpUrl;
import util.HttpUtils;
import util.ShareUtil;
import util.SharedPreferencesUtility;
import android.annotation.SuppressLint;
import android.app.AlertDialog.Builder;
import android.content.Context;
import android.content.DialogInterface;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.os.Handler;
import android.os.Message;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageButton;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.alibaba.fastjson.JSON;
import com.alibaba.fastjson.JSONArray;
import com.alibaba.fastjson.JSONException;
import com.alibaba.fastjson.JSONObject;
import com.handmark.pulltorefresh.library.PullToRefreshBase.Mode;
import com.handmark.pulltorefresh.library.PullToRefreshListView;
import com.huayan.life.R;
import com.huayan.life.adapter.NoticeAdapter;
import com.huayan.life.common.GetData;
import com.huayan.life.common.MyOnRefreshListener1;
import com.huayan.life.model.Notice;
import com.huayan.life.model.User;
import com.loopj.android.http.JsonHttpResponseHandler;
import com.loopj.android.http.RequestParams;

/**
 * 通知列表
 * @author wzz
 *
 */
@SuppressLint("HandlerLeak")
public class NoticeActivity extends BaseActivity implements OnClickListener{

	private PullToRefreshListView ptrlvHeadLineNews = null;
	private NoticeAdapter newAdapter = null;
	private ImageButton goBackTextView;
	static User user=null;
	List<Notice> noticeList=null;
	Handler myHandler;
	int currentPage=0;
	int totalPage=0;
	LinearLayout llClean;
	TextView tv_notice_clean;
	
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_notice);
		initView();
		user=ShareUtil.readUser(context);	
		SharedPreferencesUtility.removeSharedPreferences(context,SharedPreferencesUtility.NOTICEACTIVITY);
		
		SharedPreferences sp = getSharedPreferences(SharedPreferencesUtility.NOTICEACTIVITY, MODE_PRIVATE);
		currentPage=sp.getInt(SharedPreferencesUtility.CURRENT_PAGE, 0);
		totalPage=sp.getInt(SharedPreferencesUtility.PAGE_COUNT, 0);
		if((totalPage!=0&&totalPage!=currentPage)||(currentPage==0)){		
				myHandler = new Handler() {
					@Override
					public void handleMessage(Message msg) {
						if (msg.what == 0x01) {
							currentPage++;
							SharedPreferencesUtility.saveData(SharedPreferencesUtility.NOTICEACTIVITY,SharedPreferencesUtility.CURRENT_PAGE, currentPage, context);
							Bundle bundle=msg.getData();
							String jsonStr=bundle.getString("jsonString");
							int pageCount=bundle.getInt("pageCount");
							SharedPreferencesUtility.saveData(SharedPreferencesUtility.NOTICEACTIVITY,SharedPreferencesUtility.PAGE_COUNT, pageCount, context);
							noticeList=  JSON.parseArray(jsonStr, Notice.class);		
							newAdapter = new NoticeAdapter(context,noticeList);
							initPullToRefreshListView(ptrlvHeadLineNews, newAdapter);
							if(noticeList==null){
								llClean.setEnabled(false);
								tv_notice_clean.setTextColor(getResources().getColor(R.color.clean_text));
							}else{
								llClean.setEnabled(true);
								tv_notice_clean.setTextColor(getResources().getColor(R.color.white));
							}
						}
						super.handleMessage(msg);
					}
				};
				getNoticeList(context,myHandler,currentPage);//得到数据		
		}else{
			Toast.makeText(this, getResources().getString(R.string.no_newData), Toast.LENGTH_SHORT).show();
		}
		
		
	}

	public static  void getNoticeList(final Context mContext,final Handler handler,int currentPage){

		RequestParams params = new RequestParams(); // 绑定参数	
//		params.put("username", user.getUsername());
//		params.put("token", user.getToken());
		params.put("page", currentPage);
		params.put("rows", 10);
		params.put("opeType", "getList");
		params.put("requestType", 1);
		params.put("mobile", 1);
		 
		 HttpUtils.post(HttpUrl.NOTICEACTION, params, new JsonHttpResponseHandler(){

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
//									msg.what = 0x01;
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
						JSONObject obj =  JSON.parseObject(GetData.getNoticeList());
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
								msg.what = 0x01;
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
		goBackTextView = (ImageButton) findViewById(R.id.img_goback_returns);
		goBackTextView.setOnClickListener(this);
		llClean=(LinearLayout)findViewById(R.id.ll_clean);
		llClean.setOnClickListener(this);
		tv_notice_clean=(TextView)findViewById(R.id.tv_notice_clean);
		ptrlvHeadLineNews = (PullToRefreshListView) findViewById(R.id.ptrlv_notice);
	}
	
	private void initPullToRefreshListView(PullToRefreshListView rtflv,NoticeAdapter adapter) {
		rtflv.setMode(Mode.BOTH);
		rtflv.setOnRefreshListener(new MyOnRefreshListener1(rtflv, this,newAdapter));
		rtflv.setAdapter(adapter);
	}

	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.img_goback_returns:
			finish();
			break;
		case R.id.ll_clean:
			showDialog();
			break;
		}
	}
	
	
	private  void showDialog() {
		// 清空通知
		Builder builder = new android.app.AlertDialog.Builder(this);
		// 设置对话框的图标
		builder.setIcon(android.R.drawable.ic_dialog_info);
		// 设置对话框的标题
		builder.setTitle("确认清除全部通知吗？");
		// 添加一个确定按钮
		builder.setPositiveButton(" 确 定 ",
				new DialogInterface.OnClickListener() {
					public void onClick(DialogInterface dialog, int which) {
						deleteAllNotice();// 清空通知
						dialog.dismiss();
					}
				});

		// 添加一个取消按钮
		builder.setNegativeButton("取 消", new DialogInterface.OnClickListener() {
			@Override
			public void onClick(DialogInterface dialog, int which) {
				dialog.dismiss();
			}
		});
		// 创建一个复选框对话框
		builder.show();
	}
			
	private  void deleteAllNotice(){

		RequestParams params = new RequestParams(); // 绑定参数	
//		params.put("username", user.getUsername());
//		params.put("token", user.getToken());
		params.put("opeType", "delAll");
		params.put("requestType", 1);
		params.put("mobile", 1);
		 
		 HttpUtils.post(HttpUrl.NOTICEACTION, params, new JsonHttpResponseHandler(){

			@Override
			public void onSuccess(int statusCode, Header[] arg1, String responseString) {
				 if(statusCode==200){
//						try {
//							JSONObject obj =  JSON.parseObject(responseString);
//							Boolean success=obj.getBoolean("success");
//							if(success){
//								String content=obj.getString("content");													
//								JSONObject objContent=JSON.parseObject(content);
//								String message=objContent.getString("message");
//								Boolean  result = objContent.getBoolean("result");	
//								if(result){
//									noticeList.clear();
//									newAdapter.notifyDataSetChanged();
//									Toast.makeText(NoticeActivity.this,message, Toast.LENGTH_SHORT).show();
//								}							
//							}else{
//								Toast.makeText(NoticeActivity.this,"清空失败！", Toast.LENGTH_SHORT).show();
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
						JSONObject obj =  JSON.parseObject(GetData.delNoticeList());
						Boolean success=obj.getBoolean("success");
						if(success){
							String content=obj.getString("content");													
							JSONObject objContent=JSON.parseObject(content);
							String message=objContent.getString("message");
							Boolean  result = objContent.getBoolean("result");	
							if(result){
								noticeList.clear();
								newAdapter.notifyDataSetChanged();
								llClean.setEnabled(false);
								tv_notice_clean.setTextColor(getResources().getColor(R.color.clean_text));
								Toast.makeText(NoticeActivity.this,message, Toast.LENGTH_SHORT).show();
							}							
						}else{
							Toast.makeText(NoticeActivity.this,"清空失败！", Toast.LENGTH_SHORT).show();
						}							
					} catch (JSONException e) {
						e.printStackTrace();
					}
			}			 
		 });
}	
	
}

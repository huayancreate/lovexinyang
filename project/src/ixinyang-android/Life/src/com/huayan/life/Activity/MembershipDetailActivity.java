package com.huayan.life.Activity;

import java.util.List;

import org.apache.http.Header;

import util.HttpUrl;
import util.HttpUtils;
import util.ShareUtil;
import android.annotation.SuppressLint;
import android.os.Bundle;
import android.os.Handler;
import android.os.Message;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageButton;
import android.widget.ListView;
import android.widget.RelativeLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.alibaba.fastjson.JSON;
import com.alibaba.fastjson.JSONArray;
import com.alibaba.fastjson.JSONException;
import com.alibaba.fastjson.JSONObject;
import com.huayan.life.R;
import com.huayan.life.adapter.RecordAdapter;
import com.huayan.life.model.ConsumerList;
import com.huayan.life.model.User;
import com.loopj.android.http.JsonHttpResponseHandler;
import com.loopj.android.http.RequestParams;

/**
 * 
 * @author wzz
 *会员卡详情页
 */
public class MembershipDetailActivity extends BaseActivity implements OnClickListener {

	ListView recordList;
	int cardID;
	RecordAdapter adapter = null;
	List<ConsumerList> records=null;
	Handler myHandler;
	User user =null;
	TextView tvShopName,tvLevel,tvNumber,tvGrowth,tv_grade;
	RelativeLayout rl_album;
	
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_membership_detail);		
		cardID = getIntent().getIntExtra("cardID", -1);
		user=ShareUtil.readUser(context);
		initView();
	}
	
	@SuppressLint("HandlerLeak")
	private void initView(){
		((ImageButton)findViewById(R.id.ib_goback_pre)).setOnClickListener(this);		
		recordList=(ListView)findViewById(R.id.lv_records_consumption);
		tvShopName=(TextView)findViewById(R.id.sto_name);
		tvLevel=(TextView)findViewById(R.id.ms_grade);
		tvNumber=(TextView)findViewById(R.id.ms_number);
		tvGrowth=(TextView)findViewById(R.id.tv_growth_value);
		tv_grade=(TextView)findViewById(R.id.tv_grade);
		rl_album=(RelativeLayout)findViewById(R.id.ms_album);
		
		getCardInfo();
		getCardRecordsList();
		myHandler = new Handler() {
			@Override
			public void handleMessage(Message msg) {
				if (msg.what == 0x12) {
					Bundle bundle=msg.getData();
					String jsonStr=bundle.getString("jsonString");
					records=  JSON.parseArray(jsonStr, ConsumerList.class);		
					adapter = new RecordAdapter(context,records);
					recordList.setAdapter(adapter);
				}
				super.handleMessage(msg);
			}
		};
	}
	
	
	private  void getCardInfo(){
		RequestParams params = new RequestParams(); // 绑定参数
		params.put("cardID", cardID);				
		params.put("username", user.getUsername());
		params.put("token", user.getToken());
		params.put("opeType", "getCardInfo");
		params.put("requestType", 1);
		params.put("mobile", 1);
		 
		 HttpUtils.post(HttpUrl.MEMBERCARDACTION, params, new JsonHttpResponseHandler(){

			@Override
			public void onSuccess(int statusCode, Header[] arg1, String responseString) {
				 if(statusCode==200){
						try {
							JSONObject obj =  JSON.parseObject(responseString);
							Boolean result=obj.getBoolean("success");
							if(result){
									String content=obj.getString("content");													
									JSONObject objContent=JSON.parseObject(content);
									
									String  shopName=objContent.getString("shopName");
									String level=objContent.getString("level");	
									String number=objContent.getString("number");
									String growthValue=objContent.getString("growthValue");
//									String img=objContent.getString("img");//会员图片
									tvShopName.setText(shopName);
									tvLevel.setText(level);
									tvNumber.setText(number);
									tvGrowth.setText("成长值："+growthValue);
									tv_grade.setText("当前等级："+level);									
							}else{
								Toast.makeText(MembershipDetailActivity.this, getResources().getString(R.string.dialog_title_getDataFail), Toast.LENGTH_SHORT).show();
							}							
						} catch (JSONException e) {
							e.printStackTrace();
						}
				 }			
			}
			
			@Override
			public void onFailure(int statusCode, Header[] arg1, String responseString,Throwable error) {
					error.printStackTrace();
			}			 
		 });
}
	
	private  void getCardRecordsList(){
		RequestParams params = new RequestParams(); // 绑定参数		
		params.put("cardID", cardID);				
		params.put("username", user.getUsername());
		params.put("token", user.getToken());
		params.put("opeType", "getCardConsumerList");
		params.put("requestType", 1);
		params.put("mobile", 1);
		 
		 HttpUtils.post(HttpUrl.MEMBERCARDACTION, params, new JsonHttpResponseHandler(){

			@Override
			public void onSuccess(int statusCode, Header[] arg1, String responseString) {
				 if(statusCode==200){
						try {
							JSONObject obj =  JSON.parseObject(responseString);
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
									Message msg = myHandler.obtainMessage();
									Bundle bd=new Bundle();
									bd.putString("jsonString", jsonString);
									bd.putInt("pageCount", pageCount);
									msg.setData(bd);
									msg.what = 0x12;
									msg.sendToTarget();
								}
							}).start();
							}else{
								Toast.makeText(MembershipDetailActivity.this, getResources().getString(R.string.dialog_title_getDataFail), Toast.LENGTH_SHORT).show();
							}							
						} catch (JSONException e) {
							e.printStackTrace();
						}
				 }			
			}
			
			@Override
			public void onFailure(int statusCode, Header[] arg1, String responseString,Throwable error) {
					error.printStackTrace();
			}			 
		 });
}
	
	@Override
	public void onClick(View v) {
			switch (v.getId()) {
			case R.id.ib_goback_pre:
				finish();
				break;
			default:
				break;
			}
		}
	
}

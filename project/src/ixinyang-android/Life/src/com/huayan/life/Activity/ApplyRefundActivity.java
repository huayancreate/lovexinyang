package com.huayan.life.Activity;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;

import org.apache.http.Header;

import util.HttpUrl;
import util.HttpUtils;
import util.Utility;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.CheckBox;
import android.widget.CompoundButton;
import android.widget.CompoundButton.OnCheckedChangeListener;
import android.widget.ImageButton;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import com.alibaba.fastjson.JSON;
import com.alibaba.fastjson.JSONException;
import com.alibaba.fastjson.JSONObject;
import com.huayan.life.R;
import com.huayan.life.adapter.RefundAdapter;
import com.huayan.life.common.GetData;
import com.huayan.life.model.Codes;
import com.loopj.android.http.JsonHttpResponseHandler;
import com.loopj.android.http.RequestParams;

/**
 * 申请退款
 * 
 * @author wzz
 * 
 */
public class ApplyRefundActivity extends BaseActivity implements OnClickListener {

	TextView tv_refund_flow;
	CheckBox cb_method1, cb_method2, cb_reason1, cb_reason2, cb_reason3,
			cb_reason4, cb_reason5, cb_reason6, cb_reason7;// 退款方式
	ListView lvRefundCode;
	List<String> codeList = new ArrayList<String>() ;
	RefundAdapter adapter = null;
	String jsonString;
	String orderId,discountPrice;
	int detailId;

   int checkNum=0; // 记录选中的条目数量
	HashMap<String, String> hm;
	String method=null;
	int reason;

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_apply_refund);
		jsonString = getIntent().getStringExtra("jsonCode");
		orderId = getIntent().getStringExtra("orderID");
		detailId = getIntent().getIntExtra("detailsID", 0);
		discountPrice=getIntent().getStringExtra("discountPrice");
		hm = new HashMap<String, String>();
		initView();
	}

	private void initView() {
		((ImageButton) findViewById(R.id.ib_return_go_refund)).setOnClickListener(this);
		((TextView) findViewById(R.id.txt_apply_refund)).setOnClickListener(this);
		lvRefundCode = (ListView) findViewById(R.id.lv_refund_codes);
		tv_refund_flow = (TextView) findViewById(R.id.tv_refund_flow);
		cb_method1 = (CheckBox) findViewById(R.id.cb_method1);
		cb_method2 = (CheckBox) findViewById(R.id.cb_method2);
		cb_reason1 = (CheckBox) findViewById(R.id.cb_reason1);
		cb_reason2 = (CheckBox) findViewById(R.id.cb_reason2);
		cb_reason3 = (CheckBox) findViewById(R.id.cb_reason3);
		cb_reason4 = (CheckBox) findViewById(R.id.cb_reason4);
		cb_reason5 = (CheckBox) findViewById(R.id.cb_reason5);
		cb_reason6 = (CheckBox) findViewById(R.id.cb_reason6);
		cb_reason7 = (CheckBox) findViewById(R.id.cb_reason7);
		refundReason(cb_reason1, cb_reason2, cb_reason3,cb_reason4, cb_reason5, cb_reason6, cb_reason7);
		refundReason(cb_reason2, cb_reason1, cb_reason3,cb_reason4, cb_reason5, cb_reason6, cb_reason7);
		refundReason(cb_reason3, cb_reason2, cb_reason1,cb_reason4, cb_reason5, cb_reason6, cb_reason7);
		refundReason(cb_reason4, cb_reason2, cb_reason3,cb_reason1, cb_reason5, cb_reason6, cb_reason7);
		refundReason(cb_reason5, cb_reason2, cb_reason3,cb_reason4, cb_reason1, cb_reason6, cb_reason7);
		refundReason(cb_reason6, cb_reason2, cb_reason3,cb_reason4, cb_reason5, cb_reason1, cb_reason7);
		refundReason(cb_reason7, cb_reason2, cb_reason3,cb_reason4, cb_reason5, cb_reason6, cb_reason1);

		List<Codes> listCodes = JSON.parseArray(jsonString, Codes.class);
		if (listCodes != null) {
			for (int i = 0; i < listCodes.size(); i++) {
				Codes code = listCodes.get(i);
				if(code!=null){
					codeList.add(code.getGoodsPassword());
				}
			}
		}

		adapter = new RefundAdapter(context, codeList);
		lvRefundCode.setAdapter(adapter);
		Utility.setListViewHeightBasedOnChildren(lvRefundCode,10);

		lvRefundCode.setOnItemClickListener(new OnItemClickListener() {
			@Override
			public void onItemClick(AdapterView<?> adapter1, View view,
					int position, long arg3) {
				final String code = adapter.getItem(position);
				CheckBox cb = (CheckBox) view.findViewById(R.id.cb_ma);

				cb.setOnCheckedChangeListener(new OnCheckedChangeListener() {
					@Override
					public void onCheckedChanged(CompoundButton buttonView,boolean isChecked) {
						if (isChecked) {
							checkNum++;
							hm.put(code, code);
						} else {
							if (hm.containsKey(code)) {
								hm.remove(code);
								checkNum--;
							}
						}
						float price = checkNum * Float.valueOf(discountPrice);
						tv_refund_flow.setText("￥" + price);
					}
				});
			}
		});
		choiceMethod();
	}
	
	private  void choiceMethod(){
		
		cb_method1.setOnCheckedChangeListener(new OnCheckedChangeListener() {
			@Override
			public void onCheckedChanged(CompoundButton buttonView,boolean isChecked) {
				// TODO 选择一种退款方式
				if(isChecked){
					cb_method2.setChecked(false);
					method="0";
				}else{
					cb_method2.setChecked(true);
					method="1";
				}
			}		
		});
		
		cb_method2.setOnCheckedChangeListener(new OnCheckedChangeListener() {
			@Override
			public void onCheckedChanged(CompoundButton buttonView, boolean isChecked) {
				if(isChecked){
					cb_method1.setChecked(false);
					method="1";
				}else{
					cb_method1.setChecked(true);
					method="0";
				}
			}
		});
		
	}
	
	private void refundReason(CheckBox cb1 ,final CheckBox cb2 ,final CheckBox cb3,final CheckBox cb4,final CheckBox cb5,final CheckBox cb6,final CheckBox cb7){
		cb1.setOnCheckedChangeListener(new OnCheckedChangeListener() {			
			@Override
			public void onCheckedChanged(CompoundButton buttonView, boolean isChecked) {
				if(isChecked){
					cb2.setChecked(false);
					cb3.setChecked(false);
					cb4.setChecked(false);
					cb5.setChecked(false);
					cb6.setChecked(false);
					cb7.setChecked(false);
				}
			}
		});
	}
	
	private void choiceReason(){
		if(cb_reason1.isChecked()){
			reason=1;
		}else if(cb_reason2.isChecked()){
			reason=2;
		}else if(cb_reason3.isChecked()){
			reason=3;
		}else if(cb_reason4.isChecked()){
			reason=4;
		}else if(cb_reason5.isChecked()){
			reason=5;
		}else if(cb_reason6.isChecked()){
			reason=6;
		}else if(cb_reason7.isChecked()){
			reason=7;
		}
	}
	
	private void  refund(){
		choiceReason();
//		User myUser =ShareUtil.readUser(mContext);
		RequestParams params = new RequestParams(); // 绑定参数	
//		params.put("username", myUser.getUsername());
//		params.put("token", myUser.getToken());
		params.put("orderID", orderId);
		params.put("type", method);
		params.put("reason", reason);//退款原因
		params.put("detilsIDList", hm);//退款券码
		params.put("opeType", "refund");
		params.put("requestType", 1);
		params.put("mobile", 1);

		 HttpUtils.post(HttpUrl.ORDERTRANSACTION, params, new JsonHttpResponseHandler(){

			@Override
			public void onSuccess(int statusCode, Header[] arg1, String responseString) {
				 if(statusCode==200){
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
								String  message=objContent.getString("message");
								Boolean result=objContent.getBoolean("result");
								if(result){
									Toast.makeText(context, message, Toast.LENGTH_SHORT).show();
									Intent intent = new Intent(ApplyRefundActivity.this,RefundSuccessActivity.class);//退款成功
									intent.putExtra("orderID", orderId);
									intent.putExtra("detailsID", detailId);
									startActivity(intent);
								}
						}else{
							Toast.makeText(context, context.getResources().getString(R.string.dialog_title_getDataFail), Toast.LENGTH_SHORT).show();
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
		case R.id.ib_return_go_refund:
			finish(); 
			break;
		case R.id.txt_apply_refund:
			refund();
			break;
		}
	}

}

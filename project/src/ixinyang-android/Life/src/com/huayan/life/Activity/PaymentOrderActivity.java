package com.huayan.life.Activity;

import org.apache.http.Header;

import util.HttpUrl;
import util.HttpUtils;
import util.ShareUtil;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.CheckBox;
import android.widget.ImageButton;
import android.widget.TextView;
import android.widget.Toast;

import com.alibaba.fastjson.JSON;
import com.alibaba.fastjson.JSONException;
import com.alibaba.fastjson.JSONObject;
import com.huayan.life.R;
import com.huayan.life.model.Order;
import com.huayan.life.model.User;
import com.loopj.android.http.JsonHttpResponseHandler;
import com.loopj.android.http.RequestParams;

/**
 * 支付订单
 * @author wzz
 *
 */
public class PaymentOrderActivity extends BaseActivity implements OnClickListener {

	TextView payNum,orderNo,totalPrice ,yue ,money;
	 Order order =null;
	 User user=null;
	 CheckBox cb_pay;
	 
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_payment_order);
		initView();
	}
	
	private void initView(){
		user=ShareUtil.readUser(context);
		((ImageButton) findViewById(R.id.imgbud_fanhui)).setOnClickListener(this);
		payNum=(TextView)findViewById(R.id.tv_pay_number);
		orderNo=(TextView)findViewById(R.id.tv_pay_unitPrice);
		totalPrice=(TextView)findViewById(R.id.tv_pay_totalPrice); 
		yue=(TextView)findViewById(R.id.tv_pay_money);
		money=(TextView)findViewById(R.id.tv_payment_money);
		cb_pay=(CheckBox)findViewById(R.id.rb_pay);
		((TextView)findViewById(R.id.txt_payout_order)).setOnClickListener(this);
		order = (Order)getIntent().getSerializableExtra("submit_order");
		if(order!=null){
			payNum.setText(""+order.getNum());
			orderNo.setText(order.getOrderID());
			totalPrice.setText(order.getPrice());
//			getUserMoney();
		}				
	}
	
	private void getUserMoney() {			
		RequestParams params = new RequestParams(); // 绑定参数
		params.put("username", user.getUsername());
		params.put("token", user.getToken());
		params.put("opeType", "surplusMoney");
		params.put("requestType", 1);
		params.put("mobile", 1);
		 
		 HttpUtils.post(HttpUrl.FINANCEACTION, params, new JsonHttpResponseHandler(){

			@Override
			public void onSuccess(int statusCode, Header[] arg1, String responseString) {
				 if(statusCode==200){
						try {
							JSONObject obj =  JSON.parseObject(responseString); 
							Boolean success=obj.getBoolean("success");
							if(success){
								String content=obj.getString("content");		
								JSONObject objContent=JSON.parseObject(content);
								Boolean result=objContent.getBoolean("result");
								if(result){
									double yuMoney=objContent.getDouble("money");
									yue.setText(yuMoney+"元");
									double allPrice=Double.valueOf(order.getPrice());
									if(yuMoney>=allPrice){
										money.setText("0元");
									}else{
										double tempMoney=allPrice-yuMoney;
										money.setText(tempMoney+"元");
									}
								}else{
									Toast.makeText(context, getResources().getString(R.string.dialog_title_getDataFail), Toast.LENGTH_SHORT).show();
								}												
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

	private void payMoney() {			
		RequestParams params = new RequestParams(); // 绑定参数
		params.put("username", user.getUsername());
		params.put("token", user.getToken());
		params.put("opeType", "pay");
		params.put("orderID", order.getOrderID());
		params.put("requestType", 1);
		params.put("mobile", 1);
		 
		 HttpUtils.post(HttpUrl.ORDERTRANSACTION, params, new JsonHttpResponseHandler(){

			@Override
			public void onSuccess(int statusCode, Header[] arg1, String responseString) {
				 if(statusCode==200){
						try {
							JSONObject obj =  JSON.parseObject(responseString); 
							Boolean success=obj.getBoolean("success");
							if(success){
								String content=obj.getString("content");		
								JSONObject objContent=JSON.parseObject(content);
								Boolean result=objContent.getBoolean("result");
								if(result){
//									String returnUrl=objContent.getString("returnUrl");
									//TODO 支付宝接口
								}else{
									Toast.makeText(context, getResources().getString(R.string.dialog_title_getDataFail), Toast.LENGTH_SHORT).show();
								}												
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
		case R.id.imgbud_fanhui:
			finish();
			break;		
		case R.id.txt_payout_order:
			if(cb_pay.isChecked()){
				payMoney();
			}else{
				showDialog("请选择支付方式！");
			}
			break;
		}
	}
}

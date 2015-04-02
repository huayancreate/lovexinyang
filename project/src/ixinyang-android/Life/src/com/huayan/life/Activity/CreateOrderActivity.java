package com.huayan.life.Activity;

import java.util.HashMap;

import org.apache.http.Header;

import util.HttpUrl;
import util.HttpUtils;
import util.ShareUtil;
import util.StringUtility;
import android.content.Intent;
import android.os.Bundle;
import android.text.Editable;
import android.text.TextWatcher;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.LinearLayout;
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
 * 生成订单
 * @author wzz
 *
 */
public class CreateOrderActivity extends BaseActivity implements OnClickListener {

	EditText et_number;
	int num=0;//数量
	TextView addView,minusView,unitPrice,totalPrice,orderName ,phone ,submitOrder;
	private int MIN_MARK = 0; 
    private int MAX_MARK = 500; 
    int temp=0;
    int mPrice=0;
    User user=null;
    Bundle data =null;
	int goodsId,shopId;
	String price,name;
	
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_submit_orders);
		initView();
	}
	
	private void initView(){
		orderName=(TextView)findViewById(R.id.tv_orderName);
		phone=(TextView)findViewById(R.id.tv_binding_phone);
		submitOrder=(TextView)findViewById(R.id.txt_submit_order);
		unitPrice=(TextView)findViewById(R.id.tv_unit_price);
		totalPrice=(TextView)findViewById(R.id.tv_sub_total_price);
		addView=(TextView)findViewById(R.id.tv_add_number);
		minusView=(TextView)findViewById(R.id.tv_minus_number);
		et_number=(EditText)findViewById(R.id.et_number);
		addView.setTag("-");
		minusView.setTag("+");
		setViewListener();
		
		user=ShareUtil.readUser(context);
		String strPhone=StringUtility.changePhone(user.getUsername());
		phone.setText(strPhone);
		data=getIntent().getExtras();
		if(data!=null){
			price=data.getString("UnitPrice");
			name=data.getString("GoodsName");
			goodsId=data.getInt("goodsID");
			shopId=data.getInt("shopID");
			
			mPrice=Integer.valueOf(price);
			unitPrice.setText(mPrice+"元");
			totalPrice.setText(price+"元");
			et_number.setText("1");
			orderName.setText(name);
		}
	}

	private void setViewListener(){
		((ImageButton) findViewById(R.id.imgbu_fanhui)).setOnClickListener(this);
		((TextView) findViewById(R.id.txt_submit_order)).setOnClickListener(this);
		((LinearLayout)findViewById(R.id.ll_bangphone)).setOnClickListener(this);
		addView.setOnClickListener(new OnButtonClickListener());
		minusView.setOnClickListener(new OnButtonClickListener());
		et_number.addTextChangedListener(new OnTextChangeListener());
		et_number.setSelection(et_number.getText().toString().length());
	}
	
	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.imgbu_fanhui:
			finish();
			break;
		case R.id.txt_submit_order:
			updateOrder();
			break;   			
		case R.id.ll_bangphone:
			jumpToActivity(CreateOrderActivity.this, SaveVerificationActivity.class);//修改绑定手机
			break;
		}
	}
	
	private void updateOrder() {		
		final String goodsNum = et_number.getText().toString().trim();
		final String allPrice=totalPrice.getText().toString().trim();
		
		HashMap<String, String> hm= new HashMap<String, String>();
		hm.put("number", goodsNum);
		hm.put("allPrice", allPrice);
		hm.put("shopID", shopId+"");
		hm.put("goodsId",goodsId+"");
		
		RequestParams params = new RequestParams(); // 绑定参数
		params.put("username", user.getUsername());
		params.put("token", user.getToken());
		params.put("orderList", hm);
		params.put("opeType", "create");
		params.put("requestType", 1);
		params.put("mobile", 1);
		 
		 HttpUtils.post(HttpUrl.ORDERTRANSACTION, params, new JsonHttpResponseHandler(){

			@Override
			public void onSuccess(int statusCode, Header[] arg1, String responseString) {
				 if(statusCode==200){
						try {
							JSONObject obj =  JSON.parseObject(responseString); 
							String content=obj.getString("content");			
							JSONObject objContent=JSON.parseObject(content);
							Boolean result=objContent.getBoolean("result");
							String orderId=objContent.getString("orderID");
							String message=objContent.getString("message");//(true:message成功信息， false:message传递错误信息)
							if(result){
								Order myOder=new Order();
								myOder.setOrderID(orderId);
								myOder.setUnitPrice(price);
								myOder.setName(name);
								myOder.setNum(Integer.valueOf(goodsNum));
								myOder.setPrice(allPrice);
								
								Intent intent = new Intent(CreateOrderActivity.this, PaymentOrderActivity.class);
								Bundle bundle = new Bundle();
								bundle.putSerializable("submit_order", myOder);
								intent.putExtras(bundle);
								startActivity(intent);
							}
								Toast.makeText(CreateOrderActivity.this, message, Toast.LENGTH_SHORT).show();
							
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
	
	class OnButtonClickListener implements OnClickListener
	{
		@Override
		public void onClick(View v)
		{
			String numString = et_number.getText().toString();
			if (numString == null || numString.equals(""))
			{
				num = 0;
				et_number.setText("0");
				temp=0;
				totalPrice.setText(String.valueOf(temp)+"元");
			} else
			{
				if (v.getTag().equals("-"))
				{
					if (++num < 0)  //先加，再判断
					{
						num--;
						minusView.setBackgroundResource(R.drawable.ic_zoom_out_normal);
						Toast.makeText(CreateOrderActivity.this, "请输入一个大于0的数字",Toast.LENGTH_SHORT).show();
					} else
					{
						minusView.setBackgroundResource(R.drawable.ic_zoom_out_pressed);
						et_number.setText(String.valueOf(num));
						temp=num*mPrice;
					    totalPrice.setText(String.valueOf(temp)+"元");
					}
				} else if (v.getTag().equals("+"))
				{					
					if (--num < 0)  //先减，再判断
					{
						num++;		
						minusView.setBackgroundResource(R.drawable.ic_zoom_out_normal);
						Toast.makeText(CreateOrderActivity.this, "请输入一个大于0的数字",Toast.LENGTH_SHORT).show();
					} else
					{
						minusView.setBackgroundResource(R.drawable.ic_zoom_out_pressed);
						et_number.setText(String.valueOf(num));
						temp=num*mPrice;
					    totalPrice.setText(String.valueOf(temp)+"元");
					}
				}
			}
		}
	}
	
	/**
	 * EditText输入变化事件监听器
	 */
	class OnTextChangeListener implements TextWatcher
	{
		@Override
		public void afterTextChanged(Editable s)
		{
			String numString = s.toString();
			if(numString == null || numString.equals(""))
			{
				num = 0;
			}else {
				int numInt = Integer.parseInt(numString);
				if (numInt < 0)
				{
					minusView.setBackgroundResource(R.drawable.ic_zoom_out_normal);
					Toast.makeText(CreateOrderActivity.this, "请输入一个大于0的数字",Toast.LENGTH_SHORT).show();
				}else if(numInt==0){
					minusView.setBackgroundResource(R.drawable.ic_zoom_out_normal);
					et_number.setSelection(et_number.getText().toString().length());
					num = numInt;
				}else{
					//设置EditText光标位置 为文本末端
					et_number.setSelection(et_number.getText().toString().length());
					num = numInt;
				}
				
				if (MIN_MARK != -1 && MAX_MARK != -1) 
                { 
                     int markVal = 0; 
                     try 
                     { 
                         markVal = Integer.parseInt(s.toString()); 
                     } 
                     catch (NumberFormatException e) 
                     { 
                         markVal = 0; 
                     } 
                     if (markVal > MAX_MARK) 
                     { 
                         Toast.makeText(getBaseContext(), "数量不能超过500", Toast.LENGTH_SHORT).show(); 
                         et_number.setText(String.valueOf(MAX_MARK)); 
                     	temp=MAX_MARK*mPrice;
                        totalPrice.setText(String.valueOf(temp)+"元");
                     } else{
                    	 temp=markVal*mPrice;
                         totalPrice.setText(String.valueOf(temp)+"元");
                     }
                     return; 
                } 
			}
		}

		@Override
		public void beforeTextChanged(CharSequence s, int start, int count,
				int after)
		{
		}

		@Override
		public void onTextChanged(CharSequence s, int start, int before,int count)
		{	
			 if (start > 1) 
             { 
                 if (MIN_MARK != -1 && MAX_MARK != -1) 
                 { 
                   int myNum = Integer.parseInt(s.toString()); 
                   if (myNum > MAX_MARK) 
                   { 
                       s = String.valueOf(MAX_MARK); 
                      et_number.setText(s); 
                      temp=MAX_MARK*mPrice;
                      totalPrice.setText(String.valueOf(temp)+"元");
                   }  else if(myNum < MIN_MARK) 
                       s = String.valueOf(MIN_MARK);
                   return; 
                 } 
             } 
		}
		
	}
	
}

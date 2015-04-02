package com.huayan.life.Activity;

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
import android.widget.ImageButton;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import com.alibaba.fastjson.JSON;
import com.alibaba.fastjson.JSONArray;
import com.alibaba.fastjson.JSONException;
import com.alibaba.fastjson.JSONObject;
import com.huayan.life.R;
import com.huayan.life.adapter.OrderDetailAdapter;
import com.huayan.life.common.GetData;
import com.huayan.life.model.Order;
import com.huayan.life.model.OrderIntroduce;
import com.loopj.android.http.JsonHttpResponseHandler;
import com.loopj.android.http.RequestParams;

/**
 * 订单介绍
 * @author wzz
 *
 */
public class OrderIntroductionActivity extends BaseActivity implements OnClickListener{

	TextView tvOrderId,tvOrderTel,tv_orderTime,tv_orderNum,tv_orderPrice,tvPay;
	String orderID,type;
	ListView lv_order_introduction;
	OrderDetailAdapter orderAdapter=null;
	List<OrderIntroduce> orderList=null;
	int num;
	String price;
	
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_order_introduction);
		orderID=getIntent().getStringExtra("orderID");
		type=getIntent().getStringExtra("category");
		initView();
	}
		
	private  void initView(){
		tvPay=(TextView)findViewById(R.id.txt_pay);
		tvPay.setOnClickListener(this);
		if(type.equals(getResources().getString(R.string.pending_payment))){
			tvPay.setVisibility(View.VISIBLE);
		}else{
			tvPay.setVisibility(View.GONE);
		}
		
		((ImageButton)findViewById(R.id.ib_return_go)).setOnClickListener(this);
		tvOrderId=(TextView)findViewById(R.id.tv_orderId);
		tvOrderTel=(TextView)findViewById(R.id.tv_orderTel);
		tv_orderTime=(TextView)findViewById(R.id.tv_orderTime);
		tv_orderNum=(TextView)findViewById(R.id.tv_orderNum);
		tv_orderPrice=(TextView)findViewById(R.id.tv_orderPrice);		
		lv_order_introduction=(ListView)findViewById(R.id.lv_order_introduction);
		getOrderList();
		
		lv_order_introduction.setOnItemClickListener(new OnItemClickListener() {
			@Override
			public void onItemClick(AdapterView<?> adapter, View view, int position,long arg3) {
				
				OrderIntroduce  order=orderAdapter.getItem(position); 		
				 TextView text = (TextView) view.findViewById(R.id.tv_order_category1);
				 String category=text.getText().toString();
				  Intent intent=null ;
				    if(category.equals(getResources().getString(R.string.pending_payment))){//待付款
				    	 intent = new Intent(context, OrderDetailsActivity.class);
				    	 
				    }else if(category.equals(context.getResources().getString(R.string.dai_eva))){//待评价
				    	intent = new Intent(context, EvaOrderDetailsActivity.class);
				    	
				    }else if(category.equals(context.getResources().getString(R.string.yi_refund))){//已退款
				    	 intent = new Intent(context, RefundOrderDetailsActivity.class);
				    	
				    }else if(category.equals(context.getResources().getString(R.string.refunding))){//退款中
				    	 intent = new Intent(context, RefundOrderDetailsActivity.class);
				    	 
				    }else if(category.equals(context.getResources().getString(R.string.non_consumption))){//未消费
				    	 intent = new Intent(context, ConsumptionOrderDetailsActivity.class);
				    	 
				    }else{
				    	 intent = new Intent(context, EvaOrderDetailsActivity.class); //已评价
				    }
				    intent.putExtra("orderID", orderID);
				    intent.putExtra("detailsID", order.getDetailsID());
				    intent.putExtra("category", category);
					startActivity(intent);
			}
		});
	}
	
	
	private  void getOrderList(){
//		User myUser =ShareUtil.readUser(mContext);

		RequestParams params = new RequestParams(); // 绑定参数	
//		params.put("username", myUser.getUsername());
//		params.put("token", myUser.getToken());
		params.put("orderID", orderID);
		params.put("opeType", "getDetailsList");
		params.put("requestType", 1);
		params.put("mobile", 1);
		 
		 HttpUtils.post(HttpUrl.ORDERACTION, params, new JsonHttpResponseHandler(){

			@Override
			public void onSuccess(int statusCode, Header[] arg1, String responseString) {
				 if(statusCode==200){
				 }			
			}
			
			@Override
			public void onFailure(int statusCode, Header[] arg1, String responseString,Throwable error) {
					error.printStackTrace();
					try {
						JSONObject obj =  JSON.parseObject(GetData.getOrdersList());
						Boolean result=obj.getBoolean("success");
						if(result){
								String content=obj.getString("content");													
								JSONObject objContent=JSON.parseObject(content);
								String  time=objContent.getString("orderTime");
								String phone=objContent.getString("orderTel");
								num=objContent.getInteger("num");
								price=objContent.getString("price");
								tvOrderId.setText("订单号："+orderID);
								tvOrderTel.setText("购买手机号："+phone);
								tv_orderTime.setText("下单时间："+time);
								tv_orderNum.setText("数量："+num);
								tv_orderPrice.setText("总价："+price);
								
//								[{"typeName":"待付款","num":1,"price":"68","goodsImg":"http://rate.jpg","page":0,"detailsID":0,"shopName":"丽江龙继斑鱼庄","name":"肯德基套餐15元","requestType":0,"goodsID":11,"iD":0,"mobile":0,"rows":0},{"typeName":"未消费","num":2,"price":"58","goodsImg":"http://img.taobao-rate.jpg","page":0,"detailsID":1,"shopName":"丽江龙继斑鱼庄","name":"肯德基套餐25元","requestType":0,"goodsID":12,"iD":0,"mobile":0,"rows":0},{"typeName":"待评价","num":3,"price":"28","goodsImg":"http://im0-rate.jpg","page":0,"detailsID":2,"shopName":"肯德基KFC","name":"肯德基套餐12元","requestType":0,"goodsID":13,"iD":0,"mobile":0,"rows":0}]
								JSONArray arr = objContent.getJSONArray("recordList");	
								String jsonString=arr.toString();
								orderList=JSON.parseArray(jsonString, OrderIntroduce.class);
								orderAdapter=new OrderDetailAdapter(context, orderList);
								lv_order_introduction.setAdapter(orderAdapter);
								Utility.setListViewHeightBasedOnChildren(lv_order_introduction,10);
								
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
		case R.id.ib_return_go:
			finish();
			break;		
		case R.id.txt_pay:
			Order order=new Order();
			order.setOrderID(orderID);
			order.setNum(num);
			order.setPrice(price);
			Intent intent = new Intent(context, PaymentOrderActivity.class);//去付款
			Bundle bundle = new Bundle();
			bundle.putSerializable("submit_order", order);
			intent.putExtras(bundle);
			startActivity(intent);
			break;
		}
	}
	
}

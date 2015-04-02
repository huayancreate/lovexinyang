package com.huayan.life.Activity;

import org.apache.http.Header;

import util.HttpUrl;
import util.HttpUtils;
import android.graphics.Bitmap;
import android.graphics.Paint;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.alibaba.fastjson.JSON;
import com.alibaba.fastjson.JSONException;
import com.alibaba.fastjson.JSONObject;
import com.huayan.life.R;
import com.huayan.life.common.GetData;
import com.loopj.android.http.JsonHttpResponseHandler;
import com.loopj.android.http.RequestParams;
import com.nostra13.universalimageloader.core.DisplayImageOptions;
import com.nostra13.universalimageloader.core.assist.ImageScaleType;
import com.nostra13.universalimageloader.core.display.RoundedBitmapDisplayer;

/**
 * 订单详情-待付款
 * @author wzz
 *
 */
public class OrderDetailsActivity extends BaseActivity implements OnClickListener{

	TextView tvOrderId,tvOrderTel,tv_orderTime,tv_orderNum,tv_orderPrice,
	txt_order_title,tv_order_content,tv_order_jiage,tv_order_old_jiage;
	ImageView img_blumn_order;
	String orderID;
	int detailsID;
	
	private DisplayImageOptions options = null;
	
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_order_detail);
		orderID=getIntent().getStringExtra("orderID");
		detailsID=getIntent().getIntExtra("detailsID",0);
		initView();
	}
		
	@SuppressWarnings("deprecation")
	private  void initView(){
		options = new DisplayImageOptions.Builder()
		.showImageOnLoading(R.drawable.pic)// 设置图片在下载期间显示的图片
		.showImageForEmptyUri(R.drawable.pic)	// 设置图片Uri为空或是错误的时候显示的图片
		.showImageOnFail(R.drawable.pic)// 设置图片加载/解码过程中错误时候显示的图片
		.displayer(new RoundedBitmapDisplayer(0xff000000, 10))
		.bitmapConfig(Bitmap.Config.RGB_565)
		.imageScaleType(ImageScaleType.IN_SAMPLE_INT)
		.cacheOnDisc(true)
		.build();
		
		((ImageButton)findViewById(R.id.ib_return_go)).setOnClickListener(this);
		tvOrderId=(TextView)findViewById(R.id.tv_orderId);
		tvOrderTel=(TextView)findViewById(R.id.tv_orderTel);
		tv_orderTime=(TextView)findViewById(R.id.tv_orderTime);
		tv_orderNum=(TextView)findViewById(R.id.tv_orderNum);
		tv_orderPrice=(TextView)findViewById(R.id.tv_orderPrice);
				
		txt_order_title=(TextView)findViewById(R.id.txt_order_eva_title);
		tv_order_content=(TextView)findViewById(R.id.tv_order_eva_content);
		tv_order_jiage=(TextView)findViewById(R.id.tv_order_eva_jiage);
		tv_order_old_jiage=(TextView)findViewById(R.id.tv_order_eva_old_jiage);
		img_blumn_order=(ImageView)findViewById(R.id.img_blumn_order_eva);
		
		getOrderDetails();
	}
	
	private  void getOrderDetails(){
//		User myUser =ShareUtil.readUser(mContext);

		RequestParams params = new RequestParams(); // 绑定参数	
//		params.put("username", myUser.getUsername());
//		params.put("token", myUser.getToken());
		params.put("orderID", orderID);
		params.put("detailsID", detailsID);
		params.put("opeType", "getDetails");
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
						JSONObject obj =  JSON.parseObject(GetData.getOrdersDetail(0));
						Boolean result=obj.getBoolean("success");
						if(result){
								String content=obj.getString("content");													
								JSONObject objContent=JSON.parseObject(content);
								String  time=objContent.getString("orderTime");
								String phone=objContent.getString("orderTel");
								int num=objContent.getInteger("num");
								String totalPrice=objContent.getString("totalPrice");
								tvOrderId.setText("订单号："+orderID);
								tvOrderTel.setText("购买手机号："+phone);
								tv_orderTime.setText("下单时间："+time);
								tv_orderNum.setText("数量："+num);
								tv_orderPrice.setText("总价："+totalPrice);
								
								String img=objContent.getString("goodsImg");
								String name=objContent.getString("name");
								String des=objContent.getString("des");
								String discountPrice=objContent.getString("discountPrice");
								String price=objContent.getString("price");
								txt_order_title.setText(name);
								tv_order_content.setText(des);
								tv_order_jiage.setText(discountPrice);
								tv_order_old_jiage.setText(price+"元");
								tv_order_old_jiage.getPaint().setFlags(Paint. STRIKE_THRU_TEXT_FLAG ); //中间横线
								imageLoader.displayImage(img, img_blumn_order, options);
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
		}
	}
	
}

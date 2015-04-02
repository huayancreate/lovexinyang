package com.huayan.life.Activity;

import org.apache.http.Header;

import util.HttpUrl;
import util.HttpUtils;
import util.ShareUtil;
import android.graphics.Bitmap;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageView;
import android.widget.RelativeLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.alibaba.fastjson.JSON;
import com.alibaba.fastjson.JSONException;
import com.alibaba.fastjson.JSONObject;
import com.huayan.life.R;
import com.huayan.life.model.User;
import com.loopj.android.http.JsonHttpResponseHandler;
import com.loopj.android.http.RequestParams;
import com.nostra13.universalimageloader.core.DisplayImageOptions;
import com.nostra13.universalimageloader.core.assist.ImageScaleType;
import com.nostra13.universalimageloader.core.display.RoundedBitmapDisplayer;

/**
 * 我的
 * @author wzz
 * 
 */
public class MyActivity extends BaseActivity implements OnClickListener {

	TextView txt_loginTextView,txt_realName,txt_money;
	RelativeLayout rel_daily_layout, orderRelativeLayout,rl_noLogin,rl_logined;
	ImageView iv_map,img_userPhoto;
	User myUser=null;
	private DisplayImageOptions options = null;
	
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_mine);
		myUser=ShareUtil.readUser(context);
		initView();
		isLogin();
	}

	@SuppressWarnings("deprecation")
	private void initView() {
		options = new DisplayImageOptions.Builder()
		.showImageOnLoading(R.drawable.pic)// 设置图片在下载期间显示的图片
		.showImageForEmptyUri(R.drawable.pic)	// 设置图片Uri为空或是错误的时候显示的图片
		.showImageOnFail(R.drawable.pic)// 设置图片加载/解码过程中错误时候显示的图片
		.displayer(new RoundedBitmapDisplayer(0xff000000, 10))
		.bitmapConfig(Bitmap.Config.RGB_565)
		.imageScaleType(ImageScaleType.IN_SAMPLE_INT)
		.cacheOnDisc(true)
		.build();
		
		txt_loginTextView = (TextView) findViewById(R.id.txt_login);	
		txt_loginTextView.setOnClickListener(this);
		rel_daily_layout = (RelativeLayout) findViewById(R.id.rel_daily_layout);
		rel_daily_layout.setOnClickListener(this);
		orderRelativeLayout = (RelativeLayout) findViewById(R.id.order_rel);
		orderRelativeLayout.setOnClickListener(this);
		((RelativeLayout) findViewById(R.id.daijin_layout)).setOnClickListener(this);
		((RelativeLayout) findViewById(R.id.rl_account)).setOnClickListener(this);
		iv_map = (ImageView) findViewById(R.id.iv_map);
		iv_map.setOnClickListener(this);
		((RelativeLayout) findViewById(R.id.vip_layout)).setOnClickListener(this);
		((RelativeLayout) findViewById(R.id.rl_integral)).setOnClickListener(this);	
		rl_noLogin=(RelativeLayout)findViewById(R.id.rl_noLogin);
		rl_logined=(RelativeLayout)findViewById(R.id.rl_Logined);
		txt_realName=(TextView)findViewById(R.id.txt_nickname);
		txt_money=(TextView)findViewById(R.id.txt_user_money);
		img_userPhoto=(ImageView)findViewById(R.id.img_user_photo);
	}
	
	/**
	 * 判断用户是否已登录7
	 */
	private void isLogin(){
		if(myUser==null){
			rl_noLogin.setVisibility(View.VISIBLE);
			rl_logined.setVisibility(View.GONE);
		}else{
			rl_noLogin.setVisibility(View.GONE);
			rl_logined.setVisibility(View.VISIBLE);
			getUserInfo();
			getUserMoney();
		}
	}
	
	/**
	 * 未登录就去登录，已登录可查看我的各个模块
	 * @return boolean
	 */
	private  Boolean noLogin(){
		if(myUser==null){			
			return false;
		}
		return true;		
	}
	
	
	private void getUserMoney() {			
		RequestParams params = new RequestParams(); // 绑定参数
		params.put("username", myUser.getUsername());
		params.put("token", myUser.getToken());
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
									txt_money.setText("账户余额："+objContent.getDouble("money")+"元");
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
	

	private void getUserInfo() {			
		RequestParams params = new RequestParams(); // 绑定参数
		params.put("username", myUser.getUsername());
		params.put("token", myUser.getToken());
		params.put("opeType", "getInfo");
		params.put("requestType", 1);
		params.put("mobile", 1);
		 
		 HttpUtils.post(HttpUrl.USERACTION, params, new JsonHttpResponseHandler(){

			@Override
			public void onSuccess(int statusCode, Header[] arg1, String responseString) {
				 if(statusCode==200){
						try {
							JSONObject obj =  JSON.parseObject(responseString); 
							Boolean result=obj.getBoolean("success");
							if(result){
								String content=obj.getString("content");											
								User user=JSON.parseObject(content, User.class);
								txt_realName.setText(user.getRealname());
								imageLoader.displayImage(user.getHeadIcon(), img_userPhoto, options);
							}else{
								Toast.makeText(context, getResources().getString(R.string.dialog_title_getDataFail), Toast.LENGTH_SHORT).show();
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
		case R.id.txt_login:
//			 jumpToActivity(MyActivity.this, LoginActivity.class); //未登录
			 jumpToActivity(MyActivity.this, MyAccountActivity.class);
			break;
		case R.id.rel_daily_layout:
			jumpToActivity(MyActivity.this, TheRecommendedDailyActivity.class);// 每日推荐
			break;
		case R.id.order_rel:
			if(!noLogin()){
				jumpToActivity(MyActivity.this, OrderActivity.class);// 订单管理
			}else{
				jumpToActivity(MyActivity.this, LoginActivity.class);
			}
			break;			
		case R.id.daijin_layout:
			if(!noLogin()){
				jumpToActivity(MyActivity.this, CollectionActivity.class);// 我的收藏
			}else{
				jumpToActivity(MyActivity.this, LoginActivity.class);
			}		
			break;
		case R.id.iv_map:
				if(noLogin()){
					jumpToActivity(MyActivity.this, NoticeActivity.class);//我的消息
				}else{
					jumpToActivity(MyActivity.this, LoginActivity.class);
				}
			break;
		case R.id.vip_layout:
			if(!noLogin()){
				jumpToActivity(MyActivity.this, MembershipCardActivity.class);//我的会员卡
			}else{
				jumpToActivity(MyActivity.this, LoginActivity.class);
			}
			break;
		case R.id.rl_integral:
			if(!noLogin()){
				jumpToActivity(MyActivity.this, MyScoreActivity.class); //我的积分
			}else{
				jumpToActivity(MyActivity.this, LoginActivity.class);
			}
			break;
		case R.id.rl_account:
			 jumpToActivity(MyActivity.this, MyAccountActivity.class); //已登录
			break;
		}
	}

}

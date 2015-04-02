package com.huayan.life.Activity;

import java.util.HashMap;

import org.apache.http.Header;

import util.HttpUrl;
import util.HttpUtils;
import util.ShareUtil;
import android.os.Bundle;
import android.os.Handler;
import android.os.Handler.Callback;
import android.os.Message;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.Toast;
import cn.sharesdk.framework.AbstractWeibo;
import cn.sharesdk.framework.WeiboActionListener;
import cn.sharesdk.sina.weibo.SinaWeibo;
import cn.sharesdk.tencent.qzone.QZone;

import com.alibaba.fastjson.JSON;
import com.alibaba.fastjson.JSONException;
import com.alibaba.fastjson.JSONObject;
import com.huayan.life.R;
import com.huayan.life.model.User;
import com.loopj.android.http.JsonHttpResponseHandler;
import com.loopj.android.http.RequestParams;

public class LoginActivity extends BaseActivity implements Callback,OnClickListener, WeiboActionListener {

	EditText et_username, et_userpwd;
	Button btn_login, btnRegView, txtQuickRegView;
	// 创建handler对象
	private Handler handler;
	// 创建接口Runnable
	private Runnable updateThread;

	LinearLayout ll_AreaLayout, ll_LoginLayout;
	boolean tag = true;
	ImageView img_qq, img_sina;

	// 定义Handler对象
	private Handler mHandler;

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.login);
		et_username = (EditText) findViewById(R.id.et_username);
		et_userpwd = (EditText) findViewById(R.id.et_userpwd);
		btn_login = (Button) findViewById(R.id.btn_login);
		btnRegView = (Button) findViewById(R.id.btn_reg);
		btnRegView.setOnClickListener(this);
		txtQuickRegView = (Button) findViewById(R.id.txt_quick_login_page);
		txtQuickRegView.setOnClickListener(this);
		((ImageButton) findViewById(R.id.ib_return)).setOnClickListener(this);
		btn_login.setOnClickListener(this);

		ll_AreaLayout = (LinearLayout) findViewById(R.id.ll_bottom_lg);
		ll_LoginLayout = (LinearLayout) findViewById(R.id.ll_login);
		img_sina = (ImageView) findViewById(R.id.img_sina);
		img_qq = (ImageView) findViewById(R.id.img_qq);
		ll_AreaLayout.setOnClickListener(this);
		img_sina.setOnClickListener(this);
		img_qq.setOnClickListener(this);

		// 初始化ShareSDK
		AbstractWeibo.initSDK(this);
		// 实例化Handler对象并设置信息回调监听接口
		mHandler = new Handler(this);

		// 获取平台列表
		AbstractWeibo[] weibos = AbstractWeibo.getWeiboList(this);

		for (int i = 0; i < weibos.length; i++) {
			if (!weibos[i].isValid()) {
				continue;
			}
			// 得到授权用户的用户名称
			String userName = weibos[i].getDb().get("nickname");
			if (userName == null || userName.length() <= 0
					|| "null".equals(userName)) {
				// 如果平台已经授权却没有拿到帐号名称，则自动获取用户资料，以获取名称
				userName = getWeiboName(weibos[i]);
				// 添加平台事件监听
				weibos[i].setWeiboActionListener(this);
				// 显示用户资料，null表示显示自己的资料
				weibos[i].showUser(null);
			}
		}

	}

	/**
	 * 得到授权用户的用户名称
	 */
	private String getWeiboName(AbstractWeibo weibo) {
		if (weibo == null) {
			return null;
		}

		String name = weibo.getName();
		if (name == null) {
			return null;
		}
		int res = 0;
		if (SinaWeibo.NAME.equals(name)) {
			res = R.string.sinaweibo;
		} else if (QZone.NAME.equals(name)) {
			res = R.string.qzone;
		}
		if (res == 0) {
			return name;
		}
		return this.getResources().getString(res);
	}

	/**
	 * 获得授权
	 */
	private AbstractWeibo getWeibo(int vid) {
		String name = null;
		switch (vid) {
		// 进入新浪微博的授权页面
		case R.id.img_sina:
			name = SinaWeibo.NAME;
			break;
		// 进入QQ的授权页面
		case R.id.img_qq:
			name = QZone.NAME;
			break;
		}

		if (name != null) {
			return AbstractWeibo.getWeibo(this, name);
		}
		return null;
	}


	/**
	 * 验证登录帐号
	 */
	private void loginPro() {		
		final String username = et_username.getText().toString().trim();
		String password = et_userpwd.getText().toString().trim();

		RequestParams params = new RequestParams(); // 绑定参数
		params.put("username", username);
		params.put("password", password);
		params.put("opeType", "login");
		params.put("requestType", 1);
		params.put("mobile", 1);	
		 
		 HttpUtils.post(HttpUrl.USERACTION, params, new JsonHttpResponseHandler(){

			@Override
			public void onSuccess(int statusCode, Header[] arg1, String responseString) {
				 if(statusCode==200){
						try {
							JSONObject obj =  JSON.parseObject(responseString); 
							String content=obj.getString("content");			
							JSONObject objContent=JSON.parseObject(content);
							Boolean result=objContent.getBoolean("result");
							String message=objContent.getString("message");//(true:message传递token值, false:message传递错误信息)

							if(result){
								User myUser=new User();
								myUser.setID(objContent.getInteger("ID"));
								myUser.setUsername(username);
								myUser.setToken(message);
								ShareUtil.saveUser(myUser, context);							
								jumpToActivity(LoginActivity.this, MyActivity.class);		//登录成功，跳转到我的模块						
							}else{
								Toast.makeText(LoginActivity.this, message, Toast.LENGTH_SHORT).show();
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

	/**
	 * 输入为空
	 */
	private boolean validate() {
		String username = et_username.getText().toString().trim();
		String password = et_userpwd.getText().toString().trim();
		if ("".equals(username)) {
			showDialog("请输入用户名!");
			return false;
		}
		if ("".equals(password)) {
			showDialog("请输入用户密码!");
			return false;
		}
		return true;
	}


	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.btn_reg:
			jumpToActivity(LoginActivity.this, RegisterActivity.class);
			break;
		case R.id.txt_quick_login_page:
			jumpToActivity(LoginActivity.this, QuickLoginActivity.class);
			break;
		case R.id.ib_return:
			finish();
			break;
		case R.id.btn_login:
			handler = new Handler();
			// 创建接口Runnable 线程
			updateThread = new Runnable() {
				public void run() {
					if (!validate()) {
						return;
					}else{
						loginPro();
					}
				}
			};
			handler.post(updateThread);
			break;
		case R.id.ll_bottom_lg:
			if (tag) {
				ll_LoginLayout.setVisibility(View.VISIBLE);
				tag = false;
			} else {
				ll_LoginLayout.setVisibility(View.GONE);
				tag = true;
			}
			break;
		case R.id.img_qq:
			AbstractWeibo weibo = getWeibo(v.getId());
			if (weibo == null) {
				return;
			}
			if (weibo.isValid()) {
				weibo.removeAccount();
				return;
			}
			weibo.setWeiboActionListener(this);
			weibo.showUser(null);
			break;
		case R.id.img_sina:
			AbstractWeibo weibo1 = getWeibo(v.getId());
			if (weibo1 == null) {
				return;
			}

			if (weibo1.isValid()) {
				weibo1.removeAccount();
				return;
			}
			weibo1.setWeiboActionListener(this);
			weibo1.showUser(null);
			break;

		}
	}

	@Override
	public boolean handleMessage(Message msg) {
		AbstractWeibo weibo = (AbstractWeibo) msg.obj;
		String text = actionToString(msg.arg2);

		switch (msg.arg1) {
		case 1: { // 成功
			text = weibo.getName() + " completed at " + text;
			Toast.makeText(this, text, Toast.LENGTH_SHORT).show();
		}
			break;
		case 2: { // 失败
			text = weibo.getName() + " caught error at " + text;
			Toast.makeText(this, text, Toast.LENGTH_SHORT).show();
			return false;
		}
		case 3: { // 取消
			text = weibo.getName() + " canceled at " + text;
			Toast.makeText(this, text, Toast.LENGTH_SHORT).show();
			return false;
		}
		}
		String userName = weibo.getDb().get("nickname"); // getAuthedUserName();
		if (userName == null || userName.length() <= 0
				|| "null".equals(userName)) {
			userName = getWeiboName(weibo);
		}
		return false;
	}

	public static String actionToString(int action) {
		switch (action) {
		case AbstractWeibo.ACTION_AUTHORIZING:
			return "ACTION_AUTHORIZING";
		case AbstractWeibo.ACTION_GETTING_FRIEND_LIST:
			return "ACTION_GETTING_FRIEND_LIST";
		case AbstractWeibo.ACTION_FOLLOWING_USER:
			return "ACTION_FOLLOWING_USER";
		case AbstractWeibo.ACTION_SENDING_DIRECT_MESSAGE:
			return "ACTION_SENDING_DIRECT_MESSAGE";
		case AbstractWeibo.ACTION_TIMELINE:
			return "ACTION_TIMELINE";
		case AbstractWeibo.ACTION_USER_INFOR:
			return "ACTION_USER_INFOR";
		case AbstractWeibo.ACTION_SHARE:
			return "ACTION_SHARE";
		default: {
			return "UNKNOWN";
		}
		}
	}

	/**
	 * 取消授权的回调
	 */
	@Override
	public void onCancel(AbstractWeibo weibo, int action) {
		Message msg = new Message();
		msg.arg1 = 3;
		msg.arg2 = action;
		msg.obj = weibo;
		mHandler.sendMessage(msg);
	}

	/**
	 * 授权成功的回调 weibo - 回调的平台 action - 操作的类型 res - 请求的数据通过res返回
	 */
	@Override
	public void onComplete(AbstractWeibo weibo, int action,
			HashMap<String, Object> res) {
		Message msg = new Message();
		msg.arg1 = 1;
		msg.arg2 = action;
		msg.obj = weibo;
		mHandler.sendMessage(msg);
	}

	/**
	 * 授权失败的回调
	 */
	@Override
	public void onError(AbstractWeibo weibo, int action, Throwable t) {
		t.printStackTrace();

		Message msg = new Message();
		msg.arg1 = 2;
		msg.arg2 = action;
		msg.obj = weibo;
		mHandler.sendMessage(msg);
	}

	protected void onDestroy() {
		// 结束ShareSDK的统计功能并释放资源
		AbstractWeibo.stopSDK(this);
		super.onDestroy();
	}

}
package com.huayan.life.Activity;

import org.apache.http.Header;

import util.HttpUrl;
import util.HttpUtils;
import util.ShareUtil;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.TextView;
import android.widget.Toast;

import com.alibaba.fastjson.JSON;
import com.alibaba.fastjson.JSONException;
import com.alibaba.fastjson.JSONObject;
import com.huayan.life.R;
import com.huayan.life.model.User;
import com.loopj.android.http.JsonHttpResponseHandler;
import com.loopj.android.http.RequestParams;

/**
 * 修改支付密码
 * @author wzz
 *
 */
public class ModifyPayPwdActivity extends BaseActivity implements OnClickListener {

	EditText etOldPayPwd;
	
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_modify_pay_pwd);
		((ImageButton)findViewById(R.id.img_goback1)).setOnClickListener(this);
		etOldPayPwd=(EditText)findViewById(R.id.old_pay_pwd);
		((TextView)findViewById(R.id.txt_ok_pwd)).setOnClickListener(this);
	}

	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.img_goback1:
			finish();
			break;
		case R.id.txt_ok_pwd:
			if(validate()){
				updatePayPwd();
			}
			break;
		}
	}
	
	private void updatePayPwd() {		
		String oldPwd = etOldPayPwd.getText().toString().trim();
		User myUser=ShareUtil.readUser(context);

		RequestParams params = new RequestParams(); // 绑定参数
		params.put("username", myUser.getUsername());
		params.put("token", myUser.getToken());
		params.put("oldPassword", oldPwd);
		params.put("opeType", "updatePayPassword");
		params.put("requestType", 1);
		params.put("mobile", 1);
		 
		 HttpUtils.post(HttpUrl.PASSWORDACTION, params, new JsonHttpResponseHandler(){

			@Override
			public void onSuccess(int statusCode, Header[] arg1, String responseString) {
				 if(statusCode==200){
						try {
							JSONObject obj =  JSON.parseObject(responseString); 
							String content=obj.getString("content");			
							JSONObject objContent=JSON.parseObject(content);
							Boolean result=objContent.getBoolean("result");
							String message=objContent.getString("message");//(true:message成功信息， false:message传递错误信息)
							if(result){
								jumpToActivity(ModifyPayPwdActivity.this, SetPayPwdActivity.class);		
								finish();
							}
								Toast.makeText(ModifyPayPwdActivity.this, message, Toast.LENGTH_SHORT).show();
							
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
	
	private boolean validate() {
		String oldPayPwd = etOldPayPwd.getText().toString().trim();
		if ("".equals(oldPayPwd)) {
			showDialog("原支付密码不能为空!");
			return false;
		}
		return true;
	}
}

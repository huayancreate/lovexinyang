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
public class SetPayPwdActivity extends BaseActivity implements OnClickListener {

	EditText etSetPayPwd,etConfirmPwd;
	
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_modify_pay_pwd);
		((ImageButton)findViewById(R.id.img_goback2)).setOnClickListener(this);
		etSetPayPwd=(EditText)findViewById(R.id.new_pay_pwd);
		etConfirmPwd=(EditText)findViewById(R.id.conform_pay_pwd);
		((TextView)findViewById(R.id.txt_set_pay_pwd)).setOnClickListener(this);
	}

	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.img_goback2:
			finish();
			break;
		case R.id.txt_set_pay_pwd:
			if(validate()){
				setPayPwd();
			}
			break;
		}
	}
	
	private void setPayPwd() {		
		String payPwd = etSetPayPwd.getText().toString().trim();
		String confirmPwd=etConfirmPwd.getText().toString().trim();
		User myUser=ShareUtil.readUser(context);

		RequestParams params = new RequestParams(); // 绑定参数
		params.put("username", myUser.getUsername());
		params.put("token", myUser.getToken());
		params.put("newPassword", payPwd);
		params.put("comfirmPassword", confirmPwd);
		params.put("opeType", "setPayPassword");
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
								jumpToActivity(SetPayPwdActivity.this, PayPwdActivity.class);		
								finish();
							}
								Toast.makeText(SetPayPwdActivity.this, message, Toast.LENGTH_SHORT).show();
							
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
		String newPayPwd = etSetPayPwd.getText().toString().trim();
		String confirmPwd=etConfirmPwd.getText().toString().trim();
		if ("".equals(newPayPwd)) {
			showDialog("支付密码不能为空!");
			return false;
		}else if ("".equals(confirmPwd)) {
			showDialog("确认密码不能为空!");
			return false;
		}else if(!newPayPwd.equals(confirmPwd)){
			showDialog("确认密码与新支付密码不一致!");
			return false;
		}
		return true;
	}
}

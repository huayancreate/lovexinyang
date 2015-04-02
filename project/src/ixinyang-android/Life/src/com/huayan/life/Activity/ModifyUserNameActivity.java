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
 * 修改用户名
 * @author wzz
 *
 */
public class ModifyUserNameActivity extends BaseActivity implements OnClickListener {

	EditText et_userName;
	
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_modify_username);
		et_userName=(EditText)findViewById(R.id.modify_username);
		((TextView)findViewById(R.id.txt_confirm_modify)).setOnClickListener(this);
		((ImageButton)findViewById(R.id.imgb_back_user)).setOnClickListener(this);
	}

	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.txt_confirm_modify:
			if(validate()){
				updateRealName();
			}
			break;
		case R.id.imgb_back_user:
			finish();
			break;
		}
	}
	
	private void updateRealName() {		
		String nickName = et_userName.getText().toString().trim();
		User myUser=ShareUtil.readUser(context);

		RequestParams params = new RequestParams(); // 绑定参数
		params.put("username", myUser.getUsername());
		params.put("token", myUser.getToken());
		params.put("realname", nickName);
		params.put("opeType", "updateInfo");
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
							String message=objContent.getString("message");//(true:message成功信息， false:message传递错误信息)
							if(result){
								jumpToActivity(ModifyUserNameActivity.this, MyAccountActivity.class);		
								finish();
							}
								Toast.makeText(ModifyUserNameActivity.this, message, Toast.LENGTH_SHORT).show();
							
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
		String nickName = et_userName.getText().toString().trim();
		if ("".equals(nickName)) {
			showDialog("用户名不能为空!");
			return false;
		}
		return true;
	}
}

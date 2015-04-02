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
 * �޸�����
 * @author wzz
 *
 */
public class ModifyPwdActivity extends BaseActivity implements OnClickListener {

	EditText modify_currentPwd, modify_newPwd,again_newPwd;
	TextView txt_confirm_pwd;
	
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_modify_pwd);
		initView();
	}
	
	private void initView(){
		modify_currentPwd=(EditText)findViewById(R.id.modify_current_pwd);
		modify_newPwd=(EditText)findViewById(R.id.modify_new_pwd);
		again_newPwd=(EditText)findViewById(R.id.queren_new_pwd);
		((ImageButton)findViewById(R.id.imb_back)).setOnClickListener(this);
		txt_confirm_pwd=(TextView)findViewById(R.id.txt_confirm_pwd);
		txt_confirm_pwd.setOnClickListener(this);
	}
	

	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.imb_back:
			finish();
			break;
		case R.id.txt_confirm_pwd:
			if(validate()){
				updateLoginPassword();
			}
			break;
		}		
	}
	
	private boolean validate() {
		String pwd = modify_currentPwd.getText().toString().trim();
		String newPwd = modify_newPwd.getText().toString().trim();
		String  confrimPwd=again_newPwd.getText().toString().trim();
		if ("".equals(pwd)) {
			showDialog("��ǰ���벻��Ϊ�գ������뵱ǰ����!");
			return false;
		}else if ("".equals(newPwd)) {
			showDialog("�����벻��Ϊ�գ�������������!");
			return false;
		}else if ("".equals(confrimPwd)) {
			showDialog("ȷ�����벻��Ϊ�գ�������ȷ������!");
			return false;
		}else if(!newPwd.equals(confrimPwd)){
			showDialog("ȷ�������������벻һ��!");
			return false;
		}
		return true;
	}
	
	
	private void updateLoginPassword() {		
		String oldPwd = modify_currentPwd.getText().toString().trim();
		String newPwd = modify_newPwd.getText().toString().trim();
		String confirmPwd=again_newPwd.getText().toString().trim();
		User myUser=ShareUtil.readUser(context);
		
		RequestParams params = new RequestParams(); // �󶨲���	
		params.put("username", myUser.getUsername());
		params.put("token", myUser.getToken());
		params.put("newPassword", newPwd);
		params.put("oldPassword", oldPwd);
		params.put("comfirmPassword", confirmPwd);
		params.put("opeType", "loginPassword");
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
							String message=objContent.getString("message");//(true:message�ɹ���Ϣ�� false:message���ݴ�����Ϣ)
							if(result){
								jumpToActivity(ModifyPwdActivity.this, MyAccountActivity.class);		
								finish();
							}
								Toast.makeText(ModifyPwdActivity.this, message, Toast.LENGTH_SHORT).show();
							
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
	
}

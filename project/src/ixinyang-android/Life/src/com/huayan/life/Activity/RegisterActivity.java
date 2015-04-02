package com.huayan.life.Activity;

import org.apache.http.Header;

import util.HttpUrl;
import util.HttpUtils;
import android.graphics.Paint;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.CheckBox;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.alibaba.fastjson.JSON;
import com.alibaba.fastjson.JSONException;
import com.alibaba.fastjson.JSONObject;
import com.huayan.life.R;
import com.loopj.android.http.JsonHttpResponseHandler;
import com.loopj.android.http.RequestParams;

/**
 *免费注册
 * @author wzz
 *
 */
public class RegisterActivity extends BaseActivity implements OnClickListener {

	EditText editPhone;
	TextView txtCode,txtUserAgreement;
	CheckBox cbAgreement;

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_register);
		initView();
	}

	private void initView() {
		editPhone = (EditText) findViewById(R.id.edit_phone);
		txtCode = (TextView) findViewById(R.id.check_code);
		txtCode.setOnClickListener(this);
		cbAgreement=(CheckBox)findViewById(R.id.ck_xieyi);
		((TextView)findViewById(R.id.header_name)).setText(R.string.register);		
		((ImageView)findViewById(R.id.go_back)).setOnClickListener(this);		
		txtUserAgreement=(TextView)findViewById(R.id.tv_quick_reg2);
		txtUserAgreement.getPaint().setFlags(Paint.UNDERLINE_TEXT_FLAG);//下划线
		txtUserAgreement.setOnClickListener(this);
	}

	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.check_code:
			if(validate()&&cbAgreement.isChecked()){
				loginValidate();
			}
			break;			
		case R.id.go_back:
			finish();
			break;
		case R.id.tv_quick_reg2:
			jumpToActivity(RegisterActivity.this, UserAgreementActivity.class); //用户协议
			break;
		}
	}
	
	/**
	 * 发送手机号码并跳转
	 */
	private void loginValidate() {		
		String phone = editPhone.getText().toString().trim();
		RequestParams params = new RequestParams(); // 绑定参数
		params.put("phoneNumber", phone);
		params.put("opeType", "signin");
		params.put("requestType", 1);
		params.put("mobile", 1);
		 
		 HttpUtils.post(HttpUrl.USERACTION, params, new JsonHttpResponseHandler(){

			@Override
			public void onSuccess(int statusCode, Header[] arg1, String responseString) {
				 if(statusCode==200){
						try {
							JSONObject obj =  JSON.parseObject(responseString);
							Boolean result=obj.getBoolean("result");
							if(result){
								jumpToActivity(RegisterActivity.this, RegStepTwoActivity.class);		
								finish();
							}else{
								Toast.makeText(RegisterActivity.this, "发送失败", Toast.LENGTH_SHORT).show();
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
	
	
	private boolean validate(){
		String phone=editPhone.getText().toString().trim();
		if(!phone.equals("")){
			return true;
		}
		return false;
	}
	
}

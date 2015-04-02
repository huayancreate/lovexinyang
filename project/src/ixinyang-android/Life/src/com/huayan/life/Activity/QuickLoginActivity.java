package com.huayan.life.Activity;

import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;

import com.huayan.life.R;

/**
 * 免费注册——快捷登录
 * 
 * @author wzz
 * 
 */
public class QuickLoginActivity extends BaseActivity implements OnClickListener {

	EditText editPhone, editCode;
	TextView txtCode, txtLogin;

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_quick_login);
		initView();
	}

	private void initView() {
		editPhone = (EditText) findViewById(R.id.et_phone);
		editCode = (EditText) findViewById(R.id.et_phone_code);

		txtCode = (TextView) findViewById(R.id.tv_checkcode);
		txtCode.setOnClickListener(this);
		txtLogin = (TextView) findViewById(R.id.tv_login);
		txtLogin.setOnClickListener(this);

		((TextView) findViewById(R.id.header_name)).setText(R.string.quick_login);
		((ImageView) findViewById(R.id.go_back)).setOnClickListener(this);

	}

	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.tv_login:
			if(validate(editCode,"请输入正确的验证码！")){
				//验证验证码正确，完善个人信息
				jumpToActivity(QuickLoginActivity.this, MyActivity.class);
			}
			finish();
			break;
		case R.id.go_back:
			finish();
			break;
		case R.id.tv_checkcode:
			if(validate(editPhone,"请输入正确的手机号！")){
				//获取验证码
			}
			break;
		}
	}

	
	private boolean validate(EditText v,String msg){
		String phone=v.getText().toString().trim();
		if(!phone.equals("")){
			return true;
		}
		showDialog(msg);
		return false;
	}
	
}

package com.huayan.life.Activity;

import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;

/**
 *免费注册第三步
 * @author wzz
 *
 */
public class RegStepThreeActivity extends BaseActivity implements OnClickListener {

	EditText etPwd;
	TextView txtPwd;

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_register3);
		initView();
	}

	private void initView() {
		etPwd = (EditText) findViewById(R.id.et_pwd);
		txtPwd = (TextView) findViewById(R.id.submit_pwd);
		txtPwd.setOnClickListener(this);
		((TextView)findViewById(R.id.header_name)).setText(R.string.register);		
		((ImageView)findViewById(R.id.go_back)).setOnClickListener(this);		
	}

	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.submit_pwd:
			if(validate()){
				//发送验证码并跳转		
				jumpToActivity(RegStepThreeActivity.this, LoginActivity.class);
				finish();
			}
			break;
			
		case R.id.go_back:
			finish();
			break;
	
		}
	}
	
	private boolean validate(){
		String pwd=etPwd.getText().toString().trim();
		if(!pwd.equals("")){
			return true;
		}
		return false;
	}
	
}

package com.huayan.life.Activity;

import android.graphics.Paint;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.CheckBox;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;

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
				//发送验证码并跳转
				jumpToActivity(RegisterActivity.this, RegStepTwoActivity.class);
				finish();
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
	
	private boolean validate(){
		String phone=editPhone.getText().toString().trim();
		if(!phone.equals("")){
			return true;
		}
		return false;
	}
	
}

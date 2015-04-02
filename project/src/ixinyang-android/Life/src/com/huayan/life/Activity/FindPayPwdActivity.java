package com.huayan.life.Activity;

import util.ShareUtil;
import util.StringUtility;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.TextView;

import com.huayan.life.R;
import com.huayan.life.model.User;

/**
 * 找回支付密码——安全验证，验证通过去设置支付密码，确认支付密码（SetPayPwdActivity）
 * 
 * @author wzz
 *
 */
public class FindPayPwdActivity extends BaseActivity implements OnClickListener {

	EditText etPhone,etCode;
	
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_save_verification);
		initView();
	}
	
	
	private void initView(){
		etPhone=(EditText)findViewById(R.id.ed_ph);
		etCode=(EditText)findViewById(R.id.ed_code);
		((TextView)findViewById(R.id.tv_checkcode)).setOnClickListener(this);
		((TextView)findViewById(R.id.txt_save_verification)).setOnClickListener(this);
		((ImageButton)findViewById(R.id.i_fanback)).setOnClickListener(this);		
		User user=ShareUtil.readUser(context);
		if(user!=null){
			String phone=StringUtility.changePhone(user.getUsername());
			etPhone.setText(phone);
		}
	}

	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.i_fanback:
			finish();
			break;
		case R.id.tv_checkcode:
			//TODO 获取验证码
			break;
		case R.id.txt_save_verification:
			if(validate()){
				//验证成功跳转到SetPayPwdActivity
			}
			break;
		}
	}
	
	private boolean validate() {
		String code = etCode.getText().toString().trim();
		if ("".equals(code)) {
			showDialog("验证码不能为空!");
			return false;
		}
		return true;
	}
	
}

package com.huayan.life.Activity;

import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;

import com.huayan.life.R;

/**
 *免费注册第二步
 * @author wzz
 *
 */
public class RegStepTwoActivity extends BaseActivity implements OnClickListener {

	EditText etCode;
	TextView txtCode;

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_register2);
		initView();
	}

	private void initView() {
		etCode = (EditText) findViewById(R.id.et_code);
		txtCode = (TextView) findViewById(R.id.submit_code);
		txtCode.setOnClickListener(this);
		((TextView)findViewById(R.id.header_name)).setText(R.string.register);		
		((ImageView)findViewById(R.id.go_back)).setOnClickListener(this);		
	}

	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.submit_code:
			if(validate()){
				//发送验证码并跳转	
				jumpToActivity(RegStepTwoActivity.this, RegStepThreeActivity.class);
				finish();
			}
			break;
			
		case R.id.go_back:
			finish();
			break;	
		}
	}
	
	private boolean validate(){
		String code=etCode.getText().toString().trim();
		if(!code.equals("")){
			return true;
		}
		return false;
	}
	
}

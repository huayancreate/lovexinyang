package com.huayan.life.Activity;

import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.EditText;
import android.widget.TextView;

/**
 * ע��
 * @author wzz
 *
 */
public class RegisterActivity extends BaseActivity implements OnClickListener {

	EditText editPhone;
	TextView txtCode;

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_register);
		initView();
	}

	private void initView() {
		editPhone = (EditText) findViewById(R.id.edit_phone);
		txtCode = (TextView) findViewById(R.id.check_code);
		((TextView)findViewById(R.id.header_name)).setText(R.string.register);		
	}

	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.check_code:
			if(validate()){
				//������֤�벢��ת
				
			}
			break;
		}
	}
	
	private boolean validate(){
		String phone=editPhone.getText().toString().trim();
		if(!phone.equals("")){
			txtCode.setEnabled(true);
			return true;
		}
		return false;
	}
	
}

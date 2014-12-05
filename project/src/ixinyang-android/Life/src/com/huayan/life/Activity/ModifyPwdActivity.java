package com.huayan.life.Activity;

import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.EditText;
import android.widget.ImageButton;

/**
 * ÐÞ¸ÄÃÜÂë
 * @author wzz
 *
 */
public class ModifyPwdActivity extends BaseActivity implements OnClickListener {

	EditText modify_currentPwd, modify_newPwd,again_newPwd;
	
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_modify_pwd);
		modify_currentPwd=(EditText)findViewById(R.id.modify_current_pwd);
		modify_newPwd=(EditText)findViewById(R.id.modify_new_pwd);
		again_newPwd=(EditText)findViewById(R.id.queren_new_pwd);
		((ImageButton)findViewById(R.id.imb_back)).setOnClickListener(this);
	}
	

	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.imb_back:
			finish();
			break;

		default:
			break;
		}
		
	}
}

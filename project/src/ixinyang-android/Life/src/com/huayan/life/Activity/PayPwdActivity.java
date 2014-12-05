package com.huayan.life.Activity;

import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageButton;
import android.widget.RelativeLayout;

/**
 * ÷ß∏∂√‹¬Î
 * @author wzz
 *
 */
public class PayPwdActivity extends BaseActivity implements OnClickListener {

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_pay_pwd);
		((ImageButton)findViewById(R.id.img_goback)).setOnClickListener(this);
		((RelativeLayout)findViewById(R.id.rl_modify_pay_pwd)).setOnClickListener(this);
		((RelativeLayout)findViewById(R.id.rel_find_pwd)).setOnClickListener(this);
	}

	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.img_goback:
			finish();
			break;
		case R.id.rl_modify_pay_pwd:
			jumpToActivity(PayPwdActivity.this, ModifyPayPwdActivity.class);
			break;
	case R.id.rel_find_pwd:
			jumpToActivity(PayPwdActivity.this, SaveVerificationActivity.class);
			break;
		default:
			break;
		}
	}
}

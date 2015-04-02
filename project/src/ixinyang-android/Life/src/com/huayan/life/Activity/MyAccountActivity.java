package com.huayan.life.Activity;

import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageButton;
import android.widget.RelativeLayout;
import android.widget.TextView;

import com.huayan.life.R;

/**
 * 我的账户
 * @author wzz
 *
 */
public class MyAccountActivity extends BaseActivity implements OnClickListener {

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_account);
		((ImageButton) findViewById(R.id.imgba_back)).setOnClickListener(this);
		((TextView) findViewById(R.id.txt_exit)).setOnClickListener(this);
		((RelativeLayout) findViewById(R.id.rl_modify_username)).setOnClickListener(this);
		((RelativeLayout) findViewById(R.id.rl_modify_pwd)).setOnClickListener(this);
		((RelativeLayout)findViewById(R.id.rl_save_ver)).setOnClickListener(this);
		((RelativeLayout)findViewById(R.id.rel_pay_pwd)).setOnClickListener(this);
	}

	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.imgba_back:
			finish();
			break;
		case R.id.txt_exit:
			BaseActivity.exit();
		case R.id.rl_modify_username:
			jumpToActivity(MyAccountActivity.this, ModifyUserNameActivity.class);//修改用户名
			break;
		case R.id.rl_modify_pwd:
			jumpToActivity(MyAccountActivity.this, ModifyPwdActivity.class);//修改密码
			break;
		case R.id.rl_save_ver:
			jumpToActivity(MyAccountActivity.this, SaveVerificationActivity.class);//修改绑定的手机号码
			break;
		case R.id.rel_pay_pwd:
			jumpToActivity(MyAccountActivity.this, PayPwdActivity.class);//修改支付密码
			break;
		default:
			break;
		}
	}
}

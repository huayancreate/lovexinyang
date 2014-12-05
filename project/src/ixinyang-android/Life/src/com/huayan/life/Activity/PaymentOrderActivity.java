package com.huayan.life.Activity;

import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageButton;
import android.widget.RelativeLayout;

/**
 * Ö§¸¶¶©µ¥
 * @author wzz
 *
 */
public class PaymentOrderActivity extends BaseActivity implements OnClickListener {

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_payment_order);
		((ImageButton) findViewById(R.id.imgbud_fanhui)).setOnClickListener(this);
		((RelativeLayout)findViewById(R.id.rl_daijinquan)).setOnClickListener(this);
	}

	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.imgbud_fanhui:
			finish();
			break;
		case R.id.rl_daijinquan:
//			jumpToActivity(PaymentOrderActivity.this, UserVoucherActivity.class);
			break;
		default:
			break;
		}
	}
}

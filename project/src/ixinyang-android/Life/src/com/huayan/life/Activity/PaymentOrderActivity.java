package com.huayan.life.Activity;

import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageButton;

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

	}

	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.imgbud_fanhui:
			finish();
			break;
		
		default:
			break;
		}
	}
}

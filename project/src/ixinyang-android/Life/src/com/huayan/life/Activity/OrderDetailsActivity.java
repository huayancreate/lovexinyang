package com.huayan.life.Activity;

import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageButton;
import android.widget.TextView;

/**
 * ∂©µ•œÍ«È
 * @author wzz
 *
 */
public class OrderDetailsActivity extends BaseActivity implements OnClickListener{

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_order_detail);
		((ImageButton)findViewById(R.id.ib_return_go)).setOnClickListener(this);
		((TextView)findViewById(R.id.txt_pay)).setOnClickListener(this);
	}

	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.ib_return_go:
			finish();
			break;
		case R.id.txt_pay:
			jumpToActivity(OrderDetailsActivity.this, SubmitOrderActivity.class);
			break;
		default:
			break;
		}
	}
}

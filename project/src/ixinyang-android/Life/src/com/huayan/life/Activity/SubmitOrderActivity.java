package com.huayan.life.Activity;

import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.LinearLayout;
import android.widget.TextView;

/**
 * Ã·Ωª∂©µ•
 * @author wzz
 *
 */
public class SubmitOrderActivity extends BaseActivity implements OnClickListener {

	EditText et_number;
	
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_submit_orders);
		((ImageButton) findViewById(R.id.imgbu_fanhui)).setOnClickListener(this);
		((TextView) findViewById(R.id.txt_submit_order)).setOnClickListener(this);
		((LinearLayout)findViewById(R.id.ll_bangphone)).setOnClickListener(this);
		((TextView)findViewById(R.id.tv_add_number)).setOnClickListener(this);
		((TextView)findViewById(R.id.tv_minus_number)).setOnClickListener(this);
		et_number=(EditText)findViewById(R.id.et_number);
	}

	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.imgbu_fanhui:
			finish();
			break;

		case R.id.txt_submit_order:
			jumpToActivity(SubmitOrderActivity.this, PaymentOrderActivity.class);
			break;   
			
		case R.id.ll_bangphone:
			jumpToActivity(SubmitOrderActivity.this, SaveVerificationActivity.class);
			break;
			
		default:
			break;
		}
	}
}

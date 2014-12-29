package com.huayan.life.Activity;

import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageButton;
import android.widget.TextView;

/**
 * ÉêÇëÍË¿î
 * @author wzz
 *
 */
public class ApplyRefundActivity extends BaseActivity implements OnClickListener{

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_apply_refund);
		((ImageButton)findViewById(R.id.ib_return_go_refund)).setOnClickListener(this);
		((TextView)findViewById(R.id.txt_apply_refund)).setOnClickListener(this);
	}

	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.ib_return_go_refund:
			finish();
			break;
		case R.id.txt_apply_refund:
			jumpToActivity(ApplyRefundActivity.this, ApplyRefundActivity.class);//ÉêÇëÍË¿î
			break;
		default:
			break;
		}
	}

}

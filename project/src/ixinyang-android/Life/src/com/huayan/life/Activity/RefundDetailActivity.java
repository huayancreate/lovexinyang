package com.huayan.life.Activity;

import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageButton;
import android.widget.TextView;

/**
 * ÍË¿îÏêÇé
 * @author wzz
 *
 */
public class RefundDetailActivity extends BaseActivity implements OnClickListener{

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_refund_detail);
		((ImageButton)findViewById(R.id.ib_return_go)).setOnClickListener(this);
		((TextView)findViewById(R.id.tv_refund_help)).setOnClickListener(this);
	}

	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.ib_return_go:
			finish();
			break;
		case R.id.tv_refund_help:
			jumpToActivity(RefundDetailActivity.this, PaidHelpActivity.class);//ÍË¿î°ïÖú
			break;
		default:
			break;
		}
	}
}

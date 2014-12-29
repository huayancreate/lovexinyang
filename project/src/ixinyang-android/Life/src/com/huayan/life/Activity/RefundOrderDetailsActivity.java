package com.huayan.life.Activity;

import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageButton;
import android.widget.TextView;

/**
 * �������飨���˿�/�˿��У�
 * @author wzz
 *
 */
public class RefundOrderDetailsActivity extends BaseActivity implements OnClickListener{

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_refund_order_detail);
		((ImageButton)findViewById(R.id.ib_return_go_eva)).setOnClickListener(this);
		((TextView)findViewById(R.id.tv_refund_details)).setOnClickListener(this);
	}

	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.ib_return_go_eva:
			finish();
			break;
		case R.id.tv_refund_details:
			jumpToActivity(RefundOrderDetailsActivity.this, RefundDetailActivity.class);//�˿�����
			break;
		default:
			break;
		}
	}
	
}

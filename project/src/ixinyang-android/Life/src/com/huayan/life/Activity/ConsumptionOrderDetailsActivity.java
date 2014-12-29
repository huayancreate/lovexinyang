package com.huayan.life.Activity;

import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageButton;
import android.widget.TextView;

/**
 * 订单详情（未消费）
 * @author wzz
 *
 */
public class ConsumptionOrderDetailsActivity extends BaseActivity implements OnClickListener{

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_noxiaofei_order_detail);
		((ImageButton)findViewById(R.id.ib_return_go_eva)).setOnClickListener(this);
		((TextView)findViewById(R.id.tv_apply_tuikuan)).setOnClickListener(this);
	}

	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.ib_return_go_eva:
			finish();
			break;
		case R.id.tv_apply_tuikuan:
			jumpToActivity(ConsumptionOrderDetailsActivity.this, ApplyRefundActivity.class);//申请退款
			break;
		default:
			break;
		}
	}
	
}

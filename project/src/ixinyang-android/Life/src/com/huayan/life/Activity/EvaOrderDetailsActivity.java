package com.huayan.life.Activity;

import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageButton;
import android.widget.RelativeLayout;

/**
 * 订单详情（评价）
 * @author wzz
 *
 */
public class EvaOrderDetailsActivity extends BaseActivity implements OnClickListener{

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_eva_order_detail);
		((ImageButton)findViewById(R.id.ib_return_go_eva)).setOnClickListener(this);
		((RelativeLayout)findViewById(R.id.rl_go_ping)).setOnClickListener(this);
	}

	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.ib_return_go_eva:
			finish();
			break;
		case R.id.rl_go_ping:
			jumpToActivity(EvaOrderDetailsActivity.this, EvaluationActivity.class);//评价
			break;
		default:
			break;
		}
	}
}

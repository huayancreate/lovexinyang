package com.huayan.life.Activity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageView;
import android.widget.TextView;

import com.huayan.life.R;

/**
 *退款成功
 * @author wzz
 *
 */
public class RefundSuccessActivity extends BaseActivity implements OnClickListener {

	String orderID;
	int detailsID;
	TextView tv_refund_close,txt_look_order;

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_refund_success);
		orderID=getIntent().getStringExtra("orderID");
		detailsID=getIntent().getIntExtra("detailsID",0);
		initView();
	}

	private void initView() {
		((ImageView) findViewById(R.id.img_goback_refund)).setOnClickListener(this);
		tv_refund_close=(TextView)findViewById(R.id.tv_refund_close);
		tv_refund_close.setOnClickListener(this);
		txt_look_order=(TextView)findViewById(R.id.txt_look_order);
		txt_look_order.setOnClickListener(this);
	}

	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.tv_refund_close:
			Intent intent1 = new Intent(RefundSuccessActivity.this,ConsumptionOrderDetailsActivity.class);//订单详情
			intent1.putExtra("orderID", orderID);
			intent1.putExtra("detailsID", detailsID);
			startActivity(intent1);
			finish();
			break;			
		case R.id.img_goback_refund:
			finish();
			break;
		case R.id.txt_look_order:
			Intent intent = new Intent(RefundSuccessActivity.this,ConsumptionOrderDetailsActivity.class);//订单详情
			intent.putExtra("orderID", orderID);
			intent.putExtra("detailsID", detailsID);
			startActivity(intent);
			finish();
			break;
		}
	}
	
}

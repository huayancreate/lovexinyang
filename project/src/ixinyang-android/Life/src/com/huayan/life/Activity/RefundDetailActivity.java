package com.huayan.life.Activity;

import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageButton;
import android.widget.TextView;

import com.huayan.life.R;

/**
 * 退款详情
 * @author wzz
 *
 */
public class RefundDetailActivity extends BaseActivity implements OnClickListener{

	String codePwd,unitPrice;
	TextView tv_quan,tv_jia;
	
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_refund_detail);
		codePwd=getIntent().getStringExtra("goodsPwd");
		unitPrice=getIntent().getStringExtra("discountPrice");
		initView();
	}

	private void initView(){
		((ImageButton)findViewById(R.id.ib_return_go)).setOnClickListener(this);
		((TextView)findViewById(R.id.tv_refund_help)).setOnClickListener(this);
		tv_quan=(TextView)findViewById(R.id.tv_quan1);
		tv_jia=(TextView)findViewById(R.id.tv_jia);
		tv_quan.setText("券码："+codePwd);
		tv_jia.setText("总价："+unitPrice);
	}
	
	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.ib_return_go:
			finish();
			break;
		case R.id.tv_refund_help:
			jumpToActivity(RefundDetailActivity.this, PaidHelpActivity.class);//退款帮助
			break;
		}
	}
}

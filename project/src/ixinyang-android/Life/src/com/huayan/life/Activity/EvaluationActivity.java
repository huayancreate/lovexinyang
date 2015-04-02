package com.huayan.life.Activity;

import android.os.Bundle;
import android.view.MotionEvent;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.View.OnTouchListener;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.RatingBar;
import android.widget.TextView;

import com.huayan.life.R;

/**
 * ÆÀ¼Û
 * 
 * @author wzz
 * 
 */
public class EvaluationActivity extends BaseActivity implements OnClickListener {

	LinearLayout ll_part_ping;
	RatingBar rtb_total;

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_evaluation);
		((ImageView) findViewById(R.id.go_back)).setOnClickListener(this);
		((TextView) findViewById(R.id.header_name)).setText(R.string.eva);
		initView();
	}

	
	private  void initView(){
		rtb_total=(RatingBar)findViewById(R.id.rtb_total);
		ll_part_ping=(LinearLayout)findViewById(R.id.ll_part_ping);
		rtb_total.setOnTouchListener(new OnTouchListener() {
			
			@Override
			public boolean onTouch(View v, MotionEvent event) {
				ll_part_ping.setVisibility(View.VISIBLE);
				return false;
			}
		});
	}
	
	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.go_back:
			finish();
			break;
	
		default:
			break;
		}
	}

}

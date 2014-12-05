package com.huayan.life.Activity;

import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageButton;

/**
 * 
 * @author wzz
 *我的积分
 */
public class MyScoreActivity extends BaseActivity implements OnClickListener {

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_score);
		((ImageButton)findViewById(R.id.ib_goback_previous)).setOnClickListener(this);		
	}

	@Override
	public void onClick(View v) {
			switch (v.getId()) {
			case R.id.ib_goback_previous:
				finish();
				break;
			default:
				break;
			}
		}
	
}

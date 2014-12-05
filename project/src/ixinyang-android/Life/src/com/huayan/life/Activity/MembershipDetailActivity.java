package com.huayan.life.Activity;

import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageButton;

/**
 * 
 * @author wzz
 *ª·‘±ø®œÍ«È“≥
 */
public class MembershipDetailActivity extends BaseActivity implements OnClickListener {

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_membership_detail);
		((ImageButton)findViewById(R.id.ib_goback_pre)).setOnClickListener(this);		
	}

	@Override
	public void onClick(View v) {
			switch (v.getId()) {
			case R.id.ib_goback_pre:
				finish();
				break;
			default:
				break;
			}
		}

	
}

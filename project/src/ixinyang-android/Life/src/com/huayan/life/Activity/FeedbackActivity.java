package com.huayan.life.Activity;

import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageView;
import android.widget.TextView;

/**
 * Òâ¼û·´À¡
 * @author wzz
 *
 */
public class FeedbackActivity extends BaseActivity implements OnClickListener {

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_feedback);
		((ImageView) findViewById(R.id.go_back)).setOnClickListener(this);
		((TextView)findViewById(R.id.header_name)).setText(R.string.feedback);
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

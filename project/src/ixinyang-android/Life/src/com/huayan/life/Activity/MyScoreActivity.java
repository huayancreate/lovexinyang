package com.huayan.life.Activity;

import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageButton;
import android.widget.ProgressBar;
import android.widget.RelativeLayout;
import android.widget.TextView;

import com.huayan.life.R;

/**
 * 
 * @author wzz
 *我的积分
 */
public class MyScoreActivity extends BaseActivity implements OnClickListener {
	
	TextView tv_grade,tv_growth_value,tv_current_score,tv_now_shuoming;
	RelativeLayout rl_shuoming;
	ProgressBar  progress_horizontal;
	
	
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_score);
		initView();
	}

	private void initView(){
		((ImageButton)findViewById(R.id.ib_goback_previous)).setOnClickListener(this);		
		tv_grade=(TextView)findViewById(R.id.tv_grade);
		tv_growth_value=(TextView)findViewById(R.id.tv_growth_value);
		tv_current_score=(TextView)findViewById(R.id.tv_current_score);//积分
		tv_now_shuoming=(TextView)findViewById(R.id.tv_now_shuoming);//积分记录
		rl_shuoming=(RelativeLayout)findViewById(R.id.rl_shuoming);//积分规则
		rl_shuoming.setOnClickListener(this);
		progress_horizontal=(ProgressBar)findViewById(R.id.progress_horizontal);
	}
	 
	
	@Override
	public void onClick(View v) {
			switch (v.getId()) {
			case R.id.ib_goback_previous:
				finish();
				break;
			case R.id.rl_shuoming:
				jumpToActivity(MyScoreActivity.this, PaidHelpActivity.class);//积分规则
				break;
			}
		}
	
}

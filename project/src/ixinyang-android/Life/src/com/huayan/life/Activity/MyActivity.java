package com.huayan.life.Activity;

import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageView;
import android.widget.RelativeLayout;
import android.widget.TextView;

/**
 * �ҵ�
 * @author wzz
 * 
 */
public class MyActivity extends BaseActivity implements OnClickListener {

	TextView txt_loginTextView;
	RelativeLayout rel_daily_layout, orderRelativeLayout;
	ImageView iv_map;
   int count=0;
	
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_mine);
		initView();
	}

	private void initView() {
		txt_loginTextView = (TextView) findViewById(R.id.txt_login);	
		txt_loginTextView.setOnClickListener(this);
		rel_daily_layout = (RelativeLayout) findViewById(R.id.rel_daily_layout);
		rel_daily_layout.setOnClickListener(this);
		orderRelativeLayout = (RelativeLayout) findViewById(R.id.order_rel);
		orderRelativeLayout.setOnClickListener(this);
		((RelativeLayout) findViewById(R.id.daijin_layout)).setOnClickListener(this);
		iv_map = (ImageView) findViewById(R.id.iv_map);
		iv_map.setOnClickListener(this);
		((RelativeLayout) findViewById(R.id.vip_layout)).setOnClickListener(this);
		((RelativeLayout) findViewById(R.id.rl_integral)).setOnClickListener(this);	
	}

	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.txt_login:
			if(count%2==0){
				 jumpToActivity(MyActivity.this, LoginActivity.class);
			}else{
				jumpToActivity(MyActivity.this, MyAccountActivity.class);
			}
			count++;
			break;

		case R.id.rel_daily_layout:
			jumpToActivity(MyActivity.this, TheRecommendedDailyActivity.class);// ÿ���Ƽ�
			break;

		case R.id.order_rel:
			jumpToActivity(MyActivity.this, OrderActivity.class);// ��������
			break;
			
		case R.id.daijin_layout:
			jumpToActivity(MyActivity.this, CollectionActivity.class);// �ҵ��ղ�
			break;

		case R.id.iv_map:
			//û��¼������ת��LoginActivity;��¼������ת��NoticeActivity��
//			jumpToActivity(MyActivity.this, LoginActivity.class);
			jumpToActivity(MyActivity.this, NoticeActivity.class);
			break;

		case R.id.vip_layout:
			jumpToActivity(MyActivity.this, MembershipCardActivity.class);//�ҵĻ�Ա��
			break;
		case R.id.rl_integral:
			jumpToActivity(MyActivity.this, MyScoreActivity.class); //�ҵĻ���
			break;
		}
	}
}

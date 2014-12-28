package com.huayan.life.Activity;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.ImageView;
import android.widget.RelativeLayout;
import android.widget.TextView;

import com.handmark.pulltorefresh.library.PullToRefreshBase.Mode;
import com.handmark.pulltorefresh.library.PullToRefreshListView;
import com.huayan.life.adapter.NearTuanGouAdapter;
import com.huayan.life.common.GetData;
import com.huayan.life.common.MyOnRefreshListener9;

/**
 * 每日推荐
 * @author wzz
 *
 */
public class TheRecommendedDailyActivity extends BaseActivity {

	private PullToRefreshListView ptrlvHeadLineNews = null;
	private NearTuanGouAdapter  dailyAdapter = null;
	ImageView goBack;
	
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_daily_recommend);
		ptrlvHeadLineNews = (PullToRefreshListView) findViewById(R.id.ptrlvdaily_recommend);
		dailyAdapter = new NearTuanGouAdapter(this,GetData.getNearList(10));
		
		initPullToRefreshListView(ptrlvHeadLineNews, dailyAdapter);
		goBack = (ImageView) findViewById(R.id.go_back);
		((TextView) findViewById(R.id.header_name)).setText(getString(R.string.tuijian));	
		
		ptrlvHeadLineNews.setOnItemClickListener(new OnItemClickListener() {
			@Override
			public void onItemClick(AdapterView<?> arg0, View view,	int position, long id) {				
				jumpToActivity(TheRecommendedDailyActivity.this,GroupPurchaseActivity.class);
			}
		});
		
		goBack.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				finish();
			}
		});
	}

	private void initPullToRefreshListView(PullToRefreshListView rtflv,NearTuanGouAdapter adapter) {
		rtflv.setMode(Mode.BOTH);
		rtflv.setOnRefreshListener(new MyOnRefreshListener9(rtflv,this,dailyAdapter));
		rtflv.setAdapter(adapter);
		RelativeLayout  buyRelativeLayout = (RelativeLayout) LayoutInflater.from(this).inflate(R.layout.tuijian_layout, null);
		//添加其他模块控件
		rtflv.getRefreshableView().addHeaderView(buyRelativeLayout, null, false);
	}

}

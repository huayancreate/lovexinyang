package com.huayan.life.Activity;

import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.ImageButton;

import com.handmark.pulltorefresh.library.PullToRefreshBase.Mode;
import com.handmark.pulltorefresh.library.PullToRefreshListView;
import com.huayan.life.adapter.MembershipCardAdapter;
import com.huayan.life.common.GetData;
import com.huayan.life.common.MyOnRefreshListener8;

/**
 * 会员卡
 * @author wzz
 *
 */
public class MembershipCardActivity extends BaseActivity implements OnClickListener {

	private PullToRefreshListView ptrlvHeadLineNews = null;
	private MembershipCardAdapter newAdapter = null;
	
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_membership_card);
		ptrlvHeadLineNews = (PullToRefreshListView) findViewById(R.id.ptrlv_membership_card);
		newAdapter = new MembershipCardAdapter(this,GetData.getMembershipCard(10));
		initPullToRefreshListView(ptrlvHeadLineNews, newAdapter);
		((ImageButton)findViewById(R.id.ib_fanhui)).setOnClickListener(this);
		
		ptrlvHeadLineNews.setOnItemClickListener(new OnItemClickListener() {
			@Override
			public void onItemClick(AdapterView<?> arg0, View arg1, int arg2,
					long arg3) {
				//会员卡详情页
				jumpToActivity(MembershipCardActivity.this,MembershipDetailActivity.class);
			}			
		});
	}

	private void initPullToRefreshListView(PullToRefreshListView rtflv,	MembershipCardAdapter adapter) {
		rtflv.setMode(Mode.BOTH);
		rtflv.setOnRefreshListener(new MyOnRefreshListener8(rtflv,this,newAdapter));
		rtflv.setAdapter(adapter);
	}

	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.ib_fanhui:
			finish();
			break;
		default:
			break;
		}
	}
	
}

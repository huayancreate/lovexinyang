package com.huayan.life.Activity;

import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageButton;

import com.handmark.pulltorefresh.library.PullToRefreshBase.Mode;
import com.handmark.pulltorefresh.library.PullToRefreshListView;
import com.huayan.life.adapter.NoticeAdapter;
import com.huayan.life.common.GetData;
import com.huayan.life.common.MyOnRefreshListener1;

public class NoticeActivity extends BaseActivity implements OnClickListener{

	private PullToRefreshListView ptrlvHeadLineNews = null;
	private NoticeAdapter newAdapter = null;
	private ImageButton goBackTextView;
	
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_notice);
		ptrlvHeadLineNews = (PullToRefreshListView) findViewById(R.id.ptrlv_notice);
		newAdapter = new NoticeAdapter(this, GetData.getNoticeList(3));
		initPullToRefreshListView(ptrlvHeadLineNews, newAdapter);
		goBackTextView = (ImageButton) findViewById(R.id.img_goback_returns);
		goBackTextView.setOnClickListener(this);
	}

	private void initPullToRefreshListView(PullToRefreshListView rtflv,NoticeAdapter adapter) {
		rtflv.setMode(Mode.BOTH);
		rtflv.setOnRefreshListener(new MyOnRefreshListener1(rtflv, this,newAdapter));
		rtflv.setAdapter(adapter);
	}

	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.img_goback_returns:
			finish();
			break;
		}
	}
}

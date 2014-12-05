package com.huayan.life.Activity;

import com.handmark.pulltorefresh.library.PullToRefreshListView;
import com.handmark.pulltorefresh.library.PullToRefreshBase.Mode;
import com.huayan.life.adapter.EvaluationAdapter;
import com.huayan.life.common.GetData;
import com.huayan.life.common.MyOnRefreshListener7;

import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageButton;

/**
 * 最近半年评论
 * @author wzz
 *
 */
public class RecentEvaluationActivity extends BaseActivity implements OnClickListener {

	private PullToRefreshListView ptrlvHeadLineNews = null;
	private EvaluationAdapter newAdapter = null;

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_recent_evaluation);
		ptrlvHeadLineNews = (PullToRefreshListView) findViewById(R.id.ptrlv_recent_card);
		newAdapter = new EvaluationAdapter(this, GetData.getEvaluationList(10));
		initPullToRefreshListView(ptrlvHeadLineNews, newAdapter);
		((ImageButton) findViewById(R.id.ibb_fanhui2)).setOnClickListener(this);
	}

	private void initPullToRefreshListView(PullToRefreshListView rtflv,
			EvaluationAdapter adapter) {
		rtflv.setMode(Mode.BOTH);
		rtflv.setOnRefreshListener(new MyOnRefreshListener7(rtflv, this,newAdapter));
		rtflv.setAdapter(adapter);
	}

	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.ibb_fanhui2:
			finish();
			break;

		default:
			break;
		}
	}
}

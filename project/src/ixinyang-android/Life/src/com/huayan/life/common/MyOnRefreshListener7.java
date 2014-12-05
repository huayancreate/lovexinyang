package com.huayan.life.common;

import android.content.Context;
import android.text.format.DateUtils;
import android.widget.ListView;

import com.handmark.pulltorefresh.library.PullToRefreshBase;
import com.handmark.pulltorefresh.library.PullToRefreshBase.OnRefreshListener2;
import com.handmark.pulltorefresh.library.PullToRefreshListView;
import com.huayan.life.adapter.EvaluationAdapter;

public class MyOnRefreshListener7 implements OnRefreshListener2<ListView> {

	private PullToRefreshListView mPtflv;
	private Context mContext;
	private EvaluationAdapter newAdapter;
	
	public MyOnRefreshListener7(PullToRefreshListView ptflv, Context context,EvaluationAdapter adapter) {
		this.mPtflv = ptflv;
		this.mContext = context;
		this.newAdapter=adapter;
	}

	@Override
	public void onPullDownToRefresh(PullToRefreshBase<ListView> refreshView) {
		// 下拉刷新
		String label = DateUtils.formatDateTime(
				mContext.getApplicationContext(), System.currentTimeMillis(),
				DateUtils.FORMAT_SHOW_TIME | DateUtils.FORMAT_SHOW_DATE
						| DateUtils.FORMAT_ABBREV_ALL);

		refreshView.getLoadingLayoutProxy().setLastUpdatedLabel(label);
		new GetEvaluationTask(mPtflv, mContext,newAdapter).execute();

	}

	@Override
	public void onPullUpToRefresh(PullToRefreshBase<ListView> refreshView) {
		// 上拉加载
		new GetEvaluationTask(mPtflv, mContext,newAdapter).execute();
	}

}

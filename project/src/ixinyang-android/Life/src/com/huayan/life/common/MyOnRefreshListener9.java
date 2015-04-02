package com.huayan.life.common;

import android.content.Context;
import android.text.format.DateUtils;
import android.widget.ListView;

import com.handmark.pulltorefresh.library.PullToRefreshBase;
import com.handmark.pulltorefresh.library.PullToRefreshBase.OnRefreshListener2;
import com.handmark.pulltorefresh.library.PullToRefreshListView;
import com.huayan.life.adapter.NearTuanGouAdapter;

public class MyOnRefreshListener9 implements OnRefreshListener2<ListView> {

	private PullToRefreshListView mPtflv;
	private Context mContext;
	private NearTuanGouAdapter newAdapter;
	private int type;

	public MyOnRefreshListener9(PullToRefreshListView ptflv, Context context,
			NearTuanGouAdapter adapter,int type) {
		this.mPtflv = ptflv;
		this.mContext = context;
		this.newAdapter = adapter;
		this.type=type;
	}

	@Override
	public void onPullDownToRefresh(PullToRefreshBase<ListView> refreshView) {
		// 下拉刷新
		String label = DateUtils.formatDateTime(
				mContext.getApplicationContext(), System.currentTimeMillis(),
				DateUtils.FORMAT_SHOW_TIME | DateUtils.FORMAT_SHOW_DATE
						| DateUtils.FORMAT_ABBREV_ALL);

		refreshView.getLoadingLayoutProxy().setLastUpdatedLabel(label);
		new GetNearTuanTask(mPtflv, mContext, newAdapter,type).execute();

	}

	@Override
	public void onPullUpToRefresh(PullToRefreshBase<ListView> refreshView) {
		// 上拉加载
		new GetNearTuanTask(mPtflv, mContext, newAdapter,type).execute();
	}
}

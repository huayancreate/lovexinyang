package com.huayan.life.common;

import android.content.Context;
import android.text.format.DateUtils;
import android.widget.ListView;

import com.handmark.pulltorefresh.library.PullToRefreshBase;
import com.handmark.pulltorefresh.library.PullToRefreshBase.OnRefreshListener2;
import com.handmark.pulltorefresh.library.PullToRefreshListView;
import com.huayan.life.adapter.OrderListAdapter;

public class OrderOnRefreshListener2 implements OnRefreshListener2<ListView> {

	private PullToRefreshListView mPtflv;
	private Context mContext;
	private OrderListAdapter newAdapter;
	private int  mIndex;
	
	public OrderOnRefreshListener2(PullToRefreshListView ptflv, Context context,OrderListAdapter adapter,int type) {
		this.mPtflv = ptflv;
		this.mContext = context;
		this.newAdapter=adapter;
		this.mIndex=type;
	}

	@Override
	public void onPullDownToRefresh(PullToRefreshBase<ListView> refreshView) {
		// 下拉刷新
		String label = DateUtils.formatDateTime(
				mContext.getApplicationContext(), System.currentTimeMillis(),
				DateUtils.FORMAT_SHOW_TIME | DateUtils.FORMAT_SHOW_DATE
						| DateUtils.FORMAT_ABBREV_ALL);

		refreshView.getLoadingLayoutProxy().setLastUpdatedLabel(label);
		new GetOrdersTask(mPtflv, mContext,newAdapter,mIndex).execute();

	}

	@Override
	public void onPullUpToRefresh(PullToRefreshBase<ListView> refreshView) {
		// 上拉加载
		new GetOrdersTask(mPtflv, mContext,newAdapter,mIndex).execute();
	}

}

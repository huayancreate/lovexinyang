package com.huayan.life.Activity;

import android.annotation.SuppressLint;
import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;

import com.handmark.pulltorefresh.library.PullToRefreshBase.Mode;
import com.handmark.pulltorefresh.library.PullToRefreshListView;
import com.huayan.life.adapter.StoreListAdapter;
import com.huayan.life.common.GetData;
import com.huayan.life.common.MyOnRefreshListener5;

@SuppressLint("ValidFragment")
public class MyFragment extends Fragment implements OnClickListener {

	private Activity mActivity;
	private View mView;
	private int mIndex;
	private PullToRefreshListView mListView;
	private StoreListAdapter newAdapter = null;

	public MyFragment(Activity activity, int index) {
		mActivity = activity;
		mIndex = index;
	}

	@Override
	public View onCreateView(LayoutInflater inflater, ViewGroup container,
			Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreateView(inflater, container, savedInstanceState);
		mView = inflater.inflate(R.layout.film_seat, null);
		initList();
		return mView;
	}

	/* 然后， 我们来给mList添加一些要显示的数据 */
	private void initList() {
		mListView = (PullToRefreshListView) mView.findViewById(R.id.ptrlvEntertainmentFilm);
		newAdapter = new StoreListAdapter(mActivity,GetData.getStoreList(10));
		initPullToRefreshListView(mListView,newAdapter);
		
		mListView.setOnItemClickListener(new OnItemClickListener() {
			@Override
			public void onItemClick(AdapterView<?> parent, View view, int arg2,long arg3) {
				Intent intent = new Intent(mActivity, OrderDetailsActivity.class);
				startActivity(intent);
			}
		});
	}
	
	private void initPullToRefreshListView(PullToRefreshListView rtflv,StoreListAdapter adapter) {
		rtflv.setMode(Mode.BOTH);
		rtflv.setOnRefreshListener(new MyOnRefreshListener5(rtflv,mActivity,newAdapter));
		rtflv.setAdapter(adapter);
	}
	

	@Override
	public void onClick(View v) {
		// TODO Auto-generated method stub
		switch (v.getId()) {
		default:
			break;
		}
	}
}

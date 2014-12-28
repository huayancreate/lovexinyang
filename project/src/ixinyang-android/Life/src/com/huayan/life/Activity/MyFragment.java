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
import android.widget.TextView;

import com.handmark.pulltorefresh.library.PullToRefreshBase.Mode;
import com.handmark.pulltorefresh.library.PullToRefreshListView;
import com.huayan.life.adapter.OrderListAdapter;
import com.huayan.life.common.GetData;
import com.huayan.life.common.OrderOnRefreshListener2;

@SuppressLint("ValidFragment")
public class MyFragment extends Fragment implements OnClickListener {

	private Activity mActivity;
	private View mView;
	private int mIndex;
	private PullToRefreshListView mListView;
	private OrderListAdapter newAdapter = null;

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
		newAdapter = new OrderListAdapter(mActivity,GetData.getOrders(10,mIndex));
		initPullToRefreshListView(mListView,newAdapter);
		
		mListView.setOnItemClickListener(new OnItemClickListener() {
			@Override
			public void onItemClick(AdapterView<?> parent, View view, int position,long arg3) {
			    TextView text = (TextView) view.findViewById(R.id.tv_order_category);
			    String category=text.getText().toString();
			    Intent intent=null ;
			    if(category.equals(mActivity.getResources().getString(R.string.pending_payment))){//待付款
			    	 intent = new Intent(mActivity, OrderDetailsActivity.class);
			    	 
			    }else if(category.equals(mActivity.getResources().getString(R.string.dai_eva))){//待评价
			    	intent = new Intent(mActivity, EvaOrderDetailsActivity.class);
			    	
			    }else if(category.equals(mActivity.getResources().getString(R.string.yi_refund))){//已退款
			    	 intent = new Intent(mActivity, RefundOrderDetailsActivity.class);
			    	
			    }else if(category.equals(mActivity.getResources().getString(R.string.refunding))){//退款中
			    	 intent = new Intent(mActivity, RefundOrderDetailsActivity.class);
			    	 
			    }else if(category.equals(mActivity.getResources().getString(R.string.non_consumption))){//未消费
			    	 intent = new Intent(mActivity, ConsumptionOrderDetailsActivity.class);
			    	 
			    }else{
			    	 intent = new Intent(mActivity, EvaOrderDetailsActivity.class); //已评价
			    	 
			    }
				startActivity(intent);
			}
		});
	}
	
	private void initPullToRefreshListView(PullToRefreshListView rtflv,OrderListAdapter adapter) {
		rtflv.setMode(Mode.BOTH);
		rtflv.setOnRefreshListener(new OrderOnRefreshListener2(rtflv,mActivity,newAdapter,mIndex));
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

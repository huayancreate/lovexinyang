package com.huayan.life.Activity;

import android.annotation.SuppressLint;
import android.graphics.Paint;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.ViewTreeObserver.OnGlobalLayoutListener;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.ListView;
import android.widget.RelativeLayout;
import android.widget.TextView;

import com.huayan.life.adapter.EvaluationAdapter;
import com.huayan.life.adapter.GroupPurchaseAdapter;
import com.huayan.life.adapter.NearTuanGouAdapter;
import com.huayan.life.common.GetData;
import com.huayan.life.view.MyScrollView;
import com.huayan.life.view.MyScrollView.OnScrollListener;

/**
 * 商品详情
 * @author wzz
 * @version 1.0
 */
public class GroupPurchaseActivity extends BaseActivity implements
		OnScrollListener, OnClickListener {

	private MyScrollView myScrollView;
	private LinearLayout mBuyLayout; // 在MyScrollView里面的购买布局
	private LinearLayout mTopBuyLayout;// 位于顶部的购买布局
	TextView newPriceView;
	RelativeLayout rl_albumLayout;
	TextView tv_buy;
	ListView pingListView, listRecommendvView, listTuanView;
	EvaluationAdapter evaluationAdapter;
	GroupPurchaseAdapter  adapter;
	
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_group_purchase);

		myScrollView = (MyScrollView) findViewById(R.id.my_sl);
		mBuyLayout = (LinearLayout) findViewById(R.id.buy);
		mTopBuyLayout = (LinearLayout) findViewById(R.id.top_buy_layout);
		myScrollView.setOnScrollListener(this);
		rl_albumLayout = (RelativeLayout) findViewById(R.id.rl_album);
		rl_albumLayout.setOnClickListener(this);
		((ImageView) findViewById(R.id.fanhui)).setOnClickListener(this);
		((TextView)findViewById(R.id.txt_moreping)).setOnClickListener(this);
		
		LinearLayout rlAdv = (LinearLayout) findViewById(R.id.buy);
		newPriceView = (TextView) rlAdv.findViewById(R.id.tv_new_price);
		newPriceView.setText("268元");
		newPriceView.getPaint().setFlags(Paint.STRIKE_THRU_TEXT_FLAG); // 中间横线
		tv_buy = (TextView) rlAdv.findViewById(R.id.tv_buy);
		tv_buy.setOnClickListener(this);

		pingListView = (ListView) findViewById(R.id.list_evaluation);
		evaluationAdapter = new EvaluationAdapter(context,GetData.getEvaluationList(3));
		pingListView.setAdapter(evaluationAdapter);
		listRecommendvView = (ListView) findViewById(R.id.list_recommended);
		listTuanView = (ListView) findViewById(R.id.list_tuangou);
		NearTuanGouAdapter tanGouAdapter = new NearTuanGouAdapter(context,GetData.getNearList(4));
		adapter=new GroupPurchaseAdapter(context, GetData.getGroupPurchase(4));
		listRecommendvView.setAdapter(adapter);
		listTuanView.setAdapter(tanGouAdapter);

		listRecommendvView.setOnItemClickListener(new mListener());
		listTuanView.setOnItemClickListener(new mListener());
		
		// 当布局的状态或者控件的可见性发生改变回调的接口
		findViewById(R.id.parent_layout).getViewTreeObserver()
				.addOnGlobalLayoutListener(new OnGlobalLayoutListener() {
					@Override
					public void onGlobalLayout() {
						// 这一步很重要，使得上面的购买布局和下面的购买布局重合
						onScroll(myScrollView.getScrollY());
					}
				});
	}

	
	private final class mListener implements OnItemClickListener {

		/*
		 * arg1 当前所点击的VIew对象 arg2 当前所点击的条目所绑定的数据在集合中的索引值 arg3 当前界面中的排列值
		 */
		@SuppressLint("ResourceAsColor")
		public void onItemClick(AdapterView<?> arg0, View arg1, int arg2,long arg3) {
			jumpToActivity(GroupPurchaseActivity.this, GroupPurchaseActivity.class);
		}
	}
	@Override
	public void onScroll(int scrollY) {
		int mBuyLayout2ParentTop = Math.max(scrollY, mBuyLayout.getTop());
		mTopBuyLayout.layout(0, mBuyLayout2ParentTop, mTopBuyLayout.getWidth(),mBuyLayout2ParentTop + mTopBuyLayout.getHeight());
	}

	@Override
	
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.rl_album:
			jumpToActivity(GroupPurchaseActivity.this, AlbumActivity.class);
			break;
		case R.id.fanhui:
			finish();
			break;
		case R.id.tv_buy:
			jumpToActivity(GroupPurchaseActivity.this,SubmitOrderActivity.class);
			break;
		case R.id.txt_moreping:
			//半年内的评价列表
			jumpToActivity(GroupPurchaseActivity.this, RecentEvaluationActivity.class);
			break;
		}
	}

}

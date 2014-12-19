package com.huayan.life.Activity;

import util.Utility;
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
 * ��Ʒ����
 * @author wzz
 * @version 1.0
 */
public class GroupPurchaseActivity extends BaseActivity implements
		OnScrollListener, OnClickListener {

	private MyScrollView myScrollView;
	private LinearLayout mBuyLayout; // ��MyScrollView����Ĺ��򲼾�
	private LinearLayout mTopBuyLayout;// λ�ڶ����Ĺ��򲼾�
	TextView newPrice,oldPrice;
	ListView pingListView, listRecommendvView, listTuanView;
	EvaluationAdapter evaluationAdapter;
	GroupPurchaseAdapter  adapter;
	NearTuanGouAdapter tanGouAdapter ;
	
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_group_purchase);

		myScrollView = (MyScrollView) findViewById(R.id.my_sl);
		myScrollView.setOnScrollListener(this);		
		mBuyLayout = (LinearLayout) findViewById(R.id.buy);
		mTopBuyLayout = (LinearLayout) findViewById(R.id.top_buy_layout);

		newPrice = (TextView)mTopBuyLayout.findViewById(R.id.tv_new_price);
		newPrice.setText("268Ԫ");
		newPrice.getPaint().setFlags(Paint.STRIKE_THRU_TEXT_FLAG); // �м����
		oldPrice=(TextView)mTopBuyLayout.findViewById(R.id.tv_old_price);
		oldPrice.setText("108");

		((TextView)mTopBuyLayout.findViewById(R.id.tv_buy)).setOnClickListener(this);
		initView();	
		
		// �����ֵ�״̬���߿ؼ��Ŀɼ��Է����ı�ص��Ľӿ�
		findViewById(R.id.parent_layout).getViewTreeObserver()
				.addOnGlobalLayoutListener(new OnGlobalLayoutListener() {
					@Override
					public void onGlobalLayout() {
						// ��һ������Ҫ��ʹ������Ĺ��򲼾ֺ�����Ĺ��򲼾��غ�
						onScroll(myScrollView.getScrollY());
					}
				});
	}
	
	
	private  void initView(){
		((RelativeLayout) findViewById(R.id.rl_album)).setOnClickListener(this);
		((ImageView) findViewById(R.id.fanhui)).setOnClickListener(this);
		((TextView)findViewById(R.id.txt_moreping)).setOnClickListener(this);
		pingListView = (ListView) findViewById(R.id.list_evaluation);
		listRecommendvView = (ListView) findViewById(R.id.list_recommended);
		listTuanView = (ListView) findViewById(R.id.list_tuangou);
		
		evaluationAdapter = new EvaluationAdapter(context,GetData.getEvaluationList(3));
		pingListView.setAdapter(evaluationAdapter);
		Utility.setListViewHeightBasedOnChildren(pingListView, 230);
			
		adapter=new GroupPurchaseAdapter(context, GetData.getGroupPurchase(4));
		listRecommendvView.setAdapter(adapter);
		Utility.setListViewHeightBasedOnChildren(listRecommendvView, 50);
		
		tanGouAdapter = new NearTuanGouAdapter(context,GetData.getNearList(4));		
		listTuanView.setAdapter(tanGouAdapter);
		Utility.setListViewHeightBasedOnChildren(listTuanView, 30);
		
		listRecommendvView.setOnItemClickListener(new mListener());
		listTuanView.setOnItemClickListener(new mListener());
		
	}
	
	
	private final class mListener implements OnItemClickListener {
		/*
		 * arg1 ��ǰ�������VIew���� arg2 ��ǰ���������Ŀ���󶨵������ڼ����е�����ֵ arg3 ��ǰ�����е�����ֵ
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
			//�����ڵ������б�
			jumpToActivity(GroupPurchaseActivity.this, RecentEvaluationActivity.class);
			break;
		}
	}
	
}

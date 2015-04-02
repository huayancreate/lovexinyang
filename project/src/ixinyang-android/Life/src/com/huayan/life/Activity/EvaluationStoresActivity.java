package com.huayan.life.Activity;

import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageButton;

import com.handmark.pulltorefresh.library.PullToRefreshBase.Mode;
import com.handmark.pulltorefresh.library.PullToRefreshListView;
import com.huayan.life.R;
import com.huayan.life.adapter.EvaluationAdapter;
import com.huayan.life.common.GetData;
import com.huayan.life.common.MyOnRefreshListener7;

/**
 * 商家评价列表
 * @author wzz
 *
 */
public class EvaluationStoresActivity extends BaseActivity implements OnClickListener {

	private PullToRefreshListView ptrlvHeadLineNews = null;
	private EvaluationAdapter newAdapter = null;
	
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_evaluation_store);
		ptrlvHeadLineNews = (PullToRefreshListView) findViewById(R.id.ptrlv_store_card);
		newAdapter = new EvaluationAdapter(this,GetData.getEvaluationList(10));
		initPullToRefreshListView(ptrlvHeadLineNews, newAdapter);
		((ImageButton)findViewById(R.id.ibb_fanhui)).setOnClickListener(this);
	}

	private void initPullToRefreshListView(PullToRefreshListView rtflv,
			EvaluationAdapter adapter) {
		rtflv.setMode(Mode.BOTH);
		rtflv.setOnRefreshListener(new MyOnRefreshListener7(rtflv,this,newAdapter));
		rtflv.setAdapter(adapter);
	}

	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.ibb_fanhui:
			finish();
			break;
		default:
			break;
		}
	}
}

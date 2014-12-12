package com.huayan.life.Activity;

import android.annotation.SuppressLint;
import android.graphics.drawable.BitmapDrawable;
import android.os.Bundle;
import android.view.Gravity;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.ViewGroup.LayoutParams;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.PopupWindow;
import android.widget.TextView;

import com.huayan.life.adapter.EvaluationAdapter;
import com.huayan.life.adapter.HotAdapter;
import com.huayan.life.adapter.NearTuanGouAdapter;
import com.huayan.life.common.GetData;

/**
 * 商家详情
 * @author wzz
 *
 */
public class StoreDetailActivity extends BaseActivity implements
		OnClickListener {

	HotAdapter adapter;
	ListView pingListView, nearListView;
	PopupWindow popupWindow;
	NearTuanGouAdapter tanGouAdapter;
	EvaluationAdapter evaluationAdapter;

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_store_detail);
		pingListView = (ListView) findViewById(R.id.lv_evaluation);
		nearListView = (ListView) findViewById(R.id.lv_near_store);
		((ImageView) findViewById(R.id.ib_returns)).setOnClickListener(this);
		((ImageView)findViewById(R.id.img_blumn)).setOnClickListener(this);//商家相册
		initData();
		((ImageView) findViewById(R.id.vip)).setOnClickListener(this);
		((TextView) findViewById(R.id.tv_down)).setOnClickListener(this);
		((TextView) findViewById(R.id.tv_moreping)).setOnClickListener(this);
	}

	private void initData() {
		tanGouAdapter = new NearTuanGouAdapter(context, GetData.getNearList(4));
		evaluationAdapter = new EvaluationAdapter(context,GetData.getEvaluationList(3));
		pingListView.setAdapter(evaluationAdapter);
		nearListView.setAdapter(tanGouAdapter);
		nearListView.setOnItemClickListener(new mListener());
	}

	private final class mListener implements OnItemClickListener {
		@SuppressLint("ResourceAsColor")
		public void onItemClick(AdapterView<?> arg0, View arg1, int arg2,
				long arg3) {
			jumpToActivity(StoreDetailActivity.this,
					GroupPurchaseActivity.class);
		}
	}

	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.ib_returns:
			finish();
			break;
		case R.id.vip:
			showAlert();
			popupWindow.showAtLocation(findViewById(R.id.ll_store),
					Gravity.CENTER, 0, 0);
			break;
		case R.id.tv_down:
			// 添加到我的会员卡
			jumpToActivity(StoreDetailActivity.this,
					MembershipCardActivity.class);
			break;
		case R.id.tv_moreping:
			// 商家评价
			jumpToActivity(StoreDetailActivity.this,
					EvaluationStoresActivity.class);
			break;
		case R.id.img_blumn:
			//TODO 商家相册
			jumpToActivity(StoreDetailActivity.this,StoreAlbumActivity.class);
			break;
		default:
			break;
		}
	}

	private void showAlert() {

		if (null != popupWindow) {
			popupWindow.dismiss();
			return;
		} else {
			View popupWindow_view = getLayoutInflater().inflate(
					R.layout.vip_dialog, null, false);
			popupWindow = new PopupWindow(popupWindow_view,
					LayoutParams.WRAP_CONTENT, LayoutParams.WRAP_CONTENT, true);
			popupWindow.setBackgroundDrawable(new BitmapDrawable());
			ImageView close = (ImageView) popupWindow_view
					.findViewById(R.id.img_close_dialog);
			close.setOnClickListener(new View.OnClickListener() {
				public void onClick(View v) {
					popupWindow.dismiss();
				}
			});
		}
	}

}

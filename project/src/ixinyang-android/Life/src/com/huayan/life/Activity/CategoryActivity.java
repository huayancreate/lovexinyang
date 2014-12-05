package com.huayan.life.Activity;

import java.util.ArrayList;
import java.util.HashMap;

import android.graphics.drawable.BitmapDrawable;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.FrameLayout;
import android.widget.LinearLayout;
import android.widget.ListView;
import android.widget.PopupWindow;
import android.widget.TextView;

import com.handmark.pulltorefresh.library.PullToRefreshBase.Mode;
import com.handmark.pulltorefresh.library.PullToRefreshListView;
import com.huayan.life.adapter.CategoryListAdapter;
import com.huayan.life.adapter.RecommendAdapter;
import com.huayan.life.common.GetData;
import com.huayan.life.common.MyOnRefreshListener6;

/**
 * 商品类别列表
 * @author wzz
 *
 */
public class CategoryActivity extends BaseActivity {

	private PullToRefreshListView ptrlvHeadLineNews = null;
	private RecommendAdapter newAdapter = null;

	private LinearLayout public_menu;
	private ArrayList<HashMap<String, Object>> itemList;
	private TextView text1;
	private TextView text2;
	private TextView text3;
	private LinearLayout linLayout;
	private LinearLayout layout;
	private ListView rootList;
	private String title[] = { "全部分类", "美食", "酒店", "电影", "休闲娱乐", "生活服务", "丽人" };
	private String near[] = { "附近", "热门商圈", "浉河区", "罗山区", "潢川县", "淮滨县", "平桥区" };
	private String sort[]={ "智能排序", "好评优先", "离我最近", "人均最低"};
	private FrameLayout flChild;
	private ListView childList;
	private PopupWindow mPopWin;

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_category);
		ptrlvHeadLineNews = (PullToRefreshListView) findViewById(R.id.ptrlvStoreCategory);
		newAdapter = new RecommendAdapter(this, GetData.getRecommendList(10));
		initPullToRefreshListView(ptrlvHeadLineNews, newAdapter);

		ptrlvHeadLineNews.setOnItemClickListener(new OnItemClickListener() {
			@Override
			public void onItemClick(AdapterView<?> arg0, View arg1, int arg2,
					long arg3) {
				jumpToActivity(CategoryActivity.this,GroupPurchaseActivity.class);
			}
		});

		LinearLayout ll_back = (LinearLayout) findViewById(R.id.ll_back);
		ll_back.setOnClickListener(new OnClickListener() {

			@Override
			public void onClick(View v) {
				finish();
			}
		});
		initPopupWindow();
	}

	private void initPopupWindow() {
		public_menu = (LinearLayout) findViewById(R.id.public_menu);
		itemList = new ArrayList<HashMap<String, Object>>();
		text1 = (TextView) public_menu.findViewById(R.id.text1);
		text2 = (TextView) public_menu.findViewById(R.id.text2);
		text3 = (TextView) public_menu.findViewById(R.id.text3);
		linLayout = (LinearLayout) findViewById(R.id.ll_food);

		text1.setOnClickListener(new OnClickListener() {

			@Override
			public void onClick(View v) {
				showPopupWindow(text1,title, linLayout.getWidth(),
						linLayout.getHeight());
			}
		});

		text2.setOnClickListener(new OnClickListener() {

			@Override
			public void onClick(View v) {
				showPopupWindow(text2,near, linLayout.getWidth(),
						linLayout.getHeight());
			}
		});

		text3.setOnClickListener(new OnClickListener() {

			@Override
			public void onClick(View v) {
				showPopupWindow(text3,sort, linLayout.getWidth(),
						linLayout.getHeight());
			}
		});
	}

	private void showPopupWindow(TextView txtView,String[] titStrings, int width, int height) {

		itemList = new ArrayList<HashMap<String, Object>>();
		layout = (LinearLayout) LayoutInflater.from(CategoryActivity.this)
				.inflate(R.layout.popup_category, null);
		rootList = (ListView) layout.findViewById(R.id.rootcategory);
		for (int i = 0; i < titStrings.length; i++) {
			HashMap<String, Object> items = new HashMap<String, Object>();
			items.put("name", titStrings[i]);
			items.put("count", i * 5);
			itemList.add(items);
		}

		CategoryListAdapter cla = new CategoryListAdapter(CategoryActivity.this, itemList);
		rootList.setAdapter(cla);

		flChild = (FrameLayout) layout.findViewById(R.id.child_lay);
		childList = (ListView) layout.findViewById(R.id.childcategory);
		childList.setAdapter(cla);
		flChild.setVisibility(View.INVISIBLE);

		mPopWin = new PopupWindow(layout, width * 9 / 10, height / 2, true);
		mPopWin.setBackgroundDrawable(new BitmapDrawable());
		mPopWin.showAsDropDown(txtView, 5, 1);
		mPopWin.update();

		rootList.setOnItemClickListener(new android.widget.AdapterView.OnItemClickListener() {

			@Override
			public void onItemClick(AdapterView<?> parent, View view,
					int position, long id) {
				flChild.setVisibility(View.VISIBLE);
				childList
						.setOnItemClickListener(new android.widget.AdapterView.OnItemClickListener() {
							@Override
							public void onItemClick(AdapterView<?> parent,
									View view, int position, long id) {
								layout.setVisibility(View.GONE);
							}
						});
			}
		});
	}

	private void initPullToRefreshListView(PullToRefreshListView rtflv,
			RecommendAdapter adapter) {
		rtflv.setMode(Mode.BOTH);
		rtflv.setOnRefreshListener(new MyOnRefreshListener6(rtflv, this,
				newAdapter));
		rtflv.setAdapter(adapter);
	}

}

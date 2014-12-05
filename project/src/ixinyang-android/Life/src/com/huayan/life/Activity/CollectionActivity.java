package com.huayan.life.Activity;

import java.util.ArrayList;
import java.util.List;

import android.graphics.BitmapFactory;
import android.graphics.Matrix;
import android.os.Bundle;
import android.support.v4.view.ViewPager;
import android.support.v4.view.ViewPager.OnPageChangeListener;
import android.util.DisplayMetrics;
import android.view.LayoutInflater;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.animation.Animation;
import android.view.animation.TranslateAnimation;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.ImageView;
import android.widget.TextView;

import com.handmark.pulltorefresh.library.PullToRefreshBase.Mode;
import com.handmark.pulltorefresh.library.PullToRefreshListView;
import com.huayan.life.adapter.MyPagerAdapter;
import com.huayan.life.adapter.NearTuanGouAdapter;
import com.huayan.life.adapter.StoreListAdapter;
import com.huayan.life.common.GetData;
import com.huayan.life.common.MyOnRefreshListener5;
import com.huayan.life.common.MyOnRefreshListener9;

/**
 * 收藏管理
 * 
 * @author wzz
 *
 */
public class CollectionActivity extends BaseActivity implements OnClickListener {
	private ViewPager vpViewPager = null;
	private List<View> views = null;

	private int offset; // 间隔
	private int cursorWidth; // 游标的长度
	private int originalIndex = 0;
	private ImageView cursor = null;
	private Animation animation = null;
	private PullToRefreshListView ptrlvFilm = null;//商品
	private PullToRefreshListView ptrlvHotel = null;//店铺
	private StoreListAdapter storeListAdapter;
	private NearTuanGouAdapter nearAdapter;
	
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_order);
		((TextView) findViewById(R.id.tvTag1)).setOnClickListener(this);
		((TextView) findViewById(R.id.tvTag2)).setOnClickListener(this);
		((ImageView) findViewById(R.id.go_back)).setOnClickListener(this);
		((TextView) findViewById(R.id.header_name)).setText(getString(R.string.my_daijin));

		views = new ArrayList<View>();
		views.add(LayoutInflater.from(this).inflate(R.layout.film_seat, null));
		views.add(LayoutInflater.from(this).inflate(R.layout.hotel_reservation,null));

		vpViewPager = (ViewPager) findViewById(R.id.vp_ViewPager1);
		vpViewPager.setAdapter(new MyPagerAdapter(views));
		vpViewPager.setOnPageChangeListener(new MyOnPageChangeListener());
		initCursor(views.size());
		MyPagerAdapter myPagerAdapter = (MyPagerAdapter) vpViewPager.getAdapter();
		View v1 = myPagerAdapter.getItemAtPosition(0);
		View v2 = myPagerAdapter.getItemAtPosition(1);
		ptrlvFilm = (PullToRefreshListView) v1.findViewById(R.id.ptrlvEntertainmentFilm);
		ptrlvHotel = (PullToRefreshListView) v2.findViewById(R.id.ptrlvHotel);

		storeListAdapter=new StoreListAdapter(context, GetData.getStoreList(10));
		nearAdapter =new NearTuanGouAdapter(context, GetData.getNearList(10));
		
		initPullToRefreshListView1(ptrlvFilm, nearAdapter);
		initPullToRefreshListView(ptrlvHotel, storeListAdapter);
		ptrlvFilm.setOnItemClickListener(new OnItemClickListener() {

			@Override
			public void onItemClick(AdapterView<?> arg0, View arg1, int arg2,
					long arg3) {
				jumpToActivity(CollectionActivity.this, GroupPurchaseActivity.class);
			}
		});
		
		ptrlvHotel.setOnItemClickListener(new OnItemClickListener() {

			@Override
			public void onItemClick(AdapterView<?> arg0, View arg1, int arg2,
					long arg3) {
				jumpToActivity(CollectionActivity.this, StoreDetailActivity.class);
			}
		});

	}

	private void initCursor(int tagNum) {
		cursorWidth = BitmapFactory.decodeResource(getResources(),
				R.drawable.cursor).getWidth();
		DisplayMetrics dm = new DisplayMetrics();
		getWindowManager().getDefaultDisplay().getMetrics(dm);
		offset = ((dm.widthPixels / tagNum) - cursorWidth) / 2;
		cursor = (ImageView) findViewById(R.id.ivCursor);
		Matrix matrix = new Matrix();
		matrix.setTranslate(offset, 0);
		cursor.setImageMatrix(matrix);
	}

	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.tvTag1:
			vpViewPager.setCurrentItem(0);
			break;
		case R.id.tvTag2:
			vpViewPager.setCurrentItem(1);
			break;
		case R.id.go_back:
			finish();
			break;
		}
	}
	
	private void initPullToRefreshListView1(PullToRefreshListView rtflv,NearTuanGouAdapter adapter) {
		rtflv.setMode(Mode.BOTH);
		rtflv.setOnRefreshListener(new MyOnRefreshListener9(rtflv,CollectionActivity.this,nearAdapter));
		rtflv.setAdapter(adapter);
	}

	
	private void initPullToRefreshListView(PullToRefreshListView rtflv,StoreListAdapter adapter) {
		rtflv.setMode(Mode.BOTH);
		rtflv.setOnRefreshListener(new MyOnRefreshListener5(rtflv,CollectionActivity.this,storeListAdapter));
		rtflv.setAdapter(adapter);
	}

	class MyOnPageChangeListener implements OnPageChangeListener {
		@Override
		public void onPageSelected(int arg0) {
			int one = 2 * offset + cursorWidth;
			int two = one * 2;

			switch (originalIndex) {
			case 0:
				if (arg0 == 1) {
					animation = new TranslateAnimation(0, one, 0, 0);
				}
				if (arg0 == 2) {
					animation = new TranslateAnimation(0, two, 0, 0);
				}
				break;
			case 1:
				if (arg0 == 0) {
					animation = new TranslateAnimation(one, 0, 0, 0);
				}
				if (arg0 == 2) {
					animation = new TranslateAnimation(one, two, 0, 0);
				}
				break;
			case 2:
				if (arg0 == 1) {
					animation = new TranslateAnimation(two, one, 0, 0);
				}
				if (arg0 == 0) {
					animation = new TranslateAnimation(two, 0, 0, 0);
				}
				break;
			}
			animation.setFillAfter(true);
			animation.setDuration(300);
			cursor.startAnimation(animation);

			originalIndex = arg0;
		}

		@Override
		public void onPageScrolled(int arg0, float arg1, int arg2) {

		}

		@Override
		public void onPageScrollStateChanged(int arg0) {

		}

	}


}

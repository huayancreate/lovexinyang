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
import com.huayan.life.adapter.StoreListAdapter;
import com.huayan.life.common.GetData;
import com.huayan.life.common.MyOnRefreshListener5;

/**
 * 订单管理
 * @author wzz
 *
 */
public class OrderActivity extends BaseActivity implements OnClickListener {

	private ViewPager vpViewPager = null;
	private List<View> views = null;

	private int offset; // 间隔
	private int cursorWidth; // 游标的长度
	private int originalIndex = 0;
	private ImageView cursor = null;
	private StoreListAdapter newAdapter = null;
	private Animation animation = null;
	private PullToRefreshListView ptrlvFilm = null,ptrlvFilm3 = null,ptrlvFilm5= null;
	private PullToRefreshListView ptrlvHotel = null,ptrlvHotel4 = null;

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_order_manage);
		((TextView) findViewById(R.id.tv_Tag1)).setOnClickListener(this);
		((TextView) findViewById(R.id.tv_Tag2)).setOnClickListener(this);
		((TextView) findViewById(R.id.tv_Tag3)).setOnClickListener(this);
		((TextView) findViewById(R.id.tv_Tag4)).setOnClickListener(this);
		((TextView) findViewById(R.id.tv_Tag5)).setOnClickListener(this);
		((ImageView) findViewById(R.id.go_back)).setOnClickListener(this);
		((TextView)findViewById(R.id.header_name)).setText(R.string.yuding);
		
		
		views = new ArrayList<View>();
		views.add(LayoutInflater.from(this).inflate(R.layout.film_seat, null));
		views.add(LayoutInflater.from(this).inflate(R.layout.hotel_reservation,null));
		views.add(LayoutInflater.from(this).inflate(R.layout.film_seat, null));
		views.add(LayoutInflater.from(this).inflate(R.layout.hotel_reservation,null));
		views.add(LayoutInflater.from(this).inflate(R.layout.film_seat, null));
		
		vpViewPager = (ViewPager) findViewById(R.id.vp_ViewPager2);
		vpViewPager.setAdapter(new MyPagerAdapter(views));
		vpViewPager.setOnPageChangeListener(new MyOnPageChangeListener());
		
		initCursor(views.size());
		
		MyPagerAdapter myPagerAdapter = (MyPagerAdapter) vpViewPager.getAdapter();
		View v1 = myPagerAdapter.getItemAtPosition(0);
		View v2 = myPagerAdapter.getItemAtPosition(1);
		View v3 = myPagerAdapter.getItemAtPosition(2);
		View v4 = myPagerAdapter.getItemAtPosition(3);
		View v5 = myPagerAdapter.getItemAtPosition(4);
		
		ptrlvFilm = (PullToRefreshListView) v1.findViewById(R.id.ptrlvEntertainmentFilm);
		ptrlvHotel = (PullToRefreshListView)v2.findViewById(R.id.ptrlvHotel);
		ptrlvFilm3 = (PullToRefreshListView) v3.findViewById(R.id.ptrlvEntertainmentFilm);
		ptrlvHotel4= (PullToRefreshListView)v4.findViewById(R.id.ptrlvHotel);
		ptrlvFilm5 = (PullToRefreshListView) v5.findViewById(R.id.ptrlvEntertainmentFilm);
		
		newAdapter = new StoreListAdapter(this,GetData.getStoreList(10));
		initPullToRefreshListView(ptrlvFilm, newAdapter);
		initPullToRefreshListView(ptrlvHotel, newAdapter);
		initPullToRefreshListView(ptrlvFilm3, newAdapter);
		initPullToRefreshListView(ptrlvHotel4, newAdapter);
		initPullToRefreshListView(ptrlvFilm5, newAdapter);
		
		ptrlvFilm.setOnItemClickListener(new OnItemClickListener() {
			@Override
			public void onItemClick(AdapterView<?> arg0, View arg1, int arg2,long arg3) {
				jumpToActivity(OrderActivity.this, OrderDetailsActivity.class);
			}
		});
	}

	private void initCursor(int tagNum) {
		cursorWidth = BitmapFactory.decodeResource(getResources(),R.drawable.cursor).getWidth();
		DisplayMetrics dm = new DisplayMetrics();
		getWindowManager().getDefaultDisplay().getMetrics(dm);
		offset = ((dm.widthPixels / tagNum) - cursorWidth) / 2;
		cursor = (ImageView) findViewById(R.id.iv_Cursor);
		Matrix matrix = new Matrix();
		matrix.setTranslate(offset, 0);
		cursor.setImageMatrix(matrix);
	}

	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.tv_Tag1:
			vpViewPager.setCurrentItem(0);
			break;
		case R.id.tv_Tag2:
			vpViewPager.setCurrentItem(1);
			break;
		case R.id.tv_Tag3:
			vpViewPager.setCurrentItem(2);
			break;
		case R.id.tv_Tag4:
			vpViewPager.setCurrentItem(3);
			break;
		case R.id.tv_Tag5:
			vpViewPager.setCurrentItem(4);
			break;
		case R.id.go_back:
			finish();
			break;
		}
	}

	private void initPullToRefreshListView(PullToRefreshListView rtflv,StoreListAdapter adapter) {
		rtflv.setMode(Mode.BOTH);
		rtflv.setOnRefreshListener(new MyOnRefreshListener5(rtflv,OrderActivity.this,newAdapter));
		rtflv.setAdapter(adapter);
	}

	class MyOnPageChangeListener implements OnPageChangeListener {
		@Override
		public void onPageSelected(int arg0) {
			int one = 2 * offset + cursorWidth;
			int two = one * 2+5;
			int three=one*3+15;
			int four=one*4+15;

			switch (originalIndex) {
			case 0:
				if (arg0 == 1) {
					animation = new TranslateAnimation(0, one, 0, 0);
				}
				if (arg0 == 2) {
					animation = new TranslateAnimation(0, two, 0, 0);
				}
				if(arg0==3){
					animation = new TranslateAnimation(0, three, 0, 0);
				}
				if(arg0==4){
					animation = new TranslateAnimation(0, four, 0, 0);
				}
				break;
			case 1:
				if (arg0 == 0) {
					animation = new TranslateAnimation(one, 0, 0, 0);
				}
				if (arg0 == 2) {
					animation = new TranslateAnimation(one, two, 0, 0);
				}
				if (arg0 == 3) {
					animation = new TranslateAnimation(one, three, 0, 0);
				}
				if (arg0 == 4) {
					animation = new TranslateAnimation(one, four, 0, 0);
				}
				break;
			case 2:
				if (arg0 == 1) {
					animation = new TranslateAnimation(two, one, 0, 0);
				}
				if (arg0 == 0) {
					animation = new TranslateAnimation(two, 0, 0, 0);
				}
				if (arg0 == 3) {
					animation = new TranslateAnimation(two, three, 0, 0);
				}
				if (arg0 == 4) {
					animation = new TranslateAnimation(two, four, 0, 0);
				}
			case 3:
				if (arg0 == 0) {
					animation = new TranslateAnimation(three, 0, 0, 0);
				}
				if (arg0 == 1) {
					animation = new TranslateAnimation(three, one, 0, 0);
				}
				if (arg0 == 2) {
					animation = new TranslateAnimation(three, two, 0, 0);
				}
				if (arg0 == 4) {
					animation = new TranslateAnimation(three, four, 0, 0);
				}
				break;
			case 4:
				if (arg0 == 0) {
					animation = new TranslateAnimation(four, 0, 0, 0);
				}
				if (arg0 == 1) {
					animation = new TranslateAnimation(four, one, 0, 0);
				}
				if (arg0 == 2) {
					animation = new TranslateAnimation(four, two, 0, 0);
				}
				if (arg0 == 3) {
					animation = new TranslateAnimation(four, three, 0, 0);
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

package com.huayan.life.Activity;

import java.util.ArrayList;
import java.util.List;

import android.content.res.Configuration;
import android.content.res.Resources;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentActivity;
import android.support.v4.app.FragmentPagerAdapter;
import android.support.v4.view.ViewPager;
import android.support.v4.view.ViewPager.OnPageChangeListener;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageView;
import android.widget.TextView;

import com.huayan.life.view.PageIndicator;

/**
 * 订单管理
 * 
 * @author wzz
 * 
 */
public class OrderActivity extends FragmentActivity implements OnClickListener {

	ViewPager mViewPager;
	TabPageAdapter mTabsAdapter;
	PageIndicator mIndicator;

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_order_manage);
		((ImageView) findViewById(R.id.go_back)).setOnClickListener(this);
		((TextView) findViewById(R.id.header_name)).setText(R.string.yuding);
		initControl();
		initViewPager();
	}

	private void initControl() {
		mViewPager = (ViewPager) findViewById(R.id.vp_ViewPager2);
		mViewPager.setOffscreenPageLimit(2);/* 预加载页面 */
		mIndicator = (PageIndicator) findViewById(R.id.pvr_user_indicator);
		mIndicator.setOnPageChangeListener(new IndicatorOnPageChangedListener());
	}

	/* 初始化ViewPager */
	private void initViewPager() {
		mTabsAdapter = new TabPageAdapter(this);
		mViewPager.setAdapter(mTabsAdapter);
		mIndicator.setViewPager(mViewPager);
		new ContentAsyncTask().execute();
	}

	/* 页卡框架 */
	public class TabPageAdapter extends FragmentPagerAdapter {

		private ArrayList<Fragment> mFragments;
		public List<String> tabs = new ArrayList<String>();

		public TabPageAdapter(OrderActivity activity) {
			super(activity.getSupportFragmentManager());
			mFragments = new ArrayList<Fragment>();
		}

		public void addTab(String title, Fragment fragment) {
			mFragments.add(fragment);
			tabs.add(title);
			notifyDataSetChanged();
		}

		@Override
		public CharSequence getPageTitle(int position) {
			return tabs.get(position);
		}

		@Override
		public Fragment getItem(int arg0) {
			return mFragments.get(arg0);
		}

		@Override
		public int getCount() {
			return mFragments.size();
		}
	}

	public class ContentAsyncTask extends AsyncTask<Integer, Integer, String> {

		@Override
		protected void onPreExecute() {
			// TODO Auto-generated method stub
			super.onPreExecute();
		}

		@Override
		protected void onPostExecute(String result) {
			// TODO Auto-generated method stub    
			mTabsAdapter.addTab(getString(R.string.film_xuan),new MyFragment(OrderActivity.this, 0));
			mTabsAdapter.addTab(getString(R.string.hotel_order),new MyFragment(OrderActivity.this, 1));
			mTabsAdapter.addTab(getString(R.string.non_consumption), new MyFragment(OrderActivity.this, 2));
			mTabsAdapter.addTab(getString(R.string.dai_eva), new MyFragment(OrderActivity.this, 3));
			mTabsAdapter.addTab(getString(R.string.refund), new MyFragment(OrderActivity.this, 4));
			mTabsAdapter.notifyDataSetChanged();
			mViewPager.setCurrentItem(0);
		}

		@Override
		protected String doInBackground(Integer... params) {
			// TODO Auto-generated method stub
			return null;
		}
	}

	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.go_back:
			finish();
			break;
		}
	}

	/* 指示器切换监听 */
	private class IndicatorOnPageChangedListener implements
			OnPageChangeListener {

		@Override
		public void onPageScrollStateChanged(int arg0) {
			// TODO Auto-generated method stub
		}

		@Override
		public void onPageScrolled(int arg0, float arg1, int arg2) {
			// TODO Auto-generated method stub
		}

		@Override
		public void onPageSelected(int arg0) {
			// TODO Auto-generated method stub
		}
	}

	/* 页卡切换监听 */
	public class MyOnPageChangeListener implements OnPageChangeListener {

		@Override
		public void onPageSelected(int arg0) {
		}

		@Override
		public void onPageScrolled(int arg0, float arg1, int arg2) {
		}

		@Override
		public void onPageScrollStateChanged(int arg0) {
		}
	}
	
	/**
	 * app字体不随系统字体的大小改变而改变
	 */
	@Override  
	public Resources getResources() {  
	    Resources res = super.getResources();    
	    Configuration config=new Configuration();    
	    config.setToDefaults();    
	    res.updateConfiguration(config,res.getDisplayMetrics() );  
	    return res;  
	}  

}

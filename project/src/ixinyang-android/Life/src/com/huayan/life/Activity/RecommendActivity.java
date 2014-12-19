package com.huayan.life.Activity;

import java.util.ArrayList;
import java.util.List;
import android.annotation.SuppressLint;
import android.os.Bundle;
import android.os.Handler;
import android.os.Message;
import android.support.v4.view.ViewPager;
import android.support.v4.view.ViewPager.OnPageChangeListener;
import android.view.LayoutInflater;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.ViewGroup;
import android.view.ViewGroup.LayoutParams;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.RelativeLayout;
import com.handmark.pulltorefresh.library.PullToRefreshBase.Mode;
import com.handmark.pulltorefresh.library.PullToRefreshListView;
import com.huayan.life.adapter.AdvAdapter;
import com.huayan.life.adapter.HomePageAdapter;
import com.huayan.life.adapter.MyPagerAdapter;
import com.huayan.life.common.GetData;
import com.huayan.life.common.MyOnRefreshListener3;
import com.huayan.life.view.AdvViewPager;

/**
 * 
 * @author wzz
 *首页
 */
@SuppressLint("HandlerLeak")
public class RecommendActivity extends BaseActivity implements OnClickListener {

	public static final int HTTP_REQUEST_SUCCESS = -1;
	public static final int HTTP_REQUEST_ERROR = 0;

	private ViewPager vpViewPager = null;
	private List<View> views = null;
	private PullToRefreshListView ptrlvHeadLineNews = null;
	private HomePageAdapter newAdapter = null;

	private AdvViewPager vpAdv = null;
	private ViewGroup vg = null;
	private ImageView[] imageViews = null;
	private List<View> advs = null;
	private int currentPage = 0;
	private ImageView imgColse;

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_recommend);

		views = new ArrayList<View>();
		views.add(LayoutInflater.from(this).inflate(R.layout.head_lines, null));
		vpViewPager = (ViewPager) findViewById(R.id.adv_pager);
		vpViewPager.setAdapter(new MyPagerAdapter(views));
		vpViewPager.setOnPageChangeListener(new MyOnPageChangeListener());
		((LinearLayout) findViewById(R.id.ll_city)).setOnClickListener(this);
		((ImageView)findViewById(R.id.iv_search)).setOnClickListener(this);
		
		MyPagerAdapter myPagerAdapter = (MyPagerAdapter) vpViewPager.getAdapter();
		View v1 = myPagerAdapter.getItemAtPosition(0);
		
		ptrlvHeadLineNews = (PullToRefreshListView) v1.findViewById(R.id.ptrlvHeadLineNews);
		newAdapter = new HomePageAdapter(this, GetData.getHomePageList(3));
		initPullToRefreshListView(ptrlvHeadLineNews, newAdapter);
		
		ptrlvHeadLineNews.setOnItemClickListener(new OnItemClickListener() {
			@Override
			public void onItemClick(AdapterView<?> arg0, View view,	int position, long id) {			
				jumpToActivity(RecommendActivity.this,CategoryActivity.class);
			}
		});
	}
	

	/**
	 * 初始化PullToRefreshListView<br>
	 * 初始化在PullToRefreshListView中的ViewPager广告栏
	 * 
	 * @param rtflv
	 * @param adapter
	 */
	private void initPullToRefreshListView(PullToRefreshListView rtflv,HomePageAdapter adapter) {
		rtflv.setMode(Mode.BOTH);
		rtflv.setOnRefreshListener(new MyOnRefreshListener3(rtflv,RecommendActivity.this, newAdapter));
		rtflv.setAdapter(adapter);

		if (rtflv.getId() == R.id.ptrlvHeadLineNews) {
			RelativeLayout rlAdv = (RelativeLayout) LayoutInflater.from(this)
					.inflate(R.layout.sliding_advertisement, null);
			vpAdv = (AdvViewPager) rlAdv.findViewById(R.id.vpAdv);
			vg = (ViewGroup) rlAdv.findViewById(R.id.viewGroup);
			imgColse = (ImageView) rlAdv.findViewById(R.id.img_close);

			advs = new ArrayList<View>();
			ImageView iv;
			iv = new ImageView(this);
			iv.setBackgroundResource(R.drawable.advertising_default_1);
			advs.add(iv);

			iv = new ImageView(this);
			iv.setBackgroundResource(R.drawable.advertising_default_2);
			advs.add(iv);

			iv = new ImageView(this);
			iv.setBackgroundResource(R.drawable.advertising_default_3);
			advs.add(iv);

			iv = new ImageView(this);
			iv.setBackgroundResource(R.drawable.advertising_default);
			advs.add(iv);

			vpAdv.setAdapter(new AdvAdapter(advs));
			vpAdv.setOnPageChangeListener(new OnPageChangeListener() {

				@Override
				public void onPageSelected(int arg0) {
					currentPage = arg0;
					for (int i = 0; i < advs.size(); i++) {
						if (i == arg0) {
							imageViews[i].setBackgroundResource(R.drawable.banner_dian_focus);
						} else {
							imageViews[i].setBackgroundResource(R.drawable.banner_dian_blur);
						}
					}
				}

				@Override
				public void onPageScrolled(int arg0, float arg1, int arg2) {

				}

				@Override
				public void onPageScrollStateChanged(int arg0) {

				}
			});

			imageViews = new ImageView[advs.size()];
			ImageView imageView;
			for (int i = 0; i < advs.size(); i++) {
				imageView = new ImageView(this);
				imageView.setLayoutParams(new LayoutParams(20, 20));
				imageViews[i] = imageView;
				if (i == 0) {
					imageViews[i].setBackgroundResource(R.drawable.banner_dian_focus);
				} else {
					imageViews[i].setBackgroundResource(R.drawable.banner_dian_blur);
				}
				vg.addView(imageViews[i]);
			}

			rtflv.getRefreshableView().addHeaderView(rlAdv, null, false);

			imgColse.setOnClickListener(new OnClickListener() {
				@Override
				public void onClick(View v) {
					imgColse.setVisibility(View.GONE);
					vpAdv.setVisibility(View.GONE);
					vg.setVisibility(View.GONE);
				}
			});

			final Handler handler = new Handler() {
				@Override
				public void handleMessage(Message msg) {
					vpAdv.setCurrentItem(msg.what);
					super.handleMessage(msg);
				}
			};
			new Thread(new Runnable() {

				@Override
				public void run() {
					while (true) {
						try {
							Thread.sleep(5000);
							currentPage++;
							if (currentPage > advs.size() - 1) {
								currentPage = 0;
							}
							handler.sendEmptyMessage(currentPage);
						} catch (InterruptedException e) {
							e.printStackTrace();
						}
					}
				}
			}).start();
		}
	}

	class MyOnPageChangeListener implements OnPageChangeListener {
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

	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.ll_city:
			//城市选择去除  只能选择信阳各个区
			break;
		case R.id.iv_search:
			jumpToActivity(RecommendActivity.this, QueryActivity.class);
			break;
		default:
			break;
		}
	}

}

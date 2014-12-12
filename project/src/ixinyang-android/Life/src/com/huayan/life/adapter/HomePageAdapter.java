package com.huayan.life.adapter;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;

import android.content.Context;
import android.os.Handler;
import android.os.Message;
import android.support.v4.view.ViewPager.OnPageChangeListener;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.ViewGroup.LayoutParams;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import com.huayan.life.Activity.R;
import com.huayan.life.view.AdvViewPager;
import com.nostra13.universalimageloader.core.DisplayImageOptions;
import com.nostra13.universalimageloader.core.ImageLoader;
import com.nostra13.universalimageloader.core.ImageLoaderConfiguration;
import com.nostra13.universalimageloader.core.display.RoundedBitmapDisplayer;

public class HomePageAdapter extends BaseAdapter {

	private Context context;
	private List<HashMap<String, String>> list;
	private List<View> advs = null;
	private ImageLoader imageLoader = null;
	private DisplayImageOptions options = null;
	private int currentPage = 0;
	private ImageView[] imageViews = null;

	public HomePageAdapter(Context context, List<HashMap<String, String>> news) {
		this.context = context;
		this.list = news;
		imageLoader = ImageLoader.getInstance();
		imageLoader.init(ImageLoaderConfiguration.createDefault(context));

		options = new DisplayImageOptions.Builder()
				.displayer(new RoundedBitmapDisplayer(0xff000000, 10))
				.cacheInMemory().cacheOnDisc().build();
	}

	@Override
	public int getCount() {
		return list.size();
	}

	@Override
	public HashMap<String, String> getItem(int position) {
		return list.get(position);
	}

	@Override
	public long getItemId(int position) {
		return position;
	}

	@Override
	public View getView(int position, View convertView, ViewGroup parent) {
		final CacheView cacheView;
		if (convertView == null) {
			convertView = LayoutInflater.from(context).inflate(
					R.layout.item_store_category, null);
			cacheView = new CacheView();
			cacheView.tv_type = (TextView) convertView
					.findViewById(R.id.tv_type);
			cacheView.adv_type = (AdvViewPager) convertView
					.findViewById(R.id.adv_type);
			cacheView.vg_type = (ViewGroup) convertView
					.findViewById(R.id.vg_type);
			convertView.setTag(cacheView);
		} else {
			cacheView = (CacheView) convertView.getTag();
		}
		cacheView.tv_type.setText(getItem(position).get("type"));

		advs = new ArrayList<View>();
		for (int i = 0; i < 3; i++) {
			ImageView iv = new ImageView(context);
			if (i % 3 == 2) {
				iv.setBackgroundResource(R.drawable.advertising_default_3);
			} else if (i % 3 == 1) {
				iv.setBackgroundResource(R.drawable.advertising_default_2);
			} else {
				iv.setBackgroundResource(R.drawable.advertising_default_1);
			}
			advs.add(iv);
		}

		cacheView.adv_type.setAdapter(new AdvAdapter(advs));
		cacheView.adv_type.setOnPageChangeListener(new OnPageChangeListener() {

			@Override
			public void onPageSelected(int arg0) {
				currentPage = arg0;
				for (int i = 0; i < advs.size(); i++) {
					if (i == arg0) {
						imageViews[i]
								.setBackgroundResource(R.drawable.banner_dian_focus);
					} else {
						imageViews[i]
								.setBackgroundResource(R.drawable.banner_dian_blur);
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
			imageView = new ImageView(context);
			imageView.setLayoutParams(new LayoutParams(20, 20));
			imageViews[i] = imageView;
			if (i == 0) {
				imageViews[i]
						.setBackgroundResource(R.drawable.banner_dian_focus);
			} else {
				imageViews[i]
						.setBackgroundResource(R.drawable.banner_dian_blur);
			}
			cacheView.vg_type.addView(imageViews[i]);
		}

		final Handler handler = new Handler() {
			@Override
			public void handleMessage(Message msg) {
				cacheView.adv_type.setCurrentItem(msg.what);
				super.handleMessage(msg);
			}
		};
		new Thread(new Runnable() {

			@Override
			public void run() {
				while (true) {
					try {
						Thread.sleep(10000);
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

		return convertView;
	}

	private static class CacheView {
		TextView tv_type;
		AdvViewPager adv_type;
		ViewGroup vg_type;
	}

	public void addNews(List<HashMap<String, String>> addNews) {
		for (HashMap<String, String> hm : addNews) {
			list.add(hm);
		}
	}
}

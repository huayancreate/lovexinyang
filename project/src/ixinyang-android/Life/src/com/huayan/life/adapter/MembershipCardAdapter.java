package com.huayan.life.adapter;

import java.util.HashMap;
import java.util.List;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import com.huayan.life.Activity.R;
import com.nostra13.universalimageloader.core.DisplayImageOptions;
import com.nostra13.universalimageloader.core.ImageLoader;
import com.nostra13.universalimageloader.core.ImageLoaderConfiguration;
import com.nostra13.universalimageloader.core.display.RoundedBitmapDisplayer;

public class MembershipCardAdapter extends BaseAdapter {

	private Context context;
	private List<HashMap<String, String>> list;

	private ImageLoader imageLoader = null;
	private DisplayImageOptions options = null;

	public MembershipCardAdapter(Context context,
			List<HashMap<String, String>> news) {
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
		CacheView cacheView;
		if (convertView == null) {
			convertView = LayoutInflater.from(context).inflate(R.layout.item_membership_card, null);
			cacheView = new CacheView();
			cacheView.img_icon = (ImageView) convertView.findViewById(R.id.img_icon_store);
			cacheView.tv_title = (TextView) convertView.findViewById(R.id.txt_icon_name);
			cacheView.tv_num = (TextView) convertView.findViewById(R.id.tv_number);
			cacheView.tv_discount = (TextView) convertView.findViewById(R.id.tv_youhui);
			convertView.setTag(cacheView);
		} else {
			cacheView = (CacheView) convertView.getTag();
		}
		imageLoader.displayImage(getItem(position).get("path"),cacheView.img_icon, options);
		cacheView.tv_title.setText(getItem(position).get("title"));
		cacheView.tv_num.setText(getItem(position).get("number"));
		cacheView.tv_discount.setText(getItem(position).get("discount"));
		return convertView;
	}

	private static class CacheView {
		ImageView img_icon;
		TextView tv_title;
		TextView tv_num;
		TextView tv_discount;
	}

	public void addNews(List<HashMap<String, String>> addNews) {
		for (HashMap<String, String> hm : addNews) {
			list.add(hm);
		}
	}
}

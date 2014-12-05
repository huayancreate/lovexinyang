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

public class NewListAdapter extends BaseAdapter {

	private ImageLoader imageLoader = null;
	private DisplayImageOptions options = null;

	static class ViewHolder {
		ImageView ivPreview;
		TextView tvTitle;
		TextView tvContent;
		TextView tvReview;
	}

	private Context context;
	private List<HashMap<String, String>> news;

	public NewListAdapter(Context context, List<HashMap<String, String>> news) {
		this.context = context;
		this.news = news;
		imageLoader = ImageLoader.getInstance();
		imageLoader.init(ImageLoaderConfiguration.createDefault(context));

		options = new DisplayImageOptions.Builder()
				.displayer(new RoundedBitmapDisplayer(0xff000000, 10))
				.cacheInMemory().cacheOnDisc().build();
	}

	@Override
	public int getCount() {
		return news.size();
	}

	@Override
	public HashMap<String, String> getItem(int position) {
		return news.get(position);
	}

	@Override
	public long getItemId(int position) {
		return position;
	}

	@Override
	public View getView(int position, View convertView, ViewGroup parent) {

		ViewHolder holder = null;
		if (convertView == null) {
			convertView = LayoutInflater.from(context).inflate(
					R.layout.item_news, null);
			holder = new ViewHolder();
			holder.ivPreview = (ImageView) convertView
					.findViewById(R.id.ivPreview);
			holder.tvTitle = (TextView) convertView.findViewById(R.id.tvTitle);
			holder.tvContent = (TextView) convertView
					.findViewById(R.id.tvContent);
			holder.tvReview = (TextView) convertView
					.findViewById(R.id.tvReview);
			convertView.setTag(holder);
		} else {
			holder = (ViewHolder) convertView.getTag();
		}

		imageLoader.displayImage(getItem(position).get("uri"),holder.ivPreview, options);
		holder.tvTitle.setText(getItem(position).get("title"));
		holder.tvContent.setText(getItem(position).get("content"));
		holder.tvReview.setText(getItem(position).get("review"));

		return convertView;
	}

	public void addNews(List<HashMap<String, String>> addNews) {
		for (HashMap<String, String> hm : addNews) {
			news.add(hm);
		}
	}

}

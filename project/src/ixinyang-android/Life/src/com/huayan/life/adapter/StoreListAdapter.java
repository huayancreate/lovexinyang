package com.huayan.life.adapter;

import java.util.HashMap;
import java.util.List;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.RatingBar;
import android.widget.TextView;

import com.huayan.life.Activity.R;
import com.nostra13.universalimageloader.core.DisplayImageOptions;
import com.nostra13.universalimageloader.core.ImageLoader;
import com.nostra13.universalimageloader.core.ImageLoaderConfiguration;
import com.nostra13.universalimageloader.core.display.RoundedBitmapDisplayer;

public class StoreListAdapter extends BaseAdapter {

	private ImageLoader imageLoader = null;
	private DisplayImageOptions options = null;

	static class ViewHolder {
		ImageView img_Icon;
		TextView tvTitle;
		RatingBar rbBar;
		TextView tvPing;
		TextView tvCategory;
		TextView tvQu;
		TextView tvJu;
	}

	private Context context;
	private List<HashMap<String, String>> news;

	public StoreListAdapter(Context context, List<HashMap<String, String>> list) {
		this.context = context;
		this.news = list;
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
			convertView = LayoutInflater.from(context).inflate(R.layout.item_store, null);
			holder = new ViewHolder();
			holder.img_Icon = (ImageView) convertView.findViewById(R.id.img_biao_icon);
			holder.tvTitle = (TextView) convertView.findViewById(R.id.txt_biao_title);
			holder.rbBar = (RatingBar) convertView.findViewById(R.id.rtb_item_store);
			holder.tvPing = (TextView) convertView.findViewById(R.id.tv_biao_pingjia);
			holder.tvCategory = (TextView) convertView.findViewById(R.id.tv_biao_cate);
			holder.tvQu = (TextView) convertView.findViewById(R.id.tv_biao_lu);
			holder.tvJu = (TextView) convertView.findViewById(R.id.tv_biao_near);
			convertView.setTag(holder);
		} else {
			holder = (ViewHolder) convertView.getTag();
		}

		imageLoader.displayImage(getItem(position).get("uri"), holder.img_Icon,options);
		holder.rbBar.setRating(Float.parseFloat(getItem(position).get("rab")));
		holder.tvPing.setText(getItem(position).get("ping"));
		holder.tvTitle.setText(getItem(position).get("title1"));
		holder.tvCategory.setText(getItem(position).get("cate"));
		holder.tvQu.setText(getItem(position).get("qu"));
		holder.tvJu.setText(getItem(position).get("ju"));
		return convertView;

	}

	public void addNews(List<HashMap<String, String>> addNews) {
		for (HashMap<String, String> hm : addNews) {
			news.add(hm);
		}
	}

}

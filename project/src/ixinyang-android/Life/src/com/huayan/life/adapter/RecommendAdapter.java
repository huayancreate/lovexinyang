package com.huayan.life.adapter;

import java.util.HashMap;
import java.util.List;

import android.content.Context;
import android.graphics.Paint;
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

public class RecommendAdapter extends BaseAdapter {

	private Context context;
	private List<HashMap<String, String>> list;

	private ImageLoader imageLoader = null;
	private DisplayImageOptions options = null;

	public RecommendAdapter(Context context, List<HashMap<String, String>> news) {
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
	public HashMap<String,String> getItem(int position) {
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
			convertView = LayoutInflater.from(context).inflate(R.layout.item_near_tuan_gou, null);
			cacheView = new CacheView();
			cacheView.img_icon = (ImageView) convertView.findViewById(R.id.img_icon_con);
			cacheView.tv_title = (TextView) convertView.findViewById(R.id.txt_icon_title);
			cacheView.tv_near=(TextView)convertView.findViewById(R.id.tv_juli);
			cacheView.tv_des = (TextView) convertView.findViewById(R.id.tv_content);
			cacheView.tv_price = (TextView) convertView.findViewById(R.id.tv_jiage);
			cacheView.tv_oldPrice = (TextView) convertView.findViewById(R.id.tv_old_jiage);
			cacheView.tv_fen=(TextView) convertView.findViewById(R.id.tv_defen);
			convertView.setTag(cacheView);
		} else {
			cacheView = (CacheView) convertView.getTag();
		}
		imageLoader.displayImage(getItem(position).get("path"), cacheView.img_icon, options);
		cacheView.tv_des.setText(getItem(position).get("descr"));
		cacheView.tv_title.setText(getItem(position).get("tit"));
		cacheView.tv_near.setText(getItem(position).get("near"));
		cacheView.tv_price.setText(getItem(position).get("price"));
		cacheView.tv_oldPrice.setText(getItem(position).get("oldPrice"));
		cacheView.tv_fen.setText("已售"+getItem(position).get("yishou"));
		
		cacheView.tv_oldPrice.getPaint().setFlags(Paint. STRIKE_THRU_TEXT_FLAG ); //中间横线
		return convertView;
	}

	private static class CacheView {
		ImageView img_icon;
		TextView tv_title;
		TextView tv_near;
		TextView tv_des;
		TextView tv_price;
		TextView tv_oldPrice;
		TextView tv_fen;
	}
	
	public void addNews(List<HashMap<String, String>> addNews) {
		for (HashMap<String, String> hm : addNews) {
			list.add(hm);
		}
	}
}

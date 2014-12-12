package com.huayan.life.adapter;

import java.util.HashMap;
import java.util.List;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;

import com.huayan.life.Activity.R;
import com.nostra13.universalimageloader.core.DisplayImageOptions;
import com.nostra13.universalimageloader.core.ImageLoader;
import com.nostra13.universalimageloader.core.ImageLoaderConfiguration;
import com.nostra13.universalimageloader.core.display.RoundedBitmapDisplayer;

public class StoreAlbumAdapter extends BaseAdapter {

	private Context context;
	private List<HashMap<String, String>> list;
	private ImageLoader imageLoader = null;
	private DisplayImageOptions options = null;

	public StoreAlbumAdapter(Context context, List<HashMap<String, String>> list) {
		this.context = context;
		this.list = list;

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
			convertView = LayoutInflater.from(context).inflate(R.layout.item_store_image, null);
			cacheView = new CacheView();
			cacheView.img_sto_album = (ImageView) convertView.findViewById(R.id.img_store_album);
			convertView.setTag(cacheView);
		} else {
			cacheView = (CacheView) convertView.getTag();
		}
		imageLoader.displayImage(getItem(position).get("uri"),cacheView.img_sto_album, options);
		return convertView;
	}

	private static class CacheView {
		ImageView img_sto_album;
	}

}

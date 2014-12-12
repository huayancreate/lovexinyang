package com.huayan.life.adapter;

import java.util.List;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;

import com.huayan.life.Activity.R;
import com.huayan.life.model.AlbumImage;

public class GridImageAdapter extends BaseAdapter {

	private Context context;
	private List<AlbumImage> list;

	public GridImageAdapter(Context context, List<AlbumImage> list) {
		this.context = context;
		this.list = list;
	}

	@Override
	public int getCount() {
		return list.size();
	}

	@Override
	public Object  getItem(int position) {
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
			convertView = LayoutInflater.from(context).inflate(R.layout.item_grid_image, null);
			cacheView = new CacheView();
			cacheView.img_mapping = (ImageView) convertView.findViewById(R.id.child_image);
			convertView.setTag(cacheView);
		} else {
			cacheView = (CacheView) convertView.getTag();
		}
		cacheView.img_mapping.setImageDrawable(list.get(position).getImgurl());
		
		return convertView;
	}

	private static class CacheView {
		ImageView img_mapping;		
	}
	
}

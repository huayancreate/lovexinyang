package com.huayan.life.adapter;

import java.util.List;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import com.huayan.life.Activity.R;
import com.huayan.life.model.AlbumImage;

public class AlbumAdapter extends BaseAdapter {

	private List<AlbumImage> list;
	LayoutInflater inflater;

	public AlbumAdapter(Context context, List<AlbumImage> list) {
		this.list = list;
		this.inflater = LayoutInflater.from(context);
	}

	@Override
	public int getCount() {
		return list.size();
	}

	@Override
	public Object getItem(int position) {
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
			convertView = inflater.inflate(R.layout.item_gallery, null);
			cacheView = new CacheView();
			cacheView.img_albumView = (ImageView) convertView
					.findViewById(R.id.img_gy_alb);
			cacheView.tv_title = (TextView) convertView
					.findViewById(R.id.tv_title);
			cacheView.tv_pageNum = (TextView) convertView
					.findViewById(R.id.tv_page);	
			convertView.setTag(cacheView);
		} else {
			cacheView = (CacheView) convertView.getTag();
		}
		cacheView.img_albumView.setImageDrawable(list.get(position).getImgurl());
		cacheView.tv_title.setText(list.get(position).getTitle());
		String pageNum = position + 1 + "/" + list.size();
		cacheView.tv_pageNum.setText(pageNum);
		return convertView;
	}

	private static class CacheView {
		ImageView img_albumView;
		TextView tv_title;
		TextView tv_pageNum;
	}
}

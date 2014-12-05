package com.huayan.life.adapter;

import java.util.HashMap;
import java.util.List;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import com.huayan.life.Activity.R;

public class NoticeAdapter extends BaseAdapter {


	static class ViewHolder {
		TextView tvTitle;
		TextView tvTime;
	}

	private Context context;
	private List<HashMap<String, String>> news;

	public NoticeAdapter(Context context, List<HashMap<String, String>> list) {
		this.context = context;
		this.news = list;
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
			convertView = LayoutInflater.from(context).inflate(R.layout.item_notice, null);
			holder = new ViewHolder();
			holder.tvTitle = (TextView) convertView.findViewById(R.id.tv_notice_title);
			holder.tvTime = (TextView) convertView.findViewById(R.id.tv_notice_time);
			convertView.setTag(holder);
		} else {
			holder = (ViewHolder) convertView.getTag();
		}
		holder.tvTitle.setText(getItem(position).get("title"));
		holder.tvTime.setText(getItem(position).get("time"));
		return convertView;
	}

	public void addNews(List<HashMap<String, String>> addNews) {
		for (HashMap<String, String> hm : addNews) {
			news.add(hm);
		}
	}
	
}

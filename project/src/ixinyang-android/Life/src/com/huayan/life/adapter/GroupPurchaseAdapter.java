package com.huayan.life.adapter;

import java.util.HashMap;
import java.util.List;

import android.content.Context;
import android.graphics.Paint;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import com.huayan.life.Activity.R;

public class GroupPurchaseAdapter extends BaseAdapter {


	static class ViewHolder {
		TextView tvTitle;
		TextView tvPrice;
		TextView tvOldPrice;
	}

	private Context context;
	private List<HashMap<String, String>> news;

	public GroupPurchaseAdapter(Context context, List<HashMap<String, String>> list) {
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
			convertView = LayoutInflater.from(context).inflate(R.layout.item_group_purchase_recommendation, null);
			holder = new ViewHolder();
			holder.tvTitle = (TextView) convertView.findViewById(R.id.tv_re_title);
			holder.tvPrice = (TextView) convertView.findViewById(R.id.tv_lanjia);
			holder.tvOldPrice = (TextView) convertView.findViewById(R.id.tv_old_lanjia);
			convertView.setTag(holder);
		} else {
			holder = (ViewHolder) convertView.getTag();
		}
		holder.tvTitle.setText(getItem(position).get("title"));
		holder.tvPrice.setText(getItem(position).get("price"));
		holder.tvOldPrice.setText(getItem(position).get("oldprice"));
		holder.tvOldPrice.getPaint().setFlags(Paint. STRIKE_THRU_TEXT_FLAG ); //÷–º‰∫·œﬂ
		return convertView;
	}

}

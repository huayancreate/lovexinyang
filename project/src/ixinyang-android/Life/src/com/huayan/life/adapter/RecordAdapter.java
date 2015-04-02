package com.huayan.life.adapter;

import java.util.List;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import com.huayan.life.R;
import com.huayan.life.model.ConsumerList;

public class RecordAdapter extends BaseAdapter {

	private Context context;
	private List<ConsumerList> news;

	public RecordAdapter(Context context, List<ConsumerList> list) {
		this.context = context;
		this.news = list;
	}

	@Override
	public int getCount() {
		return news.size();
	}

	@Override
	public ConsumerList getItem(int position) {
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
			convertView = LayoutInflater.from(context).inflate(R.layout.item_card_record, null);
			holder = new ViewHolder();
			holder.tvAddress= (TextView) convertView.findViewById(R.id.tv_consume_address);
			holder.tvMoney=(TextView)convertView.findViewById(R.id.tv_consume_money);
			holder.tvTime = (TextView) convertView.findViewById(R.id.tv_consume_time);
			convertView.setTag(holder);
		} else {
			holder = (ViewHolder) convertView.getTag();
		}
		ConsumerList consumer=news.get(position);
		holder.tvAddress.setText(consumer.getBranchShopName());
		holder.tvMoney.setText("гд"+consumer.getMoney());
		holder.tvTime.setText(consumer.getTime());
		return convertView;
	}

	static class ViewHolder {
		TextView tvAddress;
		TextView tvTime;
		TextView tvMoney;
	}
	
}

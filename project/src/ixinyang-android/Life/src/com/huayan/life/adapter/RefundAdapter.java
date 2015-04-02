package com.huayan.life.adapter;

import java.util.List;

import android.annotation.SuppressLint;
import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.CheckBox;
import android.widget.TextView;

import com.huayan.life.R;

@SuppressLint("UseSparseArrays")
public class RefundAdapter extends BaseAdapter {

	private Context context;
	private List<String> news;

	public RefundAdapter(Context context, List<String> list) {
		this.context = context;
		this.news = list;
	}
	
	@Override
	public int getCount() {
		return news.size();
	}

	@Override
	public String getItem(int position) {
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
			convertView = LayoutInflater.from(context).inflate(R.layout.item_refund_codes, null);
			holder = new ViewHolder();
			holder.tvCode= (TextView) convertView.findViewById(R.id.tv_quan1);
			holder.cbSelect=(CheckBox)convertView.findViewById(R.id.cb_ma);
			convertView.setTag(holder);
		} else {
			holder = (ViewHolder) convertView.getTag();
		}
		
		final String code=news.get(position);
		holder.tvCode.setText("ȯ�룺"+code);
		holder.cbSelect.setChecked(false);
		return convertView;
	}

	static class ViewHolder {
		TextView tvCode;
		CheckBox cbSelect;
	}
	
}

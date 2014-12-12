package com.huayan.life.adapter;

import java.util.ArrayList;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import com.huayan.life.Activity.R;

public class HotAdapter extends BaseAdapter {

	private Context context;
	private ArrayList<String> itemList;

	public HotAdapter(Context context, ArrayList<String> item) {
		this.context = context;
		this.itemList = item;
	}

	@Override
	public int getCount() {
		return itemList.size();
	}

	@Override
	public Object getItem(int position) {
		return itemList.get(position);
	}

	@Override
	public long getItemId(int position) {
		return position;
	}

	@Override
	public View getView(int position, View convertView, ViewGroup parent) {
		Datalist data = new Datalist();
		convertView = LayoutInflater.from(context).inflate(R.layout.hot_item,null);
		data.mNameTextView = (TextView) convertView.findViewById(R.id.txt_hot_name);
		data.mNameTextView.setText(itemList.get(position));
		return convertView;
	}

	private class Datalist {
		public TextView mNameTextView;
	}

}

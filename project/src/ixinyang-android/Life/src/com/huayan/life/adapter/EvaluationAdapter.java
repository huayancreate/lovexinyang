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

public class EvaluationAdapter extends BaseAdapter {
	private Context context;
	private List<HashMap<String, String>> list;


	public EvaluationAdapter(Context context, List<HashMap<String, String>> news) {
		this.context = context;
		this.list = news;
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
			convertView = LayoutInflater.from(context).inflate(R.layout.item_evaluation, null);
			cacheView = new CacheView();
			cacheView.img_rank = (ImageView) convertView.findViewById(R.id.img_rank);
			cacheView.tv_nickname= (TextView) convertView.findViewById(R.id.tv_nickname);
			cacheView.tv_date=(TextView)convertView.findViewById(R.id.tv_date);
			cacheView.tv_des = (TextView) convertView.findViewById(R.id.tv_evaluation_content);
			cacheView.tv_rating = (RatingBar) convertView.findViewById(R.id.rtb_rating);
			convertView.setTag(cacheView);
		} else {
			cacheView = (CacheView) convertView.getTag();
		}
		cacheView.tv_des.setText(getItem(position).get("des"));
		cacheView.tv_nickname.setText(getItem(position).get("nickname"));
		cacheView.tv_date.setText(getItem(position).get("date"));
		cacheView.tv_rating.setRating(Float.parseFloat(getItem(position).get("rating")));
		cacheView.img_rank.setImageResource(R.drawable.ic_user_growth_1);
		
		return convertView;
	}

	private static class CacheView {
		ImageView img_rank;
		TextView tv_nickname;
		TextView tv_date;
		RatingBar tv_rating;
		TextView tv_des;
	}
	
	public void addNews(List<HashMap<String, String>> addNews) {
		for (HashMap<String, String> hm : addNews) {
			list.add(hm);
		}
	}
	
}

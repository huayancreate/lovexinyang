package com.huayan.life.adapter;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;

import android.content.Context;
import android.content.Intent;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.RatingBar;
import android.widget.TextView;
import android.widget.TextView.BufferType;

import com.huayan.life.Activity.EvaPicActivity;
import com.huayan.life.R;
import com.huayan.life.model.AlbumImage;
import com.huayan.life.view.CollapsibleTextView;
import com.huayan.life.view.MyGridView;

public class EvaluationAdapter extends BaseAdapter {
	private Context context;
	private List<HashMap<String, String>> list;
	GridImageAdapter adapter;

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
			cacheView.tv_des = (CollapsibleTextView) convertView.findViewById(R.id.tv_evaluation_content);
			cacheView.tv_rating = (RatingBar) convertView.findViewById(R.id.rtb_rating);
			cacheView.gv_mapping=(MyGridView)convertView.findViewById(R.id.gv_mapping);
			cacheView.tv_pic_num=(TextView)convertView.findViewById(R.id.tv_pic_num);
			convertView.setTag(cacheView);
		} else {
			cacheView = (CacheView) convertView.getTag();
		}
		cacheView.tv_des.setDesc( getItem(position).get("des"),BufferType.NORMAL); 
		cacheView.tv_nickname.setText(getItem(position).get("nickname"));
		cacheView.tv_date.setText(getItem(position).get("date"));
		cacheView.tv_rating.setRating(Float.parseFloat(getItem(position).get("rating")));
		cacheView.img_rank.setImageResource(R.drawable.ic_user_growth_1);
		List<AlbumImage> imgList = new ArrayList<AlbumImage>();
		AlbumImage img;
		for (int i = 1; i < 7; i++) {
			img = new AlbumImage();
			if(i%2==1){
			img.setTitle(i+ ".wzz 上传于 2014-12-11");
			img.setImgurl("http://img.taobaocdn.com/bao/uploaded/i2/18783042962806492/TB2HqSYXVXXXXXDXXXXXXXXXXXX_!!1060668783-0-rate.jpg");
			}else{
				img.setTitle(i+ ".wzz 上传于 2014-12-11");
				img.setImgurl("http://img.taobaocdn.com/bao/uploaded/i2/18783042962806492/TB2HqSYXVXXXXXDXXXXXXXXXXXX_!!1060668783-0-rate.jpg");			}
			imgList.add(img);
		}
		adapter=new GridImageAdapter(context, imgList);
		cacheView.gv_mapping.setAdapter(adapter);		
		cacheView.tv_pic_num.setText("共7张");
		
		cacheView.gv_mapping.setOnItemClickListener(new OnItemClickListener() {
			@Override
			public void onItemClick(AdapterView<?> parent, View view, int arg2,long arg3) {
				// TODO jump 
				Intent mIntent = new Intent(context, EvaPicActivity.class);
//				mIntent.putExtra("Eva",eva);
				context.startActivity(mIntent);
			}
		});
		
		return convertView;
	}

	private static class CacheView {
		ImageView img_rank;
		TextView tv_nickname;
		TextView tv_date;
		RatingBar tv_rating;
		CollapsibleTextView tv_des;
		MyGridView gv_mapping;
		TextView tv_pic_num;
	}
	
	public void addNews(List<HashMap<String, String>> addNews) {
		for (HashMap<String, String> hm : addNews) {
			list.add(hm);
		}
	}
	
}

package com.huayan.life.adapter;

import java.util.List;

import android.content.Context;
import android.content.Intent;
import android.view.LayoutInflater;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import com.huayan.life.Activity.GroupPurchaseActivity;
import com.huayan.life.R;
import com.huayan.life.Activity.StoreDetailActivity;
import com.huayan.life.model.Notice;

public class NoticeAdapter extends BaseAdapter {

	private Context context;
	private List<Notice> news;

	public NoticeAdapter(Context context, List<Notice> list) {
		this.context = context;
		this.news = list;
	}

	@Override
	public int getCount() {
		return news.size();
	}

	@Override
	public Notice getItem(int position) {
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
		Notice notice=news.get(position);		
		holder.tvTitle.setText(notice.getContent());
		holder.tvTime.setText(notice.getTime());	
		final int type=notice.getType();//类别（1商品，2商家，0系统消息）
		final int Id=notice.getID();
				
		convertView.setOnClickListener(new OnClickListener() {			
			@Override
			public void onClick(View v) {
				if(type==1){
					Intent intent = new Intent(context,StoreDetailActivity.class);
					intent.putExtra("shopID", Id);
					context.startActivity(intent);
				}else if(type==2){
					Intent intent = new Intent(context,GroupPurchaseActivity.class);
					intent.putExtra("goodsID", Id);
					context.startActivity(intent);
				}
			}
		});
		return convertView;
	}

	static class ViewHolder {
		TextView tvTitle;
		TextView tvTime;
	}
	
	public void addNews(List<Notice> addNews) {
		for (Notice hm : addNews) {
			news.add(hm);
		}
	}
	
}

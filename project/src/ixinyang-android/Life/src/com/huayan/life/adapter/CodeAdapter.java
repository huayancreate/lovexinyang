package com.huayan.life.adapter;

import java.util.List;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import com.huayan.life.R;
import com.huayan.life.model.Codes;

public class CodeAdapter extends BaseAdapter {

	private Context context;
	private List<Codes> news;
	int type; //1»ÒÉ«  2ºìÉ« 3ÂÌÉ«

	public CodeAdapter(Context context, List<Codes> list,int type) {
		this.context = context;
		this.news = list;
		this.type=type;
	}

	@Override
	public int getCount() {
		return news.size();
	}

	@Override
	public Codes getItem(int position) {
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
			convertView = LayoutInflater.from(context).inflate(R.layout.item_code, null);
			holder = new ViewHolder();
			holder.tvCode= (TextView) convertView.findViewById(R.id.tv_code_yan);
			holder.tvStatus=(TextView)convertView.findViewById(R.id.tv_used);
			holder.line=(ImageView)convertView.findViewById(R.id.img_line44);
			holder.tv_refund_details=(TextView)convertView.findViewById(R.id.tv_refund_details);
			convertView.setTag(holder);
		} else {
			holder = (ViewHolder) convertView.getTag();
		}
		Codes code=news.get(position);
		
		holder.tvCode.setText("È¯Âë0"+(position+1)+"£º"+code.getGoodsPassword());
		holder.tvStatus.setText(code.getStatus());
		if(type==1){
			holder.tvStatus.setTextColor(context.getResources().getColor(R.color.text_color_gray));
			holder.line.setVisibility(View.GONE);
			holder.tv_refund_details.setVisibility(View.GONE);
		}else if(type==2){
			holder.tvStatus.setTextColor(context.getResources().getColor(R.color.text_red));
			holder.line.setVisibility(View.VISIBLE);
			holder.tv_refund_details.setVisibility(View.VISIBLE);
		}else if(type==3){
			holder.tvStatus.setTextColor(context.getResources().getColor(R.color.nonConsumptionColor));
			holder.line.setVisibility(View.GONE);
			holder.tv_refund_details.setVisibility(View.GONE);
		}
		return convertView;
	}

	static class ViewHolder {
		TextView tvCode;
		TextView tvStatus;
		ImageView line;
		TextView tv_refund_details;
	}
	
}

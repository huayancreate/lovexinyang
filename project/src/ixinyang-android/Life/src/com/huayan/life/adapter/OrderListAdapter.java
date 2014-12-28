package com.huayan.life.adapter;

import java.util.HashMap;
import java.util.List;

import android.annotation.SuppressLint;
import android.content.Context;
import android.content.Intent;
import android.view.LayoutInflater;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import com.huayan.life.Activity.EvaluationActivity;
import com.huayan.life.Activity.R;
import com.huayan.life.Activity.SubmitOrderActivity;
import com.nostra13.universalimageloader.core.DisplayImageOptions;
import com.nostra13.universalimageloader.core.ImageLoader;
import com.nostra13.universalimageloader.core.ImageLoaderConfiguration;
import com.nostra13.universalimageloader.core.display.RoundedBitmapDisplayer;

@SuppressLint("ResourceAsColor")
public class OrderListAdapter extends BaseAdapter  {

	private ImageLoader imageLoader = null;
	private DisplayImageOptions options = null;
	private Context context;
	private List<HashMap<String, String>> news;

	public OrderListAdapter(Context context, List<HashMap<String, String>> news) {
		this.context = context;
		this.news = news;
		imageLoader = ImageLoader.getInstance();
		imageLoader.init(ImageLoaderConfiguration.createDefault(context));

		options = new DisplayImageOptions.Builder()
				.displayer(new RoundedBitmapDisplayer(0xff000000, 10))
				.cacheInMemory().cacheOnDisc().build();
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
			convertView = LayoutInflater.from(context).inflate(R.layout.item_orders, null);
			holder = new ViewHolder();
			holder.ivPreview = (ImageView) convertView.findViewById(R.id.img_order_icon);
			holder.tvTitle = (TextView) convertView.findViewById(R.id.txt_order_title);
			holder.tvPrice= (TextView) convertView.findViewById(R.id.tv_order_price);
			holder.tvNum = (TextView) convertView.findViewById(R.id.tv_order_number);
			holder.tvCate=(TextView)convertView.findViewById(R.id.tv_order_category);
			holder.tvBut=(TextView)convertView.findViewById(R.id.tv_order_pay);
			convertView.setTag(holder);
		} else {
			holder = (ViewHolder) convertView.getTag();
		}

		imageLoader.displayImage(getItem(position).get("uri"),holder.ivPreview, options);
		holder.tvTitle.setText(getItem(position).get("title"));
		holder.tvPrice.setText("总价："+getItem(position).get("price"));
		holder.tvNum.setText("数量："+getItem(position).get("num"));
		
		if(getItem(position).get("cate").equals(context.getResources().getString(R.string.pending_payment))){//待付款
			holder.tvCate.setText(getItem(position).get("cate"));
			holder.tvCate.setTextColor(context.getResources().getColor(R.color.text_green));
			holder.tvBut.setVisibility(View.VISIBLE);			
			holder.tvBut.setText(context.getResources().getString(R.string.payment));
			holder.tvBut.setOnClickListener(new OnClickListener() {				
				@Override
				public void onClick(View v) {
					// TODO 提交订单
					Intent intent = new Intent(context, SubmitOrderActivity.class);
					context.startActivity(intent);
				}
			});
		}else if(getItem(position).get("cate").equals(context.getResources().getString(R.string.evaluated))){ //已评价
			holder.tvCate.setText(getItem(position).get("cate")+" "+getItem(position).get("score"));
			holder.tvCate.setTextColor(context.getResources().getColor(R.color.orange_text));
			holder.tvBut.setVisibility(View.GONE);
		}else if(getItem(position).get("cate").equals(context.getResources().getString(R.string.dai_eva))){ //待评价
			holder.tvCate.setText(getItem(position).get("cate"));
			holder.tvCate.setTextColor(context.getResources().getColor(R.color.text_green));
			holder.tvBut.setVisibility(View.VISIBLE);			
			holder.tvBut.setText(context.getResources().getString(R.string.eva));
			holder.tvBut.setOnClickListener(new OnClickListener() {				
				@Override
				public void onClick(View v) {
					// TODO 评价界面
					Intent intent = new Intent(context, EvaluationActivity.class);
					context.startActivity(intent);
				}
			});
		}else  if(getItem(position).get("cate").equals(context.getResources().getString(R.string.yi_refund))){ //已退款
			holder.tvCate.setText(getItem(position).get("cate"));
			holder.tvCate.setTextColor(context.getResources().getColor(R.color.viewfinder_mask));
			holder.tvBut.setVisibility(View.GONE);			
		}else  if(getItem(position).get("cate").equals(context.getResources().getString(R.string.non_consumption))){ //未消费
			holder.tvCate.setText(getItem(position).get("cate"));
			holder.tvCate.setTextColor(context.getResources().getColor(R.color.nonConsumptionColor));
			holder.tvBut.setVisibility(View.VISIBLE);			
			holder.tvBut.setText(R.string.collect);
		}else  if(getItem(position).get("cate").equals(context.getResources().getString(R.string.refunding))){ //退款中
			holder.tvCate.setText(getItem(position).get("cate"));
			holder.tvCate.setTextColor(context.getResources().getColor(R.color.viewfinder_mask));
			holder.tvBut.setVisibility(View.VISIBLE);			
			holder.tvBut.setText(R.string.collect);
		}

		return convertView;
	}

	private static class ViewHolder {
		ImageView ivPreview;
		TextView tvTitle;
		TextView tvPrice;
		TextView tvNum;
		TextView tvCate;
		TextView tvBut;
	}
	
	public void addNews(List<HashMap<String, String>> addNews) {
		for (HashMap<String, String> hm : addNews) {
			news.add(hm);
		}
	}

}

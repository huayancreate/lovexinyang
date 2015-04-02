package com.huayan.life.adapter;

import java.util.List;

import android.annotation.SuppressLint;
import android.content.Context;
import android.content.Intent;
import android.graphics.Bitmap;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import com.huayan.life.Activity.EvaluationActivity;
import com.huayan.life.Activity.PaymentOrderActivity;
import com.huayan.life.R;
import com.huayan.life.model.Order;
import com.nostra13.universalimageloader.cache.memory.impl.WeakMemoryCache;
import com.nostra13.universalimageloader.core.DisplayImageOptions;
import com.nostra13.universalimageloader.core.ImageLoader;
import com.nostra13.universalimageloader.core.ImageLoaderConfiguration;
import com.nostra13.universalimageloader.core.assist.ImageScaleType;
import com.nostra13.universalimageloader.core.assist.QueueProcessingType;
import com.nostra13.universalimageloader.core.display.RoundedBitmapDisplayer;

@SuppressLint("ResourceAsColor")
public class OrderListAdapter extends BaseAdapter  {

	private ImageLoader imageLoader = null;
	private DisplayImageOptions options = null;
	private Context context;
	private List<Order> news;

	@SuppressWarnings("deprecation")
	public OrderListAdapter(Context context, List<Order> news) {
		this.context = context;
		this.news = news;
		imageLoader = ImageLoader.getInstance();
		ImageLoaderConfiguration config = new ImageLoaderConfiguration.Builder(
				context)
				.memoryCacheExtraOptions(480, 800)//即保存的每个缓存文件的最大长宽
				.threadPoolSize(3)// 线程池内加载的数量
				.threadPriority(Thread.NORM_PRIORITY - 2)
				.denyCacheImageMultipleSizesInMemory()
				.memoryCache(new WeakMemoryCache())
				.memoryCacheSize(2 * 1024 * 1024)
				.writeDebugLogs() // Remove for release app
				.tasksProcessingOrder(QueueProcessingType.LIFO).build();
		imageLoader.init(config);

		options = new DisplayImageOptions.Builder()
				.showImageOnLoading(R.drawable.pic)// 设置图片在下载期间显示的图片
				.showImageForEmptyUri(R.drawable.pic)	// 设置图片Uri为空或是错误的时候显示的图片
				.showImageOnFail(R.drawable.pic)// 设置图片加载/解码过程中错误时候显示的图片
				.displayer(new RoundedBitmapDisplayer(0xff000000, 10))
				.bitmapConfig(Bitmap.Config.RGB_565)
				.imageScaleType(ImageScaleType.IN_SAMPLE_INT)
				.cacheOnDisc(true)
				.build();
	}

	@Override
	public int getCount() {
		return news.size();
	}

	@Override
	public Order getItem(int position) {
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

		final Order order=news.get(position);

		imageLoader.displayImage(order.getGoodsImg(),holder.ivPreview, options);
		holder.tvTitle.setText(order.getName());
		holder.tvPrice.setText("￥"+order.getPrice());
		holder.tvNum.setText(""+order.getNum());
		String type=order.getTypeName();
		int isBookmark=order.getIsBookmark();
		
		if(type.equals(context.getResources().getString(R.string.pending_payment))){//待付款
			holder.tvCate.setText(type);
			holder.tvCate.setTextColor(context.getResources().getColor(R.color.text_green));
			holder.tvBut.setVisibility(View.VISIBLE);			
			holder.tvBut.setText(context.getResources().getString(R.string.payment));
			holder.tvBut.setOnClickListener(new OnClickListener() {				
				@Override
				public void onClick(View v) {
					// 支付订单(修改订单)
					Intent intent = new Intent(context, PaymentOrderActivity.class);
					Bundle bundle = new Bundle();
					bundle.putSerializable("submit_order", order);
					intent.putExtras(bundle);
					context.startActivity(intent);
				}
			});
		}else if(type.equals(context.getResources().getString(R.string.evaluated))){ //已评价
			holder.tvCate.setText(type+" "+order.getCommentScore()+"分");
			holder.tvCate.setTextColor(context.getResources().getColor(R.color.orange_text));
			holder.tvBut.setVisibility(View.GONE);
		}else if(type.equals(context.getResources().getString(R.string.dai_eva))){ //待评价
			holder.tvCate.setText(type);
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
		}else  if(type.equals(context.getResources().getString(R.string.yi_refund))){ //已退款
			holder.tvCate.setText(type);
			holder.tvCate.setTextColor(context.getResources().getColor(R.color.viewfinder_mask));
			holder.tvBut.setVisibility(View.GONE);			
		}else  if(type.equals(context.getResources().getString(R.string.non_consumption))){ //未消费
			holder.tvCate.setText(type);
			holder.tvCate.setTextColor(context.getResources().getColor(R.color.nonConsumptionColor));
			holder.tvBut.setVisibility(View.VISIBLE);			
			if(isBookmark==0){
				holder.tvBut.setText(R.string.collect);
			}else if(isBookmark==1){
				holder.tvBut.setText(R.string.yi_shoucang);
			}
		}else  if(type.equals(context.getResources().getString(R.string.refunding))){ //退款中
			holder.tvCate.setText(type);
			holder.tvCate.setTextColor(context.getResources().getColor(R.color.viewfinder_mask));
			holder.tvBut.setVisibility(View.VISIBLE);			
			if(isBookmark==0){
				holder.tvBut.setText(R.string.collect);
			}else if(isBookmark==1){
				holder.tvBut.setText(R.string.yi_shoucang);
			}
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
	
	public void addNews(List<Order> addNews) {
		for (Order  order : addNews) {
			news.add(order);
		}
	}

}

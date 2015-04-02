package com.huayan.life.adapter;

import java.util.List;

import android.content.Context;
import android.graphics.Bitmap;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import com.huayan.life.R;
import com.huayan.life.model.OrderIntroduce;
import com.nostra13.universalimageloader.cache.memory.impl.WeakMemoryCache;
import com.nostra13.universalimageloader.core.DisplayImageOptions;
import com.nostra13.universalimageloader.core.ImageLoader;
import com.nostra13.universalimageloader.core.ImageLoaderConfiguration;
import com.nostra13.universalimageloader.core.assist.ImageScaleType;
import com.nostra13.universalimageloader.core.assist.QueueProcessingType;
import com.nostra13.universalimageloader.core.display.RoundedBitmapDisplayer;

/**
 * 订单介绍
 * @author wzz
 *
 */
public class OrderDetailAdapter extends BaseAdapter {

	private ImageLoader imageLoader = null;
	private DisplayImageOptions options = null;

	private Context context;
	private List<OrderIntroduce> news;
	
	@SuppressWarnings("deprecation")
	public OrderDetailAdapter(Context context, List<OrderIntroduce> list) {
		this.context = context;
		this.news = list;
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
	public OrderIntroduce getItem(int position) {
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
			convertView = LayoutInflater.from(context).inflate(R.layout.item_details, null);
			holder = new ViewHolder();
			holder.img_Icon = (ImageView) convertView.findViewById(R.id.img_blumn_order);
			holder.tvShopName = (TextView) convertView.findViewById(R.id.txt_order_title);
			holder.tvName = (TextView) convertView.findViewById(R.id.tv_order_content);
			holder.tvPrice = (TextView) convertView.findViewById(R.id.tv_order_jiage);
			holder.tvNum = (TextView) convertView.findViewById(R.id.tv_order_old_jiage);
			holder.tvCategory=(TextView)convertView.findViewById(R.id.tv_order_category1);
			convertView.setTag(holder);
		} else {
			holder = (ViewHolder) convertView.getTag();
		}
		
		OrderIntroduce order=news.get(position);
		
		imageLoader.displayImage(order.getGoodsImg(), holder.img_Icon,options);
		holder.tvShopName.setText(order.getShopName());
		holder.tvName.setText(order.getName());
		holder.tvPrice.setText("总价："+order.getPrice());
		holder.tvNum.setText("数量："+order.getNum());
		holder.tvCategory.setText(order.getTypeName());
		return convertView;
	}

	private static class ViewHolder {
		ImageView img_Icon;
		TextView tvShopName;
		TextView tvName;
		TextView tvPrice;
		TextView tvNum;
		TextView tvCategory;
	}

}

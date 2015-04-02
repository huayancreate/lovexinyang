package com.huayan.life.adapter;

import java.util.List;

import android.content.Context;
import android.graphics.Bitmap;
import android.view.LayoutInflater;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.View.OnLongClickListener;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import com.huayan.life.R;
import com.huayan.life.model.MemberCard;
import com.nostra13.universalimageloader.cache.memory.impl.WeakMemoryCache;
import com.nostra13.universalimageloader.core.DisplayImageOptions;
import com.nostra13.universalimageloader.core.ImageLoader;
import com.nostra13.universalimageloader.core.ImageLoaderConfiguration;
import com.nostra13.universalimageloader.core.assist.ImageScaleType;
import com.nostra13.universalimageloader.core.assist.QueueProcessingType;
import com.nostra13.universalimageloader.core.display.RoundedBitmapDisplayer;

public class MembershipCardAdapter extends BaseAdapter {

	private Context context;
	private List<MemberCard> list;

	private ImageLoader imageLoader = null;
	private DisplayImageOptions options = null;

	@SuppressWarnings("deprecation")
	public MembershipCardAdapter(Context context,List<MemberCard> news) {
		this.context = context;
		this.list = news;
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
		return list.size();
	}

	@Override
	public MemberCard getItem(int position) {
		return list.get(position);
	}

	@Override
	public long getItemId(int position) {
		return position;
	}

	@Override
	public View getView(final int position, View convertView, ViewGroup parent) {
		final CacheView cacheView;
		if (convertView == null) {
			convertView = LayoutInflater.from(context).inflate(R.layout.item_membership_card, null);
			cacheView = new CacheView();
			cacheView.img_icon = (ImageView) convertView.findViewById(R.id.img_icon_store);
			cacheView.tv_title = (TextView) convertView.findViewById(R.id.txt_icon_name);
			cacheView.tv_num = (TextView) convertView.findViewById(R.id.tv_number);
			cacheView.tv_discount = (TextView) convertView.findViewById(R.id.tv_youhui);
			cacheView.tv_delete=(TextView)convertView.findViewById(R.id.tv_delete);
			convertView.setTag(cacheView);
		} else {
			cacheView = (CacheView) convertView.getTag();
		}
		MemberCard card= list.get(position);
		
		imageLoader.displayImage(card.getImg(),cacheView.img_icon, options);
		cacheView.tv_title.setText(card.getShopName());
		cacheView.tv_num.setText(card.getNumber());
		cacheView.tv_discount.setText(card.getLevel());
		cacheView.tv_delete.setVisibility(View.GONE);
		
//		convertView.setOnLongClickListener(new OnLongClickListener() {
//			@Override
//			public boolean onLongClick(View v) {
//				cacheView.tv_delete.setVisibility(View.VISIBLE);
//				
//				cacheView.tv_delete.setOnClickListener(new OnClickListener() {
//					@Override
//					public void onClick(View v) {
//						// TODO 长按删除
//						list.remove(position);
//						MembershipCardAdapter.this.notifyDataSetChanged();
//					}
//				});				
//				return true;
//			}
//		});
		
		return convertView;
	}

	private static class CacheView {
		ImageView img_icon;
		TextView tv_title;
		TextView tv_num;
		TextView tv_discount;
		TextView tv_delete;
	}

	public void addNews(List<MemberCard> addNews) {
		for (MemberCard memberCard : addNews) {
			list.add(memberCard);
		}
	}
}

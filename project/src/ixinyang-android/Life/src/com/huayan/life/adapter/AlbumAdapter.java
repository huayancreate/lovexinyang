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
import com.huayan.life.model.AlbumImage;
import com.nostra13.universalimageloader.cache.memory.impl.WeakMemoryCache;
import com.nostra13.universalimageloader.core.DisplayImageOptions;
import com.nostra13.universalimageloader.core.ImageLoader;
import com.nostra13.universalimageloader.core.ImageLoaderConfiguration;
import com.nostra13.universalimageloader.core.assist.ImageScaleType;
import com.nostra13.universalimageloader.core.assist.QueueProcessingType;
import com.nostra13.universalimageloader.core.display.RoundedBitmapDisplayer;

public class AlbumAdapter extends BaseAdapter {

	private List<AlbumImage> list;
	LayoutInflater inflater;
	private ImageLoader imageLoader = null;
	private DisplayImageOptions options = null;

	@SuppressWarnings("deprecation")
	public AlbumAdapter(Context context, List<AlbumImage> list) {
		this.list = list;
		this.inflater = LayoutInflater.from(context);
		imageLoader = ImageLoader.getInstance();
		ImageLoaderConfiguration config = new ImageLoaderConfiguration.Builder(
				context)
				.memoryCacheExtraOptions(480, 450)//即保存的每个缓存文件的最大长宽
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
	public AlbumImage getItem(int position) {
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
			convertView = inflater.inflate(R.layout.item_gallery, null);
			cacheView = new CacheView();
			cacheView.img_albumView = (ImageView) convertView
					.findViewById(R.id.img_gy_alb);
			cacheView.tv_title = (TextView) convertView
					.findViewById(R.id.tv_title);
			cacheView.tv_pageNum = (TextView) convertView
					.findViewById(R.id.tv_page);
			convertView.setTag(cacheView);
		} else {
			cacheView = (CacheView) convertView.getTag();
		}
		imageLoader.displayImage(list.get(position).getImgurl(),
				cacheView.img_albumView, options);
		cacheView.tv_title.setText(list.get(position).getTitle());
		String pageNum = position + 1 + "/" + list.size();
		cacheView.tv_pageNum.setText(pageNum);
		return convertView;
	}

	private static class CacheView {
		ImageView img_albumView;
		TextView tv_title;
		TextView tv_pageNum;
	}
}

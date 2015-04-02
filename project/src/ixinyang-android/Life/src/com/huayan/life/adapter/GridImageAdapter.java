package com.huayan.life.adapter;

import java.util.List;

import android.content.Context;
import android.graphics.Bitmap;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;

import com.huayan.life.R;
import com.huayan.life.model.AlbumImage;
import com.nostra13.universalimageloader.cache.memory.impl.WeakMemoryCache;
import com.nostra13.universalimageloader.core.DisplayImageOptions;
import com.nostra13.universalimageloader.core.ImageLoader;
import com.nostra13.universalimageloader.core.ImageLoaderConfiguration;
import com.nostra13.universalimageloader.core.assist.ImageScaleType;
import com.nostra13.universalimageloader.core.assist.QueueProcessingType;
import com.nostra13.universalimageloader.core.display.RoundedBitmapDisplayer;

public class GridImageAdapter extends BaseAdapter {

	private Context context;
	private List<AlbumImage> list;
	private ImageLoader imageLoader = null;
	private DisplayImageOptions options = null;
	
	@SuppressWarnings("deprecation")
	public GridImageAdapter(Context context, List<AlbumImage> list) {
		this.context = context;
		this.list = list;
		imageLoader = ImageLoader.getInstance();
		ImageLoaderConfiguration config = new ImageLoaderConfiguration.Builder(
				context)
				.memoryCacheExtraOptions(480, 800)//�������ÿ�������ļ�����󳤿�
				.threadPoolSize(3)// �̳߳��ڼ��ص�����
				.threadPriority(Thread.NORM_PRIORITY - 2)
				.denyCacheImageMultipleSizesInMemory()
				.memoryCache(new WeakMemoryCache())
				.memoryCacheSize(2 * 1024 * 1024)
				.writeDebugLogs() // Remove for release app
				.tasksProcessingOrder(QueueProcessingType.LIFO).build();
		imageLoader.init(config);

		options = new DisplayImageOptions.Builder()
				.showImageOnLoading(R.drawable.pic)// ����ͼƬ�������ڼ���ʾ��ͼƬ
				.showImageForEmptyUri(R.drawable.pic)	// ����ͼƬUriΪ�ջ��Ǵ����ʱ����ʾ��ͼƬ
				.showImageOnFail(R.drawable.pic)// ����ͼƬ����/��������д���ʱ����ʾ��ͼƬ
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
	public Object  getItem(int position) {
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
			convertView = LayoutInflater.from(context).inflate(R.layout.item_grid_image, null);
			cacheView = new CacheView();
			cacheView.img_mapping = (ImageView) convertView.findViewById(R.id.child_image);
			convertView.setTag(cacheView);
		} else {
			cacheView = (CacheView) convertView.getTag();
		}
		imageLoader.displayImage(list.get(position).getImgurl(), cacheView.img_mapping, options);
		return convertView;
	}

	private static class CacheView {
		ImageView img_mapping;		
	}
	
}

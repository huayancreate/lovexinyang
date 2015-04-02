package com.huayan.life.adapter;

import java.text.DecimalFormat;
import java.util.List;

import util.GetLocation;
import util.ShareUtil;
import android.content.Context;
import android.graphics.Bitmap;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.RatingBar;
import android.widget.TextView;

import com.baidu.mapapi.model.LatLng;
import com.huayan.life.R;
import com.huayan.life.model.MyLocation;
import com.huayan.life.model.Shop;
import com.nostra13.universalimageloader.cache.memory.impl.WeakMemoryCache;
import com.nostra13.universalimageloader.core.DisplayImageOptions;
import com.nostra13.universalimageloader.core.ImageLoader;
import com.nostra13.universalimageloader.core.ImageLoaderConfiguration;
import com.nostra13.universalimageloader.core.assist.ImageScaleType;
import com.nostra13.universalimageloader.core.assist.QueueProcessingType;
import com.nostra13.universalimageloader.core.display.RoundedBitmapDisplayer;

public class StoreListAdapter extends BaseAdapter {

	private ImageLoader imageLoader = null;
	private DisplayImageOptions options = null;

	private Context context;
	private List<Shop> news;
	GetLocation loc=null;
	MyLocation endLoc;
	
	@SuppressWarnings("deprecation")
	public StoreListAdapter(Context context, List<Shop> list) {
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
		loc=new GetLocation(context);
		endLoc=ShareUtil.readMyLocation(context);		
	}

	@Override
	public int getCount() {
		return news.size();
	}

	@Override
	public Shop getItem(int position) {
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
			convertView = LayoutInflater.from(context).inflate(R.layout.item_store, null);
			holder = new ViewHolder();
			holder.img_Icon = (ImageView) convertView.findViewById(R.id.img_biao_icon);
			holder.tvTitle = (TextView) convertView.findViewById(R.id.txt_biao_title);
			holder.rbBar = (RatingBar) convertView.findViewById(R.id.rtb_item_store);
			holder.tvPing = (TextView) convertView.findViewById(R.id.tv_biao_pingjia);
			holder.tvCategory = (TextView) convertView.findViewById(R.id.tv_biao_cate);
			holder.tvQu = (TextView) convertView.findViewById(R.id.tv_biao_lu);
			holder.tvJu = (TextView) convertView.findViewById(R.id.tv_biao_near);
			convertView.setTag(holder);
		} else {
			holder = (ViewHolder) convertView.getTag();
		}
		
		Shop shop=news.get(position);
		
		imageLoader.displayImage(shop.getImg(), holder.img_Icon,options);
		holder.rbBar.setRating(shop.getCommentScore());
		holder.tvPing.setText(shop.getCommentNum()+"人评价");
		holder.tvTitle.setText(shop.getShopName());
		holder.tvCategory.setText(shop.getType());
		holder.tvQu.setText(shop.getRegion());
		
		MyLocation myLoc=shop.getLocation();
		LatLng start=new LatLng(myLoc.getLatitude(), myLoc.getLongitude());
		LatLng end=new LatLng(endLoc.getLatitude(), endLoc.getLongitude());
		Double distance=loc.getDistance(start, end);
		DecimalFormat df=new DecimalFormat(".#");
		String distStr=df.format(distance);
		holder.tvJu.setText(distStr+"km");//距离
		return convertView;

	}

	
	static class ViewHolder {
		ImageView img_Icon;
		TextView tvTitle;
		RatingBar rbBar;
		TextView tvPing;
		TextView tvCategory;
		TextView tvQu;
		TextView tvJu;
	}
	
	public void addNews(List<Shop> addNews) {
		for (Shop hm : addNews) {
			news.add(hm);
		}
	}

}

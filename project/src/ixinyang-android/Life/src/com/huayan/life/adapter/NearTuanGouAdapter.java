package com.huayan.life.adapter;

import java.text.DecimalFormat;
import java.util.List;

import util.GetLocation;
import util.ShareUtil;
import android.content.Context;
import android.graphics.Bitmap;
import android.graphics.Paint;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import com.baidu.mapapi.model.LatLng;
import com.huayan.life.R;
import com.huayan.life.model.Goods;
import com.huayan.life.model.MyLocation;
import com.nostra13.universalimageloader.cache.memory.impl.WeakMemoryCache;
import com.nostra13.universalimageloader.core.DisplayImageOptions;
import com.nostra13.universalimageloader.core.ImageLoader;
import com.nostra13.universalimageloader.core.ImageLoaderConfiguration;
import com.nostra13.universalimageloader.core.assist.ImageScaleType;
import com.nostra13.universalimageloader.core.assist.QueueProcessingType;
import com.nostra13.universalimageloader.core.display.RoundedBitmapDisplayer;

public class NearTuanGouAdapter extends BaseAdapter {

	private Context context;
	private List<Goods> list;

	private ImageLoader imageLoader = null;
	private DisplayImageOptions options = null;
	GetLocation loc=null;
	MyLocation endLoc;
	
	@SuppressWarnings("deprecation")
	public NearTuanGouAdapter(Context context, List<Goods> news) {
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
		loc=new GetLocation(context);
		endLoc=ShareUtil.readMyLocation(context);	
	}

	@Override
	public int getCount() {
		return list.size();
	}

	@Override
	public Goods getItem(int position) {
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
			convertView = LayoutInflater.from(context).inflate(R.layout.item_near_tuan_gou, null);
			cacheView = new CacheView();
			cacheView.img_icon = (ImageView) convertView.findViewById(R.id.img_icon_con);
			cacheView.tv_title = (TextView) convertView.findViewById(R.id.txt_icon_title);
			cacheView.tv_near=(TextView)convertView.findViewById(R.id.tv_juli);
			cacheView.tv_des = (TextView) convertView.findViewById(R.id.tv_content);
			cacheView.tv_price = (TextView) convertView.findViewById(R.id.tv_jiage);
			cacheView.tv_oldPrice = (TextView) convertView.findViewById(R.id.tv_old_jiage);
			cacheView.tv_fen=(TextView) convertView.findViewById(R.id.tv_defen);
			convertView.setTag(cacheView);
		} else {
			cacheView = (CacheView) convertView.getTag();
		}
				
		Goods goods=list.get(position);
		imageLoader.displayImage(goods.getShopImg(), cacheView.img_icon, options);
		cacheView.tv_des.setText(goods.getDes());
		cacheView.tv_title.setText(goods.getName());
		cacheView.tv_price.setText(goods.getDiscountPrice()+"");
		cacheView.tv_oldPrice.setText(goods.getPrice()+"元");
		cacheView.tv_oldPrice.getPaint().setFlags(Paint. STRIKE_THRU_TEXT_FLAG ); //中间横线
		cacheView.tv_fen.setText(goods.getCommentScore()+"分("+goods.getSalesNum()+")");

		MyLocation myLoc=goods.getLocation();
		LatLng start=new LatLng(myLoc.getLatitude(), myLoc.getLongitude());
		LatLng end=new LatLng(endLoc.getLatitude(), endLoc.getLongitude());
		Double distance=loc.getDistance(start, end);
		DecimalFormat df=new DecimalFormat(".#");
		String distStr=df.format(distance);
		cacheView.tv_near.setText(distStr+"km");//距离
		return convertView;
	}
	
	public void addNews(List<Goods> addNews) {
		for (Goods  goods : addNews) {
			list.add(goods);
		}
	}

	private static class CacheView {
		ImageView img_icon;
		TextView tv_title;
		TextView tv_near;
		TextView tv_des;
		TextView tv_price;
		TextView tv_oldPrice;
		TextView tv_fen;
	}
}

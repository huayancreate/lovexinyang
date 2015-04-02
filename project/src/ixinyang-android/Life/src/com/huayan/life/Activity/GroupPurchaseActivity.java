package com.huayan.life.Activity;

import java.text.DecimalFormat;
import java.util.List;

import org.apache.http.Header;

import util.GetLocation;
import util.HttpUrl;
import util.HttpUtils;
import util.ShareUtil;
import util.Utility;
import android.annotation.SuppressLint;
import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.Paint;
import android.net.Uri;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.ViewTreeObserver.OnGlobalLayoutListener;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.ListView;
import android.widget.RatingBar;
import android.widget.RelativeLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.alibaba.fastjson.JSON;
import com.alibaba.fastjson.JSONArray;
import com.alibaba.fastjson.JSONException;
import com.alibaba.fastjson.JSONObject;
import com.baidu.mapapi.model.LatLng;
import com.huayan.life.R;
import com.huayan.life.adapter.EvaluationAdapter;
import com.huayan.life.adapter.RecommendAdapter;
import com.huayan.life.common.GetData;
import com.huayan.life.model.AlbumImage;
import com.huayan.life.model.Goods;
import com.huayan.life.model.GoodsDetail;
import com.huayan.life.model.MyLocation;
import com.huayan.life.model.User;
import com.huayan.life.view.MyScrollView;
import com.huayan.life.view.MyScrollView.OnScrollListener;
import com.loopj.android.http.JsonHttpResponseHandler;
import com.loopj.android.http.RequestParams;
import com.nostra13.universalimageloader.core.DisplayImageOptions;
import com.nostra13.universalimageloader.core.assist.ImageScaleType;
import com.nostra13.universalimageloader.core.display.RoundedBitmapDisplayer;

/**
 * ��Ʒ����
 * @author wzz
 * @version 1.0
 */
public class GroupPurchaseActivity extends BaseActivity implements OnScrollListener, OnClickListener {

	private MyScrollView myScrollView;
	private LinearLayout mBuyLayout; // ��MyScrollView����Ĺ��򲼾�
	private LinearLayout mTopBuyLayout;// λ�ڶ����Ĺ��򲼾�
	TextView newPrice,oldPrice;
	ListView pingListView, listTuanView;
	EvaluationAdapter evaluationAdapter;
	RecommendAdapter tanGouAdapter ;
	List<Goods> goodsList=null;
	int goodsID,shopId;
	ImageView img_album,img_phone;
	TextView tvName,tvDes,tvScore,tvCommentNum,tvAddress,tvBuyNotice,tvDistance,txt_store_title,txt_moreping;
	RatingBar ratingBar;
	private DisplayImageOptions options = null;
	RelativeLayout rlAlbum;
	GetLocation loc=null;
	MyLocation endLoc;
	User myUser=null;
	String goodsName,unitPrice;
	
	ImageView iv_collection;
	int isBookmark=0;
	
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_group_purchase);
		myUser=ShareUtil.readUser(context);
		
		myScrollView = (MyScrollView) findViewById(R.id.my_sl);
		myScrollView.setOnScrollListener(this);		
		mBuyLayout = (LinearLayout) findViewById(R.id.buy);
		mTopBuyLayout = (LinearLayout) findViewById(R.id.top_buy_layout);
		newPrice = (TextView)mTopBuyLayout.findViewById(R.id.tv_new_price);
		newPrice.getPaint().setFlags(Paint.STRIKE_THRU_TEXT_FLAG); // �м����
		oldPrice=(TextView)mTopBuyLayout.findViewById(R.id.tv_old_price);
		((TextView)mTopBuyLayout.findViewById(R.id.tv_buy)).setOnClickListener(this);
		
		initView();	
		
		// �����ֵ�״̬���߿ؼ��Ŀɼ��Է����ı�ص��Ľӿ�
		findViewById(R.id.parent_layout).getViewTreeObserver()
				.addOnGlobalLayoutListener(new OnGlobalLayoutListener() {
					@Override
					public void onGlobalLayout() {
						// ��һ������Ҫ��ʹ������Ĺ��򲼾ֺ�����Ĺ��򲼾��غ�
						onScroll(myScrollView.getScrollY());
					}
				});
	}
	
	
	@SuppressWarnings("deprecation")
	private  void initView(){
		goodsID=getIntent().getIntExtra("goodsID", 0);
		
		options = new DisplayImageOptions.Builder()
		.showImageOnLoading(R.drawable.pic)// ����ͼƬ�������ڼ���ʾ��ͼƬ
		.showImageForEmptyUri(R.drawable.pic)	// ����ͼƬUriΪ�ջ��Ǵ����ʱ����ʾ��ͼƬ
		.showImageOnFail(R.drawable.pic)// ����ͼƬ����/��������д���ʱ����ʾ��ͼƬ
		.displayer(new RoundedBitmapDisplayer(0xff000000, 10))
		.bitmapConfig(Bitmap.Config.RGB_565)
		.imageScaleType(ImageScaleType.IN_SAMPLE_INT)
		.cacheOnDisc(true)
		.build();
		
		rlAlbum=(RelativeLayout) findViewById(R.id.rl_album);//�̼����
		((ImageView) findViewById(R.id.fanhui)).setOnClickListener(this);
		txt_moreping=(TextView)findViewById(R.id.txt_moreping);
		txt_moreping.setOnClickListener(this);//�鿴��������
		pingListView = (ListView) findViewById(R.id.list_evaluation);
		listTuanView = (ListView) findViewById(R.id.list_tuangou);
			
		img_album=(ImageView)findViewById(R.id.img_album);
		ratingBar=(RatingBar)findViewById(R.id.ratingBar);
		tvName=(TextView)findViewById(R.id.txt_group_title);
		tvDes=(TextView)findViewById(R.id.txt_group_content);
		tvScore=(TextView)findViewById(R.id.tv_fraction);
		tvCommentNum=(TextView)findViewById(R.id.tv_evaluation);
		tvDistance=(TextView)findViewById(R.id.txt_Distance);
		tvAddress=(TextView)findViewById(R.id.txt_address_content);
		txt_store_title=(TextView)findViewById(R.id.txt_store_title);
		tvBuyNotice=(TextView)findViewById(R.id.tv_buy_notice);
		img_phone=(ImageView)findViewById(R.id.img_phone);
		((LinearLayout)findViewById(R.id.ll_all_eva)).setOnClickListener(this);
		((RelativeLayout)findViewById(R.id.store_layout)).setOnClickListener(this);		
		iv_collection=(ImageView)findViewById(R.id.iv_collection);
		iv_collection.setOnClickListener(this);
		
		evaluationAdapter = new EvaluationAdapter(context,GetData.getEvaluationList(3));
		pingListView.setAdapter(evaluationAdapter);
		Utility.setListViewHeightBasedOnChildren(pingListView, 230);

		loc=new GetLocation(context);
		endLoc=ShareUtil.readMyLocation(context);		
		
		getOtherGoodsList();
	}	
	
	private   void getOtherGoodsList(){
		RequestParams params = new RequestParams(); // �󶨲���	
		params.put("goodsID", goodsID);
		params.put("opeType", "getDetils");
		params.put("requestType", 1);
		params.put("mobile", 1);
		 
		 HttpUtils.post(HttpUrl.GOODSACTION, params, new JsonHttpResponseHandler(){

			@Override
			public void onSuccess(int statusCode, Header[] arg1, String responseString) {
				 if(statusCode==200){
//						try {
//							JSONObject obj =  JSON.parseObject(responseString);
//							Boolean result=obj.getBoolean("success");
//							if(result){
//								String content=obj.getString("content");		
//								//�ؼ���ֵ
//								GoodsDetail detail=JSON.parseObject(content, GoodsDetail.class);
//								
//								ratingBar.setRating(detail.getCommentScore());
//								tvName.setText(goodsName);
//								tvDes.setText(detail.getIntroduction());
//								tvScore.setText(detail.getCommentScore()+"��");
//								tvCommentNum.setText(detail.getCommentNum()+"������");
//								tvAddress.setText(detail.getAddress());
//								txt_store_title.setText(goodsName);
//								tvBuyNotice.setText(detail.getBuyNotice());
//								oldPrice.setText(detail.getDiscountPrice());
//								newPrice.setText(detail.getPrice()+"Ԫ");
//								
//								MyLocation myLoc=detail.getLocation();
//								LatLng start=new LatLng(myLoc.getLatitude(), myLoc.getLongitude());
//								LatLng end=new LatLng(endLoc.getLatitude(), endLoc.getLongitude());
//								Double distance=loc.getDistance(start, end);
//								DecimalFormat df=new DecimalFormat(".#");
//								String distStr=df.format(distance);
//								tvDistance.setText(distStr+"km");//����
//								shopId=detail.getShopID();
//								
//								List<AlbumImage>imgs=detail.getImgs();
//								imageLoader.displayImage(imgs.get(1).getImgurl(),img_album, options);	
//								txt_moreping.setText("�鿴ȫ��"+detail.getCommentNum()+"������");// ������
//								
//								JSONObject objContent=JSON.parseObject(content);
//								JSONArray imgArray = objContent.getJSONArray("imgs");
//								final String imgString=imgArray.toString();
//								
//								rlAlbum.setOnClickListener(new OnClickListener() {
//									@Override
//									public void onClick(View v) {
//										// ��Ʒ���
//										Intent intent = new Intent(GroupPurchaseActivity.this,AlbumActivity.class);
//										Bundle bundle=new Bundle();
//										bundle.putString("goodsImgs", imgString);
//										intent.putExtras(bundle);
//										startActivity(intent);
//									}
//								});
//								
//								final String phone=detail.getTel();
//								img_phone.setOnClickListener(new OnClickListener() {
//									@Override
//									public void onClick(View v) {
//										//  �����̼ҵ绰
//										Intent intentPhone = new Intent();
//										intentPhone.setAction(Intent.ACTION_DIAL);
//										intentPhone.setData(Uri.parse("tel:"+phone));
//										startActivity(intentPhone);								
//									}
//								});
//								
//								JSONArray arr = objContent.getJSONArray("goodsList");	
//								String jsonString=arr.toString();
//								goodsList=JSON.parseArray(jsonString, Goods.class);
//								
//								tanGouAdapter = new RecommendAdapter(context,goodsList);		
//								listTuanView.setAdapter(tanGouAdapter);
//								Utility.setListViewHeightBasedOnChildren(listTuanView, 30);
//								listTuanView.setOnItemClickListener(new mListener());
//							}else{
//								Toast.makeText(context, getResources().getString(R.string.dialog_title_getDataFail), Toast.LENGTH_SHORT).show();
//							}							
//						} catch (JSONException e) {
//							e.printStackTrace();
//						}
				 }			
			}			
			@Override
			public void onFailure(int statusCode, Header[] arg1, String responseString,Throwable error) {
					error.printStackTrace();
					String json=GetData.getOtherGoodsList();
					try {
						JSONObject obj =  JSON.parseObject(json);
						Boolean result=obj.getBoolean("success");
						if(result){
							String content=obj.getString("content");		
							//�ؼ���ֵ
							GoodsDetail detail=JSON.parseObject(content, GoodsDetail.class);
							goodsName=detail.getName();
							unitPrice=detail.getDiscountPrice();
							
							ratingBar.setRating(detail.getCommentScore());
							tvName.setText(goodsName);
							tvDes.setText(detail.getIntroduction());
							tvScore.setText(detail.getCommentScore()+"��");
							tvCommentNum.setText(detail.getCommentNum()+"������");
							tvAddress.setText(detail.getAddress());
							txt_store_title.setText(goodsName);
							tvBuyNotice.setText(detail.getBuyNotice());
							oldPrice.setText(unitPrice);
							newPrice.setText(detail.getPrice()+"Ԫ");
							
							  isBookmark=detail.getIsBookmark();
								if(isBookmark==1){
									iv_collection.setImageResource(R.drawable.ic_action_favorite_on);
								}else if(isBookmark==0){
									iv_collection.setImageResource(R.drawable.ic_action_favorite_on);
								}
							
							MyLocation myLoc=detail.getLocation();
							LatLng start=new LatLng(myLoc.getLatitude(), myLoc.getLongitude());
							LatLng end=new LatLng(endLoc.getLatitude(), endLoc.getLongitude());
							Double distance=loc.getDistance(start, end);
							DecimalFormat df=new DecimalFormat(".#");
							String distStr=df.format(distance);
							tvDistance.setText(distStr+"km");//����
							shopId=detail.getShopID();
							
							List<AlbumImage>imgs=detail.getImgs();
							imageLoader.displayImage(imgs.get(1).getImgurl(),img_album, options);	
							txt_moreping.setText("�鿴ȫ��"+detail.getCommentNum()+"������");// ������
							
							JSONObject objContent=JSON.parseObject(content);
							JSONArray imgArray = objContent.getJSONArray("imgs");
							final String imgString=imgArray.toString();
							
							rlAlbum.setOnClickListener(new OnClickListener() {
								@Override
								public void onClick(View v) {
									// ��Ʒ���
									Intent intent = new Intent(GroupPurchaseActivity.this,AlbumActivity.class);
									Bundle bundle=new Bundle();
									bundle.putString("goodsImgs", imgString);
									intent.putExtras(bundle);
									startActivity(intent);
								}
							});
							
							final String phone=detail.getTel();
							img_phone.setOnClickListener(new OnClickListener() {
								@Override
								public void onClick(View v) {
									//  �����̼ҵ绰
									Intent intentPhone = new Intent();
									intentPhone.setAction(Intent.ACTION_DIAL);
									intentPhone.setData(Uri.parse("tel:"+phone));
									startActivity(intentPhone);								
								}
							});
							
							JSONArray arr = objContent.getJSONArray("goodsList");	
							String jsonString=arr.toString();
							goodsList=JSON.parseArray(jsonString, Goods.class);
							
							tanGouAdapter = new RecommendAdapter(context,goodsList);		
							listTuanView.setAdapter(tanGouAdapter);
							Utility.setListViewHeightBasedOnChildren(listTuanView, 30);
							listTuanView.setOnItemClickListener(new mListener());
						}else{
							Toast.makeText(context, getResources().getString(R.string.dialog_title_getDataFail), Toast.LENGTH_SHORT).show();
						}							
					} catch (JSONException e) {
						e.printStackTrace();
					}
			}			 
		 });
}
			
	private final class mListener implements OnItemClickListener {
		/*
		 * arg1 ��ǰ�������VIew���� arg2 ��ǰ���������Ŀ���󶨵������ڼ����е�����ֵ arg3 ��ǰ�����е�����ֵ
		 */
		@SuppressLint("ResourceAsColor")
		public void onItemClick(AdapterView<?> arg0, View arg1, int arg2,long arg3) {
			jumpToActivity(GroupPurchaseActivity.this, GroupPurchaseActivity.class);
		}
	}
	
	@Override
	public void onScroll(int scrollY) {
		int mBuyLayout2ParentTop = Math.max(scrollY, mBuyLayout.getTop());
		mTopBuyLayout.layout(0, mBuyLayout2ParentTop, mTopBuyLayout.getWidth(),mBuyLayout2ParentTop + mTopBuyLayout.getHeight());
	}

	/**
	 * δ��¼��ȥ��¼���ѵ�¼�ɲ鿴�ҵĸ���ģ��
	 * @return boolean
	 */
	private  Boolean noLogin(){
		if(myUser==null){			
			return false;
		}
		return true;		
	}
	
	@Override	
	public void onClick(View v) {
		switch (v.getId()) {		
		case R.id.fanhui:
			finish();
			break;
		case R.id.tv_buy:
			if(noLogin()){				
				Intent intent = new Intent(GroupPurchaseActivity.this,CreateOrderActivity.class);//�������������ɶ���
				Bundle bundle=new Bundle();
				bundle.putString("GoodsName", goodsName);
				bundle.putString("UnitPrice", unitPrice);
				bundle.putInt("shopID", shopId);
				bundle.putInt("goodsID", goodsID);
				intent.putExtras(bundle);
				startActivity(intent);
			}else{
				jumpToActivity(GroupPurchaseActivity.this, LoginActivity.class);
			}
			break;
		case R.id.store_layout:
			Intent intent = new Intent(GroupPurchaseActivity.this,StoreDetailActivity.class);
			intent.putExtra("shopID", shopId);
			startActivity(intent);
		break;
		case R.id.txt_moreping:
			//�����ڵ������б�
			jumpToActivity(GroupPurchaseActivity.this, RecentEvaluationActivity.class);  
			break;
		case R.id.ll_all_eva:
			//�����ڵ������б�
			jumpToActivity(GroupPurchaseActivity.this, RecentEvaluationActivity.class);
			break;
		case R.id.iv_collection:
			//0����ղ�  1ɾ���ղ�
			if(isBookmark==0){
				addBookmark();
			}else if(isBookmark==1){
				delBookmark();
			}
			break;
		}
	}
	
	private   void delBookmark(){
		RequestParams params = new RequestParams(); // �󶨲���	
		params.put("username", myUser.getUsername());
		params.put("token", myUser.getToken());
		params.put("id", goodsID);
		params.put("opeType", "del");
		params.put("type", 1);
		params.put("requestType", 1);
		params.put("mobile", 1);
		 
		 HttpUtils.post(HttpUrl.BOOKMARKACTION, params, new JsonHttpResponseHandler(){

			@Override
			public void onSuccess(int statusCode, Header[] arg1, String responseString) {
				 if(statusCode==200){
						try {
							JSONObject obj =  JSON.parseObject(responseString); 
							String content=obj.getString("content");			
							JSONObject objContent=JSON.parseObject(content);
							Boolean result=objContent.getBoolean("result");
							String message=objContent.getString("message");//(true:message�ɹ���Ϣ�� false:message���ݴ�����Ϣ)
							if(result){
								iv_collection.setImageResource(R.drawable.ic_action_favorite_off);
								Toast.makeText(GroupPurchaseActivity.this, message, Toast.LENGTH_SHORT).show();	
							}else{
								Toast.makeText(GroupPurchaseActivity.this, "ȡ���ղ�ʧ�ܣ�", Toast.LENGTH_SHORT).show();	
							}
						} catch (JSONException e) {
							e.printStackTrace();
						}
				 }			
			}			
			@Override
			public void onFailure(int statusCode, Header[] arg1, String responseString,Throwable error) {
				error.printStackTrace();
			}			 
		 });
}
	
	
	private   void addBookmark(){
		RequestParams params = new RequestParams(); // �󶨲���	
		params.put("username", myUser.getUsername());
		params.put("token", myUser.getToken());
		params.put("id", goodsID);
		params.put("opeType", "add");
		params.put("type", 1);
		params.put("requestType", 1);
		params.put("mobile", 1);
		 
		 HttpUtils.post(HttpUrl.BOOKMARKACTION, params, new JsonHttpResponseHandler(){

			@Override
			public void onSuccess(int statusCode, Header[] arg1, String responseString) {
				 if(statusCode==200){
						try {
							JSONObject obj =  JSON.parseObject(responseString); 
							String content=obj.getString("content");			
							JSONObject objContent=JSON.parseObject(content);
							Boolean result=objContent.getBoolean("result");
							String message=objContent.getString("message");//(true:message�ɹ���Ϣ�� false:message���ݴ�����Ϣ)
							if(result){
								iv_collection.setImageResource(R.drawable.ic_action_favorite_on);
								Toast.makeText(GroupPurchaseActivity.this, message, Toast.LENGTH_SHORT).show();	
							}else{
								Toast.makeText(GroupPurchaseActivity.this, "�ղ�ʧ�ܣ�", Toast.LENGTH_SHORT).show();	
							}
						} catch (JSONException e) {
							e.printStackTrace();
						}
				 }			
			}			
			@Override
			public void onFailure(int statusCode, Header[] arg1, String responseString,Throwable error) {
				error.printStackTrace();
			}			 
		 });
}
	
}

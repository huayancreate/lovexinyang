package com.huayan.life.Activity;

import java.util.List;

import org.apache.http.Header;

import util.HttpUrl;
import util.HttpUtils;
import util.ShareUtil;
import util.Utility;
import android.annotation.SuppressLint;
import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.drawable.BitmapDrawable;
import android.net.Uri;
import android.os.Bundle;
import android.view.Gravity;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.ViewGroup.LayoutParams;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.PopupWindow;
import android.widget.RatingBar;
import android.widget.TextView;
import android.widget.Toast;

import com.alibaba.fastjson.JSON;
import com.alibaba.fastjson.JSONArray;
import com.alibaba.fastjson.JSONException;
import com.alibaba.fastjson.JSONObject;
import com.huayan.life.R;
import com.huayan.life.adapter.EvaluationAdapter;
import com.huayan.life.adapter.NearTuanGouAdapter;
import com.huayan.life.common.GetData;
import com.huayan.life.model.AlbumImage;
import com.huayan.life.model.Goods;
import com.huayan.life.model.ShopDetail;
import com.huayan.life.model.User;
import com.loopj.android.http.JsonHttpResponseHandler;
import com.loopj.android.http.RequestParams;
import com.nostra13.universalimageloader.core.DisplayImageOptions;
import com.nostra13.universalimageloader.core.assist.ImageScaleType;
import com.nostra13.universalimageloader.core.display.RoundedBitmapDisplayer;

/**
 * 商家详情
 * @author wzz
 *
 */
public class StoreDetailActivity extends BaseActivity implements OnClickListener {

	ListView pingListView, nearListView;
	PopupWindow popupWindow;
	NearTuanGouAdapter tanGouAdapter;
	EvaluationAdapter evaluationAdapter;
	List <Goods>  goodsList=null;
	int shopID;
	TextView shopName,tv_fenshu,tv_pingjia,photosNumber,tv_dianhua,tv_dizhi,tv_moreping;
	RatingBar shopScore;
	ImageView img_blumn;
	private DisplayImageOptions options = null;
	User user=null;
	
	ImageView iv_collection;
	int isBookmark=0;
	
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_store_detail);
		initView();
		initData();
		shopID=getIntent().getIntExtra("shopID", 0);
		user=ShareUtil.readUser(context);
	}

	@SuppressWarnings("deprecation")
	private void initView(){
		options = new DisplayImageOptions.Builder()
		.showImageOnLoading(R.drawable.pic)// 设置图片在下载期间显示的图片
		.showImageForEmptyUri(R.drawable.pic)	// 设置图片Uri为空或是错误的时候显示的图片
		.showImageOnFail(R.drawable.pic)// 设置图片加载/解码过程中错误时候显示的图片
		.displayer(new RoundedBitmapDisplayer(0xff000000, 10))
		.bitmapConfig(Bitmap.Config.RGB_565)
		.imageScaleType(ImageScaleType.IN_SAMPLE_INT)
		.cacheOnDisc(true)
		.build();
		
		pingListView = (ListView) findViewById(R.id.lv_evaluation);
		nearListView = (ListView) findViewById(R.id.lv_near_store);
		((ImageView) findViewById(R.id.ib_returns)).setOnClickListener(this);
		img_blumn=(ImageView)findViewById(R.id.img_blumn);
		img_blumn.setOnClickListener(this);//商家相册
		((ImageView) findViewById(R.id.vip)).setOnClickListener(this);
		((TextView) findViewById(R.id.tv_down)).setOnClickListener(this);
		tv_moreping=(TextView) findViewById(R.id.tv_moreping);
		tv_moreping.setOnClickListener(this);
		shopName=(TextView)findViewById(R.id.txt_shop_title);
		shopScore=(RatingBar)findViewById(R.id.rtb_store);
		tv_fenshu=(TextView)findViewById(R.id.tv_fenshu);
		tv_pingjia=(TextView)findViewById(R.id.tv_pingjia);
		photosNumber=(TextView)findViewById(R.id.photosNumber);
		tv_dianhua=(TextView)findViewById(R.id.tv_dianhua);
		tv_dizhi=(TextView)findViewById(R.id.tv_dizhi);
		iv_collection=(ImageView)findViewById(R.id.iv_collection);
		iv_collection.setOnClickListener(this);
	}
	
	private void initData() {
		getGoodsList();
		evaluationAdapter = new EvaluationAdapter(context,GetData.getEvaluationList(3));
		pingListView.setAdapter(evaluationAdapter);
		Utility.setListViewHeightBasedOnChildren(pingListView,230);
	}   
    
	private final class mListener implements OnItemClickListener {
		@SuppressLint("ResourceAsColor")
		public void onItemClick(AdapterView<?> adapter, View view, int position,long arg3) {
			Goods  goods=tanGouAdapter.getItem(position); 
			Intent intent = new Intent(StoreDetailActivity.this,GroupPurchaseActivity.class);
			intent.putExtra("goodsID", goods.getGoodsID());
			startActivity(intent);
		}
	}
	
	private   void getGoodsList(){
		RequestParams params = new RequestParams(); // 绑定参数	
		params.put("shopID", shopID);
		params.put("opeType", "getDetils");
		params.put("requestType", 1);
		params.put("mobile", 1);
		 
		 HttpUtils.post(HttpUrl.SHOPACTION, params, new JsonHttpResponseHandler(){

			@Override
			public void onSuccess(int statusCode, Header[] arg1, String responseString) {
				 if(statusCode==200){
//						try {
//							JSONObject obj =  JSON.parseObject(responseString);
//							Boolean result=obj.getBoolean("success");
//							if(result){
//								String content=obj.getString("content");		
//								//控件绑值
//								ShopDetail detail=JSON.parseObject(content, ShopDetail.class);
//								shopName.setText(detail.getName());
//								shopScore.setRating(detail.getCommentScore());
//								tv_fenshu.setText(detail.getCommentScore()+"分");
//								tv_pingjia.setText(detail.getCommentNum()+"人评价");
//								tv_dianhua.setText(detail.getTel());
//								tv_dizhi.setText(detail.getAddress());
//								List<AlbumImage>imgs=detail.getImgs();
//								photosNumber.setText("共"+imgs.size()+"张");//照片数
//								imageLoader.displayImage(imgs.get(0).getImgurl(),img_blumn, options);	
//								tv_moreping.setText("查看全部"+detail.getEvaluationNum()+"条评论");// 评论数
//								
//								JSONObject objContent=JSON.parseObject(content);
//								JSONArray imgArray = objContent.getJSONArray("imgs");
//								final String imgString=imgArray.toString();
//								
//								img_blumn.setOnClickListener(new OnClickListener() {
//									@Override
//									public void onClick(View v) {
//										//TODO 商家相册
//										Intent intent = new Intent(StoreDetailActivity.this,StoreAlbumActivity.class);
//										Bundle bundle=new Bundle();
//										bundle.putString("imgs", imgString);
//										intent.putExtras(bundle);
//										startActivity(intent);
//									}
//								});
//
//								
//								JSONArray arr = objContent.getJSONArray("otherGoodsList");	
//								String jsonString=arr.toString();
//								goodsList=JSON.parseArray(jsonString, Goods.class);
//								tanGouAdapter = new NearTuanGouAdapter(context, goodsList);
//								nearListView.setAdapter(tanGouAdapter);
//								nearListView.setOnItemClickListener(new mListener());
//								Utility.setListViewHeightBasedOnChildren(nearListView,25);								
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
					String json=GetData.getGoodsList();
					try {
						JSONObject obj =  JSON.parseObject(json);
						Boolean result=obj.getBoolean("success");
						if(result){
							String content=obj.getString("content");		
							//控件绑值
							ShopDetail detail=JSON.parseObject(content, ShopDetail.class);
							shopName.setText(detail.getName());
							shopScore.setRating(detail.getCommentScore());
							tv_fenshu.setText(detail.getCommentScore()+"分");
							tv_pingjia.setText(detail.getCommentNum()+"评价");
							tv_dizhi.setText(detail.getAddress());
							List<AlbumImage>imgs=detail.getImgs();
							photosNumber.setText("共"+imgs.size()+"张");//照片数
							imageLoader.displayImage(imgs.get(0).getImgurl(),img_blumn, options);	
							tv_moreping.setText("查看全部"+detail.getEvaluationNum()+"条评论");// 评论数
						   isBookmark=detail.getIsBookmark();
							if(isBookmark==1){
								iv_collection.setImageResource(R.drawable.ic_action_favorite_on);
							}else if(isBookmark==0){
								iv_collection.setImageResource(R.drawable.ic_action_favorite_on);
							}
							
							final String phone=detail.getTel();
							tv_dianhua.setText(phone);
							tv_dianhua.setOnClickListener(new OnClickListener() {
								@Override
								public void onClick(View v) {
									//  拨打商家电话
									Intent intentPhone = new Intent();
									intentPhone.setAction(Intent.ACTION_DIAL);
									intentPhone.setData(Uri.parse("tel:"+phone));
									startActivity(intentPhone);								
								}
							});
							
							JSONObject objContent=JSON.parseObject(content);
							JSONArray imgArray = objContent.getJSONArray("imgs");
							final String imgString=imgArray.toString();
							
							img_blumn.setOnClickListener(new OnClickListener() {
								@Override
								public void onClick(View v) {
									//TODO 商家相册
									Intent intent = new Intent(StoreDetailActivity.this,StoreAlbumActivity.class);
									Bundle bundle=new Bundle();
									bundle.putString("imgs", imgString);
									intent.putExtras(bundle);
									startActivity(intent);
								}
							});

							
							JSONArray arr = objContent.getJSONArray("otherGoodsList");	
							String jsonString=arr.toString();
							goodsList=JSON.parseArray(jsonString, Goods.class);
							tanGouAdapter = new NearTuanGouAdapter(context, goodsList);
							nearListView.setAdapter(tanGouAdapter);
							nearListView.setOnItemClickListener(new mListener());
							Utility.setListViewHeightBasedOnChildren(nearListView,25);								
						}else{
							Toast.makeText(context, getResources().getString(R.string.dialog_title_getDataFail), Toast.LENGTH_SHORT).show();
						}							
					} catch (JSONException e) {
						e.printStackTrace();
					}
			}			 
		 });
}
		
	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.ib_returns:
			finish();
			break;
		case R.id.vip:
			showAlert();
			popupWindow.showAtLocation(findViewById(R.id.ll_store),Gravity.CENTER, 0, 0);
			break;
		case R.id.tv_down:
			// 添加到我的会员卡
			createMemberCard();
			break;
		case R.id.tv_moreping:
			// 商家评价
			jumpToActivity(StoreDetailActivity.this,EvaluationStoresActivity.class);
			break;
		case R.id.iv_collection:
			//0添加收藏  1删除收藏
			if(isBookmark==0){
				addBookmark();
			}else if(isBookmark==1){
				delBookmark();
			}
			break;
		}
	}
	
	
	private   void delBookmark(){
		RequestParams params = new RequestParams(); // 绑定参数	
		params.put("username", user.getUsername());
		params.put("token", user.getToken());
		params.put("id", shopID);
		params.put("opeType", "del");
		params.put("type", 2);
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
							String message=objContent.getString("message");//(true:message成功信息， false:message传递错误信息)
							if(result){
								iv_collection.setImageResource(R.drawable.ic_action_favorite_off);
								Toast.makeText(StoreDetailActivity.this, message, Toast.LENGTH_SHORT).show();	
							}else{
								Toast.makeText(StoreDetailActivity.this, "取消收藏失败！", Toast.LENGTH_SHORT).show();	
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
		RequestParams params = new RequestParams(); // 绑定参数	
		params.put("username", user.getUsername());
		params.put("token", user.getToken());
		params.put("id", shopID);
		params.put("opeType", "add");
		params.put("type", 2);
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
							String message=objContent.getString("message");//(true:message成功信息， false:message传递错误信息)
							if(result){
								iv_collection.setImageResource(R.drawable.ic_action_favorite_on);
								Toast.makeText(StoreDetailActivity.this, message, Toast.LENGTH_SHORT).show();	
							}else{
								Toast.makeText(StoreDetailActivity.this, "收藏失败！", Toast.LENGTH_SHORT).show();	
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
	
	private   void createMemberCard(){
		RequestParams params = new RequestParams(); // 绑定参数	
		params.put("username", user.getUsername());
		params.put("token", user.getToken());
		params.put("shopID", shopID);
		params.put("opeType", "createMemberCard");
		params.put("requestType", 1);
		params.put("mobile", 1);
		 
		 HttpUtils.post(HttpUrl.MEMBERCARDACTION, params, new JsonHttpResponseHandler(){

			@Override
			public void onSuccess(int statusCode, Header[] arg1, String responseString) {
				 if(statusCode==200){
						try {
							JSONObject obj =  JSON.parseObject(responseString); 
							String content=obj.getString("content");			
							JSONObject objContent=JSON.parseObject(content);
							Boolean result=objContent.getBoolean("result");
//							String cardId=objContent.getString("cardID");
							String message=objContent.getString("message");//(true:message成功信息， false:message传递错误信息)
							if(result){
								jumpToActivity(StoreDetailActivity.this, MembershipCardActivity.class);		
								finish();
							}
								Toast.makeText(StoreDetailActivity.this, message, Toast.LENGTH_SHORT).show();			
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

	private void showAlert() {

		if (null != popupWindow) {
			popupWindow.dismiss();
			return;
		} else {
			View popupWindow_view = getLayoutInflater().inflate(
					R.layout.vip_dialog, null, false);
			popupWindow = new PopupWindow(popupWindow_view,
					LayoutParams.WRAP_CONTENT, LayoutParams.WRAP_CONTENT, true);
			popupWindow.setBackgroundDrawable(new BitmapDrawable());
			ImageView close = (ImageView) popupWindow_view
					.findViewById(R.id.img_close_dialog);
			close.setOnClickListener(new View.OnClickListener() {
				public void onClick(View v) {
					popupWindow.dismiss();
				}
			});
		}
	}

}

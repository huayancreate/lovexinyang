package com.huayan.life.Activity;

import java.io.File;
import java.io.FileOutputStream;

import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.pm.PackageInfo;
import android.content.pm.PackageManager;
import android.content.pm.PackageManager.NameNotFoundException;
import android.graphics.Bitmap;
import android.graphics.Bitmap.CompressFormat;
import android.graphics.BitmapFactory;
import android.os.Bundle;
import android.os.Environment;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.RelativeLayout;
import android.widget.Toast;
import cn.sharesdk.framework.AbstractWeibo;
import cn.sharesdk.onekeyshare.ShareAllGird;

import com.huayan.life.R;
import com.huayan.life.model.MyApp;

/**
 * 更多
 * @author wzz
 *
 */
public class MoreActivity extends BaseActivity implements OnClickListener {


	private MyApp app;
	private int currentVersionCode;
	public static String TEST_IMAGE;
	
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_more);
		app = (MyApp) getApplication();
		initView();
		//初始化ShareSDK
		AbstractWeibo.initSDK(this);	
		initImagePath();
	}

	private void initView() {
		((RelativeLayout) findViewById(R.id.type_layout10)).setOnClickListener(this);
		((RelativeLayout) findViewById(R.id.type_layout6)).setOnClickListener(this);
		((RelativeLayout) findViewById(R.id.type_layout7)).setOnClickListener(this);		
		((RelativeLayout) findViewById(R.id.type_layout8)).setOnClickListener(this);
		((RelativeLayout) findViewById(R.id.type_layout9)).setOnClickListener(this);
		((RelativeLayout) findViewById(R.id.type_layout4)).setOnClickListener(this);
		((RelativeLayout) findViewById(R.id.type_layout3)).setOnClickListener(this);
	}

	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.type_layout10:
			jumpToActivity(MoreActivity.this,AboutActivity.class);//关于
			break;
		case R.id.type_layout6:
			Intent intent = new Intent();
			intent.setClass(MoreActivity.this, MipcaActivityCapture.class);//扫一扫
			intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
			startActivityForResult(intent, 1);
			break;
		case R.id.type_layout7:
			jumpToActivity(MoreActivity.this,FeedbackActivity.class); //意见反馈
			break;
		case R.id.type_layout8:
			jumpToActivity(MoreActivity.this,PaidHelpActivity.class); //支付帮助
			break;
		case R.id.type_layout9:
			PackageManager manager = MoreActivity.this.getPackageManager();//检查更新 
			try {
				PackageInfo info = manager.getPackageInfo(
						MoreActivity.this.getPackageName(), 0);
				String appVersion = info.versionName; // 版本名
				currentVersionCode = info.versionCode; // 版本号
			} catch (NameNotFoundException e) {
				e.printStackTrace();
			}
			// 上面是获取manifest中的版本数据，我是使用versionCode
			// 在从服务器获取到最新版本的versionCode,比较
			showUpdateDialog();
			break;
		case R.id.type_layout4:
			// TODO 清空缓存
			Toast.makeText(this, "缓存已清空", Toast.LENGTH_SHORT).show();
			break;
		case R.id.type_layout3:
//			jumpToActivity(MoreActivity.class); //分享设置
			showGrid(false);
			break;
		}
	}

	private void showGrid(boolean silent) {
		Intent i = new Intent(this, ShareAllGird.class);
		// 分享时Notification的图标
		i.putExtra("notif_icon", R.drawable.icon);
		// 分享时Notification的标题
		i.putExtra("notif_title", this.getString(R.string.app_name));

		// title标题，在印象笔记、邮箱、信息、微信（包括好友和朋友圈）、人人网和QQ空间使用，否则可以不提供
		i.putExtra("title", this.getString(R.string.share));
		// titleUrl是标题的网络链接，仅在人人网和QQ空间使用，否则可以不提供
		i.putExtra("titleUrl", "http://sharesdk.cn");
		// text是分享文本，所有平台都需要这个字段
		i.putExtra("text", this.getString(R.string.share_content));
		// imagePath是本地的图片路径，所有平台都支持这个字段，不提供，则表示不分享图片
		i.putExtra("imagePath", TEST_IMAGE);
		// url仅在微信（包括好友和朋友圈）中使用，否则可以不提供
		i.putExtra("url", "http://sharesdk.cn");
		// thumbPath是缩略图的本地路径，仅在微信（包括好友和朋友圈）中使用，否则可以不提供
		i.putExtra("thumbPath", TEST_IMAGE);
		// appPath是待分享应用程序的本地路劲，仅在微信（包括好友和朋友圈）中使用，否则可以不提供
		i.putExtra("appPath", TEST_IMAGE);
		// comment是我对这条分享的评论，仅在人人网和QQ空间使用，否则可以不提供
		i.putExtra("comment", this.getString(R.string.share));
		// site是分享此内容的网站名称，仅在QQ空间使用，否则可以不提供
		i.putExtra("site", this.getString(R.string.app_name));
		// siteUrl是分享此内容的网站地址，仅在QQ空间使用，否则可以不提供
		i.putExtra("siteUrl", "http://sharesdk.cn");

		// 是否直接分享
		i.putExtra("silent", silent);
		this.startActivity(i);
	}
	
	/**
	 * 初始化分享的图片
	 */
	private void initImagePath() {
		try {//判断SD卡中是否存在此文件夹
			if (Environment.MEDIA_MOUNTED.equals(Environment.getExternalStorageState())
					&& Environment.getExternalStorageDirectory().exists()) {
				TEST_IMAGE = Environment.getExternalStorageDirectory().getAbsolutePath() + "/pic.png";
			}
			else {
				TEST_IMAGE = getApplication().getFilesDir().getAbsolutePath() + "/pic.png";
			}
			File file = new File(TEST_IMAGE);
			//判断图片是否存此文件夹中
			if (!file.exists()) {
				file.createNewFile();
				Bitmap pic = BitmapFactory.decodeResource(getResources(), R.drawable.pic);
				FileOutputStream fos = new FileOutputStream(file);
				pic.compress(CompressFormat.JPEG, 100, fos);
				fos.flush();
				fos.close();
			}
		} catch(Throwable t) {
			t.printStackTrace();			
			TEST_IMAGE = null;
		}
	}
	
	
	private void showUpdateDialog() {
		AlertDialog.Builder builder = new AlertDialog.Builder(this);
		builder.setIcon(android.R.drawable.ic_dialog_info);
		builder.setTitle("检测到新版本");
		builder.setMessage("是否下载更新?");
		builder.setPositiveButton("立即下载",
				new DialogInterface.OnClickListener() {

					@Override
					public void onClick(DialogInterface dialog, int which) {
						Intent it = new Intent(MoreActivity.this,
								NotificationUpdateActivity.class);
						startActivityForResult(it, 2);
						app.setDownload(true);
					}
				}).setNegativeButton("下次再说",
				new DialogInterface.OnClickListener() {

					@Override				
					public void onClick(DialogInterface dialog, int which) {
					}
				});
		builder.show();
	}

}

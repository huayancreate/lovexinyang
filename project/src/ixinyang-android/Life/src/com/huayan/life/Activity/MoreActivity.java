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
 * ����
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
		//��ʼ��ShareSDK
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
			jumpToActivity(MoreActivity.this,AboutActivity.class);//����
			break;
		case R.id.type_layout6:
			Intent intent = new Intent();
			intent.setClass(MoreActivity.this, MipcaActivityCapture.class);//ɨһɨ
			intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
			startActivityForResult(intent, 1);
			break;
		case R.id.type_layout7:
			jumpToActivity(MoreActivity.this,FeedbackActivity.class); //�������
			break;
		case R.id.type_layout8:
			jumpToActivity(MoreActivity.this,PaidHelpActivity.class); //֧������
			break;
		case R.id.type_layout9:
			PackageManager manager = MoreActivity.this.getPackageManager();//������ 
			try {
				PackageInfo info = manager.getPackageInfo(
						MoreActivity.this.getPackageName(), 0);
				String appVersion = info.versionName; // �汾��
				currentVersionCode = info.versionCode; // �汾��
			} catch (NameNotFoundException e) {
				e.printStackTrace();
			}
			// �����ǻ�ȡmanifest�еİ汾���ݣ�����ʹ��versionCode
			// �ڴӷ�������ȡ�����°汾��versionCode,�Ƚ�
			showUpdateDialog();
			break;
		case R.id.type_layout4:
			// TODO ��ջ���
			Toast.makeText(this, "���������", Toast.LENGTH_SHORT).show();
			break;
		case R.id.type_layout3:
//			jumpToActivity(MoreActivity.class); //��������
			showGrid(false);
			break;
		}
	}

	private void showGrid(boolean silent) {
		Intent i = new Intent(this, ShareAllGird.class);
		// ����ʱNotification��ͼ��
		i.putExtra("notif_icon", R.drawable.icon);
		// ����ʱNotification�ı���
		i.putExtra("notif_title", this.getString(R.string.app_name));

		// title���⣬��ӡ��ʼǡ����䡢��Ϣ��΢�ţ��������Ѻ�����Ȧ������������QQ�ռ�ʹ�ã�������Բ��ṩ
		i.putExtra("title", this.getString(R.string.share));
		// titleUrl�Ǳ�����������ӣ�������������QQ�ռ�ʹ�ã�������Բ��ṩ
		i.putExtra("titleUrl", "http://sharesdk.cn");
		// text�Ƿ����ı�������ƽ̨����Ҫ����ֶ�
		i.putExtra("text", this.getString(R.string.share_content));
		// imagePath�Ǳ��ص�ͼƬ·��������ƽ̨��֧������ֶΣ����ṩ�����ʾ������ͼƬ
		i.putExtra("imagePath", TEST_IMAGE);
		// url����΢�ţ��������Ѻ�����Ȧ����ʹ�ã�������Բ��ṩ
		i.putExtra("url", "http://sharesdk.cn");
		// thumbPath������ͼ�ı���·��������΢�ţ��������Ѻ�����Ȧ����ʹ�ã�������Բ��ṩ
		i.putExtra("thumbPath", TEST_IMAGE);
		// appPath�Ǵ�����Ӧ�ó���ı���·��������΢�ţ��������Ѻ�����Ȧ����ʹ�ã�������Բ��ṩ
		i.putExtra("appPath", TEST_IMAGE);
		// comment���Ҷ�������������ۣ�������������QQ�ռ�ʹ�ã�������Բ��ṩ
		i.putExtra("comment", this.getString(R.string.share));
		// site�Ƿ�������ݵ���վ���ƣ�����QQ�ռ�ʹ�ã�������Բ��ṩ
		i.putExtra("site", this.getString(R.string.app_name));
		// siteUrl�Ƿ�������ݵ���վ��ַ������QQ�ռ�ʹ�ã�������Բ��ṩ
		i.putExtra("siteUrl", "http://sharesdk.cn");

		// �Ƿ�ֱ�ӷ���
		i.putExtra("silent", silent);
		this.startActivity(i);
	}
	
	/**
	 * ��ʼ�������ͼƬ
	 */
	private void initImagePath() {
		try {//�ж�SD�����Ƿ���ڴ��ļ���
			if (Environment.MEDIA_MOUNTED.equals(Environment.getExternalStorageState())
					&& Environment.getExternalStorageDirectory().exists()) {
				TEST_IMAGE = Environment.getExternalStorageDirectory().getAbsolutePath() + "/pic.png";
			}
			else {
				TEST_IMAGE = getApplication().getFilesDir().getAbsolutePath() + "/pic.png";
			}
			File file = new File(TEST_IMAGE);
			//�ж�ͼƬ�Ƿ����ļ�����
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
		builder.setTitle("��⵽�°汾");
		builder.setMessage("�Ƿ����ظ���?");
		builder.setPositiveButton("��������",
				new DialogInterface.OnClickListener() {

					@Override
					public void onClick(DialogInterface dialog, int which) {
						Intent it = new Intent(MoreActivity.this,
								NotificationUpdateActivity.class);
						startActivityForResult(it, 2);
						app.setDownload(true);
					}
				}).setNegativeButton("�´���˵",
				new DialogInterface.OnClickListener() {

					@Override				
					public void onClick(DialogInterface dialog, int which) {
					}
				});
		builder.show();
	}

}

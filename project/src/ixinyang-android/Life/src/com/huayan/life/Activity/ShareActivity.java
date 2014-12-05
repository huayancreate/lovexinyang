package com.huayan.life.Activity;

import java.io.File;
import java.io.FileOutputStream;

import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.Bitmap.CompressFormat;
import android.graphics.BitmapFactory;
import android.os.Bundle;
import android.os.Environment;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.RelativeLayout;
import android.widget.TextView;
import cn.sharesdk.framework.AbstractWeibo;
import cn.sharesdk.onekeyshare.ShareAllGird;

/**
 * ��������
 * @author wzz
 *
 */
public class ShareActivity extends BaseActivity implements OnClickListener {

	RelativeLayout sinaLayout,tenxunLayout,weixinLayout;
	public static String TEST_IMAGE;
	
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_share);
		((TextView) findViewById(R.id.go_back)).setOnClickListener(this);	
		((TextView)findViewById(R.id.header_name)).setText(R.string.share_seting);
		
		sinaLayout=(RelativeLayout)findViewById(R.id.share_seting_layout2);
		sinaLayout.setOnClickListener(this);
		tenxunLayout=(RelativeLayout)findViewById(R.id.share_seting_layout3);
		tenxunLayout.setOnClickListener(this);
		weixinLayout=(RelativeLayout)findViewById(R.id.share_seting_layout4);
		weixinLayout.setOnClickListener(this);
		//��ʼ��ShareSDK
		AbstractWeibo.initSDK(this);	
		initImagePath();
	}

	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.go_back:
			jumpToActivity(ShareActivity.this, MoreActivity.class);
			break;
		case R.id.share_seting_layout2:
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
}

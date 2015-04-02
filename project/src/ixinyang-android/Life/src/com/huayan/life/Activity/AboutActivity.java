package com.huayan.life.Activity;

import android.content.Intent;
import android.content.pm.PackageInfo;
import android.content.pm.PackageManager;
import android.content.pm.PackageManager.NameNotFoundException;
import android.net.Uri;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageView;
import android.widget.TextView;

import com.huayan.life.R;

/**
 * πÿ”⁄
 * @author wzz
 *
 */
public class AboutActivity extends BaseActivity implements OnClickListener {

	TextView info, info_phone, text_version;

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_about);
		info = (TextView) findViewById(R.id.info);
		info.setOnClickListener(this);
		info_phone = (TextView) findViewById(R.id.info_phone);
		info_phone.setOnClickListener(this);
		((ImageView) findViewById(R.id.go_back)).setOnClickListener(this);
		((TextView)findViewById(R.id.header_name)).setText(R.string.about_xinyan);
		text_version = (TextView) findViewById(R.id.txt_version);
		getVersion();
	}

	private void getVersion() {
		PackageManager manager;
		PackageInfo info = null;
		manager = this.getPackageManager();
		try {
			info = manager.getPackageInfo(this.getPackageName(), 0);
			text_version.setText("∞Æ–≈—ÙV" + info.versionName);
		} catch (NameNotFoundException e) {
			e.printStackTrace();
		}
	}

	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.info:
			jumpToActivity(AboutActivity.this,UserAgreementActivity.class);		
			break;
		case R.id.go_back:
			finish();
			break;
		case R.id.info_phone:
			Intent intentPhone = new Intent();
			intentPhone.setAction(Intent.ACTION_DIAL);
			intentPhone.setData(Uri.parse("tel:4006605353"));
			startActivity(intentPhone);
			break;
		}
	}

}

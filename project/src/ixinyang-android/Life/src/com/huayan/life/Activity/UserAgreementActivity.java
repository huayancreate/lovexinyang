package com.huayan.life.Activity;

import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.webkit.WebView;
import android.widget.ImageView;
import android.widget.TextView;

import com.huayan.life.R;

/**
 * 用户协议
 * @author wzz
 *
 */
public class UserAgreementActivity extends BaseActivity implements OnClickListener {

	private WebView mWebView;

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_user_agreement);
		mWebView = (WebView) findViewById(R.id.webWiew);
		mWebView.getSettings().setJavaScriptEnabled(true);
		mWebView.loadUrl("file:///android_asset/common_FQA/index.html");
		((ImageView) findViewById(R.id.go_back)).setOnClickListener(this);
		((TextView)findViewById(R.id.header_name)).setText("用户协议");
	}

	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.go_back:
			finish();
			break;
		}
	}
}

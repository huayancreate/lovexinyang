package com.huayan.life.Activity;

import android.app.ActivityGroup;
import android.content.Intent;
import android.content.res.Configuration;
import android.content.res.Resources;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.ImageView;
import android.widget.TabHost;
import android.widget.TextView;

import com.huayan.life.R;

/**
 * 主控制页面
 * 
 * @author
 * @date
 */
public class MainActivity extends ActivityGroup {

	private TabHost mTabHost;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_main);
		initTabs();
	}
	

	private void initTabs() {
		mTabHost = (TabHost) findViewById(R.id.tabhost);
		mTabHost.setup(this.getLocalActivityManager());

		Intent intent = new Intent(this, RecommendActivity.class);		
		mTabHost.addTab(mTabHost.newTabSpec(getResources().getString(R.string.recommend)).setContent(intent)
				.setIndicator(getTabView(R.drawable.selector_tab_home,getString(R.string.recommend),R.layout.app_tab_layout)));

		intent = new Intent(this, StoreActivity.class);
		mTabHost.addTab(mTabHost.newTabSpec(getResources().getString(R.string.my_store)).setContent(intent)
				.setIndicator(getTabView(R.drawable.selector_tab_message,getString(R.string.my_store),R.layout.app_tab_layout)));
		
		intent = new Intent(this, MyActivity.class);
		mTabHost.addTab(mTabHost.newTabSpec(getResources().getString(R.string.my_content)).setContent(intent)
				.setIndicator(getTabView(R.drawable.selector_tab_contacts,getString(R.string.my_content),R.layout.app_tab_layout)));
		
		intent = new Intent(this, MoreActivity.class);
		mTabHost.addTab(mTabHost.newTabSpec(getResources().getString(R.string.my_more)).setContent(intent)
				.setIndicator(getTabView(R.drawable.selector_tab_home,getString(R.string.my_more),R.layout.app_tab_layout)));
	}

	
	private View getTabView(int icon, String label, int viewId) {
		View localView = LayoutInflater.from(this).inflate(viewId, null);
		ImageView iconView = (ImageView) localView.findViewById(R.id.icon);
		TextView labelView = (TextView) localView.findViewById(R.id.title);
		iconView.setBackgroundResource(icon);
		labelView.setText(label);
		return localView;
	}


	@Override
	protected void onResume() {
		super.onResume();
	}

	@Override
	protected void onStop() {
		super.onStop();
	}

	@Override
	protected void onPause() {
		super.onPause();
	}
	
	/**
	 * app字体不随系统字体的大小改变而改变
	 */
	@Override  
	public Resources getResources() {  
	    Resources res = super.getResources();    
	    Configuration config=new Configuration();    
	    config.setToDefaults();    
	    res.updateConfiguration(config,res.getDisplayMetrics() );  
	    return res;  
	}  
}
package com.huayan.life.model;

import android.app.Application;

public class MyApp extends Application {

	private boolean isDownload;

	@Override
	public void onCreate() {
		super.onCreate();
		isDownload = false;
	}

	public boolean isDownload() {
		return isDownload;
	}

	public void setDownload(boolean isDownload) {
		this.isDownload = isDownload;
	}
	
	
}

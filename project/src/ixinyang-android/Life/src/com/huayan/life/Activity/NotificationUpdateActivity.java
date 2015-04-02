package com.huayan.life.Activity;

import android.app.Activity;
import android.content.ComponentName;
import android.content.Context;
import android.content.Intent;
import android.content.ServiceConnection;
import android.os.Bundle;
import android.os.Handler;
import android.os.IBinder;
import cn.jpush.android.api.JPushInterface;

import com.huayan.life.R;
import com.huayan.life.model.MyApp;
import com.huayan.life.service.DownloadService;
import com.huayan.life.service.DownloadService.DownloadBinder;

public class NotificationUpdateActivity extends Activity {

	private DownloadBinder binder;
	private boolean isBinded;
	private boolean isDestroy = true;
	private MyApp app;
	
	@Override
	public void onCreate(Bundle savedInstanceState) {		
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_more);
		app = (MyApp) getApplication();
}

	ServiceConnection conn = new ServiceConnection() {

		@Override
		public void onServiceDisconnected(ComponentName name) {
			isBinded = false;
		}

		@Override
		public void onServiceConnected(ComponentName name, IBinder service) {
			binder = (DownloadBinder) service;
			System.out.println("服务启动!!!");
			// 开始下载
			isBinded = true;
			binder.addCallback(callback);
			binder.start();
		}
	};

	@Override
	protected void onResume() {
		super.onResume();
		if (isDestroy && app.isDownload()) {
			Intent it = new Intent(NotificationUpdateActivity.this, DownloadService.class);
			startService(it);
			bindService(it, conn, Context.BIND_AUTO_CREATE);
		}
		System.out.println(" notification  onresume");
		JPushInterface.onResume(this);
	}

	@Override
	protected void onNewIntent(Intent intent) {
		super.onNewIntent(intent);
		if (isDestroy && app.isDownload()) {
			Intent it = new Intent(NotificationUpdateActivity.this, DownloadService.class);
			startService(it);
			bindService(it, conn, Context.BIND_AUTO_CREATE);
		}
		System.out.println(" notification  onNewIntent");
	}

	@Override
	protected void onStart() {
		super.onStart();
	}

	@Override
	protected void onPause() {
		super.onPause();
		System.out.println(" notification  onPause");
		JPushInterface.onPause(this);
	}

	@Override
	protected void onStop() {
		super.onStop();
		isDestroy = false;
		System.out.println(" notification  onStop");
	}

	@Override
	protected void onDestroy() {
		super.onDestroy();
		if (isBinded) {
			System.out.println(" onDestroy   unbindservice");
			unbindService(conn);
		}
		if (binder != null && binder.isCanceled()) {
			System.out.println(" onDestroy  stopservice");
			Intent it = new Intent(this, DownloadService.class);
			stopService(it);
		}
	}

	private ICallbackResult callback = new ICallbackResult() {

		@Override
		public void OnBackResult(Object result) {
			if ("finish".equals(result)) {
				finish();
				return;
			}
			int i = (Integer) result;
			//mProgressBar.setProgress(i);
			// tv_progress.setText("当前进度 =>  "+i+"%");
			// tv_progress.postInvalidate();
			mHandler.sendEmptyMessage(i);
		}
	};

	private Handler mHandler = new Handler() {
		public void handleMessage(android.os.Message msg) {
			//	tv_progress.setText("当前进度 ： " + msg.what + "%");
		};
	};

	public interface ICallbackResult {
		public void OnBackResult(Object result);
	}
}

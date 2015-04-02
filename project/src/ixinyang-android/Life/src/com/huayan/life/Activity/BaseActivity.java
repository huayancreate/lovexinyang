package com.huayan.life.Activity;

import java.util.ArrayList;
import java.util.List;
import java.util.Map;

import util.GetLocation;
import util.Network;
import android.annotation.SuppressLint;
import android.app.Activity;
import android.app.AlertDialog;
import android.app.AlertDialog.Builder;
import android.app.Dialog;
import android.content.ComponentName;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.res.Configuration;
import android.content.res.Resources;
import android.os.Bundle;
import android.provider.Settings;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.TextView;
import cn.jpush.android.api.JPushInterface;

import com.huayan.life.R;
import com.nostra13.universalimageloader.core.ImageLoader;


/**
 * base Activity
 * @author Administrator
 *
 */
@SuppressLint("CutPasteId")
public abstract class BaseActivity extends Activity{

	public Map<String, String> map;
	
	public static List<Activity> activityList = new ArrayList<Activity>();
    public String tag = this.getClass().getSimpleName(); // tag 用于测试log用
	public  Context context; // 存储上下文对象
	public int show_title = 0;
	GetLocation loc=null;
	protected ImageLoader imageLoader = ImageLoader.getInstance();
	
	@Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        //初始化
        if(activityList == null) activityList = new ArrayList<Activity>();
        activityList.add(this);
        context = this;
        
        loc=new GetLocation(context);
        loc.getLocation();
      //控制切屏模式
//		this.setRequestedOrientation(Configuration.ORIENTATION_LANDSCAPE);
		this.setRequestedOrientation(Configuration.ORIENTATION_PORTRAIT);        
		checkNetWorkShowLog(sendType);
	}

	public void onCreate(Bundle savedInstanceState, boolean isCheckNetwork) {
		super.onCreate(savedInstanceState);
		//初始化
		if(activityList == null) activityList = new ArrayList<Activity>();
		activityList.add(this);
		context = this;
	    
		//控制切屏模式
//		this.setRequestedOrientation(Configuration.ORIENTATION_LANDSCAPE);
		this.setRequestedOrientation(Configuration.ORIENTATION_PORTRAIT);
		if(isCheckNetwork)
			checkNetWorkShowLog(sendType);
	}
	
	@Override
	protected void onDestroy() {
		super.onDestroy();
		try {
			if(activityList != null && activityList.size()>0 && activityList.contains(this))
				activityList.remove(this);
		} catch (Exception e) {
			e.printStackTrace();
		}
	}
	
	/**
	 * 退出程序
	 */
	public static void exit() {
		for (int i = 0; i < activityList.size(); i++) {
			if (null != activityList.get(i)) {
				activityList.get(i).finish();
			}
		}
		activityList = null;
	}
	
	public int sendType = 2;
	
	/**
	 * 
	 * 检测网络是否正常
	 * @param type sendType
	 * @return true：正常 false：不正常
	 * 创建时间：2014-6-23 
	 */
	public boolean checkNetWorkShowLog(final int type){
		//判断网络是否可用
		if (!Network.checkNetWork(context)) { // 进行网络设置
			Builder b = new AlertDialog.Builder(context).setTitle(R.string.network_show_title)
					.setMessage(R.string.network_show_msg);
			b.setPositiveButton(R.string.network_show_setting, new DialogInterface.OnClickListener() {

				public void onClick(DialogInterface dialog, int whichButton) {
					if(type == 1){ // 设置打开wif
						Intent intent=new Intent(Settings.ACTION_WIFI_SETTINGS);
//						ComponentName cName = new ComponentName("com.android.phone","com.android.phone.Settings");
//						intent.setComponent(cName);
						startActivityForResult(intent,sendType);
						sendType = 2;
					} else { // 设置打开 3G
						Intent intent=new Intent(Settings.ACTION_NETWORK_OPERATOR_SETTINGS);
						ComponentName cName = new ComponentName("com.android.phone","com.android.phone.Settings");
						intent.setComponent(cName);
						startActivityForResult(intent,sendType);
						sendType = 1;
					}
				}
			}).setNeutralButton(R.string.network_show_exit, new DialogInterface.OnClickListener() {
				public void onClick(DialogInterface dialog, int whichButton) {
//					// 进行跳转
//					Message msg = new Message();
//					msg.what = 3;
//					mHandler.sendMessage(msg);
//					dialog.dismiss();
					BaseActivity.exit();
				}
			}).show();
			return false;
		}
		return true;
	}
	
	@Override
	protected void onActivityResult(int requestCode, int resultCode, Intent data) {
		checkNetWorkShowLog(sendType);
	}
	
	
	@Override
	public Dialog onCreateDialog(int id) {
		
		LayoutInflater li = (LayoutInflater) getBaseContext().getSystemService(LAYOUT_INFLATER_SERVICE);
		View dv = (View) li.inflate(R.layout.dialog_progress, null);
		switch (id) {
		case 1:
			TextView loading = (TextView)dv.findViewById(R.id.loading);
			loading.setText(R.string.progress_loading);
			break;
		case 2:
			TextView loading2 = (TextView)dv.findViewById(R.id.loading);
			loading2.setText(R.string.progress_login);
			break;
		case 3:
			TextView loading3 = (TextView)dv.findViewById(R.id.loading);
			loading3.setText(R.string.request_loading);
			break;
		case 4:
			//	"获取数据失败";
			show_title = R.string.dialog_title_getDataFail;
			break;
		case 5:
			//"网络超时，服务器断开或者请检查网络连接是否正常";
			show_title = R.string.dialog_title_newwork_request_timeout;
			break;
		case 6:
			// "暂无数据";
			show_title = R.string.dialog_title_newData;
			break;
		case 7:
			//"获取用户信息失败";
			show_title = R.string.dialog_title_getUserInfoDataFail;
			break;
		case 8:
			//"发送数据失败";
			show_title=R.string.send_data_error;
			break;
		case 9://修改成功
			show_title=R.string.update_success;
			break;
		case 10://用户名或者密码错误
			show_title=R.string.userName_password_error;
			break;
		default:
			return null;
		}
		switch (id) {
		case 1:
		case 2:
		case 3:
			return new AlertDialog.Builder(this)
			.setView(dv).create();
		default:
			return new AlertDialog.Builder(this)
			.setMessage(show_title)
			.setPositiveButton(R.string.confirm,
					new DialogInterface.OnClickListener() {
				@Override
				public void onClick(DialogInterface dialog,
						int which) {
					dialog.dismiss();
				}
			}).create();
		}
	}
	
	public  void jumpToActivity(Context clsA,Class<?> clsB) {
		Intent intent = new Intent(clsA,clsB);
		startActivity(intent);
	}
	
	
	/**
	 * 对话框
	 * @param mess
	 */
	public void showDialog(String mess) {
		new AlertDialog.Builder(BaseActivity.this).setTitle(getResources().getString(R.string.reminder))
				.setIcon(android.R.drawable.ic_dialog_info).setMessage(mess)
				.setNegativeButton(getResources().getString(R.string.confirm), new DialogInterface.OnClickListener() {
					public void onClick(DialogInterface dialog, int which) {
						dialog.dismiss();
					}
				}).show();
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
	
	@Override
	public void onPause() {
		super.onPause();
		JPushInterface.onPause(this);
	}

	@Override
	public void onResume() {
		super.onResume();
		JPushInterface.onResume(this);
	}

}

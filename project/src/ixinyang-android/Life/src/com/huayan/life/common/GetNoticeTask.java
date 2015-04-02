package com.huayan.life.common;

import java.util.List;

import util.Network;
import util.SharedPreferencesUtility;
import android.annotation.SuppressLint;
import android.content.Context;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.Handler;
import android.os.Message;
import android.widget.Toast;

import com.alibaba.fastjson.JSON;
import com.handmark.pulltorefresh.library.PullToRefreshListView;
import com.huayan.life.Activity.NoticeActivity;
import com.huayan.life.R;
import com.huayan.life.adapter.NoticeAdapter;
import com.huayan.life.model.Notice;

@SuppressLint("HandlerLeak")
public class GetNoticeTask extends AsyncTask<String, Void, Integer> {
	
	public static final int HTTP_REQUEST_SUCCESS = -1;
	public static final int HTTP_REQUEST_ERROR = 0;
	private PullToRefreshListView mPtrlv;
	private Context mContext;
	private NoticeAdapter newAdapter;
	private Handler myHandler;
	private List<Notice> listCard=null;
	int currentPage=0;
	int totalPage=0;
	
	public GetNoticeTask(PullToRefreshListView ptrlv,Context context,NoticeAdapter adapter) {
		this.mPtrlv = ptrlv;
		this.mContext=context;
		this.newAdapter=adapter;
	}

	@Override
	protected Integer doInBackground(String... params) {
		if (Network.isWifiConnected(mContext)) {
			try {
				Thread.sleep(1000);
				return HTTP_REQUEST_SUCCESS;
			} catch (InterruptedException e) {
				e.printStackTrace();
			}
		}
		return HTTP_REQUEST_ERROR;
	}

	@Override
	protected void onPostExecute(Integer result) {
		super.onPostExecute(result);
		switch (result) {
		case HTTP_REQUEST_SUCCESS:
			SharedPreferences sp = mContext.getSharedPreferences(SharedPreferencesUtility.NOTICEACTIVITY, Context.MODE_PRIVATE);
			currentPage=sp.getInt(SharedPreferencesUtility.CURRENT_PAGE, 0);
			totalPage=sp.getInt(SharedPreferencesUtility.PAGE_COUNT, 0);
			if(totalPage!=0&&totalPage!=currentPage){
					myHandler = new Handler() {
						@Override
						public void handleMessage(Message msg) {
							if (msg.what == 0x01) {
								currentPage++;
								SharedPreferencesUtility.saveData(SharedPreferencesUtility.NOTICEACTIVITY,SharedPreferencesUtility.CURRENT_PAGE, currentPage, mContext);
								
								Bundle bundle=msg.getData();
								String jsonStr=bundle.getString("jsonString");
								
								int pageCount=bundle.getInt("pageCount");
								SharedPreferencesUtility.saveData(SharedPreferencesUtility.NOTICEACTIVITY,SharedPreferencesUtility.PAGE_COUNT, pageCount, mContext);
								
								listCard=  JSON.parseArray(jsonStr, Notice.class);	
								newAdapter.addNews(listCard);
								newAdapter.notifyDataSetChanged();
							}
							super.handleMessage(msg);
						}
					};
				NoticeActivity.getNoticeList(mContext,myHandler,currentPage);	
			}else{
				Toast.makeText(mContext, mContext.getResources().getString(R.string.no_newData), Toast.LENGTH_SHORT).show();
			}		
			
			break;
		case HTTP_REQUEST_ERROR:
			Toast.makeText(mContext, "Çë¼ì²éÍøÂç", Toast.LENGTH_SHORT).show();
			break;
		}
		mPtrlv.onRefreshComplete();
	}

}


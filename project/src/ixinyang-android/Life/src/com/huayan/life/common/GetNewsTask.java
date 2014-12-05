package com.huayan.life.common;

import util.Network;
import android.content.Context;
import android.os.AsyncTask;
import android.widget.Toast;

import com.handmark.pulltorefresh.library.PullToRefreshListView;
import com.huayan.life.adapter.NewListAdapter;

public class GetNewsTask extends AsyncTask<String, Void, Integer> {
	
	public static final int HTTP_REQUEST_SUCCESS = -1;
	public static final int HTTP_REQUEST_ERROR = 0;
	private PullToRefreshListView mPtrlv;
	private Context mContext;
	private NewListAdapter newAdapter;
	
	
	public GetNewsTask(PullToRefreshListView ptrlv,Context context,NewListAdapter adapter) {
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
			newAdapter.addNews(GetData.getSimulationNews(10));
			newAdapter.notifyDataSetChanged();
			break;
		case HTTP_REQUEST_ERROR:
			Toast.makeText(mContext, "Çë¼ì²éÍøÂç", Toast.LENGTH_SHORT).show();
			break;
		}
		mPtrlv.onRefreshComplete();
	}

}


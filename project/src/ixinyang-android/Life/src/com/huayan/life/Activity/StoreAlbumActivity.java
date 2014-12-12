package com.huayan.life.Activity;

import java.util.ArrayList;
import java.util.HashMap;

import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.ImageView;
import android.widget.TextView;

import com.huayan.life.adapter.StoreAlbumAdapter;
import com.huayan.life.view.MyGridView;

/**
 * 商家相册列表
 * @author wzz
 *
 */
public class StoreAlbumActivity extends BaseActivity implements OnClickListener {

	private MyGridView gvAlbum;

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_store_album);
		gvAlbum = (MyGridView) findViewById(R.id.gv_album);
		((ImageView) findViewById(R.id.go_back)).setOnClickListener(this);
		((TextView)findViewById(R.id.header_name)).setText(R.string.sto_album);
		StoreAlbumAdapter adapter = new StoreAlbumAdapter(context, getStoreAlbumList());
		gvAlbum.setAdapter(adapter);
		
		gvAlbum.setOnItemClickListener(new OnItemClickListener() {

			@Override
			public void onItemClick(AdapterView<?> arg0, View arg1, int arg2,long arg3) {
				finish();
			}
		});
	}
	
	private ArrayList<HashMap<String, String>> getStoreAlbumList() {
		ArrayList<HashMap<String, String>> ret = new ArrayList<HashMap<String, String>>();
		HashMap<String, String> hm;
		for (int i = 0; i < 10; i++) {
			hm = new HashMap<String, String>();
			if (i % 2 == 0) {
				hm.put("uri",
						"http://img.taobaocdn.com/bao/uploaded/i1/15700043372811105/TB2sI9VXVXXXXchXXXXXXXXXXXX_!!15335700-0-rate.jpg");

			} else {
				hm.put("uri","http://img.taobaocdn.com/bao/uploaded/i2/18783042962806492/TB2HqSYXVXXXXXDXXXXXXXXXXXX_!!1060568783-0-rate.jpg");
			}		
			ret.add(hm);
		}
		return ret;
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

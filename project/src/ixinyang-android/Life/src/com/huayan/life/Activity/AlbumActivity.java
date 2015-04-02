package com.huayan.life.Activity;

import java.util.List;

import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.Gallery;

import com.alibaba.fastjson.JSON;
import com.huayan.life.R;
import com.huayan.life.adapter.AlbumAdapter;
import com.huayan.life.model.AlbumImage;

/**
 * Õº∆¨‘§¿¿
 * 
 * @author wzz
 * 
 */
public class AlbumActivity extends BaseActivity {

	private Gallery gallery;
	List<AlbumImage> list;
	AlbumAdapter pageAdapter;

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_album);
		gallery = (Gallery) findViewById(R.id.gy_album);
		initData();
	}

	private void initData() {
		Bundle data = getIntent().getExtras();
		if (data != null) {
			String imageJson = data.getString("goodsImgs");
			list = JSON.parseArray(imageJson, AlbumImage.class);
			pageAdapter = new AlbumAdapter(context, list);
			gallery.setAdapter(pageAdapter);
		}

		gallery.setOnItemClickListener(new OnItemClickListener() {
			@Override
			public void onItemClick(AdapterView<?> arg0, View arg1, int arg2,long arg3) {
				finish();
			}
		});
	}

}

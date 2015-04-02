package com.huayan.life.Activity;

import java.util.List;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.ImageView;
import android.widget.TextView;

import com.alibaba.fastjson.JSON;
import com.huayan.life.R;
import com.huayan.life.adapter.StoreAlbumAdapter;
import com.huayan.life.model.AlbumImage;
import com.huayan.life.view.MyGridView;

/**
 * 商家相册列表
 * @author wzz
 *
 */
public class StoreAlbumActivity extends BaseActivity implements OnClickListener {

	private MyGridView gvAlbum;
	StoreAlbumAdapter adapter=null;
	List<AlbumImage> list=null;
	Bundle data=null;
	
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_store_album);
		initView();
		initData();
	}
	
	private void initData(){
		data=getIntent().getExtras();
		if(data!=null){
			String imageJson=data.getString("imgs");
			list=JSON.parseArray(imageJson, AlbumImage.class);
			adapter = new StoreAlbumAdapter(context,list);
			gvAlbum.setAdapter(adapter);
		}
		
		gvAlbum.setOnItemClickListener(new OnItemClickListener() {
			@Override
			public void onItemClick(AdapterView<?> parent, View view, int position,long arg3) {
				Intent intent = new Intent(StoreAlbumActivity.this,ChildStoreAlbumActivity.class);
				data.putInt("ImagePosition", position);
				intent.putExtras(data);
				startActivity(intent);
			}
		});
	}
	
	private void initView(){
		gvAlbum = (MyGridView) findViewById(R.id.gv_album);
		((ImageView) findViewById(R.id.go_back)).setOnClickListener(this);
		((TextView)findViewById(R.id.header_name)).setText(R.string.sto_album);
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

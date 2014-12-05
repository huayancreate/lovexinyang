package com.huayan.life.Activity;

import java.util.ArrayList;
import java.util.List;

import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.Gallery;

import com.huayan.life.adapter.AlbumAdapter;
import com.huayan.life.model.AlbumImage;

/**
 * ͼƬԤ��
 * @author wzz
 *
 */
public class AlbumActivity extends BaseActivity {

	private Gallery gallery;

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_album);
		gallery = (Gallery) findViewById(R.id.gy_album);
		List<AlbumImage> list = new ArrayList<AlbumImage>();
		AlbumImage img;
		for (int i = 1; i < 11; i++) {
			img = new AlbumImage();
			img.setTitle("����ʱ��");
			if(i%2==1){
			img.setDes(i+ ".����ʱ��һ�Σ���ʿר��spa");
			img.setImgurl(	getResources().getDrawable(R.drawable.advertising_default_1));
			}else{
				img.setDes(i+ ".����ʱ�⣬���ʾ���");
				img.setImgurl(	getResources().getDrawable(R.drawable.advertising_default_2));
			}
			list.add(img);
		}
		AlbumAdapter pageAdapter = new AlbumAdapter(context, list);
		gallery.setAdapter(pageAdapter);
		
		gallery.setOnItemClickListener(new OnItemClickListener() {

			@Override
			public void onItemClick(AdapterView<?> arg0, View arg1, int arg2,long arg3) {
				finish();
			}
		});
	}
	
}

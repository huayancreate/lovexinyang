package com.huayan.life.Activity;

import java.util.ArrayList;
import java.util.List;

import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.Gallery;

import com.huayan.life.R;
import com.huayan.life.adapter.AlbumAdapter;
import com.huayan.life.model.AlbumImage;

/**
 * ∆¿¬€Õº∆¨‘§¿¿
 * @author wzz
 *
 */
public class EvaPicActivity extends BaseActivity {

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
			if(i%2==1){
			img.setTitle(i+ ".»—≈ ±π‚“ª¥Œ£¨ƒ– ø◊®œÌspa");
			img.setImgurl("http://img.taobaocdn.com/bao/uploaded/i2/18783042962806492/TB2HqSYXVXXXXXDXXXXXXXXXXXX_!!1060668783-0-rate.jpg");
			}else{
				img.setTitle(i+ ".»—≈ ±π‚£¨ Ê  æ°œÌ");
				img.setImgurl("http://img.taobaocdn.com/bao/uploaded/i2/18783042962806492/TB2HqSYXVXXXXXDXXXXXXXXXXXX_!!1060668783-0-rate.jpg");
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

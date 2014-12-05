package com.huayan.life.Activity;

import java.util.ArrayList;

import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageButton;

import com.huayan.life.adapter.HotAdapter;
import com.huayan.life.view.MyGridView;

/**
 * 搜索
 * @author wzz
 *
 */
public class QueryActivity extends BaseActivity implements OnClickListener{

	MyGridView gvHotCategory;
	HotAdapter  adapter;
	
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_query);
		((ImageButton)findViewById(R.id.ib_back)).setOnClickListener(this);
		gvHotCategory=(MyGridView)findViewById(R.id.hot_type);
		initData();
		}

		private void initData(){
			ArrayList<String> list=new ArrayList<String>();
			list.add("热门搜索");
			list.add("瑞司大叔");
			list.add("奥体中心");
			list.add("傣妹火锅");
			list.add("长江鱼馆");
			list.add("食谱世家");
			list.add("佳佳超市");
			list.add("鱼来鱼往");
			list.add("唛田KTV");
			list.add("佳淼商贸");
			list.add("美甲世界");
			list.add("永辉超市");
			adapter=new HotAdapter(context, list);
			gvHotCategory.setAdapter(adapter);
		}

	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.ib_back:
			finish();
			break;

		default:
			break;
		}
	}
}

package com.huayan.life.Activity;

import java.util.ArrayList;

import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ImageButton;

import com.huayan.life.adapter.HotAdapter;
import com.huayan.life.view.MyGridView;

/**
 * ����
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
			list.add("��������");
			list.add("��˾����");
			list.add("��������");
			list.add("���û��");
			list.add("�������");
			list.add("ʳ������");
			list.add("�Ѽѳ���");
			list.add("��������");
			list.add("����KTV");
			list.add("�����ó");
			list.add("��������");
			list.add("���Գ���");
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

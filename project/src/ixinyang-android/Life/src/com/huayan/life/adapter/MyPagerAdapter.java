package com.huayan.life.adapter;

import java.util.List;

import android.support.v4.view.PagerAdapter;
import android.support.v4.view.ViewPager;
import android.view.View;

public class MyPagerAdapter extends PagerAdapter {

	private List<View> views;

	public MyPagerAdapter(List<View> views) {
		this.views = views;
	}

	@Override
	public int getCount() {
		return views.size();
	}

	@Override
	public boolean isViewFromObject(View arg0, Object arg1) {
		return arg0 == arg1;
	}

	@Override
	public void destroyItem(View container, int position, Object object) {
		// ��ָ����view��viewPager���Ƴ�
		((ViewPager) container).removeView(views.get(position));
	}

	@Override
	public Object instantiateItem(View container, int position) {
		// ��view���ӵ�viewPager��
		((ViewPager) container).addView(views.get(position));
		return views.get(position);
	}

	public View getItemAtPosition(int position) {
		return views.get(position);
	}

}
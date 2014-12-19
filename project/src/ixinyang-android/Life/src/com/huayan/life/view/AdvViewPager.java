package com.huayan.life.view;

import android.content.Context;
import android.support.v4.view.ViewPager;
import android.util.AttributeSet;
import android.view.GestureDetector;
import android.view.GestureDetector.SimpleOnGestureListener;
import android.view.MotionEvent;
import android.view.ViewParent;

public class AdvViewPager extends ViewPager {

	GestureDetector mGestureDetector = new GestureDetector(
			new YScrollDetector());

	class YScrollDetector extends SimpleOnGestureListener {
		@Override
		public boolean onScroll(MotionEvent e1, MotionEvent e2,
				float distanceX, float distanceY) {
			if (Math.abs(distanceY) >= Math.abs(distanceX)) {
				return true;
			}
			return false;
		}
	}

	public AdvViewPager(Context context) {
		super(context);
	}

	public AdvViewPager(Context context, AttributeSet attrs) {
		super(context, attrs);
	}


	public boolean onInterceptTouchEvent(MotionEvent ev) {
		if (mGestureDetector.onTouchEvent(ev)) {
			return false;
		}
		return true;
	}

	private float x;
	private float y;

	@Override
	public boolean dispatchTouchEvent(MotionEvent ev) {
		ViewParent mViewParent = this.getParent();
		final int action = ev.getAction();
		switch (action) {
		case MotionEvent.ACTION_DOWN:
			x = ev.getX();
			y = ev.getY();
			mViewParent.requestDisallowInterceptTouchEvent(true);
			break;
		case MotionEvent.ACTION_MOVE:
			if (Math.abs(ev.getX() - x) > 10)
				mViewParent.requestDisallowInterceptTouchEvent(true);
			else if (Math.abs(ev.getY() - y) > 10)
				mViewParent.requestDisallowInterceptTouchEvent(false);
			break;
		case MotionEvent.ACTION_UP:
		case MotionEvent.ACTION_CANCEL:
			mViewParent.requestDisallowInterceptTouchEvent(false);
			break;
		}
		return super.dispatchTouchEvent(ev);
	}
}

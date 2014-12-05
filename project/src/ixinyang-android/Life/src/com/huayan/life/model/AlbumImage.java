package com.huayan.life.model;

import java.io.Serializable;

import android.graphics.drawable.Drawable;

public class AlbumImage implements Serializable {

	private static final long serialVersionUID = 1L;
	private String des;// ÃèÊö
	private String title;
	
	public String getTitle() {
		return title;
	}

	public void setTitle(String title) {
		this.title = title;
	}

	private Drawable imgurl;// Í¼Æ¬Â·¾¶

	public String getDes() {
		return des;
	}

	public void setDes(String des) {
		this.des = des;
	}

	public Drawable getImgurl() {
		return imgurl;
	}

	public void setImgurl(Drawable imgurl) {
		this.imgurl = imgurl;
	}
}

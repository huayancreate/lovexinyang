package com.huayan.life.model;

import java.io.Serializable;

public class AlbumImage extends BaseModel implements Serializable {

	private static final long serialVersionUID = 1L;
	private String title;
	private String imgurl;// Í¼Æ¬Â·¾¶

	public String getTitle() {
		return title;
	}

	public void setTitle(String title) {
		this.title = title;
	}

	public String getImgurl() {
		return imgurl;
	}

	public void setImgurl(String imgurl) {
		this.imgurl = imgurl;
	}

}

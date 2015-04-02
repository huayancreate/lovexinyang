package com.huayan.life.model;

import java.io.Serializable;

/**
 * 广告
 * 
 * @author wzz
 * 
 */
public class Banner extends BaseModel implements Serializable {

	private static final long serialVersionUID = 1L;

	private int type;// 类别 (0、纯广告 1、商家 2、商品 )
	private String img;// 图片
	private String path;// 路径

	public int getType() {
		return type;
	}

	public void setType(int type) {
		this.type = type;
	}

	public String getImg() {
		return img;
	}

	public void setImg(String img) {
		this.img = img;
	}

	public String getPath() {
		return path;
	}

	public void setPath(String path) {
		this.path = path;
	}

}

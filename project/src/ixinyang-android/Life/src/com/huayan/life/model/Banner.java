package com.huayan.life.model;

import java.io.Serializable;

/**
 * ���
 * 
 * @author wzz
 * 
 */
public class Banner extends BaseModel implements Serializable {

	private static final long serialVersionUID = 1L;

	private int type;// ��� (0������� 1���̼� 2����Ʒ )
	private String img;// ͼƬ
	private String path;// ·��

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

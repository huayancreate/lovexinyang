package com.huayan.life.model;

import java.io.Serializable;

/**
 * ������Ϣ
 * 
 * @author wzz
 * 
 */
public class Shop extends BaseModel implements Serializable {

	private static final long serialVersionUID = 1L;

	private int shopID;// (����ID)
	private String img;// (ͼƬ)
	private String shopName;// (��������)
	private MyLocation location;// (��γ��)
	private int commentNum;// ��������
	private float commentScore;// �����ܷ�
	private String type;// �̼����
	private String region;// ��Ȧ

	public int getShopID() {
		return shopID;
	}

	public void setShopID(int shopID) {
		this.shopID = shopID;
	}

	public String getImg() {
		return img;
	}

	public void setImg(String img) {
		this.img = img;
	}

	public String getShopName() {
		return shopName;
	}

	public void setShopName(String shopName) {
		this.shopName = shopName;
	}

	public MyLocation getLocation() {
		return location;
	}

	public void setLocation(MyLocation location) {
		this.location = location;
	}

	public int getCommentNum() {
		return commentNum;
	}

	public void setCommentNum(int commentNum) {
		this.commentNum = commentNum;
	}

	public float getCommentScore() {
		return commentScore;
	}

	public void setCommentScore(float commentScore) {
		this.commentScore = commentScore;
	}

	public String getType() {
		return type;
	}

	public void setType(String type) {
		this.type = type;
	}

	public String getRegion() {
		return region;
	}

	public void setRegion(String region) {
		this.region = region;
	}

}

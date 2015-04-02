package com.huayan.life.model;

import java.io.Serializable;

/**
 * 店铺信息
 * 
 * @author wzz
 * 
 */
public class Shop extends BaseModel implements Serializable {

	private static final long serialVersionUID = 1L;

	private int shopID;// (店铺ID)
	private String img;// (图片)
	private String shopName;// (店铺名称)
	private MyLocation location;// (经纬度)
	private int commentNum;// 评价人数
	private float commentScore;// 评价总分
	private String type;// 商家类别
	private String region;// 商圈

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

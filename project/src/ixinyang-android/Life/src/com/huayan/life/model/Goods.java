package com.huayan.life.model;

import java.io.Serializable;

/**
 * 商品信息
 * 
 * @author wzz
 * 
 */
public class Goods extends BaseModel implements Serializable {

	private static final long serialVersionUID = 1L;

	private int goodsID;// (商品ID)
	private String shopImg;// (店铺图片)
	private String name;// (商品名称)
	private String des;// (商品描述)
	private MyLocation location;// 经纬度
	private String discountPrice;// 折扣价
	private String price;// 原价
	private int salesNum;// 已经销售数量
	private float commentScore;//评价分数

	public String getDiscountPrice() {
		return discountPrice;
	}

	public void setDiscountPrice(String discountPrice) {
		this.discountPrice = discountPrice;
	}

	public String getPrice() {
		return price;
	}

	public void setPrice(String price) {
		this.price = price;
	}

	public float getCommentScore() {
		return commentScore;
	}

	public void setCommentScore(float commentScore) {
		this.commentScore = commentScore;
	}

	public int getGoodsID() {
		return goodsID;
	}

	public void setGoodsID(int goodsID) {
		this.goodsID = goodsID;
	}

	public String getShopImg() {
		return shopImg;
	}

	public void setShopImg(String shopImg) {
		this.shopImg = shopImg;
	}

	public String getName() {
		return name;
	}

	public void setName(String name) {
		this.name = name;
	}

	public String getDes() {
		return des;
	}

	public void setDes(String des) {
		this.des = des;
	}

	public MyLocation getLocation() {
		return location;
	}

	public void setLocation(MyLocation location) {
		this.location = location;
	}

	public int getSalesNum() {
		return salesNum;
	}

	public void setSalesNum(int salesNum) {
		this.salesNum = salesNum;
	}

}

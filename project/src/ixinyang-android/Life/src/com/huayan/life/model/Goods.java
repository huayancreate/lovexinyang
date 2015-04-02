package com.huayan.life.model;

import java.io.Serializable;

/**
 * ��Ʒ��Ϣ
 * 
 * @author wzz
 * 
 */
public class Goods extends BaseModel implements Serializable {

	private static final long serialVersionUID = 1L;

	private int goodsID;// (��ƷID)
	private String shopImg;// (����ͼƬ)
	private String name;// (��Ʒ����)
	private String des;// (��Ʒ����)
	private MyLocation location;// ��γ��
	private String discountPrice;// �ۿۼ�
	private String price;// ԭ��
	private int salesNum;// �Ѿ���������
	private float commentScore;//���۷���

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

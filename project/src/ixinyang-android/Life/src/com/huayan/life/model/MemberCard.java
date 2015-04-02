package com.huayan.life.model;

import java.io.Serializable;

/**
 * ��Ա��
 * 
 * @author wzz
 * 
 */
public class MemberCard extends BaseModel implements Serializable {

	private static final long serialVersionUID = 1L;

	private int cardID;// ��Ա��ID
	private String shopName;// ���������ƣ�
	private int shopid;// (����ID)
	private String img;// ����Ա��ͼƬ��
	private String number;// (��Ա������)
	private String level;// (�����еĵȼ��ۿ�)
	private String growthValue;// (�ɳ�ֵ)

	public int getCardID() {
		return cardID;
	}

	public void setCardID(int cardID) {
		this.cardID = cardID;
	}

	public String getShopName() {
		return shopName;
	}

	public void setShopName(String shopName) {
		this.shopName = shopName;
	}

	public int getShopid() {
		return shopid;
	}

	public void setShopid(int shopid) {
		this.shopid = shopid;
	}

	public String getImg() {
		return img;
	}

	public void setImg(String img) {
		this.img = img;
	}

	public String getNumber() {
		return number;
	}

	public void setNumber(String number) {
		this.number = number;
	}

	public String getLevel() {
		return level;
	}

	public void setLevel(String level) {
		this.level = level;
	}

	public String getGrowthValue() {
		return growthValue;
	}

	public void setGrowthValue(String growthValue) {
		this.growthValue = growthValue;
	}

}

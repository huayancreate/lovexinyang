package com.huayan.life.model;

import java.io.Serializable;

/**
 * 会员卡
 * 
 * @author wzz
 * 
 */
public class MemberCard extends BaseModel implements Serializable {

	private static final long serialVersionUID = 1L;

	private int cardID;// 会员卡ID
	private String shopName;// （店铺名称）
	private int shopid;// (店铺ID)
	private String img;// （会员卡图片）
	private String number;// (会员卡卡号)
	private String level;// (所享有的等级折扣)
	private String growthValue;// (成长值)

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

package com.huayan.life.model;

import java.io.Serializable;
import java.util.List;

/**
 * 商品详细信息
 * 
 * @author wzz
 * 
 */
public class GoodsDetail extends BaseModel implements Serializable {

	private static final long serialVersionUID = 1L;

	private String name;// (商品名称)
	private String introduction;// (商品介绍)
	private List<AlbumImage> imgs;// (店铺图片)
	private float commentScore;// 评价总分
	private int commentNum;// 评价人数
	private String tel;// 电话
	private MyLocation location;// 经纬度
	private String address;// 详细地址
	private String discountPrice;// 折扣价
	private String price;// 原价
	private String buyNotice;// 购买须知
	private int shopID;// (店铺ID)
	private int isBookmark;// (0未收藏 ， 1已收藏)

	public int getIsBookmark() {
		return isBookmark;
	}

	public void setIsBookmark(int isBookmark) {
		this.isBookmark = isBookmark;
	}

	public int getShopID() {
		return shopID;
	}

	public void setShopID(int shopID) {
		this.shopID = shopID;
	}

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

	public List<AlbumImage> getImgs() {
		return imgs;
	}

	public void setImgs(List<AlbumImage> imgs) {
		this.imgs = imgs;
	}

	public String getName() {
		return name;
	}

	public void setName(String name) {
		this.name = name;
	}

	public String getIntroduction() {
		return introduction;
	}

	public void setIntroduction(String introduction) {
		this.introduction = introduction;
	}

	public float getCommentScore() {
		return commentScore;
	}

	public void setCommentScore(float commentScore) {
		this.commentScore = commentScore;
	}

	public int getCommentNum() {
		return commentNum;
	}

	public void setCommentNum(int commentNum) {
		this.commentNum = commentNum;
	}

	public String getTel() {
		return tel;
	}

	public void setTel(String tel) {
		this.tel = tel;
	}

	public MyLocation getLocation() {
		return location;
	}

	public void setLocation(MyLocation location) {
		this.location = location;
	}

	public String getAddress() {
		return address;
	}

	public void setAddress(String address) {
		this.address = address;
	}

	public String getBuyNotice() {
		return buyNotice;
	}

	public void setBuyNotice(String buyNotice) {
		this.buyNotice = buyNotice;
	}

}

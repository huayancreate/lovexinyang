package com.huayan.life.model;

public class OrderIntroduce extends BaseModel {

	private static final long serialVersionUID = 1L;

	private String shopName;// （店铺名称）
	private String goodsImg;// (商品图片)
	private String name;// (商品名称)
	private String price;// (总价)
	private int num;// （数量）
	private int detailsID;// 订单详情ID
	private int goodsID;// 商品ID
	private String typeName;// 类别（1待付款 2未消费 3待评价 4退款中 5已退款 6已评价）

	public int getDetailsID() {
		return detailsID;
	}

	public void setDetailsID(int detailsID) {
		this.detailsID = detailsID;
	}

	public String getTypeName() {
		return typeName;
	}

	public void setTypeName(String typeName) {
		this.typeName = typeName;
	}

	public int getGoodsID() {
		return goodsID;
	}

	public void setGoodsID(int goodsID) {
		this.goodsID = goodsID;
	}

	public String getShopName() {
		return shopName;
	}

	public void setShopName(String shopName) {
		this.shopName = shopName;
	}

	public String getGoodsImg() {
		return goodsImg;
	}

	public void setGoodsImg(String goodsImg) {
		this.goodsImg = goodsImg;
	}

	public String getName() {
		return name;
	}

	public void setName(String name) {
		this.name = name;
	}

	public String getPrice() {
		return price;
	}

	public void setPrice(String price) {
		this.price = price;
	}

	public int getNum() {
		return num;
	}

	public void setNum(int num) {
		this.num = num;
	}

}

package com.huayan.life.model;

public class OrderIntroduce extends BaseModel {

	private static final long serialVersionUID = 1L;

	private String shopName;// ���������ƣ�
	private String goodsImg;// (��ƷͼƬ)
	private String name;// (��Ʒ����)
	private String price;// (�ܼ�)
	private int num;// ��������
	private int detailsID;// ��������ID
	private int goodsID;// ��ƷID
	private String typeName;// ���1������ 2δ���� 3������ 4�˿��� 5���˿� 6�����ۣ�

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

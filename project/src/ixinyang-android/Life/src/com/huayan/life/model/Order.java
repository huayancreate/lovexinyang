package com.huayan.life.model;

import java.io.Serializable;

/**
 * ����
 * @author wzz
 *
 */
public class Order extends BaseModel implements Serializable {

	private static final long serialVersionUID = 1L;

	private int type;//(0ȫ�� 1δ���� 2δ���� 3������ 4�˿��� 5���˿� 6������)
	private String typeName;// (0ȫ�� 1δ���� 2δ���� 3������ 4�˿��� 5���˿� 6������)
	private String orderID;//����ID
	private String name;//  (��������)
	private String goodsImg;//(��ƷͼƬ)
	private String price;//(�ܼ�)
	private String unitPrice;//�����ۣ�
	private int num;//��������
	private float commentScore;// (�������۷���)
	private int isBookmark;// (0δ�ղ� �� 1���ղ�)
	private String  orderTime;//�µ�ʱ��
	private String orderTel;//�����ֻ���
	private  String returnUrl;//֧���󷵻ص�URl
	
	public String getUnitPrice() {
		return unitPrice;
	}
	public void setUnitPrice(String unitPrice) {
		this.unitPrice = unitPrice;
	}
	public String getReturnUrl() {
		return returnUrl;
	}
	public void setReturnUrl(String returnUrl) {
		this.returnUrl = returnUrl;
	}
	public int getType() {
		return type;
	}
	public void setType(int type) {
		this.type = type;
	}
	public String getTypeName() {
		return typeName;
	}
	public void setTypeName(String typeName) {
		this.typeName = typeName;
	}
	public String getOrderID() {
		return orderID;
	}
	public void setOrderID(String orderID) {
		this.orderID = orderID;
	}
	public String getName() {
		return name;
	}
	public void setName(String name) {
		this.name = name;
	}
	public String getGoodsImg() {
		return goodsImg;
	}
	public void setGoodsImg(String goodsImg) {
		this.goodsImg = goodsImg;
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
	public float getCommentScore() {
		return commentScore;
	}
	public void setCommentScore(float commentScore) {
		this.commentScore = commentScore;
	}
	public int getIsBookmark() {
		return isBookmark;
	}
	public void setIsBookmark(int isBookmark) {
		this.isBookmark = isBookmark;
	}
	public String getOrderTime() {
		return orderTime;
	}
	public void setOrderTime(String orderTime) {
		this.orderTime = orderTime;
	}
	public String getOrderTel() {
		return orderTel;
	}
	public void setOrderTel(String orderTel) {
		this.orderTel = orderTel;
	}
	
}

package com.huayan.life.model;

import java.io.Serializable;

/**
 * 订单
 * @author wzz
 *
 */
public class Order extends BaseModel implements Serializable {

	private static final long serialVersionUID = 1L;

	private int type;//(0全部 1未付款 2未消费 3待评价 4退款中 5已退款 6已评价)
	private String typeName;// (0全部 1未付款 2未消费 3待评价 4退款中 5已退款 6已评价)
	private String orderID;//订单ID
	private String name;//  (订单名称)
	private String goodsImg;//(商品图片)
	private String price;//(总价)
	private String unitPrice;//（单价）
	private int num;//（数量）
	private float commentScore;// (总体评价分数)
	private int isBookmark;// (0未收藏 ， 1已收藏)
	private String  orderTime;//下单时间
	private String orderTel;//购买手机号
	private  String returnUrl;//支付后返回的URl
	
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

package com.huayan.life.model;

import java.io.Serializable;

public class CusOrderDetails implements Serializable {

	/**
	 * ��������
	 */
	private static final long serialVersionUID = 1L;

	private int id;
	private int orderId;// ����ID
	private String goodsName;// ��Ʒ����
	private int goodsId;// ��ƷID
	private Double price;// ��Ʒ�۸�
	private Double totalPrice;// ��Ʒ�ܼ�
	private String rebate;// �ۿ�
	private Double rebatePrice;// �ۿۼ۸�
	private int sellerId;// �̼�ID
	private String memberCardNo;// ��Ա������
	private int totalNum; // ��Ʒ����

	public int getId() {
		return id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public int getOrderId() {
		return orderId;
	}

	public void setOrderId(int orderId) {
		this.orderId = orderId;
	}

	public String getGoodsName() {
		return goodsName;
	}

	public void setGoodsName(String goodsName) {
		this.goodsName = goodsName;
	}

	public int getGoodsId() {
		return goodsId;
	}

	public void setGoodsId(int goodsId) {
		this.goodsId = goodsId;
	}

	public Double getPrice() {
		return price;
	}

	public void setPrice(Double price) {
		this.price = price;
	}

	public Double getTotalPrice() {
		return totalPrice;
	}

	public void setTotalPrice(Double totalPrice) {
		this.totalPrice = totalPrice;
	}

	public String getRebate() {
		return rebate;
	}

	public void setRebate(String rebate) {
		this.rebate = rebate;
	}

	public Double getRebatePrice() {
		return rebatePrice;
	}

	public void setRebatePrice(Double rebatePrice) {
		this.rebatePrice = rebatePrice;
	}

	public int getSellerId() {
		return sellerId;
	}

	public void setSellerId(int sellerId) {
		this.sellerId = sellerId;
	}

	public String getMemberCardNo() {
		return memberCardNo;
	}

	public void setMemberCardNo(String memberCardNo) {
		this.memberCardNo = memberCardNo;
	}

	public int getTotalNum() {
		return totalNum;
	}

	public void setTotalNum(int totalNum) {
		this.totalNum = totalNum;
	}

}

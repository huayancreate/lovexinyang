package com.huayan.life.model;

import java.io.Serializable;

public class StoGoods implements Serializable {

	/**
	 * ��Ʒ��Ϣ
	 */
	private static final long serialVersionUID = 1L;

	private int id;
	private String  goodsName; // ��Ʒ����
	private String  summary; //��Ʒ���������
	private String describes; //��Ʒ����
	private Double price; //��Ʒ�۸�
	private String parentClass; //��Ʒ����
	private String  subClass; // ��Ʒ����
	private int sellerId; //��Ӧ�̼�ID
	private int  storeId;  //��Ӧ�����ŵ�ID
	private String  validity; //�Ƿ���Ч 0 ��Ч  1 ��Ч
	private String supplyDateTime;//��Ӧʱ��
	private int  inventory;// ���
	private String enjoyRebate; //�Ƿ����ܻ�Ա�ۿ�
	private int goodsGrade;//��Ʒ�ȼ�
	private int goodsWeight;//��ƷȨ��
	public int getId() {
		return id;
	}
	public void setId(int id) {
		this.id = id;
	}
	public String getGoodsName() {
		return goodsName;
	}
	public void setGoodsName(String goodsName) {
		this.goodsName = goodsName;
	}
	public String getSummary() {
		return summary;
	}
	public void setSummary(String summary) {
		this.summary = summary;
	}
	public String getDescribes() {
		return describes;
	}
	public void setDescribes(String describes) {
		this.describes = describes;
	}
	public Double getPrice() {
		return price;
	}
	public void setPrice(Double price) {
		this.price = price;
	}
	public String getParentClass() {
		return parentClass;
	}
	public void setParentClass(String parentClass) {
		this.parentClass = parentClass;
	}
	public String getSubClass() {
		return subClass;
	}
	public void setSubClass(String subClass) {
		this.subClass = subClass;
	}
	public int getSellerId() {
		return sellerId;
	}
	public void setSellerId(int sellerId) {
		this.sellerId = sellerId;
	}
	public int getStoreId() {
		return storeId;
	}
	public void setStoreId(int storeId) {
		this.storeId = storeId;
	}
	public String getValidity() {
		return validity;
	}
	public void setValidity(String validity) {
		this.validity = validity;
	}
	public String getSupplyDateTime() {
		return supplyDateTime;
	}
	public void setSupplyDateTime(String supplyDateTime) {
		this.supplyDateTime = supplyDateTime;
	}
	public int getInventory() {
		return inventory;
	}
	public void setInventory(int inventory) {
		this.inventory = inventory;
	}
	public String getEnjoyRebate() {
		return enjoyRebate;
	}
	public void setEnjoyRebate(String enjoyRebate) {
		this.enjoyRebate = enjoyRebate;
	}
	public int getGoodsGrade() {
		return goodsGrade;
	}
	public void setGoodsGrade(int goodsGrade) {
		this.goodsGrade = goodsGrade;
	}
	public int getGoodsWeight() {
		return goodsWeight;
	}
	public void setGoodsWeight(int goodsWeight) {
		this.goodsWeight = goodsWeight;
	}
	
}


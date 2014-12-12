package com.huayan.life.model;

import java.io.Serializable;

public class StoGoods implements Serializable {

	/**
	 * 商品信息
	 */
	private static final long serialVersionUID = 1L;

	private int id;
	private String  goodsName; // 商品名称
	private String  summary; //商品概述，简介
	private String describes; //商品描述
	private Double price; //商品价格
	private String parentClass; //商品大类
	private String  subClass; // 商品子类
	private int sellerId; //对应商家ID
	private int  storeId;  //对应店铺门店ID
	private String  validity; //是否有效 0 无效  1 有效
	private String supplyDateTime;//供应时间
	private int  inventory;// 库存
	private String enjoyRebate; //是否享受会员折扣
	private int goodsGrade;//商品等级
	private int goodsWeight;//商品权重
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


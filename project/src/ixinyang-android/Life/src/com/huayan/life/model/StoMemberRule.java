package com.huayan.life.model;

import java.io.Serializable;

public class StoMemberRule implements Serializable {

	/**
	 * 商家会员规则设置
	 */
	private static final long serialVersionUID = 1L;

	 private  int id; //ID 自增列
	  private int operatorId;//操作人ID
	  private String  operatorName;//操作人名称
	  private String  createTime;//创建时间
	 private int memberRating;//会员等级
	  private int upperLimit;//会员积分上限
	 private  int lowerLimit;//会员积分下限
	 private String ico;//会员等级图标
	 private String memberName;//会员名称
	 private String  rebate;//折扣
	 private int sellerId;//商家ID
	 private String sellerName;//商家名称
	 private String validity;//是否有效
	 private String modifyTime;//修改时间

	 public int getId() {
		return id;
	}
	public void setId(int id) {
		this.id = id;
	}
	public int getOperatorId() {
		return operatorId;
	}
	public void setOperatorId(int operatorId) {
		this.operatorId = operatorId;
	}
	public String getOperatorName() {
		return operatorName;
	}
	public void setOperatorName(String operatorName) {
		this.operatorName = operatorName;
	}
	public String getCreateTime() {
		return createTime;
	}
	public void setCreateTime(String createTime) {
		this.createTime = createTime;
	}
	public int getMemberRating() {
		return memberRating;
	}
	public void setMemberRating(int memberRating) {
		this.memberRating = memberRating;
	}
	public int getUpperLimit() {
		return upperLimit;
	}
	public void setUpperLimit(int upperLimit) {
		this.upperLimit = upperLimit;
	}
	public int getLowerLimit() {
		return lowerLimit;
	}
	public void setLowerLimit(int lowerLimit) {
		this.lowerLimit = lowerLimit;
	}
	public String getIco() {
		return ico;
	}
	public void setIco(String ico) {
		this.ico = ico;
	}
	public String getMemberName() {
		return memberName;
	}
	public void setMemberName(String memberName) {
		this.memberName = memberName;
	}
	public String getRebate() {
		return rebate;
	}
	public void setRebate(String rebate) {
		this.rebate = rebate;
	}
	public int getSellerId() {
		return sellerId;
	}
	public void setSellerId(int sellerId) {
		this.sellerId = sellerId;
	}
	public String getSellerName() {
		return sellerName;
	}
	public void setSellerName(String sellerName) {
		this.sellerName = sellerName;
	}
	public String getValidity() {
		return validity;
	}
	public void setValidity(String validity) {
		this.validity = validity;
	}
	public String getModifyTime() {
		return modifyTime;
	}
	public void setModifyTime(String modifyTime) {
		this.modifyTime = modifyTime;
	}
	
}

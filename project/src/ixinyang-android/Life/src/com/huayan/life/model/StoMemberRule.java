package com.huayan.life.model;

import java.io.Serializable;

public class StoMemberRule implements Serializable {

	/**
	 * �̼һ�Ա��������
	 */
	private static final long serialVersionUID = 1L;

	 private  int id; //ID ������
	  private int operatorId;//������ID
	  private String  operatorName;//����������
	  private String  createTime;//����ʱ��
	 private int memberRating;//��Ա�ȼ�
	  private int upperLimit;//��Ա��������
	 private  int lowerLimit;//��Ա��������
	 private String ico;//��Ա�ȼ�ͼ��
	 private String memberName;//��Ա����
	 private String  rebate;//�ۿ�
	 private int sellerId;//�̼�ID
	 private String sellerName;//�̼�����
	 private String validity;//�Ƿ���Ч
	 private String modifyTime;//�޸�ʱ��

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

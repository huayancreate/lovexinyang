package com.huayan.life.model;

import java.io.Serializable;

public class CusElectronicCard implements Serializable {

	/**
	 * �û���Ӧ��Ա���ӿ�
	 */
	private static final long serialVersionUID = 1L;

	private int id;
	private int memberId;// ��Ա�ȼ�ID
	private String memberCardNumber;// ��Ա������
	private String sellerName;// �̼�����
	private int userIndividualCenterId;// �û���������ID
	
	public int getId() {
		return id;
	}
	public void setId(int id) {
		this.id = id;
	}
	public int getMemberId() {
		return memberId;
	}
	public void setMemberId(int memberId) {
		this.memberId = memberId;
	}
	public String getMemberCardNumber() {
		return memberCardNumber;
	}
	public void setMemberCardNumber(String memberCardNumber) {
		this.memberCardNumber = memberCardNumber;
	}
	public String getSellerName() {
		return sellerName;
	}
	public void setSellerName(String sellerName) {
		this.sellerName = sellerName;
	}
	public int getUserIndividualCenterId() {
		return userIndividualCenterId;
	}
	public void setUserIndividualCenterId(int userIndividualCenterId) {
		this.userIndividualCenterId = userIndividualCenterId;
	}
	
}

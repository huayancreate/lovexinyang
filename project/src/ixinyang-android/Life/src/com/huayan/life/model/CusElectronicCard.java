package com.huayan.life.model;

import java.io.Serializable;

public class CusElectronicCard implements Serializable {

	/**
	 * 用户对应会员电子卡
	 */
	private static final long serialVersionUID = 1L;

	private int id;
	private int memberId;// 会员等级ID
	private String memberCardNumber;// 会员卡卡号
	private String sellerName;// 商家名称
	private int userIndividualCenterId;// 用户个人中心ID
	
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

package com.huayan.life.model;

import java.io.Serializable;

public class ComComment implements Serializable {

	/**
	 * ����
	 */
	private static final long serialVersionUID = 1L;

	private int id;
	private int storeId; // �ŵ�ID
	private String storeName;// �ŵ�����
	private String content;// ��������
	private String commentPersonID;// ������
	private String commentPersonName;// ����������
	private String discussantAccount;// �������˺�
	private String commentDate;// ����ʱ��
	private int sellerId;// �̼�ID
	private String sellerName;// �̼�����
	private int goodsId;// ��ƷID
	private String goodsName;// ��Ʒ����
	private String cryptonym;// �Ƿ�������0��������1����',
	private String validity;// �Ƿ���Ч��0��Ч��1��Ч',
	private String detailsComment;// ��ϸ����
	private int overallScore;// ��������
	private int pid;// �����̼һظ�ʹ�� �洢Ϊ�ظ���ǰ����ID

	public int getId() {
		return id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public int getStoreId() {
		return storeId;
	}

	public void setStoreId(int storeId) {
		this.storeId = storeId;
	}

	public String getStoreName() {
		return storeName;
	}

	public void setStoreName(String storeName) {
		this.storeName = storeName;
	}

	public String getContent() {
		return content;
	}

	public void setContent(String content) {
		this.content = content;
	}

	public String getCommentPersonID() {
		return commentPersonID;
	}

	public void setCommentPersonID(String commentPersonID) {
		this.commentPersonID = commentPersonID;
	}

	public String getCommentPersonName() {
		return commentPersonName;
	}

	public void setCommentPersonName(String commentPersonName) {
		this.commentPersonName = commentPersonName;
	}

	public String getDiscussantAccount() {
		return discussantAccount;
	}

	public void setDiscussantAccount(String discussantAccount) {
		this.discussantAccount = discussantAccount;
	}

	public String getCommentDate() {
		return commentDate;
	}

	public void setCommentDate(String commentDate) {
		this.commentDate = commentDate;
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

	public int getGoodsId() {
		return goodsId;
	}

	public void setGoodsId(int goodsId) {
		this.goodsId = goodsId;
	}

	public String getGoodsName() {
		return goodsName;
	}

	public void setGoodsName(String goodsName) {
		this.goodsName = goodsName;
	}

	public String getCryptonym() {
		return cryptonym;
	}

	public void setCryptonym(String cryptonym) {
		this.cryptonym = cryptonym;
	}

	public String getValidity() {
		return validity;
	}

	public void setValidity(String validity) {
		this.validity = validity;
	}

	public String getDetailsComment() {
		return detailsComment;
	}

	public void setDetailsComment(String detailsComment) {
		this.detailsComment = detailsComment;
	}

	public int getOverallScore() {
		return overallScore;
	}

	public void setOverallScore(int overallScore) {
		this.overallScore = overallScore;
	}

	public int getPid() {
		return pid;
	}

	public void setPid(int pid) {
		this.pid = pid;
	}

}

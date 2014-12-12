package com.huayan.life.model;

import java.io.Serializable;

public class ComComment implements Serializable {

	/**
	 * 评价
	 */
	private static final long serialVersionUID = 1L;

	private int id;
	private int storeId; // 门店ID
	private String storeName;// 门店名称
	private String content;// 评价内容
	private String commentPersonID;// 评论人
	private String commentPersonName;// 评论人名称
	private String discussantAccount;// 评论人账号
	private String commentDate;// 评论时间
	private int sellerId;// 商家ID
	private String sellerName;// 商家名称
	private int goodsId;// 商品ID
	private String goodsName;// 商品名称
	private String cryptonym;// 是否匿名：0不匿名，1匿名',
	private String validity;// 是否有效：0无效，1有效',
	private String detailsComment;// 详细评价
	private int overallScore;// 总体评分
	private int pid;// 用于商家回复使用 存储为回复当前评论ID

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

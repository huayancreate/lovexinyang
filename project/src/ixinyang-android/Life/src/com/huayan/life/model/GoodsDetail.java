package com.huayan.life.model;

import java.io.Serializable;
import java.util.List;

/**
 * ��Ʒ��ϸ��Ϣ
 * 
 * @author wzz
 * 
 */
public class GoodsDetail extends BaseModel implements Serializable {

	private static final long serialVersionUID = 1L;

	private String name;// (��Ʒ����)
	private String introduction;// (��Ʒ����)
	private List<AlbumImage> imgs;// (����ͼƬ)
	private float commentScore;// �����ܷ�
	private int commentNum;// ��������
	private String tel;// �绰
	private MyLocation location;// ��γ��
	private String address;// ��ϸ��ַ
	private String discountPrice;// �ۿۼ�
	private String price;// ԭ��
	private String buyNotice;// ������֪
	private int shopID;// (����ID)
	private int isBookmark;// (0δ�ղ� �� 1���ղ�)

	public int getIsBookmark() {
		return isBookmark;
	}

	public void setIsBookmark(int isBookmark) {
		this.isBookmark = isBookmark;
	}

	public int getShopID() {
		return shopID;
	}

	public void setShopID(int shopID) {
		this.shopID = shopID;
	}

	public String getDiscountPrice() {
		return discountPrice;
	}

	public void setDiscountPrice(String discountPrice) {
		this.discountPrice = discountPrice;
	}

	public String getPrice() {
		return price;
	}

	public void setPrice(String price) {
		this.price = price;
	}

	public List<AlbumImage> getImgs() {
		return imgs;
	}

	public void setImgs(List<AlbumImage> imgs) {
		this.imgs = imgs;
	}

	public String getName() {
		return name;
	}

	public void setName(String name) {
		this.name = name;
	}

	public String getIntroduction() {
		return introduction;
	}

	public void setIntroduction(String introduction) {
		this.introduction = introduction;
	}

	public float getCommentScore() {
		return commentScore;
	}

	public void setCommentScore(float commentScore) {
		this.commentScore = commentScore;
	}

	public int getCommentNum() {
		return commentNum;
	}

	public void setCommentNum(int commentNum) {
		this.commentNum = commentNum;
	}

	public String getTel() {
		return tel;
	}

	public void setTel(String tel) {
		this.tel = tel;
	}

	public MyLocation getLocation() {
		return location;
	}

	public void setLocation(MyLocation location) {
		this.location = location;
	}

	public String getAddress() {
		return address;
	}

	public void setAddress(String address) {
		this.address = address;
	}

	public String getBuyNotice() {
		return buyNotice;
	}

	public void setBuyNotice(String buyNotice) {
		this.buyNotice = buyNotice;
	}

}

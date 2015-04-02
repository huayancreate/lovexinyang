package util;



public class HttpUrl {

	public static String BASEACTION = "BaseActionController"; // 基础数据
	public static String USERACTION="UserActionController";//用户
	public static String PASSWORDACTION="PasswordActionController";//密码
	public static String BOOKMARKACTION="BookmarkActionController";//收藏
	public static String FINANCEACTION="FinanceActionController";//财务
	public static String MEMBERCARDACTION="MemberCardActionController";//会员卡
	public static String ORDERACTION="OrderActionController";//订单
	public static String ORDERTRANSACTION="OrderTransActionController";//订单交易
	public static String SHOPACTION="ShopAction";//店铺
	public static String GOODSACTION="GoodsAction";//商品
	public static String ADVACTION="AdvAction";//广告
	public static String COMMENTACTION="CommentActionController";//评价
	public static String PLATFORMINTERFACEACTION="PlatformInterfaceActionController";//平台交互
	
	/*新增接口*/
	public static String RECOMMENDDAILYACTION="RecommendDailyActionController";//每日推荐
	public static String APPLICATIONSCORE="RecommendDailyActionController";//系统积分  
	public static String NOTICEACTION="NoticeActionController";//消息通知
	
	
	
	public static class Config {
		public static final boolean DEVELOPER_MODE = false;
	}
}

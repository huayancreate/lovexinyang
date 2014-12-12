package util;

import java.net.URL;

import android.graphics.drawable.Drawable;
import android.text.Html;

/**
 * 文本域中显示 图片
 * @author Administrator
 *
 */
public class TextImage implements Html.ImageGetter {

	public Drawable getDrawable(String source) {
		  try {
				String imagePath=source.lastIndexOf("upload")>0 ?source.substring(source.lastIndexOf("upload")) : 
					source.substring(source.indexOf("js"));
				URL url=new URL(C.http.httpPic()+imagePath);
			    Drawable drawable=	Drawable.createFromStream(url.openStream(), "");
			    drawable.setBounds(0, 0, drawable.getIntrinsicWidth(), drawable.getIntrinsicHeight());
			    return drawable;
			  } catch (Exception e) {
				e.printStackTrace();
			}
			return null;
	}

}
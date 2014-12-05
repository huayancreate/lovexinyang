package util;

import android.app.Activity;
import android.content.Context;
import android.view.View;
import android.view.inputmethod.InputMethodManager;

/**
 * ¼àÌý¼üÅÌ
 * @author Administrator
 * @date 2014-6-23 
 */
public class KeyBoard {
	public static void HiddenInputPanel(Context context) {
		final View v = ((Activity) context).getWindow().peekDecorView();
		if (v != null && v.getWindowToken() != null) {
			InputMethodManager imm = (InputMethodManager) context.getSystemService(Context.INPUT_METHOD_SERVICE);
			imm.hideSoftInputFromWindow(v.getWindowToken(), 0);
		}
	}
}

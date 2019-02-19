package com.craftbox.imagesearch.Custom;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.craftbox.imagesearch.R;


public class Toaster {

    public static int INFO = 1;
    public static int SUCCESS = 2;
    public static int WARNING = 3;
    public static int DANGER = 4;
    public static void show(Context context, String text, boolean isLong, int msgType) {
        LayoutInflater inflater = LayoutInflater.from(context);
        View layout = inflater.inflate(R.layout.toast_layout, null);
        LinearLayout ll_toast = (LinearLayout)layout.findViewById(R.id.ll_toast);
        ImageView image = (ImageView) layout.findViewById(R.id.toast_image);

        TextView textV = (TextView) layout.findViewById(R.id.toast_text);
        textV.setText(text);

        Toast t = new Toast(context);
        t.setView(layout);
        if(isLong)
        {
            t.setDuration(Toast.LENGTH_LONG);
        }
        else
        {
            t.setDuration(Toast.LENGTH_SHORT);
        }

        if(msgType == INFO)
        {
            ll_toast.setBackground(context.getResources().getDrawable(R.drawable.toastinfo));
            image.setImageResource(R.drawable.ic_info_outline_white_36dp);
        }
        if(msgType == DANGER)
        {
            ll_toast.setBackground(context.getResources().getDrawable(R.drawable.toastdanger));
            image.setImageResource(R.drawable.ic_danger);
        }
        if(msgType == SUCCESS)
        {
            ll_toast.setBackground(context.getResources().getDrawable(R.drawable.toastsuccess));
            image.setImageResource(R.drawable.ic_success_done);
        }
        if(msgType == WARNING)
        {
            ll_toast.setBackground(context.getResources().getDrawable(R.drawable.toastwarning));
            image.setImageResource(R.drawable.ic_info_outline_white_36dp);
        }
        t.show();
    }
}

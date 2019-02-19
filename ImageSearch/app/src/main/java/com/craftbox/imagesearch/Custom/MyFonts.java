package com.craftbox.imagesearch.Custom;

import android.content.Context;
import android.graphics.Typeface;


/**
 * Created by WarMachine on 12/25/2016.
 */
public class MyFonts {

    private MyFonts(){}

    public static Typeface setFont(Context context, int text){
        return FontSource.process(text, context);
    }
}

package com.craftbox.imagesearch.Custom;

import java.util.regex.Matcher;
import java.util.regex.Pattern;

/**
 * Created by CRAFT BOX on 3/1/2017.
 */

public class Validation {

    public static int EMAIL=1;
    public static int BLANK_CHECK=2;
    public static int PASSWORD=3;
    public static int MOBILE=4;
    public static boolean isValid(int type,String value)
    {

        switch (type)
        {
            case 1:
            String EMAIL_PATTERN = "^[_A-Za-z0-9-\\+]+(\\.[_A-Za-z0-9-]+)*@"
                    + "[A-Za-z0-9-]+(\\.[A-Za-z0-9]+)*(\\.[A-Za-z]{2,})$";
            Pattern pattern = Pattern.compile(EMAIL_PATTERN);
            Matcher matcher = pattern.matcher(value);
            return matcher.matches();

            case 2:
                return (value.trim().equals(""))?false:true;
            case 3:
                if(value.trim().length()<6)
                {
                    return false;
                }
                else
                {
                    return true;
                }
            case 4:
                if(value.trim().length()<10)
                {
                    return false;
                }
                else
                {
                    return true;
                }
            default: return false;

        }

    }
}

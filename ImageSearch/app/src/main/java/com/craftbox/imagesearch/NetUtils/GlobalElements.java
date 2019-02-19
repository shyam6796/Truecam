package com.craftbox.imagesearch.NetUtils;

import android.app.AlertDialog;
import android.app.Application;
import android.content.Context;
import android.content.DialogInterface;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;

import java.io.File;
import java.text.DecimalFormat;

/**
 * Created by FriendFill on 30-Jul-16.
 */
public class GlobalElements extends Application {

   public static String PreferenceName="bus_tracking";
   public static String EncraptionKey="Craftbox@technology";
   public static String bid;
   public static File finalFile;

   public static double NumberFormater(double value)
   {
      DecimalFormat df = new DecimalFormat("#.####");
      return  Double.parseDouble(df.format(value));
   }

   public static boolean isConnectingToInternet(Context context)
   {
      ConnectivityManager connectivity = (ConnectivityManager) context
              .getSystemService(Context.CONNECTIVITY_SERVICE);

      if (connectivity != null) {
         NetworkInfo info = connectivity.getNetworkInfo(ConnectivityManager.TYPE_MOBILE);

         if (info != null) {
            if (info.isConnected()) {
               return true;
            }
            else
            {
               NetworkInfo info1 = connectivity.getNetworkInfo(ConnectivityManager.TYPE_WIFI);
               if (info1.isConnected()) {
                  return true;
               }
               else
               {
                  return false;
               }
            }
         }
      }
      return false;
   }

   public static void showDialog(Context context)
   {
      AlertDialog alertDialog = new AlertDialog.Builder(context).create();
      // Set Dialog Title
      alertDialog.setTitle("Internet Connection");
      // Set Dialog Message
      alertDialog.setMessage("Please check your internet connection ..");
      // Set OK Button
      alertDialog.setButton("OK", new DialogInterface.OnClickListener()
      {
         public void onClick(DialogInterface dialog, int which)
         {

         }
      });
      // Show Alert Message
      alertDialog.show();
   }

}

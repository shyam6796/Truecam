package com.craftbox.imagesearch;

import android.content.Intent;
import android.os.Handler;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;

import com.craftbox.imagesearch.NetUtils.DBHelper;
import com.craftbox.imagesearch.NetUtils.MyPreferences;

import java.io.IOException;

public class SplashActivity extends AppCompatActivity {

    MyPreferences myPreferences;
    DBHelper db;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_splash);
        myPreferences = new MyPreferences(this);
        db=new DBHelper(this);

        try {
            db.createDataBase();
        } catch (IOException e) {
            e.printStackTrace();
        }

        new Handler().postDelayed(new Runnable() {
            @Override
            public void run() {
            if(myPreferences.GetPreferences("id").equals(""))
            {
                Intent i=new Intent(SplashActivity.this,LoginActivity.class);
                startActivity(i);
                finish();
            }
            else
            {
                Intent i=new Intent(SplashActivity.this,DashBoardActivity.class);
                startActivity(i);
                finish();
            }
            }
        },2000);
    }
}

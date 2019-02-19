package com.craftbox.imagesearch;

import android.app.ProgressDialog;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.design.widget.AppBarLayout;
import android.support.design.widget.CollapsingToolbarLayout;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.LinearLayout;
import android.widget.TextView;

import com.craftbox.imagesearch.Custom.ScaleImageView;
import com.craftbox.imagesearch.Custom.Toaster;
import com.craftbox.imagesearch.Model.ModelImageList;
import com.craftbox.imagesearch.NetUtils.MyPreferences;
import com.craftbox.imagesearch.NetUtils.UserFunction;
import com.craftbox.imagesearch.R;
import com.squareup.picasso.Picasso;

import org.json.JSONException;
import org.json.JSONObject;
import org.w3c.dom.Text;

import java.util.ArrayList;
import java.util.List;

public class ShowUserDetailAct extends AppCompatActivity {
    List<ModelImageList> modelImageListList = new ArrayList<>();
    int Pos;
    String name, email, mobile, birth_date, gender, blood_group, address, image_path, id, Iid;
    ScaleImageView detailimg;
    Button btn_match;
    Uri uri;
    MyPreferences preferences;
    TextView ShowUDNameTv, ShowUDEmailTv, ShowUDMobileTv, ShowUDBirthDateTv, ShowUDGenderTv, ShowUDBloodGroupTv, ShowUDAddressTv;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_show_user_detail);
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        getSupportActionBar().setDisplayShowHomeEnabled(true);
        preferences = new MyPreferences(ShowUserDetailAct.this);

        //TODO:FINDIDS
        ShowUDNameTv = (TextView) findViewById(R.id.ShowUDNameTv);
        ShowUDEmailTv = (TextView) findViewById(R.id.ShowUDEmailTv);
        ShowUDMobileTv = (TextView) findViewById(R.id.ShowUDMobileTv);
        ShowUDBirthDateTv = (TextView) findViewById(R.id.ShowUDBirthDateTv);
        ShowUDGenderTv = (TextView) findViewById(R.id.ShowUDGenderTv);
        ShowUDBloodGroupTv = (TextView) findViewById(R.id.ShowUDBloodGroupTv);
        ShowUDAddressTv = (TextView) findViewById(R.id.ShowUDAddressTv);
        detailimg = (ScaleImageView) findViewById(R.id.detailimg);
        btn_match = (Button) findViewById(R.id.btn_match);
        Iid = preferences.GetPreferences("inserted");


        //TODO:INTENTDATA
        Bundle b = getIntent().getExtras();
        modelImageListList = (List<ModelImageList>) b.getSerializable("model");
        Pos = b.getInt("pos");
        if (modelImageListList != null) {
            name = modelImageListList.get(Pos).getName();
            email = modelImageListList.get(Pos).getEmail();
            mobile = modelImageListList.get(Pos).getMobile();
            gender = modelImageListList.get(Pos).getGender();
            id = modelImageListList.get(Pos).getId();
            birth_date = modelImageListList.get(Pos).getBirth_date();
            blood_group = modelImageListList.get(Pos).getBlood_group();
            address = modelImageListList.get(Pos).getAddress();
            image_path = modelImageListList.get(Pos).getImage_path();
            uri = Uri.parse(image_path);

            //TODO:SETDATA

            ShowUDNameTv.setText(name);
            ShowUDEmailTv.setText(email);
            ShowUDMobileTv.setText(mobile);
            ShowUDBirthDateTv.setText(birth_date);
            ShowUDGenderTv.setText(gender);
            ShowUDBloodGroupTv.setText(blood_group);
            ShowUDAddressTv.setText(address);
            Picasso.with(ShowUserDetailAct.this).load(image_path).into(detailimg);

        } else {
            Toaster.show(ShowUserDetailAct.this, "nodata", false, Toaster.DANGER);
        }

        btn_match.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                new match().execute("match");
            }
        });

        //TODO:CollapsingLayout
        final CollapsingToolbarLayout collapsingToolbarLayout = (CollapsingToolbarLayout) findViewById(R.id.toolbar_layout);
        AppBarLayout appBarLayout = (AppBarLayout) findViewById(R.id.app_bar);
        appBarLayout.addOnOffsetChangedListener(new AppBarLayout.OnOffsetChangedListener() {
            boolean isShow = false;
            int scrollRange = -1;

            @Override
            public void onOffsetChanged(AppBarLayout appBarLayout, int verticalOffset) {
                if (scrollRange == -1) {
                    scrollRange = appBarLayout.getTotalScrollRange();
                    collapsingToolbarLayout.setTitle(" ");
                }
                if (scrollRange + verticalOffset == 0) {
                    collapsingToolbarLayout.setTitle("");

                    isShow = true;
                } else if (isShow) {
                    collapsingToolbarLayout.setTitle(" ");//carefull there should a space between double quote otherwise it wont work
                    isShow = false;
                }
            }
        });

        //TODO:LAYOUTINFLATE


    }
    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()) {
            // Respond to the action bar's Up/Home button
            case android.R.id.home:
                //NavUtils.navigateUpFromSameTask(this);
                finish();
                return true;
        }
        return super.onOptionsItemSelected(item);
    }
    public class match extends AsyncTask<String, Void, JSONObject> {
        ProgressDialog pd;
        String task;

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pd = new ProgressDialog(ShowUserDetailAct.this);
            pd.setMessage("Loading");
            pd.setCancelable(false);
            pd.show();
        }

        @Override
        protected JSONObject doInBackground(String... args) {
            task = args[0];
            if (task == "match") {
                UserFunction uf = new UserFunction();
                JSONObject json = uf.MatchImage(id, Iid);
                return json;
            }

            return null;
        }

        @Override
        protected void onPostExecute(JSONObject json) {
            super.onPostExecute(json);
            pd.dismiss();
            if (task == "match") {
                if (json != null) {
                    try {
                        if (json.getInt("ack") == 1) {

                            Toaster.show(ShowUserDetailAct.this, json.getString("ack_msg"), false, Toaster.SUCCESS);

                        } else {
                            Toaster.show(ShowUserDetailAct.this, json.getString("ack_msg"), false, Toaster.DANGER);
                        }
                    } catch (JSONException e) {
                        e.printStackTrace();
                    }
                } else {
                    Toaster.show(ShowUserDetailAct.this, "Internal Error!", false, Toaster.DANGER);
                }

            }
        }
    }

}

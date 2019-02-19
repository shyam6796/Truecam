package com.craftbox.imagesearch;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.Toolbar;
import android.view.MenuItem;
import android.view.View;
import android.widget.LinearLayout;
import android.widget.Toast;

import com.craftbox.imagesearch.Adapter.SearchHistoryAdapter;
import com.craftbox.imagesearch.Controller.SearchHistoryController;
import com.craftbox.imagesearch.Custom.Toaster;
import com.craftbox.imagesearch.Model.ModelSearchHistory;
import com.craftbox.imagesearch.NetUtils.MyPreferences;
import com.craftbox.imagesearch.NetUtils.UserFunction;

import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;


public class SearchHistoryActivity extends AppCompatActivity {
    RecyclerView SearchHistoryRV;
    String uid;
    List<ModelSearchHistory> modelSearchHistories = new ArrayList<>();
    SearchHistoryAdapter mAdapter;
    MyPreferences preferences;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_search_history);
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        getSupportActionBar().setDisplayShowHomeEnabled(true);

        preferences = new MyPreferences(SearchHistoryActivity.this);
        uid = preferences.GetPreferences("id");
        SearchHistoryRV=(RecyclerView)findViewById(R.id.SearchHistoryRV);
        if (uid != null && !uid.equals("")) {
            new history().execute("history");
        }
        else {
            Intent i=new Intent(SearchHistoryActivity.this,LoginActivity.class);
            startActivity(i);
        }


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

    public class history extends AsyncTask<String, Void, JSONObject> {
        String task = "";
        ProgressDialog progressdialog;

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            progressdialog = new ProgressDialog(SearchHistoryActivity.this);
            progressdialog.setMessage("Please wait while processing...");
            progressdialog.setCanceledOnTouchOutside(false);
            progressdialog.setCancelable(false);
            progressdialog.show();
        }

        @Override
        protected JSONObject doInBackground(String... args) {
            modelSearchHistories.clear();
            task=args[0];
            if(task=="history"){
                UserFunction uf=new UserFunction();
                JSONObject json=uf.SearchHistory(uid);
                return json;
            }
            return null;
        }

        @Override
        protected void onPostExecute(JSONObject json) {
            super.onPostExecute(json);
            progressdialog.dismiss();
            if(json!=null&&!json.equals("")){
                if(task=="history"){
                    try{
                        JSONObject jMainObject=json;

                            modelSearchHistories=new SearchHistoryController().getHistory(json);
                            mAdapter=new SearchHistoryAdapter(modelSearchHistories,SearchHistoryActivity.this);
                            SearchHistoryRV.setAdapter(mAdapter);
                            SearchHistoryRV.setLayoutManager(new LinearLayoutManager(SearchHistoryActivity.this, LinearLayout.VERTICAL,false));


                    }catch (Exception e){
                        e.printStackTrace();
                    }
                }
            }
        }
    }

}

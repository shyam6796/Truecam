package com.craftbox.imagesearch;

import android.app.ProgressDialog;
import android.content.Intent;
import android.database.Cursor;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Bundle;
import android.provider.MediaStore;
import android.support.v4.media.VolumeProviderCompat;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.GridLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.MenuItem;

import com.craftbox.imagesearch.Adapter.ImageAdapter;
import com.craftbox.imagesearch.Controller.ImageListController;
import com.craftbox.imagesearch.Custom.Toaster;
import com.craftbox.imagesearch.Model.ModelImageList;
import com.craftbox.imagesearch.NetUtils.GlobalElements;
import com.craftbox.imagesearch.NetUtils.MyPreferences;
import com.craftbox.imagesearch.NetUtils.UserFunction;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.entity.mime.HttpMultipartMode;
import org.apache.http.entity.mime.MultipartEntityBuilder;
import org.apache.http.entity.mime.content.FileBody;
import org.apache.http.entity.mime.content.StringBody;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.util.EntityUtils;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.File;
import java.util.ArrayList;
import java.util.List;

public class ImageListActivity extends AppCompatActivity {
    RecyclerView ImageListRV;
    List<ModelImageList> modelImageLists = new ArrayList<>();
    ImageAdapter mAdapter;
    String Iid,uid,Image,file1,responseBody;
    String tempUri;
    HttpEntity resEntity;
    //File finalFile;
    MyPreferences preferences;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_image_list);
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        getSupportActionBar().setDisplayShowHomeEnabled(true);
        ImageListRV = (RecyclerView) findViewById(R.id.ImageListRv);

        preferences=new MyPreferences(this);
        Iid=preferences.GetPreferences("Iid");
        uid = preferences.GetPreferences("id");

        new All().execute("");

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
//    public String getRealPathFromURI(Uri uri) {
//        Cursor cursor = getContentResolver().query(uri, null, null, null, null);
//        cursor.moveToFirst();
//        int idx = cursor.getColumnIndex(MediaStore.Images.ImageColumns.DATA);
//        return cursor.getString(idx);
//    }
    public class All extends AsyncTask<String, String, String> {
        ProgressDialog pd;

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pd = new ProgressDialog(ImageListActivity.this);
            pd.setMessage("Loading");
            pd.setCancelable(false);
            pd.show();
        }

        @Override
        protected String doInBackground(String... args) {
// TODO Auto-generated method stub

            try {
                HttpClient client = new DefaultHttpClient();
                HttpPost post = new HttpPost(UserFunction.service_url + "service_user.php");
                MultipartEntityBuilder builder = MultipartEntityBuilder.create();
                builder.setMode(HttpMultipartMode.BROWSER_COMPATIBLE);
                if (GlobalElements.finalFile != null) {
                    FileBody bin1 = new FileBody(GlobalElements.finalFile);
                    builder.addPart("file", bin1);
                }
                builder.addPart("key", new StringBody("1226"));
                builder.addPart("s", new StringBody("40"));
                builder.addPart("uid", new StringBody(""+uid));
                HttpEntity entity = builder.build();
                post.setEntity(entity);
                publishProgress(args);
                HttpResponse response = client.execute(post);
                resEntity = response.getEntity();
                responseBody = EntityUtils.toString(resEntity);
            } catch (Exception e) {
                e.printStackTrace();
            }
            return null;
        }

        @Override
        protected void onPostExecute(String s) {
            super.onPostExecute(s);
            pd.dismiss();
            if (resEntity != null) {
                String res = "0";
                JSONObject jMainObject = null;
                String ack_msg = null;//Convert String to JSON Object
                try {
                    responseBody = responseBody.replaceAll("ï»¿","");
                    jMainObject = new JSONObject(responseBody);
//                    JSONObject jResultObject = jMainObject.getJSONObject("result");
                    res = jMainObject.getString("ack");
                    ack_msg = jMainObject.getString("ack_msg");
                    preferences.SetPreferences("inserted",jMainObject.getString("inserted_id"));
                } catch (JSONException e) {
                    e.printStackTrace();
                }

                if (res.equals("1")) {
                    try {
                        Toaster.show(ImageListActivity.this, "" + ack_msg, false, Toaster.SUCCESS);
                        modelImageLists=new ImageListController().getImageList(jMainObject);
                        mAdapter=new ImageAdapter(modelImageLists,ImageListActivity.this);
                        ImageListRV.setAdapter(mAdapter);
                        ImageListRV.setLayoutManager(new GridLayoutManager(ImageListActivity.this,2));

                    } catch (Exception e) {
                        e.printStackTrace();
                    }
                } else {
                    try {
                        Toaster.show(ImageListActivity.this, "" + ack_msg, false, Toaster.DANGER);
                        Intent i=new Intent(ImageListActivity.this,DashBoardActivity.class);
                        startActivity(i);
                    } catch (Exception e) {
                        e.printStackTrace();
                    }
                }
            }
        }
    }


//    public class ImageLIst extends AsyncTask<String, Void, JSONObject> {
//        ProgressDialog pd;
//        String task = "";
//
//        @Override
//        protected void onPreExecute() {
//            super.onPreExecute();
//            pd = new ProgressDialog(ImageListActivity.this);
//            pd.setMessage("Please wait while processing...");
//            pd.setCanceledOnTouchOutside(false);
//            pd.setCancelable(false);
//            pd.show();
//        }
//
//        @Override
//        protected JSONObject doInBackground(String... args) {
//            task = args[0];
//            modelImageLists.clear();
//            if (task == "Get") {
//                UserFunction uf = new UserFunction();
//                JSONObject json = uf.GetImageList();
//                return json;
//            }
//            return null;
//        }
//
//        @Override
//        protected void onPostExecute(JSONObject json) {
//            super.onPostExecute(json);
//            pd.dismiss();
//            try {
//                if(task=="Get"){
//                    if(json!=null){
//
//                    }
//                    else {
//                        Toaster.show(ImageListActivity.this,"Internal Erro!",false,Toaster.DANGER);
//                    }
//                }
//            } catch (Exception e) {
//                e.printStackTrace();
//            }
//        }
//    }

}

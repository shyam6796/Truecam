package com.craftbox.imagesearch;

import android.app.DatePickerDialog;
import android.app.ProgressDialog;
import android.content.Intent;
import android.database.Cursor;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Build;
import android.provider.MediaStore;
import android.support.design.widget.TextInputLayout;
import android.support.v4.content.FileProvider;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.text.Editable;
import android.text.TextUtils;
import android.text.TextWatcher;
import android.view.MenuItem;
import android.view.View;
import android.view.WindowManager;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.RadioButton;
import android.widget.RadioGroup;
import android.widget.Spinner;
import android.widget.TextView;

import com.craftbox.imagesearch.Custom.Toaster;
import com.craftbox.imagesearch.Model.ModelDepartment;
import com.craftbox.imagesearch.NetUtils.GlobalElements;
import com.craftbox.imagesearch.NetUtils.MyPreferences;
import com.craftbox.imagesearch.NetUtils.UserFunction;
import com.craftbox.imagesearch.R;

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
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.File;
import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.List;
import java.util.Locale;

import butterknife.ButterKnife;
import fr.ganfra.materialspinner.MaterialSpinner;

import static android.R.attr.id;
import static android.R.attr.mode;
import static com.craftbox.imagesearch.R.color.edittext;

public class UpdateDetailActivity extends AppCompatActivity {
    EditText Updateprofile_name_edt, Updateprofile_email_edt, Updateprofile_phone_edt, Updateprofile_address_edt, Updateprofile_DOB_edt;
    RadioButton Updateprofile_radio;
    MaterialSpinner Updateprofile_bloodgroup_spinner, Updateprofile_department_spinner;
    RadioGroup Updateprofile_Genderradiogrp;
    TextView Updateprofile_save;
    TextInputLayout name_input_layout, email_input_layout, phone_input_layout, address_input_layout;
    String uid, name, email, address, phone, DepartMent, Gender, DOB, BloodGroup, Image, file1, responseBody, Departmentid;
    String Bg[] = new String[]{"A+", "B+", "AB+", "O+", "A-", "B-", "AB-", "O-"};
    int selectedId;
    //File finalFile;
    Uri tempUri;
    DatePickerDialog toDatePickerDialog;
    List<ModelDepartment> modelDepartments = new ArrayList<>();
    HttpEntity resEntity;
    MyPreferences myPreferences;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_update_detail);
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        getSupportActionBar().setDisplayShowHomeEnabled(true);

        new DepartMent().execute("get");
        final Calendar myCalendar = Calendar.getInstance();
        myCalendar.add(Calendar.YEAR,-18);

        Bundle b = getIntent().getExtras();
        try {
            //Image = b.getString("img");
             //finalFile=new File(Image);
             //tempUri = FileProvider.getUriForFile(UpdateDetailActivity.this, "my.file.provider.smartsearch", finalFile);
           // tempUri = Uri.parse(Image).getPath();
        } catch (Exception e) {
            e.printStackTrace();
        }

        myPreferences = new MyPreferences(this);
        uid = myPreferences.GetPreferences("id");
        Updateprofile_name_edt = (EditText) findViewById(R.id.Updateprofile_name_edt);
        Updateprofile_email_edt = (EditText) findViewById(R.id.Updateprofile_email_edt);
        Updateprofile_phone_edt = (EditText) findViewById(R.id.Updateprofile_phone_edt);
        Updateprofile_DOB_edt = (EditText) findViewById(R.id.Updateprofile_DOB_edt);
        Updateprofile_address_edt = (EditText) findViewById(R.id.Updateprofile_address_edt);

        Updateprofile_bloodgroup_spinner = (MaterialSpinner) findViewById(R.id.Updateprofile_bloodgroup_spinner);
        Updateprofile_department_spinner = (MaterialSpinner) findViewById(R.id.Updateprofile_department_spinner);
        Updateprofile_Genderradiogrp = (RadioGroup) findViewById(R.id.Updateprofile_Gender_radiogrp);
        Updateprofile_save = (TextView) findViewById(R.id.Updateprofile_save);
        name_input_layout = (TextInputLayout) findViewById(R.id.Updateprofile_name_input_layout);
        email_input_layout = (TextInputLayout) findViewById(R.id.Updateprofile_email_input_layout);
        phone_input_layout = (TextInputLayout) findViewById(R.id.Updateprofile_phone_input_layout);
        address_input_layout = (TextInputLayout) findViewById(R.id.Updateprofile_address_input_layout);

        selectedId = Updateprofile_Genderradiogrp.getCheckedRadioButtonId();
        Updateprofile_radio = (RadioButton) findViewById(selectedId);
        //TODO:ARRAY ADAPTER TO BE SETTED
        ArrayAdapter<String> BLOODGROUPAdapter = new ArrayAdapter<String>(UpdateDetailActivity.this, android.R.layout.simple_spinner_item, Bg);
        BLOODGROUPAdapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        Updateprofile_bloodgroup_spinner.setAdapter(BLOODGROUPAdapter);


        final DatePickerDialog.OnDateSetListener date = new DatePickerDialog.OnDateSetListener() {

            @Override
            public void onDateSet(DatePicker view, int year, int monthOfYear,
                                  int dayOfMonth) {
                // TODO Auto-generated method stub
                myCalendar.set(Calendar.YEAR, year);
                myCalendar.set(Calendar.MONTH, monthOfYear);
                myCalendar.set(Calendar.DAY_OF_MONTH, dayOfMonth);
                updateLabel();
            }

            private void updateLabel() {

                String myFormat = "yyyy/MM/dd"; //In which you need put here
                SimpleDateFormat sdf = new SimpleDateFormat(myFormat, Locale.US);

                Updateprofile_DOB_edt.setText(sdf.format(myCalendar.getTime()));
            }

        };
        Updateprofile_DOB_edt.setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View v) {
                // TODO Auto-generated method stub
                new DatePickerDialog(UpdateDetailActivity.this, date, myCalendar
                        .get(Calendar.YEAR), myCalendar.get(Calendar.MONTH),
                        myCalendar.get(Calendar.DAY_OF_MONTH)).show();

            }
        });

        try {
            uid = myPreferences.GetPreferences("id");
//            Updateprofile_name_edt.setText("" + myPreferences.GetPreferences("name"));
            Updateprofile_email_edt.setText("" + myPreferences.GetPreferences("email"));
//            Updateprofile_address_edt.setText("" + myPreferences.GetPreferences("address"));
//            Updateprofile_phone_edt.setText("" + myPreferences.GetPreferences("phone"));
        } catch (Exception e) {
            e.printStackTrace();
        }

        Updateprofile_save.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                name = Updateprofile_name_edt.getText().toString();
                email = Updateprofile_email_edt.getText().toString();
                address = Updateprofile_address_edt.getText().toString();
                phone = Updateprofile_phone_edt.getText().toString();
                DOB = Updateprofile_DOB_edt.getText().toString();
                Gender = Updateprofile_radio.getText().toString();
                BloodGroup = Updateprofile_bloodgroup_spinner.getSelectedItem().toString();
                DepartMent = Updateprofile_department_spinner.getSelectedItem().toString();
                for (int i = 0; i < modelDepartments.size(); i++) {
                    if (modelDepartments.get(i).getName() == DepartMent) {
                        Departmentid = modelDepartments.get(i).getId();
                    }
                }
                if (!Updateprofile_phone_edt.equals("") && !validateMobile()) {
                    return;
                }
                if (!validateName()) {
                    return;
                }
                if (!validateEmail()) {
                    return;
                }
                if (GlobalElements.isConnectingToInternet(UpdateDetailActivity.this)) {
                    new All().execute("");
                } else {
                    GlobalElements.showDialog(UpdateDetailActivity.this);
                }

            }
        });

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
    private boolean validateMobile() {
        if (!Updateprofile_phone_edt.getText().toString().equals("") && Updateprofile_phone_edt.getText().toString().length() < 10) {
            phone_input_layout.setError(getString(R.string.sign_up_phone_error));
            requestFocus(Updateprofile_phone_edt);
            return false;
        } else {
            phone_input_layout.setErrorEnabled(false);
        }
        return true;
    }

    private boolean validateName() {
        if (Updateprofile_name_edt.getText().toString().equals("")) {
            Updateprofile_name_edt.setError(getString(R.string.sign_up_name_error));
            requestFocus(Updateprofile_name_edt);
            return false;
        } else {
            name_input_layout.setErrorEnabled(false);
        }
        return true;
    }

    private boolean validateEmail() {
        String email1 = Updateprofile_email_edt.getText().toString().trim();
        if (email1.isEmpty() || !isValidEmail(email1)) {
            Updateprofile_email_edt.setError(getString(R.string.sign_up_email_error));
            requestFocus(Updateprofile_email_edt);
            return false;
        } else {
            email_input_layout.setErrorEnabled(false);
        }
        return true;
    }

    private static boolean isValidEmail(String email) {
        return !TextUtils.isEmpty(email) && android.util.Patterns.EMAIL_ADDRESS.matcher(email).matches();
    }

    private void requestFocus(View view) {
        if (view.requestFocus()) {
            getWindow().setSoftInputMode(WindowManager.LayoutParams.SOFT_INPUT_STATE_ALWAYS_VISIBLE);
        }
    }

    public class DepartMent extends AsyncTask<String, Void, JSONObject> {
        ProgressDialog pd;
        String task;

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pd = new ProgressDialog(UpdateDetailActivity.this);
            pd.setMessage("Loading");
            pd.setCancelable(false);
            pd.show();

        }

        @Override
        protected JSONObject doInBackground(String... args) {
            task = args[0];
            if (task == "get") {
                UserFunction uf = new UserFunction();
                JSONObject json = uf.GetDepartmentList();
                return json;
            }

            return null;
        }

        @Override
        protected void onPostExecute(JSONObject json) {
            super.onPostExecute(json);
            pd.dismiss();
            if (task == "get") {
                try {
                    JSONArray jResultArray = json.getJSONArray("result");
                    for (int i = 0; i < jResultArray.length(); i++) {
                        JSONObject jResultObject = jResultArray.getJSONObject(i);
                        ModelDepartment model = new ModelDepartment();
                        model.setId(jResultObject.getString("id"));
                        model.setName(jResultObject.getString("name"));
                        modelDepartments.add(model);
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                }

                List<String> list = new ArrayList<>();
                for (int i = 0; i < modelDepartments.size(); i++) {
                    list.add(i, modelDepartments.get(i).getName());
                }
                try {
                    ArrayAdapter<String> mAdapter = new ArrayAdapter<String>(UpdateDetailActivity.this, R.layout.departmentlist, list);
                    Updateprofile_department_spinner.setAdapter(mAdapter);
                } catch (Exception e) {
                    e.printStackTrace();
                }
            } else {
            }
        }
    }

    public String getRealPathFromURI(Uri uri) {
        Cursor cursor = getContentResolver().query(uri, null, null, null, null);
        cursor.moveToFirst();
        int idx = cursor.getColumnIndex(MediaStore.Images.ImageColumns.DATA);
        return cursor.getString(idx);
    }

    public class All extends AsyncTask<String, String, String> {
        ProgressDialog pd;

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pd = new ProgressDialog(UpdateDetailActivity.this);
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
                builder.addPart("s", new StringBody("39"));
                builder.addPart("name", new StringBody("" + name));
                builder.addPart("email", new StringBody("" + email));
                builder.addPart("mobile", new StringBody("" + phone));
                builder.addPart("birth_date", new StringBody("" + DOB));
                builder.addPart("blood_group", new StringBody("" + BloodGroup));
                builder.addPart("gender",new StringBody(""+Gender));
                builder.addPart("address", new StringBody("" + address));
                builder.addPart("department_id", new StringBody("" + Departmentid));
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
//        private void showDatePicker() {
//            Calendar newCalendar = Calendar.getInstance();
//            newCalendar.add(Calendar.YEAR, -18);
//            toDatePickerDialog = new DatePickerDialog(this, new DatePickerDialog.OnDateSetListener() {
//
//                public void onDateSet(DatePicker view, int year, int monthOfYear, int dayOfMonth) {
//                    Calendar newDate = Calendar.getInstance();
//                    newDate.set(year, monthOfYear, dayOfMonth);
//                    Updateprofile_DOB_edt.setText(dateFormatter.format(newDate.getTime()));
//                }
//            },newCalendar.get(Calendar.YEAR), newCalendar.get(Calendar.MONTH), newCalendar.get(Calendar.DAY_OF_MONTH));
//
//            if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.LOLLIPOP) {
//                toDatePickerDialog.getDatePicker().setLayoutMode(1);
//            }
//            toDatePickerDialog.getDatePicker().setMaxDate(newCalendar.getTimeInMillis()-1000);
//            toDatePickerDialog.show();
//        }
        @Override
        protected void onPostExecute(String s) {
            super.onPostExecute(s);
            pd.dismiss();
            if (resEntity != null) {
                String res = "0";
                responseBody = responseBody.replaceAll("ï»¿", "");
                JSONObject jMainObject = null;
                String ack_msg = null;//Convert String to JSON Object
                try {
                    jMainObject = new JSONObject(responseBody);
                    JSONObject jResultObject = jMainObject.getJSONObject("result");
                    myPreferences.SetPreferences("Iid", jResultObject.getString("id"));
                    res = jMainObject.getString("ack");
                    ack_msg = jMainObject.getString("ack_msg");
                } catch (JSONException e) {
                    e.printStackTrace();
                }

                if (res.equals("1")) {
                    try {
                        Toaster.show(UpdateDetailActivity.this, "" + ack_msg, false, Toaster.SUCCESS);
                        Intent i = new Intent(UpdateDetailActivity.this, DashBoardActivity.class);
                        startActivity(i);
                    } catch (Exception e) {
                        e.printStackTrace();
                    }
                } else {
                    try {
                        Toaster.show(UpdateDetailActivity.this, "" + ack_msg, false, Toaster.DANGER);
                    } catch (Exception e) {
                        e.printStackTrace();
                    }
                }
            }
        }
    }

//    public void compressImage(File file) {
//        if (file == null) {
//            showError("Please choose an image!");
//        } else {
//
//           /* Compressor.getDefault(this)
//                    .compressToFileAsObservable(file)
//                    .subscribeOn(Schedulers.io())
//                    .observeOn(AndroidSchedulers.mainThread())
//                    .subscribe(new Action1<File>() {
//                        @Override
//                        public void call(File file) {
//                            file1 = file;
//                            //setCompressedImage();
//                        }
//                    }, new Action1<Throwable>() {
//                        @Override
//                        public void call(Throwable throwable) {
//                            showError(throwable.getMessage());
//                        }
//                    });*/
//            new Compressor.Builder(this)
//                    .setQuality(100)
//                    .setCompressFormat(Bitmap.CompressFormat.JPEG)
//                    .build()
//                    .compressToFileAsObservable(file)
//                    .subscribeOn(Schedulers.io())
//                    .observeOn(AndroidSchedulers.mainThread())
//                    .subscribe(new Action1<File>() {
//                        @Override
//                        public void call(File file) {
//                            file1 = file;
//                        }
//                    }, new Action1<Throwable>() {
//                        @Override
//                        public void call(Throwable throwable) {
//                            showError(throwable.getMessage());
//                        }
//                    });
//        }
//    }
//    public void showError(String errorMessage) {
//        Toast.makeText(this, errorMessage, Toast.LENGTH_SHORT).show();
//    }

}

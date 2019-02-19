package com.craftbox.imagesearch;

import android.app.ProgressDialog;
import android.content.Intent;
import android.database.Cursor;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.os.AsyncTask;
import android.os.Build;
import android.support.annotation.ColorRes;
import android.support.design.widget.TextInputLayout;
import android.support.v4.content.ContextCompat;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.text.Editable;
import android.text.TextWatcher;
import android.view.View;
import android.view.Window;
import android.view.WindowManager;
import android.widget.AdapterView;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.craftbox.imagesearch.Adapter.CountryAdapter;
import com.craftbox.imagesearch.Model.GeneralModel;
import com.craftbox.imagesearch.NetUtils.DBHelper;
import com.craftbox.imagesearch.NetUtils.GlobalElements;
import com.craftbox.imagesearch.NetUtils.MyPreferences;
import com.craftbox.imagesearch.NetUtils.UserFunction;

import org.json.JSONObject;

import java.util.ArrayList;

import butterknife.BindView;
import butterknife.ButterKnife;
import fr.ganfra.materialspinner.MaterialSpinner;

public class ProfileActivity extends AppCompatActivity {

    /* todo textinput layout */
    @BindView(R.id.profile_name_input_layout)     TextInputLayout name_input_layout;
    @BindView(R.id.profile_email_input_layout)    TextInputLayout email_input_layout;
    @BindView(R.id.profile_locality_input_layout) TextInputLayout locality_input_layout;
    @BindView(R.id.profile_city_input_layout)     TextInputLayout city_input_layout;
    @BindView(R.id.profile_state_input_layout)    TextInputLayout state_input_layout;
    @BindView(R.id.profile_pincode_input_layout)  TextInputLayout pincode_input_layout;
    @BindView(R.id.profile_phone_input_layout)    TextInputLayout phone_input_layout;
    /* todo edittext */
    @BindView(R.id.profile_name_edt)              EditText name_edt;
    @BindView(R.id.profile_email_edt)             EditText email_edt;
    @BindView(R.id.profile_address_edt)           EditText address_edt;
    @BindView(R.id.profile_locality_edt)          EditText locality_edt;
    @BindView(R.id.profile_city_edt)              EditText city_edt;
    @BindView(R.id.profile_state_edt)             EditText state_edt;
    @BindView(R.id.profile_pincode_edt)           EditText pin_code_edt;
    @BindView(R.id.profile_phone_edt)             EditText phone_edt;
    /* todo spinner */
    @BindView(R.id.profile_country_spinner)       MaterialSpinner country_spinner;
    /* todo textview */
    @BindView(R.id.profile_save)                  TextView save_txt;
    /* rodo custom action bar*/
    @BindView(R.id.custom_actionbar_back)         ImageView back;
    @BindView(R.id.custom_actionbar_logout)       ImageView logout;
    /* todo declare varable */
    String uid,name,email,address,locality,city,state,pin_code,phone;
    int country_id;

    /* todo  declare class or model or adapter */
    MyPreferences myPreferences;
    DBHelper db;
    ArrayList<GeneralModel> country_data=new ArrayList<>();
    CountryAdapter countryAdapter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_profile);
        ButterKnife.bind(this);
        myPreferences = new MyPreferences(this);
        db=new DBHelper(this);

        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.LOLLIPOP) {
            Window window = getWindow();
            window.addFlags(WindowManager.LayoutParams.FLAG_DRAWS_SYSTEM_BAR_BACKGROUNDS);
            window.setStatusBarColor(ContextCompat.getColor(ProfileActivity.this,R.color.Colorstatusbar));
        }

        try {
            uid = myPreferences.GetPreferences("id");
            name_edt.setText(""+myPreferences.GetPreferences("name"));
            email_edt.setText(""+myPreferences.GetPreferences("email"));
            address_edt.setText(""+myPreferences.GetPreferences("address"));
            locality_edt.setText(""+myPreferences.GetPreferences("locality"));
            city_edt.setText(""+myPreferences.GetPreferences("city"));
            state_edt.setText(""+myPreferences.GetPreferences("state"));
            pin_code_edt.setText(""+myPreferences.GetPreferences("pin_code"));
            phone_edt.setText(""+myPreferences.GetPreferences("phone"));
        } catch (Exception e) {
            e.printStackTrace();
        }

        pin_code_edt.addTextChangedListener(new MyTextWatcher(pin_code_edt));
        phone_edt.addTextChangedListener(new MyTextWatcher(phone_edt));

        Getcountry();

        back.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                finish();
            }
        });

        logout.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                myPreferences.SetPreferences("id","");
                myPreferences.SetPreferences("name","");
                myPreferences.SetPreferences("email","");
                myPreferences.SetPreferences("phone","");
                myPreferences.SetPreferences("address","");
                myPreferences.SetPreferences("locality","");
                myPreferences.SetPreferences("city","");
                myPreferences.SetPreferences("state","");
                myPreferences.SetPreferences("country_slug","");
                myPreferences.SetPreferences("pin_code","");
                Intent i = new Intent(getApplicationContext(), LoginActivity.class);
                i.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
                startActivity(i);
            }
        });

        save_txt.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                uid = myPreferences.GetPreferences("id");
                name        = name_edt.getText().toString();
                email       = email_edt.getText().toString();
                address     = address_edt.getText().toString();
                locality    = locality_edt.getText().toString();
                city        = city_edt.getText().toString();
                state       =  state_edt.getText().toString();
                pin_code    = pin_code_edt.getText().toString();
                phone       = phone_edt.getText().toString();
                if(!pin_code.equals("") &&!Pincode())
                {
                    return;
                }
                if(!phone.equals("") && !validateMobile())
                {
                    return;
                }
                if(GlobalElements.isConnectingToInternet(ProfileActivity.this))
                {
                    new General().execute("update");
                }
                else
                {
                    GlobalElements.showDialog(ProfileActivity.this);
                }

            }
        });

        country_spinner.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {

                try {
                    country_id =  country_data.get(position).getId();
                    country_spinner.setError(null);
                }catch (Exception e)
                {
                    country_id=0;
                    e.printStackTrace();
                }
            }
            @Override
            public void onNothingSelected(AdapterView<?> parent) {
            }
        });

    }

    private boolean Pincode() {
        if (!pin_code_edt.getText().toString().equals("") &&pin_code_edt.getText().toString().length() < 6) {
            pincode_input_layout.setError(getString(R.string.profile_pincode_error));
            requestFocus(pin_code_edt);
            return false;
        } else {
            pincode_input_layout.setErrorEnabled(false);
        }
        return true;
    }

    private boolean validateMobile() {
        if (!phone_edt.getText().toString().equals("") && phone_edt.getText().toString().length() <10) {
            phone_input_layout.setError(getString(R.string.sign_up_phone_error));
            requestFocus(phone_edt);
            return false;
        } else {
            phone_input_layout.setErrorEnabled(false);
        }
        return true;
    }


    private void requestFocus(View view) {
        if (view.requestFocus()) {
            getWindow().setSoftInputMode(WindowManager.LayoutParams.SOFT_INPUT_STATE_ALWAYS_VISIBLE);
        }
    }

    private class MyTextWatcher implements TextWatcher {

        private View view;
        private MyTextWatcher(View view) {
            this.view = view;
        }
        public void beforeTextChanged(CharSequence charSequence, int i, int i1, int i2) {
        }
        public void onTextChanged(CharSequence charSequence, int i, int i1, int i2) {
        }
        public void afterTextChanged(Editable editable) {
            switch (view.getId()) {
                case R.id.profile_pincode_edt:
                    Pincode();
                    break;
                case R.id.profile_phone_edt:
                    validateMobile();
                    break;
            }
        }
    }

    /* todo get country in local database */
    public void Getcountry()
    {
        try {
            Cursor c=db.getData("select * from "+DBHelper.Country+"");
            if(c.getCount()>0)
            {
                while (c.moveToNext())
                {
                    GeneralModel da=new GeneralModel();
                    da.setId(c.getInt(c.getColumnIndex("id")));
                    da.setName(c.getString(c.getColumnIndex("name")));
                    country_data.add(da);
                }
                countryAdapter = new CountryAdapter(ProfileActivity.this,country_data);
                country_spinner.setAdapter(countryAdapter);
                countryAdapter.notifyDataSetChanged();
                country_spinner.setHint("Select country");
                for (int i=0;i<country_data.size();i++)
                {
                    if(country_data.get(i).getId()==Integer.parseInt(myPreferences.GetPreferences("country_slug")))
                    {
                        country_spinner.setSelection(i+1);
                        break;
                    }
                }
            }
            else
            {
                countryAdapter = new CountryAdapter(ProfileActivity.this,country_data);
                country_spinner.setAdapter(countryAdapter);
                countryAdapter.notifyDataSetChanged();
                country_spinner.setHint("Select country");
            }
        }catch (Exception e)
        {
            e.printStackTrace();
        }
    }

    public class General extends AsyncTask<String,Void,JSONObject>
    {
        ProgressDialog pd;
        String temp="";
        @Override
        protected void onPreExecute()
        {
            super.onPreExecute();
            pd = new ProgressDialog(ProfileActivity.this);
            pd.setMessage("Loading");
            pd.setCancelable(false);
            pd.show();
        }
        @Override
        protected JSONObject doInBackground(String... args) {
            temp=args[0];
            if(temp.equals("update"))
            {
                UserFunction uf=new UserFunction();
                JSONObject json=uf.UserUpdate(uid,name,email,address,locality,city,state,pin_code,phone,""+country_id);
                return json;
            }
            return null;
        }

        @Override
        protected void onPostExecute(JSONObject json) {
            super.onPostExecute(json);

            try {
                if(temp.equals("update"))
                {
                    if(json.getInt("ack")==1)
                    {
                        Toast.makeText(ProfileActivity.this, ""+json.getString("ack_msg"), Toast.LENGTH_SHORT).show();
                        JSONObject c=json.getJSONObject("result");

                        /* todo set Preference */
                        myPreferences.SetPreferences("id",c.getString("id"));
                        myPreferences.SetPreferences("name",c.getString("name"));
                        myPreferences.SetPreferences("email",c.getString("email"));
                        myPreferences.SetPreferences("phone",c.getString("phone"));
                        myPreferences.SetPreferences("address",c.getString("address"));
                        myPreferences.SetPreferences("locality",c.getString("locality"));
                        myPreferences.SetPreferences("city",c.getString("city"));
                        myPreferences.SetPreferences("state",c.getString("state"));
                        myPreferences.SetPreferences("country_slug",c.getString("country_slug"));
                        myPreferences.SetPreferences("pin_code",c.getString("zip"));
                        Toast.makeText(ProfileActivity.this, ""+json.getString("ack_msg"), Toast.LENGTH_SHORT).show();
                        finish();
                    }
                    else
                    {
                        Toast.makeText(ProfileActivity.this, ""+json.getString("ack_msg"), Toast.LENGTH_SHORT).show();
                    }
                }
                pd.dismiss();
            }
            catch (Exception e)
            {
                e.printStackTrace();
                pd.dismiss();
            }
        }
    }
}

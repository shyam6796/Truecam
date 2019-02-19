package com.craftbox.imagesearch;

import android.Manifest;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.os.AsyncTask;
import android.support.design.widget.TextInputLayout;
import android.os.Bundle;
import android.telephony.TelephonyManager;
import android.text.Editable;
import android.text.TextUtils;
import android.text.TextWatcher;
import android.view.View;
import android.view.WindowManager;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.craftbox.imagesearch.NetUtils.GlobalElements;
import com.craftbox.imagesearch.NetUtils.MyPreferences;
import com.craftbox.imagesearch.NetUtils.RuntimePermissionsActivity;
import com.craftbox.imagesearch.NetUtils.UserFunction;

import org.json.JSONObject;

import butterknife.BindView;
import butterknife.ButterKnife;

public class LoginActivity extends RuntimePermissionsActivity {

    /* todo declar xml varable  */
    @BindView(R.id.login_email_input_layout)
    TextInputLayout email_input;
    @BindView(R.id.login_password_input_layout)
    TextInputLayout password_input;

    @BindView(R.id.login_email_edt)
    EditText email_edt;
    @BindView(R.id.login_password_edt)
    EditText password_edt;

    @BindView(R.id.login_sumbit_txt)
    TextView login_txt;
    @BindView(R.id.login_signup_txt)
    TextView signup_txt;
    @BindView(R.id.login_forgot_txt)
    TextView forgot_password;

    @BindView(R.id.login_finish_img)
    ImageView back;

    /* todo declar varable */
    String email,password,imei="";

    /* todo declar model or class or adapter */
    MyPreferences myPreferences;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        ButterKnife.bind(LoginActivity.this);
        myPreferences = new MyPreferences(this);

        /* todo  reuntime permission */
        LoginActivity.super.requestAppPermissions(new
                        String[]{android.Manifest.permission.READ_PHONE_STATE, Manifest.permission.CAMERA,android.Manifest.permission.WRITE_EXTERNAL_STORAGE}, R.string.runtime_permissions_txt
                , 20);

        password_edt.addTextChangedListener(new LoginActivity.MyTextWatcher(password_edt));
        email_edt.addTextChangedListener(new LoginActivity.MyTextWatcher(email_edt));

        back.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                finish();
            }
        });

        login_txt.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (!validateEmail()) {
                    return;
                }
                if (!validatePassword()) {
                    return;
                }

                if(imei.toString().equals(""))
                {
                    LoginActivity.super.requestAppPermissions(new
                                    String[]{android.Manifest.permission.READ_PHONE_STATE}, R.string.runtime_permissions_txt
                            , 20);
                    return;
                }

                email     = email_edt.getText().toString();
                password  = password_edt.getText().toString();
                if(GlobalElements.isConnectingToInternet(LoginActivity.this))
                {
                    new General().execute("login");
                }
                else
                {
                    GlobalElements.showDialog(LoginActivity.this);
                }
            }
        });

        signup_txt.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i=new Intent(LoginActivity.this,SignUpActivity.class);
                startActivity(i);
                finish();
            }
        });

        forgot_password.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i=new Intent(LoginActivity.this,ForgetPasswordActivity.class);
                startActivity(i);
            }
        });
    }

    @Override
    public void onPermissionsGranted(int requestCode) {
        try {
            TelephonyManager tele = (TelephonyManager) getApplicationContext()
                    .getSystemService(Context.TELEPHONY_SERVICE);
            imei = tele.getDeviceId();
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    private boolean validatePassword() {
        if (password_edt.getText().toString().length() < 6) {
            password_input.setError(getString(R.string.sign_up_password_error));
            requestFocus(password_edt);
            return false;
        } else {
            password_input.setErrorEnabled(false);
        }
        return true;
    }

    private boolean validateEmail() {
        String email1 = email_edt.getText().toString().trim();
        if (email1.isEmpty() || !isValidEmail(email1)) {
            email_input.setError(getString(R.string.sign_up_email_error));
            requestFocus(email_edt);
            return false;
        } else {
            email_input.setErrorEnabled(false);
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
                case R.id.login_email_edt:
                    validateEmail();
                    break;
                case R.id.login_password_edt:
                    validatePassword();
                    break;
            }
        }
    }

    @Override
    public void onBackPressed() {
        super.onBackPressed();
        finish();
    }

    public class General extends AsyncTask<String,Void,JSONObject>
    {
        ProgressDialog pd;
        String temp="";
        @Override
        protected void onPreExecute()
        {
            super.onPreExecute();
            pd = new ProgressDialog(LoginActivity.this);
            pd.setMessage("Loading");
            pd.setCancelable(false);
            pd.show();
        }
        @Override
        protected JSONObject doInBackground(String... args) {
            temp=args[0];
            if(temp.equals("login"))
            {
                UserFunction uf=new UserFunction();
                JSONObject json=uf.UserLogin(email,password,imei,"123456");
                return json;
            }
            return null;
        }

        @Override
        protected void onPostExecute(JSONObject json) {
            super.onPostExecute(json);

            try {
                if(temp.equals("login"))
                {
                    if(json.getInt("ack")==1)
                    {
                        Toast.makeText(LoginActivity.this, ""+json.getString("ack_msg"), Toast.LENGTH_SHORT).show();
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

                        Intent intent = new Intent(LoginActivity.this, DashBoardActivity.class);
                        startActivity(intent);
                        finish();
                    }
                    else
                    {
                        password_edt.setText("");
                        Toast.makeText(LoginActivity.this, ""+json.getString("ack_msg"), Toast.LENGTH_SHORT).show();
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

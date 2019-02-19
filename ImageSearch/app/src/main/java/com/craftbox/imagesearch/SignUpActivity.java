package com.craftbox.imagesearch;

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
import com.craftbox.imagesearch.NetUtils.RuntimePermissionsActivity;
import com.craftbox.imagesearch.NetUtils.UserFunction;

import org.json.JSONObject;

import butterknife.BindView;
import butterknife.ButterKnife;

public class SignUpActivity extends RuntimePermissionsActivity {

    @BindView(R.id.sign_up_name_input_layout)
    TextInputLayout name_input;
    @BindView(R.id.sign_up_email_input_layout)
    TextInputLayout email_input;
    @BindView(R.id.sign_up_password_input_layout)
    TextInputLayout password_input;
    @BindView(R.id.sign_up_phone_input_layout)
    TextInputLayout phone_input;

    @BindView(R.id.sign_up_name_edt)
    EditText name_edt;
    @BindView(R.id.sign_up_email_edt)
    EditText email_edt;
    @BindView(R.id.sign_up_password_edt)
    EditText password_edt;
    @BindView(R.id.sign_up_phone_edt)
    EditText phone_edt;

    @BindView(R.id.signup_sumbit_txt)
    TextView submit_txt;
    @BindView(R.id.signup_login_txt)
    TextView login_txt;

    @BindView(R.id.signup_finish_img)
    ImageView back;


    String email,name,password,mobile,imei;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_sign_up);
        ButterKnife.bind(this);

        SignUpActivity.super.requestAppPermissions(new
                        String[]{android.Manifest.permission.READ_PHONE_STATE}, R.string.runtime_permissions_txt
                , 20);

        name_edt.addTextChangedListener(new MyTextWatcher(name_edt));
        email_edt.addTextChangedListener(new MyTextWatcher(email_edt));
        password_edt.addTextChangedListener(new MyTextWatcher(password_edt));
        phone_edt.addTextChangedListener(new MyTextWatcher(phone_edt));

        submit_txt.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(!validateName())
                {
                    return;
                }
                if (!validateEmail()) {
                    return;
                }
                if (!validatePassword()) {
                    return;
                }
                if(!validateMobile())
                {
                    return;
                }
                if(imei.toString().equals(""))
                {
                    SignUpActivity.super.requestAppPermissions(new
                                    String[]{android.Manifest.permission.READ_PHONE_STATE}, R.string.runtime_permissions_txt
                            , 20);
                    return;
                }

                if(GlobalElements.isConnectingToInternet(SignUpActivity.this))
                {
                    name=name_edt.getText().toString();
                    email = email_edt.getText().toString();
                    password = password_edt.getText().toString();
                    mobile = phone_edt.getText().toString();
                    new General().execute("signup");
                }
                else
                {
                    GlobalElements.showDialog(SignUpActivity.this);
                }
            }
        });

        login_txt.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i = new Intent(getApplicationContext(), LoginActivity.class);
                i.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
                startActivity(i);
            }
        });

        back.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i = new Intent(getApplicationContext(), LoginActivity.class);
                i.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
                startActivity(i);
            }
        });
    }

    @Override
    public void onBackPressed() {
        super.onBackPressed();
        Intent i = new Intent(getApplicationContext(), LoginActivity.class);
        i.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
        startActivity(i);
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

    private boolean validateName() {
        if (name_edt.getText().toString().equals("")) {
            name_input.setError(getString(R.string.sign_up_name_error));
            requestFocus(name_edt);
            return false;
        } else {
            name_input.setErrorEnabled(false);
        }
        return true;
    }
    private boolean validatePassword() {
        if (password_edt.getText().toString().length() < 5) {
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
    private boolean validateMobile() {
        if (phone_edt.getText().toString().length() < 10) {
            phone_input.setError(getString(R.string.sign_up_phone_error));
            requestFocus(phone_edt);
            return false;
        } else {
            phone_input.setErrorEnabled(false);
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
                case R.id.sign_up_name_edt:
                    validateName();
                    break;
                case R.id.sign_up_email_edt:
                    validateEmail();
                    break;
                case R.id.sign_up_password_edt:
                    validatePassword();
                    break;
                case R.id.sign_up_phone_edt:
                    validateMobile();
                    break;
            }
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
            pd = new ProgressDialog(SignUpActivity.this);
            pd.setMessage("Loading");
            pd.setCancelable(false);
            pd.show();
        }
        @Override
        protected JSONObject doInBackground(String... args) {
            temp=args[0];
            if(temp.equals("signup"))
            {
                UserFunction uf=new UserFunction();
                JSONObject json=uf.UserSignup(name,email,password,mobile,imei,"12354");
                return json;
            }
            return null;
        }

        @Override
        protected void onPostExecute(JSONObject json) {
            super.onPostExecute(json);

            try {
                if(temp.equals("signup"))
                {
                    if(json.getInt("ack")==1)
                    {
                        Toast.makeText(SignUpActivity.this, ""+json.getString("ack_msg"), Toast.LENGTH_SHORT).show();
                        Intent intent = new Intent(SignUpActivity.this, LoginActivity.class);
                        intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
                        startActivity(intent);
                        finish();
                    }
                    else
                    {
                        Toast.makeText(SignUpActivity.this, ""+json.getString("ack_msg"), Toast.LENGTH_SHORT).show();
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

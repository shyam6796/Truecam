package com.craftbox.imagesearch;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v4.widget.NestedScrollView;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.CardView;
import android.util.Log;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.craftbox.imagesearch.NetUtils.UserFunction;

import org.json.JSONObject;

public class ForgetPasswordActivity extends AppCompatActivity {

    NestedScrollView nsv;
    CardView c1, c2, c3, c4;
    EditText edt_email, edt_password, edt_r_password, edt_security_code;
    String email, password, rpassword, code;
    Button btn_find_account, btn_change_password, btn_continue, btn_login;
    TextView tv_code_send_email,tv_resend_code;
    ImageView back;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        setContentView(R.layout.activity_forget_password);
        nsv = (NestedScrollView) findViewById(R.id.nsv);

        tv_resend_code = (TextView) findViewById(R.id.tv_resend_code);
        tv_code_send_email = (TextView) findViewById(R.id.tv_code_send_email);
        edt_email = (EditText) findViewById(R.id.signup_email);
        edt_password = (EditText) findViewById(R.id.signup_new_password);
        edt_r_password = (EditText) findViewById(R.id.signup_new_password_retype);
        edt_security_code = (EditText) findViewById(R.id.edt_security_code);
        btn_find_account = (Button) findViewById(R.id.btn_find_account);
        btn_change_password = (Button) findViewById(R.id.btn_change_password);
        btn_continue = (Button) findViewById(R.id.btn_continue);
        btn_login = (Button) findViewById(R.id.btn_login);
        back = (ImageView)findViewById(R.id.custom_actionbar_back);


        c1 = (CardView) findViewById(R.id.card_view_1);
        c2 = (CardView) findViewById(R.id.card_view_2);
        c3 = (CardView) findViewById(R.id.card_view_3);
        c4 = (CardView) findViewById(R.id.card_view_4);

        back.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                finish();
            }
        });

        tv_resend_code.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                new findAccount().execute();
            }
        });
        btn_find_account.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                email = edt_email.getText().toString();
                boolean isValid = true;
                if (email == null || email.equals("")) {
                    isValid = false;
                    edt_email.setError("Email Required!!");

                }

                if (isValid) {
                    new findAccount().execute();
                }
            }
        });
        btn_continue.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                code = edt_security_code.getText().toString();
                boolean isValid = true;
                if (code == null || code.equals("") || code.length() < 6) {
                    isValid = false;
                    edt_security_code.setError("Code Not Valid!!");

                }

                if (isValid) {
                    new checkSecurity().execute();
                }
            }
        });
        btn_change_password.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                password = edt_password.getText().toString();
                rpassword = edt_r_password.getText().toString();
                boolean isValid = true;
                if (password == null || password.length()< 6 ) {
                    isValid = false;
                    edt_password.setError(""+getResources().getString(R.string.sign_up_password_error));
                }
                if (rpassword == null || !rpassword.equals(password)) {
                    isValid = false;
                    edt_r_password.setError("Password Miss Match");
                }
                if (isValid) {
                    new changeForgetPassword().execute();
                }
            }
        });
        btn_login.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i = new Intent(ForgetPasswordActivity.this, LoginActivity.class);
                i.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
                startActivity(i);
                finish();
            }
        });
    }
    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()) {
            case android.R.id.home:
                finish();
                return true;
            default:
                return super.onOptionsItemSelected(item);
        }
    }

    public class findAccount extends AsyncTask<String, Void, JSONObject> {
        ProgressDialog pd;

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pd = new ProgressDialog(ForgetPasswordActivity.this);
            pd.setTitle("Please Wait");
            pd.setMessage("Loading");
            pd.setCancelable(false);
            pd.show();
        }

        @Override
        protected JSONObject doInBackground(String... strings) {
            UserFunction uf = new UserFunction();

            JSONObject json = uf.findAccount(email);
            return json;
        }

        @Override
        protected void onPostExecute(JSONObject json) {
            super.onPostExecute(json);
            try {
                int success = json.getInt("ack");
                if (success == 1) {
                    c1.setVisibility(View.GONE);
                    c2.setVisibility(View.VISIBLE);
                    tv_code_send_email.setText(edt_email.getText().toString());

                    Toast.makeText(ForgetPasswordActivity.this, json.getString("ack_msg"), Toast.LENGTH_SHORT).show();
                } else if (success == 2) {
                    edt_email.setError(json.getString("ack_msg"));
                } else {
                    Toast.makeText(ForgetPasswordActivity.this, json.getString("ack_msg"), Toast.LENGTH_SHORT).show();
                }


            } catch (Exception e) {
                e.printStackTrace();
                Log.e("<--Payment list--->", e.toString());
            }

            pd.dismiss();
        }
    }
    public class checkSecurity extends AsyncTask<String, Void, JSONObject> {
        ProgressDialog pd;

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pd = new ProgressDialog(ForgetPasswordActivity.this);
            pd.setTitle("Please Wait");
            pd.setMessage("Loading");
            pd.setCancelable(false);
            pd.show();
        }

        @Override
        protected JSONObject doInBackground(String... strings) {
            UserFunction uf = new UserFunction();

            JSONObject json = uf.checkSecurity(email, code);
            return json;
        }

        @Override
        protected void onPostExecute(JSONObject json) {
            super.onPostExecute(json);
            try {
                int success = json.getInt("ack");
                if (success == 1) {
                    c1.setVisibility(View.GONE);
                    c2.setVisibility(View.GONE);
                    c3.setVisibility(View.VISIBLE);
                    Toast.makeText(ForgetPasswordActivity.this, json.getString("ack_msg"), Toast.LENGTH_SHORT).show();
                } else if (success == 2) {
                    edt_security_code.setError(json.getString("ack_msg"));
                } else {
                    Toast.makeText(ForgetPasswordActivity.this, json.getString("ack_msg"), Toast.LENGTH_SHORT).show();
                }


            } catch (Exception e) {
                e.printStackTrace();
                Log.e("<--Payment list--->", e.toString());
            }

            pd.dismiss();
        }
    }
    public class changeForgetPassword extends AsyncTask<String, Void, JSONObject> {
        ProgressDialog pd;

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pd = new ProgressDialog(ForgetPasswordActivity.this);
            pd.setTitle("Please Wait");
            pd.setMessage("Loading");
            pd.setCancelable(false);
            pd.show();
        }

        @Override
        protected JSONObject doInBackground(String... strings) {
            UserFunction uf = new UserFunction();

            JSONObject json = uf.changeForgetPassword(email, password);
            return json;
        }

        @Override
        protected void onPostExecute(JSONObject json) {
            super.onPostExecute(json);
            try {
                int success = json.getInt("ack");
                if (success == 1) {
                    c1.setVisibility(View.GONE);
                    c2.setVisibility(View.GONE);
                    c3.setVisibility(View.GONE);
                    c4.setVisibility(View.VISIBLE);
                    Toast.makeText(ForgetPasswordActivity.this, json.getString("ack_msg"), Toast.LENGTH_SHORT).show();
                } else if (success == 2) {
                    edt_password.setError(json.getString("ack_msg"));
                } else {
                    Toast.makeText(ForgetPasswordActivity.this, json.getString("ack_msg"), Toast.LENGTH_SHORT).show();
                }


            } catch (Exception e) {
                e.printStackTrace();
                Log.e("<--Payment list--->", e.toString());
            }

            pd.dismiss();
        }
    }
}

package com.google.www.smartlock;

import android.app.Activity;
import android.content.Intent;
import android.os.CountDownTimer;
import android.os.Bundle;
import android.widget.ProgressBar;

public class Splash extends Activity {
    public static final int segundos = 8;
    public static final int milisegundos = segundos*1000;
    public static final int delay = 2;
    private ProgressBar pBar;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_splash);
        pBar = (ProgressBar) findViewById(R.id.pBar);
        pBar.setMax(maximoProgreso());
        empezaranimacion();
    }

    public void empezaranimacion(){
        new CountDownTimer(milisegundos,1000){

            @Override
            public void onTick(long millisUntilFinished) {
                pBar.setProgress(establecerProgreso(millisUntilFinished));
            }

            @Override
            public void onFinish() {
                Intent nuevoform = new Intent(Splash.this,Navegador.class);
                startActivity(nuevoform);
                finish();
            }
        }.start();
    }

    public int establecerProgreso(long miliseconds){
        return (int)((milisegundos-miliseconds)/1000);
    }

    public int maximoProgreso(){
        return segundos - delay;
    }
}

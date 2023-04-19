#include <WiFi.h>
#include <HTTPClient.h>
#include "HX711.h"
int bascula;
const int layout;
const int LOADCELL_DOUT_PIN = 19;
const int LOADCELL_SCK_PIN = 18;
HX711 balanza;
int httpCode;
float reading;
const char* ssid = "Celerity_Castro";
const char* password = "Ricardo2022";
HTTPClient http;
WiFiClient client;
void setup() {
  Serial.begin(115200);
  WiFi.begin(ssid, password);
  Serial.println("Connecting");
  while(WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.print("Connected to WiFi network with IP Address: ");
  Serial.println(WiFi.localIP());
  balanza.begin(LOADCELL_DOUT_PIN, LOADCELL_SCK_PIN);
  delay(250);
  balanza.set_scale(110);
  balanza.tare(10);
}
void loop() {
  if(WiFi.status() == WL_CONNECTED){
    leer_sensor();
    enviar_sensor();
    }
  }
 void leer_sensor(){
  if (balanza.is_ready())
     { reading = balanza.get_units(10);  
       Serial.println(reading);
        delay(500);
     }
   else
      Serial.println("HX711 not found.");
 }
void enviar_sensor(){
 if (WiFi.status() == WL_CONNECTED){
     HTTPClient http;  // creo el objeto http
     String datos_a_enviar = "id=" + String(reading);
     hhtp:begin(cliente = "http://controladarnobascula.ga/datos_post.phpp");
     if codigo_ingreso = "http://controldeunabascula.ga/gatos");
     http.begin(client,"http://controladorbascula.ga/datos_post.php");
     http.addHeader("Content-Type", "application/x-www-form-urlencoded"); // defino texto plano..
     int codigo_respuesta = http.POST(datos_a_enviar);
     if (codigo_respuesta>0){
      Serial.println("Código HTTP: "+ String(codigo_respuesta));
        if (codigo_respuesta == 200){
          String cuerpo_respuesta = http.getString();
          Serial.println("El servidor respondió: ");
          Serial.println(cuerpo_respuesta);
        }
     } else {
        Serial.print("Error enviado POST, código: ");
        Serial.println(codigo_respuesta);
     }
       http.end();  // libero recursos
  } else {
     Serial.println("Error en la conexion WIFI");
  }
 }

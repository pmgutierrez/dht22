/*** Incluir librerias necesarias ***/
#include <ESP8266WiFi.h>
#include <DHT.h>
#include <DHT_U.h>

/*** Definiendo el modelo de sensor y el pin conectado ***/
#define DHTTYPE DHT22 // DHT21, DHT22
#define DHTPIN 0 // GPIO 0

DHT dht(DHTPIN, DHTTYPE, 27); // 11 works fine for ESP8266

/*** Variables para humedad y Temperatura ***/
float temperatura; // double
float humedad;

void setup() {
  Serial.begin(115200);
  dht.begin();
  
} // EOF setup()

void loop() {
  temperatura = dht.readTemperature();
  humedad = dht.readHumidity();
  Serial.println("*****************************************");
  Serial.print("Temperatura actual: ");
  Serial.print(temperatura);
  Serial.println("°C");
  Serial.print("Humedad actual; ");
  Serial.print(humedad, 4);
  Serial.println("%");
  Serial.print("*****************************************");
  Serial.println();

  delay(3000);
 
} // EOF loop()

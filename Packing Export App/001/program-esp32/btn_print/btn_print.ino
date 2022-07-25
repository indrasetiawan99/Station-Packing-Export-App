/*----- WiFi and HTTP Client -----*/
#include <WiFi.h>
#include <HTTPClient.h>
//const char *ssid = "INDRA_PC";
//const char *password = "qwer1234";
const char *ssid = "DESKTOP-VAV3K26 3037";
const char *password = "1r\\S0472";

//Your Domain name with URL path or IP address with path
//String serverName = "http://192.168.137.1:8081/boxing-qrcode/public/home/btnPrintQrcode";
String serverName = "http://192.168.137.1/boxing-qrcode/public/home/btnPrintQrcode";
String serverPath1 = "";
String serverPath2 = "";
String serverPath3 = "";
String serverPath4 = "";
HTTPClient http;
/*----- WiFi and HTTP Client -----*/

/*----- Logical Programming Variable -----*/
bool one_cycle1 = true;
bool one_cycle2 = true;
bool dif_down1 = false;
bool dif_down2 = false;
unsigned long millisBefore1;
unsigned long millisBefore2;
/*----- Logical Programming Variable -----*/

/*----- Signal Sequence -----*/
#define btn_print_ 14
bool btn_print;
bool curr_val_btn_print;
/*----- Signal Sequence -----*/

void setup(void) {
  Serial.begin(115200);

  // configure wifi connection
  WiFi.begin(ssid, password);
  Serial.println("Connecting");
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.print("Connected to WiFi network with IP Address: ");
  Serial.println(WiFi.localIP());

  // configure input
  pinMode(btn_print_, INPUT_PULLUP);
}

void loop(void) {
  if (WiFi.status() != WL_CONNECTED) {
    ESP.restart();
  }

  // setting variable to read signal
  btn_print = digitalRead(btn_print_);

  /********** Print QR-code **********/
  if ((btn_print == 0) && (curr_val_btn_print == 1) && (dif_down1 == false)) {
    serverPath1 = serverName;

    // Your Domain name with URL path or IP address with path
    http.begin(serverPath1.c_str());
    http.GET();
    http.end();
    serverPath1 = "";

    dif_down1 = true;
    Serial.println("Button print ditekan");
  }
  curr_val_btn_print = btn_print;

  if (dif_down1 == true) {
    if (one_cycle1) {
      millisBefore1 = millis();
      one_cycle1 = false;
    }
    if (millis() - millisBefore1 > 500) {
      dif_down1 = false;
      millisBefore1 = millis();
      one_cycle1 = true;
    }
  }
  /********** Print QR-code **********/
}

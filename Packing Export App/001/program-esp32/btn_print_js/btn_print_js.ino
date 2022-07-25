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
  Serial.begin(9600);

  // configure input
  pinMode(btn_print_, INPUT_PULLUP);
}

void loop(void) {

  // setting variable to read signal
  btn_print = digitalRead(btn_print_);

  /********** Print QR-code **********/
  if ((btn_print == 0) && (curr_val_btn_print == 1) && (dif_down1 == false)) {
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

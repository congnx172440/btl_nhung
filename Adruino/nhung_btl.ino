#include <MFRC522.h> 
#include <SPI.h> 
#include <WiFi.h>
#include <HTTPClient.h>
#include <Arduino.h>
#include <Wire.h> 
#include <LiquidCrystal_I2C.h>

LiquidCrystal_I2C lcd(0x27,16,2);

#include "soc/soc.h"
#include "soc/rtc_cntl_reg.h"
#include "esp_camera.h"

WiFiClient client;

//Dinh nghia cac chan SPI giao tiep voi RC522
#define RST_PIN   16  
#define SS_PIN    15  
#define MISO_PIN  12 
#define MOSI_PIN  13 
#define SCK_PIN   14 
#define SIZE_BUFFER     18
#define MAX_SIZE_BLOCK  16

//Dinh nghia cac chan I2C giao tep voi LCD 16*2
#define SDA 3
#define SCL 1

// Dinh nghia cac chan cua camera
#define PWDN_GPIO_NUM     32
#define RESET_GPIO_NUM    -1
#define XCLK_GPIO_NUM      0
#define SIOD_GPIO_NUM     26
#define SIOC_GPIO_NUM     27

#define Y9_GPIO_NUM       35
#define Y8_GPIO_NUM       34
#define Y7_GPIO_NUM       39
#define Y6_GPIO_NUM       36
#define Y5_GPIO_NUM       21
#define Y4_GPIO_NUM       19
#define Y3_GPIO_NUM       18
#define Y2_GPIO_NUM        5
#define VSYNC_GPIO_NUM    25
#define HREF_GPIO_NUM     23
#define PCLK_GPIO_NUM     22


const char* ssid = "TPLink2";
const char* password = "vinh12345!";
const char* device="1";
String authName = "http://192.168.0.101:81/auth";
String serverNameCam = "192.168.0.101";
String serverPathCam = "/uploads/upload.php";
const int serverPort = 80;     
unsigned long startTime = 0;
unsigned long timeDelay = 42000;//Qua trinh xac thuc se ket thuc khi thoi gian cho lon hon 1p

//used in authentication
MFRC522::MIFARE_Key key;
//authentication return status code
MFRC522::StatusCode status;
// Defined pins to module RC522
MFRC522 rfid(SS_PIN, RST_PIN);
extern SPIClass spiRFID;

//Khoi tao noi luu tru uid duoc doc vao
byte nuidPICC[4];
void setup() {
  spiRFID.begin(14,12,13,15);
  rfid.PCD_Init(); // Init MFRC522
  for (byte i = 0; i < 6; i++) {
    key.keyByte[i] = 0xFF;
  }
  //WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);
  while(WiFi.status() != WL_CONNECTED) {
    delay(500);
  }
  //Set up cho LCD
  lcd.begin(SDA, SCL);// initialize the lcd with SDA and SCL pins
  // Print a message to the LCD.
  lcd.backlight();
  lcd.setCursor(2,0);
  lcd.print("N24 XIN MOI");
  lcd.setCursor(3,1);
  lcd.print("QUET THE!");
  

  //Set up cho camera
  WRITE_PERI_REG(RTC_CNTL_BROWN_OUT_REG, 0); 
  camera_config_t config;
  config.ledc_channel = LEDC_CHANNEL_0;
  config.ledc_timer = LEDC_TIMER_0;
  config.pin_d0 = Y2_GPIO_NUM;
  config.pin_d1 = Y3_GPIO_NUM;
  config.pin_d2 = Y4_GPIO_NUM;
  config.pin_d3 = Y5_GPIO_NUM;
  config.pin_d4 = Y6_GPIO_NUM;
  config.pin_d5 = Y7_GPIO_NUM;
  config.pin_d6 = Y8_GPIO_NUM;
  config.pin_d7 = Y9_GPIO_NUM;
  config.pin_xclk = XCLK_GPIO_NUM;
  config.pin_pclk = PCLK_GPIO_NUM;
  config.pin_vsync = VSYNC_GPIO_NUM;
  config.pin_href = HREF_GPIO_NUM;
  config.pin_sscb_sda = SIOD_GPIO_NUM;
  config.pin_sscb_scl = SIOC_GPIO_NUM;
  config.pin_pwdn = PWDN_GPIO_NUM;
  config.pin_reset = RESET_GPIO_NUM;
  config.xclk_freq_hz = 20000000;
  config.pixel_format = PIXFORMAT_JPEG;

  // init with high specs to pre-allocate larger buffers
  if(psramFound()){
    config.frame_size = FRAMESIZE_SVGA;
    config.jpeg_quality = 10;  //0-63 lower number means higher quality
    config.fb_count = 2;
  } else {
    config.frame_size = FRAMESIZE_CIF;
    config.jpeg_quality = 12;  //0-63 lower number means higher quality
    config.fb_count = 1;
  }
  
  // camera init
  esp_err_t err = esp_camera_init(&config);
  if (err != ESP_OK) {
    delay(1000);
    ESP.restart();
  }  
}

void loop() {

  
  // Đặt lại vòng lặp nếu không có thẻ mới 
  if ( ! rfid.PICC_IsNewCardPresent())
    return;
  // Xac minh xem the da duoc doc chua
  if ( ! rfid.PICC_ReadCardSerial())
    return;

  MFRC522::PICC_Type piccType = rfid.PICC_GetType(rfid.uid.sak);

  if (rfid.uid.uidByte[0] != nuidPICC[0] || rfid.uid.uidByte[1] != nuidPICC[1] || rfid.uid.uidByte[2] != nuidPICC[2] || rfid.uid.uidByte[3] != nuidPICC[3] ) 
    {
    //Luu UID vao mang nuidPICC 
    String CardID ="";
    for (byte i = 0; i < 4; i++) 
    {
      CardID += rfid.uid.uidByte[i];
    }
    
    if(WiFi.status()== WL_CONNECTED)
    {
      sendPhoto(CardID);
      HTTPClient http;
      String getData = "/" + CardID ;
      String link=authName+getData;
      String payload;
      int httpResponseCode;
          startTime=millis();
          while(1)
          {
            delay(15000);
            if(millis()-startTime > timeDelay) 
            { 
                lcd.clear();
                lcd.setCursor(0,0);
                lcd.print("XAC THUC KHAU");
                lcd.setCursor(0,1);
                lcd.print("TRANG THAT BAI!");
                delay(4000);
                break;
            }
            http.begin(link.c_str());
            httpResponseCode = http.GET();
            if (httpResponseCode==200)
            {
              payload = http.getString();
              lcd.clear();
              lcd.setCursor(4,0);
              lcd.print("XIN CHAO !");
              lcd.setCursor(0,1);
              lcd.print(payload);
              http.end();
              delay(4000);
              break;
            }
            if (httpResponseCode==201)
            {
              payload = http.getString();
              lcd.clear();
              lcd.setCursor(4,0);
              lcd.print("THAT BAI!");
              lcd.setCursor(0,1);
              lcd.print("CHINH KHAU TRANG");
              http.end();
              delay(4000);
              break;
            }
          }
        
     
      // Free resources
      http.end();
    }
    else 
    {
      lcd.clear();
      lcd.setCursor(0,0);
      lcd.print("MAT KET NOI WIFI");
      delay(4000);
    }
    
  }

  // Halt PICC
  rfid.PICC_HaltA();

  // Stop encryption on PCD
  rfid.PCD_StopCrypto1();
  lcd.clear();
  lcd.setCursor(2,0);
  lcd.print("N24 XIN MOI");
  lcd.setCursor(3,1);
  lcd.print("QUET THE!");
}

void sendPhoto(String &CardID) {
  String getAll;
  String getBody;

  camera_fb_t * fb = NULL;
  fb = esp_camera_fb_get();
  if(!fb) {
    delay(1000);
    ESP.restart();
  }
  if (client.connect(serverNameCam.c_str(), serverPort)) 
  {
    String head = "--RandomNerdTutorials\r\nContent-Disposition: form-data; name=\"imageFile\"; filename=\"1_"+ CardID +".jpg\"\r\nContent-Type: image/jpeg\r\n\r\n";
    String tail = "\r\n--RandomNerdTutorials--\r\n";

    uint32_t imageLen = fb->len;
    uint32_t extraLen = head.length() + tail.length();
    uint32_t totalLen = imageLen + extraLen;
  
    client.println("POST " + serverPathCam + " HTTP/1.1");
    client.println("Host: " + serverNameCam);
    client.println("Content-Length: " + String(totalLen));
    client.println("Content-Type: multipart/form-data; boundary=RandomNerdTutorials");
    client.println();
    client.print(head);
  
    uint8_t *fbBuf = fb->buf;
    size_t fbLen = fb->len;
    for (size_t n=0; n<fbLen; n=n+1024) {
      if (n+1024 < fbLen) {
        client.write(fbBuf, 1024);
        fbBuf += 1024;
      }
      else if (fbLen%1024>0) {
        size_t remainder = fbLen%1024;
        client.write(fbBuf, remainder);
      }
    }   
    client.print(tail);
    esp_camera_fb_return(fb);
    
    int timoutTimer = 6000;
    long startTimer = millis();
    boolean state = false;
    
    while ((startTimer + timoutTimer) > millis()) 
    {
      delay(100);      
      while (client.available()) {
        char c = client.read();
        if (c == '\n') {
          if (getAll.length()==0) { state=true; }
          getAll = "";
        }
        else if (c != '\r') { getAll += String(c); }
        if (state==true) { getBody += String(c); }
        startTimer = millis();
      }
      if (getBody.length()>0) { break; }
    }
    client.stop();

  }
  else {
    lcd.setCursor(0,0);
    lcd.print("LOI KET NOI CAM");
    delay(4000);
  }
}

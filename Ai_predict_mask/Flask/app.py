from flask import Flask, render_template, request

import tensorflow as tf
import json
from keras.preprocessing.image import img_to_array
from tensorflow.keras.layers import *
from tensorflow.keras.models import Model
from keras_preprocessing.image import load_img
from flask import jsonify
import matplotlib.pyplot as plt
import numpy as np

app = Flask(__name__)
IMAGE_SIZE = 224
BATCH_SIZE = 64
IMG_SHAPE = (IMAGE_SIZE, IMAGE_SIZE, 3)
base_model = tf.keras.applications.MobileNetV2(input_shape=IMG_SHAPE, include_top=False, weights='imagenet')
model = base_model.output
model = AveragePooling2D(pool_size=(7, 7))(model)
model = Flatten(name="flatten")(model)
model = Dense(512, activation="relu")(model)
model = Dropout(0.5)(model)
model = Dense(256, activation="relu")(model)
model = Dropout(0.5)(model)
model = Dense(64, activation="relu")(model)
model = Dropout(0.5)(model)
model = Dense(2, activation="softmax")(model)
model = Model(inputs=base_model.input, outputs=model)
model = tf.keras.models.load_model("model.h5")

@app.route('/<string:image_name>', methods=['GET'])
def predict(image_name):    
    global img_path
    img_path="C:\\xampp\\htdocs\\uploads\\"
    image_path = img_path + f'{image_name}'+'.jpg'
    image = load_img(image_path, target_size=(224, 224))
    image = img_to_array(image)
    image = np.expand_dims(image, axis=0)
    image /= 255.
    result = model.predict(image)
    label='OK'
    if(result[0][0] <= 0.5): 
        label= 'NOK'
    return label

if __name__ == '__main__':
    app.run(port=3000, debug=True)

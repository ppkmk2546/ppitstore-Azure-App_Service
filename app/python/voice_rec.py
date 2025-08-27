import os
import sys
import pathlib
# import matplotlib.pyplot as plt
import numpy as np
import seaborn as sns
import tensorflow as tf
from tensorflow.keras import layers
from tensorflow.keras import models
from sklearn.metrics import classification_report
from pydub import AudioSegment
# from IPython import display

model2022 = tf.keras.models.load_model('D:\\xampp\\htdocs\\project\\vitzard-laravel\\app\\python\\modelch2')

filenames = sys.argv[1]
filenames = "D:\\xampp\\htdocs\\project\\vitzard-laravel\\public\\assets\\predict_data\\test_rec\\" + filenames

sound = AudioSegment.from_wav(filenames)
sound = sound.set_channels(1)
sound.export(filenames, format="wav")

#download speech command dataset
DATASET_PATH = 'D:\\xampp\\htdocs\\project\\vitzard-laravel\\app\\python\\TA'
data_dir = pathlib.Path(DATASET_PATH)
if not data_dir.exists():
  tf.keras.utils.get_file(
      'mini_speech_commands.zip',
      origin="http://storage.googleapis.com/download.tensorflow.org/data/mini_speech_commands.zip",
      extract=True,
      cache_dir='.', cache_subdir='data')

#get folder name
commands = np.array(tf.io.gfile.listdir(str(data_dir)))
commands = commands[commands != 'README.md']
print('Commands:', commands)

# print('Example file tensor:', filenames[0])
filenames = [filenames]

def decode_audio(audio_binary):
  audio, _ = tf.audio.decode_wav(contents=audio_binary)
  return tf.squeeze(audio, axis=-1)

def get_label(file_path):
  parts = tf.strings.split(
      input=file_path,
      sep=os.path.sep)
  return parts[-2]

def get_waveform_and_label(file_path):
  label = get_label(file_path)
  audio_binary = tf.io.read_file(file_path)
  waveform = decode_audio(audio_binary)
  return waveform, label

AUTOTUNE = tf.data.AUTOTUNE
files_ds = tf.data.Dataset.from_tensor_slices(filenames)
waveform_ds = files_ds.map(map_func=get_waveform_and_label, num_parallel_calls=AUTOTUNE)

def get_spectrogram(waveform):
  input_len = 20000
  waveform = waveform[:input_len]
  zero_padding = tf.zeros(
      [20000] - tf.shape(waveform),
      dtype=tf.float32)
  waveform = tf.cast(waveform, dtype=tf.float32)
  equal_length = tf.concat([waveform, zero_padding], 0)
  spectrogram = tf.signal.stft(
      equal_length, frame_length=255, frame_step=128)
  spectrogram = tf.abs(spectrogram)
  spectrogram = spectrogram[..., tf.newaxis]
  return spectrogram

def get_spectrogram_and_label_id(audio, label):
  spectrogram = get_spectrogram(audio)
  label_id = tf.argmax(label == commands)
  return spectrogram, label_id

spectrogram_ds = waveform_ds.map(
  map_func=get_spectrogram_and_label_id,
  num_parallel_calls=AUTOTUNE)

def preprocess_dataset(files):
  files_ds = tf.data.Dataset.from_tensor_slices(files)
  output_ds = files_ds.map(
      map_func=get_waveform_and_label,
      num_parallel_calls=AUTOTUNE)
  output_ds = output_ds.map(
      map_func=get_spectrogram_and_label_id,
      num_parallel_calls=AUTOTUNE)
  return output_ds

test_ds = preprocess_dataset(filenames)

for spectrogram, _ in spectrogram_ds.take(1):
  input_shape = spectrogram.shape
print('Input shape:', input_shape)

#get number of unique labels (folders)
num_labels = len(commands)

#extract x and y from test set
test_audio = []
test_labels = []

for audio, label in test_ds:
  test_audio.append(audio.numpy())
  test_labels.append(label.numpy())

test_audio = np.array(test_audio)
test_labels = np.array(test_labels)

# name23=['cpu','Gaming','harddisk','headset','keyboard','monitor','mouse','notebook','ram']

y_pred = np.argmax(model2022.predict(test_audio), axis=1)
y_true = test_labels
print(y_pred[0])
